# Postgres Sample Database

Sample database to study and practice


## Usage
Create a database called dvdrental
```bash
CREATE DATABASE [IF NOT EXISTS] dvdrental;
```

Restore from .tar file
```bash
pg_restore -U postgres -d dvdrental dvdrental.tar
```

## Diagram
![Sample Database Diagram](sample_database_diagram.png)

## Sample Database from Posgresql Tutorial
<https://www.postgresqltutorial.com/postgresql-sample-database/>