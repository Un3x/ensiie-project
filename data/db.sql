CREATE TABLE "User" (
    id VARCHAR ,
    prenom VARCHAR NOT NULL ,
    nom VARCHAR NOT NULL ,
    pseudo VARCHAR NOT NULL ,
    ddn date ,
    mdp VARCHAR NOT NULL ,
    mail VARCHAR NOT NULL ,
    nbLivresEmpruntés int NOT NULL,
    nbLivresRendus int ,
    estAdmin boolean ,
    CONSTRAINT pk_users PRIMARY KEY id ,
    CONSTRAINT un_users (prenom, nom, pseudo) UNIQUE
);

CREATE TABLE "Livre" (
    id VARCHAR NOT NULL,
    titre VARCHAR ,
    auteur VARCHAR, // multivalué
    publication date,
    couverture VARCHAR,
    edition VARCHAR ,
    CONSTRAINT pk_livres PRIMARY KEY id
);

CREATE TABLE "Review" (
    id VARCHAR NOT NULL ,
    num int,
    personne VARCHAR NOT NULL ,
    texte VARCHAR[400] ,
    note int,
    CONSTRAINT pk_review PRIMARY KEY (id, num) ,
    FOREIGN KEY (id) REFERENCES Livre (id),
    FOREIGN KEY (personne) REFERENCES User (id)
);

CREATE TABLE "Empruntes" (
    id VARCHAR NOT NULL , 
    emprunter // ,
    emprunteLe date ,
    CONSTRAINT pk_empruntes PRIMARY KEY id 
);

CREATE TABLE "Historique" (
    id_livre VARCHAR NOT NULL,
    id_user VARCHAR NOT NULL,
    date_emprunt date NOT NULL,
    date_rendu date NOT NULL,
    id_review VARCHAR,
    num_review VARCHAR,
    CONTRAINT pk_historique PRIMARY KEY (id_livre, id_user),
    FOREIGN KEY id_livre REFERENCES Livre (id),
    FOREIGN KEY id_user REFERENCES User (id),
    FOREIGN KEY (id_review, num_review) REFERENCES Review (id, num)
);

CREATE TABLE "Reservation" (
    id_livre VARCHAR NOT NULL,
    id_user VARCHAR NOT NULL,
    CONTRAINT pk_reservation PRIMARY KEY (id_livre, id_user),
    FOREIGN KEY id_livre REFERENCES Livre (id),
    FOREIGN KEY id_user REFERENCES User (id)
);
