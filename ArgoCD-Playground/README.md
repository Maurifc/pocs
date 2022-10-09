# Kubernetes
This repo holds applications K8s Manifests or Hem Charts

**This is intended to be used on Continuos Delivery POC**

## Useful commands

### Setup

Install ArgoCD on Kubernetes cluster
```bash
kubectl create namespace argocd
kubectl apply -n argocd -f https://raw.githubusercontent.com/argoproj/argo-cd/stable/manifests/install.yaml
```

Install Argo CD CLI on your machine
```bash
curl -sSL -o /usr/local/bin/argocd https://github.com/argoproj/argo-cd/releases/latest/download/argocd-linux-amd64
chmod +x /usr/local/bin/argocd
```

Forward ArgoCD port
```bash
kubectl port-forward svc/argocd-server -n argocd 8080:443
```

Get the Admin password
```bash
kubectl -n argocd get secret argocd-initial-admin-secret -o jsonpath="{.data.password}" | base64 -d; echo
```

Login on CLI
```bash
argocd login localhost:8080
```

> Optionally, you can access the UI via browser using `admin` user and `http://localhost:8080/`

### Creating Application
Create the app using CLI
```bash
kubectl create namespace prod
argocd app create lockeyapi-prod \
    --repo git@bitbucket.org:mauricarmo/kubernetes.git \
    --path lockeyapi \
    --dest-server https://kubernetes.default.svc \
    --dest-namespace prod
```

Check app status
```bash
argocd app list
```

Sync app with git repo
```bash
argocd app sync lockeyapi
```

### Private Repo
Just add the repo with its a private key
```bash
argocd repo add git@bitbucket.org:mauricarmo/kubernetes.git --ssh-private-key-path ~/.ssh/id_rsa
```

## Setup Argo Rollouts
Create namespace
```bash
kubectl create namespace argo-rollouts
```

Deploy
```bash
kubectl apply -n argo-rollouts -f https://github.com/argoproj/argo-rollouts/releases/latest/download/install.yaml
```

## Folders
| Name | Description |
| ---- | ----------- |
| argocd_apps | Argo's applications described as K8s manifests |
| canary-demo | Canary demo with Argo Rollouts' |
| charts/lockeyapi | An not packed Helm chart |
| lockeyapi | K8s manifests to deploy LockeyAPI |
| sample_app | Sample app used in canary demo |


## References:
[ArgoCD with Helm](https://argo-cd.readthedocs.io/en/stable/user-guide/helm)  
[ArgoRollouts Getting Started](https://github.com/argoproj/argo-rollouts/blob/master/docs/getting-started.md)  
[Setting up Private Repositories](https://argo-cd.readthedocs.io/en/release-1.8/user-guide/private-repositories)  