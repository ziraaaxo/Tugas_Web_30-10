CREATE DATABASE IF NOT EXISTS catynesia CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE catynesia;

CREATE TABLE IF NOT EXISTS cats (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  breed VARCHAR(100),
  age INT,
  gender ENUM('Male','Female'),
  location VARCHAR(150),
  description TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
