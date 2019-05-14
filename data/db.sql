CREATE TABLE "user" (

    id INT NOT NULL IDENTITY(1,1) PRIMARY KEY,
    is_admin INT, -- is_admin = 0 si non admin du site, 1 si admin --
    firstname VARCHAR(30) NOT NULL,
    pseudo VARCHAR(30) NOT NULL UNIQUE, 
    email VARCHAR(30) NOT NULL,
    birthday DATE,
    passwrd VARCHAR(30) NOT NULL,
    perso_description VARCHAR(300),
    nb_followers INT,
    nb_friends INT,
    picture TEXT(500)
)

CREATE TABLE "post" (

    id INT NOT NULL IDENTITY(1,1) PRIMARY KEY,
    is_ok INT, -- is_ok = 0 si non verifie ou approuve par l'admin, 1 sinon et donc il peut etre affiche --
    author VARCHAR(30),
    contenu TEXT(300),
    nb_like INT, 
    nb_dislike INT
)

CREATE TABLE "like" (

    id INT NOT NULL IDENTITY(1,1) PRIMARY KEY,
    id_post INT,
    id_author INT,
    nb_like INT,
    nb_dislike INT
)

-- AJOUT MANUEL DES ADMINS DU SITE --
INSERT INTO "user" (is_admin, firstname, pseudo, birthday, passwrd) VALUES ( 1, 'Tania', 'Tan', '1998-06-18', 'lapin');
INSERT INTO "user" (is_admin, firstname, pseudo, birthday, passwrd) VALUES ( 1, 'Théo', 'Bébou', '1998-12-06', 'lapin');
INSERT INTO "user" (is_admin, firstname, pseudo, birthday, passwrd) VALUES ( 1, 'Kelly', 'Pixie<3', '1996-06-18', 'lapin');
INSERT INTO "user" (is_admin, firstname, pseudo, birthday, passwrd) VALUES ( 1, 'Kélian', 'Styx', '1999-01-05', 'lapin');