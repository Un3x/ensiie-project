CREATE TABLE "member" (
    id SERIAL PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    /*searchUser boolean not null default false,*/
    email VARCHAR(255) NOT NULL,
    password VARCHAR(40) NOT NULL,
    admin boolean not null default false,
    banned boolean not null default false
);
INSERT INTO "member"(firstname, lastname, email, password) VALUES ('Ammar', 'Moizaly', 'ammar.moizaly@ensiie.fr', 'ammarammar');
INSERT INTO "member"(firstname, lastname, email, password) VALUES ('Mehdi', 'Abdallaoui', 'mehdi.abdallaoui@ensiie.fr', 'mehdimehdi');
INSERT INTO "member"(firstname, lastname, email, password, admin) VALUES ('prénomAdmin', 'nomAdmin', 'test.test@ensiie.fr', 'testtest', true);

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

/*The two tables below will be used for the feature of chatrooms we are working on since there will be several users belonging to different chatrooms*/
/*create table "chatRoom" (
    id SERIAL PRIMARY KEY,
    chatRoomName VARCHAR(30) NOT NULL,
    member integer references member(id)
);*/

/*
CREATE TABLE "user" (
    id SERIAL PRIMARY KEY ,
    firstname VARCHAR NOT NULL ,
    lastname VARCHAR NOT NULL ,
    birthday date
);*/