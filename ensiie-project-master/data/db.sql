-- ***************************
-- * Création tables
-- ***************************
CREATE TABLE Utilisateur (
       id SERIAL PRIMARY KEY,
       nom VARCHAR(50) NOT NULL ,
       prenom VARCHAR(50) NOT NULL ,
       email VARCHAR(50) NOT NULL ,
       password VARCHAR(50) UNIQUE NOT NULL ,
       tel INTEGER ,
       genre CHAR(1),
       sport VARCHAR(50) NOT NULL );
       
-- Héritage (Classe Mère)

CREATE TABLE Jury ( ) INHERITS (Utilisateur);
CREATE TABLE Organisateur ( ) INHERITS (Utilisateur);
CREATE TABLE Participant ( ) INHERITS (Utilisateur);

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

