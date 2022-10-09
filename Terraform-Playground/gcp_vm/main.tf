resource "google_compute_instance" "nginx-vm" {
  name         = "nginx-vm"
  machine_type = "custom-1-1024"

  zone = var.zone

  allow_stopping_for_update = true # Stops the instance, if needed, during update

  tags = ["terraform", "web", "nginx"]

  boot_disk {
    initialize_params {
      image = "debian-cloud/debian-11"
      size  = 20 # 20 GB
    }
  }

  network_interface {
    network = google_compute_network.project_vpc.self_link

    access_config {
      // Ephemeral public IP
    }
  }

  metadata_startup_script = "apt-get update && apt-get -y install nginx"

  service_account {
    email  = google_service_account.default.email
    scopes = ["cloud-platform"]
  }
}