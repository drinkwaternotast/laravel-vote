-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 2018 年 2 月 10 日 21:48
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
-- テーブルのデータのダンプ `favorites`
--

INSERT INTO `favorites` (`id`, `photo_id`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 152, 32, '2017-09-12 01:46:50', '2017-09-12 01:46:50'),
(4, 142, 32, '2017-09-12 03:38:44', '2017-09-12 03:38:44'),
(12, 152, 1, '2017-10-11 03:01:35', '2017-10-11 03:01:35'),
(22, 142, 1, '2017-10-11 03:03:05', '2017-10-11 03:03:05');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
