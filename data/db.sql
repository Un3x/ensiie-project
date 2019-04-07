/* Example
CREATE TABLE "user" (
    id SERIAL PRIMARY KEY ,
    firstname VARCHAR NOT NULL ,
    lastname VARCHAR NOT NULL ,
    birthday date
);

INSERT INTO "user"(firstname, lastname, birthday) VALUES ('John', 'Doe', '1967-11-22');
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
INSERT INTO "user"(firstname, lastname, birthday) VALUES ('Delores', 'Williamson', '1961-07-19');
*/

create table users (
	id_user serial primary key,
	firstname varchar not null,
	lastname varchar not null,
	pseudo varchar not null,
	year int not null,
	role varchar 
);

create table associations (
	id_asso serial primary key,
	name varchar not null,
	president int references users(id_user)
);

create table events (
	id_event serial primary key,
	name varchar not null,
	association int references associations(id_asso),
	coeff int not null check (coeff<=1 and coeff>0)
);

create table score (
	id_user int references users(id_user),
	id_event int references events(id_event),
	notation int not null check(notation<=10 and notation>0),
	primary key (id_user,id_event)
);


create table pointsassos (
	id_user int references users(id_user),
	id_asso int references associations(id_asso),
	notation int not null check(notation<=10 and notation>0),
	proposition int not null check(proposition<=10 and notation>0),
	primary key (id_user,id_asso)
);


insert into users (firstname,lastname,pseudo,year) values ('Loïc','Dubard','Wikle','2018');
insert into users(firstname,lastname,pseudo,year) values ('Quentin','Japhet','Samuh','2018');
insert into associations(name,president) values ('Securitiie',1);
insert into events(name,association,coeff) values ('reu',1,1); 
insert into score(id_user,id_event,notation) values (1,1,10);
insert into pointsassos(id_user,id_asso,notation,proposition) values (1,1,9,10);

/*pour q'un élève consulte ses points asso : 
select name,notation from (pointsassos join associations using (id_asso)) where iduser=$iduser; --par assos
select name,association,notation from (score natural join events using (id_event) join associations using (id_asso)) where iduser=$iduser; --par evenements
*/

/*pour qu'un élève modifie sa participation a un évènement
 
 */
