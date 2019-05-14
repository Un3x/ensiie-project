
DROP TABLE "Eleve";
DROP TABLE "Forum";
DROP TABLE "Participant";

CREATE TYPE STATUT AS enum ('Admin', 'Visitor');
--Admin pour les administrateurs
--Visitor pour les élèves étudiants mais non administrateurs

CREATE TABLE "Eleve"(
    id_eleve SERIAL PRIMARY KEY,
    nom VARCHAR(150) NOT NULL,
    prenom VARCHAR(150) NOT NULL,
    grade INTEGER NOT NULL,
    mdp VARCHAR(100) NOT NULL,
    stat STATUT NOT NULL,
    mail VARCHAR(150) NOT NULL
);

CREATE TABLE "Forum"(
    id_forum SERIAL PRIMARY KEY NOT NULL,
    nom VARCHAR(150) NOT NULL,
    ville VARCHAR(150) NOT NULL,
    f_date date NOT NULL
);

CREATE TABLE "Participant"(
    id_eleve INTEGER NOT NULL,
    id_forum INTEGER NOT NULL,
    CONSTRAINT id_participant PRIMARY KEY (id_eleve, id_forum)
);

INSERT INTO "Eleve"(id_eleve, nom, prenom, grade, mdp, stat, mail) VALUES ('0', 'Boiteau', 'Mathis', '2021', 'Ragnalor', 'Visitor', 'mathis.boiteau@ensiie.fr');
INSERT INTO "Eleve"(id_eleve, nom, prenom, grade, mdp, stat, mail) VALUES ('1', 'Gauthier', 'Alexandra', '2021', 'Eiji', 'Admin', 'alexandra.gauthier@ensiie.fr');
INSERT INTO "Eleve"(id_eleve, nom, prenom, grade, mdp, stat, mail) VALUES ('2', 'Doan', 'Dorian', '2021', 'Bouteille', 'Admin', 'dorian.doan@ensiie.fr');
INSERT INTO "Eleve"(id_eleve, nom, prenom, grade, mdp, stat, mail) VALUES ('3', 'Bailleul', 'Géraldine', '2021', 'Howly', 'Admin', 'geraldine.bailleul@ensiie.fr');
INSERT INTO "Eleve"(id_eleve, nom, prenom, grade, mdp, stat, mail) VALUES ('4', 'Tirbisch', 'Romain', '2021', 'Elfo', 'Visitor', 'romain.tirbisch@ensiie.fr');

INSERT INTO "Forum"(id_forum, nom, ville, f_date) VALUES ('-5', 'FENELON', 'PARIS08', '2019-11-15');
INSERT INTO "Forum"(id_forum, nom, ville, f_date) VALUES ('-4', 'Institut Emmanuel Alzon', 'NÎMES', '2018-11-16');
INSERT INTO "Forum"(id_forum, nom, ville, f_date) VALUES ('-3', 'Albert Chatelêt', 'DOUAI', '2018-11-23');
INSERT INTO "Forum"(id_forum, nom, ville, f_date) VALUES ('-2', 'François 1er', 'LE HAVRE', '2018-11-23');
INSERT INTO "Forum"(id_forum, nom, ville, f_date) VALUES ('-1', 'Berthollet', 'ANNECY', '2018-11-23');




