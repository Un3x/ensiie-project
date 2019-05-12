CREATE TABLE Admin 
(
    id SERIAL PRIMARY KEY,
    surname VARCHAR NOT NULL,
    firstname VARCHAR NOT NULL,
    idRace INT NOT NULL,
    mailAddress VARCHAR NOT NULL UNIQUE,
    password VARCHAR NOT NULL,
    money INT NOT NULL,
    phoneNumber VARCHAR NOT NULL,
    birthDate TIMESTAMP NOT NULL,
    reputation INT NOT NULL,
    description VARCHAR NOT NULL,
    gender VARCHAR NOT NULL,
    creationDate TIMESTAMP NOT NULL
);

CREATE TABLE Client 
(
    id SERIAL PRIMARY KEY,
    surname VARCHAR NOT NULL,
    firstname VARCHAR NOT NULL,
    idRace INT NOT NULL,
    mailAddress VARCHAR NOT NULL UNIQUE,
    password VARCHAR NOT NULL,
    money INT NOT NULL,
    phoneNumber VARCHAR NOT NULL,
    birthDate TIMESTAMP NOT NULL,
    reputation INT NOT NULL,
    description VARCHAR NOT NULL,
    gender VARCHAR NOT NULL,
    creationDate TIMESTAMP NOT NULL,
    nbClientCourses INT NOT NULL
);

CREATE TABLE Vendor 
(
    id SERIAL PRIMARY KEY,
    surname VARCHAR NOT NULL,
    firstname VARCHAR NOT NULL,
    idRace INT NOT NULL,
    mailAddress VARCHAR NOT NULL UNIQUE,
    password VARCHAR NOT NULL,
    money INT NOT NULL,
    phoneNumber VARCHAR NOT NULL,
    birthDate TIMESTAMP NOT NULL,
    reputation INT NOT NULL,
    description VARCHAR NOT NULL,
    gender VARCHAR NOT NULL,
    creationDate TIMESTAMP NOT NULL,
    nbClientCourses INT NOT NULL,
    nbVendorCourses INT NOT NULL,
    position INT,
    occupied BOOLEAN NOT NULL
);

INSERT INTO Admin (surname,firstname,idRace,mailAddress,password,money,phoneNumber,birthDate,reputation,creationDate,description,gender) 
VALUES ('aaa','bbb',1,'aaa.aawxcsfdfcfgsfgwxcqa@gmail.com','aaaa','5555','064455835500','1666-01-18 20:50:30','10','1666-01-18 20:50:30','ddddd','other'),
('aaa','bbb',1,'aaa.aaawxcwxssdfgsdfgsfd@gmail.com','aaaa','5555','064455835500','1666-01-18 20:50:30','10','1666-01-18 20:50:30','ddddd','other');

INSERT INTO Client (surname,firstname,idRace,mailAddress,password,money,phoneNumber,birthDate,reputation,creationDate,description,gender,nbClientCourses) 
VALUES ('aaa','bbb',1,'aaa.aawxcwxcqa@gmail.com','aaaa','5555','064455835500','1666-01-18 20:50:30','10','1666-01-18 20:50:30','ddddd','other','0'),
('aaa','bbb',1,'aaa.aaawxcwxsfd@gmail.com','aaaa','5555','064455835500','1666-01-18 20:50:30','10','1666-01-18 20:50:30','ddddd','other','0');

INSERT INTO Vendor (surname,firstname,idRace,mailAddress,password,money,phoneNumber,birthDate,reputation,creationDate,description,gender,nbClientCourses,nbVendorCourses,occupied,position) 
VALUES ('aaa','bbb',1,'aaa.aaa@gmail.com','aaaa','5555','064455835500','1666-01-18 20:50:30','10','1666-01-18 20:50:30','ddddd','other','0','0','false','0'),
('aaa','bbb',1,'aaa.aaasfd@gmail.com','aaaa','5555','064455835500','1666-01-18 20:50:30','10','1666-01-18 20:50:30','ddddd','other','0','0','false','0');
