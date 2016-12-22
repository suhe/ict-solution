-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2016 at 05:11 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

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
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `is_active`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'Medan', 1, '2016-12-21 00:00:00', 1, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `npwp` varchar(100) NOT NULL,
  `address_1` varchar(255) NOT NULL,
  `address_2` varchar(255) NOT NULL,
  `city_id` int(11) NOT NULL,
  `zip_code` varchar(5) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `npwp`, `address_1`, `address_2`, `city_id`, `zip_code`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'PT ANGKASA PURA SOLUSI Ku', '01.071.557.1 - 058.000', 'Terminal 2F Kedatangan; Ruang F9P67', 'Bandara Internasional Soekarno-Hatta', 1, '19120', '2016-12-22 04:00:00', 1, '2016-12-22 13:26:26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `identity_number` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `customer_group_id` int(11) NOT NULL,
  `contact_person` varchar(100) NOT NULL,
  `contact_position` varchar(100) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `city_id` int(11) NOT NULL,
  `zip_code` varchar(5) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `identity_number`, `name`, `customer_group_id`, `contact_person`, `contact_position`, `phone_number`, `address`, `city_id`, `zip_code`, `is_active`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'IP00000001', 'PT. BANK RAKYAT INDONESIA (PERSERO), TBK.', 1, 'NIZAR ALAMSYAH', 'Se', '08522205405', 'KANTOR KAS BANK BRI KNO', 1, '12059', 1, '2016-12-07 09:00:00', 1, '2016-12-21 09:39:01', 0),
(3, '12095', 'Asia Pacific', 1, 'banddd', 'jalsa', '08522205405', 'sdadasd', 1, '23232', 1, '2016-12-21 09:12:10', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_groups`
--

CREATE TABLE `customer_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_groups`
--

INSERT INTO `customer_groups` (`id`, `name`, `is_active`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'BANK BRI', 1, '2016-12-07 00:00:00', 1, '0000-00-00 00:00:00', 0),
(2, 'Garuda Indonesia', 1, '2016-12-22 07:41:39', 3, '2016-12-22 07:43:12', 3),
(3, 'Lions Group', 1, '2016-12-22 07:45:11', 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `telephone_billings`
--

CREATE TABLE `telephone_billings` (
  `id` int(11) NOT NULL,
  `number` varchar(100) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `payment_method_id` int(11) NOT NULL,
  `payment_frequency` varchar(20) NOT NULL,
  `print_date` date NOT NULL,
  `due_date` date NOT NULL,
  `service_periode` varchar(100) NOT NULL,
  `abodemen` double NOT NULL,
  `japati` double NOT NULL,
  `mobile` double NOT NULL,
  `local` double NOT NULL,
  `sljj` double NOT NULL,
  `sli_007` double NOT NULL,
  `telkom_global_017` double NOT NULL,
  `surcharge` double NOT NULL,
  `ppn` double NOT NULL,
  `total_bill` double NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `telephone_billings`
--

INSERT INTO `telephone_billings` (`id`, `number`, `customer_id`, `payment_method_id`, `payment_frequency`, `print_date`, `due_date`, `service_periode`, `abodemen`, `japati`, `mobile`, `local`, `sljj`, `sli_007`, `telkom_global_017`, `surcharge`, `ppn`, `total_bill`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, '/APS-FIN/ICT-TLP/XI/2014', 1, 1, 'BULANAN', '2016-12-22', '2016-12-30', 'Mei 2014 s/d Oktober 2014', 0, 0, 0, 0, 0, 0, 0, 0, 0, 3000000, '2016-12-22 07:00:00', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `telephone_billing_details`
--

CREATE TABLE `telephone_billing_details` (
  `id` int(11) NOT NULL,
  `telephone_billing_id` int(11) NOT NULL,
  `phone_number` varchar(28) NOT NULL,
  `period` varchar(100) NOT NULL,
  `abonemen` double NOT NULL,
  `japati` double NOT NULL,
  `mobile` double NOT NULL,
  `local` double NOT NULL,
  `sljj` double NOT NULL,
  `sli_007` double NOT NULL,
  `telkom_global_017` double NOT NULL,
  `surcharge` double NOT NULL,
  `ppn` double NOT NULL,
  `subtotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `telephone_billing_details`
--

INSERT INTO `telephone_billing_details` (`id`, `telephone_billing_id`, `phone_number`, `period`, `abonemen`, `japati`, `mobile`, `local`, `sljj`, `sli_007`, `telkom_global_017`, `surcharge`, `ppn`, `subtotal`) VALUES
(1, 1, '06188880532', 'Mei 2016', 120000, 120000, 120000, 120000, 120000, 120000, 120000, 15, 10, 32000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
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
  `company_id` int(11) NOT NULL DEFAULT '1',
  `employee_id` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_group_id`, `first_name`, `last_name`, `email`, `password`, `remember_token`, `linked`, `company_id`, `employee_id`, `is_active`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 1, 'Faky', 'Faky', 'it@ict.co.id', '$2y$10$ZDEQU.oXaMO6M0DpMtFtoegM7Y0.S3.f2tBLGRYlMAvYhjb2vH3eW', 'OQT4FMGzTN9vjseqPYJ1aiFax6zQYB7qNQ1jMG4b8baWbfLHYAREOkczIW9z', 'Company', 1, 0, 1, '2016-09-01 00:00:00', 1, '2016-11-09 16:33:12', 1),
(2, 1, 'Hendar', 'Nunuk', 'hendarsyahss@gmail.com', '$2y$10$3uoEnPLhqAQtmAUIJETeDO3ME3mfrzGCQkTv5D2UeNs0gHbg88Vqy', NULL, 'Company', 0, 0, 1, '2016-12-22 03:58:07', 1, NULL, NULL),
(3, 1, 'De', 'Su', 'hendarsyahss2@gmail.com', '$2y$10$CET.UrcBesAigLErXLgTu.JO68ly.T/E3/WiD7GbYhaEhfyjFfRgy', '5SFA9dHCwzZu7dhLmpdrsHc0tcsKixUTRu1mD7JzrWzoXnBD0OjtPnzB2e5G', 'Company', 0, 0, 1, '2016-12-22 03:59:22', 1, '2016-12-22 09:38:08', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `name`, `description`, `is_active`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'Administrator', 'Full Access', 1, '2016-12-22 00:00:00', 1, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_group_modules`
--

CREATE TABLE `user_group_modules` (
  `id` int(11) NOT NULL,
  `user_group_id` int(11) NOT NULL,
  `module_slug` varchar(100) NOT NULL,
  `access` enum('r','c','u','d') NOT NULL DEFAULT 'r'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_groups`
--
ALTER TABLE `customer_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `telephone_billings`
--
ALTER TABLE `telephone_billings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `telephone_billing_details`
--
ALTER TABLE `telephone_billing_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_group_modules`
--
ALTER TABLE `user_group_modules`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `customer_groups`
--
ALTER TABLE `customer_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `telephone_billings`
--
ALTER TABLE `telephone_billings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `telephone_billing_details`
--
ALTER TABLE `telephone_billing_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_group_modules`
--
ALTER TABLE `user_group_modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
