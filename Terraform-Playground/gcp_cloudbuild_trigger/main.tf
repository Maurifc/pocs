resource "google_cloudbuild_trigger" "build-trigger" {
  trigger_template {
    branch_name = "dev*"
    repo_name   = var.repo_name
  }

  build {
    step {
      id         = "Build"
      name       = "debian"
      entrypoint = "/bin/echo"
      args       = ["Build Stage"]
      timeout    = "120s"
    }
  }
}