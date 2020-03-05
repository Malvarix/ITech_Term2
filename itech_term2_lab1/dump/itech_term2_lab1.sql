-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Мар 02 2020 г., 23:14
-- Версия сервера: 10.4.10-MariaDB
-- Версия PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `itech_term2_lab1`
--
CREATE DATABASE IF NOT EXISTS `itech_term2_lab1` DEFAULT CHARACTER SET cp1251 COLLATE cp1251_general_ci;
USE `itech_term2_lab1`;

-- --------------------------------------------------------

--
-- Структура таблицы `client`
--

CREATE TABLE `client` (
  `ID_Client` decimal(10,0) NOT NULL,
  `name` varchar(25) DEFAULT NULL,
  `login` varchar(25) DEFAULT NULL,
  `password` varchar(16) DEFAULT NULL,
  `IP` varchar(25) DEFAULT NULL,
  `balance` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `client`
--

INSERT INTO `client` (`ID_Client`, `name`, `login`, `password`, `IP`, `balance`) VALUES
('23', 'Vladimir', 'vova1970', '1234v', '192.0.1.168', '7000'),
('24', 'Uliya', 'red98', 'ul9807', '178.4.0.67', '-1500'),
('25', 'Nikolay', 'razrushitel2002', 'r1n2q', '187.1.24.0', '-750'),
('35', 'Garyk', 'gar88', '89zik89', '67.124.1.0', '600');

-- --------------------------------------------------------

--
-- Структура таблицы `seanse`
--

CREATE TABLE `seanse` (
  `ID_Seanse` decimal(10,0) NOT NULL,
  `start` datetime DEFAULT NULL,
  `stop` datetime DEFAULT NULL,
  `in_trafic` decimal(10,0) DEFAULT NULL,
  `out_trafic` decimal(10,0) DEFAULT NULL,
  `FID_CLIENT` decimal(10,0) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `seanse`
--

INSERT INTO `seanse` (`ID_Seanse`, `start`, `stop`, `in_trafic`, `out_trafic`, `FID_CLIENT`) VALUES
('1167', '2020-01-01 12:05:01', '2020-01-01 15:27:10', '70', '40', '35'),
('1276', '2020-01-01 10:10:10', '2020-01-01 20:10:10', '250', '200', '23'),
('1301', '2020-01-02 07:00:53', '2020-01-02 11:34:09', '100', '80', '23');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`ID_Client`);

--
-- Индексы таблицы `seanse`
--
ALTER TABLE `seanse`
  ADD PRIMARY KEY (`ID_Seanse`) USING BTREE,
  ADD KEY `FID_CLIENT` (`FID_CLIENT`);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `seanse`
--
ALTER TABLE `seanse`
  ADD CONSTRAINT `seanse_ibfk_1` FOREIGN KEY (`FID_CLIENT`) REFERENCES `client` (`ID_Client`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
