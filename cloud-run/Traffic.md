```bash
gcloud run deploy hello \
    --image gcr.io/cloudrun/hello \
    --service-account user-service@unixlike-sat.iam.gserviceaccount.com \
    --allow-unauthenticated \
    --region southamerica-east1 \
    --tag prod \
    --port 3001 
```

Deploy a new version, with no traffic
```bash
gcloud run deploy hello \
    --image gcr.io/cloudrun/hello \
    --service-account user-service@unixlike-sat.iam.gserviceaccount.com \
    --allow-unauthenticated \
    --region southamerica-east1 \
    --tag canary \
    --no-traffic \
    --port 3001 
```


Sed 50% of traffic to canary and 50% to prod
```bash
gcloud run services update-traffic user --to-tags prod=50,canary=50
```

Change tags of revision
```bash
gcloud run services update-traffic user --update-tags canary=LATEST,prod=user-00004-dex
```