CREATE TABLE "user" (
    idUser SERIAL PRIMARY KEY,
    pseudo VARCHAR NOT NULL,
	firstname VARCHAR NOT NULL ,
    lastname VARCHAR NOT NULL ,
    birthday date,
    mdp VARCHAR NOT NULL
);

CREATE TABLE "logement" (
idLogement SERIAL PRIMARY KEY,
idUser INT,
departement INT,
ville VARCHAR NOT NULL,
nb_places_libres INT,
prix INT,
CONSTRAINT fk_user
	   FOREIGN KEY (idUser)
	   REFERENCES user(idUser)
);

CREATE TABLE "favoris" (
idUser INT,
idLogement INT,
CONSTRAINT fk_user2
	   FOREIGN KEY (idUser)
	   REFERENCES user(idUser),
CONSTRAINT fk_logement
	   FOREIGN KEY (idLogement)
	   REFERENCES logement(idLogement),
PRIMARY KEY (idUser,idLogement)
);


      

INSERT INTO "user"(firstname, lastname, birthday, mdp) VALUES ('John', 'Doe', '1967-11-22','john');
INSERT INTO "user"(firstname, lastname, birthday, mdp) VALUES ('Yvette', 'Angel', '1932-01-24','yvette');
INSERT INTO "user"(firstname, lastname, birthday, mdp) VALUES ('Amelia', 'Waters', '1981-12-01','amelia');
INSERT INTO "user"(firstname, lastname, birthday, mdp) VALUES ('Manuel', 'Holloway', '1979-07-25','manuel');
INSERT INTO "user"(firstname, lastname, birthday, mdp) VALUES ('Alonzo', 'Erickson', '1947-11-13','alonzo');
INSERT INTO "user"(firstname, lastname, birthday, mdp) VALUES ('Otis', 'Roberson', '1995-01-09','otis');
INSERT INTO "user"(firstname, lastname, birthday, mdp) VALUES ('Jaime', 'King', '1924-05-30','jaime');
INSERT INTO "user"(firstname, lastname, birthday, mdp) VALUES ('Vicky', 'Pearson', '1982-12-12)','vicky');
INSERT INTO "user"(firstname, lastname, birthday, mdp) VALUES ('Silvia', 'Mcguire', '1971-03-02','silvia');
INSERT INTO "user"(firstname, lastname, birthday, mdp) VALUES ('Brendan', 'Pena', '1950-02-17','brendan');
INSERT INTO "user"(firstname, lastname, birthday, mdp) VALUES ('Jackie', 'Cohen', '1967-01-27','jackie');
INSERT INTO "user"(firstname, lastname, birthday, mdp) VALUES ('Delores', 'Williamson', '1961-07-19','delores');

INSERT INTO "logement"(idUser, departement, ville, nb_places_libres, prix) VALUES (1, 91 , 'Evry', 2, 400);
INSERT INTO "logement"(idUser, departement, ville, nb_places_libres, prix) VALUES (2, 91 , 'Evry', 1, 500);
INSERT INTO "logement"(idUser, departement, ville, nb_places_libres, prix) VALUES (4, 13 , 'Marseille', 2, 400);
INSERT INTO "logement"(idUser, departement, ville, nb_places_libres, prix) VALUES (34, 13 , 'Marseille', 3, 350);

INSERT INTO "favoris"(idUser, idLogement) VALUES (1,2);



/** DEBUT DES PERMISSIONS */

/** les roles possibles */
CREATE TABLE "role" (
	id		SERIAL	PRIMARY KEY,
	name	VARCHAR	NOT NULL UNIQUE
);

/** les roles associés à un utilisateur */
CREATE TABLE "utilisateur_role" (
	utilisateur_id	INTEGER	NOT NULL,
	FOREIGN KEY (utilisateur_id) REFERENCES user(idUser),
	
	role_id			INTEGER	DEFAULT 1,
	FOREIGN KEY (role_id) REFERENCES role(id),
	
	PRIMARY KEY (utilisateur_id, role_id)
);

/** les permissions */
CREATE TABLE "permission" (
	id 			SERIAL			PRIMARY KEY,
	name		VARCHAR(32)		NOT NULL UNIQUE
);

/** les permissions associés à un role */
CREATE TABLE "role_permission" (
  role_id		INTEGER	NOT NULL,
  FOREIGN KEY (role_id) REFERENCES role(id),

  permission_id	INTEGER	NOT NULL,
  FOREIGN KEY (permission_id) REFERENCES permission(id),
  
  PRIMARY KEY (role_id, permission_id)
);

/** les roles */
INSERT INTO role (name) VALUES ('utilisateur');			/* 1 */
INSERT INTO role (name) VALUES ('moderateur');		/* 2 */
INSERT INTO role (name) VALUES ('administrateur');	/* 3 */

/** les permissions */
INSERT INTO permission (name) VALUES ('create_logement');		/* 1 */
INSERT INTO permission (name) VALUES ('modif_logement');	/* 2 */
INSERT INTO permission (name) VALUES ('create_role');		/* 3 */
INSERT INTO permission (name) VALUES ('delete_role');		/* 4 */
INSERT INTO permission (name) VALUES ('assign_role');		/* 5 */
INSERT INTO permission (name) VALUES ('unassign_role');		/* 6 */
INSERT INTO permission (name) VALUES ('add_permission');	/* 7 */
INSERT INTO permission (name) VALUES ('remove_permission');	/* 8 */

/* utilisateur */
INSERT INTO role_permission (role_id, permission_id) VALUES (1, 1); /* create_logement */
INSERT INTO role_permission (role_id, permission_id) VALUES (1, 1); /* create_logement */

/* modérateur */
INSERT INTO role_permission (role_id, permission_id) VALUES (2, 1); /* create_logement */
INSERT INTO role_permission (role_id, permission_id) VALUES (2, 2); /* modif_logement */

/* administrateur : toutes les permissions */
INSERT INTO role_permission (role_id, permission_id) SELECT 3, id FROM permission ;


/** FIN DES PERMISSIONS */
