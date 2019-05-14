CREATE TABLE utilisateur(
	id_pseudo VARCHAR PRIMARY KEY,
	prenom VARCHAR NOT NULL,
	nom VARCHAR NOT NULL,
	mail VARCHAR NOT NULL,
	pswd VARCHAR NOT NULL,
	sexe VARCHAR NOT NULL,
	birthdate DATE NOT NULL,
	isAdmin BOOLEAN
);


CREATE TABLE compte(
	id_pseudo_compte VARCHAR PRIMARY KEY,
	point_fort VARCHAR,
	CONSTRAINT fk_id_pseudo FOREIGN KEY (id_pseudo_compte) REFERENCES utilisateur(id_pseudo)
);



CREATE TABLE aide(
	id_aide SERIAL PRIMARY KEY,
	pseudo_aide VARCHAR,
	pseudo_aidant VARCHAR,
	aide_matiere VARCHAR NOT NULL,
	valide BOOLEAN,
	jour DATE, 
	heure VARCHAR,
	numtel VARCHAR,
	CONSTRAINT fk_aide FOREIGN KEY (pseudo_aide) REFERENCES compte(id_pseudo_compte)
);