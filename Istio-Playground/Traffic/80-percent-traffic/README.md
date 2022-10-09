# 80% Traffic
This example demonstrates how split traffic between different versions (deployments) of same application


## Setup Traffic Routing

Create traffic routing to split traffic between `Red` and `Green` app.

- 80% of traffic goes to `v1` (label version=red)  
- 20% of traffic goes to `v2` (label version=green)  

```bash
kubectl apply -f Traffic/80-percent-traffic/virtualservice.yaml
kubectl apply -f Traffic/80-percent-traffic/destination-rule.yaml
```


## Test from inside the mesh

Create a pod `inside the same namespace` where `myapp` is deployed to send request to it
```bash
kubectl run --rm -ti busybox --image=busybox
```

From inside the `busybox` pod, send requests to `myapp` service
```bash
while true; do wget -qO- myapp:8080 | grep -E -o "Red|Green|Blue"; sleep 1; done;
```

In another terminal, change the `route weight` at `myapp` virtualservice
```bash
kubectl edit virtualservice myapp
```

Now, come back to the `busybox` terminal and realize how the the traffic has changed...


## Kiali

`Open Kiali` dashboard
```bash
istioctl dashboard kiali
```

Go to `Graph` while the `wget still runs` and see how traffic goes

## Clean Up
Remove virtual service and destination rules
```bash
kubectl delete -f Traffic/80-percent-traffic/virtualservice.yaml
kubectl delete -f Traffic/80-percent-traffic/destination-rule.yaml
```

