# Authorization

## Enforce mTLS globally

First of all, enforce mTLS globally using the `PeerAuthentication` CRD
```bash
kubectl apply -f Security/authorization/mtls-strict-global.yaml
```
## Deploy Bookinfo App
Deploy Bookinfo application as described on /README.md

## Deploy an Allow Nothing Policy

This rule denies every request to pods on `default` namespace. Even inter pod communications.
Allow rules should be explicit from now

```bash
kubectl apply -f Security/authorization/policy-allow-nothing.yaml
```

From this point, you should receive an error when try to access `/productpage`
```bash
RBAC: access denied
```

## Allow GET: All -> Product Page

This policies allow all workloads and namespace issue a `GET` method to `productpage`.
After apply this rule, you can try to visit `/productpage` again.
```bash
kubectl apply -f Security/authorization/policy-product-page-viewer.yaml
```

## Allow GET: Product Page -> Details

This policies allows `productpage` issue `GET` requests to `details`
```bash
kubectl apply -f Security/authorization/policy-details-viewer.yaml
```

## Allow GET: Product Page -> Reviews

This policies allows `productpage` issue `GET` requests to `reviews`
```bash
kubectl apply -f Security/authorization/policy-reviews-viewer.yaml
```

## Allow GET: Reviews -> Ratings

This policies allows `reviews` issue `GET` requests to `ratings`
```bash
kubectl apply -f Security/authorization/policy-ratings-viewer.yaml
```


------------
## Cleaning Up
```bash
kubectl delete -f Security/authorization
```