CREATE TABLE "user" (
    idUser SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    firstname VARCHAR NOT NULL ,
    lastname VARCHAR NOT NULL ,
    birthday date,
    mdp VARCHAR NOT NULL
);

CREATE TABLE "logement" (
idLogement SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
idUser SMALLINT UNSIGNED 
departement SMALLINT UNSIGNED,
ville VARCHAR NOT NULL,
nb_places_libres SMALLINT,
prix SMALLINT UNSIGNED,
CONSTRAINT fk_user
	   FOREIGN KEY (idUser)
	   REFERENCES user(idUser)
);

CREATE TABLE "favoris" (
idUser SMALLINT UNSIGNED
idLogement SMALLINT UNSIGNED
CONSTRAINT fk_user2
	   FOREIGN KEY (idUser)
	   REFERENCES user(idUser)
CONSTRAINT fk_logement
	   FOREIGN KEY (idLogement)
	   REFERENCES logement(idLogement)
PRIMARY KEY (idUser,idLogement)
);


      

INSERT INTO "user"(firstname, lastname, birthday, mdp) VALUES ('John', 'Doe', '1967-11-22','john');
INSERT INTO "user"(firstname, lastname, birthday, mdp) VALUES ('Yvette', 'Angel', '1932-01-24','yvette');
INSERT INTO "user"(firstname, lastname, birthday, mdp) VALUES ('Amelia', 'Waters', '1981-12-01','amelia');
INSERT INTO "user"(firstname, lastname, birthday, mdp) VALUES ('Manuel', 'Holloway', '1979-07-25','manuel');
INSERT INTO "user"(firstname, lastname, birthday, mdp) VALUES ('Alonzo', 'Erickson', '1947-11-13','alonzo');
INSERT INTO "user"(firstname, lastname, birthday, mdp) VALUES ('Otis', 'Roberson', '1995-01-09','otis');
INSERT INTO "user"(firstname, lastname, birthday, mdp) VALUES ('Jaime', 'King', '1924-05-30','jaime');
INSERT INTO "user"(firstname, lastname, birthday, mdp) VALUES ('Vicky', 'Pearson', '1982-12-12)','vicky');
INSERT INTO "user"(firstname, lastname, birthday, mdp) VALUES ('Silvia', 'Mcguire', '1971-03-02','silvia');
INSERT INTO "user"(firstname, lastname, birthday, mdp) VALUES ('Brendan', 'Pena', '1950-02-17','brendan');
INSERT INTO "user"(firstname, lastname, birthday, mdp) VALUES ('Jackie', 'Cohen', '1967-01-27','jackie');
INSERT INTO "user"(firstname, lastname, birthday, mdp) VALUES ('Delores', 'Williamson', '1961-07-19','delores');

INSERT INTO "logement"(idUser, departement, ville, nb_places_libres, prix) VALUES (1, 91 , 'Evry', 2, 400);
INSERT INTO "logement"(idUser, departement, ville, nb_places_libres, prix) VALUES (2, 91 , 'Evry', 1, 500);
INSERT INTO "logement"(idUser, departement, ville, nb_places_libres, prix) VALUES (4, 13 , 'Marseille', 2, 400);

