## GCP MySQL Database (aka Cloud SQL)
Creates a MySQL database instance + DBA user on GCP

Run the following command to print DBA Password (jq required)
```
terraform show -json | jq '{DBA_PASSWORD: .values.outputs.dba_password.value}'
```