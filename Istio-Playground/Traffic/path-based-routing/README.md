# Path based routing
This example demonstrate how split traffic between different versions of same application using paths


## Setup Traffic Routing

Create traffic routing to redirect all traffic to `v1` based on the `path`

```bash
kubectl apply -f Traffic/path-based-routing/virtualservice.yaml
kubectl apply -f Traffic/path-based-routing/destination-rule.yaml
```


## Test from inside the mesh

Create a pod `inside the same namespace` where `myapp` is deployed to send request to it
```bash
kubectl run --rm -ti busybox --image=busybox
```

From inside the `busybox` pod, send requests to `myapp` service (/ path). You will be redirected to `v1` (red)
```bash
while true; do wget -qO- myapp:8080 | grep -E -o "Red|Green|Blue"; sleep 1; done;
```

Now add the path `/green` to your request and you will get `v2` (green)
```bash
while true; do wget -qO- myapp:8080/green | grep -E -o "Red|Green|Blue"; sleep 1; done;
```

Now add the path `/blue` to your request and you will get `v3` (blue)
```bash
while true; do wget -qO- myapp:8080/blue | grep -E -o "Red|Green|Blue"; sleep 1; done;
```


## Clean Up
Remove virtual service and destination rules
```bash
kubectl delete -f Traffic/path-based-routing/virtualservice.yaml
kubectl delete -f Traffic/path-based-routing/destinationrule.yaml
```

