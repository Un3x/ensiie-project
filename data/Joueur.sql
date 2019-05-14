/*CREATE TABLE "Joueur" (
    pseudo PRIMARY KEY references Participants,
    elo  INTEGER NOT NULL ,
    rang VARCHAR NOT NULL ,
    promotion INTEGER NOT NULL
);*/


/* problème ref */

/* Il faut que Sky soit aussi dans la table participant sinon pb  */

INSERT INTO "Joueur"(pseudo,elo,rang,promotion) VALUES ('Sky',1000, 'Novice',2021);
INSERT INTO "Joueur"(pseudo,elo,rang,promotion) VALUES ('Elvis',1000, 'Novice',2021);
INSERT INTO "Joueur"(pseudo,elo,rang,promotion) VALUES ('Wil',1000, 'Novice',2021);
INSERT INTO "Joueur"(pseudo,elo,rang,promotion) VALUES ('Papy',1000, 'Novice',2021);
INSERT INTO "Joueur"(pseudo,elo,rang,promotion) VALUES ('Kronk',1000, 'Novice',2021);

/*INSERT INTO "Joueur"(firstname, lastname, birthday,Elo,Rang,Promotion,Achievements,Pseudo) VALUES ('Clément', 'Cazenave', '1999-03-19', 1000, 'Novice', 2021, '', Elvis);
INSERT INTO "Joueur"(firstname, lastname, birthday,Elo,Rang,Promotion,Achievements,Pseudo) VALUES ('Guillaume', 'Shi de Milleville', '1998-06-22', 1000, 'Novice', 2021, '', Elvis);
INSERT INTO "Joueur"(firstname, lastname, birthday,Elo,Rang,Promotion,Achievements,Pseudo) VALUES ('Thibaud', 'Prigent', '1998-02-03', 1000, 'Novice', 2021, 'Papy');
INSERT INTO "Joueur"(firstname, lastname, birthday,Elo,Rang,Promotion,Achievements,Pseudo) VALUES ('Lenaïc', 'Durand', '1999-06-01', 1000, 'Novice', 2021, 'Kronk');
*/
