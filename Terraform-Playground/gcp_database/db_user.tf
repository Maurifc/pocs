# DBA user
resource "google_sql_user" "users" {
  name     = var.dba_user
  instance = google_sql_database_instance.db-instance.name
  host     = "%"
  password = random_password.password.result
}

# Random password generator
resource "random_password" "password" {
  length           = 32
  special          = true
  override_special = "_%@"
}