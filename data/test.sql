INSERT INTO "User"(nom, prenom, pseudo, mdp, mail, nb_livres_empruntes, est_admin) VALUES ('Charles', 'Tanguy', 'Ansyth', '$2y$10$5IKRZ9DBUX4tBy93jhKk6.w/uMrL8hwjzS/w/DbFx.WRLHzwPBNGO', 'tanguy.charles@ensiie.fr','7', 'true');
INSERT INTO "User"(nom, prenom, pseudo, mdp, mail, nb_livres_empruntes, nb_livres_rendus) VALUES ('Fleurance', 'Paul', 'Deluxe', '$2y$10$MuUsTZFuEKeXoViyIrU/JOEHa8SoOlSCNFrNO40zqAcJsCEKK4ehK', 'paul.fleurance@ensiie.fr', '2', '0');
INSERT INTO "User"(nom, prenom, pseudo, mdp, mail, nb_livres_empruntes, nb_livres_rendus, est_admin) VALUES ('Fourcade', 'Louis', 'Gofer', '$2y$10$MuUsTZFuEKeXoViyIrU/JOEHa8SoOlSCNFrNO40zqAcJsCEKK4ehK', 'louis.fourcade@ensiie.fr', '0', '0', 'true');
INSERT INTO "User"(nom, prenom, pseudo, mdp, mail, nb_livres_empruntes, nb_livres_rendus) VALUES ('Gauthier', 'Louis', 'Ofeeling', '$2y$10$MuUsTZFuEKeXoViyIrU/JOEHa8SoOlSCNFrNO40zqAcJsCEKK4ehK', 'louis.gauthier@ensiie.fr', '0', '0');
INSERT INTO "User"(nom, prenom, pseudo, mdp, mail, nb_livres_empruntes, nb_livres_rendus) VALUES ('Banner', 'Bruce', 'Hulk', '$2y$10$MuUsTZFuEKeXoViyIrU/JOEHa8SoOlSCNFrNO40zqAcJsCEKK4ehK', 'bruce.banner@marvel.com', '0', '0');
INSERT INTO "User"(nom, prenom, pseudo, mdp, mail, nb_livres_empruntes, nb_livres_rendus) VALUES ('Wayne', 'Bruce', 'Batman', '$2y$10$MuUsTZFuEKeXoViyIrU/JOEHa8SoOlSCNFrNO40zqAcJsCEKK4ehK', 'bruce.wayne@dc.com', '0', '0');
INSERT INTO "User"(nom, prenom, pseudo, mdp, mail, nb_livres_empruntes, nb_livres_rendus) VALUES ('Parker', 'Peter', 'Spiderman', '$2y$10$MuUsTZFuEKeXoViyIrU/JOEHa8SoOlSCNFrNO40zqAcJsCEKK4ehK', 'peter.parker@sony.com', '0', '0');
INSERT INTO "User"(nom, prenom, pseudo, mdp, mail, nb_livres_empruntes, nb_livres_rendus) VALUES ('Stark', 'Tony', 'Ironman', '$2y$10$MuUsTZFuEKeXoViyIrU/JOEHa8SoOlSCNFrNO40zqAcJsCEKK4ehK', 'tony.stark@marvel.com', '0', '0');
INSERT INTO "User"(nom, prenom, pseudo, mdp, mail, nb_livres_empruntes, nb_livres_rendus) VALUES ('Parr', 'Robert', 'MrIndestructible', '$2y$10$MuUsTZFuEKeXoViyIrU/JOEHa8SoOlSCNFrNO40zqAcJsCEKK4ehK', 'robert.parr@pixar.com', '0', '0');
INSERT INTO "User"(nom, prenom, pseudo, mdp, mail, nb_livres_empruntes, nb_livres_rendus) VALUES ('Parr', 'Helene', 'Elastigirl', '$2y$10$MuUsTZFuEKeXoViyIrU/JOEHa8SoOlSCNFrNO40zqAcJsCEKK4ehK', 'helene.parr@pixar.com', '0', '0');
INSERT INTO "User"(nom, prenom, pseudo, mdp, mail, nb_livres_empruntes, nb_livres_rendus) VALUES ('Parr', 'JackJack', 'JackJack', '$2y$10$MuUsTZFuEKeXoViyIrU/JOEHa8SoOlSCNFrNO40zqAcJsCEKK4ehK', 'adressedemerde.lol@disney.com', '0', '0');







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

INSERT INTO "Livre"(id_livre, titre, auteur, publication, couverture, editeur) VALUES ('9', 'Autobiographie scientifique', 'Max Planck', '2010-1-1', './cvlivres/Autobiographie-scientifique.jpg', 'Flammarion');
INSERT INTO "Auteur"(id_livre, auteur) VALUES ('9', 'Max Planck');

INSERT INTO "Livre"(id_livre, titre, auteur, publication, couverture, editeur) VALUES ('10', 'Le Beau Livre de la Physique', 'Clifford A. Pickover', '2012-3-10', './cvlivres/LBL.jpg', 'Dunod');
INSERT INTO "Auteur"(id_livre, auteur) VALUES ('10', 'Clifford A. Pickover');

INSERT INTO "Livre"(id_livre, titre, auteur, publication, couverture, editeur) VALUES ('11', 'Une brève histoire du temps', 'Stephen Hawking', '2018-5-4', './cvlivres/BHT.jpg', 'Edilivres');
INSERT INTO "Auteur"(id_livre, auteur) VALUES ('11', 'Stephen Hawking');







UPDATE "Livre" SET emprunteur='7', date_emprunt='2019-4-15' WHERE id_livre='9';
UPDATE "Livre" SET emprunteur='8', date_emprunt='2019-5-1' WHERE id_livre='10';
UPDATE "Livre" SET emprunteur='9', date_emprunt='2018-12-15' WHERE id_livre='11';


