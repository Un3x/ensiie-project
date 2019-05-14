-- SQL TABLES
-- IF ENCOUNTERING ISSUES, CHECK KEY CONSTRAINTS

--
-- Table of users
-- TODO : unicite mail
-- mdp : hash md5 'admin'
--

CREATE TABLE "users" (
    id SERIAL PRIMARY KEY ,
    firstname VARCHAR NOT NULL ,
    lastname VARCHAR NOT NULL ,
    signupdate date,
    mailaddress VARCHAR NOT NULL,
    passwd VARCHAR NOT NULL,
    activcode VARCHAR NOT NULL,
    lastlogdate DATE NOT NULL,
    userrole VARCHAR NOT NULL ,
    picturepath VARCHAR DEFAULT 'img/defprofilepic.png'
);

INSERT INTO "users"(firstname, lastname, signupdate, mailaddress, passwd, activcode, lastlogdate, userrole, picturepath) 
    VALUES ('Amine', 'Ladmine', '2000-01-01', 'xxaminedu69xx@gmail.com',
            '21232f297a57a5a743894a0e4a801fc3','1','2000-01-01','admin','../src/uploads/profilePics/default.png');


--
-- Table of topics
--

CREATE TABLE "sujets" (
    id SERIAL PRIMARY KEY,
    title VARCHAR NOT NULL,
    content VARCHAR DEFAULT '#',
    author VARCHAR NOT NULL,
    sdatetime TIMESTAMP NOT NULL ,
    topicstatus VARCHAR NOT NULL CHECK (topicstatus IN ('solved','unsolved')) 
);

INSERT INTO "sujets"(title, content, author, sdatetime, topicstatus) 
    VALUES ('Est-ce que les sujets marchent ?', 'C''est une bonne question quand même' ,'Amine-senpai', '2000-01-01 00:00:01', 'unsolved');
INSERT INTO "sujets"(title, author, sdatetime, topicstatus) 
    VALUES ('Mais marchent-ils deux fois ?', 'Amine-senpai', '2000-01-01 00:00:01', 'unsolved');


--
-- Table of answers to topics
-- idrep l'id de la reponse dans le sujet
-- idsujet l'id du sujet
--

CREATE TABLE "reponses" (
    idrep INT NOT NULL,
    idsujet INT NOT NULL,
    author INT NOT NULL DEFAULT 1,
    rdatetime TIMESTAMP NOT NULL,
    answertext TEXT NOT NULL,
    answerstatus VARCHAR NOT NULL CHECK (answerstatus IN ('yes','no','maybe')) DEFAULT 'maybe',
    votecount INT NOT NULL DEFAULT 0,
    CONSTRAINT PK_R PRIMARY KEY (idrep,idsujet),
    CONSTRAINT FK_Users FOREIGN KEY (author) REFERENCES users(id) ON UPDATE CASCADE ON DELETE SET DEFAULT,
    CONSTRAINT FK_Sujets FOREIGN KEY (idsujet) REFERENCES sujets(id) ON DELETE CASCADE ON UPDATE CASCADE
);
INSERT INTO "reponses"(idrep, idsujet, rdatetime, answertext) 
    VALUES (1, 1, '2000-01-01 00:00:01', 'Ouiiiiiiiiiiiiiii');
INSERT INTO "reponses"(idrep, idsujet, rdatetime, answertext) 
    VALUES (2, 1, '2000-01-01 00:00:01', 'Bitoku');

--
-- Table of votes for answers
--

CREATE TABLE "votesreponses" (
    iduser INT NOT NULL,
    idrep INT NOT NULL,
    idsujet INT NOT NULL,
    vote INT NOT NULL DEFAULT 0,
    CONSTRAINT PK_VR PRIMARY KEY (iduser,idrep,idsujet),
    CONSTRAINT FK_R FOREIGN KEY (idrep,idsujet) REFERENCES reponses(idrep,idsujet) ON DELETE CASCADE ON UPDATE CASCADE
);
INSERT INTO "votesreponses"(iduser,idrep,idsujet,vote)
    VALUES (1,2,1,10);

