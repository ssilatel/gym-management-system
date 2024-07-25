/* Database creation script */

PRAGMA foreign_keys = ON;

DROP TABLE IF EXISTS employee;

CREATE TABLE employee(
	id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
	username VARCHAR NOT NULL UNIQUE,
	password VARCHAR NOT NULL,
	created_at VARCHAR NOT NULL,
	is_admin BOOLEAN NOT NULL
);

DROP TABLE IF EXISTS member;

CREATE TABLE member (
	id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
	first_name VARCHAR NOT NULL,
	last_name VARCHAR NOT NULL,
	birthday VARCHAR NOT NULL,
	created_at VARCHAR NOT NULL
);

INSERT INTO member(first_name, last_name, birthday, created_at) VALUES(
	"John",
	"Smith",
	date("now", "-2 months", "-30 years"),
	datetime("now", "-3 months", "-45 minutes", "+10 seconds")
);

INSERT INTO member(first_name, last_name, birthday, created_at) VALUES(
	"Alessia",
	"White",
	date("now", "-6 months", "-25 years"),
	datetime("now", "-5 months", "-35 minutes")
);
