CREATE TABLE  Race(
    id SERIAL PRIMARY KEY,
    name VARCHAR NOT NULL UNIQUE,
    speed FLOAT NOT NULL,
    capacity INT NOT NULL
);


INSERT INTO cities (name, speed, capacity) VALUES
('chocobo','150.','2'),
('gobelin','5.','1');
