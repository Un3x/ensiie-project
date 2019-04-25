--- `make db.install` to update the database

--- drop if exists
DROP TABLE IF EXISTS "current";
DROP TABLE IF EXISTS "completed";
DROP TABLE IF EXISTS "story_node";
DROP TABLE IF EXISTS "link_achievement_user";
DROP TABLE IF EXISTS "achievements";
DROP TABLE IF EXISTS "user";

DROP TYPE IF EXISTS REQUIREMENT;

DROP TABLE IF EXISTS "choice";

--- user, the person that will connect
CREATE TABLE "user" (
  pseudo VARCHAR NOT NULL PRIMARY KEY,
  hash VARCHAR NOT NULL,
  gender VARCHAR NOT NULL
);

-- types for a story node
CREATE TYPE REQUIREMENT AS (
  minimum INT,
  maximum INT
);

--- next SERIAL is the primary key of a "story_node",
--- but we drop security here because of circular dependency
CREATE TABLE "choice" (
  id SERIAL,
  content VARCHAR,
  next SERIAL
  PRIMARY KEY (id, next)
);

-- the story node
CREATE TABLE "story_node" (
  id SERIAL PRIMARY KEY,
  -- requirements
  require_alcohol REQUIREMENT,
  require_attendance REQUIREMENT,
  require_ghost REQUIREMENT,
  is_bar REQUIREMENT,
  is_baka REQUIREMENT,
  is_diese REQUIREMENT,
  likeness_bar REQUIREMENT,
  likeness_baka REQUIREMENT,
  likeness_diese REQUIREMENT,
  -- modifications
  modif_alcohol INT,
  modif_attendance INT,
  modif_ghost INT,
  modif_bar INT,
  modif_baka INT,
  modif_diese INT,
  -- 0: stay the same, < 0: quit, > 0: join
  join_bar INT,
  join_baka INT,
  join_diese INT,
  -- achievement
  ach_id SERIAL REFERENCES "achievements"(id),
  -- the content of the story
  content VARCHAR NOT NULL,
  bg_picture VARCHAR NOT NULL,
  fg_picture VARCHAR,
  -- the choices for the next step,
  -- everything at NULL for an end
  choice_1 SERIAL REFERENCES "choice"(id),
  choice_2 SERIAL REFERENCES "choice"(id),
  choice_3 SERIAL REFERENCES "choice"(id)
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
  PRIMARY KEY (pseudo, achievement)
);

--- finished stories by a user
CREATE TABLE "completed" (
  -- the pseudo of the person that completed a story
  pseudo VARCHAR NOT NULL REFERENCES "user"(pseudo),
  -- the end reached in the story, a final step
  end_id SERIAL REFERENCES "story_node"(id),
  -- stats
  ghost INT NOT NULL,
  alcohol INT NOT NULL,
  attendance INT NOT NULL,
  bar INT NOT NULL,
  baka INT NOT NULL,
  diese INT NOT NULL,
  is_bar BOOLEAN NOT NULL,
  is_baka BOOLEAN NOT NULL,
  is_diese BOOLEAN NOT NULL,
  -- the date
  date_end DATE NOT NULL,
  PRIMARY KEY (pseudo, end_id, ghost, alcohol, attendance, bar, baka, diese, is_bar, is_baka, is_diese)
);

--- state of a party
CREATE TABLE "current" (
  pseudo VARCHAR NOT NULL REFERENCES "user"(pseudo),
  -- step in the story
  step SERIAL REFERENCES "story_node"(id),
  date_current DATE NOT NULL,
  -- stats
  ghost INT NOT NULL,
  alcohol INT NOT NULL,
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
INSERT INTO "user"(pseudo, hash, gender) VALUES
('Polio', 'x', 'm'),
('Sun', 'x', 'Hélicoptère Apache'),
('Kat', 'x', 'f'),
('Kubat', 'x', 'm'),
('Bob', 'x', 'Hélicoptère Apache');
