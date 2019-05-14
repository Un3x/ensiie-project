CREATE TABLE membres (
  courriel varchar(50) PRIMARY KEY,
  pseudo varchar(30) NOT NULL,
  motdepasse text NOT NULL
);

CREATE TABLE stands (
  courriel varchar(50) PRIMARY KEY,
  stand text NOT NULL,
  respo text NOT NULL,
  officielc varchar(50) NOT NULL,
  web text,
  tel varchar(20) NOT NULL,
  act text NOT NULL
);  

CREATE TABLE admins (
  courriel varchar(50) PRIMARY KEY,
  LVL INT NOT NULL
);

INSERT INTO membres (courriel, pseudo, motdepasse) VALUES
('kiscla@chat.fe', 'Kiscla', 'e7a00e53bd04bf48c4cde300b11f10decee18d7a825502c4edcbc2fa38f7fa1f');
INSERT INTO admins (courriel, lvl) VALUES
('kiscla@chat.fe', 1);
COMMIT;