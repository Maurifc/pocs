# Readme

## TODO
- [ ] Create service account
  - [ ] profile
  - [ ] user
- [ ] Deploy Cloud run
  - [ ] profile (allow unauthenticated)
  - [ ] user (only allow from profile service account)
- [ ] Load balancer


## Drafts
```bash
gcloud run deploy profile \
    --source profile \
    --service-account profile@... \
    --env-vars-file profile/production.env
```