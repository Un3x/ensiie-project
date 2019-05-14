CREATE TABLE "user2" (
    id SERIAL PRIMARY KEY ,
    fname VARCHAR NOT NULL UNIQUE ,
    falimen VARCHAR NOT NULL

);

INSERT INTO "user2"(fname,falimen) VALUES ('SuChips', 'Normal');
INSERT INTO "user2"(fname,falimen) VALUES ('Zoé','Hallal');
INSERT INTO "user2"(fname,falimen) VALUES ('Sophie', 'Vegan');