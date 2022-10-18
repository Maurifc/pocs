# Network Policy

## Enabling on a existing cluster
1. Update existing cluster
```bash
gcloud container clusters update CLUSTER_NAME --update-addons=NetworkPolicy=ENABLED

# This will recreate node pool (it takes several minutes)
gcloud container clusters update CLUSTER_NAME --enable-network-policy
```

2. Check if enabled
```bash
gcloud container clusters describe CLUSTER_NAME \
    --format="table(addonsConfig.dnsCacheConfig.enabled:label='NodeLocalDNS',networkPolicy.provider:label='NetworkPolicy provider')"

#NodeLocalDNS  NetworkPolicy provider
#              CALICO
```

3. Create namespaces
```bash
kubectl create namespace another secure
kubectl create namespace secure
```

4. Label namespaces
```bash
kubectl label namespace another project=another
kubectl label namespace secure project=secure
```

## Deny all incoming traffic
Apply the following manifest in the namespace you want to restrict traffic.

> From now, you have to explicitly allow ingress traffic to pods in that namespace.

```bash
kubectl apply -f deny-all-ingress-traffic.yaml -n default
```

## Allow traffic

### Only from certains labels
Now, allow ingress traffic to pods where label `app=nginx`  from namespaces where label `project=another` and pod label is `app1`

```bash
kubectl apply -n allow-from-app1.yaml
```

### Allow all ingress traffic from 'secure' namespace
```bash
kubectl apply -n allow-from-secure.yaml
```

## Allowed traffic mapping

| Source Namespace Label | Source Pod Label | Dest Namespace Label | Dest Pod Label | Allowed |
| ---------------------- | ---------------- | -------------------- | -------------- | ------- |
| secure                 | *                | default              | nginx          | yes     |
| another                | app=app1         | default              | app=nginx      | yes     |
| another                | *                | default              | app=nginx      | no      |
| *                      | *                | default              | app=nginx      | no      |