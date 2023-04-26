-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 16.03.2023 klo 09:45
-- Palvelimen versio: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quotes`
--

-- --------------------------------------------------------

--
-- Rakenne taululle `quotes`
--

CREATE TABLE `quotes` (
  `id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `work` varchar(255) DEFAULT NULL,
  `series` varchar(255) DEFAULT NULL,
  `quote` varchar(1000) NOT NULL,
  `char1` varchar(255) NOT NULL,
  `char2` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Vedos taulusta `quotes`
--

INSERT INTO `quotes` (`id`, `author`, `work`, `series`, `quote`, `char1`, `char2`) VALUES
(1, 'Josh Lanyon', 'The Hell You Say', 'The Adrien English Mysteries', 'A pause followed my greeting. Then “We’re watching you” whispered the voice on the other end.\r\n“Yeah? Did you see what I did with my keys?”\r\nSilence. Then dial tone.\r\nThese younger demons. So easily discouraged.', 'Adrien English', ''),
(2, 'Josh Lanyon', 'Death of a Pirate King', 'The Adrien English Mysteries', 'I thought again how odd it was to be on formal terms with someone you had once permitted to lick your ears.', 'Adrien English', ''),
(3, 'Jordan L. Hawk', 'Widdershins', 'Whyborne & Griffin', '“I will not surrender my profession simply because men throughout history have been unduly enamored of their penises!”', 'Dr. Christine Putnam', ''),
(4, 'Jordan L. Hawk', 'Widdershins', 'Whyborne & Griffin', 'I seldom ate out, both for reasons of economy and because I feared someone might try to speak to me.', 'Percival Whyborne', ''),
(5, 'Josh Lanyon', 'A Dangerous Thing', 'The Adrien English Mysteries', '“Adrien, people get killed all the time. Since when is it your job to find out what happened to them?”\r\n“I’m not usually suspected of murdering them.”\r\n“You have been as long as I’ve known you.”', 'Adrien English', 'Jake Riordan'),
(6, 'testi', NULL, NULL, 'halloota', '', ''),
(9, 'Jordan L. Hawk', 'Treshold', 'Whyborne & Griffin', '“I think I will remain here and work on my manuscript,” Christine decided. “Going about talking to the locals sounds dreadfully boring. But if you find you need anyone shot, send word and I’ll come at once.”', 'Dr. Christine Putnam', ''),
(10, 'Jordan L. Hawk', 'Widdershins', 'Whyborne & Griffin', '“Don’t sit down just yet, Whyborne,” the director ordered, motioning me to the front of the room. “We’ve a bit of business concerning you before the meeting.”\r\nI couldn’t possibly imagine what business would concern me. I’d dedicated my entire life to making sure business didn’t concern me whenever possible.', 'Percival Whyborne', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `quotes`
--
ALTER TABLE `quotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
