-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 21, 2022 at 02:03 PM
-- Server version: 8.0.28
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `berita`
--

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id_berita` int NOT NULL,
  `judul_berita` varchar(255) NOT NULL,
  `isi_berita` text NOT NULL,
  `kategori_berita` int NOT NULL,
  `gambar_berita` varchar(255) DEFAULT NULL,
  `tanggalpenulisan_berita` datetime NOT NULL,
  `status_berita` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id_berita`, `judul_berita`, `isi_berita`, `kategori_berita`, `gambar_berita`, `tanggalpenulisan_berita`, `status_berita`) VALUES
(81, 'Mesjid Termegah Seikh Zayed di Solo', 'Sabtu, 19 Nopember 2022, cuaca mendung disertai rintik di Kota Surakarta, yang menjadi tuan rumah Mut\'tamar Muhammadiyah dan Aisyiah, 18 -- 20 Nopember 2022. \r\n\r\nSejak dari Jakarta sudah ada niat akan mengunjungi masjid megah dan terbesar di Asia Tenggara ini. Paling kurang dapat merasakan nikmat nya shalat tahiyatul masjid dan shalat sunat Dhuha. \r\n\r\nPada jam 09.00 udara mulai cerah, karena akan nada acara besar lima tahunan sekali, di Gedung Olah Raga Manahan dan Auditorium Universitas Muhammadiyah Solo.\r\n\r\n\r\nSampai di lokasi masjid ini, lingkungan sekitar nya masih dalam proses konstruksi, seperti sanitasi, taman, jalan di depan masjid dan proses pembangunan fly over. Semakin dekat ke masjid, perasaan semakin penuh syukur. \r\n\r\nDapat mendatangi masjid ini, yang dapat dikatakan umur nya masih hitungan hari. Mesjid megah dengan bantuan Pangeran Uni Emirat Arab.  Diresmikan oleh presiden Jokowi berrsama Pangeran Uni Emirat Arab Mohammed bin Zayed Al Nahyan, 14 Nopember 2022.\r\n\r\nMesjid ini berada di Jl. A. Yani No.128, Gilingan, Kec. Banjarsari, Kota Surakarta, Jawa Tengah. Hanya ratusan meter dari Stasiun Kereta Api, Solobalapan. Luas masjid ini 26.581 m2 dan mampu menampung 2.000 jamaah, Letak mesjid ini hanya ratusan mater dari terminal bus Surakarta,\r\n\r\nPembangunan Masjid Raya Sheikh Zayed Solo ini sudah berjalan dari dari 6 maret 2021, dengan menelan biaya sekitar Rp. 300 miliar. Gaya arsitektur  dengan 82 kubah, terlihat kental pengaruh Maroko. Malah masjid ini dapat dikatakan mengadopsi Replika Sheikh Zayed Grand Mosque Abu Dhabi. \r\n\r\nMesjid ini semakin menarik dan indah dengan lampisan batu pualam berwarna putih. Halaman nya bergaya Mughal ini membuat jamaah yang hadir di masjid ini serasa berada di Masjid Badshahi Lahore, Pakistan. Bahan bangunan yang digunakan seperti untuk  lantai, teras menggunakan marmer asli dari Italia.\r\n\r\nMenteri Energi dan Industri UEA Suhail Mohammed Al Mazroui mengatakan Pemerintah UEA, yang hadir mewakili pemerintah Uni Emiratv Arab,  mengatakan agar bangunan masjid di Solo itu mendekati dengan masjid aslinya di Abu Dhabi. \r\n\r\nMesjid ini bukan hanya dibangun sebagai simbol dan arsitektur yang megah saja melainkan diharapkan mampu menjadi destinasi wisata religi baik untuk warga Solo maupun luar kota. ', 1, '../assets/images/20221121/facb2d3e-d528-4041-84ed-4a349b9b1e43-637b4e4708a8b57b9f4dc855.jpg', '2022-11-21 19:53:37', 1),
(82, '6 Fakta Asteroid Apophis yang Melintas Bumi, Bisa Menghantam Bumi 195.000 Tahun Sekali', 'Lembaga Penerbangan dan Antariksa Nasional (LAPAN) menyebutkan kemarin, 6 Maret 2021, sebuah asteroid yang disebut asterod Apophis telah melintas dekat Bumi. Apa itu asteroid Apophis? Apophis atau dikenal sebagai 99942 Apophis (2004 MN4) adalah asteroid dekat Bumi berukuran sekitar 340 meter dan masuk dalam keluarga asteroid Aten. Dijelaskan oleh Peneliti Pusat Penelitian Sains Antariksa LAPAN, Andi Pangerang melalui laman edukasi sains lapan, dengan ukuran 340 meter tersebut, asteroid ini digolongkan sebagai asteroid yang berpotensi berbahaya (Potentially Hazardous Object, PHA). Baca juga: Hari Ini, Ada Asteroid 1999 RM45 Lewat Dekat Bumi dan Perige Bulan Sementara, keluarga asteroid Aten merupakan sekelompok asteroid yang memiliki karakteristik orbit yang serupa dengan asteroid Aten (2062 Aten), yakni titik terdekatnya lebih kecil dari titik terjauh Bumi terhadap Matahari, yaitu sekitar 147 juta kilometer. Jarak rata-rata asteroid Aten ke Matahari lebih kecil dari 1 sa (satuan astronomi, 150 juta kilometer). Apophis mengorbit Matahari selama 323,64 hari dengan kemiringan orbit 3,337 derajat dan kelonjongan orbit 0,1915 (11,5 kali lebih lonjong dibandingkan orbit Bumi).', 10, '../assets/images/20221121/5f1aabfae84b4.jpg', '2022-11-21 20:02:27', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int NOT NULL,
  `nama_kategori` varchar(26) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Nasional'),
(2, 'Global'),
(3, 'Regional'),
(4, 'Tren'),
(5, 'Hype'),
(6, 'Food'),
(7, 'Money'),
(8, 'Bola'),
(9, 'Tekno'),
(10, 'Sains'),
(11, 'Otomotif'),
(12, 'Lifestyle'),
(13, 'Health'),
(14, 'Properti'),
(15, 'Travel'),
(16, 'Edukasi');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `level_user` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `last_login`, `level_user`) VALUES
(11, 'admin', '$2y$10$2aW.PFgeP1MAIa2UOB4iZu6lWcccntZXYPaaRkx664gnzIiw0x/6.', '2022-11-21 19:57:50', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id_berita`),
  ADD KEY `Kategori Berita_idx` (`kategori_berita`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id_berita` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `berita`
--
ALTER TABLE `berita`
  ADD CONSTRAINT `Kategori Berita` FOREIGN KEY (`kategori_berita`) REFERENCES `kategori` (`id_kategori`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
