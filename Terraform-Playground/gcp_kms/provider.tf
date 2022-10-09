terraform {
  required_providers {
    google = {
      source  = "hashicorp/google"
      version = "4.24"
    }
  }
}

provider "google" {
  project = var.project
  region  = var.region
  zone    = var.zone
}