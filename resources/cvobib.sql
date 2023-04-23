-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 15 mrt 2023 om 09:54
-- Serverversie: 10.4.20-MariaDB
-- PHP-versie: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cvobib`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `auth_activation_attempts`
--

CREATE TABLE `auth_activation_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `auth_activation_attempts`
--


-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `auth_groups`
--

CREATE TABLE `auth_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `auth_groups_permissions`
--

CREATE TABLE `auth_groups_permissions` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Tabelstructuur voor tabel `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `auth_reset_attempts`
--

CREATE TABLE `auth_reset_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `auth_users_permissions`
--

CREATE TABLE `auth_users_permissions` (
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `books`
--

CREATE TABLE `books` (
  `book_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `authors` varchar(255) NOT NULL,
  `isbn` varchar(13) NOT NULL,
  `language_code` varchar(10) NOT NULL,
  `difficulty_level` varchar(255) NOT NULL,
  `publication_year` varchar(4) NOT NULL,
  `publisher` varchar(255) NOT NULL,
  `available` tinyint(1) NOT NULL DEFAULT 1,
  `img` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `books`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `checkouts`
--

CREATE TABLE `checkouts` (
  `book_id` int(10) UNSIGNED NOT NULL,
  `book_title` varchar(255) NOT NULL,
  `member_id` int(10) UNSIGNED NOT NULL,
  `member_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `checkouts`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `collections`
--

CREATE TABLE `collections` (
  `collection_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `number_of_books` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `collections`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `language_codes`
--

CREATE TABLE `language_codes` (
  `id` int(10) UNSIGNED NOT NULL,
  `language` varchar(255) NOT NULL,
  `code_639_1` varchar(5) NOT NULL,
  `code_639_3` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `language_codes`
--

INSERT INTO `language_codes` (`id`, `language`, `code_639_1`, `code_639_3`) VALUES
(1, 'Afrikaans', 'af', 'afr'),
(2, 'Albanees', 'sq', 'sqi'),
(3, 'Arabisch', 'ar', 'ara'),
(4, 'Armeens', 'hy', 'hye'),
(5, 'Azerbeidzjaans', 'az', 'aze'),
(6, 'Baskisch', 'eu', 'eus'),
(7, 'Bengaals', 'bn', 'ben'),
(8, 'Birmaans, Birmees', 'my', 'mya'),
(9, 'Bosnisch', 'bs', 'bos'),
(10, 'Bulgaars', 'bg', 'bul'),
(11, 'Catalaans', 'ca', 'cat'),
(12, 'Corsicaans', 'co', 'cos'),
(13, 'Deens', 'da', 'dan'),
(14, 'Duits', 'de', 'deu'),
(15, 'Engels', 'en', 'eng'),
(16, 'Esperanto', 'eo', 'epo'),
(17, 'Estisch', 'et', 'est'),
(18, 'Fins', 'fi', 'fin'),
(19, 'Frans', 'fr', 'fra'),
(20, 'Galicisch', 'gl', 'glg'),
(21, 'Georgisch', 'ka', 'kat'),
(22, 'Grieks', 'el', 'ell'),
(23, 'Groenlands', 'kl', 'kal'),
(24, 'Hebreeuws', 'he', 'heb'),
(25, 'Hindi', 'hi', 'hin'),
(26, 'Hongaars', 'hu', 'hun'),
(27, 'Iers', 'ga', 'gle'),
(28, 'IJslands', 'is', 'isl'),
(29, 'Indonesisch', 'id', 'ind'),
(30, 'Italiaans', 'it', 'ita'),
(31, 'Japans', 'ja', 'jpn'),
(32, 'Kazachs', 'kk', 'kaz'),
(33, 'Kirgizisch', 'ky', 'kir'),
(34, 'Koerdisch', 'ku', 'kur'),
(35, 'Koreaans', 'ko', 'kor'),
(36, 'Kroatisch', 'hr', 'hrv'),
(37, 'Latijn', 'la', 'lat'),
(38, 'Lets', 'lv', 'lav'),
(39, 'Litouws', 'lt', 'lit'),
(40, 'Maleis', 'ms', 'msa'),
(41, 'Maltees', 'mt', 'mlt'),
(42, 'Moldavisch', 'mo', 'mol'),
(43, 'Mongools', 'mn', 'mon'),
(44, 'Nederlands', 'nl', 'nld'),
(45, 'Nepalees', 'ne', 'nep'),
(46, 'Noors', 'no', 'nor'),
(47, 'Oekraïens', 'uk', 'ukr'),
(48, 'Oezbeeks', 'uz', 'uzb'),
(49, 'Perzisch (Farsi)', 'fa', 'fas'),
(50, 'Pools', 'pl', 'pol'),
(51, 'Portugees', 'pt', 'por'),
(52, 'Roemeens', 'ro', 'ron'),
(53, 'Russisch', 'ru', 'rus'),
(54, 'Servisch', 'sr', 'srp'),
(55, 'Sloveens', 'sl', 'slv'),
(56, 'Slowaaks', 'sk', 'slk'),
(57, 'Somalisch', 'so', 'som'),
(58, 'Spaans', 'es', 'spa'),
(59, 'Thai', 'th', 'tha'),
(60, 'Tibetaans', 'bo', 'bod'),
(61, 'Tsjechisch', 'cs', 'ces'),
(62, 'Tsjetsjeens', 'ce', 'che'),
(63, 'Turks', 'tr', 'tur'),
(64, 'Welsh', 'cy', 'cym'),
(65, 'Wit-Russisch', 'be', 'bel'),
(66, 'Zweeds', 'sv', 'swe');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `members`
--

CREATE TABLE `members` (
  `member_id` int(10) UNSIGNED NOT NULL,
  `status` enum('active','suspended') NOT NULL DEFAULT 'active',
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `current_checkouts` int(3) NOT NULL,
  `img` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `members`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1675580846, 1),
(2, '2023-02-05-074041', 'App\\Database\\Migrations\\Books', 'default', 'App', 1675588936, 2),
(3, '2023-02-05-112356', 'App\\Database\\Migrations\\Members', 'default', 'App', 1675596757, 3),
(4, '2023-02-05-180445', 'App\\Database\\Migrations\\Collections', 'default', 'App', 1675621066, 4),
(6, '2023-02-05-181843', 'App\\Database\\Migrations\\Checkouts', 'default', 'App', 1675623145, 5),
(9, '2023-02-06-182832', 'App\\Database\\Migrations\\PivotBookCollection', 'default', 'App', 1675756674, 7),
(10, '2017-11-20-223112', 'App\\Database\\Migrations\\CreateAuthTables', 'default', 'App', 1678867792, 8),
(11, '2023-03-15-075832', 'App\\Database\\Migrations\\LanguageCodes', 'default', 'App', 1678867792, 8);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `pivot_book_collection`
--

CREATE TABLE `pivot_book_collection` (
  `book_id` int(10) UNSIGNED NOT NULL,
  `collection_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `pivot_book_collection`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `group_id_permission_id` (`group_id`,`permission_id`);

--
-- Indexen voor tabel `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`),
  ADD KEY `group_id_user_id` (`group_id`,`user_id`);

--
-- Indexen voor tabel `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexen voor tabel `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_tokens_user_id_foreign` (`user_id`),
  ADD KEY `selector` (`selector`);

--
-- Indexen voor tabel `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `user_id_permission_id` (`user_id`,`permission_id`);

--
-- Indexen voor tabel `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexen voor tabel `collections`
--
ALTER TABLE `collections`
  ADD PRIMARY KEY (`collection_id`);

--
-- Indexen voor tabel `language_codes`
--
ALTER TABLE `language_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexen voor tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT voor een tabel `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=223;

--
-- AUTO_INCREMENT voor een tabel `collections`
--
ALTER TABLE `collections`
  MODIFY `collection_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `language_codes`
--
ALTER TABLE `language_codes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT voor een tabel `members`
--
ALTER TABLE `members`
  MODIFY `member_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE;

--
-- Beperkingen voor tabel `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Beperkingen voor tabel `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Beperkingen voor tabel `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
