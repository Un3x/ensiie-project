CREATE TABLE Connexion(
pseudo VARCHAR PRIMARY KEY,
mdp VARCHAR NOT NULL
);

CREATE TABLE Identite (
pseudo VARCHAR  PRIMARY KEY ,
nom VARCHAR NOT NULL,
prenom VARCHAR NOT NULL,
sexe VARCHAR NOT NULL,
phrase VARCHAR NOT NULL,
region VARCHAR NOT NULL,
ville VARCHAR NOT NULL,
note INTEGER NOT NULL
);

CREATE TABLE Avatar(
pseudo VARCHAR PRIMARY KEY,
avatar VARCHAR NOT NULL
);

CREATE TABLE Commentaire(
pseudo VARCHAR,
commentaire VARCHAR,
commentateur VARCHAR,
dat DATE,
heur TIME
);

CREATE TABLE Signalement(
pseudo VARCHAR,
commentaire VARCHAR,
commentateur VARCHAR,
dat DATE,
heur TIME
);

CREATE TABLE Notation (
pseudo VARCHAR ,
note INTEGER
);

INSERT INTO Identite(pseudo,nom,prenom,sexe,phrase,region,ville,note) VALUES('Ngolo','DJIGUI','Tresor','M','Faudra essayer detre heureux ne serait-ce que pour donner lexemple','Ile-de-France','Paris',7);
INSERT INTO Identite(pseudo,nom,prenom,sexe,phrase,region,ville,note) VALUES('Presley','CAZENAVE','Clément','M','Memphis meilleur jeune 2012#pipo','Ile-de-France','Paris',8);
INSERT INTO Identite(pseudo,nom,prenom,sexe,phrase,region,ville,note) VALUES('Papy','PRIGENT','Thibaud','M','I think that alcohol is water, and you?','Ile-de-France','Paris',10);
INSERT INTO Identite(pseudo,nom,prenom,sexe,phrase,region,ville,note) VALUES('Kronk','DURAND','Lenaic','M','Voilà voilà','Ile-de-France','Paris',7);
INSERT INTO Identite(pseudo,nom,prenom,sexe,phrase,region,ville,note) VALUES('Tic','COMMINGES','Alexis','M','La vie est plus drôle avec le principe des olives','Ile-de-France','Paris',3);
INSERT INTO Identite(pseudo,nom,prenom,sexe,phrase,region,ville,note) VALUES('Administrateur','DJIGUI','Tresor','M','Je suis un administrateur','Ile-de-France','Paris',7);

INSERT INTO Commentaire(pseudo,commentaire,commentateur,dat,heur) VALUES('Ngolo','Trop gentil ce mec!','Papy',CURRENT_DATE ,CURRENT_TIME );
INSERT INTO Commentaire(pseudo,commentaire,commentateur,dat,heur) VALUES('Ngolo','Merci pour la dernière fois!','Presley',CURRENT_DATE ,CURRENT_TIME );
INSERT INTO Commentaire (pseudo,commentaire,commentateur,dat,heur) VALUES('Ngolo','On se revoit bientôt poto!','Kronk',CURRENT_DATE ,CURRENT_TIME );
INSERT INTO Commentaire(pseudo,commentaire,commentateur,dat,heur) VALUES('Ngolo','Quel prétentieux ce béninois!','Tic',CURRENT_DATE ,CURRENT_TIME );

INSERT INTO Connexion(pseudo,mdp) VALUES('Ngolo','1998Tres@r');
INSERT INTO Connexion(pseudo,mdp) VALUES('Administrateur','1998Tres@r');

INSERT INTO Avatar(pseudo,avatar) VALUES('Ngolo','avatar/avatar8.jpeg');
INSERT INTO Avatar(pseudo,avatar) VALUES('Presley','avatar/avatar8.jpeg');
INSERT INTO Avatar(pseudo,avatar) VALUES('Papy','avatar/avatar8.jpeg');
INSERT INTO Avatar(pseudo,avatar) VALUES('Kronk','avatar/avatar8.jpeg');
INSERT INTO Avatar(pseudo,avatar) VALUES('Tic','avatar/avatar8.jpeg');