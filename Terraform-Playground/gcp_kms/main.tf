# Keyring
resource "google_kms_key_ring" "test" {
  name     = "test"
  location = "global"
}

# Symmetric Key
resource "google_kms_crypto_key" "sym_key" {
  name            = "sym-key"
  key_ring        = google_kms_key_ring.test.id
  rotation_period = "100000s"

  lifecycle {
    prevent_destroy = true
  }
}

# Assymetric Key
resource "google_kms_crypto_key" "asym_key" {
  name     = "asym-key"
  key_ring = google_kms_key_ring.test.id
  purpose  = "ASYMMETRIC_DECRYPT"

  lifecycle {
    prevent_destroy = true
  }
}