CREATE TABLE "film" (
                        idfilm serial PRIMARY KEY,
                        titre Varchar NOT NULL,
                        duree integer,
                        description varchar,
                        datesortie date
);
INSERT INTO "film" (titre,duree,description,datesortie) values ('The Shawshank Redemption',142,'un film américain écrit et réalisé par Frank Darabont,Ce film est inspiré du roman court (novella) Rita Hayworth et la Rédemption de Shawshank de Stephen King ','1994-09-10');
INSERT INTO "film" (titre,duree,description,datesortie) values ('Avengers: Endgame',181,'Avengers: Endgame au Québec est un film américain réalisé par Anthony et Joe Russo,. Il met en scène l''équipe de super-héros des comics Marvel,Il s''agit du 22e film de l''Univers cinématographique Marvel, débuté en 2008','2019-04-26');
INSERT INTO "film" (titre,duree,description,datesortie) values ('The Last Castle',132,'Le Dernier Château (The Last Castle) est un film américain réalisé par Rod Lurie , Condamné par la Cour martiale, le général Eugene R. Irwin de l''U.S. Army (Robert Redford) est tenu responsable de la mort de huit soldats. À la suite de cela, il doit purger une peine dans une prison militaire de haute sécurité appelée Le Château. Le Colonel Winter (James Gandolfini)','2001-10-19');
INSERT INTO "film" (titre,duree,description,datesortie) values ('Man of Steel',130,'Man of Steel ou L''Homme d''acier au Québec est un film américano-britannique réalisé par Zack Snyder, écrit par David S. Goyer et produit par Christopher Nolan. Basé sur Superman, personnage de DC Comics, le long-métrage est un reboot qui dépeint les origines du super-héros','2013-06-14');
INSERT INTO "film" (titre,duree,description,datesortie) values ('One Piece : Z',108,'One Piece : Z , est un film réalisé en 2012 par Tatsuya Nagamine.il est le douzième film basé sur la série One Piece d''Eiichirō Oda. En seulement deux jours d''exploitation, il a réalisé le plus grand nombre d''entrées cinéma en un week-end au box-office japonais 2012, en étant le premier film à dépasser le million de spectateurs en si peu de temps (1 140 081)','2013-05-15');

CREATE TABLE "categories" (
                              idcategorie serial  PRIMARY KEY,
                              libelle varchar NOT NULL,
                              description Varchar
);
insert into categories values (1,'Drame','Le drame est un genre cinématographique qui traite des situations généralement non épiques dans un contexte sérieux, sur un ton plus susceptible d''inspirer la tristesse que le rire. Néanmoins, le drame évoque étymologiquement l''action. Il a regagné récemment la popularité dans beaucoup de pays du monde (Prison Break, Dr House)');
insert into categories values (2,'Comédie','La comédie est, au cinéma, un genre cinématographique dont une des caractéristiques majeure est l''humour. ');
insert into categories values (3,'Film d action','Le film d''action est un type de film qui met en scène une succession de scènes spectaculaires souvent stéréotypées (courses-poursuites, fusillades, explosions…) construites autour d''un conflit résolu de manière violente, généralement par la mort des ennemis du héros. ');
insert into categories values (4,'Film fantastique','Le cinéma fantastique est un genre cinématographique regroupant des films faisant appel au surnaturel, à l''horreur, à l''insolite ou aux monstres. L’intrigue se fonde sur des éléments irrationnels, ou irréalistes');
insert into categories values (5,'Film d horreur','Le film d''horreur, ou film d''épouvante, est un genre cinématographique dont l''objectif est de créer un sentiment de peur, de répulsion ou d''angoisse chez le spectateur.');

CREATE TABLE "categorie_film" (
                                  film integer,
                                  categorie integer,
                                  Constraint PK_cf PRIMARY KEY (film,categorie),
                                  Constraint FK_cf1 FOREIGN KEY (film) references film(idfilm),
                                  CONSTRAINT FK_cf2 FOREIGN KEY (categorie) references categories(idcategorie)
);
insert into categorie_film values (5,1);
insert into categorie_film values (5,2);
insert into categorie_film values (4,4);
insert into categorie_film values (2,1);
insert into categorie_film values (2,4);
insert into categorie_film values (3,1);
insert into categorie_film values (1,1);

CREATE TABLE "planing"(
                          nplaning serial PRIMARY KEY,
                          film integer NOT NULL,
                          datejour date NOT NULL,
                          debutheure TIME NOT NULL,
                          finheure TIME NOT NULL,
                          dediesalle integer DEFAULT 0,
                          CONSTRAINT FK_p1 FOREIGN KEY (film) references film(idfilm)
);
insert into planing (film, datejour, debutheure, finheure) values (2,'2019-05-14','12:00','15:05');
insert into planing (film, datejour, debutheure, finheure) values (3,'2019-05-15','12:00','15:05');
insert into planing (film, datejour, debutheure, finheure) values (4,'2019-05-16','12:00','15:05');
insert into planing (film, datejour, debutheure, finheure) values (1,'2019-05-17','12:00','15:05');
insert into planing (film, datejour, debutheure, finheure) values (5,'2019-05-18','12:00','15:05');

