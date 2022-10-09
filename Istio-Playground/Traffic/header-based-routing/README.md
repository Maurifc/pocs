# Header based routing
This example demonstrate how split traffic between different versions of same application accordling to a request header: `version`


## Setup Traffic Routing

Create traffic routing to redict all traffic to `v1` unless you send the header `version: v2-only`

```bash
kubectl apply -f Traffic/header-based-routing/virtualservice.yaml
kubectl apply -f Traffic/header-based-routing/destination-rule.yaml
```


## Test from inside the mesh

Create a pod `inside the same namespace` where `myapp` is deployed to send request to it
```bash
kubectl run --rm -ti busybox --image=busybox
```

From inside the `busybox` pod, send requests to `myapp` service. You will be redirected only to `v1` (red)
```bash
while true; do wget -qO- myapp:8080 | grep -E -o "Red|Green|Blue"; sleep 1; done;
```

Now add the header `version: v2-only` to your request and you will get `v2` (green)
```bash
while true; do wget -qO- myapp:8080 --header "version: v2-only" | grep -E -o "Red|Green|Blue"; sleep 1; done;
```


## Clean Up
Remove virtual service and destination rules
```bash
kubectl delete -f Traffic/header-based-routing/virtualservice.yaml
kubectl delete -f Traffic/header-based-routing/destination-rule.yaml
```

