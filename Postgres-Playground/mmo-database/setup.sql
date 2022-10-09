CREATE DATABASE mmo;

CREATE TABLE inventory(
    id serial NOT NULL PRIMARY KEY,
    item_name VARCHAR (50) NOT NULL,
    item_count INT NOT NULL,
    owner_id INT,
    FOREIGN KEY (owner_id)
        REFERENCES character (id)
);

CREATE TABLE character(
    id serial NOT NULL PRIMARY KEY,
    char_name VARCHAR (50) NOT NULL,
    clan_name VARCHAR (50) NOT NULL,
    exp INT NOT NULL DEFAULT 0,
    level INT NOT NULL DEFAULT 0
);

CREATE TABLE mob(
    id serial NOT NULL PRIMARY KEY,
    mob_name VARCHAR (50) NOT NULL,
    level INT NOT NULL DEFAULT 0,
    respawn_delay INTEGER NOT NULL
);