terraform {
  required_providers {
    google = {
      source  = "hashicorp/google"
      version = "3.5.0"
    }
  }
}

provider "google" {
  credentials = file(var.credentials_file)

  project = "thurproj"
  region  = var.region
  zone    = var.zone
}

# VPC
resource "google_compute_network" "vpc_network" {
  name = "terraform-network"
}

# VM
resource "google_compute_instance" "vm_instance" {
  name         = "terraform-instance"
  machine_type = "f1-micro"
  tags         = ["web", "dev"]

  boot_disk {
    initialize_params {
      image = "cos-cloud/cos-stable"
    }
  }

  network_interface {
    network = google_compute_network.vpc_network.name # VPC Binding
    access_config {                                   # Creates an external IP address
    }
  }
}

