CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('student','admin') DEFAULT 'student',
    date_added DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    student_id VARCHAR(50) UNIQUE NOT NULL,
    course VARCHAR(100) NOT NULL,
    year_level VARCHAR(50) NOT NULL,
    date_added DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(20) NOT NULL,
    name VARCHAR(200) NOT NULL,
    year_levels VARCHAR(50) NOT NULL
);

INSERT INTO courses (code, name, year_levels) VALUES
('BSIT', 'Bachelor of Science in Information Technology', '1,2,3,4'),
('BSCS', 'Bachelor of Science in Computer Science', '1,2,3,4'),
('BSEE', 'Bachelor of Science in Electrical Engineering', '1,2,3,4'),
('BSA', 'Bachelor of Science in Accountancy', '1,2,3,4');

CREATE TABLE attendance (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    course VARCHAR(100) NOT NULL,
    year_level VARCHAR(50) NOT NULL,
    date DATE NOT NULL,
    time TIME NOT NULL,
    status ENUM('Present','Absent','Excused') DEFAULT 'Present',
    is_late TINYINT(1) DEFAULT 0
);

INSERT INTO users (full_name, email, password, role) 
VALUES ('System Admin', 'admin@example.com', MD5('admin123'), 'admin');

CREATE TABLE excuse_letters (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    course VARCHAR(100) NOT NULL,
    year_level VARCHAR(50) NOT NULL,
    reason TEXT NOT NULL,
    photo VARCHAR(255) DEFAULT NULL,
    date_submitted DATETIME DEFAULT CURRENT_TIMESTAMP,
    status ENUM('Pending','Approved','Rejected') DEFAULT 'Pending',
    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE
);