/* Database creation script */

PRAGMA foreign_keys = ON;

DROP TABLE IF EXISTS user;

CREATE TABLE user (
	id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
	username VARCHAR NOT NULL,
	password VARCHAR NOT NULL,
	created_at VARCHAR NOT NULL,
	is_admin BOOLEAN NOT NULL
);
