-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-12-2022 a las 18:24:12
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
  `creado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `attack`
--

INSERT INTO `attack` (`id`, `date_time`, `mygroup_id`, `campa_id`, `creado`) VALUES
(201, '2022-12-13 22:19:27', 11, 29, 1),
(202, '2022-12-14 00:11:29', 1, 31, 1),
(203, '2022-12-14 00:11:56', 14, 30, 1),
(204, '2022-12-14 00:14:36', 13, 32, 1),
(205, '2022-12-14 00:22:38', 20, 33, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `attack_user`
--

CREATE TABLE `attack_user` (
  `id` int(11) NOT NULL,
  `email_sent` tinyint(1) DEFAULT NULL,
  `link_clicked` tinyint(1) DEFAULT NULL,
  `password_seen` tinyint(1) DEFAULT NULL,
  `attack_id` int(11) NOT NULL,
  `user_uid` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `attack_user`
--

INSERT INTO `attack_user` (`id`, `email_sent`, `link_clicked`, `password_seen`, `attack_id`, `user_uid`) VALUES
(437, 0, 1, 1, 201, '639660bef14'),
(438, NULL, NULL, NULL, 205, '63991719297'),
(439, NULL, 0, 0, 205, '639917194f8');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campaign`
--

CREATE TABLE `campaign` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_active` tinyint(1) DEFAULT NULL,
  `deleted` varchar(3) NOT NULL DEFAULT 'no',
  `group_id` int(11) NOT NULL,
  `email_template_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `campaign`
--

INSERT INTO `campaign` (`id`, `name`, `description`, `date_created`, `is_active`, `deleted`, `group_id`, `email_template_id`) VALUES
(30, 'Gaston', 'gaston', '2022-12-12 21:00:08', 0, 'no', 1, 34),
(32, 'Segunda', 'Segunda campaña', '2022-12-14 00:14:31', NULL, 'yes', 10, 34),
(33, 'Empresa', 'para la empresa', '2022-12-14 00:22:35', 0, 'yes', 1, 66),
(34, 'Nueva', 'nueva campaña', '2022-12-14 11:44:59', 0, 'yes', 21, 66);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `email_settings`
--

