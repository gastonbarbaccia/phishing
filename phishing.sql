-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-12-2022 a las 00:58:04
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
  `user_uid` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `captured_on` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campaign`
--

CREATE TABLE `campaign` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `deleted` varchar(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `group_id` int(11) NOT NULL,
  `email_template_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `campaign`
--

INSERT INTO `campaign` (`id`, `name`, `description`, `date_created`, `is_active`, `deleted`, `group_id`, `email_template_id`) VALUES
(1, 'Cencommerce', 'Campaña de phishing interno', '2022-12-18 19:08:39', 0, 'no', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `email_settings`
--

CREATE TABLE `email_settings` (
  `id` int(11) NOT NULL,
  `smtp_server` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `smtp_username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `smtp_password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `smtp_port` int(4) NOT NULL,
  `subject` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email_from` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `display` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `phishing_url` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `campaign_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `email_settings`
--

INSERT INTO `email_settings` (`id`, `smtp_server`, `smtp_username`, `smtp_password`, `smtp_port`, `subject`, `email_from`, `display`, `phishing_url`, `campaign_id`) VALUES
(1, 'in-v3.mailjet.com', '3aa698d4cd8be5e66d472936cca34626', 'd5ae76ec81d3c6fd52af3ff04c608960', 587, 'Reestablecimiento de clave', 'gaston.barbaccia@cencosud.com', 'Seguridad Informatica', 'www.subscriptionnetflix.com', 1);

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
(1, 'Netflix', 'Cambio de clave', 'asdf', '');

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
(1, 2);

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
(1, 'Netflix', 'Pagina de phishing', '');

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
(1, 'Netflix', 'Pagina de phishing', 'www.subscriptionnetflix.com', '');

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
(1, '639f6509a24', 'tlanghiiii@gmail.com', '', ''),
(2, '639f6509a33', 'gastonbarbaccia@hotmail.com', '', '');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `attack_user`
--
ALTER TABLE `attack_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `campaign`
--
ALTER TABLE `campaign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `email_settings`
--
ALTER TABLE `email_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `email_template`
--
ALTER TABLE `email_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `mygroup`
--
ALTER TABLE `mygroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `phishing_url`
--
ALTER TABLE `phishing_url`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
