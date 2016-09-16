-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2016 at 10:17 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `belangwetan`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(30) NOT NULL,
  `id_user` smallint(5) UNSIGNED NOT NULL,
  `password` varchar(30) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `pengguna` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `id_user`, `password`, `foto`, `pengguna`) VALUES
('admin', 1, 'admin', 'j.jpg', 'admin'),
('vanmovic', 2, 'admin', 'j.jpg', 'vanmovic');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `nip` varchar(30) NOT NULL,
  `id_user` smallint(5) UNSIGNED NOT NULL,
  `password` varchar(50) NOT NULL,
  `nm_guru` varchar(50) NOT NULL,
  `tmpt_lahir` varchar(50) NOT NULL,
  `date_tgl_lahir` date NOT NULL,
  `jns_kelamin` varchar(30) NOT NULL,
  `agama` varchar(30) NOT NULL,
  `almt_sekarang` text NOT NULL,
  `no_hp` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`nip`, `id_user`, `password`, `nm_guru`, `tmpt_lahir`, `date_tgl_lahir`, `jns_kelamin`, `agama`, `almt_sekarang`, `no_hp`, `email`) VALUES
('195311201982031010', 2, '12345', 'AFIFUDDIN', 'Semarang', '0000-00-00', 'Laki-Laki', 'Islam', 'Klaten', '0800000000', 'afif@gmail.com'),
('197009242009021001', 2, '12345', 'RUSMANTO', 'Klaten', '0000-00-00', 'Laki-Laki', 'Islam', 'Klaten', '0800000', 'rusmanto@gmail.com'),
('197203161997021002', 2, '12345', 'MUHAMAD WORO NUGROHO', 'Klaten', '0000-00-00', 'Laki-Laki', 'Islam', 'Klaten', '0800000000', '@gmail.com'),
('198304072010012020', 2, '12345', 'ARIE WIDIYANNINGSIH', 'Wonogiri', '1983-07-10', 'Perempuan', 'Islam', 'Cawas', '08000000000', 'ariewidya@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal_mapel` int(30) NOT NULL,
  `kd_kelas` smallint(30) UNSIGNED NOT NULL,
  `nip` varchar(30) NOT NULL,
  `id_tahun` varchar(50) NOT NULL,
  `kd_mapel` varchar(30) NOT NULL,
  `jam` varchar(2) NOT NULL,
  `id_hari` smallint(7) UNSIGNED NOT NULL,
  `id_semester` smallint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `kd_kelas` varchar(20) NOT NULL,
  `nm_kelas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`kd_kelas`, `nm_kelas`) VALUES
('XIITKJ1', 'Xii Teknik Komputer Jaringan 1'),
('XIITKJ2', 'Xii Teknik Komputer Jaringan 2'),
('XITKJ1', 'Xi Teknik Komputer Jaringan 1'),
('XITKJ2', 'Xi Teknik Komputer Jaringan 2'),
('XTKJ1', 'X Teknik Komputer Jaringan 1'),
('XTKJ2', 'X Teknik Komputer Jaringan 2');

-- --------------------------------------------------------

--
-- Table structure for table `kelas_siswa`
--

CREATE TABLE `kelas_siswa` (
  `id_kelas_siswa` int(255) NOT NULL,
  `kd_kelas` varchar(30) NOT NULL,
  `nis` varchar(30) NOT NULL,
  `kd_tahun_ajaran` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kepala_sekolah`
--

CREATE TABLE `kepala_sekolah` (
  `nip` varchar(30) NOT NULL,
  `id_user` smallint(5) UNSIGNED NOT NULL,
  `password` varchar(50) NOT NULL,
  `nm_guru` varchar(50) NOT NULL,
  `tmpt_lahir` varchar(50) NOT NULL,
  `date_tgl_lahir` date NOT NULL,
  `jns_kelamin` varchar(30) NOT NULL,
  `agama` varchar(30) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `almt_sekarang` text NOT NULL,
  `no_hp` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kepala_sekolah`
--

INSERT INTO `kepala_sekolah` (`nip`, `id_user`, `password`, `nm_guru`, `tmpt_lahir`, `date_tgl_lahir`, `jns_kelamin`, `agama`, `jabatan`, `almt_sekarang`, `no_hp`, `email`) VALUES
('1234567890', 4, '12345', 'Ini Kepala', 'Klaten', '2016-06-01', 'Laki-Laki', 'Islam', 'Kepala Sekolah', 'Jakarta', '081111', 'kepala');

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE `mapel` (
  `kd_mapel` varchar(15) NOT NULL,
  `nm_mapel` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`kd_mapel`, `nm_mapel`) VALUES
('B1', 'Bahasa Indonesia'),
('B2', 'Bahasa Inggris'),
('B3', 'Bahasa Jawa'),
('JK', 'Jaringan Komputer'),
('M1', 'Matematika');

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE `materi` (
  `kd_materi` int(10) NOT NULL,
  `nama_file` varchar(100) NOT NULL,
  `size` int(10) NOT NULL,
  `judul_materi` varchar(50) NOT NULL,
  `nip` varchar(30) NOT NULL,
  `kd_kelas` varchar(20) NOT NULL,
  `kd_mapel` varchar(15) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type` varchar(100) NOT NULL,
  `content` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`kd_materi`, `nama_file`, `size`, `judul_materi`, `nip`, `kd_kelas`, `kd_mapel`, `waktu`, `type`, `content`) VALUES
(12, '76994-WC.docx', 248612, 'Perancangan', '198304072010012020', 'XITKJ2', 'JK', '2016-06-18 11:07:38', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'PK\0\0\0\0\0!\0_Šà¶\0\0e\0\0\0[Content_Types].xml ¢( \0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0'),
(13, '85849-Format laporan KP.docx', 15022, 'Rancang', '198304072010012020', 'XITKJ2', 'JK', '2016-06-18 23:09:21', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'PK\0\0\0\0\0!\0ð!ì}Ž\0\0\0\0\0[Content_Types].xml ¢( \0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0'),
(17, '29152-Domain_Index_-_Juni.xlsx', 27783, 'Bahasaaaa', '195311201982031010', 'XTKJ2', 'B1', '2016-06-19 03:12:00', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'PK\0\0\0\0\0!\0;HŽ@i\0\0Ä\0\0\0[Content_Types].xml ¢( \0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0'),
(18, '88695-Beranda Hiburan.docx', 34965, 'Bahasa2', '195311201982031010', 'XTKJ1', 'B1', '2016-06-19 03:12:50', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'PK\0\0\0\0\0!\0Ä¾‚ï§\0\0ã\0\0\0[Content_Types].xml ¢( \0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0'),
(19, '65156-76994-WC.docx', 1358, 'WC', '195311201982031010', 'XITKJ1', 'B1', '2016-06-19 03:18:07', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', '\r\n\r\n\r\n \r\n\r\n\r\n<!DOCTYPE html>\r\n<html lang="en-us" dir="ltr" class="tm-bg-primary">\r\n<head>\r\n<meta cha'),
(20, '97798-WC.docx', 248612, 'Asdasdasd', '195311201982031010', 'XTKJ1', 'B1', '2016-06-19 03:29:23', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'PK\0\0\0\0\0!\0_Šà¶\0\0e\0\0\0[Content_Types].xml ¢( \0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0');

-- --------------------------------------------------------

--
-- Table structure for table `mengajar`
--

CREATE TABLE `mengajar` (
  `kd_mengajar` int(55) NOT NULL,
  `nip` varchar(30) NOT NULL,
  `kd_mapel` varchar(15) NOT NULL,
  `kd_kelas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mengajar`
--

INSERT INTO `mengajar` (`kd_mengajar`, `nip`, `kd_mapel`, `kd_kelas`) VALUES
(0, '195311201982031010', 'B1', 'XTKJ1'),
(23, '198304072010012020', 'JK', 'XTKJ1'),
(25, '198304072010012020', 'JK', 'XTKJ2'),
(28, '197203161997021002', 'B1', 'XITKJ1'),
(29, '197009242009021001', 'B2', 'XITKJ2'),
(31, '195311201982031010', 'B1', 'XTKJ2'),
(32, '197009242009021001', 'B3', 'XTKJ2');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `nis` varchar(30) NOT NULL,
  `kd_mapel` varchar(30) NOT NULL,
  `semester` varchar(30) NOT NULL,
  `id_tahun` varchar(30) NOT NULL,
  `kd_kelas` smallint(30) UNSIGNED NOT NULL,
  `nip` varchar(30) NOT NULL,
  `harian1` int(30) NOT NULL,
  `harian2` int(30) NOT NULL,
  `harian3` int(30) NOT NULL,
  `tugas1` int(30) NOT NULL,
  `tugas2` int(30) NOT NULL,
  `tugas3` int(30) NOT NULL,
  `uts` int(30) NOT NULL,
  `uas` int(30) NOT NULL,
  `nrataraport` int(30) NOT NULL,
  `rangking` int(30) NOT NULL,
  `nr` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `kd_pengumuman` int(5) NOT NULL,
  `nip` varchar(30) NOT NULL,
  `judul_pengumuman` varchar(30) NOT NULL,
  `isi` text NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`kd_pengumuman`, `nip`, `judul_pengumuman`, `isi`, `tanggal`) VALUES
(8, '195311201982031010', 'Senin Libur', 'Senin tanggal merah', '2016-06-17 09:43:22'),
(9, '195311201982031010', 'Pengumpulan', 'Pengumpulan Data Sekolah', '2016-06-17 09:46:58');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nis` varchar(30) NOT NULL,
  `id_user` smallint(5) UNSIGNED NOT NULL,
  `password` varchar(50) NOT NULL,
  `nm_siswa` varchar(50) NOT NULL,
  `tmpt_lahir` varchar(50) NOT NULL,
  `date_tgl_lahir` date NOT NULL,
  `jns_kelamin` varchar(30) NOT NULL,
  `agama` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(40) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `kd_kelas` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nis`, `id_user`, `password`, `nm_siswa`, `tmpt_lahir`, `date_tgl_lahir`, `jns_kelamin`, `agama`, `alamat`, `email`, `telp`, `kd_kelas`) VALUES
('12345678', 3, '12345', 'Ofa', 'Jakarta', '2016-06-06', 'Laki-Laki', 'Kristen Protestan', 'Jogja', 'bebek', '08123', 'XTKJ2'),
('12345679', 3, '12345', 'Irfan', 'Yogyakarta', '0000-00-00', 'Laki-Laki', 'Islam', 'Jogja', 'irfan@gmail.com', '081235461613', 'XTKJ1');

-- --------------------------------------------------------

--
-- Table structure for table `tahun_ajaran`
--

CREATE TABLE `tahun_ajaran` (
  `kd_tahun_ajaran` int(5) NOT NULL,
  `nm_tahun_ajaran` varchar(15) NOT NULL,
  `semester` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tahun_ajaran`
--

INSERT INTO `tahun_ajaran` (`kd_tahun_ajaran`, `nm_tahun_ajaran`, `semester`) VALUES
(2, '2014/2015', 'Genap'),
(4, '2016/2017', 'Ganjil');

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `kd_tugas` int(10) NOT NULL,
  `nama_file` varchar(100) NOT NULL,
  `size` int(10) NOT NULL,
  `judul_tugas` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `nip` varchar(30) NOT NULL,
  `kd_kelas` varchar(20) NOT NULL,
  `kd_mapel` varchar(15) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type` varchar(100) NOT NULL,
  `content` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tugas`
--

INSERT INTO `tugas` (`kd_tugas`, `nama_file`, `size`, `judul_tugas`, `keterangan`, `nip`, `kd_kelas`, `kd_mapel`, `waktu`, `type`, `content`) VALUES
(8, '33285-cover KP.docx', 25007, 'Tugas Menggambar', 'Menggambar Gunung\r\n', '195311201982031010', 'XTKJ1', 'B1', '2016-06-19 04:54:54', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'PK\0\0\0\0\0!\0žÜšŽ\0\0Â\0\0\0[Content_Types].xml ¢( \0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0'),
(9, '3655-Beranda Hiburan.docx', 34965, 'Tugas Menulis', 'Deadline: 22/6\r\n\r\nTugas Detail Di Bawah.', '195311201982031010', 'XTKJ2', 'B1', '2016-06-20 19:04:11', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'PK\0\0\0\0\0!\0Ä¾‚ï§\0\0ã\0\0\0[Content_Types].xml ¢( \0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0'),
(10, '89284-FLASHING DARI ROM DISTRIBUTOR KE ROM DEVELOPER TERBARU.docx', 184785, 'Tugas ', 'Tugas Ini', '195311201982031010', 'XTKJ2', 'B1', '2016-06-20 19:05:19', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'PK\0\0\0\0\0!\0ç!]p\0\0×\0\0\0[Content_Types].xml ¢( \0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0'),
(11, 'cover KP.docx', 25007, 'Afu', 'Afu', '195311201982031010', 'XTKJ2', 'B1', '2016-06-20 19:07:18', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'PK\0\0\0\0\0!\0žÜšŽ\0\0Â\0\0\0[Content_Types].xml ¢( \0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0');

-- --------------------------------------------------------

--
-- Table structure for table `tugas_siswa`
--

CREATE TABLE `tugas_siswa` (
  `kd_tugas_siswa` int(10) NOT NULL,
  `nama_file` varchar(100) NOT NULL,
  `size` int(10) NOT NULL,
  `judul_tugas` varchar(50) NOT NULL,
  `nip` varchar(30) NOT NULL,
  `nis` varchar(30) NOT NULL,
  `kd_kelas` varchar(20) NOT NULL,
  `kd_mapel` varchar(15) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type` varchar(100) NOT NULL,
  `content` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `tugas_siswa`
--

INSERT INTO `tugas_siswa` (`kd_tugas_siswa`, `nama_file`, `size`, `judul_tugas`, `nip`, `nis`, `kd_kelas`, `kd_mapel`, `waktu`, `type`, `content`) VALUES
(1, '76994-WC.docx', 1358, 'Tugas Menggambar', '195311201982031010', '12345679', 'XTKJ1', 'B1', '2016-06-20 18:55:25', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', '\r\n\r\n\r\n \r\n\r\n\r\n<!DOCTYPE html>\r\n<html lang="en-us" dir="ltr" class="tm-bg-primary">\r\n<head>\r\n<meta cha');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `kategori_user` varchar(50) NOT NULL,
  `id_user` smallint(5) UNSIGNED NOT NULL,
  `tingkat_user` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`kategori_user`, `id_user`, `tingkat_user`) VALUES
('Admin', 1, 10),
('Guru', 2, 1),
('Siswa', 3, 0),
('Kepala Sekolah', 4, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`nip`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal_mapel`),
  ADD KEY `kd_kelas` (`kd_kelas`,`nip`,`id_tahun`,`kd_mapel`),
  ADD KEY `kd_mapel` (`kd_mapel`),
  ADD KEY `nip` (`nip`),
  ADD KEY `id_tahun` (`id_tahun`),
  ADD KEY `id_hari` (`id_hari`),
  ADD KEY `id_semester` (`id_semester`),
  ADD KEY `id_semester_2` (`id_semester`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`kd_kelas`);

--
-- Indexes for table `kelas_siswa`
--
ALTER TABLE `kelas_siswa`
  ADD PRIMARY KEY (`id_kelas_siswa`),
  ADD KEY `kd_kelas` (`kd_kelas`,`nis`,`kd_tahun_ajaran`),
  ADD KEY `nis` (`nis`),
  ADD KEY `id_tahun` (`kd_tahun_ajaran`),
  ADD KEY `kd_tahun_ajaran` (`kd_tahun_ajaran`),
  ADD KEY `kd_kelas_2` (`kd_kelas`),
  ADD KEY `nis_2` (`nis`),
  ADD KEY `kd_tahun_ajaran_2` (`kd_tahun_ajaran`),
  ADD KEY `kd_tahun_ajaran_3` (`kd_tahun_ajaran`);

--
-- Indexes for table `kepala_sekolah`
--
ALTER TABLE `kepala_sekolah`
  ADD PRIMARY KEY (`nip`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`kd_mapel`);

--
-- Indexes for table `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`kd_materi`),
  ADD KEY `nip` (`nip`),
  ADD KEY `kd_kelas` (`kd_kelas`),
  ADD KEY `kd_mapel` (`kd_mapel`);

--
-- Indexes for table `mengajar`
--
ALTER TABLE `mengajar`
  ADD PRIMARY KEY (`kd_mengajar`),
  ADD KEY `nip` (`nip`),
  ADD KEY `kd_mapel` (`kd_mapel`),
  ADD KEY `kd_kelas` (`kd_kelas`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD KEY `nis` (`nis`),
  ADD KEY `nis_2` (`nis`,`kd_mapel`,`semester`,`id_tahun`,`kd_kelas`,`nip`),
  ADD KEY `nis_3` (`nis`,`kd_mapel`,`semester`,`id_tahun`,`kd_kelas`,`nip`),
  ADD KEY `kd_mapel` (`kd_mapel`),
  ADD KEY `id_tahun` (`id_tahun`),
  ADD KEY `kd_kelas` (`kd_kelas`),
  ADD KEY `nip` (`nip`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`kd_pengumuman`),
  ADD KEY `nip` (`nip`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nis`),
  ADD KEY `kd_kelas` (`kd_kelas`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  ADD PRIMARY KEY (`kd_tahun_ajaran`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`kd_tugas`),
  ADD KEY `nip` (`nip`),
  ADD KEY `kd_kelas` (`kd_kelas`),
  ADD KEY `kd_mapel` (`kd_mapel`);

--
-- Indexes for table `tugas_siswa`
--
ALTER TABLE `tugas_siswa`
  ADD PRIMARY KEY (`kd_tugas_siswa`),
  ADD KEY `nip` (`nip`),
  ADD KEY `kd_kelas` (`kd_kelas`),
  ADD KEY `kd_mapel` (`kd_mapel`),
  ADD KEY `nis` (`nis`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal_mapel` int(30) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kelas_siswa`
--
ALTER TABLE `kelas_siswa`
  MODIFY `id_kelas_siswa` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
  MODIFY `kd_materi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `mengajar`
--
ALTER TABLE `mengajar`
  MODIFY `kd_mengajar` int(55) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `kd_pengumuman` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  MODIFY `kd_tahun_ajaran` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `kd_tugas` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tugas_siswa`
--
ALTER TABLE `tugas_siswa`
  MODIFY `kd_tugas_siswa` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `guru`
--
ALTER TABLE `guru`
  ADD CONSTRAINT `guru_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
