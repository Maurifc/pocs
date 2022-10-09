# Allow SSH
resource "google_compute_firewall" "ssh_to_public_subnets" {
  name        = "allow-ssh-to-public-subnets"
  description = "Allow SSH to public subnets"

  network = google_compute_network.vpc.name

  allow {
    protocol = "tcp"
    ports    = ["22"]
  }

  source_ranges = ["0.0.0.0/0"]

  target_tags = ["sn-a", "sn-c"]
}

# Allow SSH from bastion to subnet b
resource "google_compute_firewall" "ssh_from_bastion" {
  name        = "allow-ssh-from-bastion"
  description = "Allow SSH from bastion to subnet b"

  network = google_compute_network.vpc.name

  allow {
    protocol = "tcp"
    ports    = ["22"]
  }

  source_tags = ["bastion-sn-b"]

  target_tags = ["sn-b"]
}