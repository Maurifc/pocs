# Enforce mTLS to namespaces
You can enforce mTLS only to a specific namespace, so `all services` deployed on it
only allow mTLS connections.


## Enforce mutual TLS only for 'giropops' namespace
```bash
kubectl apply -f Security/mtls-namespaces/mtls-strict-ns.yaml
```

## Connectivity after enforce mTLS

Only communication via mTLS are allowed to 'giropops' namespace. As 'girus' namespace can't handle mTLS, connection is refused
```bash
for from in "giropops" "strigus" "girus"; do for to in "giropops" "strigus" "girus"; do kubectl exec "$(kubectl get pod -l app=sleep -n ${from} -o jsonpath={.items..metadata.name})" -c sleep -n ${from} -- curl "http://httpbin.${to}:8000/ip" -s -o /dev/null -w "sleep.${from} to httpbin.${to}: %{http_code}\n"; done; done
```

## Allow connections to 'nginx' even without TLS

At this point, every service in 'giropops' allows only mTLS connections.  
Let's add an `exception`. If a pod has a label `app=nginx`, then `mTLS is optional`.

```bash
kubectl apply -f Security/mtls-namespaces/allow-non-tls-for-nginx.yaml
```

## Test connectivity to NGINX

Connections to `httpbin` on `giropops` are still refused if client can't handle mTLS (girus namespace)...
```bash
$ for from in "giropops" "strigus" "girus"; do for to in "giropops" "strigus" "girus"; do kubectl exec "$(kubectl get pod -l app=sleep -n ${from} -o jsonpath={.items..metadata.name})" -c sleep -n ${from} -- curl "http://httpbin.${to}:8000/ip" -s -o /dev/null -w "sleep.${from} to httpbin.${to}: %{http_code}\n"; done; done

sleep.giropops to httpbin.giropops: 200
sleep.giropops to httpbin.strigus: 200
sleep.giropops to httpbin.girus: 200
sleep.strigus to httpbin.giropops: 200
sleep.strigus to httpbin.strigus: 200
sleep.strigus to httpbin.girus: 200
sleep.girus to httpbin.giropops: 000
command terminated with exit code 56
sleep.girus to httpbin.strigus: 200
sleep.girus to httpbin.girus: 200
```

But you can reach `NGINX` on `giropops` namespace...
```bash
$ for from in "giropops" "strigus" "girus"; do for to in "giropops"; do kubectl exec "$(kubectl get pod -l app=sleep -n ${from} -o jsonpath={.items..metadata.name})" -c sleep -n ${from} -- curl "http://nginx.${to}:8080" -s -o /dev/null -w "sleep.${from} to nginx.${to}: %{http_code}\n"; done; done

sleep.giropops to nginx.giropops: 200
sleep.strigus to nginx.giropops: 200
sleep.girus to nginx.giropops: 200
```


------------
## Cleaning Up
```bash
kubectl delete -f Security/mtls-namespaces/mtls-strict-ns.yaml
kubectl delete -f Security/mtls-namespaces/allow-non-tls-for-nginx.yaml
```