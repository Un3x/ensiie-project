CREATE TABLE  Race(
    id SERIAL PRIMARY KEY,
    name VARCHAR NOT NULL UNIQUE,
    speed FLOAT NOT NULL,
    capacity INT NOT NULL
);


INSERT INTO Race (name, speed, capacity) VALUES
('chocobo','60.','2'),
('gobelin','5.','1'),
('licorne', '80', '2'),
('dragon', '70','5'),
('slime', '0.1', '1'),
('leviathan', '100', '30'),
('griffon', '50', '3'),
('phénix', '80', '4');
