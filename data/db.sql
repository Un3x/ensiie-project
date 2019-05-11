DROP TABLE IF EXISTS "utilisateur" CASCADE;
DROP TABLE IF EXISTS "photo" CASCADE;
DROP TABLE IF EXISTS "produits" CASCADE;
DROP TABLE IF EXISTS "categorie" CASCADE;
DROP TABLE IF EXISTS "assoc_prd_cat" CASCADE;

CREATE TABLE "photo"(
    id_photo INTEGER,
    extension VARCHAR(200) NOT NULL,
    CONSTRAINT key_photo PRIMARY KEY (id_photo)
);

CREATE TABLE "utilisateur"(
    id VARCHAR(50) NOT NULL,
    firstname VARCHAR(30) NOT NULL ,
    lastname VARCHAR(30) NOT NULL ,
    birthday date,
    loc VARCHAR(100) NOT NULL,
    mail VARCHAR(100) NOT NULL,
    mdp VARCHAR(100),
    photo_id INTEGER REFERENCES photo(id_photo),
    administrateur INTEGER /*CHECK (administrateur = 1 || administrateur = 0)*/,
    valid INTEGER,/*0 pas valide 1 valide 2 supprimer par admin*/
    CONSTRAINT key_user PRIMARY KEY (id)
    /*CONSTRAINT fk_photo FOREIGN KEY (photo_id) REFERENCES photo_profil(id_photo)*/
    
);


CREATE TABLE "produits"(
    id_produit INTEGER,
    date_publi date,
    id_proprio VARCHAR(50) REFERENCES "utilisateur"(id),
    descript VARCHAR,
    title VARCHAR,
    price INTEGER,
    photo1 INTEGER REFERENCES photo(id_photo),
    photo2 INTEGER REFERENCES photo(id_photo),
    photo3 INTEGER REFERENCES photo(id_photo),
    valide INTEGER, /*0 pas valide 1 valide 2 supprimer par admin 3 supprimer par user*/
    CONSTRAINT key_prod PRIMARY KEY (id_produit)
    /*CONSTRAINT fk_proprio FOREIGN KEY (id_proprio) REFERENCES "utilisateur
"(id)*/
);


CREATE TABLE "categorie"(
    id_cat INTEGER,
    nom_cat VARCHAR,
    link VARCHAR,
    CONSTRAINT key_cat PRIMARY KEY (id_cat)
);


CREATE TABLE "assoc_prd_cat"(
    id_cat INTEGER REFERENCES categorie(id_cat),
    id_prod INTEGER REFERENCES produits(id_produit),
    CONSTRAINT key_assoc_prd_cat PRIMARY KEY (id_cat,id_prod)
    /*CONSTRAINT fk_cat FOREIGN KEY (id_cat) REFERENCES categorie(id_cat)*/
);

/*INSERT INTO "utilisateur"(firstname, lastname, birthday) VALUES ('John', 'Doe', '1967-11-22');
INSERT INTO "utilisateur"(firstname, lastname, birthday) VALUES ('Yvette', 'Angel', '1932-01-24');
INSERT INTO "utilisateur"(firstname, lastname, birthday) VALUES ('Amelia', 'Waters', '1981-12-01');
INSERT INTO "utilisateur"(firstname, lastname, birthday) VALUES ('Manuel', 'Holloway', '1979-07-25');
INSERT INTO "utilisateur"(firstname, lastname, birthday) VALUES ('Alonzo', 'Erickson', '1947-11-13');
INSERT INTO "utilisateur"(firstname, lastname, birthday) VALUES ('Otis', 'Roberson', '1995-01-09');
INSERT INTO "utilisateur"(firstname, lastname, birthday) VALUES ('Jaime', 'King', '1924-05-30');
INSERT INTO "utilisateur"(firstname, lastname, birthday) VALUES ('Vicky', 'Pearson', '1982-12-12)');
INSERT INTO "utilisateur"(firstname, lastname, birthday) VALUES ('Silvia', 'Mcguire', '1971-03-02');
INSERT INTO "utilisateur"(firstname, lastname, birthday) VALUES ('Brendan', 'Pena', '1950-02-17');
INSERT INTO "utilisateur"(firstname, lastname, birthday) VALUES ('Jackie', 'Cohen', '1967-01-27');
INSERT INTO "utilisateur"(firstname, lastname, birthday) VALUES ('Delores', 'Williamson', '1961-07-19');*/

