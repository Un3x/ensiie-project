CREATE TABLE "user1" (
    id SERIAL PRIMARY KEY ,
    surnom VARCHAR NOT NULL UNIQUE ,
    mdp VARCHAR NOT NULL ,
    role VARCHAR NOT NULL ,
    regime VARCHAR NOT NULL
);

INSERT INTO "user1"(surnom, mdp, role, regime) VALUES ('SuChips', 'SuChips', 'Administrateur', 'Normal');
INSERT INTO "user1"(surnom, mdp, role, regime) VALUES ('Zoé', 'Zoé', 'Iien', 'Hallal');
INSERT INTO "user1"(surnom, mdp, role, regime) VALUES ('Sophie', 'Sophie', 'Cuisinier', 'Vegan');
