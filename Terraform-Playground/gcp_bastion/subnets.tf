resource "google_compute_subnetwork" "subnet_a" {
  name          = "sn-a"
  region        = "us-east1"
  network       = google_compute_network.vpc.name
  ip_cidr_range = "10.0.0.0/24"
}

resource "google_compute_subnetwork" "subnet_b" {
  name          = "sn-b"
  region        = "us-central1"
  network       = google_compute_network.vpc.name
  ip_cidr_range = "10.0.2.0/24"
}