CREATE TABLE "compte" (
                          ncompte serial PRIMARY KEY,
                          nomcompte varchar NOT NULL,
                          motpasse varchar NOT NULL,
                          email varchar NOT NULL
);
insert into compte (nomcompte, motpasse, email) values ('Iopterre','123456R','IopTerre@gmail.com');
insert into compte (nomcompte, motpasse, email) values ('Cramulti','123456R','Cramulti@gmail.com');
insert into compte (nomcompte, motpasse, email) values ('Sram','123456R','sram@gmail.com');
CREATE TABLE "clients" (
                           ncompte integer PRIMARY KEY,
                           nom varchar NOT NULL,
                           prenom varchar NOT NULL,
                           datenaissance date NOT NULL,
                           adresse Varchar,
                           CP integer,
                           pays varchar,
                           CONSTRAINT fk_client FOREIGN KEY (ncompte) references compte(ncompte)
);
insert into clients (ncompte,nom, prenom, datenaissance, adresse, CP, pays) values (1,'Colere','Iop','1995-01-01','Habite chez DOFUS',90000,'FRANCE');
CREATE TABLE "admin" (
                         ncompte integer ,
                         nom varchar NOT NULL,
                         prenom varchar NOT NULL,
                         datenaissance date NOT NULL,
                         adresse Varchar,
                         CP integer,
                         pays varchar,
                         CONSTRAINT fk_admin FOREIGN KEY (ncompte) references compte(ncompte),
                         CONSTRAINT PK_admin PRIMARY KEY (ncompte)
);
insert into admin (ncompte,nom,prenom,datenaissance,adresse, CP, pays) values (3,'admin','ADMIN','1997-01-01','Habite chez INCARNAM',91000,'FRANCE');
insert into clients (ncompte,nom,prenom,datenaissance,adresse, CP, pays) values (2,'Fleche','Punitive','1998-01-01','Habite chez BONTA',91000,'FRANCE');

CREATE TABLE "categories_place" (
                                    catplace integer PRIMARY KEY,
                                    prixheure integer
);
insert into categories_place values (1,50);
insert into categories_place values (2,40);
insert into categories_place values (3,40);
insert into categories_place values (4,30);
insert into categories_place values (5,25);
insert into categories_place values (6,25);



CREATE TABLE "fauteuils" (
                             nfauteuil integer PRIMARY KEY,
                             catplace integer,
                             CONSTRAINT fk_fa FOREIGN KEY (catplace) references categories_place(catplace)
);
insert into fauteuils values (1,1);
insert into fauteuils values (2,1);
insert into fauteuils values (3,1);
insert into fauteuils values (4,2);
insert into fauteuils values (5,2);
insert into fauteuils values (6,2);
insert into fauteuils values (7,3);
insert into fauteuils values (8,3);
insert into fauteuils values (9,3);
insert into fauteuils values (10,4);
insert into fauteuils values (11,4);
insert into fauteuils values (12,4);
insert into fauteuils values (13,5);
insert into fauteuils values (14,5);
insert into fauteuils values (15,5);
insert into fauteuils values (16,6);
insert into fauteuils values (17,6);
insert into fauteuils values (18,6);


CREATE TABLE "type_evenement" (
                                  eventtype varchar PRIMARY KEY,
                                  prixheure integer
);
insert into type_evenement Values ('Soirées étudiants',1000);
insert into type_evenement Values ('Soirée enteprise',3000);
insert into type_evenement Values ('Cocktails',2000);
insert into type_evenement Values ('Autre',2000);



CREATE TABLE "reservation_salle" (
                                     nreservation serial PRIMARY KEY,
                                     planing integer NOT NULL UNIQUE,
                                     client integer NOT NULL,
                                     typeevenement varchar NOT NULL,
                                     nomevenement varchar NOT NULL,
                                     CONSTRAINT FK_rs FOREIGN KEY (planing) references planing(nplaning),
                                     CONSTRAINT FK_rs2 FOREIGN KEY (client) references clients(ncompte),
                                     CONSTRAINT FK_rs3 FOREIGN KEY (typeevenement) references type_evenement(eventtype)
);

CREATE TABLE "reservation_place" (
                                     nreservation serial PRIMARY KEY,
                                     planing integer NOT NULL UNIQUE,
                                     client integer NOT NULL,
                                     fauteuil integer NOT NULL,
                                     CONSTRAINT FK_rp FOREIGN KEY (planing) references planing(nplaning),
                                     CONSTRAINT FK_rp2 FOREIGN KEY (client) references clients(ncompte),
                                     CONSTRAINT FK_rp3 FOREIGN KEY (fauteuil) references fauteuils(nfauteuil)
);
insert into reservation_place (planing,client,fauteuil) values (1,2,5);
