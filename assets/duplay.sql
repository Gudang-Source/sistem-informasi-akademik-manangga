-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2014 at 01:05 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `duplay`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE IF NOT EXISTS `absensi` (
  `id_absensi` varchar(30) NOT NULL,
  `nis` varchar(30) NOT NULL,
  `hadir` int(200) NOT NULL,
  `izin` int(200) NOT NULL,
  `sakit` int(200) NOT NULL,
  `alfa` int(200) NOT NULL,
  `tanggal` date NOT NULL,
  `id_piket` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id_absensi`, `nis`, `hadir`, `izin`, `sakit`, `alfa`, `tanggal`, `id_piket`) VALUES
('1', '1265014', 1, 1, 1, 2, '2014-12-11', '1');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE IF NOT EXISTS `guru` (
  `nip` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` varchar(30) NOT NULL,
  `nm_guru` varchar(50) NOT NULL,
  `tmpt_lahir` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jns_kelamin` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `agama` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL,
  `kd_mapel` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`nip`, `password`, `level`, `nm_guru`, `tmpt_lahir`, `tgl_lahir`, `jns_kelamin`, `alamat`, `agama`, `status`, `kd_mapel`) VALUES
('126500181701', 'fajar', '2', 'Fajar Nur R', 'gunungkidul', '2014-12-10', 'L', 'jogja', 'islam', 'guru tetap', '1'),
('126500182411', 'fajar', '2', 'Fajar Nur R', 'gunungkidul', '2014-12-10', 'L', 'jogja', 'islam', 'guru tetap', '2');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE IF NOT EXISTS `jadwal` (
  `kd_kelas` varchar(30) NOT NULL,
  `nip` varchar(30) NOT NULL,
  `id_tahun` varchar(50) NOT NULL,
  `kd_mapel` varchar(30) NOT NULL,
  `jam` date NOT NULL,
  `hari` date NOT NULL,
  `semester` varchar(30) NOT NULL,
  `ruangan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE IF NOT EXISTS `kelas` (
  `kd_kelas` varchar(30) NOT NULL,
  `nm_kelas` varchar(50) NOT NULL,
  `nip` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`kd_kelas`, `nm_kelas`, `nip`) VALUES
('1', 'xii ipa 1', '126500182411'),
('2', 'xii ipa 1', '126500181701');

-- --------------------------------------------------------

--
-- Table structure for table `kelas_siswa`
--

CREATE TABLE IF NOT EXISTS `kelas_siswa` (
`id_kelas` int(255) NOT NULL,
  `kd_kelas` varchar(30) NOT NULL,
  `nis` varchar(30) NOT NULL,
  `id_tahun` varchar(30) NOT NULL,
  `semester` varchar(30) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `kelas_siswa`
--

INSERT INTO `kelas_siswa` (`id_kelas`, `kd_kelas`, `nis`, `id_tahun`, `semester`) VALUES
(1, '1', '1265018', '1', '1'),
(2, '1', '1265014', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE IF NOT EXISTS `mapel` (
  `kd_mapel` varchar(30) NOT NULL,
  `nm_mapel` varchar(30) NOT NULL,
  `kkm` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`kd_mapel`, `nm_mapel`, `kkm`) VALUES
('1', 'matematika', '70'),
('2', 'website', '70');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE IF NOT EXISTS `nilai` (
  `nis` varchar(30) NOT NULL,
  `kd_mapel` varchar(30) NOT NULL,
  `semester` varchar(30) NOT NULL,
  `id_tahun` varchar(30) NOT NULL,
  `kd_kelas` varchar(30) NOT NULL,
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
-- Table structure for table `nil_pribadi`
--

CREATE TABLE IF NOT EXISTS `nil_pribadi` (
  `nis` varchar(30) NOT NULL,
  `semester` varchar(30) NOT NULL,
  `id_tahun` varchar(30) NOT NULL,
  `cat_kerajinan` varchar(30) NOT NULL,
  `cat_kerapian` varchar(30) NOT NULL,
  `cat_kelakuan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE IF NOT EXISTS `pegawai` (
  `id_pegawai` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` varchar(30) NOT NULL,
  `nm_pegawai` varchar(50) NOT NULL,
  `tmpt_lahir` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jns_kelamin` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `agama` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL,
  `jabatan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggaran`
--

CREATE TABLE IF NOT EXISTS `pelanggaran` (
  `id_pelanggaran` varchar(30) NOT NULL,
  `nis` varchar(30) NOT NULL,
  `nm_pelanggaran` varchar(50) NOT NULL,
  `keterangan` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `piket`
--

CREATE TABLE IF NOT EXISTS `piket` (
  `id_piket` varchar(30) NOT NULL,
  `nip` varchar(30) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE IF NOT EXISTS `siswa` (
  `nis` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nm_siswa` varchar(50) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `gol_darah` varchar(30) NOT NULL,
  `jns_kelamin` varchar(30) NOT NULL,
  `agama` varchar(30) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `nm_ortu` varchar(50) NOT NULL,
  `pekerjaan_ortu` varchar(50) NOT NULL,
  `alamat_ortu` text NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nis`, `password`, `nm_siswa`, `tempat_lahir`, `tgl_lahir`, `gol_darah`, `jns_kelamin`, `agama`, `foto`, `nm_ortu`, `pekerjaan_ortu`, `alamat_ortu`, `alamat`) VALUES
('1265014', 'yoga', 'yoga pratama', 'jogja', '2014-12-07', 'b', 'L', 'a', 'faris.jpg', 'asdasd', 'asdas', 'asdasd', 'asdasdasd'),
('1265017', 'irfan', 'irfan afif', 'jogja', '2014-12-07', 'b', 'L', 'a', 'faris.jpg', 'asdasd', 'asdas', 'asdasd', 'asdasdasd'),
('1265018', 'fajar', 'fajar nurrohmat', 'jogja', '2014-12-07', 'b', 'L', 'a', 'faris.jpg', '', 'asdas', 'asdasd', 'asdasdasd');

-- --------------------------------------------------------

--
-- Table structure for table `thn_ajaran`
--

CREATE TABLE IF NOT EXISTS `thn_ajaran` (
  `id_tahun` varchar(30) NOT NULL,
  `thn_ajaran` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `thn_ajaran`
--

INSERT INTO `thn_ajaran` (`id_tahun`, `thn_ajaran`) VALUES
('1', '2013'),
('2', '2014');

-- --------------------------------------------------------

--
-- Table structure for table `woroworo`
--

CREATE TABLE IF NOT EXISTS `woroworo` (
`id_woro` int(30) NOT NULL,
  `nm_woro` varchar(100) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `woroworo`
--

INSERT INTO `woroworo` (`id_woro`, `nm_woro`, `gambar`, `keterangan`) VALUES
(1, 'burgerkil', 'burgerkill2d.jpg', 'Satu lagi musisi Indonesia yang berhasil mencuri perhatian di industri musik dunia. Kali ini, prestasi itu diraih oleh salah satu dedengkot band metal indie Burgerkill.Satu lagi musisi Indonesia yang berhasil mencuri perhatian di industri musik dunia. Kali ini, prestasi itu diraih oleh salah satu dedengkot band metal indie Burgerkill.Satu lagi musisi Indonesia yang berhasil mencuri perhatian di industri musik dunia. Kali ini, prestasi itu diraih oleh salah satu dedengkot band metal indie Burgerkill.Satu lagi musisi Indonesia yang berhasil mencuri perhatian di industri musik dunia. Kali ini, prestasi itu diraih oleh salah satu dedengkot band metal indie Burgerkill.Satu lagi musisi Indonesia yang berhasil mencuri perhatian di industri musik dunia. Kali ini, prestasi itu diraih oleh salah satu dedengkot band metal indie Burgerkill.Satu lagi musisi Indonesia yang berhasil mencuri perhatian di industri musik dunia. Kali ini, prestasi itu diraih oleh salah satu dedengkot band metal indie Burgerkill.'),
(2, 'jenglot', '20100928_112956_Death-vomit_s.jpg', 'Nasional (SSN) dibawah pembinaan Direktorat Pembinaan SMA Direktorat Jenderal Managemen Pendidikan Dasar dan Menengah Departemen Pendidikan Nasional. SMA Negeri 2 Playen pada tahun pelajaran 2008/2009 memiliki 13 rombongan belajar yang terdiri dari 5 rombel Kelas X dengan menggunakan KTSP, 5 rombel kelas XI yang menggunakan KTSP, dan 5 rombel kelas XII yang menggunakan KTSP dengan menggunakan sistem kelas bergerak (moving class).SMA Negeri 2 Playen dibina oleh tenaga pendidik dan tenaga kependidikan yang berkompeten dibidangnya. Jumlah tenaga pendidik yang berstatus PNS sebanyak 51 orang terdiri dari 22 orang guru laki-laki dan 29 orang guru perempuan, sedangkan tenaga guru yang berstatus Non PNS sebanyak 10 orang terdiri dari 8 guru laki-laki dan 2 guru perempuan. Jumlah guru yang sudah lupus sertifikasi sampai dengan tahun 2008 berjumlah 39 orang, sedang yang 11 orang guru pada tahun 2008 ini sedang dalam proses pengajuan sertifikasi.Untuk tenaga kependidikan SMA Negeri 2 Playen mimiliki 12 pegawai berstatus PNS dan 4 pegawai berstatus Non PNS. Untuk tenaga kependidikan ini tersebar mulai tenaga administrasi kesiswaan, keuangan, kurikulum, teknisi perpustakaan, laboran, uks, took sekolah, satpam, dan kebersihan.B. Visi Sekolah: Visi SMA Negeri 2 Playen:Berprestasi di bidang akademik, seni, dan olah raga dilandasi iman dan taqwa”Indikator :* Meningkatnya pengembangan kurikulum.* Terwujudnya peningkatan sumber daya manusia pendidik dan tenaga kependidikan.* Meningkatnya proses pembelajaran* Terwujudnya rencana induk pengembangan sarana prasarana pendidikan* Terwujudnya peningkatan kualitas lulusan dalam bidang akademik maupun non akademik* Terwujudnya pelaksanaan manajemen berbasis sekolah dan peningkatan mutu kelembagaan.* Terjalinnya program penggalangan pembiayaan sekolah.* Unggul dalam prestasi akademik, non akademik dalam imtaq.* Terlaksananya pengembangan implementasi pembelajaran MIPA dalam bahasa inggris.C. Misi Sekolah1. Melaksanakan pengembangan kurikulum : · Melaksanakan pengembangan kurikulum satuan pendidikan· Melaksankan pengembangan pemetaan kompetensi dasar semua mata pelajaran.· Melaksanakan pengembangan silabus.· Melaksanakan pengembangan rencana pembelajaran.· Melaksanakan pengembangan system penilaian.2. Melaksanakan Pengembangan Tenaga Kependidikan· Melaksanakan pengembangan profesionalitas guru· Melaksanakan peningkatan kompetensi guru· Melaksanakan peningkatan kompetensi TU dan tenaga kependidikan lainnya· Melaksanakan monitoring dan evaluasi kepada guru, TU dan tenaga kependidikan lainnya.3. Melaksanakan Pengembangan Proses pembelajaran.· Melaksanakan pengembangan metode pengajaran.· Melaksanakan pengembangan strategi pembelajaran· Melaksanakan pengembangan strategi penilaian.· Melaksanakan pengembangan bahan ajar/sumber pembelajaran.4. Melaksanakan Rencana Induk Pengembangan Fasilitas Pendidikan· Mengadakan media pembelajaran· Mengadakan sarana prasarana pendidikan.· Menata lingkungan belajar sehingga tercipta lingkungan belajar yang kondusif.5. Melaksanakan Pengembangan/Peningkatan Standar Ketuntasan dan Kelulusan.6. Melaksanakan Pengembangan Kelembagaan dan Manajemen Sekolah.· Mengadakan kelengkapan administrasi sekolah melalui system administrasi sekolah terpadu.· Melaksanakan MBS.· Melaksanakan monitoring dan evaluasi.· Melaksanakan supervise klinis.· Melaksanakan pengakrifan website sekolah.· Menyusun RPS.7. Melaksanakan Program Penggalangan Pembiayaan Sekolah· Melaksanakan Pengembangan Jalinan Pinjaman Dana· Melaksanakan Usaha Peningkatan Penghasilan Sekolah· Pendayagunaan Potensi Sekolah (Lingkungan )· Melaksanakan Program Subsidi Silang.8. Melaksanakan Pengembangan Penilaian· Melaksanakan Pengembangan Perangkat/ Model-Model Pembelajaran· Melaksanakan program evaluasi pembelajaran· Menyiapkan siswa melalui kegiatan pengembangan bidang akademis, non akademis dan imtaq.· Mengikuti kegiatan lomba akademis dan non akademis dan keagamaan.9. Melaksanakan Program Pengembangan/Implementasi Pembelajaran MIPA dalam Bahasa Inggris.Melaksanakan kegiatan peningkatan mutu, konstusifitas belajar lingkungan sekolah.· Meningkatkan profesionalisme dan kompetensi guru MIPA dan Bahasa Inggris.· Mengadakan dan mengembangkan fasilitas pembelajaran.· Mengembangkan manajemen pengelalaan.D. Tujuan Pendidikan1. Sekolah Mengembangkan Kurikulum· Mengembangkan kurikulum satuan pendidikan pada tahun 2006.· Mengembangkan pemetaan SK, KD, Indikator untuk kelas 10, 11, 12 pada tahun 2009.· Mengembangkan RPP untuk kelas 10, 11, 12 semua mata pelajaran.· Mengembangkan sistem penilaian berbasis kompetensi.2. Sekolah Mencapai Standar Isi (Kurikulum) pada tahun 2010.3. Sekolah memiliki/mencapai standart proses pembelajaran meliputi tahun 2008· Melaksanakan pembelajaran dengan strategi CTL.· Melaksanakan pendekatan belajar tuntas.· Melaksanakan pembelajaran inovatif.4. Sekolah memiliki/mencapai standart pendidikan dan tenaga kependidikan sesuai SPM pada tahun 2009.5. Sekolah memiliki/mencapai standart sarana/prasarana/fasilitas pada tahun 2010.6. Sekolah memiliki/mencapai standarat pengelolaan sekolah.7. Sekolah memiliki/mencapai standart pencapaian ketuntasan keompetensi/prestasi/ lulusan.8. Sekolah memiliki/mencapai standart pembiayaan sekolah.9. Sekolah memiliki/mencapai standart sekolah nasional'),
(3, 'burgerkil', 'burgerkill2d.jpg', 'Satu lagi musisi Indonesia yang berhasil mencuri perhatian di industri musik dunia. Kali ini, prestasi itu diraih oleh salah satu dedengkot band metal indie Burgerkill.Satu lagi musisi Indonesia yang berhasil mencuri perhatian di industri musik dunia. Kali ini, prestasi itu diraih oleh salah satu dedengkot band metal indie Burgerkill.Satu lagi musisi Indonesia yang berhasil mencuri perhatian di industri musik dunia. Kali ini, prestasi itu diraih oleh salah satu dedengkot band metal indie Burgerkill.Satu lagi musisi Indonesia yang berhasil mencuri perhatian di industri musik dunia. Kali ini, prestasi itu diraih oleh salah satu dedengkot band metal indie Burgerkill.Satu lagi musisi Indonesia yang berhasil mencuri perhatian di industri musik dunia. Kali ini, prestasi itu diraih oleh salah satu dedengkot band metal indie Burgerkill.Satu lagi musisi Indonesia yang berhasil mencuri perhatian di industri musik dunia. Kali ini, prestasi itu diraih oleh salah satu dedengkot band metal indie Burgerkill.'),
(4, 'jenglot', '20100928_112956_Death-vomit_s.jpg', 'Nasional (SSN) dibawah pembinaan Direktorat Pembinaan SMA Direktorat Jenderal Managemen Pendidikan Dasar dan Menengah Departemen Pendidikan Nasional. SMA Negeri 2 Playen pada tahun pelajaran 2008/2009 memiliki 13 rombongan belajar yang terdiri dari 5 rombel Kelas X dengan menggunakan KTSP, 5 rombel kelas XI yang menggunakan KTSP, dan 5 rombel kelas XII yang menggunakan KTSP dengan menggunakan sistem kelas bergerak (moving class).SMA Negeri 2 Playen dibina oleh tenaga pendidik dan tenaga kependidikan yang berkompeten dibidangnya. Jumlah tenaga pendidik yang berstatus PNS sebanyak 51 orang terdiri dari 22 orang guru laki-laki dan 29 orang guru perempuan, sedangkan tenaga guru yang berstatus Non PNS sebanyak 10 orang terdiri dari 8 guru laki-laki dan 2 guru perempuan. Jumlah guru yang sudah lupus sertifikasi sampai dengan tahun 2008 berjumlah 39 orang, sedang yang 11 orang guru pada tahun 2008 ini sedang dalam proses pengajuan sertifikasi.Untuk tenaga kependidikan SMA Negeri 2 Playen mimiliki 12 pegawai berstatus PNS dan 4 pegawai berstatus Non PNS. Untuk tenaga kependidikan ini tersebar mulai tenaga administrasi kesiswaan, keuangan, kurikulum, teknisi perpustakaan, laboran, uks, took sekolah, satpam, dan kebersihan.B. Visi Sekolah: Visi SMA Negeri 2 Playen:Berprestasi di bidang akademik, seni, dan olah raga dilandasi iman dan taqwa”Indikator :* Meningkatnya pengembangan kurikulum.* Terwujudnya peningkatan sumber daya manusia pendidik dan tenaga kependidikan.* Meningkatnya proses pembelajaran* Terwujudnya rencana induk pengembangan sarana prasarana pendidikan* Terwujudnya peningkatan kualitas lulusan dalam bidang akademik maupun non akademik* Terwujudnya pelaksanaan manajemen berbasis sekolah dan peningkatan mutu kelembagaan.* Terjalinnya program penggalangan pembiayaan sekolah.* Unggul dalam prestasi akademik, non akademik dalam imtaq.* Terlaksananya pengembangan implementasi pembelajaran MIPA dalam bahasa inggris.C. Misi Sekolah1. Melaksanakan pengembangan kurikulum : · Melaksanakan pengembangan kurikulum satuan pendidikan· Melaksankan pengembangan pemetaan kompetensi dasar semua mata pelajaran.· Melaksanakan pengembangan silabus.· Melaksanakan pengembangan rencana pembelajaran.· Melaksanakan pengembangan system penilaian.2. Melaksanakan Pengembangan Tenaga Kependidikan· Melaksanakan pengembangan profesionalitas guru· Melaksanakan peningkatan kompetensi guru· Melaksanakan peningkatan kompetensi TU dan tenaga kependidikan lainnya· Melaksanakan monitoring dan evaluasi kepada guru, TU dan tenaga kependidikan lainnya.3. Melaksanakan Pengembangan Proses pembelajaran.· Melaksanakan pengembangan metode pengajaran.· Melaksanakan pengembangan strategi pembelajaran· Melaksanakan pengembangan strategi penilaian.· Melaksanakan pengembangan bahan ajar/sumber pembelajaran.4. Melaksanakan Rencana Induk Pengembangan Fasilitas Pendidikan· Mengadakan media pembelajaran· Mengadakan sarana prasarana pendidikan.· Menata lingkungan belajar sehingga tercipta lingkungan belajar yang kondusif.5. Melaksanakan Pengembangan/Peningkatan Standar Ketuntasan dan Kelulusan.6. Melaksanakan Pengembangan Kelembagaan dan Manajemen Sekolah.· Mengadakan kelengkapan administrasi sekolah melalui system administrasi sekolah terpadu.· Melaksanakan MBS.· Melaksanakan monitoring dan evaluasi.· Melaksanakan supervise klinis.· Melaksanakan pengakrifan website sekolah.· Menyusun RPS.7. Melaksanakan Program Penggalangan Pembiayaan Sekolah· Melaksanakan Pengembangan Jalinan Pinjaman Dana· Melaksanakan Usaha Peningkatan Penghasilan Sekolah· Pendayagunaan Potensi Sekolah (Lingkungan )· Melaksanakan Program Subsidi Silang.8. Melaksanakan Pengembangan Penilaian· Melaksanakan Pengembangan Perangkat/ Model-Model Pembelajaran· Melaksanakan program evaluasi pembelajaran· Menyiapkan siswa melalui kegiatan pengembangan bidang akademis, non akademis dan imtaq.· Mengikuti kegiatan lomba akademis dan non akademis dan keagamaan.9. Melaksanakan Program Pengembangan/Implementasi Pembelajaran MIPA dalam Bahasa Inggris.Melaksanakan kegiatan peningkatan mutu, konstusifitas belajar lingkungan sekolah.· Meningkatkan profesionalisme dan kompetensi guru MIPA dan Bahasa Inggris.· Mengadakan dan mengembangkan fasilitas pembelajaran.· Mengembangkan manajemen pengelalaan.D. Tujuan Pendidikan1. Sekolah Mengembangkan Kurikulum· Mengembangkan kurikulum satuan pendidikan pada tahun 2006.· Mengembangkan pemetaan SK, KD, Indikator untuk kelas 10, 11, 12 pada tahun 2009.· Mengembangkan RPP untuk kelas 10, 11, 12 semua mata pelajaran.· Mengembangkan sistem penilaian berbasis kompetensi.2. Sekolah Mencapai Standar Isi (Kurikulum) pada tahun 2010.3. Sekolah memiliki/mencapai standart proses pembelajaran meliputi tahun 2008· Melaksanakan pembelajaran dengan strategi CTL.· Melaksanakan pendekatan belajar tuntas.· Melaksanakan pembelajaran inovatif.4. Sekolah memiliki/mencapai standart pendidikan dan tenaga kependidikan sesuai SPM pada tahun 2009.5. Sekolah memiliki/mencapai standart sarana/prasarana/fasilitas pada tahun 2010.6. Sekolah memiliki/mencapai standarat pengelolaan sekolah.7. Sekolah memiliki/mencapai standart pencapaian ketuntasan keompetensi/prestasi/ lulusan.8. Sekolah memiliki/mencapai standart pembiayaan sekolah.9. Sekolah memiliki/mencapai standart sekolah nasional');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
 ADD PRIMARY KEY (`id_absensi`), ADD KEY `nis` (`nis`), ADD KEY `id_piket` (`id_piket`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`username`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
 ADD PRIMARY KEY (`nip`), ADD KEY `kd_mapel` (`kd_mapel`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
 ADD KEY `kd_kelas` (`kd_kelas`,`nip`,`id_tahun`,`kd_mapel`), ADD KEY `kd_mapel` (`kd_mapel`), ADD KEY `nip` (`nip`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
 ADD PRIMARY KEY (`kd_kelas`), ADD KEY `nip` (`nip`);

--
-- Indexes for table `kelas_siswa`
--
ALTER TABLE `kelas_siswa`
 ADD PRIMARY KEY (`id_kelas`), ADD KEY `kd_kelas` (`kd_kelas`,`nis`,`id_tahun`), ADD KEY `nis` (`nis`), ADD KEY `id_tahun` (`id_tahun`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
 ADD PRIMARY KEY (`kd_mapel`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
 ADD KEY `nis` (`nis`), ADD KEY `nis_2` (`nis`,`kd_mapel`,`semester`,`id_tahun`,`kd_kelas`,`nip`), ADD KEY `nis_3` (`nis`,`kd_mapel`,`semester`,`id_tahun`,`kd_kelas`,`nip`), ADD KEY `kd_mapel` (`kd_mapel`), ADD KEY `id_tahun` (`id_tahun`), ADD KEY `kd_kelas` (`kd_kelas`), ADD KEY `nip` (`nip`);

--
-- Indexes for table `nil_pribadi`
--
ALTER TABLE `nil_pribadi`
 ADD KEY `id_tahun` (`id_tahun`), ADD KEY `semester` (`semester`), ADD KEY `nis` (`nis`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
 ADD PRIMARY KEY (`id_pegawai`), ADD KEY `kd_mapel` (`jabatan`);

--
-- Indexes for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
 ADD PRIMARY KEY (`id_pelanggaran`), ADD KEY `nis` (`nis`);

--
-- Indexes for table `piket`
--
ALTER TABLE `piket`
 ADD PRIMARY KEY (`id_piket`), ADD KEY `nip` (`nip`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
 ADD PRIMARY KEY (`nis`);

--
-- Indexes for table `thn_ajaran`
--
ALTER TABLE `thn_ajaran`
 ADD PRIMARY KEY (`id_tahun`), ADD KEY `thn_ajaran` (`thn_ajaran`);

--
-- Indexes for table `woroworo`
--
ALTER TABLE `woroworo`
 ADD PRIMARY KEY (`id_woro`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kelas_siswa`
--
ALTER TABLE `kelas_siswa`
MODIFY `id_kelas` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `woroworo`
--
ALTER TABLE `woroworo`
MODIFY `id_woro` int(30) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
ADD CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `guru`
--
ALTER TABLE `guru`
ADD CONSTRAINT `guru_ibfk_1` FOREIGN KEY (`kd_mapel`) REFERENCES `mapel` (`kd_mapel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
ADD CONSTRAINT `jadwal_ibfk_2` FOREIGN KEY (`kd_mapel`) REFERENCES `mapel` (`kd_mapel`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `jadwal_ibfk_3` FOREIGN KEY (`nip`) REFERENCES `guru` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `guru` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kelas_siswa`
--
ALTER TABLE `kelas_siswa`
ADD CONSTRAINT `kelas_siswa_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `kelas_siswa_ibfk_2` FOREIGN KEY (`kd_kelas`) REFERENCES `kelas` (`kd_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `kelas_siswa_ibfk_3` FOREIGN KEY (`id_tahun`) REFERENCES `thn_ajaran` (`id_tahun`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `nilai_ibfk_2` FOREIGN KEY (`kd_mapel`) REFERENCES `mapel` (`kd_mapel`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `nilai_ibfk_4` FOREIGN KEY (`id_tahun`) REFERENCES `thn_ajaran` (`id_tahun`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `nilai_ibfk_5` FOREIGN KEY (`kd_kelas`) REFERENCES `kelas` (`kd_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `nilai_ibfk_6` FOREIGN KEY (`nip`) REFERENCES `guru` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nil_pribadi`
--
ALTER TABLE `nil_pribadi`
ADD CONSTRAINT `nil_pribadi_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `nil_pribadi_ibfk_2` FOREIGN KEY (`id_tahun`) REFERENCES `thn_ajaran` (`id_tahun`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
ADD CONSTRAINT `pelanggaran_ibfk_1` FOREIGN KEY (`id_pelanggaran`) REFERENCES `siswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `piket`
--
ALTER TABLE `piket`
ADD CONSTRAINT `piket_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `guru` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
