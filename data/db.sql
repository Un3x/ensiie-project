--- "make db.install" to update the database

DROP TABLE IF EXISTS "user_bis";
DROP TABLE IF EXISTS "story_node";
DROP TABLE IF EXISTS "requirement";
DROP TABLE IF EXISTS "link_achievement_user";
DROP TABLE IF EXISTS "current_story";
DROP TABLE IF EXISTS "completed";
DROP TABLE IF EXISTS "choice";
DROP TABLE IF EXISTS "achievements";
DROP TABLE IF EXISTS "ends";

DROP TYPE IF EXISTS req_type;

CREATE TYPE req_type AS ENUM('alcohol','ghost','attendance','bar','baka','diese','is_bar','is_baka','is_diese');

CREATE TABLE "ends" (
  "end_id" int NOT NULL,
  "end_node" int NOT NULL,
  "title" varchar NOT NULL,
  "full_text" varchar NOT NULL,
  "short_text" varchar NOT NULL,
  PRIMARY KEY("end_id")
);

CREATE TABLE "achievements" (
  "id" int NOT NULL,
  "title" varchar NOT NULL,
  "text" varchar NOT NULL,
  "icon" varchar DEFAULT NULL,
  PRIMARY KEY ("id")
);

CREATE TABLE "choice" (
  "id" int NOT NULL,
  "content" varchar DEFAULT NULL,
  "next_node" serial NOT NULL,
  PRIMARY KEY("id","next_node")
);

CREATE TABLE "completed" (
  "pseudo" varchar NOT NULL,
  "end_id" serial NOT NULL,
  "ghost" int NOT NULL,
  "alcohol" int NOT NULL,
  "attendance" int NOT NULL,
  "bar" int NOT NULL,
  "baka" int NOT NULL,
  "diese" int NOT NULL,
  "is_bar" int NOT NULL,
  "is_baka" int NOT NULL,
  "is_diese" int NOT NULL,
  "date_end" date NOT NULL,
  PRIMARY KEY ("pseudo","end_id","ghost","alcohol","attendance","bar","baka","diese","is_bar","is_baka","is_diese")
);

CREATE TABLE "current_story" (
  "pseudo" varchar(300) NOT NULL,
  "step" int NOT NULL,
  "date_current" date NOT NULL,
  "ghost" int NOT NULL,
  "alcohol" int NOT NULL,
  "attendance" int NOT NULL,
  "bar" int NOT NULL,
  "baka" int NOT NULL,
  "diese" int NOT NULL,
  "is_bar" int NOT NULL,
  "is_baka" int NOT NULL,
  "is_diese" int NOT NULL,
  PRIMARY KEY ("pseudo")
);

CREATE TABLE "link_achievement_user" (
  "pseudo" varchar NOT NULL,
  "achievement" int NOT NULL,
  "date_acquired" date NOT NULL,
  PRIMARY KEY ("pseudo","achievement")
);

CREATE TABLE "requirement" (
  "node_id" int NOT NULL,
  "variable" req_type NOT NULL,
  "min" int DEFAULT NULL,
  "max" int DEFAULT NULL,
  PRIMARY KEY ("node_id","variable")
);

CREATE TABLE "story_node" (
  "id" serial NOT NULL,
  "modif_alcohol" int DEFAULT NULL,
  "modif_attendance" int DEFAULT NULL,
  "modif_ghost" int DEFAULT NULL,
  "modif_bar" int DEFAULT NULL,
  "modif_baka" int DEFAULT NULL,
  "modif_diese" int DEFAULT NULL,
  "join_bar" int DEFAULT NULL,
  "join_baka" int DEFAULT NULL,
  "join_diese" int DEFAULT NULL,
  "ach_id" int DEFAULT NULL,
  "content" varchar NOT NULL,
  "bg_picture" varchar NOT NULL,
  "fg_picture" varchar DEFAULT NULL,
  PRIMARY KEY ("id")
);

CREATE TABLE "user_bis" (
  "pseudo" varchar NOT NULL,
  "hash_bis" varchar NOT NULL,
  "gender" varchar NOT NULL,
  PRIMARY KEY ("pseudo")
);

INSERT INTO "choice" ("id", "content", "next_node") VALUES
(1, 'Oui ! ', 2),
(1, 'Non !', 3),
(2, 'Bon ben salut alors !', 1);

INSERT INTO "current_story" ("pseudo", "step", "date_current", "ghost", "alcohol", "attendance", "bar", "baka", "diese", "is_bar", "is_baka", "is_diese") VALUES
('Kat', 2, '2019-04-28', 50, 50, 50, 60, 50, 50, 0, 0, 0),
('Polio', 1, '2019-04-28', 50, 50, 50, 50, 50, 50, 0, 0, 0);

INSERT INTO "story_node" ("id", "modif_alcohol", "modif_attendance", "modif_ghost", "modif_bar", "modif_baka", "modif_diese", "join_bar", "join_baka", "join_diese", "ach_id", "content", "bg_picture", "fg_picture") VALUES
(1, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 'Veux-tu rejoindre Le Bar (c) ?', 'facade.png', 'chara-test.png'),
(2, 0, 0, -20, 30, 0, -20, 1, 0, 0, 1, 'Bienvenue !', 'bar_encours.png', NULL);

INSERT INTO "user_bis" ("pseudo", "hash_bis", "gender") VALUES
('Bob', 'x', 'Hélicoptère Apache'),
('Kat', 'motdepasse', 'f'),
('Kubat', 'x', 'm'),
('Polio', 'x', 'm'),
('Sun', 'x', 'Hélicoptère Apache');

-- dépendances circulaires
-- ALTER TABLE "completed" ADD UNIQUE KEY "end_id" ("end_id");
-- ALTER TABLE "story_node" ADD UNIQUE KEY "id" ("id");
-- ALTER TABLE "choice" ADD UNIQUE KEY "next_node" ("next_node");
