/*TODO FINIR LES DB*/
CREATE TABLE "user" (
    id SERIAL PRIMARY KEY auto_increment,
    firstname VARCHAR NOT NULL,
    lastname VARCHAR NOT NULL,
    birthday date,
    city VARCHAR,
    yop INT,
    mail VARCHAR NOT NULL,
    password VARCHAR NOT NULL,
    phone VARCHAR,
    current_training VARCHAR,

    CHECK (yop BETWEEN 0 AND 100)
);

INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Thomas', 'GUITTON', '1998-08-31', 'Evry', 2,'guittonthomas41@gmail.com', 'motdepasse','0606426456');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Charles', 'Anteunis', '1998-02-26', 'Evry', 3, 'charles.anteunis@gmail.com','motdepasse','','Dame du Lac');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Amelia', 'Waters', '1981-12-01','','','mail@mail.mail','motdepasse');


CREATE TABLE "spot"(
       nom VARCHAR PRIMARY KEY
       latitude VARCHAR NOT NULL,
       longitude VARCHAR NOT NULL
);

INSERT INTO "spot"(latitude, longitude) VALUES ('48.623169575973634', '2.4283207872682624');
INSERT INTO "spot"(latitude, longitude) VALUES ('47.21167517573434','-1.5615792589997');

CREATE TABLE "move"(
       nom PRIMARY KEY,
       difficulte INT,

       CHECK (difficulte BETWEEN 0 AND 5)
);

CREATE TABLE "spotXmove"(
       
);
