
CREATE DATABASE allegro;

CREATE USER 'allegro'@'localhost' IDENTIFIED BY 'IDsvW.A!j*XajZ1t';
GRANT ALL PRIVILEGES ON allegro.* TO 'allegro'@'localhost';
FLUSH PRIVILEGES;

USE allegro;

CREATE TABLE User (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(255) NOT_NULL,
  username VARCHAR(255) NOT_NULL,
  password VARCHAR(60) NOT_NULL,
  firstName VARCHAR(255) NOT_NULL,
  lastName VARCHAR(255) NOT_NULL
);
