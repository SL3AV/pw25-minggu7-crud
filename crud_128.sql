CREATE TABLE crud_128 (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_lengkap VARCHAR(100) NOT NULL,
    alamat_email VARCHAR(100) UNIQUE NOT NULL,
    tanggal_lahir DATE,
    nomor_telepon VARCHAR(20),
    jurusan VARCHAR(50)
);