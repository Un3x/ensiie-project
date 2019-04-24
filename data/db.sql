CREATE TABLE "member" (
    id SERIAL PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    searchUser boolean not null default false,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(40) NOT NULL,
    admin boolean not null default false,
    banned boolean not null default false
);
INSERT INTO "member"(firstname, lastname, email, password, admin, banned) VALUES ('John', 'Doe', 'ammar.moizaly@ensiie.fr', 'ammarammar', false, false);

create table "chat" (
  id SERIAL PRIMARY KEY,
  member1 integer references member(id),
  member2 integer references member(id),
  startDate timestamp
);

create table "message" (
  id SERIAL PRIMARY KEY,
  sender integer references member(id),
  chat integer references chat(id),
  sendTime timestamp not null,
  message VARCHAR(255) NOT NULL DEFAULT ''
);

/*
CREATE TABLE "user" (
    id SERIAL PRIMARY KEY ,
    firstname VARCHAR NOT NULL ,
    lastname VARCHAR NOT NULL ,
    birthday date
);*/

/*INSERT INTO "user"(firstname, lastname, birthday) VALUES ('John', 'Doe', '1967-11-22');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Yvette', 'Angel', '1932-01-24');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Amelia', 'Waters', '1981-12-01');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Manuel', 'Holloway', '1979-07-25');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Alonzo', 'Erickson', '1947-11-13');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Otis', 'Roberson', '1995-01-09');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Jaime', 'King', '1924-05-30');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Vicky', 'Pearson', '1982-12-12)');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Silvia', 'Mcguire', '1971-03-02');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Brendan', 'Pena', '1950-02-17');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Jackie', 'Cohen', '1967-01-27');
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Delores', 'Williamson', '1961-07-19');*/