-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 22 Des 2016 pada 11.27
-- Versi Server: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ict_erp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_group_id` int(11) NOT NULL DEFAULT '1',
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `linked` enum('Company','Employee') NOT NULL DEFAULT 'Company',
  `company_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `user_group_id`, `first_name`, `last_name`, `email`, `password`, `remember_token`, `linked`, `company_id`, `employee_id`, `is_active`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 'Faky', 'Faky', 'it@ict.co.id', '$2y$10$ZDEQU.oXaMO6M0DpMtFtoegM7Y0.S3.f2tBLGRYlMAvYhjb2vH3eW', 'OQT4FMGzTN9vjseqPYJ1aiFax6zQYB7qNQ1jMG4b8baWbfLHYAREOkczIW9z', 'Company', 1, 0, 1, '2016-09-01 00:00:00', 1, '2016-11-09 16:33:12', 1),
(2, 1, 'Hendar', 'Nunuk', 'hendarsyahss@gmail.com', '$2y$10$3uoEnPLhqAQtmAUIJETeDO3ME3mfrzGCQkTv5D2UeNs0gHbg88Vqy', NULL, 'Company', 0, 0, 1, '2016-12-22 03:58:07', 1, NULL, NULL),
(3, 1, 'De', 'Su', 'hendarsyahss2@gmail.com', '$2y$10$CET.UrcBesAigLErXLgTu.JO68ly.T/E3/WiD7GbYhaEhfyjFfRgy', '5SFA9dHCwzZu7dhLmpdrsHc0tcsKixUTRu1mD7JzrWzoXnBD0OjtPnzB2e5G', 'Company', 0, 0, 1, '2016-12-22 03:59:22', 1, '2016-12-22 09:38:08', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
