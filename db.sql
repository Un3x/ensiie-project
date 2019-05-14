CREATE TABLE Sexe(id INTEGER,genre VARCHAR(50) PRIMARY KEY);

CREATE TABLE Type_jeu(type_jeu VARCHAR(50) PRIMARY KEY);
INSERT INTO Type_jeu VALUES ('Aventure'),('Course'),('FPS'),('Gestion-Wargames'),('MMORPG'), ('Plate-Forme'),('Independant'),('RPG'),('MOBA');

Create table Plateforme (plateforme VARCHAR(50) PRIMARY KEY);
INSERT INTO Plateforme VALUES ('PC'),('Console'),('Smartphone');


CREATE TABLE Individuel (individuel VARCHAR(50) PRIMARY KEY);
INSERT INTO Individuel VALUES ('Natation'),('Athletisme'),('Escrime'),('Tennis'),('Tennis de table'),('Sport de combat'), ('Gymnastique');

CREATE TABLE Collectif (collectif VARCHAR(50) PRIMARY KEY);
INSERT INTO Collectif VALUES ('Football'),('Basketball'),('Handball'),('Volley'),('Hockey'),('Baseball'),('Waterpolo'),('Rugby');


CREATE TABLE Categorie (categorie VARCHAR(50) PRIMARY KEY);
INSERT INTO Categorie VALUES ('Anime'),('Thriller'),('Action'),('Horreur'),('Dessin anime'),('Romantique'),('Policier'),('Western');


CREATE TABLE Genre_litterature(genre_litterature VARCHAR(50) PRIMARY KEY);
INSERT INTO Genre_litterature VALUES ('Thriller'),('Policier'),('Epouvante'),('Historique'),('Fantastique'),('BD'),('Manga');

CREATE TABLE Genre_musical(genre_musical VARCHAR(50) PRIMARY KEY);
INSERT INTO Genre_musical(genre_musical) VALUES ('Classique'),('Hip Hop'),('Rap'),('Rock'),('Jazz'),('Metal'),('Trap'),('House'),('Techno'),('Electro'),('Trance'),('Psytrance'),('Drumandbass');

CREATE TABLE Instrument(instrument VARCHAR(50) PRIMARY KEY);
INSERT INTO Instrument(instrument) VALUES ('Guitare'),('Piano'),('Trompette'),('Saxophone'),('Violon'),('Violoncelle'),('Basse'),('Batterie'),('Flute'),('Guitare electrique');

CREATE TABLE Religion(nom_religion VARCHAR(50) PRIMARY KEY);
INSERT INTO Religion(nom_religion) VALUES ('Catholique'),('Protestant'),('Musulman'),('Juif'),('Hindouiste'),('Athee'),('Agnostique');

CREATE TABLE Regime_alimentaire(nom_regime VARCHAR(50) PRIMARY KEY);
INSERT INTO Regime_alimentaire(nom_regime) VALUES ('Hallal'),('Kasher'),('Sans gluten'),('Vegetarien'),('Vegan'),('Carnivore');

Create table Alcool(nom_alcool VARCHAR(50) PRIMARY KEY);
INSERT INTO Alcool(nom_alcool) VALUES ('Biere'),('Whisky'),('Cidre'),('Vodka'),('Tequila'),('Rhum'),('Jaeger'),('Gin'),('Get27'),('Pastis'),('Vin');




CREATE TABLE Interet(id_personne INTEGER,plateforme VARCHAR(50), type_jeu VARCHAR(50), sport_individuel VARCHAR(50), sport_collectif VARCHAR(50), categorie_film VARCHAR(50), genre_litteraire VARCHAR(50), genre_musical VARCHAR(50), instrument VARCHAR(50), religion VARCHAR(50), regime_alimentaire VARCHAR(50), alcool VARCHAR(50));

CREATE TABLE membres(id_personne INTEGER PRIMARY KEY, pseudo VARCHAR, mail VARCHAR, motdepasse TEXT);

CREATE TABLE Person(nom VARCHAR(50),prenom VARCHAR(50), age INTEGER, id_personne INTEGER PRIMARY KEY,network VARCHAR);