# Querying data

Query all data from a table
```bash
SELECT * FROM table_name;
```

Query data from specified columns of all rows in a table
```bash
SELECT column_list
FROM table;
```

Query data and select only unique rows
```bash
SELECT DISTINCT ON (column) column
FROM table;
```

Query data from a table with a filter
```bash
SELECT *
FROM table
WHERE condition;
```

Assign an alias to a column in the result set
```bash
SELECT column_1 AS new_column_1, ...
FROM table;
```

Query data using the LIKE operator
```bash
SELECT * FROM table_name
WHERE column LIKE '%value%'
```

Query data using the BETWEEN operator
```bash
SELECT * FROM table_name
WHERE column BETWEEN low AND high;
```

Sort rows in ascending or descending order
```bash
SELECT select_list
FROM table
ORDER BY column ASC [DESC], column2 ASC [DESC],...;
```

Group rows using GROUP BY clause.
```bash
SELECT DISTINCT ON (column)
    column_1, SUM(column_2)
    FROM table GROUP BY column_1
```