
CREATE TABLE "utilisateur" (
    id SERIAL PRIMARY KEY ,
    prenom VARCHAR NOT NULL ,
    nom VARCHAR NOT NULL ,
    email VARCHAR NOT NULL ,
    mdp VARCHAR NOT NULL 
);

INSERT INTO "utilisateur"(prenom,nom,email,mdp) VALUES ('Ines','Mellouk', 'i.mellouk@hotmail.fr', 'azerty') ;

CREATE TABLE "admin" (
    id SERIAL PRIMARY KEY ,
    prenom VARCHAR NOT NULL ,
    nom VARCHAR NOT NULL ,
    email VARCHAR NOT NULL ,
    mdp VARCHAR NOT NULL 
);

INSERT INTO "admin"(prenom,nom,email,mdp) VALUES ('Maxime','El Haddari', 'max4500@hotmail.fr', 'inconnu') ;

CREATE TABLE "reservation" (
    id SERIAL PRIMARY KEY ,
    prenom VARCHAR NOT NULL ,
    nom VARCHAR NOT NULL ,
    email VARCHAR NOT NULL 
);

