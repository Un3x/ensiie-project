CREATE TABLE "user" (
    id SERIAL PRIMARY KEY ,
    firstname VARCHAR NOT NULL ,
    lastname VARCHAR NOT NULL ,
    pseudo VARCHAR	UNIQUE NOT NULL,
    mdp VARCHAR NOT NULL,
    admin VARCHAR NOT NULL
);

CREATE TABLE "event" (

	idevent SERIAL PRIMARY KEY ,
	title VARCHAR  NOT NULL ,
	type VARCHAR NOT NULL ,
	day DATE NOT NULL ,
	start TIME NOT NULL ,
	place VARCHAR NOT NULL,
	idcreator SERIAL NOT NULL,
	public VARCHAR NOT NULL

);

CREATE TABLE "participant" (

	key SERIAL PRIMARY KEY,
	idevent INT NOT NULL,
	iduser INT NOT NULL,
	pseudo VARCHAR NOT NULL


);


INSERT INTO "user"(firstname, lastname, pseudo, mdp, admin) VALUES ('Killian', 'Delarue', 'Stryt', '123','Oui');
INSERT INTO "user"(firstname, lastname, pseudo, mdp, admin) VALUES ('Lucas', 'Briffon', 'Albus', '123','Oui');
INSERT INTO "user"(firstname, lastname, pseudo, mdp, admin) VALUES ('Yasmina', 'Ladjali', 'Poussin', '123','Oui');
INSERT INTO "user"(firstname, lastname, pseudo, mdp, admin) VALUES ('Aïmane', 'Belghyti', 'Heyman', '123','Oui');

INSERT INTO "event"(title, type, day, start, place, idcreator, public) VALUES	('Crémaillère Dramaloc', 'Crémaillère', '2019-06-05', '22:00:00', 'Dramaloc', 4, 'Oui');
INSERT INTO "event"(title, type, day, start, place, idcreator, public) VALUES	('Soirée', 'Soirée', '2019-06-07', '18:00:00', 'Ecole', 3, 'Oui');
INSERT INTO "event"(title, type, day, start, place, idcreator, public) VALUES	('After Dramaloc', 'After', '2019-06-07', '23:00:00', 'Dramaloc', 2, 'Oui');
INSERT INTO "event"(title, type, day, start, place, idcreator, public) VALUES	('Anniversaire', 'Anniversaire', '2019-06-28', '20:00:00', 'Chez Stryt', 1, 'Non');

INSERT INTO "participant"(idevent,iduser,pseudo) VALUES(1,1,'Stryt');
INSERT INTO "participant"(idevent,iduser,pseudo) VALUES(2,1,'Stryt');
INSERT INTO "participant"(idevent,iduser,pseudo) VALUES(3,1,'Stryt');
INSERT INTO "participant"(idevent,iduser,pseudo) VALUES(2,2,'Albus');
INSERT INTO "participant"(idevent,iduser,pseudo) VALUES(3,2,'Albus');
INSERT INTO "participant"(idevent,iduser,pseudo) VALUES(4,2,'Albus');
INSERT INTO "participant"(idevent,iduser,pseudo) VALUES(1,3,'Poussin');
INSERT INTO "participant"(idevent,iduser,pseudo) VALUES(3,3,'Poussin');
INSERT INTO "participant"(idevent,iduser,pseudo) VALUES(4,3,'Poussin');
INSERT INTO "participant"(idevent,iduser,pseudo) VALUES(1,4,'Heyman');
INSERT INTO "participant"(idevent,iduser,pseudo) VALUES(2,4,'Heyman');
INSERT INTO "participant"(idevent,iduser,pseudo) VALUES(4,4,'Heyman');
