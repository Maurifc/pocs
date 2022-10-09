## Databases and tables

Create database
```bash
CREATE DATABASE [IF NOT EXISTS] DB_NAME;
```

Delete database
```bash
DROP DATABASE [IF EXISTS] DB_NAME;
```

Create a new table or a temporary table
```bash
CREATE [TEMP] TABLE [IF NOT EXISTS] table_name(
   pk SERIAL PRIMARY KEY,
   c1 type(size) NOT NULL,
   c2 type(size) NULL,
   ...
);
```

Add a new column to a table
```bash
ALTER TABLE table_name ADD COLUMN new_column_name TYPE;
```

Drop a column in a table
```bash
ALTER TABLE table_name DROP COLUMN column_name;
```

Rename a column:
```bash
ALTER TABLE table_name RENAME column_name TO new_column_name;
```

Set or remove a default value for a column:
```bash
ALTER TABLE table_name ALTER COLUMN [SET DEFAULT value | DROP DEFAULT]
```

Rename a table.
```bash
ALTER TABLE table_name RENAME TO new_table_name;
```

Drop a table and its dependent objects:
```bash
DROP TABLE [IF EXISTS] table_name CASCADE;
```