-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2016 at 04:20 AM
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
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `country_id` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `name`, `description`, `country_id`, `is_active`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'BCA', 'Bank Central Asia ', 101, 1, '0000-00-00 00:00:00', 0, '2016-12-23 02:53:31', 3),
(2, 'Mandiri', 'Bank Mandiri', 101, 1, '2016-12-23 02:54:25', 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

CREATE TABLE `bank_accounts` (
  `id` int(11) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `branch` varchar(100) NOT NULL,
  `account_no` varchar(100) NOT NULL,
  `account_name` varchar(100) NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT '1',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank_accounts`
--

INSERT INTO `bank_accounts` (`id`, `bank_id`, `branch`, `account_no`, `account_name`, `company_id`, `is_active`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 2, 'Terminal II D/E Bandara Soekarno-Hatta', '116 - 00 - 96011516', 'PT Angkasa Pura Solusi', 1, 1, '2016-12-23 00:14:00', 1, '2016-12-23 03:23:40', 3),
(2, 1, 'Merana Palama', '5425040212', 'Suhendar', 1, 1, '2016-12-23 03:24:24', 3, NULL, NULL);

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
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `code` varchar(2) NOT NULL DEFAULT '',
  `name` varchar(100) NOT NULL DEFAULT '',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `code`, `name`, `is_active`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'AF', 'Afghanistan', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(2, 'AL', 'Albania', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(3, 'DZ', 'Algeria', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(4, 'DS', 'American Samoa', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(5, 'AD', 'Andorra', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(6, 'AO', 'Angola', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(7, 'AI', 'Anguilla', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(8, 'AQ', 'Antarctica', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(9, 'AG', 'Antigua and Barbuda', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(10, 'AR', 'Argentina', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(11, 'AM', 'Armenia', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(12, 'AW', 'Aruba', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(13, 'AU', 'Australia', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(14, 'AT', 'Austria', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(15, 'AZ', 'Azerbaijan', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(16, 'BS', 'Bahamas', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(17, 'BH', 'Bahrain', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(18, 'BD', 'Bangladesh', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(19, 'BB', 'Barbados', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(20, 'BY', 'Belarus', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(21, 'BE', 'Belgium', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(22, 'BZ', 'Belize', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(23, 'BJ', 'Benin', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(24, 'BM', 'Bermuda', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(25, 'BT', 'Bhutan', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(26, 'BO', 'Bolivia', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(27, 'BA', 'Bosnia and Herzegovina', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(28, 'BW', 'Botswana', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(29, 'BV', 'Bouvet Island', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(30, 'BR', 'Brazil', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(31, 'IO', 'British Indian Ocean Territory', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(32, 'BN', 'Brunei Darussalam', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(33, 'BG', 'Bulgaria', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(34, 'BF', 'Burkina Faso', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(35, 'BI', 'Burundi', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(36, 'KH', 'Cambodia', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(37, 'CM', 'Cameroon', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(38, 'CA', 'Canada', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(39, 'CV', 'Cape Verde', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(40, 'KY', 'Cayman Islands', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(41, 'CF', 'Central African Republic', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(42, 'TD', 'Chad', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(43, 'CL', 'Chile', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(44, 'CN', 'China', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(45, 'CX', 'Christmas Island', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(46, 'CC', 'Cocos (Keeling) Islands', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(47, 'CO', 'Colombia', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(48, 'KM', 'Comoros', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(49, 'CG', 'Congo', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(50, 'CK', 'Cook Islands', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(51, 'CR', 'Costa Rica', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(52, 'HR', 'Croatia (Hrvatska)', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(53, 'CU', 'Cuba', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(54, 'CY', 'Cyprus', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(55, 'CZ', 'Czech Republic', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(56, 'DK', 'Denmark', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(57, 'DJ', 'Djibouti', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(58, 'DM', 'Dominica', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(59, 'DO', 'Dominican Republic', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(60, 'TP', 'East Timor', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(61, 'EC', 'Ecuador', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(62, 'EG', 'Egypt', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(63, 'SV', 'El Salvador', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(64, 'GQ', 'Equatorial Guinea', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(65, 'ER', 'Eritrea', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(66, 'EE', 'Estonia', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(67, 'ET', 'Ethiopia', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(68, 'FK', 'Falkland Islands (Malvinas)', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(69, 'FO', 'Faroe Islands', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(70, 'FJ', 'Fiji', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(71, 'FI', 'Finland', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(72, 'FR', 'France', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(73, 'FX', 'France, Metropolitan', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(74, 'GF', 'French Guiana', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(75, 'PF', 'French Polynesia', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(76, 'TF', 'French Southern Territories', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(77, 'GA', 'Gabon', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(78, 'GM', 'Gambia', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(79, 'GE', 'Georgia', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(80, 'DE', 'Germany', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(81, 'GH', 'Ghana', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(82, 'GI', 'Gibraltar', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(83, 'GK', 'Guernsey', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(84, 'GR', 'Greece', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(85, 'GL', 'Greenland', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(86, 'GD', 'Grenada', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(87, 'GP', 'Guadeloupe', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(88, 'GU', 'Guam', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(89, 'GT', 'Guatemala', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(90, 'GN', 'Guinea', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(91, 'GW', 'Guinea-Bissau', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(92, 'GY', 'Guyana', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(93, 'HT', 'Haiti', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(94, 'HM', 'Heard and Mc Donald Islands', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(95, 'HN', 'Honduras', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(96, 'HK', 'Hong Kong', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(97, 'HU', 'Hungary', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(98, 'IS', 'Iceland', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(99, 'IN', 'India', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(100, 'IM', 'Isle of Man', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(101, 'ID', 'Indonesia', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(102, 'IR', 'Iran (Islamic Republic of)', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(103, 'IQ', 'Iraq', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(104, 'IE', 'Ireland', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(105, 'IL', 'Israel', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(106, 'IT', 'Italy', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(107, 'CI', 'Ivory Coast', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(108, 'JE', 'Jersey', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(109, 'JM', 'Jamaica', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(110, 'JP', 'Japan', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(111, 'JO', 'Jordan', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(112, 'KZ', 'Kazakhstan', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(113, 'KE', 'Kenya', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(114, 'KI', 'Kiribati', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(115, 'KP', 'Korea, Democratic People''s Republic of', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(116, 'KR', 'Korea, Republic of', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(117, 'XK', 'Kosovo', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(118, 'KW', 'Kuwait', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(119, 'KG', 'Kyrgyzstan', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(120, 'LA', 'Lao People''s Democratic Republic', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(121, 'LV', 'Latvia', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(122, 'LB', 'Lebanon', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(123, 'LS', 'Lesotho', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(124, 'LR', 'Liberia', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(125, 'LY', 'Libyan Arab Jamahiriya', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(126, 'LI', 'Liechtenstein', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(127, 'LT', 'Lithuania', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(128, 'LU', 'Luxembourg', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(129, 'MO', 'Macau', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(130, 'MK', 'Macedonia', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(131, 'MG', 'Madagascar', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(132, 'MW', 'Malawi', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(133, 'MY', 'Malaysia', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(134, 'MV', 'Maldives', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(135, 'ML', 'Mali', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(136, 'MT', 'Malta', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(137, 'MH', 'Marshall Islands', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(138, 'MQ', 'Martinique', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(139, 'MR', 'Mauritania', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(140, 'MU', 'Mauritius', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(141, 'TY', 'Mayotte', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(142, 'MX', 'Mexico', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(143, 'FM', 'Micronesia, Federated States of', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(144, 'MD', 'Moldova, Republic of', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(145, 'MC', 'Monaco', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(146, 'MN', 'Mongolia', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(147, 'ME', 'Montenegro', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(148, 'MS', 'Montserrat', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(149, 'MA', 'Morocco', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(150, 'MZ', 'Mozambique', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(151, 'MM', 'Myanmar', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(152, 'NA', 'Namibia', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(153, 'NR', 'Nauru', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(154, 'NP', 'Nepal', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(155, 'NL', 'Netherlands', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(156, 'AN', 'Netherlands Antilles', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(157, 'NC', 'New Caledonia', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(158, 'NZ', 'New Zealand', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(159, 'NI', 'Nicaragua', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(160, 'NE', 'Niger', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(161, 'NG', 'Nigeria', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(162, 'NU', 'Niue', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(163, 'NF', 'Norfolk Island', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(164, 'MP', 'Northern Mariana Islands', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(165, 'NO', 'Norway', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(166, 'OM', 'Oman', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(167, 'PK', 'Pakistan', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(168, 'PW', 'Palau', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(169, 'PS', 'Palestine', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(170, 'PA', 'Panama', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(171, 'PG', 'Papua New Guinea', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(172, 'PY', 'Paraguay', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(173, 'PE', 'Peru', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(174, 'PH', 'Philippines', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(175, 'PN', 'Pitcairn', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(176, 'PL', 'Poland', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(177, 'PT', 'Portugal', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(178, 'PR', 'Puerto Rico', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(179, 'QA', 'Qatar', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(180, 'RE', 'Reunion', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(181, 'RO', 'Romania', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(182, 'RU', 'Russian Federation', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(183, 'RW', 'Rwanda', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(184, 'KN', 'Saint Kitts and Nevis', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(185, 'LC', 'Saint Lucia', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(186, 'VC', 'Saint Vincent and the Grenadines', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(187, 'WS', 'Samoa', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(188, 'SM', 'San Marino', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(189, 'ST', 'Sao Tome and Principe', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(190, 'SA', 'Saudi Arabia', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(191, 'SN', 'Senegal', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(192, 'RS', 'Serbia', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(193, 'SC', 'Seychelles', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(194, 'SL', 'Sierra Leone', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(195, 'SG', 'Singapore', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(196, 'SK', 'Slovakia', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(197, 'SI', 'Slovenia', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(198, 'SB', 'Solomon Islands', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(199, 'SO', 'Somalia', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(200, 'ZA', 'South Africa', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(201, 'GS', 'South Georgia South Sandwich Islands', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(202, 'ES', 'Spain', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(203, 'LK', 'Sri Lanka', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(204, 'SH', 'St. Helena', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(205, 'PM', 'St. Pierre and Miquelon', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(206, 'SD', 'Sudan', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(207, 'SR', 'Suriname', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(208, 'SJ', 'Svalbard and Jan Mayen Islands', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(209, 'SZ', 'Swaziland', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(210, 'SE', 'Sweden', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(211, 'CH', 'Switzerland', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(212, 'SY', 'Syrian Arab Republic', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(213, 'TW', 'Taiwan', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(214, 'TJ', 'Tajikistan', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(215, 'TZ', 'Tanzania, United Republic of', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(216, 'TH', 'Thailand', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(217, 'TG', 'Togo', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(218, 'TK', 'Tokelau', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(219, 'TO', 'Tonga', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(220, 'TT', 'Trinidad and Tobago', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(221, 'TN', 'Tunisia', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(222, 'TR', 'Turkey', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(223, 'TM', 'Turkmenistan', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(224, 'TC', 'Turks and Caicos Islands', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(225, 'TV', 'Tuvalu', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(226, 'UG', 'Uganda', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(227, 'UA', 'Ukraine', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(228, 'AE', 'United Arab Emirates', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(229, 'GB', 'United Kingdom', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(230, 'US', 'United States', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(231, 'UM', 'United States minor outlying islands', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(232, 'UY', 'Uruguay', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(233, 'UZ', 'Uzbekistan', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(234, 'VU', 'Vanuatu', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(235, 'VA', 'Vatican City State', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(236, 'VE', 'Venezuela', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(237, 'VN', 'Vietnam', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(238, 'VG', 'Virgin Islands (British)', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(239, 'VI', 'Virgin Islands (U.S.)', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(240, 'WF', 'Wallis and Futuna Islands', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(241, 'EH', 'Western Sahara', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(242, 'YE', 'Yemen', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(243, 'ZR', 'Zaire', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(244, 'ZM', 'Zambia', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(245, 'ZW', 'Zimbabwe', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0);

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
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` enum('Non-Cash','Cash') NOT NULL DEFAULT 'Cash',
  `description` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`id`, `name`, `type`, `description`, `is_active`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'CASH', 'Cash', 'Payment By Cash Cash', 1, '2016-12-08 07:00:00', 1, NULL, NULL),
(2, 'TRANSFER BANK', 'Non-Cash', 'TRANSFER BY BANK', 1, '0000-00-00 00:00:00', 1, '2016-12-23 02:22:29', 3);

-- --------------------------------------------------------

--
-- Table structure for table `provincies`
--

CREATE TABLE `provincies` (
  `id` int(10) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `country_id` int(11) NOT NULL DEFAULT '101',
  `is_active` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `provincies`
--

INSERT INTO `provincies` (`id`, `name`, `country_id`, `is_active`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'Nanggroe Aceh Darussalam', 101, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(2, 'Sumatera Utara', 101, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(3, 'Sumatera Barat', 101, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(4, 'Riau', 101, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(5, 'Kepulauan Riau', 101, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(6, 'Kepulauan Bangka-Belitung', 101, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(7, 'Jambi', 101, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(8, 'Bengkulu', 101, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(9, 'Sumatera Selatan', 101, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(10, 'Lampung', 101, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(11, 'Banten', 101, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(12, 'DKI Jakarta', 101, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(13, 'Jawa Barat', 101, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(14, 'Jawa Tengah', 101, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(15, 'Daerah Istimewa Yogyakarta  ', 101, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(16, 'Jawa Timur', 101, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(17, 'Bali', 101, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(18, 'Nusa Tenggara Barat', 101, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(19, 'Nusa Tenggara Timur', 101, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(20, 'Kalimantan Barat', 101, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(21, 'Kalimantan Tengah', 101, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(22, 'Kalimantan Selatan', 101, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(23, 'Kalimantan Timur', 101, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(24, 'Gorontalo', 101, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(25, 'Sulawesi Selatan', 101, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(26, 'Sulawesi Tenggara', 101, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(27, 'Sulawesi Tengah', 101, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(28, 'Sulawesi Utara', 101, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(29, 'Sulawesi Barat', 101, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(30, 'Maluku', 101, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(31, 'Maluku Utara', 101, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(32, 'Papua Barat', 101, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(33, 'Papua', 101, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0),
(34, 'Kalimantan Utara', 101, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0);

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
  `service_period` varchar(100) NOT NULL,
  `abodemen` double NOT NULL,
  `japati` double NOT NULL,
  `mobile` double NOT NULL,
  `local` double NOT NULL,
  `sljj` double NOT NULL,
  `sli_007` double NOT NULL,
  `telkom_global_017` double NOT NULL,
  `surcharge` double NOT NULL,
  `surcharge_total` double NOT NULL,
  `ppn` double NOT NULL,
  `ppn_total` double NOT NULL,
  `total_bill` double NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `telephone_billings`
--

INSERT INTO `telephone_billings` (`id`, `number`, `customer_id`, `payment_method_id`, `payment_frequency`, `print_date`, `due_date`, `service_period`, `abodemen`, `japati`, `mobile`, `local`, `sljj`, `sli_007`, `telkom_global_017`, `surcharge`, `surcharge_total`, `ppn`, `ppn_total`, `total_bill`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(8, '/APS-FIN/ICT-TLP/XII/2016/0000001', 1, 1, 'BULANAN', '2016-12-22', '2016-12-24', '31 Des 2014', 120000, 20000, 0, 0, 0, 0, 0, 15, 3000, 10, 14300, 157300, '2016-12-24 03:07:41', 1, '2016-12-24 03:19:41', 1);

-- --------------------------------------------------------

--
-- Table structure for table `telephone_billing_details`
--

CREATE TABLE `telephone_billing_details` (
  `id` int(11) NOT NULL,
  `telephone_billing_id` int(11) NOT NULL,
  `phone_number` varchar(28) NOT NULL,
  `period` varchar(100) NOT NULL,
  `abodemen` double DEFAULT NULL,
  `japati` double DEFAULT NULL,
  `mobile` double DEFAULT NULL,
  `local` double DEFAULT NULL,
  `sljj` double DEFAULT NULL,
  `sli_007` double DEFAULT NULL,
  `telkom_global_017` double DEFAULT NULL,
  `surcharge` double DEFAULT NULL,
  `surcharge_total` double DEFAULT NULL,
  `ppn` double DEFAULT NULL,
  `ppn_total` double DEFAULT NULL,
  `subtotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `telephone_billing_details`
--

INSERT INTO `telephone_billing_details` (`id`, `telephone_billing_id`, `phone_number`, `period`, `abodemen`, `japati`, `mobile`, `local`, `sljj`, `sli_007`, `telkom_global_017`, `surcharge`, `surcharge_total`, `ppn`, `ppn_total`, `subtotal`) VALUES
(9, 8, '0852205405855', '24 Des 2014', 120000, 20000, 0, 0, 0, 0, 0, 15, 3000, 10, 14300, 157300);

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
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `countries`
--
ALTER TABLE `countries`
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
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provincies`
--
ALTER TABLE `provincies`
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
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;
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
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `provincies`
--
ALTER TABLE `provincies`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `telephone_billings`
--
ALTER TABLE `telephone_billings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `telephone_billing_details`
--
ALTER TABLE `telephone_billing_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
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
