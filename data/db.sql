CREATE TABLE "User" (
    id_user SERIAL,
    prenom VARCHAR(50) NOT NULL,
    nom VARCHAR(50) NOT NULL ,
    pseudo VARCHAR(50) NOT NULL ,
    ddn date ,
    mdp VARCHAR(50) NOT NULL ,
    mail VARCHAR(50) NOT NULL ,
    nb_livres_empruntes int NOT NULL,
    nb_livres_rendus int NOT NULL ,
    est_admin boolean ,
    CONSTRAINT pk_users PRIMARY KEY(id_user),
    CONSTRAINT un_users UNIQUE(prenom, nom, pseudo),
    CONSTRAINT un_pseudo UNIQUE(pseudo)
);

CREATE TABLE "Livre" (
    id_livre VARCHAR(13) NOT NULL,
    titre VARCHAR(70) ,
    auteur VARCHAR(50) , -- multivalué -> cf. Auteur
    publication date ,
    couverture VARCHAR(200) , 
    editeur VARCHAR(50) ,
    emprunteur int ,
    date_emprunt date ,
    CONSTRAINT pk_livres PRIMARY KEY(id_livre) ,
    CONSTRAINT fk_livre_emprunteur FOREIGN KEY (emprunteur) REFERENCES "User"(id_user)
);

CREATE TABLE "Auteur" ( -- auteur pour livre -> composante multivalué
    id_livre VARCHAR(50) NOT NULL ,
    auteur VARCHAR(50) NOT NULL ,
    CONSTRAINT pk_auteur PRIMARY KEY (id_livre, auteur),
    CONSTRAINT fk_auteur FOREIGN KEY (id_livre) REFERENCES "Livre"(id_livre)
);

CREATE TABLE "Review" (
    id_review SERIAL,
    id VARCHAR(50) NOT NULL ,
    num VARCHAR(50),
    personne int NOT NULL ,
    texte VARCHAR(400) ,
    note int,
    CONSTRAINT pk_review PRIMARY KEY (id_review) ,
    CONSTRAINT fk_review_id FOREIGN KEY (id) REFERENCES "Livre"(id_livre) ,
    CONSTRAINT fk_review_user FOREIGN KEY (personne) REFERENCES "User"(id_user) ,
    CONSTRAINT check_note CHECK(note between 0 and 10)
);


CREATE TABLE "Historique" (
    id_livre VARCHAR(13) NOT NULL,
    id_user int NOT NULL,
    date_emprunt date NOT NULL,
    date_rendu date NOT NULL,
    id_review int,
    num_review int,
    CONSTRAINT pk_historique PRIMARY KEY (id_livre, id_user),
    CONSTRAINT fk_historique_livre FOREIGN KEY (id_livre) REFERENCES "Livre"(id_livre),
    CONSTRAINT fk_historique_user FOREIGN KEY (id_user) REFERENCES "User"(id_user),
    CONSTRAINT fk_historique_review FOREIGN KEY (id_review) REFERENCES "Review"(id_review)
);

CREATE TABLE "Reservation" (
    id_livre VARCHAR(13) NOT NULL,
    id_user int NOT NULL,
    CONSTRAINT pk_reservation PRIMARY KEY (id_livre, id_user),
    CONSTRAINT fk_reservation_livre FOREIGN KEY (id_livre) REFERENCES "Livre"(id_livre),
    CONSTRAINT fk_reservation_user FOREIGN KEY (id_user) REFERENCES "User"(id_user)
);





