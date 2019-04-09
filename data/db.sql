/*TODO FINIR LES DB*/
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

CREATE TABLE "spot"(
       nom VARCHAR PRIMARY KEY,
       latitude VARCHAR NOT NULL,
       longitude VARCHAR NOT NULL
);

INSERT INTO "spot"(nom, latitude, longitude) VALUES ('cathe','48.623169575973634', '2.4283207872682624');
INSERT INTO "spot"(nom, latitude, longitude) VALUES ('mini cathe','47.21167517573434','-1.5615792589997');

CREATE TABLE "move"(
       nom VARCHAR NOT NULL,
       difficulte INT,

       PRIMARY KEY (nom),
       CHECK (difficulte BETWEEN 0 AND 5)
);

CREATE TABLE "spotXmove"(
       
);
