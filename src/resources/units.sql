-- Table "users" structure
CREATE TABLE `users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;

-- Insert data into "users"
INSERT INTO users (username, password)
VALUES 
  ('nhatminh', 'nhatminh');

CREATE TABLE apply (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    position VARCHAR(50) NOT NULL,
    store VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    address TEXT NOT NULL,
    description TEXT NOT NULL,
    resume_file_path VARCHAR(255),
    submission_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    rating number NOT NULL,
    description TEXT,
    
);
