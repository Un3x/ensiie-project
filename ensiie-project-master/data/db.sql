
-- ***************************
-- * Création tables
-- ***************************
CREATE TABLE Utilisateur (
       id SERIAL UNIQUE PRIMARY KEY,
       nom VARCHAR(50) NOT NULL ,
       prenom VARCHAR(50) NOT NULL ,
       email VARCHAR(50) UNIQUE NOT NULL ,
       password VARCHAR(50) NOT NULL ,
       tel VARCHAR(10) ,
       genre CHAR(1),
       sport VARCHAR(50) NOT NULL );
       

-- Héritage (Classe Mère)

CREATE TABLE Jury ( ) INHERITS (Utilisateur);
CREATE TABLE Organisateur ( ) INHERITS (Utilisateur);
CREATE TABLE Participant ( ) INHERITS (Utilisateur);

INSERT INTO Participant (id, nom, prenom, email, password, tel, genre, sport) VALUES ('123', 'Participant', 'John', 'participant@gmail.com', 'mdp', '0636754809', 'm', 'Basketball');
INSERT INTO Jury (id, nom, prenom, email, password, tel, genre, sport) VALUES ('123', 'Jury', 'John', 'jury@gmail.com', 'mdp', '0636754809', 'm', 'Basketball');
INSERT INTO Organisateur (id, nom, prenom, email, password, tel, genre, sport) VALUES ('123', 'Organisateur', 'John', 'organisateur@gmail.com', 'mdp', '0636754809', 'm', 'Basketball');

CREATE TABLE Sport (
       nom VARCHAR(50) NOT NULL ,
       genre CHAR(1) NOT NULL ,
       lieu VARCHAR(50) NOT NULL,
       PRIMARY KEY ( nom, genre ));

INSERT INTO Sport (nom, genre, lieu) VALUES ('Basketball', 'm', 'Square');
INSERT INTO Sport (nom, genre, lieu) VALUES ('Basketball', 'f', 'Square');

CREATE TABLE Logement (
       adresse VARCHAR(100) PRIMARY KEY);
       /*locataire INTEGER  REFERENCES Utilisateur(id),
       type_log VARCHAR(50) );*/ 

INSERT INTO Logement (adresse) VALUES ('Cabane');
INSERT INTO Logement (adresse) VALUES ('Jardin');


CREATE TABLE LogementSport (
       nom VARCHAR(50),
       genre char(1),
       adresse VARCHAR(100),
       PRIMARY KEY (nom, genre, adresse));

