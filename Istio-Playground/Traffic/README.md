# Traffic
Before procceding with "Traffic Shiffiting" session, follow the instructions below


## Install Requirements

Kiali
```bash
kubectl apply -f https://raw.githubusercontent.com/istio/istio/release-1.14/samples/addons/kiali.yaml
```

Prometheus
```bash
kubectl apply -f https://raw.githubusercontent.com/istio/istio/release-1.14/samples/addons/prometheus.yaml
```

Wait until Kiali and Prometheus pods to be ready
```bash
$ kubectl get pods -n istio-system

NAME                                    READY   STATUS              RESTARTS   AGE
istio-egressgateway-869744fbfb-mnj2b    1/1     Running             0          55m
istio-ingressgateway-6f78479f54-m2kwf   1/1     Running             0          55m
istiod-65fcd8b554-twkxf                 1/1     Running             0          61m
kiali-6b455fd9f9-dgsq4                  0/1     ContainerCreating   0          14s
prometheus-7cc96d969f-rnrlc             0/2     ContainerCreating   0          6s
```

## Deploy Sample apps

Three images were used 

- maurifc/sample-app:red
- maurifc/sample-app:green
- maurifc/sample-app:blue

Create three deployements, `red`, `green` and `blue`.
```bash
kubectl apply -f Traffic/app.yaml
```

Wait until `myapp` pods are up and running
```bash
kubectl get pods -l app=myapp
```

Now you're ready to test the `traffic management` using Istio

## Clean Up
If you want to `remove` the Sample App, just run the command below:
```bash
kubectl delete -f Traffic/app.yaml
```