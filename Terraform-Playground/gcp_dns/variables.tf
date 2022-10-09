# Domain
variable "dns_name" {
  default     = "mydomain.io."
  description = "Domain"
}

# Zone Name
variable "zone_name" {
  default     = "mydomain-io-zone"
  description = "DNS zone name"
}

# DNS A Entries
variable "dns_a_entries" {
  description = "DNS A entries"
  default = {
    "www" = "8.8.8.8"
    "git" = "8.8.8.9"
    "git" = "8.8.8.10"
  }
}

# DNS CNAME Entries
variable "dns_cname_entries" {
  description = "DNS CNAME entries"
  default = {
    "namea" = "othera"
    "nameb" = "otherb"
    "namec" = "otherc"
  }
}

# MX Entries
variable "dns_mx_entries" {
  description = "DNS MX entries"
  default = [
    "1 aspmx.l.google.com.",
    "5 alt1.aspmx.l.google.com.",
    "5 alt2.aspmx.l.google.com.",
    "10 alt3.aspmx.l.google.com.",
    "10 alt4.aspmx.l.google.com.",
  ]
}

# Provider
variable "project_id" {
}

variable "credentials_file" {
}

variable "region" {
  default = "us-east1"
}

variable "zone" {
  default = "us-east1-d"
}