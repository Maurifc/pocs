
Set variables
```bash
CLUSTER_NAME=istio-cluster
PROJECT_ID=
CLUSTER_LOCATION=us-east1-d
LOCAL_ANTHOS_DIR=$HOME/.anthos
```

Create a cluster
```bash
gcloud container clusters create $CLUSTER_NAME \
    --project=$PROJECT_ID \
    --zone=$CLUSTER_LOCATION \
    --machine-type=e2-standard-4 \
    --num-nodes=2 \
    --workload-pool=$PROJECT_ID.svc.id.goog
```

Get cluster credentials
```bash
gcloud container clusters get-credentials istio-test \
    --project=$PROJECT_ID \
    --zone=$CLUSTER_LOCATION
```

Download Antos Service Mesh CLI
```bash
curl https://storage.googleapis.com/csm-artifacts/asm/asmcli_1.13 > asmcli
chmod +x asmcli
```

Install Anthos Service Mesh on cluster
```bash
./asmcli install \
  --project_id $PROJECT_ID \
  --cluster_name $CLUSTER_NAME \
  --cluster_location $CLUSTER_LOCATION \
  --output_dir $LOCAL_ANTHOS_DIR \
  --enable_all \
  --ca mesh_ca \
  --option prometheus
```

## Deploying an application
Create a `namespace`
```bash
kubectl create ns poc
```

Label namespace to `enable` auto-injection
```bash
kubectl label namespace poc istio-injection=enabled
```

Deploy the sample application
```bash
kubectl apply -n poc -f bookinfo.yaml
```

Wait until all pods get ready
```bash
$ kubectl get pods -n poc

NAME                              READY   STATUS    RESTARTS   AGE
details-v1-7d88846999-sjrsk       2/2     Running   0          12s
productpage-v1-7795568889-zrk7f   2/2     Running   0          4s
ratings-v1-754f9c4975-8g9hj       2/2     Running   0          10s
reviews-v1-55b668fc65-5rdpp       2/2     Running   0          8s
reviews-v2-858f99c99-g8xkv        2/2     Running   0          7s
reviews-v3-7886dd86b9-t9v7n       2/2     Running   0          6s
```

## Addons

Create namespaces
```bash
kubectl create ns grafana
kubectl create ns prometheus

```

Label `Prometheus` namespace
```bash
kubectl label namespace prometheus istio-injection=enabled
```

Install Prometheus

```bash
helm install \
  --namespace prometheus \
  --repo https://prometheus-community.github.io/helm-charts \
  prometheus \
  prometheus
```

Install Kiali

```bash
helm install \
    --repo https://kiali.org/helm-charts \
    --set cr.create=true \
    --set cr.namespace=istio-system \
    --namespace istio-system \
    kiali-operator \
    kiali-operator
```

Install Grafana

```bash
helm install \
  --namespace grafana \
  --repo https://grafana.github.io/helm-charts \
  grafana \
  grafana
```

Get Grafana `admin` password

```bash
kubectl get secret --namespace grafana grafana -o jsonpath="{.data.admin-password}" | base64 --decode ; echo
```


## Port Forward

Kiali
```bash
kubectl port-forward svc/kiali 20001:20001 -n istio-system
```

Grafana
```bash
kubectl port-forward svc/grafana 20001:20001 -n grafana
```

## Load test

Deploy `Fortio` on `poc` namespace
```bash
kubectl apply -n poc -f fortio-deploy.yaml
```

Run test against sample application
```bash
export FORTIO_POD=$(kubectl get pods -l app=fortio -o 'jsonpath={.items[0].metadata.name}')
kubectl exec "$FORTIO_POD" -c fortio -- /usr/bin/fortio load -c 2 -qps 0 -n 20 -loglevel Warning http://productpage:9080/productpage?u=normal
```

Deploy the Busybox
```bash
kubectl run --rm -ti busybox --image=busybox
```

From inside the `busybox` pod, send requests to `myapp` service
```bash
while true; do wget -qO- http://productpage:9080/productpage?u=normal --header "test: true" > /dev/null; sleep 1; done;
```



## Reference
[Anthos Install](<https://cloud.google.com/service-mesh/docs/unified-install/install-anthos-service-mesh-command>)  
[Integrating with third-party add-ons](https://cloud.google.com/service-mesh/docs/unified-install/options/third-party-integrations)
