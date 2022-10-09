# Apply mTLS to labels
You can leave mTLS optional but enforce it to a specific label (group of pods)


## Enforce mTLS
Apply this manifest witch enforces mTLS for `nginx` on `giropops` namespace 
```bash
kubectl apply -f Security/mtls-label/mtls-strict-nginx.yaml
```

## Connectivity after enforce mTLS
From now, only mTLS communication is allowed to `nginx` on `giropops` namespace.
```bash
$ for from in "giropops" "strigus" "girus"; do for to in "giropops"; do kubectl exec "$(kubectl get pod -l app=sleep -n ${from} -o jsonpath={.items..metadata.name})" -c sleep -n ${from} -- curl "http://nginx.${to}:8080" -s -o /dev/null -w "sleep.${from} to nginx.${to}: %{http_code}\n"; done; done


sleep.giropops to nginx.giropops: 200
sleep.strigus to nginx.giropops: 200
sleep.girus to nginx.giropops: 000 # 'girus' namespace can't handle mTLS
command terminated with exit code 56 
```

You continue to reach `other services` (httpbin) on `giropops` namespace **without any restriction**
```bash
$ for from in "giropops" "strigus" "girus"; do for to in "giropops" "strigus" "girus"; do kubectl exec "$(kubectl get pod -l app=sleep -n ${from} -o jsonpath={.items..metadata.name})" -c sleep -n ${from} -- curl "http://httpbin.${to}:8000/ip" -s -o /dev/null -w "sleep.${from} to httpbin.${to}: %{http_code}\n"; done; done

sleep.giropops to httpbin.giropops: 200
sleep.giropops to httpbin.strigus: 200
sleep.giropops to httpbin.girus: 200
sleep.strigus to httpbin.giropops: 200
sleep.strigus to httpbin.strigus: 200
sleep.strigus to httpbin.girus: 200
sleep.girus to httpbin.giropops: 200
sleep.girus to httpbin.strigus: 200
sleep.girus to httpbin.girus: 200
```


------------
## Cleaning Up
```bash
kubectl apply -f Security/mtls-label/mtls-strict-nginx.yaml
```