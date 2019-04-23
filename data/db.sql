DROP TABLE IF EXISTS "user" CASCADE;
DROP TABLE IF EXISTS "photo_profil" CASCADE;
DROP TABLE IF EXISTS "produits" CASCADE;
DROP TABLE IF EXISTS "categorie" CASCADE;
DROP TABLE IF EXISTS "assoc_prd_cat" CASCADE;

CREATE TABLE "photo_profil"(
    id_photo INTEGER,
    adresse VARCHAR(200) NOT NULL,
    CONSTRAINT key_photopro PRIMARY KEY (id_photo)
);

CREATE TABLE "user"(
    id VARCHAR(50) NOT NULL,
    firstname VARCHAR(30) NOT NULL ,
    lastname VARCHAR(30) NOT NULL ,
    birthday date,
    loc VARCHAR(100) NOT NULL,
    mail VARCHAR(100) NOT NULL,
    mdp VARCHAR(100),
    /*photo_id INTEGER REFERENCES photo_profil(id_photo),*/
    photo_id INTEGER,
    CONSTRAINT key_user PRIMARY KEY (id),
    CONSTRAINT fk_photo FOREIGN KEY (photo_id) REFERENCES photo_profil(id_photo)
    
);


CREATE TABLE "produits"(
    id_produit INTEGER,
    date_publi date,
    id_proprio VARCHAR(50) /*REFERENCES "user"(id)*/,
    descript VARCHAR,
    CONSTRAINT key_prod PRIMARY KEY (id_produit),
    CONSTRAINT fk_proprio FOREIGN KEY (id_proprio) REFERENCES "user"(id)
);


CREATE TABLE "categorie"(
    id_cat INTEGER,
    nom_cat VARCHAR,
    CONSTRAINT key_cat PRIMARY KEY (id_cat)
);


CREATE TABLE "assoc_prd_cat"(
    id_cat INTEGER /*REFERENCES categorie(id_cat)*/,
    id_prod INTEGER /*REFERENCES produits(id_produit)*/,
    CONSTRAINT key_assoc_prd_cat PRIMARY KEY (id_cat,id_prod),
    CONSTRAINT fk_cat FOREIGN KEY (id_cat) REFERENCES categorie(id_cat)
);

/*INSERT INTO "user"(firstname, lastname, birthday) VALUES ('John', 'Doe', '1967-11-22');
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
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Delores', 'Williamson', '1961-07-19');*/

INSERT INTO "user"(id, firstname, lastname, birthday, loc, mail, mdp) VALUES ('hugo91600', 'Hugo', 'Sellambin', '1998-02-27', 'Savigny', 'hugo@gmail.com', 'azerty');
