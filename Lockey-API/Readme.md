# Lockey API

## Project description

API to facilitate teams to retrieve Vault secrets

Basic Features:
- User register and login
- MongoDb to persist user info
- Vault integration: List secrets and get secrets
- Basic roles: Dev and Operations
- Audit Log

**Bonus Features**
- Get Kubernetes credentials (Kubeconf)

## Vault Instructions

Export variables
```bash
export VAULT_ADDR=http://localhost:8200
export VAULT_TOKEN=root
```

Check Vault Status
```bash
vault status
```

Create some sample secrets
```bash
vault kv put /secret/myapp/conf username=admin password=awesomepass
vault kv put /secret/vms/vmprod user=sysadmin password=Awesom3P4ss
vault kv put /secret/vms/vmdev user=dev password=12345678
```

Read content of a secret
```bash
vault kv get /secret/myapp/conf
```

## Setup Postgres Secret Engine
Enable database secret engine
```bash
vault secrets enable database
```

Setup secret engine 
```bash
vault write database/config/myproject-db \
        plugin_name=postgresql-database-plugin \
        allowed_roles='*' \
        connection_url="postgresql://{{username}}:{{password}}@192.168.49.1:5432/postgres?sslmode=disable" \
        username=postgres \
        password=postgres
```

Setup postgres role
```bash
vault write database/roles/myproject-db-dev \
    db_name=myproject-db \
    creation_statements="CREATE ROLE \"{{name}}\" WITH LOGIN PASSWORD '{{password}}' VALID UNTIL '{{expiration}}' INHERIT; \
                            GRANT SELECT, INSERT, UPDATE, DELETE ON ALL TABLES IN SCHEMA public TO \"{{name}}\"; \
                            GRANT USAGE, SELECT ON ALL SEQUENCES IN SCHEMA public TO \"{{name}}\";" \
    default_ttl="1h" \
    max_ttl="24h"
```

Now you can get a postgres role/user
```bash
vault read database/creds/myproject-db-dev
```

## Docker
Build image
```bash
docker image build -t lockeyapi .
```

### References:
<https://www.vaultproject.io/docs/commands/kv>
<https://www.vaultproject.io/docs/secrets/databases/postgresql>