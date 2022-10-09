# Zone
resource "google_dns_managed_zone" "zone" {
  name        = var.zone_name
  dns_name    = var.dns_name
  description = "${var.dns_name} - DNS Zone"

}

# A
resource "google_dns_record_set" "a" {
  for_each = var.dns_a_entries

  name = "${each.key}.${google_dns_managed_zone.zone.dns_name}"
  type = "A"
  ttl  = 300

  managed_zone = google_dns_managed_zone.zone.name

  rrdatas = [each.value]
}

# CNAME
resource "google_dns_record_set" "cname" {
  for_each = var.dns_cname_entries

  name = "${each.key}.${google_dns_managed_zone.zone.dns_name}"
  type = "CNAME"
  ttl  = 300

  managed_zone = google_dns_managed_zone.zone.name

  rrdatas = ["${each.value}.${var.dns_name}"]
}

# MX
resource "google_dns_record_set" "mx" {
  name         = google_dns_managed_zone.zone.dns_name
  managed_zone = google_dns_managed_zone.zone.name
  type         = "MX"
  ttl          = 3600

  rrdatas = var.dns_mx_entries
}