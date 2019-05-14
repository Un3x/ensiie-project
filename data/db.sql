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
  "next_node" int NOT NULL,
  PRIMARY KEY("id","next_node")
);

CREATE TABLE "completed" (
  "pseudo" varchar NOT NULL,
  "end_id" int NOT NULL,
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
  "id" int NOT NULL,
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
(0, '', 16),
(0, '', 17),
(0, '', 18),
(1, '...', 2),
(2, '...', 3),
(3, '...', 4),
(4, '...', 5),
(5, '...', 6),
(6, '...', 7),
(7, '...', 8),
(8, 'Faire un commentaire sur ses yeux bizarres', 9),
(8, E'Dire que Dièse a l\'air d\'être une association très intéressante', 10),
(8, 'Faire un commentaire sur la météo', 11),
(9, '...', 12),
(10, '...', 14),
(11, '...', 13),
(12, '...', 15),
(13, '...', 15),
(14, '...', 15);


INSERT INTO "story_node" ("id", "modif_alcohol", "modif_attendance", "modif_ghost", "modif_bar", "modif_baka", "modif_diese", "join_bar", "join_baka", "join_diese", "ach_id", "content", "bg_picture", "fg_picture") VALUES
(1, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, E'??? : \"Bienvenue à l\'ENSIIE ! Je suis Tuto-chan, enchantée de te rencontrer.\"', 'facade.jpg', 'chara_1.png'),
(2, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, E'Tuto-chan : \"Je suis là pour te faire découvrir l\'école et son fonctionnement, suis-moi !\"', 'facade.jpg', 'chara_1.png'),
(3, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, E'Tuto-chan : \"Te voici à l\'intérieur de l\'ENSIIE. Ici évoluent dans un écosystème en équilibre précaire de nombreuses associations...\"', 'entree.jpg', 'chara-1.png'),
(4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, E'Tuto-chan : \"Le Bar (c), dirigé par Tato-chan...\"', 'entree.jpg', 'chara_3.png'),
(5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, E'Tuto-chan : \"Le Baka, dirigé par Teto-chan...\"', 'entree.jpg', 'chara_2.png'),
(6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, E'Tuto-chan : \"Et Dièse, dirigée par Tito-chan !\"', 'entree.jpg', 'chara_4.png'),
(7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, E'Tuto-chan : \"En parlant avec elles, tu peux augmenter ton affinité avec les différentes associations et éventuellement les rejoindre plus tard !\"', 'entree.jpg', 'chara_1.png'),
(8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, E'Tuto-chan : \"Essaie de dire quelque chose de gentil à Tito-chan...\"', 'entree.jpg', 'chara_4.png'),
(9, NULL, NULL, NULL, NULL, NULL, -20, NULL, NULL, NULL, NULL, E'Tito-chan ne dit rien, mais semble contrariée. Elle s\'éloigne rapidement.', 'entree.jpg', 'chara_4.png'),
(10, NULL, NULL, NULL, NULL, NULL, 20, NULL, NULL, NULL, 1, E'Tito-chan ne dit rien, mais elle a l\'air touchée par ton compliment.', 'entree.jpg', 'chara_4.png'),
(11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, E'Tito-chan ne dit rien. Tu n\'as pas l\'air de lui faire beaucoup d\'effet.', 'entree.jpg', 'chara_4.png'),
(12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, E'Tuto-chan : \"Ce n\'est pas vraiment ce que j\'avais imaginé... Je ne sais pas si Tito-chan sera ravie de t\'accueillir dans son asso maintenant...\"', 'entree.jpg', 'chara_1.png'),
(13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, E'Tuto-chan : \"C\'est... c\'est bien ! Continue comme ça, mais en un peu plus intéressant peut-être ?\"', 'entree.jpg', 'chara_1.png'),
(14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, E'Tuto-chan : \"C\'est l\'idée ! Continue comme ça !\"', 'entree.jpg', 'chara_1.png'),
(15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, E'Tu t\'approches ensuite de Teto-chan...', 'entree.jpg', 'chara_2.png');

INSERT INTO "ends" ("end_id", "end_node", "title", "full_text", "short_text") VALUES
(1, 15, 'Premières interactions', 'Tu as rencontré les soeurs Tu et espères bien rejoindre leurs associations ! Continue comme ça !', E'a commencé sa grande aventure à l\'ENSIIE !');

INSERT INTO "user_bis" ("pseudo", "hash_bis", "gender") VALUES
('Bob', 'x', 'Hélicoptère Apache'),
('Kat', 'motdepasse', 'f'),
('DonaldTrump', 'illbuildwall', 'm'),
('Kubat', 'x', 'm'),
('Polio', 'x', 'm'),
('Sun', 'x', 'Hélicoptère Apache');
