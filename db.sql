-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2020 at 02:34 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `protag_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `setting_id` int(11) NOT NULL,
  `setting_name` varchar(512) NOT NULL,
  `setting_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`setting_id`, `setting_name`, `setting_value`) VALUES
(1, 'protocol', 'http'),
(2, 'site_url', 'protag.awaseem.me'),
(3, 'mailer_email', 'noreply@protag.com'),
(4, 'site_title', 'Protag');

-- --------------------------------------------------------

--
-- Table structure for table `social_media`
--

CREATE TABLE `social_media` (
  `sm_id` int(11) NOT NULL,
  `sm_name` varchar(512) NOT NULL,
  `sm_icon` varchar(512) NOT NULL,
  `sm_url` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `social_media`
--

INSERT INTO `social_media` (`sm_id`, `sm_name`, `sm_icon`, `sm_url`) VALUES
(1, 'Instagram', 'instagram.svg', 'http://instagram.com/'),
(2, 'Snapchat', 'snapchat.svg', 'https://www.snapchat.com/add/'),
(3, 'Twitter', 'twitter.svg', 'https://twitter.com/'),
(4, 'Facebook', 'facebook.svg', 'https://facebook.com/'),
(5, 'LinkedIn', 'linkedin.svg', 'https://www.linkedin.com/'),
(6, 'Email', 'email.svg', 'mailto:'),
(7, 'Youtube user/channel', 'youtube.svg', 'https://www.youtube.com/'),
(8, 'Tiktok', 'tiktok.svg', 'https://tiktok.com/@'),
(9, 'Soundcloud', 'soundcloud.svg', 'https://soundcloud.com/'),
(10, 'Spotify', 'spotify.svg', 'http://open.spotify.com/user/'),
(11, 'Apple Music', 'applemusic.svg', 'https://itunes.apple.com/profile/'),
(12, 'Paypal.me', 'paypal.svg', 'https://paypal.me'),
(13, 'WhatsApp', 'whatsapp.svg', 'https://wa.me/'),
(14, 'Twitch', 'twitch.svg', 'https://twitch.tv/'),
(15, 'Any link', 'anylink.svg', NULL),
(16, 'Website link', 'website.svg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(512) NOT NULL,
  `user_email` varchar(512) NOT NULL,
  `user_password` varchar(512) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `user_address` varchar(512) NOT NULL,
  `user_cover_picture` varchar(512) NOT NULL,
  `user_bio` text NOT NULL,
  `user_profile_slug` varchar(512) NOT NULL,
  `user_profile_picture` varchar(512) DEFAULT NULL,
  `user_instant` enum('ON','OFF') NOT NULL DEFAULT 'OFF',
  `user_created` datetime NOT NULL DEFAULT current_timestamp(),
  `user_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_session`
--

CREATE TABLE `user_session` (
  `session_id` varchar(255) NOT NULL,
  `session_user` int(11) NOT NULL,
  `session_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_social`
--

CREATE TABLE `user_social` (
  `us_id` int(11) NOT NULL,
  `sm_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `us_name` varchar(512) DEFAULT NULL,
  `us_dated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `social_media`
--
ALTER TABLE `social_media`
  ADD PRIMARY KEY (`sm_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_p_s_unqie` (`user_profile_slug`);

--
-- Indexes for table `user_session`
--
ALTER TABLE `user_session`
  ADD PRIMARY KEY (`session_id`);

--
-- Indexes for table `user_social`
--
ALTER TABLE `user_social`
  ADD PRIMARY KEY (`us_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `social_media`
--
ALTER TABLE `social_media`
  MODIFY `sm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_social`
--
ALTER TABLE `user_social`
  MODIFY `us_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
