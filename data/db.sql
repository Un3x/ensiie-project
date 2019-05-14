DROP TABLE "membres";
DROP TABLE "reponses";
DROP TABLE "nathane_citations";
DROP TABLE "aime_commentaires";
DROP TABLE "actualite";

CREATE TABLE "membres" (
pseudo VARCHAR(30) PRIMARY KEY ,
mdp VARCHAR(30),
prenom VARCHAR(30) NOT NULL ,
nom VARCHAR(30) NOT NULL ,
statut CHAR(1),
mail VARCHAR(50)
);

INSERT INTO "membres"(pseudo,mdp,prenom,nom,statut,mail) VALUES ('Gohan','0000','Louis','Caillé','M','louis.caille@ensiie.fr');
INSERT INTO "membres"(pseudo,mdp,prenom,nom,statut,mail) VALUES ('Gus','1111','Florence','Tsai','M','florence.tsai@ensiie.fr');
INSERT INTO "membres"(pseudo,mdp,prenom,nom,statut,mail) VALUES ('Nathaniie','2222','Nathane','Benchetrit','M','nathane.benchetrit@ensiie.fr');
INSERT INTO "membres"(pseudo,mdp,prenom,nom,statut,mail) VALUES ('Hugzer','3333','Hugo','Sellambin Andiapin','M','hugo.sellambin@ensiie.fr');
INSERT INTO "membres"(pseudo,mdp,prenom,nom,statut,mail) VALUES ('Madame','4444','Aimé','Rousset','M','aime.rousset@ensiie.fr');
INSERT INTO "membres"(pseudo,mdp,prenom,nom,statut,mail) VALUES ('Panier','5555','Imane','Alla','V','imane.alla@ensiie.fr');
INSERT INTO "membres"(pseudo,mdp,prenom,nom,statut,mail) VALUES ('Robby','6666','Robert','Marlo','V','robert.marlot@orange.fr');
INSERT INTO "membres"(pseudo,mdp,prenom,nom,statut,mail) VALUES ('Poppins','7777','Marie','Dupont','V','marie.dupont@orange.fr');
INSERT INTO "membres"(pseudo,mdp,prenom,nom,statut,mail) VALUES ('Goat','8888','Dimitri','Jossi','V','dim.jossi@gmail.com');
INSERT INTO "membres"(pseudo,mdp,prenom,nom,statut,mail) VALUES ('Bleu','9999','Sacha','Palette','V','sacha.palette@hotmail.fr');


CREATE TABLE "reponses" (
    pseudo VARCHAR(30) PRIMARY KEY,
    un CHAR(1),
    deux CHAR(1),
    trois CHAR(1),
    quatre CHAR(1),
    cinq CHAR(1),
    six CHAR(1),
    sept CHAR(1),
    huit CHAR(1),
    neuf CHAR(1),
    dix CHAR(1)
);
INSERT INTO "reponses" (pseudo,un,deux,trois,quatre,cinq,six,sept,huit,neuf,dix) VALUES ('Panier','A','A','F','N','A','F','H','H','L','A');
INSERT INTO "reponses" (pseudo,un,deux,trois,quatre,cinq,six,sept,huit,neuf,dix) VALUES ('Robby','F','N','A','N','L','L','H','F','L','L');
INSERT INTO "reponses" (pseudo,un,deux,trois,quatre,cinq,six,sept,huit,neuf,dix) VALUES ('Bleu','A','H','H','N','F','L','A','H','H','H');



