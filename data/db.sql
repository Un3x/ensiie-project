/*TODO FINIR LES DB*/

/* table utilisateur -------------------------------------------------------- */
DROP TABLE IF EXISTS "user";

CREATE TABLE "user" (
    id SERIAL NOT NULL,
    firstname VARCHAR NOT NULL,
    lastname VARCHAR NOT NULL,
    birthday date,
    city VARCHAR,
    yop INT,
    mail VARCHAR NOT NULL,
    password VARCHAR NOT NULL,
    phone VARCHAR,
    current_training VARCHAR,

    PRIMARY KEY(id),
    CHECK (yop BETWEEN 0 AND 100)
);

INSERT INTO "user"(firstname, lastname, birthday, city, yop, mail, password, phone) VALUES ('Thomas', 'GUITTON', '1998-08-31', 'Evry', 2,'guittonthomas41@gmail.com', 'motdepasse','0606426456');
INSERT INTO "user"(firstname, lastname, birthday, city, yop, mail, password, current_training) VALUES ('Charles', 'Anteunis', '1998-02-26', 'Evry', 3, 'charles.anteunis@gmail.com','motdepasse','Dame du Lac');
INSERT INTO "user"(firstname, lastname, birthday, mail, password) VALUES ('Amelia', 'Waters', '1981-12-01','mail@mail.mail','motdepasse');
INSERT INTO "user"(firstname, lastname, mail, password, birthday) VALUES ('blabla','blabla','bla@bla.bla','blabla','1998-12-01');

/* table spot --------------------------------------------------------------- */
DROP TABLE IF EXISTS "spot";

CREATE TABLE "spot"(
    id integer unsigned NOT NULL auto_increment PRIMARY KEY,
    nom VARCHAR NOT NULL,
    latitude VARCHAR NOT NULL,
    longitude VARCHAR NOT NULL,
    note INT,

    CHECK (note BETWEEN 0 AND 5)
);

INSERT INTO "spot"(nom, latitude, longitude) VALUES ('cathe','48.623169575973634', '2.4283207872682624');
INSERT INTO "spot"(nom, latitude, longitude) VALUES ('mini cathe','47.21167517573434','-1.5615792589997');

/* table move --------------------------------------------------------------- */
DROP TABLE IF EXISTS "move";

CREATE TABLE "move"(
    id integer unsigned NOT NULL auto_increment PRIMARY KEY,
    nom VARCHAR NOT NULL,
    difficulte INT NOT NULL,

    CHECK (difficulte BETWEEN 0 AND 5)
);

INSERT INTO "move"(nom, difficulte) VALUES ('salto avant','3');
INSERT INTO "move"(nom, difficulte) VALUES ('salto arriere','3');
INSERT INTO "move"(nom, difficulte) VALUES ('saut de chat','1');

/* jointure n n entre des spots et des moves -------------------------------- */
DROP TABLE IF EXISTS "spotXmove";

CREATE TABLE "spotXmove"(
    idSpot integer unsigned NOT NULL,
    idMove integer unsigned NOT NULL,

    PRIMARY KEY(idSpot, idMove),
    CONSTRAINT 'FK_spot' FOREIGN KEY (idSpot) REFERENCES 'spot' (id)
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT 'FK_move' FOREIGN KEY (idMove) REFERENCES 'move' (id)
        ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT INTO "spotXmove"(idSpot,idMove) VALUES (1,1),(1,2),(2,2);

/* jointure n n pour des utilisateurs qui follow des spots ------------------ */
DROP TABLE IF EXISTS "userXspot";

CREATE TABLE "userXspot" (

);

/* jointure n n pour les follows entre utilisateurs */
/* TODO problème d'unicité d'une clé couple ? */
DROP TABLE IF EXISTS "userXuser";

CREATE TABLE "userXuser" (

);
