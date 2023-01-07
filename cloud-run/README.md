# Readme

## Before you begin
1. Enable Cloud Run API
```bash
gcloud services enable run.googleapis.com
gcloud services enable artifactregistry.googleapis.com
gcloud services enable cloudbuild.googleapis.com
```

## Service accounts
1. Create
```bash
gcloud iam service-accounts create profile-service
gcloud iam service-accounts create user-service
```

2. List them
```bash
gcloud iam service-accounts list
```


## Deploy to Cloud Run

### Profile
Deploy `profile` service.  
- Only accepts traffic from LB and internal services
- Use the service account `profile-service@`

```bash
gcloud run deploy profile \
    --source profile/ \
    --service-account profile-service@unixlike-sat.iam.gserviceaccount.com \
    --port 3000 \
    --env-vars-file profile/production.env.yaml \
    --allow-unauthenticated \
    # --ingress internal-and-cloud-load-balancing
```

### User
Deploy `user` service.  
- Only accepts traffic internal services  
- Only authenticated services can reach its endpoints
- Use the service account `user-service@`

```bash
gcloud run deploy user \
    --source user/ \
    --service-account user-service@unixlike-sat.iam.gserviceaccount.com \
    --port 3001 
```

## Allow Profile to reach User
```bash
gcloud run services add-iam-policy-binding user \
  --region='southamerica-east1' --member='serviceAccount:profile-service@unixlike-sat.iam.gserviceaccount.com' \
  --role='roles/run.invoker'
```

## Network and LB
Follow these steps to provision a load balancer for the service
```bash
# Create a static public ip
gcloud compute addresses create myservice \
    --network-tier=PREMIUM \
    --ip-version=IPV4 \
    --global

# Create neg pointing to 'profile' on Cloud Run
gcloud compute network-endpoint-groups create service-neg \
    --region=southamerica-east1 \
    --network-endpoint-type=serverless  \
    --cloud-run-service=profile
   
# Create the backend
gcloud compute backend-services create profile-backend \
  --load-balancing-scheme=EXTERNAL_MANAGED \
  --global
  
# Link the NEG to the backend you created previously
gcloud compute backend-services add-backend profile-backend \
  --global \
  --network-endpoint-group=service-neg \
  --network-endpoint-group-region=southamerica-east1

# Create a profile URL that essentially send all request to the same backend
gcloud compute url-maps create profile-url-map \
  --default-service profile-backend

# Create a proxy to receive requests and route according to the url map
gcloud compute target-http-proxies create tp-profile \
  --url-map=profile-url-map

# Create a forwarding rule to link all pieces together: Public IP, proxy and all other resources created previously
gcloud compute forwarding-rules create fr-profile \
  --load-balancing-scheme=EXTERNAL_MANAGED \
  --network-tier=PREMIUM \
  --address=myservice \
  --target-http-proxy=tp-profile \
  --global \
  --ports=80
```

Get the IP and test the LB
```bash
gcloud compute addresses list
```

```bash
curl ...
```

## References
https://cloud.google.com/run/docs/authenticating/service-to-service
https://cloud.google.com/load-balancing/docs/https/setup-global-ext-https-serverless
