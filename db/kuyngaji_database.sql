
-- Create database
CREATE DATABASE kuyngaji;
USE kuyngaji;

-- Create login_user table
CREATE TABLE login_user (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role_user ENUM('Peserta', 'Admin', 'Guru Ngaji') NOT NULL
);

-- Create peserta table
CREATE TABLE peserta (
    id_peserta INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT,
    nama_lengkap VARCHAR(100) NOT NULL,
    gender ENUM('Laki-laki', 'Perempuan') NOT NULL,
    tempat_kota_lahir VARCHAR(50),
    tanggal_lahir DATE,
    alamat TEXT,
    no_hp VARCHAR(15),
    hobi VARCHAR(100),
    fotopeserta VARCHAR(255),
    FOREIGN KEY (id_user) REFERENCES login_user(id_user)
);

-- Create admin table
CREATE TABLE admin (
    id_admin INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT,
    nama_lengkap VARCHAR(100) NOT NULL,
    gender ENUM('Laki-laki', 'Perempuan') NOT NULL,
    tempat_kota_lahir VARCHAR(50),
    tanggal_lahir DATE,
    alamat TEXT,
    no_hp VARCHAR(15),
    hobi VARCHAR(100),
    fotoadmin VARCHAR(255),
    FOREIGN KEY (id_user) REFERENCES login_user(id_user)
);

-- Create guru_ngaji table
CREATE TABLE guru_ngaji (
    id_guru INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT,
    nama_lengkap VARCHAR(100) NOT NULL,
    gender ENUM('Laki-laki', 'Perempuan') NOT NULL,
    tempat_kota_lahir VARCHAR(50),
    tanggal_lahir DATE,
    alamat TEXT,
    no_hp VARCHAR(15),
    hobi VARCHAR(100),
    fotogurungaji VARCHAR(255),
    mengajar_di_kelas TEXT,
    FOREIGN KEY (id_user) REFERENCES login_user(id_user)
);

-- Create kelas table
CREATE TABLE kelas (
    id_kelas INT AUTO_INCREMENT PRIMARY KEY,
    nama_kelas VARCHAR(50) UNIQUE NOT NULL
);

-- Insert initial data into kelas table
INSERT INTO kelas (nama_kelas) VALUES
('Sharaf 1'), ('Sharaf 2'), ('Nahwu 1'), ('Nahwu 2'), ('Baca Kitab');

-- Create guru_kelas table for many-to-many relationship between guru_ngaji and kelas
CREATE TABLE guru_kelas (
    id_guru INT,
    id_kelas INT,
    PRIMARY KEY (id_guru, id_kelas),
    FOREIGN KEY (id_guru) REFERENCES guru_ngaji(id_guru),
    FOREIGN KEY (id_kelas) REFERENCES kelas(id_kelas)
);

-- Create peserta_kelas table for many-to-many relationship between peserta and kelas
CREATE TABLE peserta_kelas (
    id_peserta INT,
    id_kelas INT,
    PRIMARY KEY (id_peserta, id_kelas),
    FOREIGN KEY (id_peserta) REFERENCES peserta(id_peserta),
    FOREIGN KEY (id_kelas) REFERENCES kelas(id_kelas)
);
