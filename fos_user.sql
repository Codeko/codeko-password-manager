-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 20-03-2015 a las 12:13:27
-- Versión del servidor: 5.5.41-0ubuntu0.14.04.1
-- Versión de PHP: 5.5.9-1ubuntu4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `symfony`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fos_user`
--

CREATE TABLE IF NOT EXISTS `fos_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `username_canonical` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_canonical` varchar(255) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `fos_user`
--

INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`) VALUES
(1, 'testuser', 'testuser', 'test@example.com', 'test@example.com', 1, 'h0naiva59l440c04sg48k80g844k4gs', 'IlhIyYxcU9ckcUziTe0gqoeyq/g0BtVgUXsxOl1/I5FuzcB1zs+qLqDf44wSnYV/6PN0jfuXvV+nT03vnAjREQ==', NULL, 0, 0, NULL, '3rdp79yfcfeo00cws4w440gggk4440ko0wcgogok40oc0ocog8', NULL, 'a:0:{}', 0, NULL),
(3, 'testuser2', 'testuser2', 'a@a.com', 'a@a.com', 1, 'hy9lnkmlt14wgo0w4gss0owo4goc4ck', 'pXMewo+JK7t3ELTCpCiscG7xvBBsv7l09K47ks5c5BbPAUM+KyES5Gku6B3LplmIdX3YnWQGuXWWUK456QfsEQ==', NULL, 0, 0, NULL, '37samlguynwg88wko8skswokocck8k8sg88co0g00oosc00css', NULL, 'a:0:{}', 0, NULL),
(5, 'adminuser', 'adminuser', '1@a.com', '1@a.com', 1, '3tlmjb29qdgk8w8kco44w88ksowg4os', 'oHpt7PBueBlMJR6G70jdMF1qh0qGGwD37lU8a774TcdX2uz5HwkHjdcUMJ9bPzbU/mdrsQ6Prb2EwZkmDn5f5A==', '2015-03-20 12:05:58', 0, 0, NULL, '5bcgzaszoco4kgsk84oossw0so4wkowksc80cs4g88wkos8gks', NULL, 'a:1:{i:0;s:16:"ROLE_SUPER_ADMIN";}', 0, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
