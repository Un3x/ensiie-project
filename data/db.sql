DROP TABLE IF EXISTS Utilisateur CASCADE;
CREATE TABLE Utilisateur (
    id_Utilisateur SERIAL PRIMARY KEY ,
    firstname VARCHAR NOT NULL ,
    lastname VARCHAR NOT NULL ,
    promo INTEGER,
    birthday date,
	pseudo VARCHAR,
	mdp VARCHAR,
	id_admin INTEGER
);


DROP TABLE IF EXISTS Place CASCADE;
CREATE TABLE Place (
       id_Place SERIAL  PRIMARY KEY,
       name VARCHAR,
       adresse VARCHAR,
       capacite INTEGER
);

DROP TABLE IF EXISTS Event CASCADE;
CREATE TABLE Event (
       id_Event SERIAL PRIMARY KEY,
       name VARCHAR,
       id_Place INTEGER REFERENCES Place(id_Place),
       datee DATE,
       price FLOAT,
       nb_Participant INTEGER
);

DROP TABLE IF EXISTS Association CASCADE;
CREATE TABLE Association(
       id_Asso SERIAL PRIMARY KEY,
       name VARCHAR,
       budget INTEGER
);

DROP TABLE IF EXISTS Organisation CASCADE;
CREATE TABLE Organisation(
       id_Asso INTEGER REFERENCES Association(id_Asso),
       id_Event INTEGER REFERENCES Event(id_Event),
       PRIMARY KEY (id_Asso, id_Event)
);

DROP TABLE IF EXISTS Participation CASCADE;
CREATE TABLE Participation(
       id_Utilisateur INTEGER REFERENCES Utilisateur(id_Utilisateur),
       id_Event  INTEGER REFERENCES Event(id_Event),
       PRIMARY KEY (id_Utilisateur, id_Event)
);

INSERT INTO Utilisateur(firstname, lastname, promo, birthday, pseudo, mdp, id_admin) VALUES ('Tom', 'VERETOUT', 2021, '1998-09-11', 'TV', '$2y$10$l8RT7YE1H3J0/TouC./vHu2F7C8NSf8rrMhiXHeYbdOeM83fR8xv2', 1);
INSERT INTO Utilisateur(firstname, lastname, promo, birthday, pseudo, mdp, id_admin) VALUES ('Lucas', 'THIBORD', 2021, '1932-01-24', 'LT', '$2y$10$i7i8Z4hHkjTGJbmuVDrGPu.AxIkHBfPqsplCFBzs.VcWACC3CBxcK', 1);
INSERT INTO Utilisateur(firstname, lastname, promo, birthday, pseudo, mdp, id_admin) VALUES ('Bryan', 'LY', 2021, '1981-12-01', 'BL', '$2y$10$l8RT7YE1H3J0/TouC./vHu2F7C8NSf8rrMhiXHeYbdOeM83fR8xv2', 1);
INSERT INTO Utilisateur(firstname, lastname, promo, birthday, pseudo, mdp, id_admin) VALUES ('Alan', 'HANAFI', 2021, '1979-07-25', 'AH', '$2y$10$l8RT7YE1H3J0/TouC./vHu2F7C8NSf8rrMhiXHeYbdOeM83fR8xv2', 1);
INSERT INTO Utilisateur(firstname, lastname, promo, birthday, pseudo, mdp, id_admin) VALUES ('Alexandre', 'FERRAND', 2021, '1998-07-08', 'AF', '$2y$10$l8RT7YE1H3J0/TouC./vHu2F7C8NSf8rrMhiXHeYbdOeM83fR8xv2', 1);
INSERT INTO Utilisateur(firstname, lastname, promo, birthday, pseudo, mdp, id_admin) VALUES ('Clément', 'BERNARD', 2021, '1997-01-09', 'LONGPSEUDO', '$2y$10$l8RT7YE1H3J0/TouC./vHu2F7C8NSf8rrMhiXHeYbdOeM83fR8xv2', 0);
INSERT INTO Utilisateur(firstname, lastname, promo, birthday, pseudo, mdp, id_admin) VALUES ('Thomas', 'LEMONNIER', 2021, '1924-05-30', 'AUTRE', '$2y$10$l8RT7YE1H3J0/TouC./vHu2F7C8NSf8rrMhiXHeYbdOeM83fR8xv2', 0);
INSERT INTO Utilisateur(firstname, lastname, promo, birthday, pseudo, mdp, id_admin) VALUES ('Célia', 'BRANDA', 2021, '1982-12-12)', 'OK', '$2y$10$l8RT7YE1H3J0/TouC./vHu2F7C8NSf8rrMhiXHeYbdOeM83fR8xv2', 0);
INSERT INTO Utilisateur(firstname, lastname, promo, birthday, pseudo, mdp, id_admin) VALUES ('Nicolas', 'MAKAROFF', 2021, '1971-03-02', 'Blabla', '$2y$10$l8RT7YE1H3J0/TouC./vHu2F7C8NSf8rrMhiXHeYbdOeM83fR8xv2', 0);
INSERT INTO Utilisateur(firstname, lastname, promo, birthday, pseudo, mdp, id_admin) VALUES ('Victor', 'THARREAU', 2021, '1950-02-17', 'yes53', '$2y$10$l8RT7YE1H3J0/TouC./vHu2F7C8NSf8rrMhiXHeYbdOeM83fR8xv2', 0);
INSERT INTO Utilisateur(firstname, lastname, promo, birthday, pseudo, mdp, id_admin) VALUES ('Pierre', 'POIBLAUD', 2021,  '1967-01-27', 'non28', '$2y$10$l8RT7YE1H3J0/TouC./vHu2F7C8NSf8rrMhiXHeYbdOeM83fR8xv2', 0);
INSERT INTO Utilisateur(firstname, lastname, promo, birthday, pseudo, mdp, id_admin) VALUES ('Mathieu', 'PAVARD', 2021, '1961-07-19', 'guest333', '$2y$10$l8RT7YE1H3J0/TouC./vHu2F7C8NSf8rrMhiXHeYbdOeM83fR8xv2', 0);


