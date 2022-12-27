-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-12-2022 a las 23:49:07
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `phishing`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `attack`
--

CREATE TABLE `attack` (
  `id` int(11) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `mygroup_id` int(11) NOT NULL,
  `campa_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `attack`
--

INSERT INTO `attack` (`id`, `date_time`, `mygroup_id`, `campa_id`, `status`) VALUES
(1, '2022-12-27 22:44:00', 1, 1, 1),
(2, '2022-12-27 22:47:07', 1, 2, 2),
(3, '2022-12-27 22:48:00', 1, 3, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `attack_user`
--

CREATE TABLE `attack_user` (
  `id` int(11) NOT NULL,
  `email_sent` tinyint(1) NOT NULL DEFAULT 0,
  `link_clicked` tinyint(1) NOT NULL DEFAULT 0,
  `password_seen` tinyint(1) NOT NULL DEFAULT 0,
  `attack_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_uid` varchar(11) NOT NULL,
  `captured_on` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_username` varchar(50) NOT NULL,
  `user_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `attack_user`
--

INSERT INTO `attack_user` (`id`, `email_sent`, `link_clicked`, `password_seen`, `attack_id`, `user_id`, `user_uid`, `captured_on`, `user_username`, `user_password`) VALUES
(1, 1, 0, 0, 2, 1, '63ab74e079b', NULL, '', ''),
(2, 1, 0, 0, 2, 2, '63ab74e08ca', NULL, '', ''),
(3, 1, 0, 0, 3, 1, '63ab7620ae3', NULL, '', ''),
(4, 1, 0, 0, 3, 2, '63ab7620ca1', NULL, '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campaign`
--

CREATE TABLE `campaign` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_active` tinyint(1) NOT NULL,
  `deleted` varchar(3) NOT NULL DEFAULT 'no',
  `group_id` int(11) NOT NULL,
  `email_template_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `campaign`
--

INSERT INTO `campaign` (`id`, `name`, `description`, `date_created`, `is_active`, `deleted`, `group_id`, `email_template_id`) VALUES
(1, '1', '1', '2022-12-27 22:43:27', 0, 'no', 1, 1),
(2, '2', '2', '2022-12-27 22:43:47', 0, 'no', 1, 1),
(3, '3', '3', '2022-12-27 22:47:51', 0, 'no', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `email_settings`
--

CREATE TABLE `email_settings` (
  `id` int(11) NOT NULL,
  `smtp_server` varchar(50) NOT NULL,
  `smtp_username` varchar(50) NOT NULL,
  `smtp_password` varchar(150) NOT NULL,
  `smtp_port` int(4) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `email_from` varchar(200) NOT NULL,
  `display` varchar(40) NOT NULL,
  `phishing_url` varchar(100) NOT NULL,
  `campaign_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `email_settings`
--

INSERT INTO `email_settings` (`id`, `smtp_server`, `smtp_username`, `smtp_password`, `smtp_port`, `subject`, `email_from`, `display`, `phishing_url`, `campaign_id`) VALUES
(1, 'in-v3.mailjet.com', '584fc209cad8d72bf9df49866b9180f8', 'ff83b78c75842de10a43128efb015c5f', 587, '', '', '', 'www.url.com', 1),
(2, 'in-v3.mailjet.com', '584fc209cad8d72bf9df49866b9180f8', 'ff83b78c75842de10a43128efb015c5f', 587, '', '', '', 'www.url.com', 2),
(3, 'in-v3.mailjet.com', '584fc209cad8d72bf9df49866b9180f8', 'ff83b78c75842de10a43128efb015c5f', 587, '', '', '', 'www.url.com', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `email_template`
--

CREATE TABLE `email_template` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `email_deleted` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `email_template`
--

INSERT INTO `email_template` (`id`, `name`, `description`, `content`, `email_deleted`) VALUES
(1, '1', '1', 'html', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `group_user`
--

CREATE TABLE `group_user` (
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `group_user`
--

INSERT INTO `group_user` (`group_id`, `user_id`) VALUES
(1, 1),
(1, 2),
(2, 3),
(2, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mygroup`
--

CREATE TABLE `mygroup` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `description` varchar(150) NOT NULL,
  `group_deleted` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `mygroup`
--

INSERT INTO `mygroup` (`id`, `name`, `description`, `group_deleted`) VALUES
(1, '1', '1', ''),
(2, '2', '2', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `phishing_url`
--

CREATE TABLE `phishing_url` (
  `id` int(200) NOT NULL,
  `name` varchar(300) NOT NULL,
  `description` varchar(200) NOT NULL,
  `url` varchar(200) NOT NULL,
  `phishing_deleted` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `phishing_url`
--

INSERT INTO `phishing_url` (`id`, `name`, `description`, `url`, `phishing_deleted`) VALUES
(1, '1', '1', 'www.url.com', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `uid` varchar(11) NOT NULL,
  `email_address` text NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `deleted` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `uid`, `email_address`, `username`, `password`, `deleted`) VALUES
(1, '63ab7620ae3', 'msa@tel1.tel.vtt.fi', '', '', ''),
(2, '63ab7620ca1', 'ircuser@kragar.eff.org', '', '', ''),
(3, '63ab74ec54a', 'tlanghiiii@gmail.com', '', '', ''),
(4, '63ab74ec6a5', 'test2xasdtl@gmail.com', '', '', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `attack`
--
ALTER TABLE `attack`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `attack_user`
--
ALTER TABLE `attack_user`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `campaign`
--
ALTER TABLE `campaign`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `email_template_id` (`email_template_id`);

--
-- Indices de la tabla `email_settings`
--
ALTER TABLE `email_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `email_template`
--
ALTER TABLE `email_template`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mygroup`
--
ALTER TABLE `mygroup`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `phishing_url`
--
ALTER TABLE `phishing_url`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `attack`
--
ALTER TABLE `attack`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `attack_user`
--
ALTER TABLE `attack_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `campaign`
--
ALTER TABLE `campaign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `email_settings`
--
ALTER TABLE `email_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `email_template`
--
ALTER TABLE `email_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `mygroup`
--
ALTER TABLE `mygroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `phishing_url`
--
ALTER TABLE `phishing_url`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
