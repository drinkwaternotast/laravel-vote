-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 2018 年 2 月 10 日 21:56
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
-- テーブルのデータのダンプ `vote_counters`
--

INSERT INTO `vote_counters` (`id`, `battle_id`, `photo_id`, `vote`, `owner`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 0, 1, '2018-10-19 12:09:26', NULL),
(2, 1, 2, 2, 0, '2018-10-19 12:09:26', NULL),
(3, 2, 4, 1, 1, '2018-10-22 12:18:01', NULL),
(4, 2, 1, 0, 0, '2018-10-22 12:18:01', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
