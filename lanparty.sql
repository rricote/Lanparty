-- phpMyAdmin SQL Dump
-- version 4.2.6deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 12-05-2015 a las 17:37:37
-- Versión del servidor: 5.6.19-1~exp1ubuntu2
-- Versión de PHP: 5.6.6-1+deb.sury.org~utopic+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `lanparty`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `assigancions`
--

CREATE TABLE IF NOT EXISTS `assigancions` (
`ass_numero` int(11) NOT NULL,
  `usu_id` int(11) NOT NULL,
  `mot_id` int(11) NOT NULL,
  `data_assig` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pre_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `assistencies`
--

CREATE TABLE IF NOT EXISTS `assistencies` (
`id` int(10) unsigned NOT NULL,
  `accio` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `usuaris_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `competicions`
--

CREATE TABLE IF NOT EXISTS `competicions` (
  `comp_id` int(11) NOT NULL,
  `usu_id` int(11) NOT NULL,
  `comp_grup_id` int(11) NOT NULL,
  `comp_grup_nom` mediumtext NOT NULL,
  `comp_grup_validat` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `competicio_nom`
--

CREATE TABLE IF NOT EXISTS `competicio_nom` (
`comp_id` int(11) NOT NULL,
  `comp_nom` mediumtext NOT NULL,
  `logo` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estats`
--

CREATE TABLE IF NOT EXISTS `estats` (
`est_id` int(11) NOT NULL,
  `est_nom` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `motius`
--

CREATE TABLE IF NOT EXISTS `motius` (
`mot_id` int(11) NOT NULL,
  `mot_nom` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `patrocinadors`
--

CREATE TABLE IF NOT EXISTS `patrocinadors` (
`id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `tipus` smallint(5) NOT NULL DEFAULT '0',
  `logo` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `premis`
--

CREATE TABLE IF NOT EXISTS `premis` (
`pre_id` int(11) NOT NULL,
  `pre_nom` varchar(50) NOT NULL,
  `pre_empresa` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rols`
--

CREATE TABLE IF NOT EXISTS `rols` (
`rol_id` int(11) NOT NULL,
  `rol_nom` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(10) unsigned NOT NULL,
  `dni` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cognom1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cognom2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ultratoken` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `anticuser` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `estats_id` int(11) NOT NULL,
  `rols_id` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuaris`
--

CREATE TABLE IF NOT EXISTS `usuaris` (
`usu_id` int(11) NOT NULL,
  `usu_dni` varchar(10) NOT NULL,
  `usu_nom` varchar(30) NOT NULL,
  `usu_cognom1` varchar(30) NOT NULL,
  `usu_cognom2` varchar(30) NOT NULL,
  `usu_nick` varchar(30) NOT NULL,
  `usu_correu` varchar(40) NOT NULL,
  `usu_pwd` longtext NOT NULL,
  `data_registre` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `remember_token` varchar(100) NOT NULL,
  `token` varchar(100) NOT NULL,
  `est_id` int(11) NOT NULL DEFAULT '1',
  `rol_id` int(11) NOT NULL DEFAULT '2'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `assigancions`
--
ALTER TABLE `assigancions`
 ADD PRIMARY KEY (`ass_numero`), ADD KEY `usu_id` (`usu_id`), ADD KEY `mot_id` (`mot_id`), ADD KEY `pre_id` (`pre_id`);

--
-- Indices de la tabla `assistencies`
--
ALTER TABLE `assistencies`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `competicions`
--
ALTER TABLE `competicions`
 ADD KEY `comp_id` (`comp_id`,`usu_id`), ADD KEY `usu_id` (`usu_id`);

--
-- Indices de la tabla `competicio_nom`
--
ALTER TABLE `competicio_nom`
 ADD PRIMARY KEY (`comp_id`);

--
-- Indices de la tabla `estats`
--
ALTER TABLE `estats`
 ADD PRIMARY KEY (`est_id`);

--
-- Indices de la tabla `motius`
--
ALTER TABLE `motius`
 ADD PRIMARY KEY (`mot_id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
 ADD KEY `password_resets_email_index` (`email`), ADD KEY `password_resets_token_index` (`token`);

--
-- Indices de la tabla `patrocinadors`
--
ALTER TABLE `patrocinadors`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `premis`
--
ALTER TABLE `premis`
 ADD PRIMARY KEY (`pre_id`);

--
-- Indices de la tabla `rols`
--
ALTER TABLE `rols`
 ADD PRIMARY KEY (`rol_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `usuaris`
--
ALTER TABLE `usuaris`
 ADD PRIMARY KEY (`usu_id`), ADD UNIQUE KEY `usu_nick` (`usu_nick`), ADD UNIQUE KEY `usu_dni` (`usu_dni`), ADD KEY `est_id` (`est_id`), ADD KEY `rol_id` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `assigancions`
--
ALTER TABLE `assigancions`
MODIFY `ass_numero` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `assistencies`
--
ALTER TABLE `assistencies`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `competicio_nom`
--
ALTER TABLE `competicio_nom`
MODIFY `comp_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `estats`
--
ALTER TABLE `estats`
MODIFY `est_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `motius`
--
ALTER TABLE `motius`
MODIFY `mot_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `patrocinadors`
--
ALTER TABLE `patrocinadors`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `premis`
--
ALTER TABLE `premis`
MODIFY `pre_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `rols`
--
ALTER TABLE `rols`
MODIFY `rol_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuaris`
--
ALTER TABLE `usuaris`
MODIFY `usu_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `assigancions`
--
ALTER TABLE `assigancions`
ADD CONSTRAINT `assigancions_ibfk_2` FOREIGN KEY (`mot_id`) REFERENCES `motius` (`mot_id`),
ADD CONSTRAINT `assigancions_ibfk_3` FOREIGN KEY (`pre_id`) REFERENCES `premis` (`pre_id`),
ADD CONSTRAINT `assigancions_ibfk_4` FOREIGN KEY (`usu_id`) REFERENCES `usuaris` (`usu_id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `competicions`
--
ALTER TABLE `competicions`
ADD CONSTRAINT `competicions_ibfk_1` FOREIGN KEY (`comp_id`) REFERENCES `competicio_nom` (`comp_id`),
ADD CONSTRAINT `competicions_ibfk_2` FOREIGN KEY (`usu_id`) REFERENCES `usuaris` (`usu_id`);

--
-- Filtros para la tabla `usuaris`
--
ALTER TABLE `usuaris`
ADD CONSTRAINT `usuaris_ibfk_1` FOREIGN KEY (`est_id`) REFERENCES `estats` (`est_id`),
ADD CONSTRAINT `usuaris_ibfk_2` FOREIGN KEY (`rol_id`) REFERENCES `rols` (`rol_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;