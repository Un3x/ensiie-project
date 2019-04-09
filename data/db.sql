-- INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Delores', 'Williamson', '1961-07-19');

--- `make reinstall` to update the database

--- drop if exists, comme ça pas de problèmes, pas besoin mais ça coute rien
DROP TABLE IF EXISTS "user";
DROP TABLE IF EXISTS "current";
DROP TABLE IF EXISTS "achievements";
DROP TABLE IF EXISTS "completed";
DROP TABLE IF EXISTS "link_achievement_user";

--- user, the person that will connect
CREATE TABLE "user" (
  pseudo VARCHAR NOT NULL PRIMARY KEY,
  hash VARCHAR NOT NULL,
  genre VARCHAR NOT NULL
);

--- achivements, like in games
CREATE TABLE "achievements" (
  id SERIAL PRIMARY KEY,
  title VARCHAR NOT NULL,
  text VARCHAR NOT NULL,
  icon VARCHAR
);

--- link table: user <-> achivement
CREATE TABLE "link_achievement_user" (
  -- link table, need the keys of the 2 tables we want to link
  pseudo VARCHAR REFERENCES "user"(pseudo),
  achievement SERIAL REFERENCES "achievements"(id),
  -- a date, an achievement can be completed many times, this is the date of the last completion
  date_acquired DATE NOT NULL,
  PRIMARY KEY (pseudo,achievement)
);

--- finished stories by a user
CREATE TABLE "completed" (
  -- the pseudo of the person that completed a story
  pseudo VARCHAR NOT NULL REFERENCES "user"(pseudo),
  -- $(end_id).xml to get the file (see scheme)
  end_id INT NOT NULL,
  -- stats
  ghost INT NOT NULL,
  alohol INT NOT NULL,
  attendance INT NOT NULL,
  bar INT NOT NULL,
  baka INT NOT NULL,
  diese INT NOT NULL,
  is_bar BOOLEAN NOT NULL,
  is_baka BOOLEAN NOT NULL,
  is_diese BOOLEAN NOT NULL,
  -- the date
  date_end DATE NOT NULL,
  PRIMARY KEY (pseudo, end_id, ghost, alohol, attendance, bar, baka, diese, is_bar, is_baka, is_diese)
);

--- state of a party
CREATE TABLE "current" (
  pseudo VARCHAR NOT NULL REFERENCES "user"(pseudo),
  step INT NOT NULL,
  date_current DATE NOT NULL,
  -- stats
  ghost INT NOT NULL,
  alohol INT NOT NULL,
  attendance INT NOT NULL,
  bar INT NOT NULL,
  baka INT NOT NULL,
  diese INT NOT NULL,
  is_bar BOOLEAN NOT NULL,
  is_baka BOOLEAN NOT NULL,
  is_diese BOOLEAN NOT NULL,
  -- table of steps to get to this point
  steps INT[] NOT NULL,
  -- primary key
  PRIMARY KEY (pseudo)
);

--- INSERTS
INSERT INTO "user"(pseudo, hash, genre) VALUES
('Polio', 'x', 'm'),
('Sun', 'x', 'f');

INSERT INTO "achievements"(id, title, text, icon) VALUES
(1, 'Trou noir', E'Et ça n\'est pas près de s\'arrêter !', NULL),
();
