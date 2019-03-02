-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 2018 年 2 月 10 日 21:33
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
-- テーブルのデータのダンプ `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `comment`, `image`, `facebook`, `twitter`, `created_at`, `updated_at`) VALUES
(2, 2, 'Hi~', 'https://s3-ap-northeast-1.amazonaws.com/heroku-laravel5.3/profiles/4fPycLXnntxdBdc8s10NCh41Y7y5sXP4.jpeg', NULL, NULL, NULL, NULL),
(12, 12, 'Hi~', 'https://s3-ap-northeast-1.amazonaws.com/heroku-laravel5.3/profiles/9bhhP1nm9MacuEzdAaErCzM9yo7S5lJV.jpeg', NULL, NULL, NULL, NULL),
(22, 22, 'Hi~', 'https://s3-ap-northeast-1.amazonaws.com/heroku-laravel5.3/profiles/E5ly9m8YZJroKMWKstVtb09F6nMLermA.jpeg', NULL, NULL, NULL, NULL),
(32, 32, 'Hi', 'https://s3-ap-northeast-1.amazonaws.com/heroku-laravel5.3/profiles/HQ50BbX1UIunXBwlZcjjD1Y6Pi8h7g57.jpeg', NULL, NULL, NULL, NULL),
(42, 42, 'hi~', 'https://s3-ap-northeast-1.amazonaws.com/heroku-laravel5.3/profiles/gaZW12ghY3EAi2ZnOiDKicOvwm9J4aR5.jpeg', NULL, NULL, NULL, NULL),
(52, 52, 'hi.', 'https://s3-ap-northeast-1.amazonaws.com/heroku-laravel5.3/profiles/8UdQUm8VHkWeQ5kf5OIBOnkNUWRyCgHH.jpeg', NULL, NULL, NULL, NULL),
(62, 62, 'hi', 'https://s3-ap-northeast-1.amazonaws.com/heroku-laravel5.3/profiles/uc9QoyK6tb4rELz8PpD9h8q5zBUZF5Jk.jpeg', NULL, NULL, NULL, NULL),
(72, 72, 'hi', 'https://s3-ap-northeast-1.amazonaws.com/heroku-laravel5.3/profiles/fpYyoHqnOeXJm5lFgPaYxigJCPZ1PpAj.jpeg', NULL, NULL, NULL, NULL),
(82, 82, 'hi', 'https://s3-ap-northeast-1.amazonaws.com/heroku-laravel5.3/profiles/qeH1eyZhms86oi9CxGxVNoTWAL6nEcxP.jpeg', NULL, NULL, NULL, NULL),
(92, 92, 'hi', 'https://s3-ap-northeast-1.amazonaws.com/heroku-laravel5.3/profiles/jzOzyGkjBoSUB5Ae3vR01mlnVp57kLzZ.jpeg', NULL, NULL, NULL, NULL),
(93, 93, 'hello', 'https://s3.ap-northeast-1.amazonaws.com/heroku-laravel5.3/profiles/MwvPTC5ARcMnP95dyzeTZSkLgIxOm5Eb.jpeg', NULL, NULL, NULL, NULL),
(94, 94, 'よろしくお願いします', 'https://s3.ap-northeast-1.amazonaws.com/heroku-laravel5.3/profiles/8H7HrCCt4TgN5cUl0DpcWuvtimYwLziu.jpeg', NULL, NULL, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
