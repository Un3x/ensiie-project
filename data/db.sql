DROP TABLE IF EXISTS "user" CASCADE;

CREATE TABLE "user" (
    iduser SERIAL PRIMARY KEY,
    /*mail VARCHAR NOT NULL,*/
    pseudo VARCHAR NOT NULL,
    firstname VARCHAR NOT NULL ,
    lastname VARCHAR NOT NULL ,
    birthday date,
    mdp VARCHAR NOT NULL
);

DROP TABLE IF EXISTS "logement" CASCADE;

CREATE TABLE "logement" (
idLogement SERIAL PRIMARY KEY,
iduser INT,
departement INT,
ville VARCHAR NOT NULL,
nb_places_libres INT,
prix INT,
CONSTRAINT fk_user
	   FOREIGN KEY (iduser)
	   REFERENCES "user" (iduser)
);

DROP TABLE IF EXISTS "favoris" CASCADE;

CREATE TABLE "favoris" (
idUser INT,
idLogement INT,
CONSTRAINT fk_user2
	   FOREIGN KEY (iduser)
	   REFERENCES "user" (iduser),
CONSTRAINT fk_logement
	   FOREIGN KEY (idLogement)
	   REFERENCES "logement" (idLogement),
PRIMARY KEY (iduser,idLogement)
);


      

INSERT INTO "user"(/*mail*/pseudo, firstname, lastname, birthday, mdp) VALUES (/*ad1@gmail.com*/'jd','John', 'Doe', '1967-11-22','john');
INSERT INTO "user"(pseudo, firstname, lastname, birthday, mdp) VALUES ('ya','Yvette', 'Angel', '1932-01-24','yvette');
INSERT INTO "user"(pseudo, firstname, lastname, birthday, mdp) VALUES ('aw', 'Amelia', 'Waters', '1981-12-01','amelia');
INSERT INTO "user"(pseudo, firstname, lastname,birthday, mdp) VALUES ('mp', 'Mathieu', 'Pavard','1932-01-24', 'mathieu');
INSERT INTO "user"(pseudo, firstname, lastname,birthday, mdp) VALUES ('al', 'Antoine', 'Leefsma','1932-01-24', 'antoine');


INSERT INTO "logement"(idUser, departement, ville, nb_places_libres, prix) VALUES (1, 91 , 'Evry', 1, 500);
INSERT INTO "logement"(idUser, departement, ville, nb_places_libres, prix) VALUES (3, 91 , 'Evry', 5, 500);
INSERT INTO "logement"(idUser, departement, ville, nb_places_libres, prix) VALUES (4, 91 , 'Evry', 2, 500);
INSERT INTO "logement"(idUser, departement, ville, nb_places_libres, prix) VALUES (2, 91 , 'Evry', 1, 500);
INSERT INTO "logement"(idUser, departement, ville, nb_places_libres, prix) VALUES (1, 91 , 'Evry', 1, 500);
INSERT INTO "logement"(idUser, departement, ville, nb_places_libres, prix) VALUES (5, 91 , 'Evry', 10, 300);
INSERT INTO "logement"(idUser, departement, ville, nb_places_libres, prix) VALUES (4, 91 , 'Evry', 3, 300);
INSERT INTO "logement"(idUser, departement, ville, nb_places_libres, prix) VALUES (2, 13 , 'Marseille', 2, 400);

INSERT INTO "favoris"(iduser, idLogement) VALUES (1,1);