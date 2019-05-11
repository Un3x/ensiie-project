
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

INSERT INTO Participant (id, nom, prenom, email, password, tel, genre, sport) VALUES ('123', 'Participant', 'John', 'participant@gmail.com', 'mdp', '0636754809', 'm', 'Basket');
INSERT INTO Jury (id, nom, prenom, email, password, tel, genre, sport) VALUES ('123', 'Jury', 'John', 'jury@gmail.com', 'mdp', '0636754809', 'm', 'Basket');
INSERT INTO Organisateur (id, nom, prenom, email, password, tel, genre, sport) VALUES ('123', 'Organisateur', 'John', 'organisateur@gmail.com', 'mdp', '0636754809', 'm', 'Basket');

CREATE TABLE Sport (
       nom VARCHAR(50) PRIMARY KEY ,
       lieu VARCHAR(50) NOT NULL ,
       equipe VARCHAR(50) ,
       genre CHAR(1) NOT NULL );

CREATE TABLE Logement (
       adresse VARCHAR(100) NOT NULL,
       numero INTEGER,
       num_lit INTEGER,
       PRIMARY KEY ( adresse , numero, num_lit ),
       locataire INTEGER  REFERENCES Utilisateur(id),
       type_log VARCHAR(50) ); 

