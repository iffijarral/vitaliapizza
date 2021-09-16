-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Vært: localhost
-- Genereringstid: 08. 03 2020 kl. 18:57:08
-- Serverversion: 10.4.11-MariaDB
-- PHP-version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbmeal`
--

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `street` text NOT NULL,
  `floor` varchar(50) NOT NULL,
  `postno` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `city` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Data dump for tabellen `address`
--

INSERT INTO `address` (`id`, `street`, `floor`, `postno`, `userid`, `city`) VALUES
(1, 'Taastrupgaardsvej 223', '3 Tv', 2920, 1, 'Charlottenlund'),
(2, 'Taastrupgaardsvej 223', '3', 1, 5, 'Charlottenlund');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Data dump for tabellen `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'iffi@yahoo.com', 'abc');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Data dump for tabellen `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(14, '    Burger   '),
(18, 'My Sandwich'),
(26, 'Durum'),
(27, 'Pizza'),
(30, 'salad');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `orderedItems`
--

CREATE TABLE `orderedItems` (
  `id` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Data dump for tabellen `orderedItems`
--

INSERT INTO `orderedItems` (`id`, `productId`, `orderId`, `quantity`) VALUES
(6, 1, 1, 1),
(7, 2, 1, 2),
(8, 1, 13, 1),
(9, 2, 13, 2),
(10, 1, 14, 1),
(11, 2, 14, 2);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `orders`
--

CREATE TABLE `orders` (
  `id` int(20) NOT NULL,
  `userid` int(15) NOT NULL,
  `orderdate` datetime NOT NULL DEFAULT current_timestamp(),
  `amount` double NOT NULL,
  `type` varchar(256) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `view` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Data dump for tabellen `orders`
--

INSERT INTO `orders` (`id`, `userid`, `orderdate`, `amount`, `type`, `status`, `view`) VALUES
(1, 1, '2020-02-25 15:12:31', 200, 'Take Away', 0, 0);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `password_reset_temp`
--

CREATE TABLE `password_reset_temp` (
  `id` int(11) NOT NULL,
  `email` varchar(256) NOT NULL,
  `keytocheck` varchar(256) NOT NULL,
  `expDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `paymentDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `postno`
--

CREATE TABLE `postno` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Data dump for tabellen `postno`
--

INSERT INTO `postno` (`id`, `name`, `code`) VALUES
(1, 'Charlottenlund', 2920),
(2, 'Gentofte', 2820),
(3, 'Bagsværd', 2880),
(4, 'Herlev', 2730);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `catid` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `ingredients` text NOT NULL,
  `price` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Data dump for tabellen `products`
--

INSERT INTO `products` (`id`, `catid`, `name`, `ingredients`, `price`, `status`) VALUES
(1, 14, 'Italian Pizza', 'onion, tomato, cheez', 50, 1),
(2, 14, 'Ham Burger', 'chees', 70, 1);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `users`
--

CREATE TABLE `users` (
  `id` int(15) NOT NULL,
  `name` varchar(256) NOT NULL,
  `mobile` int(11) DEFAULT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Data dump for tabellen `users`
--

INSERT INTO `users` (`id`, `name`, `mobile`, `email`, `password`, `status`) VALUES
(1, 'iffi', 123, 'iffi@yahoo.com', 'jarral', NULL),
(2, 'Bajwa', 55555, 'bajwa@gmail.com', 'q', 1),
(3, 'naeem', 4444, 'naeem@yahoo.com', 'r', 1),
(4, '', 0, '', '', 1),
(5, 'Palwasha Iftikhar', 12345678, 'palwashadk@gmail.com', '123456', 1);

--
-- Begrænsninger for dumpede tabeller
--

--
-- Indeks for tabel `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `orderedItems`
--
ALTER TABLE `orderedItems`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `password_reset_temp`
--
ALTER TABLE `password_reset_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `postno`
--
ALTER TABLE `postno`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeks for tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Brug ikke AUTO_INCREMENT for slettede tabeller
--

--
-- Tilføj AUTO_INCREMENT i tabel `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tilføj AUTO_INCREMENT i tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tilføj AUTO_INCREMENT i tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Tilføj AUTO_INCREMENT i tabel `orderedItems`
--
ALTER TABLE `orderedItems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Tilføj AUTO_INCREMENT i tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Tilføj AUTO_INCREMENT i tabel `password_reset_temp`
--
ALTER TABLE `password_reset_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tilføj AUTO_INCREMENT i tabel `postno`
--
ALTER TABLE `postno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tilføj AUTO_INCREMENT i tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tilføj AUTO_INCREMENT i tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
