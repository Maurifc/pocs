# Save Terraform State on a GCS Bucket
terraform {
backend "gcs" {
  bucket = "thurproj-tf-state-prod"     # GCS bucket name to store terraform tfstate
  prefix = "myapp"                      # Folder, on bucket, where it will be stored. Must be unique within the same bucket.
  }
}