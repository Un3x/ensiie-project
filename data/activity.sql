CREATE TABLE "activity" (
    id SERIAL PRIMARY KEY ,
    title VARCHAR NOT NULL UNIQUE,
    theday date ,
    place VARCHAR NOT NULL ,
    numberpoeple INTEGER
);

INSERT INTO "activity"(title, theday, place, numberpoeple) VALUES ('Soirée Saint-Valentin', '2019-02-14', 'ENSIIE', '100');