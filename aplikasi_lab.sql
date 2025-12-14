-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 14, 2025 at 07:45 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aplikasi_lab`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel_cache_5c785c036466adea360111aa28563bfd556b5fba', 'i:2;', 1763384984),
('laravel_cache_5c785c036466adea360111aa28563bfd556b5fba:timer', 'i:1763384984;', 1763384984),
('laravel_cache_ac3478d69a3c81fa62e60f5c3696165a4e5e6ac4', 'i:1;', 1763739691),
('laravel_cache_ac3478d69a3c81fa62e60f5c3696165a4e5e6ac4:timer', 'i:1763739691;', 1763739691);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galeris`
--

CREATE TABLE `galeris` (
  `id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `tagar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galeris`
--

INSERT INTO `galeris` (`id`, `judul`, `slug`, `gambar`, `deskripsi`, `tagar`, `created_at`, `updated_at`) VALUES
(1, 'Profil Desa Tunjung Jatilawang', 'profil-desa-tunjung-jatilawang-sK5q3', 'galeri/IpvnllppXV3DmfDbJ5SkguYeON81xKG9SDUfjIKf.jpg', 'kkn bersama', 'kkn', '2025-11-25 00:08:43', '2025-11-25 00:12:54'),
(2, '15 Contoh Artikel Singkat & Menarik dari Berbagai Tema', '15-contoh-artikel-singkat-menarik-dari-berbagai-tema-7Jxvt', 'galeri/s37ZAVI9RHQo1oeUlUtyNnOdBggWb63Vk7nTu6Ci.jpg', 'Yup, artikel adalah salah satu wadah untuk memperoleh informasi. Artikel disusun berdasarkan opini dan data-data yang dikumpulkan penulis. Artikel umumnya punya 4 struktur. Hayo, masih ingat nggak? Ada judul, pendahuluan, isi, penutup, dan referensi. \r\n\r\nTopik artikel sendiri bisa bermacam-macam, tergantung tren yang sedang populer. kebutuhan para pembaca, atau keperluan akademik. Seperti contoh artikel ilmiah, contoh artikel opini, contoh artikel populer, contoh artikel kesehatan, dan masih banyak lagi.\r\n\r\nBiar makin kebayang, yuk simak contoh artikel singkat di bawah ini!', 'ilmu', '2025-11-25 00:49:57', '2025-11-25 00:49:57'),
(3, 'Smart Payday Promo Brain Academy Online untuk Persiapan PAS dan SNBT', 'smart-payday-promo-brain-academy-online-untuk-persiapan-pas-dan-snbt-Rv0yM', 'galeri/eWhK4LK7wme6GdQo6rmBguYm45asvFRdr5GDiKpc.jpg', 'Minggu depan sudah masuk PAS semester ganjil, apakah kamu sudah siap? terutama untuk kamu yang sekarang duduk di bangku kelas 10 dan 11 SMA, saatnya mempersiapkan nilai rapor untuk bekal SNBP di tahun depan. Dan untuk kamu yang duduk di kelas 12 SMA sudah saatnya persiapkan SNBT. Buruan klaim Smart Payday Promo dengan diskon s.d. 42% + Tabungan Emas s.d. 200rb*. Penasaran? Yuk, cek info lengkapnya di sini!', NULL, '2025-11-25 00:51:38', '2025-11-25 00:51:38'),
(4, 'Contoh Soal & Pembahasan PAS Kelas 10 IPA Semester Ganjil', 'contoh-soal-pembahasan-pas-kelas-10-ipa-semester-ganjil-IwZeq', 'galeri/bCyDpLkOGDOW36xZMUfxxOeF5gUVhAmNTycYGT3m.jpg', '1. Pengertian teks anekdot adalah… \r\n\r\nCerita menarik dan menghibur mengenai cara menyelesaikan, membuat, atau melakukan suatu aktivitas tertentu.\r\nTeks yang menceritakan suatu kejadian yang lucu dengan harapan dapat membuat pembacanya tertawa.\r\nTeks yang mengandung informasi atau pengetahuan menarik dalam bentuk singkat dan jelas sehingga dapat menambah pengetahuan dan menghibur pembacanya.\r\nTeks yang berisi penjelasan unik dan menarik mengenai peristiwa alam, ilmu pengetahuan, sosial, budaya, yang dikemas secara singkat, padat, dan jelas.\r\nCerita singkat yang menarik karena lucu dan mengesankan, biasanya mengenai orang penting atau terkenal dan mempunyai maksud untuk melakukan kritik atau menyampaikan pesan lewat kritikan tersebut. \r\n\r\nPembahasan:\r\n\r\nTeks anekdot adalah cerita singkat yang menarik karena lucu dan mengesankan. Cerita dalam teks anekdot biasanya mengenai orang penting atau terkenal dan berdasarkan kejadian yang sebenarnya . Teks anekdot mempunyai maksud untuk melakukan kritik atau menyampaikan pesan lewat kritikan tersebut.', 'ilmu', '2025-11-25 01:01:57', '2025-11-25 01:01:57'),
(5, 'Apa Perbedaan Garam Himalaya dengan Garam Dapur?', 'apa-perbedaan-garam-himalaya-dengan-garam-dapur-ymosU', 'galeri/DbkETCer3WV9hFIqyqYDseiKkTF1yKkJwukqSC9x.jpg', 'Kamu pasti pernah denger kan Himalayan Salt? Yap, garam Himalaya memiliki ciri khas tersendiri yang bikin banyak orang jatuh hati. Berbeda dengan garam yang biasa kamu pake masak di dapur, garam Himalaya memiliki warna pink yang sekilas mirip dengan buah persik.\r\n\r\nGaram Himalaya cukup memiliki pamor di dapur banyak orang, loh, khususnya para elit yang mengklaim bahwa garam ini lebih baik dan sehat dibandingkan garam pada umumnya. Tapi kamu tahu nggak, sih? Bahkan garam Himalaya itu bukan garam beneran yang biasanya berasal dari laut, loh! Yuk, simak pembahasan kali ini mengenai perbedaan garam Himalaya dengan garam dapur!', 'garam', '2025-11-25 01:02:50', '2025-11-25 01:03:59'),
(6, '21 Contoh Artikel Singkat dan Menarik dalam Berbagai Tema', '21-contoh-artikel-singkat-dan-menarik-dalam-berbagai-tema-380rt', 'galeri/ZqdiK9jpbZboR7ITsxwrJwTDtssXdzzqMhRt9aUi.jpg', 'Guys, tentunya, kamu sudah sering kan membaca artikel di internet? Bahkan, informasi yang sedang kamu baca saat ini juga termasuk artikel, loh! Hehe… Tapi, kamu tau gak sih artikel itu apa sebenarnya?\r\n\r\nArtikel adalah bentuk karya tulis yang menyediakan informasi atau pandangan dari penulis. Biasanya, artikel berbentuk tulisan yang pendek, yaitu sekitar 350 hingga 2000 kata, meskipun begitu, ada juga loh artikel yang panjangnya melebihi 2000 kata. Panjangnya yang berbeda-beda, akan tergantung dari seberapa banyak informasi yang ingin disampaikan.', 'film', '2025-11-25 01:04:41', '2025-11-25 01:04:41'),
(7, 'Contoh Artikel Opini tentang Pola Tidur yang Sehat', 'contoh-artikel-opini-tentang-pola-tidur-yang-sehat-Q7GWe', 'galeri/RRWEXUJAXlXL5JQUBz44e9jChBPCzJLK1qptXKad.jpg', 'Tidur adalah kebutuhan manusia yang sangat penting untuk menjaga kesehatan fisik dan mental, karena saat tidur organ tubuh kita juga beristirahat. Kalau kamu tidak tidur, pasti kamu akan merasa kelelahan dan bisa menyebabkan kematian lho. \r\n\r\nMemiliki waktu tidur yang cukup dan berkualitas adalah kunci untuk merasa segar dan bugar sepanjang hari. Namun, seringkali kita mengabaikan pentingnya waktu tidur yang cukup, dan hal ini dapat berdampak negatif bagi kesehatan kita secara keseluruhan.', 'film', '2025-11-25 01:05:15', '2025-11-25 01:05:15'),
(8, 'Contoh Artikel Opini tentang Peran Media Massa', 'contoh-artikel-opini-tentang-peran-media-massa-RJEGK', 'galeri/0CSXCkgafFM44pzSRD8iO6mJjRBPCOAffzV40OjY.jpg', 'Pungutan liar (pungli) memang berkelindan dengan korupsi. Mereka serupa tapi tak sama, ada tapi tak kasat mata, merajalela tapi tetap dimaklumkan, seolah hal tersebut sudah biasa terjadi. \r\n\r\nSelama masyarakat tidak keberatan ‘menghibahkan’ sebagian kecil hartanya bagi para pemungut, masyarakat akan tetap diam. Tentu saja pemakluman yang terus menerus ini berimbas pada kepercayaan dan kualitas terhadap institusi terkait.\r\n\r\nBeda cerita ketika pungutan itu terjadi di sebuah institusi yang lebih besar dari segi fungsi dan kedudukannya terhadap negara. Secara otomatis hal ini akan menyedot perhatian yang lebih besar pula. Terlebih jika institusi tersebut ‘tertangkap basah’ oleh presiden, seperti yang beberapa waktu lalu terjadi di Kementerian Perhubungan. Jumlahnya pun fantastis, hingga mencapai milyaran rupiah.', 'film', '2025-11-25 01:08:04', '2025-11-25 01:08:04'),
(9, 'Artikel Opini tentang Hari Perempuan Internasional', 'artikel-opini-tentang-hari-perempuan-internasional-M6q1J', 'galeri/kC6cVxtmzDgvwIBV9d5NElmsJjfYk6BY6zTeXcMu.jpg', 'Seratus enam puluh tahun berlalu. Pada masanya, New York City mengandung kemarahan oleh para perempuan yang berjibaku dengan pekerjaan kasar namun tidak menerima gaji yang setimpal. Perempuan-perempuan itu merupakan buruh garmen yang berusaha untuk mengikuti arus industrialisasi dan memiliki alasan tersirat tentang bekerja untuk hidup. Hal ini memicu keluarnya gagasan terkait perayaan tentang hari perempuan. Seratus enam puluh tahun kemudian, tepatnya pada 8 Maret 2017, perempuan kembali mendapat ‘apresiasi’ dengan diperingatinya Hari Perempuan Internasional atau International Women’s Day.', 'film', '2025-11-25 01:08:29', '2025-11-25 01:08:29'),
(10, 'Analisis Fonetik pada Realisasi Konsonan dalam Bahasa Indonesia', 'analisis-fonetik-pada-realisasi-konsonan-dalam-bahasa-indonesia-BCOam', 'galeri/f0nr8SS59TyHriKOOxs4kVXS1odZmlr42dcCcy99.png', 'Artikel ini bertujuan untuk melakukan analisis fonetik terhadap realisasi konsonan dalam bahasa Indonesia. Dalam lingkup ini, penelitian difokuskan pada konsonan-konsonan tertentu, dan variasi-variasi fonetik yang mungkin terjadi dalam produksi suara. Metode penelitian yang digunakan melibatkan rekaman percakapan sehari-hari dari berbagai penutur bahasa Indonesia dari berbagai daerah.', 'ilmu', '2025-11-25 01:08:58', '2025-11-25 01:08:58'),
(12, 'Bagaimana Cara Membuat Artikel yang Baik? Ini dia Caranya', 'bagaimana-cara-membuat-artikel-yang-baik-ini-dia-caranya-HPkak', 'galeri/2z91VkZItNMFAQWG0BlqOMh2F06phdmKt5kUPKv9.jpg', 'Bagaimana Cara Membuat Artikel yang Baik? Ini dia Caranya\r\nMenulis artikel adalah kemampuan penting yang harus dimiliki oleh mahasiswa, khususnya bagi mereka yang menempuh pendidikan di S2 Ilmu Komunikasi. Dalam program ini, mahasiswa dilatih untuk menyusun gagasan secara sistematis dan logis agar mampu menghasilkan karya tulis ilmiah maupun populer yang efektif dan komunikatif.\r\n\r\nApa Itu Artikel?\r\nArtikel merupakan tulisan yang berisi opini, informasi, atau analisis terhadap suatu topik yang disampaikan secara tertulis. Artikel bisa ditemukan di berbagai media seperti surat kabar, majalah, jurnal, dan platform digital.\r\n\r\nMenulis artikel adalah proses mengkomunikasikan ide secara tertulis dengan struktur dan tujuan tertentu.\r\nArtikel juga dapat bertujuan untuk memberikan informasi, membujuk pembaca, atau menyampaikan pandangan penulis.\r\nCara Membuat Artikel\r\nBagi mahasiswa Pascasarjana Ilmu Komunikasi, memahami cara membuat artikel menjadi keterampilan dasar yang perlu dikuasai. Berikut langkah-langkah menulis artikel:\r\n\r\n1. Menentukan topik: Pilih topik yang relevan dan menarik.\r\n2. Melakukan riset: Kumpulkan data dari sumber terpercaya.\r\n3. Menyusun kerangka artikel: Buat struktur logis sebagai panduan penulisan.\r\n4. Menulis draf pertama: Fokus pada pengembangan ide.\r\n5. Merevisi dan mengedit: Periksa ejaan, tata bahasa, dan kelogisan isi.\r\n6. Menyesuaikan dengan media tujuan: Gaya penulisan harus sesuai dengan target pembaca.', 'pmm', '2025-11-27 05:25:48', '2025-11-27 05:25:48'),
(13, '21 Contoh Artikel Singkat dan Menarik dalam Berbagai Tema', '21-contoh-artikel-singkat-dan-menarik-dalam-berbagai-tema-jhnky', 'galeri/hxS4rueKRq7pm6URK4IYMjWnQsD3GWORXlYFe7nT.jpg', '<p><strong>Artikel adalah</strong> bentuk <strong>karya tulis yang menyediakan informasi atau pandangan dari penulis</strong>. Biasanya, artikel berbentuk tulisan yang pendek, yaitu sekitar 350 hingga 2000 kata, meskipun begitu, ada juga loh artikel yang panjangnya melebihi 2000 kata.&nbsp;Panjangnya yang berbeda-beda, akan tergantung dari seberapa banyak informasi yang ingin disampaikan.</p><h4>Artikel juga memiliki beberapa struktur yang menyusun penulisannya. Artikel yang baik memiliki <strong>tiga struktur</strong> seperti di bawah ini:</h4><ul><li><strong>Gagasan utama:</strong> ide utama atau isu yang ingin ditulis di dalam artikel.</li><li><strong>Argumentasi atau pendapat: </strong><i>statement</i> atau pendapat dari penulis atau pembuat artikel terhadap isu yang dituliskan.</li><li><strong>Penegasan ulang:</strong> argumentasi yang dibuat untuk menegaskan kembali apa yang sedang dibahas, hal ini bisa berupa kesimpulan dari artikel yang ditulis.</li></ul>', 'pmm', '2025-11-27 05:55:27', '2025-12-14 00:27:01');

-- --------------------------------------------------------

--
-- Table structure for table `galeri_comments`
--

CREATE TABLE `galeri_comments` (
  `id` bigint UNSIGNED NOT NULL,
  `galeri_id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galeri_comments`
--

INSERT INTO `galeri_comments` (`id`, `galeri_id`, `nama`, `komentar`, `created_at`, `updated_at`) VALUES
(1, 1, 'Selena Gomez', 'bagus', '2025-11-25 00:09:50', '2025-11-25 00:09:50'),
(2, 7, 'Amarra', 'bagus', '2025-11-25 02:50:25', '2025-11-25 02:50:25'),
(3, 12, 'Magdalena', 'i wanna back', '2025-11-27 05:26:56', '2025-11-27 05:26:56'),
(5, 13, 'Magdalena', 'i wanna back', '2025-12-13 23:41:02', '2025-12-13 23:41:02');

-- --------------------------------------------------------

--
-- Table structure for table `ikas`
--

CREATE TABLE `ikas` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_lokasi` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sungai` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal` date NOT NULL,
  `kategori` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` decimal(10,6) DEFAULT NULL,
  `longitude` decimal(10,6) DEFAULT NULL,
  `kelas1` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kelas2` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kelas3` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kelas4` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ikas`
--

INSERT INTO `ikas` (`id`, `kode_lokasi`, `alamat`, `sungai`, `tanggal`, `kategori`, `latitude`, `longitude`, `kelas1`, `kelas2`, `kelas3`, `kelas4`, `created_at`, `updated_at`) VALUES
(3, 'A3-JT-15-005', 'Tunjung, Kec. Jatilawang, Kab. Banyumas, Jawa Tengah 53174', 'Sungai Lusi', '2025-11-27', 'Air Sungai', '-7.533713', '109.114327', '3.37 / Cemar Ringan', '3.37 / Cemar Ringan', '3.37 / Cemar Ringan', '3.37 / Cemar Ringan', '2025-11-27 06:03:24', '2025-11-27 06:03:24');

-- --------------------------------------------------------

--
-- Table structure for table `ikus`
--

CREATE TABLE `ikus` (
  `id` bigint UNSIGNED NOT NULL,
  `kabupaten_kota` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rataan_no2` decimal(10,2) DEFAULT NULL,
  `rataan_so2` decimal(10,2) DEFAULT NULL,
  `indeks_no2` decimal(10,2) DEFAULT NULL,
  `indeks_so2` decimal(10,2) DEFAULT NULL,
  `rataan_indeks` decimal(10,2) DEFAULT NULL,
  `nilai_iku` decimal(10,2) DEFAULT NULL,
  `target_iku` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ikus`
--

INSERT INTO `ikus` (`id`, `kabupaten_kota`, `rataan_no2`, `rataan_so2`, `indeks_no2`, `indeks_so2`, `rataan_indeks`, `nilai_iku`, `target_iku`, `created_at`, `updated_at`) VALUES
(3, 'Purwodadi', '7.33', '7.33', '7.33', '7.33', '7.33', '91.20', '90.00', '2025-11-25 22:17:11', '2025-11-25 22:17:11'),
(4, 'Klaten', '7.33', '7.33', '7.33', '7.33', '7.33', '91.20', '90.00', '2025-11-27 05:57:41', '2025-11-27 05:57:41');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(7, '0001_01_01_000000_create_users_table', 1),
(8, '0001_01_01_000001_create_cache_table', 1),
(9, '0001_01_01_000002_create_jobs_table', 1),
(10, '2025_11_21_162124_create_test_requests_table', 2),
(11, '2025_11_23_095823_add_fix_fields_to_test_requests_table', 3),
(12, '2025_11_23_104708_add_sample_pickup_date_to_test_requests_table', 4),
(13, '2025_11_24_152545_create_test_results_table', 5),
(14, '2025_11_25_070243_create_galeris_table', 6),
(15, '2025_11_25_070339_create_galeri_comments_table', 6),
(16, '2025_11_25_165421_create_ikas_table', 7),
(17, '2025_11_25_165437_create_ikus_table', 7),
(18, '2025_11_26_070721_create_struktur_organisasis_table', 8),
(19, '2025_12_12_071846_create_struktur_organisasis_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('rohmannawatimagdalena@gmail.com', '$2y$12$SzU92fKdxtNyQ.e3xBmx3uQl2X1jRutBl8xYOE0K82/kyubbbYouK', '2025-12-13 21:52:44');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('kJvac5J8qgS8mOVv4vnFp8cvcPHPHAxRyj2g99V3', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMzJDTk1xa2JJcndzU2dEYTlCNnNWZnBBSlFXMWdPWjF4WGloYWR4UyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9zZXRlbGFuIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mzt9', 1765697305);

-- --------------------------------------------------------

--
-- Table structure for table `struktur_organisasis`
--

CREATE TABLE `struktur_organisasis` (
  `id` bigint UNSIGNED NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `urutan` int UNSIGNED NOT NULL DEFAULT '0',
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `struktur_organisasis`
--

INSERT INTO `struktur_organisasis` (`id`, `jabatan`, `nama`, `foto`, `urutan`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'Manajer Puncak', 'Drs. Mokamat, M.Si.', NULL, 1, NULL, '2025-12-12 00:23:10', '2025-12-12 00:23:10'),
(2, 'Manajer Mutu', 'Riwan Triono, S.Hut., M.Si.', NULL, 1, 1, '2025-12-12 00:23:10', '2025-12-12 00:23:10'),
(3, 'Manajer Teknis', 'Ita Puspitasari, S.T., M.M.', NULL, 2, 1, '2025-12-12 00:23:10', '2025-12-12 00:23:10'),
(4, 'Manajer Administrasi', 'Suprihno, S.Sos.', NULL, 3, 1, '2025-12-12 00:23:10', '2025-12-12 00:23:10'),
(5, 'Staf Mutu', 'Syahidun Najih Me, S.T.', NULL, 1, 2, '2025-12-12 00:23:10', '2025-12-12 00:23:10'),
(6, 'Penyelia', 'M. Ajib Ubaidillah, S.Si.', NULL, 1, 3, '2025-12-12 00:23:10', '2025-12-12 00:23:10'),
(7, 'Petugas K3L', 'Eko Triyono.', NULL, 2, 3, '2025-12-12 00:23:10', '2025-12-12 00:23:10'),
(8, 'Penerima Contoh Uji', 'Dara Ayu K.', NULL, 1, 4, '2025-12-12 00:23:10', '2025-12-12 00:23:10'),
(9, 'Penerima Contoh Uji', 'Dian Ernawati.', NULL, 2, 4, '2025-12-12 00:23:10', '2025-12-12 00:23:10'),
(10, 'Staf Administrasi', 'Eka Ismiatul A, S.T.', NULL, 3, 4, '2025-12-12 00:23:10', '2025-12-12 00:23:10'),
(11, 'Analis', 'Nurul Izzaty, S.T.', 'struktur/7X1yo5xJHSzjAxCIlHXdky3KKtj0YezS8SMcBZQf.jpg', 1, 6, '2025-12-12 00:23:10', '2025-12-12 00:36:16'),
(12, 'Petugas Sampling', 'Eko Triyono.', NULL, 2, 6, '2025-12-12 00:23:10', '2025-12-12 00:23:10');

-- --------------------------------------------------------

--
-- Table structure for table `test_requests`
--

CREATE TABLE `test_requests` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `pic_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pic_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pic_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sample_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_type` enum('uji kualitas sungai','uji kualitas limbah','uji kualitas danau','uji kualitas lindi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `fix_fields` json DEFAULT NULL,
  `letter_file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pemeriksaan kelengkapan','persyaratan tidak lengkap','persyaratan lengkap','jadwal pengambilan sampel','pengambilan sampel','uji selesai','verifikasi hasil uji','penerbitan LHU','selesai') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pemeriksaan kelengkapan',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sample_pickup_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `test_requests`
--

INSERT INTO `test_requests` (`id`, `user_id`, `pic_name`, `pic_phone`, `pic_email`, `sample_address`, `service_type`, `notes`, `fix_fields`, `letter_file`, `status`, `created_at`, `updated_at`, `sample_pickup_date`) VALUES
(5, 7, 'Nisa', '0882006590899', 'lenaschool100@gmail.com', 'Purwokerto Utara', 'uji kualitas danau', NULL, NULL, 'permohonan/nyRkVIX5soBAXXngKW3APprFsh273CO25v6qKQ5s.jpg', 'penerbitan LHU', '2025-11-23 04:34:07', '2025-11-23 05:07:16', '2025-12-05'),
(8, 7, 'Angga Yunanda', '0882006590899', 'backupfilelena@gmail.com', 'Purwokerto Utara', 'uji kualitas limbah', NULL, NULL, 'permohonan/aN0tOvIoTH8I5DbkLMxcSfDAX2yN7CeCS96MQksg.jpg', 'pemeriksaan kelengkapan', '2025-11-24 21:05:22', '2025-11-24 21:05:22', NULL),
(9, 9, 'Nurul Izaty', '0882006590899', 'rohmannawatimagdalena@gmail.com', 'Purwokerto Utara', 'uji kualitas sungai', NULL, NULL, 'permohonan/HKAygPMZ2HTBXx2Y6oKUfdNRYYXiZIe9PD0ykYE6.pdf', 'uji selesai', '2025-11-27 02:55:56', '2025-11-27 04:57:23', NULL),
(10, 9, 'Nurul Izaty', '0882006590899', 'rohmannawatimagdalena@gmail.com', 'Purwokerto Utara', 'uji kualitas limbah', NULL, NULL, 'permohonan/adNcSErkcMpBtNWVRdtxBCUgCrvagLeRme4xgP34.pdf', 'penerbitan LHU', '2025-11-27 02:56:42', '2025-11-27 04:57:14', NULL),
(11, 9, 'Nurul Izaty', '0882006590899', 'rohmannawatimagdalena@gmail.com', 'Purwokerto Utara', 'uji kualitas danau', NULL, NULL, 'permohonan/dpdQoqdFnghvv1SA09bTax0Jsr1oqMER7wi0yqXl.jpg', 'uji selesai', '2025-11-27 02:57:10', '2025-11-27 04:57:08', NULL),
(12, 9, 'Nurul Izaty', '0882006590899', 'rohmannawatimagdalena@gmail.com', 'Purwokerto Utara', 'uji kualitas lindi', NULL, NULL, 'permohonan/hFyCmf66unckKZWvLkyuoFyqr6uDUbNHRmdBTsxr.png', 'verifikasi hasil uji', '2025-11-27 02:58:08', '2025-11-27 04:57:01', NULL),
(13, 9, 'Nurul Izaty', '0882006590899', 'rohmannawatimagdalena@gmail.com', 'Purwokerto Utara', 'uji kualitas lindi', NULL, NULL, 'permohonan/Fa3LZC0zfV0Fohsk0akYQXX0DrOv2nFwnQbGi3Pw.jpg', 'penerbitan LHU', '2025-11-27 03:29:47', '2025-11-27 04:56:55', NULL),
(14, 9, 'Nurul Izaty', '0882006590899', 'rohmannawatimagdalena@gmail.com', 'Purwokerto Utara', 'uji kualitas limbah', '1', NULL, 'permohonan/uj6j3viqdCq4dSSRR8kO1aXfVjVjntCFvpTvcUAw.jpg', 'penerbitan LHU', '2025-11-27 03:30:08', '2025-11-27 04:56:48', NULL),
(15, 9, 'Nurul Izaty', '0882006590899', 'rohmannawatimagdalena@gmail.com', 'Purwokerto Utara', 'uji kualitas danau', NULL, NULL, 'permohonan/WM131pv9knEIU4oOt2Pg8G2JIToqsdGCDG1QMQJI.png', 'uji selesai', '2025-11-27 03:30:41', '2025-11-27 04:56:41', NULL),
(16, 9, 'Nurul Izaty', '0882006590899', 'rohmannawatimagdalena@gmail.com', 'Purwokerto Utara', 'uji kualitas lindi', NULL, NULL, 'permohonan/2IVQUF6kcBuGBQx9kTadDdKhphlRBCmZzvQqw7u0.png', 'verifikasi hasil uji', '2025-11-27 03:31:01', '2025-11-27 04:56:32', NULL),
(17, 9, 'Nurul Izaty', '0882006590899', 'rohmannawatimagdalena@gmail.com', 'Purwokerto Utara', 'uji kualitas limbah', NULL, NULL, 'permohonan/Qn0xFI4arJywI8xIJVtFtYhQaCwnqh6fANVsfxPR.png', 'penerbitan LHU', '2025-11-27 03:31:18', '2025-11-27 04:56:22', NULL),
(18, 9, 'Nurul Izaty', '0882006590899', 'rohmannawatimagdalena@gmail.com', 'Purwokerto Utara', 'uji kualitas sungai', '1', NULL, 'permohonan/fSRdI4ByVDsYSo1b68WbGZ0f0l3f1JGvSc6gdWHl.png', 'verifikasi hasil uji', '2025-11-27 03:31:51', '2025-11-27 04:58:05', '2025-11-29'),
(19, 9, 'Nurul Izaty', '0882006590899', 'rohmannawatimagdalena@gmail.com', 'Purwokerto Utara', 'uji kualitas danau', NULL, NULL, 'permohonan/yvmWoVsrOLgR7mtVgqQMujlOU9hNBnhz5mNNDHYE.png', 'uji selesai', '2025-11-27 03:32:20', '2025-11-27 04:55:28', NULL),
(22, 13, 'Maudy Ayunda', '0882006590899', 'rohmannawatimagdalena@gmail.com', 'Purwokerto', 'uji kualitas danau', 'Segera', NULL, 'permohonan/R6IeBTEh2J8quf9YdMYuyKOdyTG8JnZsuVL7ITWG.jpg', 'uji selesai', '2025-12-13 23:46:36', '2025-12-14 00:08:34', '2025-12-20');

-- --------------------------------------------------------

--
-- Table structure for table `test_results`
--

CREATE TABLE `test_results` (
  `id` bigint UNSIGNED NOT NULL,
  `test_request_id` bigint UNSIGNED NOT NULL,
  `kode_dokumen` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rev_tanggal` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hal` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_pelanggan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_pengambilan_contoh` date DEFAULT NULL,
  `jenis_kegiatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lokasi_pengambilan_contoh` text COLLATE utf8mb4_unicode_ci,
  `waktu_pengambilan_contoh` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_contoh` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acuan_baku_mutu` text COLLATE utf8mb4_unicode_ci,
  `suhu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `suhu_satuan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `suhu_baku_mutu` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `suhu_keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ph` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ph_satuan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ph_baku_mutu` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ph_keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `do` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `do_satuan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `do_baku_mutu` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `do_keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tss` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tss_satuan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tss_baku_mutu` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tss_keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tds` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tds_satuan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tds_baku_mutu` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tds_keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cod` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cod_satuan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cod_baku_mutu` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cod_keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bod` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bod_satuan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bod_baku_mutu` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bod_keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nitrit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nitrat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nitrat_satuan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nitrat_baku_mutu` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nitrat_keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_fosfat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_fosfat_satuan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_fosfat_baku_mutu` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_fosfat_keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amonia` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amonia_satuan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amonia_baku_mutu` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amonia_keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecal_coliform` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecal_coliform_satuan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecal_coliform_baku_mutu` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecal_coliform_keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `daya_hantar_listrik` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `daya_hantar_listrik_satuan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `daya_hantar_listrik_baku_mutu` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `daya_hantar_listrik_keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kekeruhan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kekeruhan_satuan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kekeruhan_baku_mutu` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kekeruhan_keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `minyak_lemak` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mbas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_mutu` enum('memenuhi','cemar ringan','cemar sedang','cemar berat') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nilai_ika` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `result_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `test_results`
--

INSERT INTO `test_results` (`id`, `test_request_id`, `kode_dokumen`, `rev_tanggal`, `hal`, `nama_pelanggan`, `tanggal_pengambilan_contoh`, `jenis_kegiatan`, `lokasi_pengambilan_contoh`, `waktu_pengambilan_contoh`, `kode_contoh`, `acuan_baku_mutu`, `suhu`, `suhu_satuan`, `suhu_baku_mutu`, `suhu_keterangan`, `ph`, `ph_satuan`, `ph_baku_mutu`, `ph_keterangan`, `do`, `do_satuan`, `do_baku_mutu`, `do_keterangan`, `tss`, `tss_satuan`, `tss_baku_mutu`, `tss_keterangan`, `tds`, `tds_satuan`, `tds_baku_mutu`, `tds_keterangan`, `cod`, `cod_satuan`, `cod_baku_mutu`, `cod_keterangan`, `bod`, `bod_satuan`, `bod_baku_mutu`, `bod_keterangan`, `nitrit`, `nitrat`, `nitrat_satuan`, `nitrat_baku_mutu`, `nitrat_keterangan`, `total_fosfat`, `total_fosfat_satuan`, `total_fosfat_baku_mutu`, `total_fosfat_keterangan`, `amonia`, `amonia_satuan`, `amonia_baku_mutu`, `amonia_keterangan`, `fecal_coliform`, `fecal_coliform_satuan`, `fecal_coliform_baku_mutu`, `fecal_coliform_keterangan`, `daya_hantar_listrik`, `daya_hantar_listrik_satuan`, `daya_hantar_listrik_baku_mutu`, `daya_hantar_listrik_keterangan`, `kekeruhan`, `kekeruhan_satuan`, `kekeruhan_baku_mutu`, `kekeruhan_keterangan`, `minyak_lemak`, `mbas`, `status_mutu`, `nilai_ika`, `result_file`, `created_at`, `updated_at`) VALUES
(16, 22, '222', '12 desember', '1/2', 'Badan Gizi Nasional', '2025-12-27', '333', 'Purwokerto', NULL, '555', 'pp1990', '28', '°C', '-', 'eeee', '3', '-', '6 - 9', NULL, '80', 'mg/l', '-', NULL, '22', 'mg/l', '30', NULL, '66', 'mg/l', '-', 'rrrr', '0.5', 'mg/l', '80', NULL, '78', 'mg/l', '12', NULL, NULL, '33', 'mg/l', '-', NULL, '88', 'mg/l', '-', NULL, '56', 'mg/l', '-', NULL, '2.0', 'MPN/100ml', '200', NULL, '1.6', 'µS/cm', '-', NULL, '0.8', 'NTU', '-', NULL, NULL, NULL, NULL, NULL, 'hasil_uji/UCzGN14P4HLQkSKaf1ru46ebj4D9KLiBC9dT8kbX.pdf', '2025-12-14 00:10:04', '2025-12-14 00:12:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'customer',
  `nomor_hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instansi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `verification_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `role`, `nomor_hp`, `instansi`, `google_id`, `email_verified_at`, `verification_code`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'Admin Laboratorium', 'mgdlenar8@gmail.com', '$2y$12$aafkiJFrLC/ZykFI.xyHO.MyMdrcb/s/yzVhA8JsvWZLyQizOKOBS', 'admin', NULL, NULL, NULL, '2025-12-13 21:08:30', NULL, NULL, '2025-12-13 21:08:30', '2025-12-14 00:22:36'),
(7, 'Magdalena', 'lenaschool100@gmail.com', '$2y$12$wO2PtaPNUS6dEAkV/k74ceMz0kwvn0kqnPRzw2vzkrHnY2S5P0dIa', 'customer', '081392450459', 'Universitas Jenderal Soedirman', NULL, '2025-11-22 10:58:31', NULL, NULL, '2025-11-22 10:58:11', '2025-11-22 11:02:15'),
(9, 'Nurul Izzaty', 'rohmannawatimagdalena@gmail.com', '$2y$12$hgIfQGqgJu9l85cLfvEOyeywP9NVaT4pPDP5LJK9Wdpq65i7V7bXW', 'customer', '08122819938', 'Dinas Lingkungan Hidup Kabupaten Grobogan', NULL, '2025-11-27 02:54:48', NULL, NULL, '2025-11-27 02:54:16', '2025-12-13 21:41:41'),
(13, 'Maudy Ayunda', 'magdalena.rohmannawati@mhs.unsoed.ac.id', '$2y$12$cSvhc4AE2oE0WaTsgtmgWenDcw/2uN8IdXrub4T8gYJ8wgY6j5nne', 'customer', '081392450459', 'Badan Gizi Nasional', NULL, '2025-12-13 23:44:48', NULL, 'SgKFgEagRiDy7GJd84rZGOOh6PcHTCtrwDRDfbGBWihlbSQGebG9ZySoHgg8', '2025-12-13 23:44:26', '2025-12-13 23:47:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `galeris`
--
ALTER TABLE `galeris`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `galeris_slug_unique` (`slug`);

--
-- Indexes for table `galeri_comments`
--
ALTER TABLE `galeri_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `galeri_comments_galeri_id_foreign` (`galeri_id`);

--
-- Indexes for table `ikas`
--
ALTER TABLE `ikas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ikas_kode_lokasi_index` (`kode_lokasi`);

--
-- Indexes for table `ikus`
--
ALTER TABLE `ikus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ikus_kabupaten_kota_index` (`kabupaten_kota`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `struktur_organisasis`
--
ALTER TABLE `struktur_organisasis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `struktur_organisasis_parent_id_urutan_index` (`parent_id`,`urutan`);

--
-- Indexes for table `test_requests`
--
ALTER TABLE `test_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `test_requests_user_id_foreign` (`user_id`);

--
-- Indexes for table `test_results`
--
ALTER TABLE `test_results`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `test_results_test_request_id_unique` (`test_request_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galeris`
--
ALTER TABLE `galeris`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `galeri_comments`
--
ALTER TABLE `galeri_comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ikas`
--
ALTER TABLE `ikas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ikus`
--
ALTER TABLE `ikus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `struktur_organisasis`
--
ALTER TABLE `struktur_organisasis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `test_requests`
--
ALTER TABLE `test_requests`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `test_results`
--
ALTER TABLE `test_results`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `galeri_comments`
--
ALTER TABLE `galeri_comments`
  ADD CONSTRAINT `galeri_comments_galeri_id_foreign` FOREIGN KEY (`galeri_id`) REFERENCES `galeris` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `struktur_organisasis`
--
ALTER TABLE `struktur_organisasis`
  ADD CONSTRAINT `struktur_organisasis_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `struktur_organisasis` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `test_requests`
--
ALTER TABLE `test_requests`
  ADD CONSTRAINT `test_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `test_results`
--
ALTER TABLE `test_results`
  ADD CONSTRAINT `test_results_test_request_id_foreign` FOREIGN KEY (`test_request_id`) REFERENCES `test_requests` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
