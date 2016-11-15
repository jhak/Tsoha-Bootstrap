
CREATE TABLE Usraccount(
	usr_id SERIAL PRIMARY KEY,
	usr_name varchar(50) NOT NULL,
	usr_password varchar(50) NOT NULL,
	isadm boolean DEFAULT false
);

CREATE TABLE Drink(
	drink_id SERIAL PRIMARY KEY,
	usr_id integer REFERENCES Usraccount(usr_id),
	name varchar(50) NOT NULL,
	created DATE,	
	approved boolean DEFAULT false
);
CREATE TYPE amount_type AS ENUM ('kpl', 'cl', 'dl', 'tl', 'rl','ml');
CREATE TABLE Ingredient(
	ingrd_id SERIAL PRIMARY KEY,
	drink_id integer REFERENCES Drink(drink_id),
	ingrd_name varchar(50) NOT NULL,
	amount integer DEFAULT 1,
	amount_type amount_type
);

CREATE TABLE Preparation(
  prep_id SERIAL PRIMARY KEY,
  drink_id integer REFERENCES Drink(drink_id),
  prep_text varchar(200)
);

CREATE TABLE Followed(
	follower_id integer REFERENCES Usraccount(usr_id),
	followed_id integer REFERENCES Usraccount(usr_id)
);



