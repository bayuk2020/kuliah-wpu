-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 04 Apr 2024 pada 20.12
-- Versi server: 8.0.30
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pw_c2c022511`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int NOT NULL,
  `nama` varchar(200) NOT NULL,
  `nim` varchar(10) NOT NULL,
  `email` text NOT NULL,
  `jurusan` varchar(100) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nama`, `nim`, `email`, `jurusan`, `gambar`) VALUES
(1, 'Surya Rama', 'C2C022512', 'suryarama@gmail.com', 'S1 Informatika', 'surya.jpg'),
(2, 'Irfan Muzakki', 'C2C022513', 'irfanmuzakki@gmail.com', 'S1 Informatika', 'irfan.jpg'),
(3, 'Bayu Kristianto', 'C2C022511', 'bayuk2020@gmail.com', 'S1 Informatika', 'bayu.jpg'),
(4, 'Ari kusumadewi', 'C2C022519', 'ariari@gmail.com', 'S1 Manajemen', 'arikusuma.jpg'),
(11, 'Dewi Ayu Wulandari', 'C2C022521', 'dewiayu@gmail.com', 'S1 Perikanan', 'dewiayu.jpg'),
(12, 'Risya Pramestya Ramadhana', 'G1C019056', 'risyasasa28@gmail.com', 'D3 Keperawatan', 'risya.jpg'),
(17, 'asd', 'asd', 'asd', 'asd', '6609c5ae55c45.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(3, 'tes', '$2y$10$LSofzde3HcJT/RiWft3IGeHvrIcNUurSLXq0n2veHbVfSfexBTya.'),
(4, 'admin', '$2y$10$lNQsIh5BV3iaShmEhrS4K.SoaMpNpdVfZOONPmK2Z5.NICj02jHwW'),
(5, 'bayu', '$2y$10$gMwweajQeUB4l/wDQ1VSjuSdOSBLCh409K2.ftUda6OX4KYFWAb1e');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
