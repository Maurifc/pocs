# End-user Authentication



## Create resources
Deploy `httpbin`
```bash
kubectl apply -f /opt/istio-1.14.0/samples/httpbin/httpbin.yaml
```

Create a `gateway` and `virtualservice` for `httpbin` service
```bash
kubectl apply -f Security/end-user-auth/httpbin-gateway.yaml
kubectl apply -f Security/end-user-auth/httpbin-virtualservice.yaml
```

Get the ingress IP and Port (External IP or use the following command):
```bash
export INGRESS_PORT=$(kubectl -n istio-system get service istio-ingressgateway -o jsonpath='{.spec.ports[?(@.name=="http2")].nodePort}')
export INGRESS_HOST=$(kubectl get po -l istio=ingressgateway -n istio-system -o jsonpath='{.items[0].status.hostIP}')
export GATEWAY_URL=$INGRESS_HOST:$INGRESS_PORT
```

## Check before enforce

This should return `200`, because no JWT authentication is enabled
```bash
curl "$INGRESS_HOST:$INGRESS_PORT/headers" -s -o /dev/null -w "%{http_code}\n"
```



## Enforce JWT auth

Enforce `JWT `authentication for httpbin
```bash
kubectl apply -f Security/end-user-auth/request-authentication.yaml
```

Test it again, without passing Token.  
This request return `200` because the token is blank and, by default, blank tokens are valid
```bash
curl "$INGRESS_HOST:$INGRESS_PORT/headers" -s -o /dev/null -w "%{http_code}\n"
```

Test it again, passing a wrong Token.  
This request return `401` because the token is invalid
```bash
curl --header "Authorization: Bearer deadbeef" "$INGRESS_HOST:$INGRESS_PORT/headers" -s -o /dev/null -w "%{http_code}\n"
```

Test it again, passing the right Token.  
This request return `200` because the token is valid
```bash
TOKEN=$(curl https://raw.githubusercontent.com/istio/istio/release-1.14/security/tools/jwt/samples/demo.jwt -s)
curl --header "Authorization: Bearer $TOKEN" "$INGRESS_HOST:$INGRESS_PORT/headers" -s -o /dev/null -w "%{http_code}\n"
```

## Reject request without token

Create a `AuthorizationPolicy` which `denies` requests from not authenticated users (nonRequestPrincipals)
```bash
kubectl apply -f Security/end-user-auth/authorization-policy-all.yaml
```

Test it again, without passing Token.  
This request return `403` because the token is blank.
```bash
curl "$INGRESS_HOST:$INGRESS_PORT/headers" -s -o /dev/null -w "%{http_code}\n"
```

## Require token per path
You can require token only for specific hosts, path or method.

Create an `AuthorizationPolicy` to requests token only for `/headers`. Other paths, like `/ip` doesn't requires auth.

First, remove the Authorization Policy created previously
```bash
kubectl delete -f Security/end-user-auth/authorization-policy-all.yaml
```

Apply the `new` AuthorizationPolicy
```bash
kubectl apply -f Security/end-user-auth/authorization-policy-headers.yaml
```

Try to make a request to `/headers` , without passing Token.  
This request return `403` because the token is blank and `/header` are protected.
```bash
curl "$INGRESS_HOST:$INGRESS_PORT/headers" -s -o /dev/null -w "%{http_code}\n"
```

Now try to make a request to `/ip` , without passing Token.  
This request return `200` `/ip` is not protected.
```bash
curl "$INGRESS_HOST:$INGRESS_PORT/headers" -s -o /dev/null -w "%{http_code}\n"
```

---------------
## Clean Up
```bash
kubectl delete -f Security/end-user-auth
```