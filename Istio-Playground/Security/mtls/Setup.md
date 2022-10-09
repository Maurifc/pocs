# Setup
Setup your K8s cluster before try security policies

## Create namespaces

```bash
kubectl create namespace giropops
kubectl create namespace strigus
kubectl create namespace girus
```

Label `giropops` and `strigus` namespaces
```bash
kubectl label namespace giropops istio-injection=enabled
kubectl label namespace strigus istio-injection=enabled
```

## Deploy samples

1. `httpbin` and `nginx`
```bash
kubectl apply -f /opt/istio-1.14.0/samples/httpbin/httpbin.yaml -n giropops
kubectl apply -f /opt/istio-1.14.0/samples/httpbin/httpbin.yaml -n strigus
kubectl apply -f /opt/istio-1.14.0/samples/httpbin/httpbin.yaml -n girus
kubectl apply -f /opt/istio-1.14.0/samples/httpbin/httpbin.yaml -n girus
kubectl apply -f Security/nginx.yaml -n giropops

```

2. Deploy `sleep` (to run curl commands)
```bash
kubectl apply -f /opt/istio-1.14.0/samples/sleep/sleep.yaml -n giropops
kubectl apply -f /opt/istio-1.14.0/samples/sleep/sleep.yaml -n strigus
kubectl apply -f /opt/istio-1.14.0/samples/sleep/sleep.yaml -n girus
```

3. Wait until pods are up and running
```bash
kubectl get pods -l 'app in (httpbin,nginx,sleep)' -A
```


------------
## Cleaning Up
```bash
kubectl delete namespace giropops
kubectl delete namespace strigus
kubectl delete namespace girus
```