# Creates a regional storage bucket with versioning enabled
# Archiveds objects are deleted after 365 days
resource "google_storage_bucket" "test-bucket" {
  name          = "test-bucket${var.project_id}"
  location      = "US-EAST1"
  force_destroy = true

  storage_class = "REGIONAL"

  versioning {
    enabled = true
  }

  lifecycle_rule {
    action {
      type = "Delete"
    }

    condition {
      age = 365
      with_state = "ARCHIVED"
    }
  }

}