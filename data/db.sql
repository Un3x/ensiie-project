--
-- Table of users
-- TODO : unicite mail
-- mdp : hash md5 'admin'
--

CREATE TABLE "user" (
    id SERIAL PRIMARY KEY ,
    firstname VARCHAR NOT NULL ,
    lastname VARCHAR NOT NULL ,
    signupdate date,
    mailaddress VARCHAR NOT NULL,
    passwd VARCHAR NOT NULL,
    activcode VARCHAR NOT NULL
);

INSERT INTO "user"(firstname, lastname, signupdate, mailaddress, passwd, activcode) 
    VALUES ('Amine', 'Ladmine', '2000-01-01', 'xxaminedu69xx@gmail.com','21232f297a57a5a743894a0e4a801fc3','1');