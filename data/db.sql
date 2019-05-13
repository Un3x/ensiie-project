DROP TABLE IF EXISTS "utilisateur" CASCADE;
DROP TABLE IF EXISTS "photo" CASCADE;
DROP TABLE IF EXISTS "produits" CASCADE;
DROP TABLE IF EXISTS "categorie" CASCADE;
DROP TABLE IF EXISTS "assoc_prd_cat" CASCADE;
DROP TABLE IF EXISTS "message" CASCADE;

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

CREATE TABLE "message"(
    id_mess INTEGER,
    titre VARCHAR,
    contenu VARCHAR,
    mail VARCHAR,
    valid INTEGER, /*0 si pas traité 1 si traité 2 si supprimé*/
    id_admin VARCHAR,
    CONSTRAINT key_mess PRIMARY KEY (id_mess)
);


CREATE TABLE "assoc_prd_cat"(
    id_cat INTEGER REFERENCES categorie(id_cat),
    id_prod INTEGER REFERENCES produits(id_produit),
    CONSTRAINT key_assoc_prd_cat PRIMARY KEY (id_cat,id_prod)
    /*CONSTRAINT fk_cat FOREIGN KEY (id_cat) REFERENCES categorie(id_cat)*/
);

INSERT INTO "photo" (id_photo,extension) VALUES (0,'png');
INSERT INTO "photo" (id_photo,extension) VALUES (1,'JPG');
INSERT INTO "photo" (id_photo,extension) VALUES (2,'jpg');
INSERT INTO "photo" (id_photo,extension) VALUES (3,'png');
INSERT INTO "photo" (id_photo,extension) VALUES (4,'jpg');
INSERT INTO "photo" (id_photo,extension) VALUES (5,'jpg');
INSERT INTO "photo" (id_photo,extension) VALUES (6,'jpg');
INSERT INTO "photo" (id_photo,extension) VALUES (7,'jpg');
INSERT INTO "photo" (id_photo,extension) VALUES (8,'jpg');
INSERT INTO "photo" (id_photo,extension) VALUES (9,'jpg');
INSERT INTO "photo" (id_photo,extension) VALUES (10,'jpg');
INSERT INTO "photo" (id_photo,extension) VALUES (11,'jpg');
INSERT INTO "photo" (id_photo,extension) VALUES (12,'jpg');
INSERT INTO "photo" (id_photo,extension) VALUES (13,'jpg');
INSERT INTO "photo" (id_photo,extension) VALUES (14,'jpg');
INSERT INTO "photo" (id_photo,extension) VALUES (15,'jpg');
INSERT INTO "photo" (id_photo,extension) VALUES (16,'jpg');
INSERT INTO "photo" (id_photo,extension) VALUES (17,'jpg');
INSERT INTO "photo" (id_photo,extension) VALUES (18,'jpg');
INSERT INTO "photo" (id_photo,extension) VALUES (19,'jpg');
INSERT INTO "photo" (id_photo,extension) VALUES (20,'JPG');
INSERT INTO "photo" (id_photo,extension) VALUES (21,'JPG');
INSERT INTO "photo" (id_photo,extension) VALUES (22,'JPG');
INSERT INTO "photo" (id_photo,extension) VALUES (23,'jpg');
INSERT INTO "photo" (id_photo,extension) VALUES (24,'jpg');
INSERT INTO "photo" (id_photo,extension) VALUES (25,'jpg');
INSERT INTO "photo" (id_photo,extension) VALUES (26,'jpg');
INSERT INTO "photo" (id_photo,extension) VALUES (27,'jpg');
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
INSERT INTO "categorie"(id_cat,nom_cat, link) VALUES(10,'Sport','sport.php');
INSERT INTO "categorie"(id_cat,nom_cat, link) VALUES(11,'BONS PLANS','bonsplans.php');
INSERT INTO "produits"(id_produit,date_publi,id_proprio,descript,title,price,photo1,photo2,photo3,valide) VALUES (0,'2019-04-30','matth91000','Trotinette en très bon état','XIAOMI M365',365,4,3,3,1);
INSERT INTO "produits"(id_produit,date_publi,id_proprio,descript,title,price,photo1,photo2,photo3,valide) VALUES (1,'2019-05-08','hugo91600','Revend cette voiture tunning car je veux en tunner une autre','Voiture tunning',3000,5,3,3,0);
INSERT INTO "produits"(id_produit,date_publi,id_proprio,descript,title,price,photo1,photo2,photo3,valide) VALUES (2,'2019-04-30','matth91000','Je quitte mon appartement et mes meubles sont dans un sale état mais ca peut toujours interessé qqun','Vide appart',0,3,3,3,1);
INSERT INTO "produits"(id_produit,date_publi,id_proprio,descript,title,price,photo1,photo2,photo3,valide) VALUES (3,'2019-05-02','hugo91600','Super montre trop belle ! Elle est noir, c est une Casio G-SHOCK. Pile d origine','Montre Casio G-SHOCK',35,6,7,8,1);
INSERT INTO "produits"(id_produit,date_publi,id_proprio,descript,title,price,photo1,photo2,photo3,valide) VALUES (4,'2019-05-05','hugo91600','iPhone 6s gris 64go. Comme neuf. garantit. Facutre datée de 2016. Prix FIXE.','iPhone 6s 64go gris',300,9,10,11,1);
INSERT INTO "produits"(id_produit,date_publi,id_proprio,descript,title,price,photo1,photo2,photo3,valide) VALUES (5,'2019-05-07','matth91000','Lave vaisselle d une super marque. Bien utilisé, mais fonctionne toujours très bien. Pas d envoi, à venir chercher.','Lave vaisselle',200,12,13,14,1);
INSERT INTO "produits"(id_produit,date_publi,id_proprio,descript,title,price,photo1,photo2,photo3,valide) VALUES (6,'2019-05-07','hugo91600','Mezzanine 2 places, en metal grise. 2m50. Ideal pour un ado avec une petite chambre ou pour un étudiant.','Mezzanine 2 places',90,20,21,22,1);
INSERT INTO "produits"(id_produit,date_publi,id_proprio,descript,title,price,photo1,photo2,photo3,valide) VALUES (7,'2019-05-10','matth91000','Tournevis multi fonction ! 30 pas de vis différent ! vraiment super bon plan !','Tournevis',10,15,16,17,0);
INSERT INTO "produits"(id_produit,date_publi,id_proprio,descript,title,price,photo1,photo2,photo3,valide) VALUES (8,'2019-05-13','matth91000','Jolie armoire blanche ne bois. Elle dispose de plusieurs rangement très spacieux. TIP TOP','Armoire IKEA',40,18,19,3,1);
INSERT INTO "produits"(id_produit,date_publi,id_proprio,descript,title,price,photo1,photo2,photo3,valide) VALUES (9,'2019-05-13','hugo91600','Jolie bagnole. Toyota Supra orange, légèrement modifiée. Assurable chez tout bon assureur, pas de souci. Elle va très vite.','Voiture Toyota Supra',30000,23,24,25,1);
INSERT INTO "produits"(id_produit,date_publi,id_proprio,descript,title,price,photo1,photo2,photo3,valide) VALUES (10,'2019-05-14','matth91000','Donne cours de WEB et BD pour les élèves en S1 qui auraient du mal avec ces matières','Cours WEB et BD',0,3,3,3,1);
INSERT INTO "produits"(id_produit,date_publi,id_proprio,descript,title,price,photo1,photo2,photo3,valide) VALUES (11,'2019-05-14','hugo91600','C est ma dernière année à l ENSIIE. Donc je propose de revendre mon studio à un nouvel élève. Il est en plein centre d Evry, idéal pour aller en cours.','Studio',150000,26,3,3,1);
INSERT INTO "assoc_prd_cat" (id_cat,id_prod) VALUES (6,0);
INSERT INTO "assoc_prd_cat" (id_cat,id_prod) VALUES (1,0);
INSERT INTO "assoc_prd_cat" (id_cat,id_prod) VALUES (1,1);
INSERT INTO "assoc_prd_cat" (id_cat,id_prod) VALUES (6,1);
INSERT INTO "assoc_prd_cat" (id_cat,id_prod) VALUES (10,1);
INSERT INTO "assoc_prd_cat" (id_cat,id_prod) VALUES (3,2);
INSERT INTO "assoc_prd_cat" (id_cat,id_prod) VALUES (11,2);
INSERT INTO "assoc_prd_cat" (id_cat,id_prod) VALUES (4,3);
INSERT INTO "assoc_prd_cat" (id_cat,id_prod) VALUES (10,3);
INSERT INTO "assoc_prd_cat" (id_cat,id_prod) VALUES (5,4);
INSERT INTO "assoc_prd_cat" (id_cat,id_prod) VALUES (3,5);
INSERT INTO "assoc_prd_cat" (id_cat,id_prod) VALUES (3,6);
INSERT INTO "assoc_prd_cat" (id_cat,id_prod) VALUES (7,7);
INSERT INTO "assoc_prd_cat" (id_cat,id_prod) VALUES (3,7);
INSERT INTO "assoc_prd_cat" (id_cat,id_prod) VALUES (3,8);
INSERT INTO "assoc_prd_cat" (id_cat,id_prod) VALUES (1,9);
INSERT INTO "assoc_prd_cat" (id_cat,id_prod) VALUES (10,9);
INSERT INTO "assoc_prd_cat" (id_cat,id_prod) VALUES (6,9);
INSERT INTO "assoc_prd_cat" (id_cat,id_prod) VALUES (8,10);
INSERT INTO "assoc_prd_cat" (id_cat,id_prod) VALUES (2,11);
INSERT INTO "message" (id_mess,titre,contenu,mail,valid) VALUES (0,'Petit message','Je suis très content de votre travail','matthieu.gosset@yahoo.fr',0);

