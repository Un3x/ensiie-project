DROP TABLE IF EXISTS "user";

CREATE TABLE "user" (
    idUser SERIAL PRIMARY KEY,
    pseudo VARCHAR NOT NULL,
    firstname VARCHAR NOT NULL ,
    lastname VARCHAR NOT NULL ,
    birthday date,
    mdp VARCHAR NOT NULL
);

DROP TABLE IF EXISTS "logement";

CREATE TABLE "logement" (
idLogement SERIAL PRIMARY KEY,
idUser INT,
departement INT,
ville VARCHAR NOT NULL,
nb_places_libres INT,
prix INT,
CONSTRAINT fk_user
	   FOREIGN KEY (idUser)
	   REFERENCES user(idUser)
);

DROP TABLE IF EXISTS "favoris";

CREATE TABLE "favoris" (
idUser INT,
idLogement INT,
CONSTRAINT fk_user2
	   FOREIGN KEY (idUser)
	   REFERENCES user(idUser),
CONSTRAINT fk_logement
	   FOREIGN KEY (idLogement)
	   REFERENCES logement(idLogement),
PRIMARY KEY (idUser,idLogement)
);


      

INSERT INTO "user"(pseudo, firstname, lastname, birthday, mdp) VALUES ('jd','John', 'Doe', '1967-11-22','john');
INSERT INTO "user"(pseudo, firstname, lastname, birthday, mdp) VALUES ('ya','Yvette', 'Angel', '1932-01-24','yvette');
INSERT INTO "user"(pseudo, firstname, lastname, birthday, mdp) VALUES ('Amelia', 'Waters', '1981-12-01','amelia');


INSERT INTO "logement"(idUser, departement, ville, nb_places_libres, prix) VALUES (1, 91 , 'Evry', 2, 400);
INSERT INTO "logement"(idUser, departement, ville, nb_places_libres, prix) VALUES (2, 91 , 'Evry', 1, 500);
INSERT INTO "logement"(idUser, departement, ville, nb_places_libres, prix) VALUES (3, 13 , 'Marseille', 2, 400);

INSERT INTO "favoris"(idUser, idLogement) VALUES (1,2);