--
-- Table of votes for topics
--

CREATE TABLE "votessujets" (
    iduser INT NOT NULL,
    idsujet INT NOT NULL,
    vote INT NOT NULL DEFAULT 0,
    CONSTRAINT PK_VS PRIMARY KEY (iduser, idsujet),
    CONSTRAINT FK_S FOREIGN KEY (idsujet) REFERENCES sujets(id) ON DELETE CASCADE ON UPDATE CASCADE
);
INSERT INTO "votessujets"(iduser,idsujet,vote)
    VALUES (1,1,15);

--
-- Table for uploads
--

CREATE TABLE "uploads" (
    id SERIAL PRIMARY KEY ,
    title VARCHAR NOT NULL ,
    iduploader INT NOT NULL ,
    uploadpath VARCHAR NOT NULL,
    CONSTRAINT FK_Users FOREIGN KEY (iduploader) REFERENCES users(id) ON UPDATE CASCADE ON DELETE SET DEFAULT
);
INSERT INTO "uploads"(title,iduploader,uploadpath)
    VALUES ('DEFINITELY NOT PORN',1,'src/uploads/notporn.txt');

--
-- Table for quizzes
-- Got to count questions before adding them
--

CREATE TABLE "qcm" (
    id SERIAL PRIMARY KEY ,
    title VARCHAR NOT NULL ,
    sumup TEXT NOT NULL,
    nbq INT NOT NULL DEFAULT 0,
    idauthor INT NOT NULL ,
    CONSTRAINT FK_Users FOREIGN KEY (idauthor) REFERENCES users(id) ON UPDATE CASCADE ON DELETE SET DEFAULT
);
INSERT INTO "qcm"(title,sumup,nbq,idauthor)
    VALUES ('Test qcm','Ptet ça marche, ptet pas',1,1);

--
-- Table for quizzes questions
--

CREATE TABLE "qcmquestion" (
    idqcm INT NOT NULL,
    idquestion INT NOT NULL,
    intitule TEXT NOT NULL DEFAULT 'Quelle est la réponse ?',
    CONSTRAINT PK_QQ PRIMARY KEY (idqcm,idquestion),
    CONSTRAINT FK_Q FOREIGN KEY (idqcm) REFERENCES qcm(id) ON UPDATE CASCADE ON DELETE SET DEFAULT
);
INSERT INTO "qcmquestion"(idqcm,idquestion,intitule)
    VALUES (1,1,'Nounouille ?');

--
-- Table for quizzes answers
--

CREATE TABLE "qcmreponse" (
    idqcm INT NOT NULL,
    idquestion INT NOT NULL,
    idprop INT NOT NULL,
    textrep TEXT NOT NULL DEFAULT '---',
    valeur INT NOT NULL DEFAULT 0,
    CONSTRAINT PK_PQQ PRIMARY KEY (idqcm,idquestion, idprop)
);
INSERT INTO "qcmreponse"(idqcm,idquestion,idprop,textrep,valeur)
    VALUES (1,1,1,'Bonne réponse',1);
INSERT INTO "qcmreponse"(idqcm,idquestion,idprop,textrep,valeur)
    VALUES (1,1,2,'Mauvaise réponse',0);

--
-- Table for quizzes scores
--

CREATE TABLE "qcmscores" (
    iduser INT NOT NULL,
    idqcm INT NOT NULL,
    score INT NOT NULL DEFAULT 0,
    qcmdatetime TIMESTAMP NOT NULL ,
    CONSTRAINT PK_QS PRIMARY KEY (iduser,idqcm),
    CONSTRAINT FK_Users FOREIGN KEY (iduser) REFERENCES users(id) ON UPDATE CASCADE ON DELETE SET DEFAULT
);
INSERT INTO "qcmscores"(iduser,idqcm,score,qcmdatetime)
    VALUES (1,1,1,'2015-01-01 00:00:01');