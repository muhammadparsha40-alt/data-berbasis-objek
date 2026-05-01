-- ============================================================
-- File Pendukung - database.sql
-- Tema: Sistem Manajemen Data Buku (Perpustakaan)
-- Jalankan query ini di phpMyAdmin atau MySQL client
-- ============================================================

-- Buat database
CREATE DATABASE IF NOT EXISTS pbo_parsha
    CHARACTER SET utf8
    COLLATE utf8_general_ci;

USE pbo_parsha;

-- Buat tabel buku
CREATE TABLE IF NOT EXISTS buku (
    id          INT(11)      NOT NULL AUTO_INCREMENT,
    judul       VARCHAR(150) NOT NULL,
    pengarang   VARCHAR(100) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
