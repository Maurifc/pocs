# Pod Disruption Budget (PDB)

## Start minikube
```bash
minikube start --nodes 3 -p multinode-demo
```

Add more nodes if needed
```bash
minikube node add --worker=true -p multinode-demo
```

## Test without PDB
1. Create a deployment of *nginx*
    ```bash
    kubectl create -f deployment.yaml
    ```

2. Drain the node where pod is deployed:
    ```bash
    kubectl drain multinode-demo-m02 --ignore-daemonsets
    ```

Note the pod is deleted from the drained node *before it become ready* on another node. Let's solve this using PDB.


## Applying PDB
1. First, set the node as *schedulable* again
   ```bash
   kubectl uncordon --selector='!node-role.kubernetes.io/master'
   ```

2. Apply the *Pod Disruption Budget* manifest to force at least one *nginx* replica available during drain
   ```bash
   kubectl create -f pdb.yaml
   ```

3. Try to drain the node where the pod is in
    ```bash
    kubectl drain multinode-demo-m03 --ignore-daemonsets
    ```

The control plane won't drain the node because the current replica count of nginx (1) doesn't satisfy the minimum to a drain.  
If you check out *minAvailable* is set to *1* in *pdb.yaml*.

## Scale up and drain

1. Set all nodes as *schedulable* again
    ```bash
    kubectl uncordon --selector='!node-role.kubernetes.io/master'
    ```

2. Scale nginx to two replicas
    ```bash
    kubectl scale deploy nginx --replicas 2
    ```

3. Now drain the node
    ```bash
    kubectl drain multinode-demo-m03 --ignore-daemonsets
    ```

> Whenever at least 1 replica of Nginx is available, draining will go forward

## Cleaning up
1. Remove deployment
    ```bash
    kubectl delete deploy nginx
    ```

2. Remove PDB
    ```bash
    kubectl delete pdb nginx-pdb
    ```

3. Delete minikube cluster
    ```bash
    minikube delete -p multinode-demo
    ```