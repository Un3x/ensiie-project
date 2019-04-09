DROP TABLE IF EXISTS utilisateur;
DROP TABLE IF EXISTS preformulaire;
DROP TABLE IF EXISTS formulaire;


CREATE TABLE "utilisateur" (
    id INTEGER SERIAL PRIMARY KEY ,
    mail VARCHAR NOT NULL ,
    motPasse VARCHAR NOT NULL ,
);

INSERT INTO "utilisateur"(mail, motPasse) VALUES ('exemple1@gmail.com','azerty');
INSERT INTO "utilisateur"(mail, motPasse) VALUES ('exemple2@yahoo.fr', '1234');
INSERT INTO "utilisateur"(mail, motPasse) VALUES ('exemple3@orange.fr', '0000');
INSERT INTO "utilisateur"(mail, motPasse) VALUES ('exemple4@laposte.net', 'motdepasse');
INSERT INTO "utilisateur"(mail, motPasse) VALUES ('exemple5@ensiie.fr', 'IIEns');
INSERT INTO "utilisateur"(mail, motPasse) VALUES ('exemple6@outlook.com', 'utilisé?');
INSERT INTO "utilisateur"(mail, motPasse) VALUES ('exemple7@pasvalide.abz', 'test');

CREATE TABLE "preformulaire" (
    id INTEGER SERIAL PRIMARY KEY FOREIGN KEY REFERENCES utilisateur(id),
    nomStand VARCHAR NOT NULL ,
    nomResponsable VARCHAR NOT NULL ,
    mailStand VARCHAR NOT NULL ,
    telephone VARCHAR(10) NOT NULL ,
    siteWeb VARCHAR NOT NULL ,
    activité VARCHAR NOT NULL ,
);

CREATE TABLE "formulaire" (
    id INTEGER SERIAL PRIMARY KEY FOREIGN KEY REFERENCES utilisateur(id),
    raisonSociale VARCHAR ,
    siret VARCHAR ,
    president VARCHAR,
    vente INTEGER CHECK(vente=0 OR vente=1) ,
    telephone VARCHAR(10) NOT NULL ,
    siteWeb VARCHAR NOT NULL ,
    activité VARCHAR(3) CHECK(vente='OUI' OR vente='NON') ,
    tables INTEGER DEFAULT 0 ,
    espace VARCHAR ,
    materiel VARCHAR ,
    accesElectrique INTEGER DEFAULT 0 ,
    appareilElectrique VARCHAR ,
    heureDebut TIME DEFAULT 09:00:00 ,
    heureFin TIME DEFAULT 18:00:00 ,
    emplacement VARCHAR ,
    devis INTEGER CHECK(devis=10*vente + MAX(tables-1,0)*5)
);