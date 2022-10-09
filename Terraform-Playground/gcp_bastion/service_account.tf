resource "google_service_account" "default" {
  account_id   = "vms-service-account"
  display_name = "VMs Service Account"
}