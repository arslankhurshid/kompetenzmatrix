-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 22. Nov 2017 um 17:32
-- Server-Version: 10.1.19-MariaDB
-- PHP-Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `skillmatrix`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `competency`
--

CREATE TABLE `competency` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  `parent_id` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `competency`
--

INSERT INTO `competency` (`id`, `name`, `order`, `parent_id`) VALUES
(5, 'SWE', 3, 0),
(6, 'WBCRM SWE', 4, 5),
(7, 'WB2000 SWE', 5, 5),
(8, 'SWE Allg', 6, 5),
(9, 'SW Architektur', 7, 5),
(10, 'Infrastruktur', 8, 0),
(11, 'Windows Server', 11, 10),
(12, 'MS Client', 12, 10),
(13, 'Switching/Routing', 13, 10),
(14, 'IT-Security', 10, 10),
(15, '1st level allgemein', 14, 10),
(16, 'IBM i Systemtechnik', 9, 10),
(17, 'Drucker', 15, 10),
(18, 'Applikationen', 1, 0),
(19, 'WBCRM Support', 2, 18),
(21, 'WB2000 Support', 0, 18);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `job_title`
--

CREATE TABLE `job_title` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `job_title`
--

INSERT INTO `job_title` (`id`, `title`) VALUES
(1, 'Softwareentwickler'),
(2, 'Network Admin'),
(3, 'IT Head');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `job_title_has_comp`
--

CREATE TABLE `job_title_has_comp` (
  `id` int(11) UNSIGNED NOT NULL,
  `job_title_id` int(11) NOT NULL,
  `competency_id` int(11) NOT NULL,
  `skill_value` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `job_title_has_comp`
--

INSERT INTO `job_title_has_comp` (`id`, `job_title_id`, `competency_id`, `skill_value`) VALUES
(17, 1, 6, '1'),
(18, 1, 7, '2'),
(19, 1, 8, '0'),
(20, 1, 9, '0'),
(21, 1, 11, '0'),
(22, 1, 12, '0'),
(23, 1, 13, '0'),
(24, 1, 14, '0'),
(25, 1, 15, '0'),
(26, 1, 16, '0'),
(27, 1, 17, '0'),
(28, 1, 19, '2'),
(29, 1, 21, '3'),
(30, 2, 6, '1'),
(31, 2, 7, '1'),
(32, 2, 8, '1'),
(33, 2, 9, '1'),
(34, 2, 11, '3'),
(35, 2, 12, '3'),
(36, 2, 13, '3'),
(37, 2, 14, '3'),
(38, 2, 15, '4'),
(39, 2, 16, '3'),
(40, 2, 17, '3'),
(41, 2, 19, '1'),
(42, 2, 21, '2'),
(43, 3, 6, '0'),
(44, 3, 7, '0'),
(45, 3, 8, '0'),
(46, 3, 9, '0'),
(47, 3, 11, '3'),
(48, 3, 12, '2'),
(49, 3, 13, '1'),
(50, 3, 14, '1'),
(51, 3, 15, '2'),
(52, 3, 16, '3'),
(53, 3, 17, '4'),
(54, 3, 19, '0'),
(55, 3, 21, '0');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `migrations`
--

CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `migrations`
--

INSERT INTO `migrations` (`version`) VALUES
(7);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `skills`
--

CREATE TABLE `skills` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `skills`
--

INSERT INTO `skills` (`id`, `name`) VALUES
(1, 'Basic'),
(2, 'Intermediate'),
(3, 'Advanced'),
(4, 'Expert');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `strength`
--

CREATE TABLE `strength` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL,
  `user_id` int(11) NOT NULL,
  `parent_id` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_hash` varchar(250) NOT NULL,
  `fname` varchar(120) NOT NULL,
  `lname` varchar(120) NOT NULL,
  `dob` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `ausbildung` varchar(120) NOT NULL,
  `job_title_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `user_name`, `user_hash`, `fname`, `lname`, `dob`, `address`, `ausbildung`, `job_title_id`) VALUES
