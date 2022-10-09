# Enforce mTLS globally
You can enforce mTLS globally, then pods without mTLS support (legacy) can't communicate with Istio services


## Connectivity beforce enforce
Test connectivity between pods of distinct namespaces before enforce TLS

```bash
for from in "giropops" "strigus" "girus"; do for to in "giropops" "strigus" "girus"; do kubectl exec "$(kubectl get pod -l app=sleep -n ${from} -o jsonpath={.items..metadata.name})" -c sleep -n ${from} -- curl "http://httpbin.${to}:8000/ip" -s -o /dev/null -w "sleep.${from} to httpbin.${to}: %{http_code}\n"; done; done
```


## Enable mutual TLS
```bash
kubectl apply -f Security/mtls-global/mtls-strict-global.yaml
```
**Test it again, now with TLS enforced**
```bash
for from in "giropops" "strigus" "girus"; do for to in "giropops" "strigus" "girus"; do kubectl exec "$(kubectl get pod -l app=sleep -n ${from} -o jsonpath={.items..metadata.name})" -c sleep -n ${from} -- curl "http://httpbin.${to}:8000/ip" -s -o /dev/null -w "sleep.${from} to httpbin.${to}: %{http_code}\n"; done; done
```


------------
## Cleaning Up
```bash
kubectl delete -f Security/mtls-global/mtls-strict-global.yaml
```