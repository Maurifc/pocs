# Postgres Playground

## Running pgsql server

Start single docker container
```bash
$ docker container run --rm -d --name pgsql -e POSTGRES_PASSWORD=pass -p 5432:5432 postgres:alpine

CONTAINER ID   IMAGE             COMMAND                  CREATED         STATUS         PORTS                                       NAMES
c3bddf6c5b5b   postgres:alpine   "docker-entrypoint.s…"   3 seconds ago   Up 2 seconds   0.0.0.0:5432->5432/tcp, :::5432->5432/tcp   pgsql
```


Login with postgres client (password = **pass**)
```bash
psql -h localhost -U postgres
```

Login without postgres user
```bash
docker container exec -ti pgsql psql -U postgres
```

## Basics

List databases
```bash
\l
```

Connect do specific database
```bash
\c DATABASE_NAME;
```

List tables on current database
```bash
\dt+
```
Get fields' datailed info 
```bash
\d+ TABLE_NAME
```



## References:
<https://www.postgresqltutorial.com/postgresql-cheat-sheet/>
<https://postgrescheatsheet.com/#/users>
<https://www.postgresqltutorial.com/postgresql-sample-database/>