resource "google_compute_instance" "vm-a" {
  name         = "myvm-a"
  machine_type = "e2-micro"
  zone         = "us-east1-b"
  tags         = [
                  "sn-a",
                  "bastion-sn-b"
                  ]

  allow_stopping_for_update = true # Stops the instance, if needed, during update

  boot_disk {
    initialize_params {
      image = "debian-cloud/debian-11"
      size  = 20 # 20 GB
    }
  }

  network_interface {
    network    = google_compute_network.vpc.self_link
    subnetwork = google_compute_subnetwork.subnet_a.id

    // Ephemeral public IP
    access_config {
    }
  }

  service_account {
    email  = google_service_account.default.email
    scopes = ["cloud-platform"]
  }
}

# VM B
resource "google_compute_instance" "vm-b" {
  name         = "myvm-b"
  machine_type = "e2-micro"
  zone         = "us-central1-b"
  tags         = ["sn-b"]

  allow_stopping_for_update = true # Stops the instance, if needed, during update

  boot_disk {
    initialize_params {
      image = "debian-cloud/debian-11"
      size  = 20 # 20 GB
    }
  }

  network_interface {
    network    = google_compute_network.vpc.self_link
    subnetwork = google_compute_subnetwork.subnet_b.id
  }

  service_account {
    email  = google_service_account.default.email
    scopes = ["cloud-platform"]
  }
}