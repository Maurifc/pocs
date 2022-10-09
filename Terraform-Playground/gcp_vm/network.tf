resource "google_compute_firewall" "nginx-vm-firewall" {
  name    = "nginx-vm-firewall"
  network = google_compute_network.project_vpc.name

  allow {
    protocol = "icmp"
  }

  allow {
    protocol = "tcp"
    ports    = ["80"]
  }

  target_tags = ["web"]
}

resource "google_compute_network" "project_vpc" {
  name = "${var.project_id}-vpc"
}