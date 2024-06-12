DROP TABLE IF EXISTS user;

CREATE TABLE user (
	id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
	username VARCHAR NOT NULL,
	password VARCHAR NOT NULL,
	created_at VARCHAR NOT NULL,
	is_admin BOOLEAN NOT NULL
);

INSERT INTO user(username, password, created_at, is_admin) VALUES (
	"adam",
	"mada",
	date("now", "-2 months"),
	0
);

INSERT INTO user(username, password, created_at, is_admin) VALUES (
	"sarah",
	"haras",
	date("now", "-5 months"),
	0
);

INSERT INTO user(username, password, created_at, is_admin) VALUES (
	"john",
	"nhoj",
	date("now", "-3 months"),
	0
);

INSERT INTO user(username, password, created_at, is_admin) VALUES (
	"admin",
	"password",
	date("now", "-12 months"),
	1
);