INSERT INTO Place(name, adresse, capacite)VALUES('ENSIIE-HALL', '1 square de la Resistance, 91000 EVRY', 300);
INSERT INTO Place(name, adresse, capacite)VALUES('ENSIIE-AMPHI S2', '1 square de la Resistance, 91000 EVRY', 200);
INSERT INTO Place(name, adresse, capacite)VALUES('ENSIIE-FOYER', '1 square de la Resistance, 91000 EVRY', 100);
INSERT INTO Place(name, adresse, capacite)VALUES('NEW-YORk-TIME SQUARE', '42 Rue Broadway', 10000);

INSERT INTO Event(name, id_Place, datee, price, nb_Participant)VALUES('Remise des diplomes', 1, '2019-04-12', 0, 150);
INSERT INTO Event(name, id_Place, datee, price, nb_Participant)VALUES('Soiree de noel', 1, '2019-12-17', 0, 100);
INSERT INTO Event(name, id_Place, datee, price, nb_Participant)VALUES('Stand photo', 2, '2019-04-10', 0, 60);
INSERT INTO Event(name, id_Place, datee, price, nb_Participant)VALUES('GALA ENSIIE 2019', 4, '2019-10-10', 0, 500);

INSERT INTO Association(name, budget)VALUES('DANSIIE', 1000);
INSERT INTO Association(name, budget)VALUES('DIESE', 16000);
INSERT INTO Association(name, budget)VALUES('BDE', 10000);

INSERT INTO Organisation(id_Asso, id_Event) VALUES (1,1);
INSERT INTO Organisation(id_Asso, id_Event) VALUES (2,3);
INSERT INTO Organisation(id_Asso, id_Event) VALUES (3,2);
INSERT INTO Organisation(id_Asso, id_Event) VALUES (3,4);

INSERT INTO Participation(id_Utilisateur, id_Event) VALUES (5,1);
INSERT INTO Participation(id_Utilisateur, id_Event) VALUES (5,2);
INSERT INTO Participation(id_Utilisateur, id_Event) VALUES (5,3);
INSERT INTO Participation(id_Utilisateur, id_Event) VALUES (5,4);
INSERT INTO Participation(id_Utilisateur, id_Event) VALUES (1,1);
INSERT INTO Participation(id_Utilisateur, id_Event) VALUES (1,4);
INSERT INTO Participation(id_Utilisateur, id_Event) VALUES (2,3);
INSERT INTO Participation(id_Utilisateur, id_Event) VALUES (4,2);
