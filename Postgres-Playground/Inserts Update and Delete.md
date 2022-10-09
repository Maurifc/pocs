# Insert, Update and Delete


Insert a new row into a table:
```bash
INSERT INTO table(column1,column2,...)
VALUES(value_1,value_2,...);
```

Insert multiple rows into a table:
```bash
INSERT INTO table_name(column1,column2,...)
VALUES(value_1,value_2,...),
      (value_1,value_2,...),
      (value_1,value_2,...)...
```

Update data for a set of rows specified by a condition in the WHERE clause.
```bash
UPDATE table
SET column_1 = value_1,
    ...
WHERE condition;
```

Delete specific rows based on a condition:
```bash
DELETE FROM table_name
WHERE condition;
```