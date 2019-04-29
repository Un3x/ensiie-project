DROP TABLE IF EXISTS "user" CASCADE;
DROP TABLE IF EXISTS "utilisateur" CASCADE;
DROP TABLE IF EXISTS "photo_profil" CASCADE;
DROP TABLE IF EXISTS "produits" CASCADE;
DROP TABLE IF EXISTS "categorie" CASCADE;
DROP TABLE IF EXISTS "assoc_prd_cat" CASCADE;

CREATE TABLE "photo_profil"(
    id_photo INTEGER,
    adresse VARCHAR(200) NOT NULL,
    CONSTRAINT key_photopro PRIMARY KEY (id_photo)
);

CREATE TABLE "utilisateur"(
    id VARCHAR(50) NOT NULL,
    firstname VARCHAR(30) NOT NULL ,
    lastname VARCHAR(30) NOT NULL ,
    birthday date,
    loc VARCHAR(100) NOT NULL,
    mail VARCHAR(100) NOT NULL,
    mdp VARCHAR(100),
    photo_id INTEGER REFERENCES photo_profil(id_photo),
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
    CONSTRAINT key_prod PRIMARY KEY (id_produit)
    /*CONSTRAINT fk_proprio FOREIGN KEY (id_proprio) REFERENCES "utilisateur
"(id)*/
);


CREATE TABLE "categorie"(
    id_cat INTEGER,
    nom_cat VARCHAR,
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

INSERT INTO "utilisateur"(id, firstname, lastname, birthday, loc, mail, mdp) VALUES ('hugo91600', 'Hugo', 'Sellambin', '1998-02-27', 'Savigny', 'hugo@gmail.com', 'azerty');
INSERT INTO "utilisateur"(id, firstname, lastname, birthday, loc, mail, mdp) VALUES ('matth91000', 'Matthieu', 'Gosset', '1998-04-25', 'Evry', 'matthieu.gosset@ensiie.fr', '12345678');
INSERT INTO "photo_profil"(id_photo,adresse) VALUES (0,'~/matthieu.gosset/hugo.png');
INSERT INTO "categorie"(id_cat,nom_cat) VALUES(0,'Auto/Moto');
INSERT INTO "categorie"(id_cat,nom_cat) VALUES(1,'Immobilier');
INSERT INTO "categorie"(id_cat,nom_cat) VALUES(2,'Maison');
INSERT INTO "categorie"(id_cat,nom_cat) VALUES(3,'Mode');
INSERT INTO "categorie"(id_cat,nom_cat) VALUES (4,'Multimédia');
INSERT INTO "categorie"(id_cat,nom_cat) VALUES(5,'Loisirs');
INSERT INTO "categorie"(id_cat,nom_cat) VALUES(6,'Matériel Pro');
INSERT INTO "categorie"(id_cat,nom_cat) VALUES(7,'Services');
INSERT INTO "categorie"(id_cat,nom_cat) VALUES(8,'Emploi');
INSERT INTO "categorie"(id_cat,nom_cat) VALUES(9,'BONS PLANS');
INSERT INTO "produits"(id_produit,date_publi,id_proprio,descript,title,price) VALUES (0,'2019-04-30','matth91000','Trotinette en très bon état','XIAOMI M365',40000);
INSERT INTO "produits"(id_produit,date_publi,id_proprio,descript,title,price) VALUES (1,'2019-04-30','matth91000','Cours de maths de première à 1ère année de prépa','Cherche prof particulier mathématiques sur Evry',0);
INSERT INTO "produits"(id_produit,date_publi,id_proprio,descript,title,price) VALUES (2,'2019-04-30','matth91000','Le salon aura lieu le 7 mai prochain. Rémuneration : 200€','Cherche animateur pour salon du jeu vidéo',0);
INSERT INTO "assoc_prd_cat" (id_cat,id_prod) VALUES (5,0);
INSERT INTO "assoc_prd_cat" (id_cat,id_prod) VALUES (0,0);
INSERT INTO "assoc_prd_cat" (id_cat,id_prod) VALUES (7,1);
INSERT INTO "assoc_prd_cat" (id_cat,id_prod) VALUES (8,1);
INSERT INTO "assoc_prd_cat" (id_cat,id_prod) VALUES (5,2);
INSERT INTO "assoc_prd_cat" (id_cat,id_prod) VALUES (8,2);

/*
COMMANDE POUR RECUPERER LES TITRES DES PRODUITS DE CATEGORIE N
SELECT title FROM produits JOIN assoc_prd_cat ON id_produit=id_prod JOIN categorie ON categorie.id_cat=assoc_prd_cat.id_cat WHERE categorie.id_cat=N;

COMMANDE POUR RECUPER LES TITRES DES CATEGORIES DU PRODUIT N
SELECT nom_cat FROM categorie JOIN assoc_prd_cat ON categorie.id_cat=assoc_prd_cat.id_cat JOIN produits ON id_produit=id_prod WHERE id_produit=N;*/