(7, '', '', 'Name', 'B', '01.11.1980', 'Dr. Robert Graf Strasse 12/3/11', 'Diplom in IT, Cisco Networking, ONET: Installation', 2),
(17, '', '', 'Name', 'A', '15.02.2017', 'Mosserhofgasse 14, 8010 Graz', 'Software Engineering', 1),
(18, '', '', 'Name', 'C', '17.17.2017', 'Dr. Robert Graf Strasse 12/3/11', 'Ing', 1),
(28, 'admin', 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec', 'Admin', '', '', '', '', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_has_comp`
--

CREATE TABLE `user_has_comp` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `competency_id` int(11) NOT NULL,
  `skill_value` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `user_has_comp`
--

INSERT INTO `user_has_comp` (`id`, `user_id`, `competency_id`, `skill_value`) VALUES
(248, 7, 6, '2'),
(249, 7, 7, '2'),
(250, 7, 8, '2'),
(251, 7, 9, '2'),
(252, 7, 11, '4'),
(253, 7, 12, '2'),
(254, 7, 13, '3'),
(255, 7, 14, '4'),
(256, 7, 15, '4'),
(257, 7, 16, '3'),
(258, 7, 17, '4'),
(259, 7, 19, '2'),
(260, 7, 21, '2'),
(300, 17, 6, '2'),
(301, 17, 7, '1'),
(302, 17, 8, '0'),
(303, 17, 9, '0'),
(304, 17, 11, '1'),
(305, 17, 12, '0'),
(306, 17, 13, '3'),
(307, 17, 14, '0'),
(308, 17, 15, '0'),
(309, 17, 16, '3'),
(310, 17, 17, '4'),
(311, 17, 19, '1'),
(312, 17, 21, '4'),
(313, 18, 6, '4'),
(314, 18, 7, '3'),
(315, 18, 8, '2'),
(316, 18, 9, '4'),
(317, 18, 11, '1'),
(318, 18, 12, '2'),
(319, 18, 13, '0'),
(320, 18, 14, '0'),
(321, 18, 15, '0'),
(322, 18, 16, '0'),
(323, 18, 17, '0'),
(324, 18, 19, '1'),
(325, 18, 21, '1'),
(326, 19, 6, '0'),
(327, 19, 7, '0'),
(328, 19, 8, '0'),
(329, 19, 9, '0'),
(330, 19, 11, '0'),
(331, 19, 12, '0'),
(332, 19, 13, '0'),
(333, 19, 14, '0'),
(334, 19, 15, '0'),
(335, 19, 16, '0'),
(336, 19, 17, '0'),
(337, 19, 19, '0'),
(338, 19, 21, '0'),
(352, 20, 6, '0'),
(353, 20, 7, '0'),
(354, 20, 8, '0'),
(355, 20, 9, '0'),
(356, 20, 11, '2'),
(357, 20, 12, '3'),
(358, 20, 13, '4'),
(359, 20, 14, '1'),
(360, 20, 15, '2'),
(361, 20, 16, '2'),
(362, 20, 17, '3'),
(363, 20, 19, '0'),
(364, 20, 21, '0'),
(365, 21, 6, '0'),
(366, 21, 7, '0'),
(367, 21, 8, '0'),
(368, 21, 9, '0'),
(369, 21, 11, '0'),
(370, 21, 12, '0'),
(371, 21, 13, '0'),
(372, 21, 14, '0'),
(373, 21, 15, '0'),
(374, 21, 16, '0'),
(375, 21, 17, '0'),
(376, 21, 19, '0'),
(377, 21, 21, '0'),
(378, 22, 6, '0'),
(379, 22, 7, '0'),
(380, 22, 8, '0'),
(381, 22, 9, '0'),
(382, 22, 11, '0'),
(383, 22, 12, '0'),
(384, 22, 13, '0'),
(385, 22, 14, '0'),
(386, 22, 15, '0'),
(387, 22, 16, '0'),
(388, 22, 17, '0'),
(389, 22, 19, '0'),
(390, 22, 21, '0'),
(391, 23, 6, '0'),
(392, 23, 7, '0'),
(393, 23, 8, '0'),
(394, 23, 9, '0'),
(395, 23, 11, '0'),
(396, 23, 12, '0'),
(397, 23, 13, '0'),
(398, 23, 14, '0'),
(399, 23, 15, '0'),
(400, 23, 16, '0'),
(401, 23, 17, '0'),
(402, 23, 19, '0'),
(403, 23, 21, '0'),
(404, 24, 6, '0'),
(405, 24, 7, '0'),
(406, 24, 8, '0'),
(407, 24, 9, '0'),
(408, 24, 11, '0'),
(409, 24, 12, '0'),
(410, 24, 13, '0'),
(411, 24, 14, '0'),
(412, 24, 15, '0'),
(413, 24, 16, '0'),
(414, 24, 17, '0'),
(415, 24, 19, '0'),
(416, 24, 21, '0'),
(417, 25, 6, '0'),
(418, 25, 7, '0'),
(419, 25, 8, '0'),
(420, 25, 9, '0'),
(421, 25, 11, '0'),
(422, 25, 12, '0'),
(423, 25, 13, '0'),
(424, 25, 14, '0'),
(425, 25, 15, '0'),
(426, 25, 16, '0'),
(427, 25, 17, '0'),
(428, 25, 19, '0'),
(429, 25, 21, '0');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `competency`
--
ALTER TABLE `competency`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `job_title`
--
ALTER TABLE `job_title`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `job_title_has_comp`
--
ALTER TABLE `job_title_has_comp`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `strength`
--
ALTER TABLE `strength`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `user_has_comp`
--
ALTER TABLE `user_has_comp`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `competency`
--
ALTER TABLE `competency`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT für Tabelle `job_title`
--
ALTER TABLE `job_title`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT für Tabelle `job_title_has_comp`
--
ALTER TABLE `job_title_has_comp`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT für Tabelle `skills`
--
ALTER TABLE `skills`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT für Tabelle `strength`
--
ALTER TABLE `strength`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT für Tabelle `user_has_comp`
--
ALTER TABLE `user_has_comp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=430;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
