-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 2018 年 2 月 10 日 21:28
-- サーバのバージョン： 10.1.24-MariaDB-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `udnzcdwq_cosplay_mixhost`
--

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `api_token`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'yoshihara', 'yoshihara@gmail.com', '$2y$10$fvtYyFpa0MVFHhFBXBH/Oe.tfoCxC.fcgTb/WeIWurGnjBSsYWAxO', NULL, NULL, '2017-09-01 03:00:17', '2018-01-29 14:58:51'),
(2, '@yukimi', 'yukimikazuki@gmail.com', '$2y$10$5wt.8NhQtPJ0U15ManXld.fhCYkgD1ei4LF0a1QRSZFi4xSscQIOu', 'gMBdDFQZh4cRFR0Jp8HdBClc5SCNzY2efMawhrpd3XVZWKH9r3KbTCIIa2X1', NULL, '2017-09-07 03:06:57', '2018-01-18 16:50:47'),
(12, 'AI', 'AIkazuki@gmail.com', '$2y$10$58a/4GxQwphNM5sxkupyEeWnUWnRdyMzgpd0.CB6IAqyL7ARhByqG', NULL, NULL, '2017-09-07 03:09:21', '2018-01-29 14:55:47'),
(22, 'hizamaru', 'hizamarukazuki@gmail.com', '$2y$10$qwDLeV4LowZjQNlvCM2XtOIGOavpIYlgFiist7N1e1uvTEmNiXz46', NULL, NULL, '2017-09-07 03:10:16', '2018-01-29 15:06:06'),
(32, 'Iketani Yuka', 'IketaniYukakazuki@gmail.com', '$2y$10$uj5c1b082KTkdxoGb8IwPuToqaGl08dG9q0FP/l0IpJUALtzzWuGy', NULL, NULL, '2017-09-07 03:11:01', '2018-01-29 15:13:03'),
(42, 'kaede_hakuhi', 'kaede_hakuhikazuki@gmail.com', '$2y$10$1/O4GvAYrNY23F8zHvIcnu5lP9DuB1QACPKo9aRQGUPctR/RQ96M2', 'zT8XKXUFcGMvNjNqsVM15AvbDmMW8zNSL5M2T4EFtLHW3xRGKiDge1xCixKM', NULL, '2017-09-07 03:12:20', '2018-01-29 15:13:08'),
(52, 'kamo', 'kamokazuki@gmail.com', '$2y$10$vNwfMLyDCCMxDh/ngzH1TeYGx4SI4DkljBvKxT0pYEbdEPls8ucPG', NULL, NULL, '2017-09-07 03:12:47', '2018-01-29 15:08:45'),
(62, 'ko_sho', 'ko_shokazuki@gmail.com', '$2y$10$uBRtFz2FXrpRWCl87JN4I.t0PPF58kCLbyifhotVWWgiZgpxdIyh.', NULL, NULL, '2017-09-07 03:13:18', '2017-09-07 18:04:59'),
(72, 'sanzo_houshi', 'sanzo_houshikazuki@gmail.com', '$2y$10$AZKrI.LDzfLCQ76/5zgBM.nxJWlKe7ApK0eqwriUf6Zd3PLUXBQaC', NULL, NULL, '2017-09-07 03:13:42', '2017-09-07 18:13:12'),
(82, 'say2222', 'say2222kazuki@gmail.com', '$2y$10$i8eZT8utvvZ2yQSxu8I83ebcfrNL5I1gJ28JyOczJt9.aa9o1PKxa', NULL, NULL, '2017-09-07 03:14:18', '2017-09-12 01:46:07'),
(92, 'super_maria', 'super_mariakazuki@gmail.com', '$2y$10$juVmGbwvoQbgkZ6FPSqWseDarxYjKk03ke7/sRlAW6IPXSSgCHqyK', NULL, NULL, '2017-09-07 03:14:41', '2018-01-29 15:11:28'),
(93, 'ra_hu', 'ra_hupass@gmail.com', '$2y$10$PgLjwUwSVNXc8cAQi4fGSubeoMnoJxXOCo4nCfQAOUrtWUryXU6GW', NULL, NULL, '2018-01-06 00:49:00', '2018-01-29 14:57:23'),
(94, 'Sei', 'seipass@gmail.com', '$2y$10$8Fz7fdNVC1w0Ujs8uRY8BOEJeVmqoQCO5OMT2EIJEK1IBTdbZKIum', NULL, NULL, '2018-01-06 12:41:00', '2018-01-06 13:08:15');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
