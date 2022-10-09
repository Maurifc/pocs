# Instance
resource "google_sql_database_instance" "db-instance" {
  name             = "db-instance"
  region           = var.region
  database_version = "MYSQL_5_7"

  settings {
    tier = "db-f1-micro"
  }

}

# Database
resource "google_sql_database" "db" {
  name     = "db"
  instance = google_sql_database_instance.db-instance.name
}