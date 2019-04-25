INSERT INTO "User"(nom, prenom, pseudo, mdp, mail, nb_livres_empruntes) VALUES ('Charles', 'Tanguy', 'Ansyth', '0', '0','7');
INSERT INTO "User"(nom, prenom, pseudo, mdp, mail, nb_livres_empruntes, nb_livres_rendus) VALUES ('Fleurance', 'Paul', 'Deluxe', '0', '0', '2', '0');
INSERT INTO "User"(nom, prenom, pseudo, mdp, mail, nb_livres_empruntes, nb_livres_rendus) VALUES ('Fourcade', 'Louis', 'Gofer', '0', '0', '0', '0');
INSERT INTO "User"(nom, prenom, pseudo, mdp, mail, nb_livres_empruntes, nb_livres_rendus) VALUES ('Gauthier', 'Louis', 'Ofeeling', '0', '0', '0', '0');


INSERT INTO "Livre"(id_livre, titre, publication) VALUES('chocapic1', 'titre1', '2012-12-12');
UPDATE "Livre" 
SET emprunteur = '1'
WHERE id_livre = 'chocapic1';
UPDATE "User" 
SET nb_livres_empruntes = nb_livres_empruntes + 99
WHERE id_user = '1';
UPDATE "Livre" 
SET emprunteur = NULL
WHERE id_livre = 'chocapic1';