CREATE TABLE "nathane_citations" (
nombre INTEGER PRIMARY KEY,
citation VARCHAR(100) NOT NULL
);
INSERT INTO "nathane_citations" ( nombre, citation) VALUES (1, 'On avance a vitesse TGV');
INSERT INTO "nathane_citations" ( nombre, citation) VALUES (2, 'Il ne faut pas acheter un ours avant de l''avoir tuer');
INSERT INTO "nathane_citations" ( nombre, citation) VALUES (3, 'Marilyn poppins');
INSERT INTO "nathane_citations" ( nombre, citation) VALUES (4, 'lire entre les vignes');
INSERT INTO "nathane_citations" ( nombre, citation) VALUES (5, 'Je met faim au game');
INSERT INTO "nathane_citations" ( nombre, citation) VALUES (6, 'Au petit bonheur la chambre');
INSERT INTO "nathane_citations" ( nombre, citation) VALUES (7, 'Briller de milles et une nuits');
INSERT INTO "nathane_citations" ( nombre, citation) VALUES (8, 'Sucre d''ogre');
INSERT INTO "nathane_citations" ( nombre, citation) VALUES (9, 'Voir plus loin que le milieu de la figure');
INSERT INTO "nathane_citations" ( nombre, citation) VALUES (10, 'C''est pas tomber dans l''oeil d''un sourd');
INSERT INTO "nathane_citations" ( nombre, citation) VALUES (11, '2euros pour le prix d''un');
INSERT INTO "nathane_citations" ( nombre, citation) VALUES (12, 'Je lis en toi comme dans un lit couvert');
INSERT INTO "nathane_citations" ( nombre, citation) VALUES (13, 'Au bord du gauffre');
INSERT INTO "nathane_citations" ( nombre, citation) VALUES (14, 'Je m''interroge à ta vie');
INSERT INTO "nathane_citations" ( nombre, citation) VALUES (15, 'Je suis dans le roussignol');
INSERT INTO "nathane_citations" ( nombre, citation) VALUES (16, 'T''es gros comme trois pommes');
INSERT INTO "nathane_citations" ( nombre, citation) VALUES (17, 'Je vous avais prévu');
INSERT INTO "nathane_citations" ( nombre, citation) VALUES (18, 'Je m''enmelles les pincettes');
INSERT INTO "nathane_citations" ( nombre, citation) VALUES (19, 'Panique à babord');
INSERT INTO "nathane_citations" ( nombre, citation) VALUES (20, 'Qui fait le lapin tombe dans le ravin');

CREATE TABLE "aime_commentaires" (
    pseudo VARCHAR(30) PRIMARY KEY,
    plage VARCHAR(200),
    metisse VARCHAR(200),
    chocolat VARCHAR(200),
    vans VARCHAR(200),
    cocktail VARCHAR(200),
    chat VARCHAR(200),
    blanche VARCHAR(200),
    hamburger VARCHAR(200),
    voiture VARCHAR(200),
    om VARCHAR(200)
);

INSERT INTO "aime_commentaires" (pseudo,plage,metisse,chocolat,vans,cocktail,chat,blanche,hamburger,voiture,om) VALUES ('Robby','Magnifique','Je suis in love','Écoeurant','Je préfère les nike','Sans alcool !','Miaou','Métisses > blanches','Miam','Vroum','Paris Paris on ...');
INSERT INTO "aime_commentaires" (pseudo,plage,metisse,chocolat,vans,cocktail,chat,blanche,hamburger,voiture,om) VALUES ('Gohan','Je préfère la montagne et la neige','On te reconnait bien là Aimé','Rien de mieux que des kinder','Sympa pour l''été','Avec de la grenadine et du jus d''orange c''est pas mal','Mon chat s''appelle Mew','Plûtot mignonne','Faut pas oublier le bacon','Ma mazda roule aussi bien','Suis un vrai sport comme la natation au lieu de ça');

CREATE TABLE "actualite" (
    actu VARCHAR(100)
);

INSERT INTO "actualite" (actu) VALUES ('Nathane recherche un stage');
INSERT INTO "actualite" (actu) VALUES ('Bon ramadan à tous !');
INSERT INTO "actualite" (actu) VALUES ('Aimé recherche une conquête (appelez le 06 32 64 35 12)');
INSERT INTO "actualite" (actu) VALUES ('Gus n''a pas de vie');