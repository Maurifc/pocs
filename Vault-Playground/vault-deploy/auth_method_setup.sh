#!/bin/bash

printf "Sourcing envs from .env file\n";
# Check if .env exists
if [ -f .env ];
then
    source .env;
else
    printf "Error: .env file not found\n";
    exit 1;
fi

printf "\nChanging context to ${CONTEXT_CLIENT_CLUSTER}\n";
kubectl config use-context $CONTEXT_CLIENT_CLUSTER

if [ $? != 0 ];
then
    printf "Aborting: Can't change context to %s\n" $CONTEXT_CLIENT_CLUSTER;
    exit 1;
fi

###########
# check if need to install injector

#
if [ $TLS_ENABLED = true ];
then
    printf "\nInstalling vault Injector: TLS Enabled\n";
    EXTERNAL_URL="https://external-vault:8200"
else
    printf "\nInstalling vault Injector: TLS Disable\nd"
    EXTERNAL_URL="http://external-vault:8200"
fi

helm install vault hashicorp/vault \
    --set "injector.externalVaultAddr=${EXTERNAL_URL}" --version 0.19.0

#
printf "\nCreating Service and Endpoint for injector\n";
envsubst < injector_setup/external-vault.yaml.template > tmp/external-vault.yaml
kubectl apply -f tmp/external-vault.yaml

#
#########

#

printf "\nEnabling Vault Kubernetes Auth Method\n";
vault auth enable kubernetes

#
printf "\nGetting info from client cluster\n";
VAULT_HELM_SECRET_NAME=$(kubectl get secrets --output=json | jq -r '.items[].metadata | select(.name|startswith("vault-token-")).name')
TOKEN_REVIEW_JWT=$(kubectl get secret $VAULT_HELM_SECRET_NAME --output='go-template={{ .data.token }}' | base64 --decode)
KUBE_CA_CERT=$(kubectl config view --raw --minify --flatten --output='jsonpath={.clusters[].cluster.certificate-authority-data}' | base64 --decode)
KUBE_HOST=$(kubectl config view --raw --minify --flatten --output='jsonpath={.clusters[].cluster.server}')

#
printf "\nSetting up Kubernetes Auth Method\n";
vault write auth/kubernetes/config \
        token_reviewer_jwt="$TOKEN_REVIEW_JWT" \
        kubernetes_host="$KUBE_HOST" \
        kubernetes_ca_cert="$KUBE_CA_CERT" \
        issuer="https://kubernetes.default.svc.cluster.local"