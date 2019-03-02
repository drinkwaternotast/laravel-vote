-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 2018 年 2 月 10 日 21:29
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
-- テーブルのデータのダンプ `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(75, '2014_10_12_000000_create_users_table', 1),
(76, '2014_10_12_100000_create_password_resets_table', 1),
(77, '2016_12_30_024126_create_photos_table', 1),
(78, '2016_12_30_024225_create_votes_table', 1),
(79, '2016_12_30_024320_create_battles_table', 1),
(80, '2016_12_30_121955_create_favorites_table', 1),
(81, '2017_01_02_045027_create_comments_table', 1),
(82, '2017_01_29_135406_create_profiles_table', 1),
(83, '2017_02_20_144129_create_stages_table', 1),
(84, '2017_05_02_084755_change_column_name_of_battles_table', 1),
(85, '2017_06_22_183554_add_api_token_to_users_table', 1),
(86, '2017_07_23_110632_add_description_to_photos_table', 1),
(87, '2017_08_02_060058_create_fans_table', 1),
(88, '2017_08_13_085135_add_SNS_column_to_profiles_table', 1),
(89, '2017_09_08_064544_create_vote_counters_table', 1),
(90, '2017_09_09_141113_add_owner_to_vote_counters_table', 1),
(91, '2017_09_17_170310_create_tags_table', 1),
(92, '2017_09_17_171025_create_photo_tag_table', 1),
(93, '2017_10_29_003627_create_characters_table', 1),
(94, '2017_10_29_005225_create_titles_table', 1),
(95, '2017_10_30_164049_create_title_character_table', 1),
(96, '2017_11_12_130856_change_column_name_of_title_character_table', 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
