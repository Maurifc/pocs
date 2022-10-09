variable "region" {
  default = "us-east1"
}

variable "zone" {
  default = "us-east1-d"
}

variable "project_id" {
}

variable "subnets" {
  default = {
    "sna" = "10.0.0.0"
    "snb" = "10.0.2.0"
    "snc" = "10.0.4.0"
  }
}