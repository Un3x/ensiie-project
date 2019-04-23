--SVT ne modifiez pas les noms des attibuts sinon je doit refaire
--toutes les fonctions PHP et je serai pas content


CREATE TABLE "User" (
    id_user VARCHAR(50),
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
    CONSTRAINT un_users UNIQUE(prenom, nom, pseudo)
);

CREATE TABLE "Livre" (
    id_livre VARCHAR(13) NOT NULL,
    titre VARCHAR(50) ,
    auteur VARCHAR(50) , -- multivalué -> cf. Auteur
    publication date ,
    couverture VARCHAR(100) , 
    editeur VARCHAR(50) ,
    emprunteur VARCHAR(50) ,
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
    id VARCHAR(50) NOT NULL ,
    num VARCHAR(50),
    personne VARCHAR(50) NOT NULL ,
    texte VARCHAR(400) ,
    note int,
    CONSTRAINT pk_review PRIMARY KEY (id, num),
    FOREIGN KEY (id) REFERENCES "Livre"(id_livre) ,
    FOREIGN KEY (personne) REFERENCES "User"(id_user) ,
    CONSTRAINT check_note CHECK (note between 0 and 10)
);


CREATE TABLE "Historique" (
    id_livre VARCHAR(13) NOT NULL,
    id_user VARCHAR(50) NOT NULL,
    date_emprunt date NOT NULL,
    date_rendu date NOT NULL,
    id_review VARCHAR(50),
    num_review VARCHAR(50),
    CONSTRAINT pk_historique PRIMARY KEY (id_livre, id_user),
    FOREIGN KEY (id_livre) REFERENCES "Livre"(id_livre),
    FOREIGN KEY (id_user) REFERENCES "User"(id_user),
    FOREIGN KEY (id_review, num_review) REFERENCES "Review"(id, num)
);

CREATE TABLE "Reservation" (
    id_livre VARCHAR(13) NOT NULL,
    id_user VARCHAR(50) NOT NULL,
    CONSTRAINT pk_reservation PRIMARY KEY (id_livre, id_user),
    FOREIGN KEY (id_livre) REFERENCES "Livre"(id_livre),
    FOREIGN KEY (id_user) REFERENCES "User"(id_user)
);


/*
CREATE TRIGGER increase_nb_user AFTER UPDATE
ON "Livre" FOR EACH ROW
f_update_nb_emprunte();



CREATE OR REPLACE FUNCTION f_update_nb_emprunte() RETURNS void AS
$f_update_nb_emprunte$
BEGIN 
    IF OLD.emprunteur == NULL && NEW.emprunteur != NULL 
    THEN 
        UPDATE "User" 
        SET nb_livres_empruntes = nb_livres_empruntes + 1
        WHERE id = NEW.emprunteur;
    END IF;
    IF OLD.emprunteur != NULL && NEW.emprunteur == NULL 
    THEN 
        UPDATE "User" 
        SET nb_livres_rendus = nb_livres_rendus + 1
        WHERE id = NEW.emprunteur;
    END IF;
END;
$f_update_nb_emprunte$ LANGUAGE plpgsql;



CREATE TRIGGER initialization_user AFTER INSERT
ON "User" FOR EACH ROW
f_init_user();



CREATE OR REPLACE FUNCTION f_init_user() RETURNS void AS
$f_init_user$
BEGIN
    UPDATE "User" 
    SET nb_livres_empruntes = 0, nb_livres_rendus = 0
    WHERE id = NEW.id;
END
$f_init_user$ LANGUAGE plpgsql;



CREATE TRIGGER initialization_livre AFTER INSERT
ON "Livre" FOR EACH ROW
f_init_livre();



CREATE OR REPLACE FUNCTION f_init_livre() RETURNS void AS
$f_init_livre$
BEGIN
    UPDATE Livre 
    SET emprunteur = NULL, date_emprunt = NULL
    WHERE id = NEW.id;
END
*/



INSERT INTO "User"(id_user, nom, prenom, pseudo, mdp, mail, nb_livres_empruntes, nb_livres_rendus) VALUES ('1', 'Charles', 'Tanguy', 'Ansyth', '0', '0', '0', '0');
INSERT INTO "User"(id_user, nom, prenom, pseudo, mdp, mail, nb_livres_empruntes, nb_livres_rendus) VALUES ('2', 'Fleurance', 'Paul', 'Deluxe', '0', '0', '0', '0');
INSERT INTO "User"(id_user, nom, prenom, pseudo, mdp, mail, nb_livres_empruntes, nb_livres_rendus) VALUES ('3', 'Fourcade', 'Louis', 'Gofer', '0', '0', '0', '0');
INSERT INTO "User"(id_user, nom, prenom, pseudo, mdp, mail, nb_livres_empruntes, nb_livres_rendus) VALUES ('4', 'Gauthier', 'Louis', 'Ofeeling', '0', '0', '0', '0');