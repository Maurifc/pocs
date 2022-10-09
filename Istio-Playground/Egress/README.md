
## Setup

1. Deploy `sleep` (to run curl commands)
```bash
kubectl apply -f /opt/istio-1.14.0/samples/sleep/sleep.yaml
```

2. Check current configuration (default is `ALLOW_ANY`)  
```bash
kubectl get istiooperator installed-state -n istio-system -o jsonpath='{.spec.meshConfig.outboundTrafficPolicy.mode}'
```

**Notice**  
If nothing appears when you run the command above, reinstall Istio with
```bash
istioctl install --set meshConfig.outboundTrafficPolicy.mode=ALLOW_ANY
```

## Deny all egress traffic
1. Check connectivity for external services
```bash
kubectl exec -ti sleep-698cfc4445-jl7ms -- curl -I httpbin.org | grep HTTP/

HTTP/1.1 200 OK
```

2. Now block every traffic leaving the mesh
```bash
istioctl install --set meshConfig.outboundTrafficPolicy.mode=REGISTRY_ONLY

```

3. Check connectivity again
```bash
kubectl exec -ti sleep-698cfc4445-jl7ms -- curl -I httpbin.org | grep HTTP/

HTTP/1.1 502 Bad Gateway
```

## Allow egress to some destinations
1. Add `httpbin.org` as `ServiceEntry` to allow egress traffic to it
```bash
kubectl apply -f Egress/service-entry-httpbin.yaml
```

2. Test connection again
```bash
kubectl exec -ti sleep-698cfc4445-jl7ms -- curl -I httpbin.org | grep HTTP/

HTTP/1.1 200 OK
```

## Set a timeout
1. Create a `service entry` due to manage the external destination through Istio
```bash
kubectl apply -f Egress/service-entry-httpbin.yaml
```

2. Create a `virtual service` with a 2s timeout when host is 'httpbin.org'
```bash
kubectl apply -f Egress/virtual-service-httpbin.yaml
```

## Test
1. Make a request with a 1 second delay
```bash
```bash
kubectl exec -ti sleep-698cfc4445-jl7ms -- curl -I httpbin.org/delay/1 | grep HTTP/

HTTP/1.1 200 OK
```

1. Make a request with a 3 seconds delay
```bash
kubectl exec -ti sleep-698cfc4445-jl7ms -- curl -I httpbin.org/delay/3 | grep HTTP/

HTTP/1.1 504 Gateway Timeout
```

------------
## Cleaning Up
```bash
istioctl install --set meshConfig.outboundTrafficPolicy.mode=ALLOW_ANY
kubectl delete -f /opt/istio-1.14.0/samples/sleep/sleep.yaml
kubectl delete -f Egress
```