CREATE TABLE `email_settings` (
  `id` int(11) NOT NULL,
  `smtp_server` varchar(20) NOT NULL,
  `smtp_username` varchar(15) NOT NULL,
  `smtp_password` varchar(10) NOT NULL,
  `smtp_port` int(4) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `email_from` varchar(30) NOT NULL,
  `display` varchar(40) NOT NULL,
  `phishing_url` varchar(100) NOT NULL,
  `campaign_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `email_settings`
--

INSERT INTO `email_settings` (`id`, `smtp_server`, `smtp_username`, `smtp_password`, `smtp_port`, `subject`, `email_from`, `display`, `phishing_url`, `campaign_id`) VALUES
(30, 'lskdj', 'lkjsgf ', 'ljskg', 1234, 'sdgsd', 'ga', 'rgsfda', 'fdhbukahdg', 30),
(31, 'dgf', 'fbd', 'fhd', 33, 'fgxb', 'fdx', 'fdx', 'fd', 31),
(32, 'sdgwea', 'www', 'rgerahe', 44, 'ewag', 'arege', 'rear', 'rgeht', 32),
(33, 'sdgear', 'argae', 'aera', 23, 'sdfg', 'errrrrr', 'er', 'erer', 33),
(34, 'sdgars', 'fdgadrf', 'fdgare', 23, 'sagr', 'arga', 'rga', 'reha', 34),
(35, 'sdgear', 'argae', 'aera', 23, 'sdfg', 'errrrrr', 'er', 'erer', 35);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `email_template`
--

CREATE TABLE `email_template` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `email_template`
--

INSERT INTO `email_template` (`id`, `name`, `description`, `content`) VALUES
(34, 'ghsths', 'aerhwte', '<!DOCTYPE html>\r\n<html lang=\"en\">\r\n\r\n<head>\r\n  <meta charset=\"UTF-8\">\r\n  <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\r\n  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n  <title>Dashboard</title>'),
(64, 'dsfhst', 'shse', '<!DOCTYPE html>\n<html lang=\"en\">\n\n<head>\n  <meta charset=\"UTF-8\">\n  <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\n  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n  <title>Dashboard</title>\n  <!-- CSS only -->\n  <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css\" rel=\"stylesheet\" integrity=\"sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65\" crossorigin=\"anonymous\">\n  <link href=\"https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css\" rel=\"stylesheet\">\n  <link href=\"https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css\" rel=\"stylesheet\">\n\n\n</head>\n\n<body>\n\n  <?php\n\n  include \'layouts/nav.php\';\n\n  ?>\n\n  <div style=\"padding-top:2%;padding-left:1%;\">\n    <h3>Cencosud Phishing Campaing</h3>\n  </div>\n  <div style=\"margin: 3%\">\n    <table class=\"table table-hover\" id=\"datatable\">\n      <thead>\n        <tr>\n          <th scope=\"col\">ID</th>\n          <th scope=\"col\">Created date</th>\n          <th scope=\"col\">Name</th>\n          <th scope=\"col\">Description</th>\n          <th scope=\"col\">Active</th>\n          <th scope=\"col\">Options</th>\n          <th scope=\"col\">Attack</th>\n        </tr>\n      </thead>\n      <tbody>\n        <tr>\n          <th>1</th>\n          <td>5/12/2022 15:56</td>\n          <td><a href=\"campaing_details.php\">Cencosud Phishing Test</a></td>\n          <td>Prueba de phishing</td>\n          <td>Yes</td>\n          <td>\n            <a href=\"#\">Edit</a>\n            <a href=\"#\">Delete</a>\n          </td>\n          <td><a href=\"campaing_details.php\" style=\"color:red\"><strong>Launch Campaing!</strong></a></td>\n        </tr>\n      </tbody>\n    </table>\n  </div>\n  <?php\n\n  include \'layouts/footer.php\';\n\n  ?>\n  <!-- JavaScript Bundle with Popper -->\n  <script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js\" integrity=\"sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4\" crossorigin=\"anonymous\"></script>\n  <script src=\"https://code.jquery.com/jquery-3.5.1.js\"></script>\n  <script src=\"https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js\"></script>\n  <script src=\"https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js\"></script>\n  <script>\n    $(document).ready(function() {\n      $(\'#datatable\').DataTable();\n    });\n  </script>\n</body>\n\n</html>'),
(66, 'digiemon email', 'de Gaston inc.', '<html>\r\n  <head>\r\n    <title>Href Attribute Example</title>\r\n  </head>\r\n  <body>\r\n    <h1>Href Attribute Example</h1>\r\n    <p>\r\n      <a href=\"https://www.freecodecamp.org/contribute/\">The freeCodeCamp Contribution Page</a> shows you how and where you can contribute to freeCodeCamp\'s community and growth.\r\n    </p>\r\n  </body>\r\n</html>');

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
(9, 12),
(10, 13),
(10, 14),
(10, 15),
(11, 16),
(11, 17),
(11, 18),
(12, 19),
(12, 20),
(12, 21),
(13, 22),
(13, 23),
(14, 24),
(14, 25),
(14, 26),
(15, 27),
(16, 28),
(17, 29),
(18, 30),
(19, 31),
(20, 32),
(20, 33),
(21, 34),
(21, 35);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mygroup`
--

CREATE TABLE `mygroup` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `description` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `mygroup`
--

INSERT INTO `mygroup` (`id`, `name`, `description`) VALUES
(1, 'grupo 1', 'primer grupo'),
(2, 'grupo 2', '2do grupo'),
(3, 'grupo 3', '3er grupo'),
(4, 'grupo 4', '4to grupo'),
(5, 'grupo 5', '5to grupo'),
(6, 'grupo 6', '6to grupo'),
(7, 'grupo 7', '7mo grupo'),
(8, 'grupo 8', '8vo grupo'),
(9, 'grupo 9', '9no grupo'),
(10, 'grupo 10', '10mo grupo'),
(11, 'gaston', 'que grande'),
(12, 'gaston2', 'que grande2'),
(13, 'one', 'grupo 1'),
(14, 'pokemon', 'digiemon'),
(20, 'ceos', 'grupo de ceos'),
(21, 'dos', 'grupo dos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `uid` varchar(11) NOT NULL,
  `email_address` text NOT NULL,
  `password` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `uid`, `email_address`, `password`) VALUES
(32, '63991719297', 'ceo1@arnet.com', NULL),
(33, '639917194f8', ' ceo2@telecom.com', NULL),
(34, '6399b702ea5', 'jose@hotmail.com', NULL),
(35, '6399b7030be', 'arroba@hotmail.com', NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT de la tabla `attack_user`
--
ALTER TABLE `attack_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=440;

--
-- AUTO_INCREMENT de la tabla `campaign`
--
ALTER TABLE `campaign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `email_settings`
--
ALTER TABLE `email_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `email_template`
--
ALTER TABLE `email_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT de la tabla `mygroup`
--
ALTER TABLE `mygroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
