-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-12-2022 a las 02:32:10
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

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
  `creado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `attack`
--

INSERT INTO `attack` (`id`, `date_time`, `mygroup_id`, `campa_id`, `creado`) VALUES
(1, '2022-12-16 01:05:01', 1, 5, 1),
(2, '2022-12-16 01:09:13', 1, 6, 1),
(3, '2022-12-16 01:10:22', 1, 3, 1),
(4, '2022-12-16 01:16:05', 1, 7, 0),
(5, '2022-12-16 01:17:23', 1, 6, 0);

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
  `user_uid` varchar(11) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `attack_user`
--

INSERT INTO `attack_user` (`id`, `email_sent`, `link_clicked`, `password_seen`, `attack_id`, `user_uid`) VALUES
(1, 0, 0, 0, 1, '639bc13068b'),
(2, 0, 0, 0, 1, '639bc130697'),
(3, 0, 0, 0, 2, '639bc13068b'),
(4, 0, 0, 0, 2, '639bc130697'),
(5, 0, 0, 0, 3, '639bc13068b'),
(6, 0, 0, 0, 3, '639bc130697'),
(7, 0, 0, 0, 4, '639bc13068b'),
(8, 0, 0, 0, 4, '639bc130697'),
(9, 0, 0, 0, 5, '639bc13068b'),
(10, 0, 0, 0, 5, '639bc130697');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campaign`
--

CREATE TABLE `campaign` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_active` tinyint(1) NOT NULL,
  `deleted` varchar(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `group_id` int(11) NOT NULL,
  `email_template_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `campaign`
--

INSERT INTO `campaign` (`id`, `name`, `description`, `date_created`, `is_active`, `deleted`, `group_id`, `email_template_id`) VALUES
(1, 'Cencosud ', 'Cencommerce', '2022-12-16 00:53:27', 0, 'yes', 1, 1),
(2, 'Cencosud ', 'Cencommerce', '2022-12-16 00:57:54', 0, 'yes', 1, 1),
(3, 'Cencosud ', 'Cencommerce', '2022-12-16 00:58:54', 1, 'yes', 1, 1),
(4, 'Cencosud ', 'Cencommerce', '2022-12-16 01:04:46', 0, 'yes', 1, 1),
(5, 'Cencosud ', 'Cencommerce', '2022-12-16 01:04:55', 1, 'yes', 1, 1),
(6, 'Cencosud ', 'Cencommerce', '2022-12-16 01:08:54', 1, 'yes', 1, 1),
(7, 'Cencosud ', 'Cencommerce', '2022-12-16 01:15:49', 1, 'yes', 1, 1),
(8, 'Cencosud ', 'Cencommerce', '2022-12-16 01:28:40', 0, 'no', 1, 1),
(9, 'Cencosud ', 'Cencommerce', '2022-12-16 01:28:48', 1, 'no', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `email_settings`
--

CREATE TABLE `email_settings` (
  `id` int(11) NOT NULL,
  `smtp_server` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `smtp_username` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `smtp_password` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `smtp_port` int(4) NOT NULL,
  `subject` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email_from` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `display` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `phishing_url` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `campaign_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `email_settings`
--

INSERT INTO `email_settings` (`id`, `smtp_server`, `smtp_username`, `smtp_password`, `smtp_port`, `subject`, `email_from`, `display`, `phishing_url`, `campaign_id`) VALUES
(1, 'o365.smtp.com', 'gastonbarbaccia', 'asdf', 587, 'Reestablecimiento de clave', 'Gaston Barbaccia<gaston.barbac', 'Seguridad Informatica', 'https://www.google.com 1', 1),
(2, 'o365.smtp.com', 'gastonbarbaccia', 'asdf', 0, 'Reestablecimiento de clave', 'Gaston Barbaccia<gaston.barbac', 'Seguridad Informatica', 'https://www.google.com 1', 2),
(3, 'o365.smtp.com', 'gastonbarbaccia', 'asdf', 587, 'Reestablecimiento de clave', 'Gaston Barbaccia<gaston.barbac', 'Seguridad Informatica', 'https://www.google.com 1', 3),
(4, 'o365.smtp.com', 'gastonbarbaccia', 'sadf', 0, 'Reestablecimiento de clave', 'Gaston Barbaccia<gaston.barbac', 'Seguridad Informatica', 'https://www.google.com 1', 4),
(5, '', '', '', 0, '', '', '', 'https://www.google.com 1', 5),
(6, '', '', '', 0, '', '', '', 'https://www.google.com 1', 6),
(7, 'o365.smtp.com', 'gastonbarbaccia', 'asdf', 0, 'Reestablecimiento de clave', 'Gaston Barbaccia<gaston.barbac', 'Seguridad Informatica', 'https://www.google.com 1', 7),
(8, 'o365.smtp.com', 'gastonbarbaccia', '', 0, '', '', '', 'https://www.google.com 1', 8),
(9, '', '', '', 0, '', '', '', 'https://www.google.com 1', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `email_template`
--

CREATE TABLE `email_template` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `email_deleted` varchar(5) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `email_template`
--

INSERT INTO `email_template` (`id`, `name`, `description`, `content`, `email_deleted`) VALUES
(1, 'Teresita phishing 1', 'Sos grosa!!1', 'asdf1', ''),
(2, 'Teresita phishing', 'Sos grosa!!', '123123123', 'yes');

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
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `group_deleted` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `mygroup`
--

INSERT INTO `mygroup` (`id`, `name`, `description`, `group_deleted`) VALUES
(1, 'Cencommerce externos', 'prueba', ''),
(2, 'Cencommerce externos 12', 'Prueba de linkedin12', 'yes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `phishing_url`
--

CREATE TABLE `phishing_url` (
  `id` int(200) NOT NULL,
  `name` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `phishing_deleted` varchar(5) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `phishing_url`
--

INSERT INTO `phishing_url` (`id`, `name`, `description`, `url`, `phishing_deleted`) VALUES
(1, 'Cencommerce externos 1', 'prueba1', 'https://www.google.com 1', ''),
(2, 'Cencommerce externos', 'prueba2', 'https://www', 'yes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `uid` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `email_address` text COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `deleted` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `uid`, `email_address`, `password`, `deleted`) VALUES
(1, '639bc13068b', 'gastonbarbaccia@hotmail.com', '', ''),
(2, '639bc130697', 'gastonbarbaccia@hotmail.com', '', ''),
(3, '639bc1402ab', 'gastonbarbaccia@hotmail.com', '', ''),
(4, '639bc1402ce', 'gastonbarbaccia@hotmail.com', '', '');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `attack_user`
--
ALTER TABLE `attack_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `campaign`
--
ALTER TABLE `campaign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `email_settings`
--
ALTER TABLE `email_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `email_template`
--
ALTER TABLE `email_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `mygroup`
--
ALTER TABLE `mygroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `phishing_url`
--
ALTER TABLE `phishing_url`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
