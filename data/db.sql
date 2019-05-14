CREATE TABLE "inscrit" ( nom varchar(20) NOT NULL, 
prenom varchar(20) Not null, pseudo varchar(20) not null,
numetudiant varchar PRIMARY KEY, mail Varchar(50), 
datedenaissance varchar, genre varchar(20), mdp varchar(50), addresse VARCHAR(50));


INSERT INTO "inscrit" VALUES ('RAHJ' , 'hicham', 'sparrow', 
'13', 'hichamrahj21@gmail.com', '1998-07-13', 'Homme',
'hichamrahj', 'Bobigny'

);

CREATE TABLE "administrateur" ( nom varchar(20) NOT NULL, 
prenom varchar(20) Not null, pseudo varchar(20) not null,
numadministrateur varchar PRIMARY KEY, mail Varchar(50), 
dateDeNaissance varchar, genre varchar(20), mdp varchar(50), addresse VARCHAR(50));

INSERT INTO "administrateur" VALUES ('RAHJ' , 'hicham', 'law', 
'13', 'hichamrahj21@gmail.com', '1998-07-13', 'Homme',
'hichamrahj', 'Bobigny'

);


CREATE TABLE Livres(titre varchar, auteur varchar , genre varchar,reference varchar PRIMARY KEY, disponibilite varchar);


CREATE TABLE Audio(titre  VARCHAR , reference VARCHAR Primary key, disponibilite varchar, categorie VARCHAR);


CREATE TABLE  Video(titre VARCHAR , reference VARChar primary key , disponibilite varchar, categorie Varchar);

CREATE TABLE Emprunts(pseudo varchar, reference varchar Primary key,
 retour date );

INSERT INTO Emprunts values('mame','led1','2019-06-14');
INSERT INTO Emprunts values('alcosin','led2','2019-11-14');
INSERT INTO "inscrit" VALUES ('TOURE', 'MAME DIARRA','MAME','1 ','mametoure25@gmail.com','1998-03-25','F','azerty','evry');
INSERT INTO "inscrit" VALUES ('MOUMMOU', 'NISRINE','ALCOSIN','2','moummou.nis@gmail.com','1998-05-11','F','ytreza','evry');
INSERT INTO "inscrit" VALUES ('BENSAID', 'GHADA','BEN','3','GHADA@gmail.com','1998-07-20','F','POIUYTR','evry');
INSERT INTO "inscrit" VALUES ('RAHJ', 'HICHAM','HICH','4','RAHJ@gmail.com','1998-11-25','H','ertyui','evry');

INSERT INTO "administrateur" VALUES ('TOURE', 'mamediarra','100','admin1@gmail.com','1998-03-25','F','mdpadmin1','evry');
INSERT INTO "administrateur" VALUES ('moummou', 'nisrine','200','admin2@gmail.com','1998-05-11','F','mdpadmin2','evry');
INSERT INTO "administrateur" VALUES ('ben said', 'ghada','300','admin3@gmail.com','1998-03-20','F','mdpadmin3','evry');
INSERT INTO "administrateur" VALUES ('rahj', 'hicham','400','admin4@gmail.com','1998-07-20','F','mdpadmin4','evry');

INSERT INTO Livres VALUES('becoming','Michelle obama','educatif','led1','oui');

INSERT INTO Livres VALUES('mathematiques tout en un','Francois moulin','educatif','led2','non');

INSERT INTO Livres VALUES('les reseaux informatiques','pierre cabantous','educatif','led3','resérvé');

INSERT INTO Livres VALUES('langage C','frederique drouillon','educatif','led4','non');
INSERT INTO Livres VALUES('le CID','corneille','ludique','lud1','10-04-2019');
INSERT INTO Livres VALUES('harry Potter','J k ROWLING','ludique','lud2','10-04-2019');

INSERT INTO Audio VALUES('english pronounciation','aled1','non','educatif');
INSERT INTO Audio VALUES('mind of mine','alud1','non','ludique');


INSERT INTO Video VALUES('se preparer pour un entretien','ved1','non','educatif');

INSERT INTO Video VALUES('installer ubuntu','ved2','reservé','educatif');
INSERT INTO Video VALUES('tutoriel docker','ved3','non','educatif');

CREATE TABLE "user" (
    id SERIAL PRIMARY KEY ,
    firstname VARCHAR NOT NULL ,
    lastname VARCHAR NOT NULL ,
    birthday date
);

INSERT INTO "user"(firstname, lastname, birthday) VALUES ('John', 'Doe', '1967-11-22');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Yvette', 'Angel', '1932-01-24');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Amelia', 'Waters', '1981-12-01');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Manuel', 'Holloway', '1979-07-25');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Alonzo', 'Erickson', '1947-11-13');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Otis', 'Roberson', '1995-01-09');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Jaime', 'King', '1924-05-30');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Vicky', 'Pearson', '1982-12-12)');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Silvia', 'Mcguire', '1971-03-02');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Brendan', 'Pena', '1950-02-17');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Jackie', 'Cohen', '1967-01-27');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Delores', 'Williamson', '1961-07-19');
CREATE TABLE "user" (
    id SERIAL PRIMARY KEY ,
    firstname VARCHAR NOT NULL ,
    lastname VARCHAR NOT NULL ,
    birthday date
);

INSERT INTO "user"(firstname, lastname, birthday) VALUES ('John', 'Doe', '1967-11-22');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Yvette', 'Angel', '1932-01-24');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Amelia', 'Waters', '1981-12-01');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Manuel', 'Holloway', '1979-07-25');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Alonzo', 'Erickson', '1947-11-13');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Otis', 'Roberson', '1995-01-09');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Jaime', 'King', '1924-05-30');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Vicky', 'Pearson', '1982-12-12)');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Silvia', 'Mcguire', '1971-03-02');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Brendan', 'Pena', '1950-02-17');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Jackie', 'Cohen', '1967-01-27');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Delores', 'Williamson', '1961-07-19');