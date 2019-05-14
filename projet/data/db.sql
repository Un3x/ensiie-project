/* à venir
CREATE TABLE "utilisateur" (
    id_utilisateur SERIAL PRIMARY KEY,
    pseudo VARCHAR(15) NOT NULL UNIQUE,
    email VARCHAR(50) NOT NULL UNIQUE,
    mdp VARCHAR(20) NOT NULL,
    img_link VARCHAR,
    localisation VARCHAR
);
*/

CREATE TABLE "posts" (
    id_post SERIAL PRIMARY KEY,
	/*id_utilisateur SERIAL NOT NULL references utilisateur(id_utilisateur),*/
    contenu VARCHAR(5000),
    id_thread INT,
    theme VARCHAR(25) NOT NULL,
    date_send date,
    id_post_avant SERIAL
	/*img_link VARCHAR*/
);

CREATE TABLE "thread" (
	id_thread SERIAL PRIMARY KEY,
	titre VARCHAR(100),
	premier_post SERIAL references posts(id_post),
	theme VARCHAR(25) NOT NULL
);

/* à venir
INSERT INTO "utilisateur"(id_utilisateur, pseudo, email, mdp, img_link, localisation) VALUES (0, 'Peresse', 'peresse@gmail.com', 'peresse', NULL, NULL);
INSERT INTO "utilisateur"(id_utilisateur, pseudo, email, mdp, img_link, localisation) VALUES (1, 'Monnot', 'monnot@gmail.com', 'monnot', NULL, NULL);
INSERT INTO "utilisateur"(id_utilisateur, pseudo, email, mdp, img_link, localisation) VALUES (2, 'Malfoy', 'malfoy@gmail.com', 'malfoy', NULL, NULL);
*/
