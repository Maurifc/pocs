## Install

1. Change your Kubectl context to cluster where istio will be deployed

2. Setup `istioctl`
```bash
curl -L https://istio.io/downloadIstio | sh -
sudo mv istio-* /opt
sudo ln -s /opt/istio-1.14.0/bin/istioctl /usr/bin/istioctl
```

3. Deploy istio on Kubernetes
```bash
istioctl install --set profile=demo -y
```


4. Enable istio on `default` namespace
```bash
kubectl label namespace default istio-injection=enabled
```

## Deploy sample (BookInfo)
1. Go to `samples` folder on istio install folder
```bash
cd /opt/istio-1.14.0/samples
```

2. Apply the `manifest`
```bash
kubectl apply -f bookinfo/platform/kube/bookinfo.yaml 
```

3. Check if all pods are running
```bash
kubectl get pods

NAME                              READY   STATUS    RESTARTS   AGE
details-v1-b48c969c5-xlg4k        2/2     Running   0          3m48s
productpage-v1-74fdfbd7c7-hhhjx   2/2     Running   0          2m36s
ratings-v1-b74b895c5-vp5bn        2/2     Running   0          3m12s
reviews-v1-68b4dcbdb9-czspb       2/2     Running   0          3m20s
reviews-v2-565bcd7987-txpv9       2/2     Running   0          3m20s
reviews-v3-d88774f9c-zpx7r        2/2     Running   0          3m20s
```

4. Test connectivity
```bash
kubectl exec "$(kubectl get pod -l app=ratings -o jsonpath='{.items[0].metadata.name}')" -c ratings -- curl -sS productpage:9080/productpage | grep -o "<title>.*</title>"
```

5. Create gateway
```bash
kubectl apply -f bookinfo/networking/bookinfo-gateway.yaml 
```

6. Export ports and  Build the Gateway URL
```bash
export INGRESS_PORT=$(kubectl -n istio-system get service istio-ingressgateway -o jsonpath='{.spec.ports[?(@.name=="http2")].nodePort}')
export INGRESS_HOST=$(kubectl get po -l istio=ingressgateway -n istio-system -o jsonpath='{.items[0].status.hostIP}')
export GATEWAY_URL=$INGRESS_HOST:$INGRESS_PORT
```

7. Browse the generated url 
```bash
echo $GATEWAY_URL/productpage

---
#Example
172.25.0.2:31740/productpage
```

## Addons

Install
```bash
kubectl apply -f addons/
```

Open a dashboard
```bash
istioctl dashboard kiali
```

Generate traffic
```bash
for i in $(seq 1 100); do curl -s -o /dev/null "http://$GATEWAY_URL/productpage"; done
```

------------------
## References
<https://istio.io/latest/docs/examples/bookinfo/>