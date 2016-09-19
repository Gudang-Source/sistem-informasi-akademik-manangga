-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 19 Sep 2016 pada 17.28
-- Versi Server: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `manangga`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absen`
--

CREATE TABLE IF NOT EXISTS `absen` (
`id_absen` int(30) NOT NULL,
  `id_piket` int(30) NOT NULL,
  `nis` varchar(30) NOT NULL,
  `hadir` int(255) NOT NULL,
  `sakit` int(255) NOT NULL,
  `alfa` int(255) NOT NULL,
  `izin` int(255) NOT NULL,
  `keterangan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `username` varchar(30) NOT NULL,
  `id_user` smallint(5) unsigned NOT NULL,
  `password` varchar(30) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `administrator` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`username`, `id_user`, `password`, `foto`, `administrator`) VALUES
('admin', 1, 'admin', 'admin.jpg', 'administrator');

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE IF NOT EXISTS `berita` (
`id_berita` int(30) NOT NULL,
  `judul_berita` varchar(100) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `berita`
--

INSERT INTO `berita` (`id_berita`, `judul_berita`, `gambar`, `keterangan`) VALUES
(1, 'burgerkil', '20100928_112956_Death-vomit_s.jpg', 'Satu lagi musisi Indonesia yang berhasil mencuri perhatian di industri musik dunia. Kali ini, prestasi itu diraih oleh salah satu dedengkot band metal indie Burgerkill.Satu lagi musisi Indonesia yang berhasil mencuri perhatian di industri musik dunia. Kali ini, prestasi itu diraih oleh salah satu dedengkot band metal indie Burgerkill.Satu lagi musisi Indonesia yang berhasil mencuri perhatian di industri musik dunia. Kali ini, prestasi itu diraih oleh salah satu dedengkot band metal indie Burgerkill.Satu lagi musisi Indonesia yang berhasil mencuri perhatian di industri musik dunia. Kali ini, prestasi itu diraih oleh salah satu dedengkot band metal indie Burgerkill.Satu lagi musisi Indonesia yang berhasil mencuri perhatian di industri musik dunia. Kali ini, prestasi itu diraih oleh salah satu dedengkot band metal indie Burgerkill.Satu lagi musisi Indonesia yang berhasil mencuri perhatian di industri musik dunia. Kali ini, prestasi itu diraih oleh salah satu dedengkot band metal indie Burgerkill.'),
(2, 'jenglot', '20100928_112956_Death-vomit_s.jpg', 'Nasional (SSN) dibawah pembinaan Direktorat Pembinaan SMA Direktorat Jenderal Managemen Pendidikan Dasar dan Menengah Departemen Pendidikan Nasional. SMA Negeri 2 Playen pada tahun pelajaran 2008/2009 memiliki 13 rombongan belajar yang terdiri dari 5 rombel Kelas X dengan menggunakan KTSP, 5 rombel kelas XI yang menggunakan KTSP, dan 5 rombel kelas XII yang menggunakan KTSP dengan menggunakan sistem kelas bergerak (moving class).SMA Negeri 2 Playen dibina oleh tenaga pendidik dan tenaga kependidikan yang berkompeten dibidangnya. Jumlah tenaga pendidik yang berstatus PNS sebanyak 51 orang terdiri dari 22 orang guru laki-laki dan 29 orang guru perempuan, sedangkan tenaga guru yang berstatus Non PNS sebanyak 10 orang terdiri dari 8 guru laki-laki dan 2 guru perempuan. Jumlah guru yang sudah lupus sertifikasi sampai dengan tahun 2008 berjumlah 39 orang, sedang yang 11 orang guru pada tahun 2008 ini sedang dalam proses pengajuan sertifikasi.Untuk tenaga kependidikan SMA Negeri 2 Playen mimiliki 12 pegawai berstatus PNS dan 4 pegawai berstatus Non PNS. Untuk tenaga kependidikan ini tersebar mulai tenaga administrasi kesiswaan, keuangan, kurikulum, teknisi perpustakaan, laboran, uks, took sekolah, satpam, dan kebersihan.B. Visi Sekolah: Visi SMA Negeri 2 Playen:Berprestasi di bidang akademik, seni, dan olah raga dilandasi iman dan taqwa”Indikator :* Meningkatnya pengembangan kurikulum.* Terwujudnya peningkatan sumber daya manusia pendidik dan tenaga kependidikan.* Meningkatnya proses pembelajaran* Terwujudnya rencana induk pengembangan sarana prasarana pendidikan* Terwujudnya peningkatan kualitas lulusan dalam bidang akademik maupun non akademik* Terwujudnya pelaksanaan manajemen berbasis sekolah dan peningkatan mutu kelembagaan.* Terjalinnya program penggalangan pembiayaan sekolah.* Unggul dalam prestasi akademik, non akademik dalam imtaq.* Terlaksananya pengembangan implementasi pembelajaran MIPA dalam bahasa inggris.C. Misi Sekolah1. Melaksanakan pengembangan kurikulum : · Melaksanakan pengembangan kurikulum satuan pendidikan· Melaksankan pengembangan pemetaan kompetensi dasar semua mata pelajaran.· Melaksanakan pengembangan silabus.· Melaksanakan pengembangan rencana pembelajaran.· Melaksanakan pengembangan system penilaian.2. Melaksanakan Pengembangan Tenaga Kependidikan· Melaksanakan pengembangan profesionalitas guru· Melaksanakan peningkatan kompetensi guru· Melaksanakan peningkatan kompetensi TU dan tenaga kependidikan lainnya· Melaksanakan monitoring dan evaluasi kepada guru, TU dan tenaga kependidikan lainnya.3. Melaksanakan Pengembangan Proses pembelajaran.· Melaksanakan pengembangan metode pengajaran.· Melaksanakan pengembangan strategi pembelajaran· Melaksanakan pengembangan strategi penilaian.· Melaksanakan pengembangan bahan ajar/sumber pembelajaran.4. Melaksanakan Rencana Induk Pengembangan Fasilitas Pendidikan· Mengadakan media pembelajaran· Mengadakan sarana prasarana pendidikan.· Menata lingkungan belajar sehingga tercipta lingkungan belajar yang kondusif.5. Melaksanakan Pengembangan/Peningkatan Standar Ketuntasan dan Kelulusan.6. Melaksanakan Pengembangan Kelembagaan dan Manajemen Sekolah.· Mengadakan kelengkapan administrasi sekolah melalui system administrasi sekolah terpadu.· Melaksanakan MBS.· Melaksanakan monitoring dan evaluasi.· Melaksanakan supervise klinis.· Melaksanakan pengakrifan website sekolah.· Menyusun RPS.7. Melaksanakan Program Penggalangan Pembiayaan Sekolah· Melaksanakan Pengembangan Jalinan Pinjaman Dana· Melaksanakan Usaha Peningkatan Penghasilan Sekolah· Pendayagunaan Potensi Sekolah (Lingkungan )· Melaksanakan Program Subsidi Silang.8. Melaksanakan Pengembangan Penilaian· Melaksanakan Pengembangan Perangkat/ Model-Model Pembelajaran· Melaksanakan program evaluasi pembelajaran· Menyiapkan siswa melalui kegiatan pengembangan bidang akademis, non akademis dan imtaq.· Mengikuti kegiatan lomba akademis dan non akademis dan keagamaan.9. Melaksanakan Program Pengembangan/Implementasi Pembelajaran MIPA dalam Bahasa Inggris.Melaksanakan kegiatan peningkatan mutu, konstusifitas belajar lingkungan sekolah.· Meningkatkan profesionalisme dan kompetensi guru MIPA dan Bahasa Inggris.· Mengadakan dan mengembangkan fasilitas pembelajaran.· Mengembangkan manajemen pengelalaan.D. Tujuan Pendidikan1. Sekolah Mengembangkan Kurikulum· Mengembangkan kurikulum satuan pendidikan pada tahun 2006.· Mengembangkan pemetaan SK, KD, Indikator untuk kelas 10, 11, 12 pada tahun 2009.· Mengembangkan RPP untuk kelas 10, 11, 12 semua mata pelajaran.· Mengembangkan sistem penilaian berbasis kompetensi.2. Sekolah Mencapai Standar Isi (Kurikulum) pada tahun 2010.3. Sekolah memiliki/mencapai standart proses pembelajaran meliputi tahun 2008· Melaksanakan pembelajaran dengan strategi CTL.· Melaksanakan pendekatan belajar tuntas.· Melaksanakan pembelajaran inovatif.4. Sekolah memiliki/mencapai standart pendidikan dan tenaga kependidikan sesuai SPM pada tahun 2009.5. Sekolah memiliki/mencapai standart sarana/prasarana/fasilitas pada tahun 2010.6. Sekolah memiliki/mencapai standarat pengelolaan sekolah.7. Sekolah memiliki/mencapai standart pencapaian ketuntasan keompetensi/prestasi/ lulusan.8. Sekolah memiliki/mencapai standart pembiayaan sekolah.9. Sekolah memiliki/mencapai standart sekolah nasional'),
(3, 'burgerkil', '20100928_112956_Death-vomit_s.jpg', 'Satu lagi musisi Indonesia yang berhasil mencuri perhatian di industri musik dunia. Kali ini, prestasi itu diraih oleh salah satu dedengkot band metal indie Burgerkill.Satu lagi musisi Indonesia yang berhasil mencuri perhatian di industri musik dunia. Kali ini, prestasi itu diraih oleh salah satu dedengkot band metal indie Burgerkill.Satu lagi musisi Indonesia yang berhasil mencuri perhatian di industri musik dunia. Kali ini, prestasi itu diraih oleh salah satu dedengkot band metal indie Burgerkill.Satu lagi musisi Indonesia yang berhasil mencuri perhatian di industri musik dunia. Kali ini, prestasi itu diraih oleh salah satu dedengkot band metal indie Burgerkill.Satu lagi musisi Indonesia yang berhasil mencuri perhatian di industri musik dunia. Kali ini, prestasi itu diraih oleh salah satu dedengkot band metal indie Burgerkill.Satu lagi musisi Indonesia yang berhasil mencuri perhatian di industri musik dunia. Kali ini, prestasi itu diraih oleh salah satu dedengkot band metal indie Burgerkill.'),
(4, 'jenglot', '20100928_112956_Death-vomit_s.jpg', 'Nasional (SSN) dibawah pembinaan Direktorat Pembinaan SMA Direktorat Jenderal Managemen Pendidikan Dasar dan Menengah Departemen Pendidikan Nasional. SMA Negeri 2 Playen pada tahun pelajaran 2008/2009 memiliki 13 rombongan belajar yang terdiri dari 5 rombel Kelas X dengan menggunakan KTSP, 5 rombel kelas XI yang menggunakan KTSP, dan 5 rombel kelas XII yang menggunakan KTSP dengan menggunakan sistem kelas bergerak (moving class).SMA Negeri 2 Playen dibina oleh tenaga pendidik dan tenaga kependidikan yang berkompeten dibidangnya. Jumlah tenaga pendidik yang berstatus PNS sebanyak 51 orang terdiri dari 22 orang guru laki-laki dan 29 orang guru perempuan, sedangkan tenaga guru yang berstatus Non PNS sebanyak 10 orang terdiri dari 8 guru laki-laki dan 2 guru perempuan. Jumlah guru yang sudah lupus sertifikasi sampai dengan tahun 2008 berjumlah 39 orang, sedang yang 11 orang guru pada tahun 2008 ini sedang dalam proses pengajuan sertifikasi.Untuk tenaga kependidikan SMA Negeri 2 Playen mimiliki 12 pegawai berstatus PNS dan 4 pegawai berstatus Non PNS. Untuk tenaga kependidikan ini tersebar mulai tenaga administrasi kesiswaan, keuangan, kurikulum, teknisi perpustakaan, laboran, uks, took sekolah, satpam, dan kebersihan.B. Visi Sekolah: Visi SMA Negeri 2 Playen:Berprestasi di bidang akademik, seni, dan olah raga dilandasi iman dan taqwa”Indikator :* Meningkatnya pengembangan kurikulum.* Terwujudnya peningkatan sumber daya manusia pendidik dan tenaga kependidikan.* Meningkatnya proses pembelajaran* Terwujudnya rencana induk pengembangan sarana prasarana pendidikan* Terwujudnya peningkatan kualitas lulusan dalam bidang akademik maupun non akademik* Terwujudnya pelaksanaan manajemen berbasis sekolah dan peningkatan mutu kelembagaan.* Terjalinnya program penggalangan pembiayaan sekolah.* Unggul dalam prestasi akademik, non akademik dalam imtaq.* Terlaksananya pengembangan implementasi pembelajaran MIPA dalam bahasa inggris.C. Misi Sekolah1. Melaksanakan pengembangan kurikulum : · Melaksanakan pengembangan kurikulum satuan pendidikan· Melaksankan pengembangan pemetaan kompetensi dasar semua mata pelajaran.· Melaksanakan pengembangan silabus.· Melaksanakan pengembangan rencana pembelajaran.· Melaksanakan pengembangan system penilaian.2. Melaksanakan Pengembangan Tenaga Kependidikan· Melaksanakan pengembangan profesionalitas guru· Melaksanakan peningkatan kompetensi guru· Melaksanakan peningkatan kompetensi TU dan tenaga kependidikan lainnya· Melaksanakan monitoring dan evaluasi kepada guru, TU dan tenaga kependidikan lainnya.3. Melaksanakan Pengembangan Proses pembelajaran.· Melaksanakan pengembangan metode pengajaran.· Melaksanakan pengembangan strategi pembelajaran· Melaksanakan pengembangan strategi penilaian.· Melaksanakan pengembangan bahan ajar/sumber pembelajaran.4. Melaksanakan Rencana Induk Pengembangan Fasilitas Pendidikan· Mengadakan media pembelajaran· Mengadakan sarana prasarana pendidikan.· Menata lingkungan belajar sehingga tercipta lingkungan belajar yang kondusif.5. Melaksanakan Pengembangan/Peningkatan Standar Ketuntasan dan Kelulusan.6. Melaksanakan Pengembangan Kelembagaan dan Manajemen Sekolah.· Mengadakan kelengkapan administrasi sekolah melalui system administrasi sekolah terpadu.· Melaksanakan MBS.· Melaksanakan monitoring dan evaluasi.· Melaksanakan supervise klinis.· Melaksanakan pengakrifan website sekolah.· Menyusun RPS.7. Melaksanakan Program Penggalangan Pembiayaan Sekolah· Melaksanakan Pengembangan Jalinan Pinjaman Dana· Melaksanakan Usaha Peningkatan Penghasilan Sekolah· Pendayagunaan Potensi Sekolah (Lingkungan )· Melaksanakan Program Subsidi Silang.8. Melaksanakan Pengembangan Penilaian· Melaksanakan Pengembangan Perangkat/ Model-Model Pembelajaran· Melaksanakan program evaluasi pembelajaran· Menyiapkan siswa melalui kegiatan pengembangan bidang akademis, non akademis dan imtaq.· Mengikuti kegiatan lomba akademis dan non akademis dan keagamaan.9. Melaksanakan Program Pengembangan/Implementasi Pembelajaran MIPA dalam Bahasa Inggris.Melaksanakan kegiatan peningkatan mutu, konstusifitas belajar lingkungan sekolah.· Meningkatkan profesionalisme dan kompetensi guru MIPA dan Bahasa Inggris.· Mengadakan dan mengembangkan fasilitas pembelajaran.· Mengembangkan manajemen pengelalaan.D. Tujuan Pendidikan1. Sekolah Mengembangkan Kurikulum· Mengembangkan kurikulum satuan pendidikan pada tahun 2006.· Mengembangkan pemetaan SK, KD, Indikator untuk kelas 10, 11, 12 pada tahun 2009.· Mengembangkan RPP untuk kelas 10, 11, 12 semua mata pelajaran.· Mengembangkan sistem penilaian berbasis kompetensi.2. Sekolah Mencapai Standar Isi (Kurikulum) pada tahun 2010.3. Sekolah memiliki/mencapai standart proses pembelajaran meliputi tahun 2008· Melaksanakan pembelajaran dengan strategi CTL.· Melaksanakan pendekatan belajar tuntas.· Melaksanakan pembelajaran inovatif.4. Sekolah memiliki/mencapai standart pendidikan dan tenaga kependidikan sesuai SPM pada tahun 2009.5. Sekolah memiliki/mencapai standart sarana/prasarana/fasilitas pada tahun 2010.6. Sekolah memiliki/mencapai standarat pengelolaan sekolah.7. Sekolah memiliki/mencapai standart pencapaian ketuntasan keompetensi/prestasi/ lulusan.8. Sekolah memiliki/mencapai standart pembiayaan sekolah.9. Sekolah memiliki/mencapai standart sekolah nasional');

-- --------------------------------------------------------

--
-- Struktur dari tabel `beritaasd`
--

CREATE TABLE IF NOT EXISTS `beritaasd` (
`id_berita` int(30) NOT NULL,
  `judul_berita` varchar(100) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `keterangan_berita` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `beritaasd`
--

INSERT INTO `beritaasd` (`id_berita`, `judul_berita`, `gambar`, `keterangan_berita`) VALUES
(1, 'burgerkil', '20100928_112956_Death-vomit_s.jpg', 'Satu lagi musisi Indonesia yang berhasil mencuri perhatian di industri musik dunia. Kali ini, prestasi itu diraih oleh salah satu dedengkot band metal indie Burgerkill.Satu lagi musisi Indonesia yang berhasil mencuri perhatian di industri musik dunia. Kali ini, prestasi itu diraih oleh salah satu dedengkot band metal indie Burgerkill.Satu lagi musisi Indonesia yang berhasil mencuri perhatian di industri musik dunia. Kali ini, prestasi itu diraih oleh salah satu dedengkot band metal indie Burgerkill.Satu lagi musisi Indonesia yang berhasil mencuri perhatian di industri musik dunia. Kali ini, prestasi itu diraih oleh salah satu dedengkot band metal indie Burgerkill.Satu lagi musisi Indonesia yang berhasil mencuri perhatian di industri musik dunia. Kali ini, prestasi itu diraih oleh salah satu dedengkot band metal indie Burgerkill.Satu lagi musisi Indonesia yang berhasil mencuri perhatian di industri musik dunia. Kali ini, prestasi itu diraih oleh salah satu dedengkot band metal indie Burgerkill.'),
(2, 'jenglot', '20100928_112956_Death-vomit_s.jpg', 'Nasional (SSN) dibawah pembinaan Direktorat Pembinaan SMA Direktorat Jenderal Managemen Pendidikan Dasar dan Menengah Departemen Pendidikan Nasional. SMA Negeri 2 Playen pada tahun pelajaran 2008/2009 memiliki 13 rombongan belajar yang terdiri dari 5 rombel Kelas X dengan menggunakan KTSP, 5 rombel kelas XI yang menggunakan KTSP, dan 5 rombel kelas XII yang menggunakan KTSP dengan menggunakan sistem kelas bergerak (moving class).SMA Negeri 2 Playen dibina oleh tenaga pendidik dan tenaga kependidikan yang berkompeten dibidangnya. Jumlah tenaga pendidik yang berstatus PNS sebanyak 51 orang terdiri dari 22 orang guru laki-laki dan 29 orang guru perempuan, sedangkan tenaga guru yang berstatus Non PNS sebanyak 10 orang terdiri dari 8 guru laki-laki dan 2 guru perempuan. Jumlah guru yang sudah lupus sertifikasi sampai dengan tahun 2008 berjumlah 39 orang, sedang yang 11 orang guru pada tahun 2008 ini sedang dalam proses pengajuan sertifikasi.Untuk tenaga kependidikan SMA Negeri 2 Playen mimiliki 12 pegawai berstatus PNS dan 4 pegawai berstatus Non PNS. Untuk tenaga kependidikan ini tersebar mulai tenaga administrasi kesiswaan, keuangan, kurikulum, teknisi perpustakaan, laboran, uks, took sekolah, satpam, dan kebersihan.B. Visi Sekolah: Visi SMA Negeri 2 Playen:Berprestasi di bidang akademik, seni, dan olah raga dilandasi iman dan taqwa”Indikator :* Meningkatnya pengembangan kurikulum.* Terwujudnya peningkatan sumber daya manusia pendidik dan tenaga kependidikan.* Meningkatnya proses pembelajaran* Terwujudnya rencana induk pengembangan sarana prasarana pendidikan* Terwujudnya peningkatan kualitas lulusan dalam bidang akademik maupun non akademik* Terwujudnya pelaksanaan manajemen berbasis sekolah dan peningkatan mutu kelembagaan.* Terjalinnya program penggalangan pembiayaan sekolah.* Unggul dalam prestasi akademik, non akademik dalam imtaq.* Terlaksananya pengembangan implementasi pembelajaran MIPA dalam bahasa inggris.C. Misi Sekolah1. Melaksanakan pengembangan kurikulum : · Melaksanakan pengembangan kurikulum satuan pendidikan· Melaksankan pengembangan pemetaan kompetensi dasar semua mata pelajaran.· Melaksanakan pengembangan silabus.· Melaksanakan pengembangan rencana pembelajaran.· Melaksanakan pengembangan system penilaian.2. Melaksanakan Pengembangan Tenaga Kependidikan· Melaksanakan pengembangan profesionalitas guru· Melaksanakan peningkatan kompetensi guru· Melaksanakan peningkatan kompetensi TU dan tenaga kependidikan lainnya· Melaksanakan monitoring dan evaluasi kepada guru, TU dan tenaga kependidikan lainnya.3. Melaksanakan Pengembangan Proses pembelajaran.· Melaksanakan pengembangan metode pengajaran.· Melaksanakan pengembangan strategi pembelajaran· Melaksanakan pengembangan strategi penilaian.· Melaksanakan pengembangan bahan ajar/sumber pembelajaran.4. Melaksanakan Rencana Induk Pengembangan Fasilitas Pendidikan· Mengadakan media pembelajaran· Mengadakan sarana prasarana pendidikan.· Menata lingkungan belajar sehingga tercipta lingkungan belajar yang kondusif.5. Melaksanakan Pengembangan/Peningkatan Standar Ketuntasan dan Kelulusan.6. Melaksanakan Pengembangan Kelembagaan dan Manajemen Sekolah.· Mengadakan kelengkapan administrasi sekolah melalui system administrasi sekolah terpadu.· Melaksanakan MBS.· Melaksanakan monitoring dan evaluasi.· Melaksanakan supervise klinis.· Melaksanakan pengakrifan website sekolah.· Menyusun RPS.7. Melaksanakan Program Penggalangan Pembiayaan Sekolah· Melaksanakan Pengembangan Jalinan Pinjaman Dana· Melaksanakan Usaha Peningkatan Penghasilan Sekolah· Pendayagunaan Potensi Sekolah (Lingkungan )· Melaksanakan Program Subsidi Silang.8. Melaksanakan Pengembangan Penilaian· Melaksanakan Pengembangan Perangkat/ Model-Model Pembelajaran· Melaksanakan program evaluasi pembelajaran· Menyiapkan siswa melalui kegiatan pengembangan bidang akademis, non akademis dan imtaq.· Mengikuti kegiatan lomba akademis dan non akademis dan keagamaan.9. Melaksanakan Program Pengembangan/Implementasi Pembelajaran MIPA dalam Bahasa Inggris.Melaksanakan kegiatan peningkatan mutu, konstusifitas belajar lingkungan sekolah.· Meningkatkan profesionalisme dan kompetensi guru MIPA dan Bahasa Inggris.· Mengadakan dan mengembangkan fasilitas pembelajaran.· Mengembangkan manajemen pengelalaan.D. Tujuan Pendidikan1. Sekolah Mengembangkan Kurikulum· Mengembangkan kurikulum satuan pendidikan pada tahun 2006.· Mengembangkan pemetaan SK, KD, Indikator untuk kelas 10, 11, 12 pada tahun 2009.· Mengembangkan RPP untuk kelas 10, 11, 12 semua mata pelajaran.· Mengembangkan sistem penilaian berbasis kompetensi.2. Sekolah Mencapai Standar Isi (Kurikulum) pada tahun 2010.3. Sekolah memiliki/mencapai standart proses pembelajaran meliputi tahun 2008· Melaksanakan pembelajaran dengan strategi CTL.· Melaksanakan pendekatan belajar tuntas.· Melaksanakan pembelajaran inovatif.4. Sekolah memiliki/mencapai standart pendidikan dan tenaga kependidikan sesuai SPM pada tahun 2009.5. Sekolah memiliki/mencapai standart sarana/prasarana/fasilitas pada tahun 2010.6. Sekolah memiliki/mencapai standarat pengelolaan sekolah.7. Sekolah memiliki/mencapai standart pencapaian ketuntasan keompetensi/prestasi/ lulusan.8. Sekolah memiliki/mencapai standart pembiayaan sekolah.9. Sekolah memiliki/mencapai standart sekolah nasional'),
(3, 'burgerkil', '20100928_112956_Death-vomit_s.jpg', 'Satu lagi musisi Indonesia yang berhasil mencuri perhatian di industri musik dunia. Kali ini, prestasi itu diraih oleh salah satu dedengkot band metal indie Burgerkill.Satu lagi musisi Indonesia yang berhasil mencuri perhatian di industri musik dunia. Kali ini, prestasi itu diraih oleh salah satu dedengkot band metal indie Burgerkill.Satu lagi musisi Indonesia yang berhasil mencuri perhatian di industri musik dunia. Kali ini, prestasi itu diraih oleh salah satu dedengkot band metal indie Burgerkill.Satu lagi musisi Indonesia yang berhasil mencuri perhatian di industri musik dunia. Kali ini, prestasi itu diraih oleh salah satu dedengkot band metal indie Burgerkill.Satu lagi musisi Indonesia yang berhasil mencuri perhatian di industri musik dunia. Kali ini, prestasi itu diraih oleh salah satu dedengkot band metal indie Burgerkill.Satu lagi musisi Indonesia yang berhasil mencuri perhatian di industri musik dunia. Kali ini, prestasi itu diraih oleh salah satu dedengkot band metal indie Burgerkill.'),
(4, 'jenglot', '20100928_112956_Death-vomit_s.jpg', 'Nasional (SSN) dibawah pembinaan Direktorat Pembinaan SMA Direktorat Jenderal Managemen Pendidikan Dasar dan Menengah Departemen Pendidikan Nasional. SMA Negeri 2 Playen pada tahun pelajaran 2008/2009 memiliki 13 rombongan belajar yang terdiri dari 5 rombel Kelas X dengan menggunakan KTSP, 5 rombel kelas XI yang menggunakan KTSP, dan 5 rombel kelas XII yang menggunakan KTSP dengan menggunakan sistem kelas bergerak (moving class).SMA Negeri 2 Playen dibina oleh tenaga pendidik dan tenaga kependidikan yang berkompeten dibidangnya. Jumlah tenaga pendidik yang berstatus PNS sebanyak 51 orang terdiri dari 22 orang guru laki-laki dan 29 orang guru perempuan, sedangkan tenaga guru yang berstatus Non PNS sebanyak 10 orang terdiri dari 8 guru laki-laki dan 2 guru perempuan. Jumlah guru yang sudah lupus sertifikasi sampai dengan tahun 2008 berjumlah 39 orang, sedang yang 11 orang guru pada tahun 2008 ini sedang dalam proses pengajuan sertifikasi.Untuk tenaga kependidikan SMA Negeri 2 Playen mimiliki 12 pegawai berstatus PNS dan 4 pegawai berstatus Non PNS. Untuk tenaga kependidikan ini tersebar mulai tenaga administrasi kesiswaan, keuangan, kurikulum, teknisi perpustakaan, laboran, uks, took sekolah, satpam, dan kebersihan.B. Visi Sekolah: Visi SMA Negeri 2 Playen:Berprestasi di bidang akademik, seni, dan olah raga dilandasi iman dan taqwa”Indikator :* Meningkatnya pengembangan kurikulum.* Terwujudnya peningkatan sumber daya manusia pendidik dan tenaga kependidikan.* Meningkatnya proses pembelajaran* Terwujudnya rencana induk pengembangan sarana prasarana pendidikan* Terwujudnya peningkatan kualitas lulusan dalam bidang akademik maupun non akademik* Terwujudnya pelaksanaan manajemen berbasis sekolah dan peningkatan mutu kelembagaan.* Terjalinnya program penggalangan pembiayaan sekolah.* Unggul dalam prestasi akademik, non akademik dalam imtaq.* Terlaksananya pengembangan implementasi pembelajaran MIPA dalam bahasa inggris.C. Misi Sekolah1. Melaksanakan pengembangan kurikulum : · Melaksanakan pengembangan kurikulum satuan pendidikan· Melaksankan pengembangan pemetaan kompetensi dasar semua mata pelajaran.· Melaksanakan pengembangan silabus.· Melaksanakan pengembangan rencana pembelajaran.· Melaksanakan pengembangan system penilaian.2. Melaksanakan Pengembangan Tenaga Kependidikan· Melaksanakan pengembangan profesionalitas guru· Melaksanakan peningkatan kompetensi guru· Melaksanakan peningkatan kompetensi TU dan tenaga kependidikan lainnya· Melaksanakan monitoring dan evaluasi kepada guru, TU dan tenaga kependidikan lainnya.3. Melaksanakan Pengembangan Proses pembelajaran.· Melaksanakan pengembangan metode pengajaran.· Melaksanakan pengembangan strategi pembelajaran· Melaksanakan pengembangan strategi penilaian.· Melaksanakan pengembangan bahan ajar/sumber pembelajaran.4. Melaksanakan Rencana Induk Pengembangan Fasilitas Pendidikan· Mengadakan media pembelajaran· Mengadakan sarana prasarana pendidikan.· Menata lingkungan belajar sehingga tercipta lingkungan belajar yang kondusif.5. Melaksanakan Pengembangan/Peningkatan Standar Ketuntasan dan Kelulusan.6. Melaksanakan Pengembangan Kelembagaan dan Manajemen Sekolah.· Mengadakan kelengkapan administrasi sekolah melalui system administrasi sekolah terpadu.· Melaksanakan MBS.· Melaksanakan monitoring dan evaluasi.· Melaksanakan supervise klinis.· Melaksanakan pengakrifan website sekolah.· Menyusun RPS.7. Melaksanakan Program Penggalangan Pembiayaan Sekolah· Melaksanakan Pengembangan Jalinan Pinjaman Dana· Melaksanakan Usaha Peningkatan Penghasilan Sekolah· Pendayagunaan Potensi Sekolah (Lingkungan )· Melaksanakan Program Subsidi Silang.8. Melaksanakan Pengembangan Penilaian· Melaksanakan Pengembangan Perangkat/ Model-Model Pembelajaran· Melaksanakan program evaluasi pembelajaran· Menyiapkan siswa melalui kegiatan pengembangan bidang akademis, non akademis dan imtaq.· Mengikuti kegiatan lomba akademis dan non akademis dan keagamaan.9. Melaksanakan Program Pengembangan/Implementasi Pembelajaran MIPA dalam Bahasa Inggris.Melaksanakan kegiatan peningkatan mutu, konstusifitas belajar lingkungan sekolah.· Meningkatkan profesionalisme dan kompetensi guru MIPA dan Bahasa Inggris.· Mengadakan dan mengembangkan fasilitas pembelajaran.· Mengembangkan manajemen pengelalaan.D. Tujuan Pendidikan1. Sekolah Mengembangkan Kurikulum· Mengembangkan kurikulum satuan pendidikan pada tahun 2006.· Mengembangkan pemetaan SK, KD, Indikator untuk kelas 10, 11, 12 pada tahun 2009.· Mengembangkan RPP untuk kelas 10, 11, 12 semua mata pelajaran.· Mengembangkan sistem penilaian berbasis kompetensi.2. Sekolah Mencapai Standar Isi (Kurikulum) pada tahun 2010.3. Sekolah memiliki/mencapai standart proses pembelajaran meliputi tahun 2008· Melaksanakan pembelajaran dengan strategi CTL.· Melaksanakan pendekatan belajar tuntas.· Melaksanakan pembelajaran inovatif.4. Sekolah memiliki/mencapai standart pendidikan dan tenaga kependidikan sesuai SPM pada tahun 2009.5. Sekolah memiliki/mencapai standart sarana/prasarana/fasilitas pada tahun 2010.6. Sekolah memiliki/mencapai standarat pengelolaan sekolah.7. Sekolah memiliki/mencapai standart pencapaian ketuntasan keompetensi/prestasi/ lulusan.8. Sekolah memiliki/mencapai standart pembiayaan sekolah.9. Sekolah memiliki/mencapai standart sekolah nasional');

-- --------------------------------------------------------

--
-- Struktur dari tabel `biaya`
--

CREATE TABLE IF NOT EXISTS `biaya` (
  `id_biaya` varchar(30) NOT NULL,
  `nis` varchar(30) NOT NULL,
  `uraian` varchar(100) NOT NULL,
  `bulan` varchar(50) NOT NULL,
  `waktu_bayar` datetime NOT NULL,
  `nominal` int(255) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `id_tahun` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

CREATE TABLE IF NOT EXISTS `guru` (
  `id_kepsek` varchar(50) NOT NULL,
  `id_user` smallint(5) unsigned NOT NULL,
  `nip` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nm_guru` varchar(50) NOT NULL,
  `tmpt_lahir` varchar(50) NOT NULL,
  `date_tgl_lahir` date NOT NULL,
  `jns_kelamin` varchar(30) NOT NULL,
  `agama` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `gelar_depan` varchar(30) NOT NULL,
  `gelar_depan_akademik` varchar(30) NOT NULL,
  `gelar_belakang` varchar(30) NOT NULL,
  `almt_sekarang` text NOT NULL,
  `no_hp` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `foto` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `hari`
--

CREATE TABLE IF NOT EXISTS `hari` (
`id_hari` smallint(7) unsigned NOT NULL,
  `nm_hari` varchar(10) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data untuk tabel `hari`
--

INSERT INTO `hari` (`id_hari`, `nm_hari`) VALUES
(1, 'Senin'),
(2, 'Selasa'),
(3, 'Rabu'),
(4, 'Kamis'),
(5, 'Jumat'),
(6, 'Sabtu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal`
--

CREATE TABLE IF NOT EXISTS `jadwal` (
`id_jadwal_mapel` int(30) NOT NULL,
  `kd_kelas` smallint(30) unsigned NOT NULL,
  `nip` varchar(30) NOT NULL,
  `id_tahun` varchar(50) NOT NULL,
  `kd_mapel` varchar(30) NOT NULL,
  `jam` varchar(2) NOT NULL,
  `id_hari` smallint(7) unsigned NOT NULL,
  `id_semester` smallint(3) unsigned NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data untuk tabel `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal_mapel`, `kd_kelas`, `nip`, `id_tahun`, `kd_mapel`, `jam`, `id_hari`, `id_semester`) VALUES
(2, 1, '126500180002', '1', 'KIM2IPA', '2', 1, 1),
(4, 1, '126500180002', '1', 'KIM2IPA', '6', 2, 1),
(5, 2, '126500180001', '1', 'AGMISLM1IPS', '1', 1, 1),
(6, 2, '126500180002', '1', 'KIM2IPA', '2', 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE IF NOT EXISTS `kelas` (
`kd_kelas` smallint(30) unsigned NOT NULL,
  `nm_kelas` varchar(50) NOT NULL,
  `nip` varchar(30) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`kd_kelas`, `nm_kelas`, `nip`) VALUES
(1, 'X-IPA-1', '126500180001'),
(2, 'X-IPA-2', '126500180002');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas_siswa`
--

CREATE TABLE IF NOT EXISTS `kelas_siswa` (
`id_kelas` int(255) NOT NULL,
  `kd_kelas` smallint(30) unsigned NOT NULL,
  `nis` varchar(30) NOT NULL,
  `id_tahun` varchar(30) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelulusan`
--

CREATE TABLE IF NOT EXISTS `kelulusan` (
  `nis` int(11) DEFAULT NULL,
  `id_tahun` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kepalasekolah`
--

CREATE TABLE IF NOT EXISTS `kepalasekolah` (
  `id_guru` varchar(50) NOT NULL,
  `id_user` smallint(5) unsigned NOT NULL,
  `nip` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nm_guru` varchar(50) NOT NULL,
  `tmpt_lahir` varchar(50) NOT NULL,
  `date_tgl_lahir` date NOT NULL,
  `jns_kelamin` varchar(30) NOT NULL,
  `agama` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL,
  `kd_mapel` varchar(30) DEFAULT NULL,
  `jabatan` varchar(50) NOT NULL,
  `gelar_depan` varchar(30) NOT NULL,
  `gelar_depan_akademik` varchar(30) NOT NULL,
  `gelar_belakang` varchar(30) NOT NULL,
  `almt_sekarang` text NOT NULL,
  `no_hp` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `hari` varchar(50) NOT NULL,
  `foto` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Struktur dari tabel `mapel`
--

CREATE TABLE IF NOT EXISTS `mapel` (
  `kd_mapel` varchar(30) NOT NULL,
  `nm_mapel` varchar(30) NOT NULL,
  `kkm` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mapel`
--

INSERT INTO `mapel` (`kd_mapel`, `nm_mapel`, `kkm`) VALUES
('AGMISLM1IPS', 'Agama Islam', '75'),
('KIM2IPA', 'Kimia', '75');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE IF NOT EXISTS `nilai` (
  `nis` varchar(30) NOT NULL,
  `kd_mapel` varchar(30) NOT NULL,
  `semester` varchar(30) NOT NULL,
  `id_tahun` varchar(30) NOT NULL,
  `kd_kelas` smallint(30) unsigned NOT NULL,
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
-- Struktur dari tabel `nil_pribadi`
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
-- Struktur dari tabel `pelanggaran`
--

CREATE TABLE IF NOT EXISTS `pelanggaran` (
  `id_pelanggaran` varchar(30) NOT NULL,
  `nis` varchar(30) NOT NULL,
  `nm_pelanggaran` varchar(50) NOT NULL,
  `keterangan` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `piket`
--

CREATE TABLE IF NOT EXISTS `piket` (
  `id_piket` int(30) NOT NULL,
  `nip` varchar(30) NOT NULL,
  `hari` varchar(30) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `semester`
--

CREATE TABLE IF NOT EXISTS `semester` (
`id_semester` smallint(3) unsigned NOT NULL,
  `nm_semester` varchar(6) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `semester`
--

INSERT INTO `semester` (`id_semester`, `nm_semester`) VALUES
(1, 'ganjil'),
(2, 'genap');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE IF NOT EXISTS `siswa` (
  `id_siswa` varchar(50) NOT NULL,
  `nis` varchar(50) NOT NULL,
  `id_user` smallint(5) unsigned NOT NULL,
  `password` varchar(50) NOT NULL,
  `nm_siswa` varchar(50) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `date_tgl_lahir` date NOT NULL,
  `gol_darah` varchar(30) NOT NULL,
  `jns_kelamin` varchar(30) NOT NULL,
  `agama` varchar(30) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `alamat` text NOT NULL,
  `id_ortu` int(200) NOT NULL,
  `email` varchar(40) NOT NULL,
  `telp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `thn_ajaran`
--

CREATE TABLE IF NOT EXISTS `thn_ajaran` (
  `id_tahun` varchar(30) NOT NULL,
  `thn_ajaran` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `thn_ajaran`
--

INSERT INTO `thn_ajaran` (`id_tahun`, `thn_ajaran`) VALUES
('1', '2014/2015'),
('2', '2015/2016');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `kategori_user` varchar(50) NOT NULL,
`id_user` smallint(5) unsigned NOT NULL,
  `tingkat_user` tinyint(3) unsigned NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`kategori_user`, `id_user`, `tingkat_user`) VALUES
('Admin', 1, 10),
('Guru', 2, 1),
('Siswa', 3, 0),
('Pegawai Tu', 4, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absen`
--
ALTER TABLE `absen`
 ADD PRIMARY KEY (`id_absen`), ADD KEY `id_piket` (`id_piket`), ADD KEY `nis` (`nis`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`username`), ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
 ADD PRIMARY KEY (`id_berita`);

--
-- Indexes for table `beritaasd`
--
ALTER TABLE `beritaasd`
 ADD PRIMARY KEY (`id_berita`);

--
-- Indexes for table `biaya`
--
ALTER TABLE `biaya`
 ADD PRIMARY KEY (`id_biaya`), ADD KEY `nis` (`nis`), ADD KEY `id_tahun` (`id_tahun`), ADD KEY `id_tahun_2` (`id_tahun`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
 ADD PRIMARY KEY (`id_kepsek`), ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `hari`
--
ALTER TABLE `hari`
 ADD PRIMARY KEY (`id_hari`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
 ADD PRIMARY KEY (`id_jadwal_mapel`), ADD KEY `kd_kelas` (`kd_kelas`,`nip`,`id_tahun`,`kd_mapel`), ADD KEY `kd_mapel` (`kd_mapel`), ADD KEY `nip` (`nip`), ADD KEY `id_tahun` (`id_tahun`), ADD KEY `id_hari` (`id_hari`), ADD KEY `id_semester` (`id_semester`), ADD KEY `id_semester_2` (`id_semester`);

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
-- Indexes for table `kepalasekolah`
--
ALTER TABLE `kepalasekolah`
 ADD PRIMARY KEY (`id_guru`), ADD KEY `kd_mapel` (`kd_mapel`), ADD KEY `id_user` (`id_user`);

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
-- Indexes for table `semester`
--
ALTER TABLE `semester`
 ADD PRIMARY KEY (`id_semester`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
 ADD PRIMARY KEY (`id_siswa`), ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `thn_ajaran`
--
ALTER TABLE `thn_ajaran`
 ADD PRIMARY KEY (`id_tahun`), ADD KEY `thn_ajaran` (`thn_ajaran`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absen`
--
ALTER TABLE `absen`
MODIFY `id_absen` int(30) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
MODIFY `id_berita` int(30) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `beritaasd`
--
ALTER TABLE `beritaasd`
MODIFY `id_berita` int(30) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `hari`
--
ALTER TABLE `hari`
MODIFY `id_hari` smallint(7) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
MODIFY `id_jadwal_mapel` int(30) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
MODIFY `kd_kelas` smallint(30) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `kelas_siswa`
--
ALTER TABLE `kelas_siswa`
MODIFY `id_kelas` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
MODIFY `id_semester` smallint(3) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id_user` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `absen`
--
ALTER TABLE `absen`
ADD CONSTRAINT `absen_ibfk_1` FOREIGN KEY (`id_piket`) REFERENCES `piket` (`id_piket`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `absen_ibfk_2` FOREIGN KEY (`nis`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `admin`
--
ALTER TABLE `admin`
ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `biaya`
--
ALTER TABLE `biaya`
ADD CONSTRAINT `biaya_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `biaya_ibfk_2` FOREIGN KEY (`id_tahun`) REFERENCES `thn_ajaran` (`id_tahun`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jadwal`
--
ALTER TABLE `jadwal`
ADD CONSTRAINT `jadwal_ibfk_2` FOREIGN KEY (`kd_mapel`) REFERENCES `mapel` (`kd_mapel`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `jadwal_ibfk_3` FOREIGN KEY (`nip`) REFERENCES `gurus` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `jadwal_ibfk_5` FOREIGN KEY (`id_tahun`) REFERENCES `thn_ajaran` (`id_tahun`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `jadwal_ibfk_6` FOREIGN KEY (`kd_kelas`) REFERENCES `kelas` (`kd_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `jadwal_ibfk_7` FOREIGN KEY (`id_hari`) REFERENCES `hari` (`id_hari`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `jadwal_ibfk_8` FOREIGN KEY (`id_semester`) REFERENCES `semester` (`id_semester`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kelas`
--
ALTER TABLE `kelas`
ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `gurus` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kelas_siswa`
--
ALTER TABLE `kelas_siswa`
ADD CONSTRAINT `kelas_siswa_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `kelas_siswa_ibfk_3` FOREIGN KEY (`id_tahun`) REFERENCES `thn_ajaran` (`id_tahun`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `kelas_siswa_ibfk_4` FOREIGN KEY (`kd_kelas`) REFERENCES `kelas` (`kd_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `nilai`
--
ALTER TABLE `nilai`
ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `nilai_ibfk_2` FOREIGN KEY (`kd_mapel`) REFERENCES `mapel` (`kd_mapel`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `nilai_ibfk_4` FOREIGN KEY (`id_tahun`) REFERENCES `thn_ajaran` (`id_tahun`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `nilai_ibfk_6` FOREIGN KEY (`nip`) REFERENCES `gurus` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `nilai_ibfk_7` FOREIGN KEY (`kd_kelas`) REFERENCES `kelas` (`kd_kelas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `nil_pribadi`
--
ALTER TABLE `nil_pribadi`
ADD CONSTRAINT `nil_pribadi_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `nil_pribadi_ibfk_2` FOREIGN KEY (`id_tahun`) REFERENCES `thn_ajaran` (`id_tahun`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pelanggaran`
--
ALTER TABLE `pelanggaran`
ADD CONSTRAINT `pelanggaran_ibfk_1` FOREIGN KEY (`id_pelanggaran`) REFERENCES `siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `piket`
--
ALTER TABLE `piket`
ADD CONSTRAINT `piket_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `gurus` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `siswa`
--
ALTER TABLE `siswa`
ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
