-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 08 Apr 2019 pada 07.28
-- Versi server: 10.1.34-MariaDB
-- Versi PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_mahasiswa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_jenjang`
--

CREATE TABLE `m_jenjang` (
  `JenjangKode` int(1) NOT NULL,
  `JenjangNama` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_jenjang`
--

INSERT INTO `m_jenjang` (`JenjangKode`, `JenjangNama`) VALUES
(1, 'S3'),
(2, 'S2'),
(3, 'S1'),
(4, 'D3'),
(5, 'D2'),
(6, 'D1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_kode_kelas`
--

CREATE TABLE `m_kode_kelas` (
  `KelasKode` int(1) NOT NULL,
  `KelasNama` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_kode_kelas`
--

INSERT INTO `m_kode_kelas` (`KelasKode`, `KelasNama`) VALUES
(1, 'Reguler'),
(2, 'Non Reguler');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_mahasiswa`
--

CREATE TABLE `m_mahasiswa` (
  `MahasiswaID` int(11) NOT NULL,
  `MahasiswaNIM` varchar(10) NOT NULL,
  `MahasiswaNama` varchar(50) NOT NULL,
  `MahasiswaTahunMasuk` year(4) NOT NULL,
  `MahasiswaProdi` varchar(2) NOT NULL,
  `MahasiswaKelas` varchar(1) NOT NULL,
  `MahasiswaJenjang` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_mahasiswa`
--

INSERT INTO `m_mahasiswa` (`MahasiswaID`, `MahasiswaNIM`, `MahasiswaNama`, `MahasiswaTahunMasuk`, `MahasiswaProdi`, `MahasiswaKelas`, `MahasiswaJenjang`) VALUES
(12, '1841111073', 'ADAM NUGRAHA', 2018, '11', '1', '4'),
(13, '1830425001', 'FAIZAL JARKASIH', 2018, '04', '2', '3'),
(14, '1841111072', 'SITI MASIOTH', 2018, '11', '1', '4'),
(15, '1830721006', 'ZAKIA ADITIA', 2018, '07', '2', '3'),
(16, '1830811121', 'SRI INDAH', 2018, '08', '1', '3'),
(17, '1832011031', 'MUHAMMAD RIDHO', 2018, '20', '1', '3'),
(18, '1831811036', 'NANDA PRIHANDANA', 2018, '18', '1', '3'),
(19, '1831027002', 'SELAMET MAULANA', 2018, '10', '2', '3'),
(20, '1830111069', 'NUR AISYAH', 2018, '01', '1', '3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_prodi`
--

CREATE TABLE `m_prodi` (
  `ProdiKode` varchar(2) NOT NULL,
  `ProdiNama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_prodi`
--

INSERT INTO `m_prodi` (`ProdiKode`, `ProdiNama`) VALUES
('01', 'TEKNIK SIPIL'),
('02', 'KIMIA'),
('03', 'AGRIBISNIS'),
('04', 'AKUAKULTUR'),
('05', 'TEKNIK INFORMATIKA'),
('06', 'AKUNTANSI'),
('07', 'ADMINISTRASI PUBLIK'),
('08', 'ADMINISTRASI BISNIS'),
('09', 'SASTRA INGGRIS'),
('10', 'PENDIDIKAN BIOLOGI'),
('11', 'KEPERAWATAN'),
('12', 'PERPAJAKAN'),
('13', 'PENDIDIKAN BAHASA DAN SASTRA INDONESIA'),
('14', 'PENDIDIKAN MATEMATIKA'),
('15', 'PENDIDIKAN GURU PENDIDIKAN ANAK USIA DINI'),
('16', 'PENDIDIKAN GURU SEKOLAH DASAR'),
('17', 'PENDIDIKAN TEKNOLOGI INFORMASI'),
('18', 'PENDIDIKAN JASMANI KESEHATAN DAN REKREASI'),
('19', 'HUMAS'),
('20', 'ILMU HUKUM'),
('21', 'ILMU ADMINISTRASI');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `m_jenjang`
--
ALTER TABLE `m_jenjang`
  ADD PRIMARY KEY (`JenjangKode`);

--
-- Indeks untuk tabel `m_kode_kelas`
--
ALTER TABLE `m_kode_kelas`
  ADD PRIMARY KEY (`KelasKode`);

--
-- Indeks untuk tabel `m_mahasiswa`
--
ALTER TABLE `m_mahasiswa`
  ADD PRIMARY KEY (`MahasiswaID`),
  ADD UNIQUE KEY `MahasiswaNIM` (`MahasiswaNIM`);

--
-- Indeks untuk tabel `m_prodi`
--
ALTER TABLE `m_prodi`
  ADD PRIMARY KEY (`ProdiKode`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `m_mahasiswa`
--
ALTER TABLE `m_mahasiswa`
  MODIFY `MahasiswaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
