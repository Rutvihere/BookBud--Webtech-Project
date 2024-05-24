CREATE DATABASE IF NOT EXISTS swapbook;
USE swapbook;

CREATE TABLE IF NOT EXISTS signup (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(50),
    lastname VARCHAR(50),
    username VARCHAR(50) UNIQUE,
    password VARCHAR(255) -- For better security, it's recommended to store hashed passwords
);
