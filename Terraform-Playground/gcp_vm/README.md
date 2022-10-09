## GCP Compute Instance
Creates a VM and a basic network

### GCS Backend
This Terraform Project save the tfstate file on a bucket, thus you must:
- Create a bucket
- Set the bucket name and prefix on backend.tf file
- Authenticate on GCP to allow access to bucket
```
gcloud auth application-default login 
```
