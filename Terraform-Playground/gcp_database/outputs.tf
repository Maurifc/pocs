# Connection String
output "connection_string" {
  value = google_sql_database_instance.db-instance.connection_name
}

# Instance Private IP
output "db_instance_private_ip" {
  value = google_sql_database_instance.db-instance.private_ip_address
}

# Instance Public IP
output "db_instance_public_ip" {
  value = google_sql_database_instance.db-instance.public_ip_address
}

# DBA User & Password
output "dba_user" {
  value = var.dba_user
}
output "dba_password" {
  value     = random_password.password.result
  sensitive = true
}