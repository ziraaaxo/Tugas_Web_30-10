CREATE DATABASE IF NOT EXISTS catynesia
CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci;

USE catynesia;

DROP TABLE IF EXISTS cats;
CREATE TABLE cats (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  breed VARCHAR(100),
  age INT,
  gender ENUM('Male', 'Female'),
  location VARCHAR(150),
  description TEXT,
  photo VARCHAR(255) DEFAULT 'cat-placeholder.png',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO cats (name, breed, age, gender, location, description, photo)
VALUES
('Milo', 'Persian', 2, 'Male', 'Jakarta', 'Lucu dan jinak, suka tidur di sofa.', 'cat1.jpg'),
('Luna', 'Anggora', 3, 'Female', 'Bandung', 'Suka dipeluk dan lembut sekali bulunya.', 'cat2.jpg'),
('Leo', 'Kampung', 1, 'Male', 'Surabaya', 'Aktif dan suka bermain bola kecil.', 'cat3.jpg'),
('Bella', 'Ragdoll', 4, 'Female', 'Yogyakarta', 'Manja dan penyayang, cocok untuk anak kecil.', 'cat4.jpg'),
('Coco', 'Scottish Fold', 2, 'Female', 'Semarang', 'Telinganya lucu banget, suka disayang.', 'cat5.jpg'),
('Oreo', 'British Shorthair', 5, 'Male', 'Depok', 'Bulat dan lembut, suka tidur siang.', 'cat6.jpg'),
('Mimi', 'Siamese', 1, 'Female', 'Makassar', 'Sangat aktif dan cerewet, tapi lucu!', 'cat7.jpg');
