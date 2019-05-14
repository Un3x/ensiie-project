CREATE TABLE "soiree" (
    id SERIAL PRIMARY KEY ,
    surnom VARCHAR NOT NULL UNIQUE ,
    present VARCHAR NOT NULL
);

INSERT INTO "soiree"(surnom, present) VALUES ('SuChips', '1');
INSERT INTO "soiree"(surnom, present) VALUES ('Zoé', '0');
INSERT INTO "soiree"(surnom, present) VALUES ('Sophie', '1');