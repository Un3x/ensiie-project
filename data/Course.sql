CREATE TABLE  Course(
    id SERIAL PRIMARY KEY,
    departure INT NOT NULL,
    arrival INT NOT NULL,
    carrier INT NOT NULL,
    client INT NOT NULL,
    datetime TIMESTAMP NOT NULL,
    state INT NOT NULL,
    price FLOAT NOT NULL
);
