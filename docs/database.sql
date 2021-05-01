
CREATE DATABASE allegro;

CREATE USER 'allegro'@'localhost' IDENTIFIED BY 'IDsvW.A!j*XajZ1t';
GRANT ALL PRIVILEGES ON allegro.* TO 'allegro'@'localhost';
FLUSH PRIVILEGES;

USE allegro;

CREATE TABLE 'allegro'.user (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(255) NOT NULL,
  username VARCHAR(255) NOT NULL,
  password VARCHAR(60) NOT NULL,
  firstName VARCHAR(255) NOT NULL,
  lastName VARCHAR(255) NOT NULL
);
