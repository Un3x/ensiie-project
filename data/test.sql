INSERT INTO "User"(nom, prenom, pseudo, mdp, mail, nb_livres_empruntes, est_admin) VALUES ('Charles', 'Tanguy', 'Ansyth', '$2y$10$5IKRZ9DBUX4tBy93jhKk6.w/uMrL8hwjzS/w/DbFx.WRLHzwPBNGO', '0','7', 'true');
INSERT INTO "User"(nom, prenom, pseudo, mdp, mail, nb_livres_empruntes, nb_livres_rendus) VALUES ('Fleurance', 'Paul', 'Deluxe', '$2y$10$MuUsTZFuEKeXoViyIrU/JOEHa8SoOlSCNFrNO40zqAcJsCEKK4ehK', '0', '2', '0');
INSERT INTO "User"(nom, prenom, pseudo, mdp, mail, nb_livres_empruntes, nb_livres_rendus, est_admin) VALUES ('Fourcade', 'Louis', 'Gofer', '$2y$10$MuUsTZFuEKeXoViyIrU/JOEHa8SoOlSCNFrNO40zqAcJsCEKK4ehK', '0', '0', '0', 'true');
INSERT INTO "User"(nom, prenom, pseudo, mdp, mail, nb_livres_empruntes, nb_livres_rendus) VALUES ('Gauthier', 'Louis', 'Ofeeling', '$2y$10$MuUsTZFuEKeXoViyIrU/JOEHa8SoOlSCNFrNO40zqAcJsCEKK4ehK', '0', '0', '0');










INSERT INTO "Historique"(id_livre, id_user, date_emprunt, date_rendu) VALUES('chocapic1', '3', '2019-04-01', '2019-04-22');
INSERT INTO "Reservation"(id_livre, id_user) VALUES ('chocapic1', '3');


INSERT INTO "Review"(id, num, personne, texte, note) VALUES ('chocapic1', '4', '3', 'ce livre est vraiment trop bien', '5');





INSERT INTO "Livre"(id_livre, titre, auteur, publication, couverture, editeur) VALUES ('1', 'Formulaire technique de mécanique générale', 'Jacques Muller', '1996-1-1', './cvlivres/9782853140010_internet_w290.png', 'PAILLART');
INSERT INTO "Auteur"(id_livre, auteur) VALUES ('1', 'Jacques Muller');

INSERT INTO "Livre"(id_livre, titre, auteur, publication, couverture, editeur) VALUES ('2', 'La formule du savoir', 'Lé Nguyên Hoang', '2018-06-14', './cvlivres/xl_9782759822607-FormuleSavoir_couv-sofedis.jpg', 'Ecosciences');
INSERT INTO "Auteur"(id_livre, auteur) VALUES ('2', 'Lé Nguyên Hoang');

INSERT INTO "Livre"(id_livre, titre, auteur, publication, couverture, editeur) VALUES ('3', 'Introduction à l’étude des phénomênes économiques', 'François MOREAU', '1999-1-1', './cvlivres/Introduction_a_l_etude_des_phenomene_economique.jpg', 'editeur');
INSERT INTO "Auteur"(id_livre, auteur) VALUES ('3', 'François MOREAU');
INSERT INTO "Auteur"(id_livre, auteur) VALUES ('3', 'Gilles DESVILLES');

INSERT INTO "Livre"(id_livre, titre, auteur, publication, couverture, editeur) VALUES ('4', 'Initiation au microprocessing sym', 'Jean-Claude ARRESTIER', '1999-1-1', './cvlivres/Initiation_au_microprocessing_SYM.jpg', 'International Institute of science and technology');
INSERT INTO "Auteur"(id_livre, auteur) VALUES ('4', 'Jean-Claude ARRESTIER');
INSERT INTO "Auteur"(id_livre, auteur) VALUES ('4', 'Alain AUTIN');
INSERT INTO "Auteur"(id_livre, auteur) VALUES ('4', 'Pierre CLAUDÉ');

INSERT INTO "Livre"(id_livre, titre, auteur, publication, couverture, editeur) VALUES ('5', 'Construction mécanique – Tome 1', 'M. Dejans', '2006-5-1', './cvlivres/9782091795799.jpg', 'Nathan');
INSERT INTO "Auteur"(id_livre, auteur) VALUES ('5', 'M. Dejans');
INSERT INTO "Auteur"(id_livre, auteur) VALUES ('5', 'H. Lehu');
INSERT INTO "Auteur"(id_livre, auteur) VALUES ('5', 'R. Quatremer');
INSERT INTO "Auteur"(id_livre, auteur) VALUES ('5', 'J.-P. Trotignon');

INSERT INTO "Livre"(id_livre, titre, auteur, publication, couverture, editeur) VALUES ('6', 'Guide du technicien en électronique', 'C. Cimelli', '2007-5-9', './cvlivres/000972379.jpg', 'Hachette');
INSERT INTO "Auteur"(id_livre, auteur) VALUES ('6', 'C. Cimelli');
INSERT INTO "Auteur"(id_livre, auteur) VALUES ('6', 'R. Bourgeron');

INSERT INTO "Livre"(id_livre, titre, auteur, publication, couverture, editeur) VALUES ('7', 'Guide du dessinateur industriel', 'A. Chevalier', '2003-6-25', './cvlivres/515lJficFfL._SX326_BO1,204,203,200_.jpg', 'Hachette');
INSERT INTO "Auteur"(id_livre, auteur) VALUES ('7', 'A. Chevalier');

INSERT INTO "Livre"(id_livre, titre, auteur, publication, couverture, editeur) VALUES ('8', 'Getting Started with the raisonance 8051 and ST6 Development Kits', 'Revision 1.00', '1999-1-1', './cvlivres/Raisonance.jpg', 'Raisonance');
INSERT INTO "Auteur"(id_livre, auteur) VALUES ('8', 'Revision 1.00');