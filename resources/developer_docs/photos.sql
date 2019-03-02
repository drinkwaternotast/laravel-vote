-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 2018 年 2 月 10 日 21:32
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
-- テーブルのデータのダンプ `photos`
--

INSERT INTO `photos` (`id`, `original_path`, `description`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'https://s3-ap-northeast-1.amazonaws.com/heroku-laravel5.3/images/PJiVswjt9j4fI5n19uwgpcI5CkzwEf8n.jpeg', 'upload mainly Tokyo Ghoul photos', 2, '2017-09-07 05:22:30', NULL, NULL),
(12, 'https://s3-ap-northeast-1.amazonaws.com/heroku-laravel5.3/images/MssO8B9ojyMf3VaVzTzLBtDcd7M3Zho8.jpeg', 'upload mainly Tokyo Ghoul photos(Kaneki no mask ver.)', 2, '2017-09-07 05:24:42', NULL, NULL),
(22, 'https://s3-ap-northeast-1.amazonaws.com/heroku-laravel5.3/images/1zA6SJULlohW1C7POcdIvNaeOZeMe39I.jpeg', 'Double pikachu~', 12, '2017-09-07 05:29:30', NULL, NULL),
(32, 'https://s3-ap-northeast-1.amazonaws.com/heroku-laravel5.3/images/Lvjz8zxstq83NZfw62Vubgf9oFKLJeYb.jpeg', 'Love Alice so much♥', 12, '2017-09-07 05:34:46', NULL, NULL),
(42, 'https://s3-ap-northeast-1.amazonaws.com/heroku-laravel5.3/images/P53Is4CnzIuvUCS8WTPYvEwoVCf2nh7q.jpeg', 'Super miracle shot Masamune XD', 22, '2017-09-07 05:47:12', NULL, NULL),
(52, 'https://s3-ap-northeast-1.amazonaws.com/heroku-laravel5.3/images/beMSodZSx2KUoPRozfrIyLrXutOCV591.jpeg', 'I tried it for the first time. Pls vote~.', 32, '2017-09-07 17:22:28', NULL, NULL),
(62, 'https://s3-ap-northeast-1.amazonaws.com/heroku-laravel5.3/images/Q7mFxihQgL0bAeCzJPoLCoBM3T1pRE6Q.jpeg', 'Pls check my facebook and twitter~XD', 42, '2017-09-07 17:27:25', NULL, NULL),
(72, 'https://s3-ap-northeast-1.amazonaws.com/heroku-laravel5.3/images/iZ3JQVtvfxffGE1mi35Jn8WWb12k1Aa7.jpeg', 'love panzer~', 52, '2017-09-07 17:38:37', NULL, NULL),
(82, 'https://s3-ap-northeast-1.amazonaws.com/heroku-laravel5.3/images/iWpePTOozfiSeaGrB5bmwBbViBZ6UsEp.jpeg', '这是网络游戏的一个角色', 62, '2017-09-07 17:55:21', NULL, NULL),
(92, 'https://s3-ap-northeast-1.amazonaws.com/heroku-laravel5.3/images/adIjpInejNKQcEgbmT0iqCxobp6aufvG.jpeg', 'He is the one of my favorite character, taken at Ohori Park Japan.\r\nI\'m waiting for job offers through facebook', 72, '2017-09-07 18:09:54', NULL, NULL),
(102, 'https://s3-ap-northeast-1.amazonaws.com/heroku-laravel5.3/images/64WIKYQ4Jte03ITdwKraFijCVllbunbG.jpeg', 'I\'m innocent.', 82, '2017-09-07 18:16:56', NULL, NULL),
(112, 'https://s3-ap-northeast-1.amazonaws.com/heroku-laravel5.3/images/MttcecuHxryrMjiI0KMYiMYjqh1zjMq3.jpeg', 'If you don\'t vote for me, I will catch you.', 82, '2017-09-07 18:21:26', NULL, NULL),
(122, 'https://s3-ap-northeast-1.amazonaws.com/heroku-laravel5.3/images/Q5FH8UnHbMb88aCPf1ctUDW3gEHCPNcB.jpeg', 'with Deme chen(Hunter×Hunter Sizuku)', 92, '2017-09-07 23:16:19', NULL, NULL),
(132, 'https://s3-ap-northeast-1.amazonaws.com/heroku-laravel5.3/images/BgBgAmLuFlbRp0nAuq9FkbJJFo7HR5YL.jpeg', 'yes! super cool!', 22, '2017-09-07 23:20:40', NULL, NULL),
(142, 'https://s3-ap-northeast-1.amazonaws.com/heroku-laravel5.3/images/MwhL2CLDB7aqURNr21tyXmlO0qApotZX.jpeg', 'I really get a tattoo...', 42, '2017-09-07 23:27:05', NULL, NULL),
(152, 'https://s3-ap-northeast-1.amazonaws.com/heroku-laravel5.3/images/4OLbfWilD32rUmRTdRMPmvr4VtbyMqtV.jpeg', 'Which Pikachu is good for you?', 12, '2017-09-07 23:32:54', NULL, NULL),
(162, 'https://s3-ap-northeast-1.amazonaws.com/heroku-laravel5.3/images/i5vdtIZTXkv4eRkxGOo84IKuUcHa9hza.jpeg', 'Tokyo ghoul Kaneki white color ver !!!', 2, '2017-09-07 23:37:13', NULL, NULL),
(163, 'https://s3-ap-northeast-1.amazonaws.com/heroku-laravel5.3/images/MTOtCSuFPdY0PPPCkyvzbTHUr9c3K6SC.jpeg', '@comike', 32, '2017-09-12 01:50:06', NULL, NULL),
(164, 'https://s3.ap-northeast-1.amazonaws.com/heroku-laravel5.3/images/BX7JbCu72wEICbPqxzDY89vL48UY35AX.jpeg', NULL, 93, '2018-01-06 12:02:43', NULL, NULL),
(165, 'https://s3.ap-northeast-1.amazonaws.com/heroku-laravel5.3/images/1BlRvktDx0IC8jTerNKT9nlWZJRMtXmF.jpeg', NULL, 93, '2018-01-06 12:13:18', NULL, '2018-01-06 12:23:26'),
(166, 'https://s3.ap-northeast-1.amazonaws.com/heroku-laravel5.3/images/7hPF5eFXjbSHG8yHeJliIl0DRDrEmO5G.png', NULL, 93, '2018-01-06 12:21:38', NULL, '2018-01-06 12:35:54'),
(167, 'https://s3.ap-northeast-1.amazonaws.com/heroku-laravel5.3/images/F00r3jchJH3RVp0BA1YE0QbyLH8131nV.png', NULL, 93, '2018-01-06 12:21:56', NULL, '2018-01-06 12:22:26'),
(168, 'https://s3.ap-northeast-1.amazonaws.com/heroku-laravel5.3/images/iRP7pceZkfKh0wN9P7gaTATDcW2Wuv11.png', 'たくさん見てください。', 93, '2018-01-06 12:30:26', NULL, '2018-01-06 12:35:39'),
(169, 'https://s3.ap-northeast-1.amazonaws.com/heroku-laravel5.3/images/ZxwRCAWnYVAd0IcABz6fhIFPqCcOnJYo.jpeg', 'よろしくお願いします', 93, '2018-01-06 12:35:26', NULL, NULL),
(170, 'https://s3.ap-northeast-1.amazonaws.com/heroku-laravel5.3/images/xLSZIhJRUFQcPQPm0Cu8DQ76tN4Go4Zj.jpeg', 'プロフ見てください', 93, '2018-01-06 12:38:48', NULL, NULL),
(171, 'https://s3.ap-northeast-1.amazonaws.com/heroku-laravel5.3/images/M0sazSik5IzMNFbkEW0SIVkYumZ6I0Pa.jpeg', NULL, 94, '2018-01-06 12:56:12', NULL, NULL),
(172, 'https://s3.ap-northeast-1.amazonaws.com/heroku-laravel5.3/images/w8YLjeHDLHxizfgyQDLpCuLyOhf6anhH.jpeg', NULL, 94, '2018-01-06 12:56:35', NULL, NULL),
(173, 'https://s3.ap-northeast-1.amazonaws.com/heroku-laravel5.3/images/06ATpCM0DqdhOPitXLSuqpwWDSxMG3mD.jpeg', NULL, 94, '2018-01-06 12:56:51', NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
