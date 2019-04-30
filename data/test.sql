INSERT INTO "User"(nom, prenom, pseudo, mdp, mail, nb_livres_empruntes) VALUES ('Charles', 'Tanguy', 'Ansyth', '0', '0','7');
INSERT INTO "User"(nom, prenom, pseudo, mdp, mail, nb_livres_empruntes, nb_livres_rendus) VALUES ('Fleurance', 'Paul', 'Deluxe', '0', '0', '2', '0');
INSERT INTO "User"(nom, prenom, pseudo, mdp, mail, nb_livres_empruntes, nb_livres_rendus, est_admin) VALUES ('Fourcade', 'Louis', 'Gofer', '0', '0', '0', '0', 'true');
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




INSERT INTO "Historique"(id_livre, id_user, date_emprunt, date_rendu) VALUES('chocapic1', '3', '2019-04-01', '2019-04-22');
INSERT INTO "Reservation"(id_livre, id_user) VALUES ('chocapic1', '3');


INSERT INTO "Review"(id, num, personne, texte, note) VALUES ('chocapic1', '4', '3', 'ce livre est vraiment trop bien', '5');





INSERT INTO "Livre"(id_livre, titre, auteur, publication, couverture, editeur) VALUES ('1', 'Formulaire technique de mécanique générale', 'Jacques Muller', '1999-1-1', 'couverture', 'editeur');
INSERT INTO "Auteur"(id_livre, auteur) VALUES ('1', 'Jacques Muller');

INSERT INTO "Livre"(id_livre, titre, auteur, publication, couverture, editeur) VALUES ('2', 'La formule du savoir', 'Lé Nguyên Hoang', '1999-1-1', 'couverture', 'Ecosciences');
INSERT INTO "Auteur"(id_livre, auteur) VALUES ('2', 'Lé Nguyên Hoang');

INSERT INTO "Livre"(id_livre, titre, auteur, publication, couverture, editeur) VALUES ('3', 'Introduction à l’étude des phénomênes économiques', 'François MOREAU', '1999-1-1', 'couverture', 'editeur');
INSERT INTO "Auteur"(id_livre, auteur) VALUES ('3', 'François MOREAU');
INSERT INTO "Auteur"(id_livre, auteur) VALUES ('3', 'Gilles DESVILLES');

INSERT INTO "Livre"(id_livre, titre, auteur, publication, couverture, editeur) VALUES ('4', 'Initiation au microprocessing sym', 'Jean-Claude ARRESTIER', '1999-1-1', 'couverture', 'International Institute of science and technology');
INSERT INTO "Auteur"(id_livre, auteur) VALUES ('4', 'Jean-Claude ARRESTIER');
INSERT INTO "Auteur"(id_livre, auteur) VALUES ('4', 'Alain AUTIN');
INSERT INTO "Auteur"(id_livre, auteur) VALUES ('4', 'Pierre CLAUDÉ');

INSERT INTO "Livre"(id_livre, titre, auteur, publication, couverture, editeur) VALUES ('5', 'Construction mécanique – Tome 1', 'M. Dejans', '1999-1-1', 'couverture', 'Nathan');
INSERT INTO "Auteur"(id_livre, auteur) VALUES ('5', 'M. Dejans');
INSERT INTO "Auteur"(id_livre, auteur) VALUES ('5', 'H. Lehu');
INSERT INTO "Auteur"(id_livre, auteur) VALUES ('5', 'R. Quatremer');
INSERT INTO "Auteur"(id_livre, auteur) VALUES ('5', 'J.-P. Trotignon');

INSERT INTO "Livre"(id_livre, titre, auteur, publication, couverture, editeur) VALUES ('6', 'Guide du technicien en électronique', 'C. Cimelli', '1999-1-1', 'couverture', 'Hachette');
INSERT INTO "Auteur"(id_livre, auteur) VALUES ('6', 'C. Cimelli');
INSERT INTO "Auteur"(id_livre, auteur) VALUES ('6', 'R. Bourgeron');

INSERT INTO "Livre"(id_livre, titre, auteur, publication, couverture, editeur) VALUES ('7', 'Guide du dessinateur industriel', 'A. Chevalier', '1999-1-1', 'couverture', 'Hachette');
INSERT INTO "Auteur"(id_livre, auteur) VALUES ('7', 'A. Chevalier');

INSERT INTO "Livre"(id_livre, titre, auteur, publication, couverture, editeur) VALUES ('8', 'Getting Started with the raisonance 8051 and ST6 Development Kits', 'Revision 1.00', '1999-1-1', 'couverture', 'Raisonance');
INSERT INTO "Auteur"(id_livre, auteur) VALUES ('8', 'Revision 1.00');