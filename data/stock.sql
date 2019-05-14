CREATE TABLE "stock" (
    id SERIAL PRIMARY KEY ,
    surnom VARCHAR NOT NULL ,
    ingrediant VARCHAR NOT NULL ,
    qte INTEGER NOT NULL ,
    expiration date ,
    UNIQUE(ingrediant, surnom)
);

INSERT INTO "stock"(surnom, ingrediant, qte, expiration) VALUES ('Sophie', 'Salade', '2', '1999-12-31');
INSERT INTO "stock"(surnom, ingrediant, qte, expiration) VALUES ('SuChips', 'Tomate', '1', '2019-04-24');