INSERT INTO "photo" (id_photo,extension) VALUES (0,'png');
INSERT INTO "photo" (id_photo,extension) VALUES (1,'JPG');
INSERT INTO "photo" (id_photo,extension) VALUES (2,'jpg');
INSERT INTO "photo" (id_photo,extension) VALUES (3,'png');
INSERT INTO "photo" (id_photo,extension) VALUES (4,'jpg');
INSERT INTO "utilisateur"(id, firstname, lastname, birthday, loc, mail, mdp, photo_id, administrateur,valid) VALUES ('hugo91600', 'Hugo', 'Sellambin', '1998-02-27', 'Savigny', 'hugo@gmail.com', 'azertyui',1,1,1);
INSERT INTO "utilisateur"(id, firstname, lastname, birthday, loc, mail, mdp, photo_id, administrateur,valid) VALUES ('matth91000', 'Matthieu', 'Gosset', '1998-04-25', 'Evry', 'matthieu.gosset@ensiie.fr', '12345678',2,1,1);
INSERT INTO "utilisateur"(id, firstname, lastname, birthday, loc, mail, mdp, photo_id, administrateur,valid) VALUES ('hugoBoss', 'Hugo', 'Sellambin', '1998-02-27', 'Savigny', 'hugo@gmail.com', 'azertyui',0,0,1);
INSERT INTO "categorie"(id_cat,nom_cat, link) VALUES(1,'Auto/Moto', 'automoto.php');
INSERT INTO "categorie"(id_cat,nom_cat, link) VALUES(2,'Immobilier','immobilier.php');
INSERT INTO "categorie"(id_cat,nom_cat, link) VALUES(3,'Maison','maison.php');
INSERT INTO "categorie"(id_cat,nom_cat, link) VALUES(4,'Mode','mode.php');
INSERT INTO "categorie"(id_cat,nom_cat, link) VALUES(5,'Multimédia','multimedia.php');
INSERT INTO "categorie"(id_cat,nom_cat, link) VALUES(6,'Loisirs','loisirs.php');
INSERT INTO "categorie"(id_cat,nom_cat, link) VALUES(7,'Matériel Pro','materielpro.php');
INSERT INTO "categorie"(id_cat,nom_cat, link) VALUES(8,'Services','services.php');
INSERT INTO "categorie"(id_cat,nom_cat, link) VALUES(9,'Emploi','emploi.php');
INSERT INTO "categorie"(id_cat,nom_cat, link) VALUES(10,'BONS PLANS','bonsplans.php');
INSERT INTO "produits"(id_produit,date_publi,id_proprio,descript,title,price,photo1,photo2,photo3,valide) VALUES (0,'2019-04-30','matth91000','Trotinette en très bon état','XIAOMI M365',40000,4,3,3,0);
INSERT INTO "produits"(id_produit,date_publi,id_proprio,descript,title,price,photo1,photo2,photo3,valide) VALUES (1,'2019-04-30','matth91000','Cours de maths de première à 1ère année de prépa','Cherche prof particulier mathématiques sur Evry',0,3,3,3,0);
INSERT INTO "produits"(id_produit,date_publi,id_proprio,descript,title,price,photo1,photo2,photo3,valide) VALUES (2,'2019-04-30','matth91000','Le salon aura lieu le 7 mai prochain. Rémuneration : 200€','Cherche animateur pour salon du jeu vidéo',0,3,3,3,0);
INSERT INTO "assoc_prd_cat" (id_cat,id_prod) VALUES (6,0);
INSERT INTO "assoc_prd_cat" (id_cat,id_prod) VALUES (1,0);
INSERT INTO "assoc_prd_cat" (id_cat,id_prod) VALUES (8,1);
INSERT INTO "assoc_prd_cat" (id_cat,id_prod) VALUES (9,1);
INSERT INTO "assoc_prd_cat" (id_cat,id_prod) VALUES (6,2);
INSERT INTO "assoc_prd_cat" (id_cat,id_prod) VALUES (9,2);

/*
COMMANDE POUR RECUPERER LES TITRES DES PRODUITS DE CATEGORIE N
SELECT title FROM produits JOIN assoc_prd_cat ON id_produit=id_prod JOIN categorie ON categorie.id_cat=assoc_prd_cat.id_cat WHERE categorie.id_cat=N;

COMMANDE POUR RECUPER LES TITRES DES CATEGORIES DU PRODUIT N
SELECT nom_cat, link FROM categorie JOIN assoc_prd_cat ON categorie.id_cat=assoc_prd_cat.id_cat JOIN produits ON id_produit=id_prod WHERE id_produit=N;*/

