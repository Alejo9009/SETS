-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-02-2025 a las 00:30:57
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sets`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anuncio`
--

CREATE TABLE `anuncio` (
  `idAnuncio` int(11) NOT NULL,
  `titulo` varchar(45) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `fechaPublicacion` date DEFAULT NULL,
  `horaPublicacion` time DEFAULT NULL,
  `persona` int(11) NOT NULL,
  `apart` int(22) NOT NULL,
  `img_anuncio` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apartamento`
--

CREATE TABLE `apartamento` (
  `id_Apartamento` int(11) NOT NULL,
  `numApartamento` varchar(111) DEFAULT NULL,
  `descripcionApartamento` varchar(45) DEFAULT NULL,
  `pisos` varchar(11) NOT NULL,
  `torrres` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `apartamento`
--

INSERT INTO `apartamento` (`id_Apartamento`, `numApartamento`, `descripcionApartamento`, `pisos`, `torrres`) VALUES
(3, '101A', 'Apartamento 101A', '1A', 1),
(4, '102A', 'Apartamento 102A', '1A', 1),
(5, '103A', 'Apartamento 103A', '1A', 1),
(6, '104A', 'Apartamento 104A', '1A', 1),
(7, '201A', 'Apartamento 201A', '2A', 1),
(8, '202A', 'Apartamento 202A', '2A', 1),
(9, '203A', 'Apartamento 203A', '2A', 1),
(10, '204A', 'Apartamento 204A', '2A', 1),
(11, '301A', 'Apartamento 301A', '3A', 1),
(12, '302A', 'Apartamento 302A', '3A', 1),
(13, '303A', 'Apartamento 303A', '3A', 1),
(14, '304A', 'Apartamento 304A', '3A', 1),
(15, '401A', 'Apartamento 401A', '4A', 1),
(16, '402A', 'Apartamento 402A', '4A', 1),
(17, '403A', 'Apartamento 403A', '4A', 1),
(18, '404A', 'Apartamento 404A', '4A', 1),
(19, '501A', 'Apartamento 501A', '5A', 1),
(20, '502A', 'Apartamento 502A', '5A', 1),
(21, '503A', 'Apartamento 503A', '5A', 1),
(22, '504A', 'Apartamento 504A', '5A', 1),
(23, '601A', 'Apartamento 601A', '6A', 1),
(24, '602A', 'Apartamento 602A', '6A', 1),
(25, '603A', 'Apartamento 603A', '6A', 1),
(26, '604A', 'Apartamento 604A', '6A', 1),
(27, '701A', 'Apartamento 701A', '7A', 1),
(28, '702A', 'Apartamento 702A', '7A', 1),
(29, '703A', 'Apartamento 703A', '7A', 1),
(30, '704A', 'Apartamento 704A', '7A', 1),
(31, '801A', 'Apartamento 801A', '8A', 1),
(32, '802A', 'Apartamento 802A', '8A', 1),
(33, '803A', 'Apartamento 803A', '8A', 1),
(34, '804A', 'Apartamento 804A', '8A', 1),
(35, '901A', 'Apartamento 901A', '9A', 1),
(36, '902A', 'Apartamento 902A', '9A', 1),
(37, '903A', 'Apartamento 903A', '9A', 1),
(38, '904A', 'Apartamento 904A', '9A', 1),
(39, '1001A', 'Apartamento 1001A', '10A', 1),
(40, '1002A', 'Apartamento 1002A', '10A', 1),
(41, '1003A', 'Apartamento 1003A', '10A', 1),
(42, '1004A', 'Apartamento 1004A', '10A', 1),
(43, '101B', 'Apartamento 101B', '1B', 2),
(44, '102B', 'Apartamento 102B', '1B', 2),
(45, '103B', 'Apartamento 103B', '1B', 2),
(46, '104B', 'Apartamento 104B', '1B', 2),
(47, '201B', 'Apartamento 201B', '2B', 2),
(48, '202B', 'Apartamento 202B', '2B', 2),
(49, '203B', 'Apartamento 203B', '2B', 2),
(50, '204B', 'Apartamento 204B', '2B', 2),
(51, '301B', 'Apartamento 301B', '3B', 2),
(52, '302B', 'Apartamento 302B', '3B', 2),
(53, '303B', 'Apartamento 303B', '3B', 2),
(54, '304B', 'Apartamento 304B', '3B', 2),
(55, '401B', 'Apartamento 401B', '4B', 2),
(56, '402B', 'Apartamento 402B', '4B', 2),
(57, '403B', 'Apartamento 403B', '4B', 2),
(58, '404B', 'Apartamento 404B', '4B', 2),
(59, '501B', 'Apartamento 501B', '5B', 2),
(60, '502B', 'Apartamento 502B', '5B', 2),
(61, '503B', 'Apartamento 503B', '5B', 2),
(62, '504B', 'Apartamento 504B', '5B', 2),
(63, '601B', 'Apartamento 601B', '6B', 2),
(64, '602B', 'Apartamento 602B', '6B', 2),
(65, '603B', 'Apartamento 603B', '6B', 2),
(66, '604B', 'Apartamento 604B', '6B', 2),
(67, '701B', 'Apartamento 701B', '7B', 2),
(68, '702B', 'Apartamento 702B', '7B', 2),
(69, '703B', 'Apartamento 703B', '7B', 2),
(70, '704B', 'Apartamento 704B', '7B', 2),
(71, '801B', 'Apartamento 801B', '8B', 2),
(72, '802B', 'Apartamento 802B', '8B', 2),
(73, '803B', 'Apartamento 803B', '8B', 2),
(74, '804B', 'Apartamento 804B', '8B', 2),
(75, '901B', 'Apartamento 901B', '9B', 2),
(76, '902B', 'Apartamento 902B', '9B', 2),
(77, '903B', 'Apartamento 903B', '9B', 2),
(78, '904B', 'Apartamento 904B', '9B', 2),
(79, '1001B', 'Apartamento 1001B', '10B', 2),
(80, '1002B', 'Apartamento 1002B', '10B', 2),
(81, '1003B', 'Apartamento 1003B', '10B', 2),
(82, '1004B', 'Apartamento 1004B', '10B', 2),
(83, '101C', 'Apartamento 101C', '1C', 3),
(84, '102C', 'Apartamento 102C', '1C', 3),
(85, '103C', 'Apartamento 103C', '1C', 3),
(86, '104C', 'Apartamento 104C', '1C', 3),
(87, '201C', 'Apartamento 201C', '2C', 3),
(88, '202C', 'Apartamento 202C', '2C', 3),
(89, '203C', 'Apartamento 203C', '2C', 3),
(90, '204C', 'Apartamento 204C', '2C', 3),
(91, '301C', 'Apartamento 301C', '3C', 3),
(92, '302C', 'Apartamento 302C', '3C', 3),
(93, '303C', 'Apartamento 303C', '3C', 3),
(94, '304C', 'Apartamento 304C', '3C', 3),
(95, '401C', 'Apartamento 401C', '4C', 3),
(96, '402C', 'Apartamento 402C', '4C', 3),
(97, '403C', 'Apartamento 403C', '4C', 3),
(98, '404C', 'Apartamento 404C', '4C', 3),
(99, '501C', 'Apartamento 501C', '5C', 3),
(100, '502C', 'Apartamento 502C', '5C', 3),
(101, '503C', 'Apartamento 503C', '5C', 3),
(102, '504C', 'Apartamento 504C', '5C', 3),
(103, '601C', 'Apartamento 601C', '6C', 3),
(104, '602C', 'Apartamento 602C', '6C', 3),
(105, '603C', 'Apartamento 603C', '6C', 3),
(106, '604C', 'Apartamento 604C', '6C', 3),
(107, '701C', 'Apartamento 701C', '7C', 3),
(108, '702C', 'Apartamento 702C', '7C', 3),
(109, '703C', 'Apartamento 703C', '7C', 3),
(110, '704C', 'Apartamento 704C', '7C', 3),
(111, '801C', 'Apartamento 801C', '8C', 3),
(112, '802C', 'Apartamento 802C', '8C', 3),
(113, '803C', 'Apartamento 803C', '8C', 3),
(114, '804C', 'Apartamento 804C', '8C', 3),
(115, '901C', 'Apartamento 901C', '9C', 3),
(116, '902C', 'Apartamento 902C', '9C', 3),
(117, '903C', 'Apartamento 903C', '9C', 3),
(118, '904C', 'Apartamento 904C', '9C', 3),
(119, '1001C', 'Apartamento 1001C', '10C', 3),
(120, '1002C', 'Apartamento 1002C', '10C', 3),
(121, '1003C', 'Apartamento 1003C', '10C', 3),
(122, '1004C', 'Apartamento 1004C', '10C', 3),
(123, '101D', 'Apartamento 101D', '1D', 4),
(124, '102D', 'Apartamento 102D', '1D', 4),
(125, '103D', 'Apartamento 103D', '1D', 4),
(126, '104D', 'Apartamento 104D', '1D', 4),
(127, '201D', 'Apartamento 201D', '2D', 4),
(128, '202D', 'Apartamento 202D', '2D', 4),
(129, '203D', 'Apartamento 203D', '2D', 4),
(130, '204D', 'Apartamento 204D', '2D', 4),
(131, '301D', 'Apartamento 301D', '3D', 4),
(132, '302D', 'Apartamento 302D', '3D', 4),
(133, '303D', 'Apartamento 303D', '3D', 4),
(134, '304D', 'Apartamento 304D', '3D', 4),
(135, '401D', 'Apartamento 401D', '4D', 4),
(136, '402D', 'Apartamento 402D', '4D', 4),
(137, '403D', 'Apartamento 403D', '4D', 4),
(138, '404D', 'Apartamento 404D', '4D', 4),
(139, '501D', 'Apartamento 501D', '5D', 4),
(140, '502D', 'Apartamento 502D', '5D', 4),
(141, '503D', 'Apartamento 503D', '5D', 4),
(142, '504D', 'Apartamento 504D', '5D', 4),
(143, '601D', 'Apartamento 601D', '6D', 4),
(144, '602D', 'Apartamento 602D', '6D', 4),
(145, '603D', 'Apartamento 603D', '6D', 4),
(146, '604D', 'Apartamento 604D', '6D', 4),
(147, '701D', 'Apartamento 701D', '7D', 4),
(148, '702D', 'Apartamento 702D', '7D', 4),
(149, '703D', 'Apartamento 703D', '7D', 4),
(150, '704D', 'Apartamento 704D', '7D', 4),
(151, '801D', 'Apartamento 801D', '8D', 4),
(152, '802D', 'Apartamento 802D', '8D', 4),
(153, '803D', 'Apartamento 803D', '8D', 4),
(154, '804D', 'Apartamento 804D', '8D', 4),
(155, '901D', 'Apartamento 901D', '9D', 4),
(156, '902D', 'Apartamento 902D', '9D', 4),
(157, '903D', 'Apartamento 903D', '9D', 4),
(158, '904D', 'Apartamento 904D', '9D', 4),
(159, '1001D', 'Apartamento 1001D', '10D', 4),
(160, '1002D', 'Apartamento 1002D', '10D', 4),
(161, '1003D', 'Apartamento 1003D', '10D', 4),
(162, '1004D', 'Apartamento 1004D', '10D', 4),
(163, '101E', 'Apartamento 101E', '1E', 5),
(164, '102E', 'Apartamento 102E', '1E', 5),
(165, '103E', 'Apartamento 103E', '1E', 5),
(166, '104E', 'Apartamento 104E', '1E', 5),
(167, '201E', 'Apartamento 201E', '2E', 5),
(168, '202E', 'Apartamento 202E', '2E', 5),
(169, '203E', 'Apartamento 203E', '2E', 5),
(170, '204E', 'Apartamento 204E', '2E', 5),
(171, '301E', 'Apartamento 301E', '3E', 5),
(172, '302E', 'Apartamento 302E', '3E', 5),
(173, '303E', 'Apartamento 303E', '3E', 5),
(174, '304E', 'Apartamento 304E', '3E', 5),
(175, '401E', 'Apartamento 401E', '4E', 5),
(176, '402E', 'Apartamento 402E', '4E', 5),
(177, '403E', 'Apartamento 403E', '4E', 5),
(178, '404E', 'Apartamento 404E', '4E', 5),
(179, '501E', 'Apartamento 501E', '5E', 5),
(180, '502E', 'Apartamento 502E', '5E', 5),
(181, '503E', 'Apartamento 503E', '5E', 5),
(182, '504E', 'Apartamento 504E', '5E', 5),
(183, '601E', 'Apartamento 601E', '6E', 5),
(184, '602E', 'Apartamento 602E', '6E', 5),
(185, '603E', 'Apartamento 603E', '6E', 5),
(186, '604E', 'Apartamento 604E', '6E', 5),
(187, '701E', 'Apartamento 701E', '7E', 5),
(188, '702E', 'Apartamento 702E', '7E', 5),
(189, '703E', 'Apartamento 703E', '7E', 5),
(190, '704E', 'Apartamento 704E', '7E', 5),
(191, '801E', 'Apartamento 801E', '8E', 5),
(192, '802E', 'Apartamento 802E', '8E', 5),
(193, '803E', 'Apartamento 803E', '8E', 5),
(194, '804E', 'Apartamento 804E', '8E', 5),
(195, '901E', 'Apartamento 901E', '9E', 5),
(196, '902E', 'Apartamento 902E', '9E', 5),
(197, '903E', 'Apartamento 903E', '9E', 5),
(198, '904E', 'Apartamento 904E', '9E', 5),
(199, '1001E', 'Apartamento 1001E', '10E', 5),
(200, '1002E', 'Apartamento 1002E', '10E', 5),
(201, '1003E', 'Apartamento 1003E', '10E', 5),
(202, '1004E', 'Apartamento 1004E', '10E', 5),
(203, '101F', 'Apartamento 101F', '1F', 6),
(204, '102F', 'Apartamento 102F', '1F', 6),
(205, '103F', 'Apartamento 103F', '1F', 6),
(206, '104F', 'Apartamento 104F', '1F', 6),
(207, '201F', 'Apartamento 201F', '2F', 6),
(208, '202F', 'Apartamento 202F', '2F', 6),
(209, '203F', 'Apartamento 203F', '2F', 6),
(210, '204F', 'Apartamento 204F', '2F', 6),
(211, '301F', 'Apartamento 301F', '3F', 6),
(212, '302F', 'Apartamento 302F', '3F', 6),
(213, '303F', 'Apartamento 303F', '3F', 6),
(214, '304F', 'Apartamento 304F', '3F', 6),
(215, '401F', 'Apartamento 401F', '4F', 6),
(216, '402F', 'Apartamento 402F', '4F', 6),
(217, '403F', 'Apartamento 403F', '4F', 6),
(218, '404F', 'Apartamento 404F', '4F', 6),
(219, '501F', 'Apartamento 501F', '5F', 6),
(220, '502F', 'Apartamento 502F', '5F', 6),
(221, '503F', 'Apartamento 503F', '5F', 6),
(222, '504F', 'Apartamento 504F', '5F', 6),
(223, '601F', 'Apartamento 601F', '6F', 6),
(224, '602F', 'Apartamento 602F', '6F', 6),
(225, '603F', 'Apartamento 603F', '6F', 6),
(226, '604F', 'Apartamento 604F', '6F', 6),
(227, '701F', 'Apartamento 701F', '7F', 6),
(228, '702F', 'Apartamento 702F', '7F', 6),
(229, '703F', 'Apartamento 703F', '7F', 6),
(230, '704F', 'Apartamento 704F', '7F', 6),
(231, '801F', 'Apartamento 801F', '8F', 6),
(232, '802F', 'Apartamento 802F', '8F', 6),
(233, '803F', 'Apartamento 803F', '8F', 6),
(234, '804F', 'Apartamento 804F', '8F', 6),
(235, '901F', 'Apartamento 901F', '9F', 6),
(236, '902F', 'Apartamento 902F', '9F', 6),
(237, '903F', 'Apartamento 903F', '9F', 6),
(238, '904F', 'Apartamento 904F', '9F', 6),
(239, '1001F', 'Apartamento 1001F', '10F', 6),
(240, '1002F', 'Apartamento 1002F', '10F', 6),
(241, '1003F', 'Apartamento 1003F', '10F', 6),
(242, '1004F', 'Apartamento 1004F', '10F', 6),
(243, '101G', 'Apartamento 101G', '1G', 7),
(244, '102G', 'Apartamento 102G', '1G', 7),
(245, '103G', 'Apartamento 103G', '1G', 7),
(246, '104G', 'Apartamento 104G', '1G', 7),
(247, '201G', 'Apartamento 201G', '2G', 7),
(248, '202G', 'Apartamento 202G', '2G', 7),
(249, '203G', 'Apartamento 203G', '2G', 7),
(250, '204G', 'Apartamento 204G', '2G', 7),
(251, '301G', 'Apartamento 301G', '3G', 7),
(252, '302G', 'Apartamento 302G', '3G', 7),
(253, '303G', 'Apartamento 303G', '3G', 7),
(254, '304G', 'Apartamento 304G', '3G', 7),
(255, '401G', 'Apartamento 401G', '4G', 7),
(256, '402G', 'Apartamento 402G', '4G', 7),
(257, '403G', 'Apartamento 403G', '4G', 7),
(258, '404G', 'Apartamento 404G', '4G', 7),
(259, '501G', 'Apartamento 501G', '5G', 7),
(260, '502G', 'Apartamento 502G', '5G', 7),
(261, '503G', 'Apartamento 503G', '5G', 7),
(262, '504G', 'Apartamento 504G', '5G', 7),
(263, '601G', 'Apartamento 601G', '6G', 7),
(264, '602G', 'Apartamento 602G', '6G', 7),
(265, '603G', 'Apartamento 603G', '6G', 7),
(266, '604G', 'Apartamento 604G', '6G', 7),
(267, '701G', 'Apartamento 701G', '7G', 7),
(268, '702G', 'Apartamento 702G', '7G', 7),
(269, '703G', 'Apartamento 703G', '7G', 7),
(270, '704G', 'Apartamento 704G', '7G', 7),
(271, '801G', 'Apartamento 801G', '8G', 7),
(272, '802G', 'Apartamento 802G', '8G', 7),
(273, '803G', 'Apartamento 803G', '8G', 7),
(274, '804G', 'Apartamento 804G', '8G', 7),
(275, '901G', 'Apartamento 901G', '9G', 7),
(276, '902G', 'Apartamento 902G', '9G', 7),
(277, '903G', 'Apartamento 903G', '9G', 7),
(278, '904G', 'Apartamento 904G', '9G', 7),
(279, '1001G', 'Apartamento 1001G', '10G', 7),
(280, '1002G', 'Apartamento 1002G', '10G', 7),
(281, '1003G', 'Apartamento 1003G', '10G', 7),
(282, '1004G', 'Apartamento 1004G', '10G', 7),
(283, '101H', 'Apartamento 101H', '1H', 8),
(284, '102H', 'Apartamento 102H', '1H', 8),
(285, '103H', 'Apartamento 103H', '1H', 8),
(286, '104H', 'Apartamento 104H', '1H', 8),
(287, '201H', 'Apartamento 201H', '2H', 8),
(288, '202H', 'Apartamento 202H', '2H', 8),
(289, '203H', 'Apartamento 203H', '2H', 8),
(290, '204H', 'Apartamento 204H', '2H', 8),
(291, '301H', 'Apartamento 301H', '3H', 8),
(292, '302H', 'Apartamento 302H', '3H', 8),
(293, '303H', 'Apartamento 303H', '3H', 8),
(294, '304H', 'Apartamento 304H', '3H', 8),
(295, '401H', 'Apartamento 401H', '4H', 8),
(296, '402H', 'Apartamento 402H', '4H', 8),
(297, '403H', 'Apartamento 403H', '4H', 8),
(298, '404H', 'Apartamento 404H', '4H', 8),
(299, '501H', 'Apartamento 501H', '5H', 8),
(300, '502H', 'Apartamento 502H', '5H', 8),
(301, '503H', 'Apartamento 503H', '5H', 8),
(302, '504H', 'Apartamento 504H', '5H', 8),
(303, '601H', 'Apartamento 601H', '6H', 8),
(304, '602H', 'Apartamento 602H', '6H', 8),
(305, '603H', 'Apartamento 603H', '6H', 8),
(306, '604H', 'Apartamento 604H', '6H', 8),
(307, '701H', 'Apartamento 701H', '7H', 8),
(308, '702H', 'Apartamento 702H', '7H', 8),
(309, '703H', 'Apartamento 703H', '7H', 8),
(310, '704H', 'Apartamento 704H', '7H', 8),
(311, '801H', 'Apartamento 801H', '8H', 8),
(312, '802H', 'Apartamento 802H', '8H', 8),
(313, '803H', 'Apartamento 803H', '8H', 8),
(314, '804H', 'Apartamento 804H', '8H', 8),
(315, '901H', 'Apartamento 901H', '9H', 8),
(316, '902H', 'Apartamento 902H', '9H', 8),
(317, '903H', 'Apartamento 903H', '9H', 8),
(318, '904H', 'Apartamento 904H', '9H', 8),
(319, '1001H', 'Apartamento 1001H', '10H', 8),
(320, '1002H', 'Apartamento 1002H', '10H', 8),
(321, '1003H', 'Apartamento 1003H', '10H', 8),
(322, '1004H', 'Apartamento 1004H', '10H', 8),
(323, '101I', 'Apartamento 101I', '1I', 9),
(324, '102I', 'Apartamento 102I', '1I', 9),
(325, '103I', 'Apartamento 103I', '1I', 9),
(326, '104I', 'Apartamento 104I', '1I', 9),
(327, '201I', 'Apartamento 201I', '2I', 9),
(328, '202I', 'Apartamento 202I', '2I', 9),
(329, '203I', 'Apartamento 203I', '2I', 9),
(330, '204I', 'Apartamento 204I', '2I', 9),
(331, '301I', 'Apartamento 301I', '3I', 9),
(332, '302I', 'Apartamento 302I', '3I', 9),
(333, '303I', 'Apartamento 303I', '3I', 9),
(334, '304I', 'Apartamento 304I', '3I', 9),
(335, '401I', 'Apartamento 401I', '4I', 9),
(336, '402I', 'Apartamento 402I', '4I', 9),
(337, '403I', 'Apartamento 403I', '4I', 9),
(338, '404I', 'Apartamento 404I', '4I', 9),
(339, '501I', 'Apartamento 501I', '5I', 9),
(340, '502I', 'Apartamento 502I', '5I', 9),
(341, '503I', 'Apartamento 503I', '5I', 9),
(342, '504I', 'Apartamento 504I', '5I', 9),
(343, '601I', 'Apartamento 601I', '6I', 9),
(344, '602I', 'Apartamento 602I', '6I', 9),
(345, '603I', 'Apartamento 603I', '6I', 9),
(346, '604I', 'Apartamento 604I', '6I', 9),
(347, '701I', 'Apartamento 701I', '7I', 9),
(348, '702I', 'Apartamento 702I', '7I', 9),
(349, '703I', 'Apartamento 703I', '7I', 9),
(350, '704I', 'Apartamento 704I', '7I', 9),
(351, '801I', 'Apartamento 801I', '8I', 9),
(352, '802I', 'Apartamento 802I', '8I', 9),
(353, '803I', 'Apartamento 803I', '8I', 9),
(354, '804I', 'Apartamento 804I', '8I', 9),
(355, '901I', 'Apartamento 901I', '9I', 9),
(356, '902I', 'Apartamento 902I', '9I', 9),
(357, '903I', 'Apartamento 903I', '9I', 9),
(358, '904I', 'Apartamento 904I', '9I', 9),
(359, '1001I', 'Apartamento 1001I', '10I', 9),
(360, '1002I', 'Apartamento 1002I', '10I', 9),
(361, '1003I', 'Apartamento 1003I', '10I', 9),
(362, '1004I', 'Apartamento 1004I', '10I', 9),
(363, '101J', 'Apartamento 101J', '1J', 10),
(364, '102J', 'Apartamento 102J', '1J', 10),
(365, '103J', 'Apartamento 103J', '1J', 10),
(366, '104J', 'Apartamento 104J', '1J', 10),
(367, '201J', 'Apartamento 201J', '2J', 10),
(368, '202J', 'Apartamento 202J', '2J', 10),
(369, '203J', 'Apartamento 203J', '2J', 10),
(370, '204J', 'Apartamento 204J', '2J', 10),
(371, '301J', 'Apartamento 301J', '3J', 10),
(372, '302J', 'Apartamento 302J', '3J', 10),
(373, '303J', 'Apartamento 303J', '3J', 10),
(374, '304J', 'Apartamento 304J', '3J', 10),
(375, '401J', 'Apartamento 401J', '4J', 10),
(376, '402J', 'Apartamento 402J', '4J', 10),
(377, '403J', 'Apartamento 403J', '4J', 10),
(378, '404J', 'Apartamento 404J', '4J', 10),
(379, '501J', 'Apartamento 501J', '5J', 10),
(380, '502J', 'Apartamento 502J', '5J', 10),
(381, '503J', 'Apartamento 503J', '5J', 10),
(382, '504J', 'Apartamento 504J', '5J', 10),
(383, '601J', 'Apartamento 601J', '6J', 10),
(384, '602J', 'Apartamento 602J', '6J', 10),
(385, '603J', 'Apartamento 603J', '6J', 10),
(386, '604J', 'Apartamento 604J', '6J', 10),
(387, '701J', 'Apartamento 701J', '7J', 10),
(388, '702J', 'Apartamento 702J', '7J', 10),
(389, '703J', 'Apartamento 703J', '7J', 10),
(390, '704J', 'Apartamento 704J', '7J', 10),
(391, '801J', 'Apartamento 801J', '8J', 10),
(392, '802J', 'Apartamento 802J', '8J', 10),
(393, '803J', 'Apartamento 803J', '8J', 10),
(394, '804J', 'Apartamento 804J', '8J', 10),
(395, '901J', 'Apartamento 901J', '9J', 10),
(396, '902J', 'Apartamento 902J', '9J', 10),
(397, '903J', 'Apartamento 903J', '9J', 10),
(398, '904J', 'Apartamento 904J', '9J', 10),
(399, '1001J', 'Apartamento 1001J', '10J', 10),
(400, '1002J', 'Apartamento 1002J', '10J', 10),
(401, '1003J', 'Apartamento 1003J', '10J', 10),
(402, '1004J', 'Apartamento 1004J', '10J', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `idcita` int(11) NOT NULL,
  `fechacita` date NOT NULL,
  `horacita` time NOT NULL,
  `tipocita` varchar(45) NOT NULL,
  `apa` int(11) NOT NULL,
  `respuesta` varchar(100) NOT NULL,
  `estado` enum('pendiente','respondida','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactarnos`
--

CREATE TABLE `contactarnos` (
  `idcontactarnos` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `comentario` text DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `directorio_servicios`
--

CREATE TABLE `directorio_servicios` (
  `id_contacto` int(11) NOT NULL,
  `nombre_contacto` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `tipo_servicio` enum('Seguridad','Emergencia','Gas','Electricidad','Agua','Salud','Administración','Otros') NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingreso_peatonal`
--

CREATE TABLE `ingreso_peatonal` (
  `idIngreso_Peatonal` int(11) NOT NULL,
  `personasIngreso` varchar(45) NOT NULL,
  `horaFecha` datetime NOT NULL,
  `documento` varchar(2009) NOT NULL,
  `tipo_ingreso` enum('vehiculo','visitante') NOT NULL,
  `placa` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `idPagos` int(11) NOT NULL,
  `pagoPor` varchar(100) NOT NULL,
  `cantidad` decimal(10,2) NOT NULL,
  `mediopago` enum('Efectivo','Transferencia','Tarjeta','Cheque','Otro') NOT NULL,
  `apart` int(11) NOT NULL,
  `fechaPago` date NOT NULL,
  `estado` enum('Pendiente','Pagado','Vencido') NOT NULL DEFAULT 'Pendiente',
  `referenciaPago` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parqueadero`
--

CREATE TABLE `parqueadero` (
  `id_parqueadero` int(11) NOT NULL,
  `numero_parqueadero` int(11) NOT NULL,
  `id_apartamento` int(11) NOT NULL,
  `uso` datetime NOT NULL,
  `disponibilidad` varchar(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

CREATE TABLE `registro` (
  `id_Registro` int(11) NOT NULL,
  `idRol` int(20) NOT NULL,
  `PrimerNombre` varchar(45) NOT NULL,
  `SegundoNombre` varchar(45) DEFAULT NULL,
  `PrimerApellido` varchar(45) NOT NULL,
  `SegundoApellido` varchar(45) DEFAULT NULL,
  `apartamento` int(11) NOT NULL,
  `Correo` varchar(45) NOT NULL,
  `Usuario` varchar(45) NOT NULL,
  `Clave` varchar(45) NOT NULL,
  `Id_tipoDocumento` int(11) NOT NULL,
  `numeroDocumento` int(11) NOT NULL,
  `telefonoUno` int(11) NOT NULL,
  `telefonoDos` int(11) DEFAULT NULL,
  `imagenPerfil` varchar(300) DEFAULT NULL,
  `tipo_propietario` enum('dueño','residente','ambos') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `Roldescripcion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `Roldescripcion`) VALUES
(1, 'admin'),
(2222, 'Guarda de Seguridad'),
(3333, 'residente'),
(4444, 'Dueño');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_parqueadero`
--

CREATE TABLE `solicitud_parqueadero` (
  `id_solicitud` int(11) NOT NULL,
  `id_apartamento` int(11) NOT NULL,
  `parqueadero_visitante` enum('V1','V2','V3','V4','V5') NOT NULL,
  `nombre_visitante` varchar(100) NOT NULL,
  `placaVehiculo` varchar(45) NOT NULL,
  `colorVehiculo` varchar(45) NOT NULL,
  `tipoVehiculo` varchar(100) NOT NULL,
  `modelo` varchar(90) NOT NULL,
  `marca` varchar(100) NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_final` datetime NOT NULL,
  `estado` enum('pendiente','aprobado','rechazado') NOT NULL DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_zona`
--

CREATE TABLE `solicitud_zona` (
  `ID_Apartamentooss` int(100) NOT NULL,
  `ID_zonaComun` int(100) NOT NULL,
  `fechainicio` date NOT NULL,
  `fechafinal` date NOT NULL,
  `Hora_inicio` time NOT NULL,
  `Hora_final` time NOT NULL,
  `estado` enum('ACEPTADA','PENDIENTE','RECHAZADA') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipodoc`
--

CREATE TABLE `tipodoc` (
  `idtDoc` int(11) NOT NULL,
  `descripcionDoc` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipodoc`
--

INSERT INTO `tipodoc` (`idtDoc`, `descripcionDoc`) VALUES
(1, 'Cedula de Ciudadanía'),
(2, 'Cédula de ciudadanía digital'),
(4, 'Cédulas de Extranjería');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tokens`
--

CREATE TABLE `tokens` (
  `id_token` int(11) NOT NULL,
  `id_Registro` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_expiracion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zona_comun`
--

CREATE TABLE `zona_comun` (
  `idZona` int(11) NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  `costo_alquiler` int(222) NOT NULL,
  `url_videos` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `anuncio`
--
ALTER TABLE `anuncio`
  ADD PRIMARY KEY (`idAnuncio`),
  ADD KEY `fk_anuncio_persona` (`persona`);

--
-- Indices de la tabla `apartamento`
--
ALTER TABLE `apartamento`
  ADD PRIMARY KEY (`id_Apartamento`);

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`idcita`),
  ADD KEY `fk_cita_apartamento` (`apa`);

--
-- Indices de la tabla `contactarnos`
--
ALTER TABLE `contactarnos`
  ADD PRIMARY KEY (`idcontactarnos`);

--
-- Indices de la tabla `directorio_servicios`
--
ALTER TABLE `directorio_servicios`
  ADD PRIMARY KEY (`id_contacto`);

--
-- Indices de la tabla `ingreso_peatonal`
--
ALTER TABLE `ingreso_peatonal`
  ADD PRIMARY KEY (`idIngreso_Peatonal`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`idPagos`);

--
-- Indices de la tabla `parqueadero`
--
ALTER TABLE `parqueadero`
  ADD PRIMARY KEY (`id_parqueadero`),
  ADD KEY `id_apartamento` (`id_apartamento`);

--
-- Indices de la tabla `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`id_Registro`),
  ADD KEY `fk_registro_apartamento` (`apartamento`),
  ADD KEY `fk_registro_rol` (`idRol`),
  ADD KEY `fk_registro_tipodoc` (`Id_tipoDocumento`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `solicitud_parqueadero`
--
ALTER TABLE `solicitud_parqueadero`
  ADD PRIMARY KEY (`id_solicitud`),
  ADD KEY `id_apartamento` (`id_apartamento`);

--
-- Indices de la tabla `solicitud_zona`
--
ALTER TABLE `solicitud_zona`
  ADD KEY `fkidZona` (`ID_zonaComun`),
  ADD KEY `fkid_Apartamento5` (`ID_Apartamentooss`);

--
-- Indices de la tabla `tipodoc`
--
ALTER TABLE `tipodoc`
  ADD PRIMARY KEY (`idtDoc`);

--
-- Indices de la tabla `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id_token`),
  ADD KEY `id_Registro` (`id_Registro`);

--
-- Indices de la tabla `zona_comun`
--
ALTER TABLE `zona_comun`
  ADD PRIMARY KEY (`idZona`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `anuncio`
--
ALTER TABLE `anuncio`
  MODIFY `idAnuncio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `apartamento`
--
ALTER TABLE `apartamento`
  MODIFY `id_Apartamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=403;

--
-- AUTO_INCREMENT de la tabla `cita`
--
ALTER TABLE `cita`
  MODIFY `idcita` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contactarnos`
--
ALTER TABLE `contactarnos`
  MODIFY `idcontactarnos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `directorio_servicios`
--
ALTER TABLE `directorio_servicios`
  MODIFY `id_contacto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ingreso_peatonal`
--
ALTER TABLE `ingreso_peatonal`
  MODIFY `idIngreso_Peatonal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `idPagos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `parqueadero`
--
ALTER TABLE `parqueadero`
  MODIFY `id_parqueadero` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `registro`
--
ALTER TABLE `registro`
  MODIFY `id_Registro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4446;

--
-- AUTO_INCREMENT de la tabla `solicitud_parqueadero`
--
ALTER TABLE `solicitud_parqueadero`
  MODIFY `id_solicitud` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id_token` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `anuncio`
--
ALTER TABLE `anuncio`
  ADD CONSTRAINT `fk_anuncio_persona` FOREIGN KEY (`persona`) REFERENCES `registro` (`id_Registro`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `fk_cita_apartamento` FOREIGN KEY (`apa`) REFERENCES `apartamento` (`id_Apartamento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `parqueadero`
--
ALTER TABLE `parqueadero`
  ADD CONSTRAINT `parqueadero_ibfk_1` FOREIGN KEY (`id_apartamento`) REFERENCES `apartamento` (`id_Apartamento`) ON DELETE CASCADE;

--
-- Filtros para la tabla `registro`
--
ALTER TABLE `registro`
  ADD CONSTRAINT `fk_registro_apartamento` FOREIGN KEY (`apartamento`) REFERENCES `apartamento` (`id_Apartamento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_registro_rol` FOREIGN KEY (`idRol`) REFERENCES `rol` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_registro_tipodoc` FOREIGN KEY (`Id_tipoDocumento`) REFERENCES `tipodoc` (`idtDoc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `solicitud_parqueadero`
--
ALTER TABLE `solicitud_parqueadero`
  ADD CONSTRAINT `solicitud_parqueadero_ibfk_1` FOREIGN KEY (`id_apartamento`) REFERENCES `apartamento` (`id_Apartamento`) ON DELETE CASCADE;

--
-- Filtros para la tabla `solicitud_zona`
--
ALTER TABLE `solicitud_zona`
  ADD CONSTRAINT `fk` FOREIGN KEY (`ID_zonaComun`) REFERENCES `zona_comun` (`idZona`),
  ADD CONSTRAINT `fkidZona` FOREIGN KEY (`ID_zonaComun`) REFERENCES `zona_comun` (`idZona`),
  ADD CONSTRAINT `fkid_Apartamento5` FOREIGN KEY (`ID_Apartamentooss`) REFERENCES `apartamento` (`id_Apartamento`);

--
-- Filtros para la tabla `tokens`
--
ALTER TABLE `tokens`
  ADD CONSTRAINT `tokens_ibfk_1` FOREIGN KEY (`id_Registro`) REFERENCES `registro` (`id_Registro`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
