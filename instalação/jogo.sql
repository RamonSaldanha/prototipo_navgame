-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 08-Set-2014 às 14:58
-- Versão do servidor: 5.5.36
-- PHP Version: 5.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jogo`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aldeia`
--

CREATE TABLE IF NOT EXISTS `aldeia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ult_att` int(250) NOT NULL,
  `armazem` varchar(250) NOT NULL,
  `producao` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `aldeia`
--

INSERT INTO `aldeia` (`id`, `ult_att`, `armazem`, `producao`) VALUES
(1, 1408367529, '480.80555555556', 50),
(2, 1408367529, '9356.805555555547', 1000);

-- --------------------------------------------------------

--
-- Estrutura da tabela `edificios`
--

CREATE TABLE IF NOT EXISTS `edificios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aldeia` int(10) NOT NULL,
  `t1` int(5) NOT NULL,
  `t2` int(5) NOT NULL,
  `t3` int(5) NOT NULL,
  `t4` int(5) NOT NULL,
  `t5` int(5) NOT NULL,
  `t6` int(5) NOT NULL,
  `t7` int(5) NOT NULL,
  `t8` int(5) NOT NULL,
  `t9` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `edificios`
--

INSERT INTO `edificios` (`id`, `aldeia`, `t1`, `t2`, `t3`, `t4`, `t5`, `t6`, `t7`, `t8`, `t9`) VALUES
(1, 1, 1, 0, 0, 0, 0, 0, 0, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `mapa`
--

CREATE TABLE IF NOT EXISTS `mapa` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `x` varchar(5) DEFAULT NULL,
  `y` varchar(5) DEFAULT NULL,
  `tip` varchar(1) DEFAULT NULL,
  `subtip` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 MAX_ROWS=1000000000 AUTO_INCREMENT=442 ;

--
-- Extraindo dados da tabela `mapa`
--

INSERT INTO `mapa` (`id`, `x`, `y`, `tip`, `subtip`) VALUES
(1, '0', '0', '2', '2'),
(2, '0', '1', '1', '1'),
(3, '0', '2', '1', '1'),
(4, '0', '3', '3', '3'),
(5, '0', '4', '1', '1'),
(6, '0', '5', '3', '3'),
(7, '0', '6', '2', '2'),
(8, '0', '7', '2', '2'),
(9, '0', '8', '2', '2'),
(10, '0', '9', '3', '3'),
(11, '0', '10', '1', '1'),
(12, '0', '11', '3', '3'),
(13, '0', '12', '2', '2'),
(14, '0', '13', '1', '1'),
(15, '0', '14', '1', '1'),
(16, '0', '15', '2', '2'),
(17, '0', '16', '3', '3'),
(18, '0', '17', '2', '2'),
(19, '0', '18', '1', '1'),
(20, '0', '19', '1', '1'),
(21, '0', '20', '1', '1'),
(22, '1', '0', '3', '3'),
(23, '1', '1', '3', '3'),
(24, '1', '2', '1', '1'),
(25, '1', '3', '1', '1'),
(26, '1', '4', '1', '1'),
(27, '1', '5', '1', '1'),
(28, '1', '6', '2', '2'),
(29, '1', '7', '3', '3'),
(30, '1', '8', '2', '2'),
(31, '1', '9', '1', '1'),
(32, '1', '10', '3', '3'),
(33, '1', '11', '2', '2'),
(34, '1', '12', '1', '1'),
(35, '1', '13', '1', '1'),
(36, '1', '14', '1', '1'),
(37, '1', '15', '1', '1'),
(38, '1', '16', '2', '2'),
(39, '1', '17', '3', '3'),
(40, '1', '18', '2', '2'),
(41, '1', '19', '2', '2'),
(42, '1', '20', '1', '1'),
(43, '2', '0', '1', '1'),
(44, '2', '1', '1', '1'),
(45, '2', '2', '3', '3'),
(46, '2', '3', '3', '3'),
(47, '2', '4', '1', '1'),
(48, '2', '5', '1', '1'),
(49, '2', '6', '3', '3'),
(50, '2', '7', '2', '2'),
(51, '2', '8', '2', '2'),
(52, '2', '9', '3', '3'),
(53, '2', '10', '1', '1'),
(54, '2', '11', '2', '2'),
(55, '2', '12', '2', '2'),
(56, '2', '13', '3', '3'),
(57, '2', '14', '1', '1'),
(58, '2', '15', '2', '2'),
(59, '2', '16', '1', '1'),
(60, '2', '17', '3', '3'),
(61, '2', '18', '1', '1'),
(62, '2', '19', '2', '2'),
(63, '2', '20', '2', '2'),
(64, '3', '0', '1', '1'),
(65, '3', '1', '1', '1'),
(66, '3', '2', '1', '1'),
(67, '3', '3', '1', '1'),
(68, '3', '4', '2', '2'),
(69, '3', '5', '1', '1'),
(70, '3', '6', '2', '2'),
(71, '3', '7', '1', '1'),
(72, '3', '8', '3', '3'),
(73, '3', '9', '1', '1'),
(74, '3', '10', '1', '1'),
(75, '3', '11', '2', '2'),
(76, '3', '12', '1', '1'),
(77, '3', '13', '2', '2'),
(78, '3', '14', '3', '3'),
(79, '3', '15', '2', '2'),
(80, '3', '16', '2', '2'),
(81, '3', '17', '2', '2'),
(82, '3', '18', '3', '3'),
(83, '3', '19', '3', '3'),
(84, '3', '20', '3', '3'),
(85, '4', '0', '3', '3'),
(86, '4', '1', '3', '3'),
(87, '4', '2', '2', '2'),
(88, '4', '3', '3', '3'),
(89, '4', '4', '3', '3'),
(90, '4', '5', '2', '2'),
(91, '4', '6', '1', '1'),
(92, '4', '7', '1', '1'),
(93, '4', '8', '2', '2'),
(94, '4', '9', '3', '3'),
(95, '4', '10', '2', '2'),
(96, '4', '11', '3', '3'),
(97, '4', '12', '3', '3'),
(98, '4', '13', '2', '2'),
(99, '4', '14', '3', '3'),
(100, '4', '15', '2', '2'),
(101, '4', '16', '3', '3'),
(102, '4', '17', '3', '3'),
(103, '4', '18', '2', '2'),
(104, '4', '19', '1', '1'),
(105, '4', '20', '3', '3'),
(106, '5', '0', '1', '1'),
(107, '5', '1', '1', '1'),
(108, '5', '2', '1', '1'),
(109, '5', '3', '2', '2'),
(110, '5', '4', '2', '2'),
(111, '5', '5', '1', '1'),
(112, '5', '6', '3', '3'),
(113, '5', '7', '1', '1'),
(114, '5', '8', '2', '2'),
(115, '5', '9', '1', '1'),
(116, '5', '10', '2', '2'),
(117, '5', '11', '2', '2'),
(118, '5', '12', '2', '2'),
(119, '5', '13', '1', '1'),
(120, '5', '14', '1', '1'),
(121, '5', '15', '2', '2'),
(122, '5', '16', '3', '3'),
(123, '5', '17', '1', '1'),
(124, '5', '18', '1', '1'),
(125, '5', '19', '3', '3'),
(126, '5', '20', '2', '2'),
(127, '6', '0', '2', '2'),
(128, '6', '1', '1', '1'),
(129, '6', '2', '2', '2'),
(130, '6', '3', '2', '2'),
(131, '6', '4', '2', '2'),
(132, '6', '5', '2', '2'),
(133, '6', '6', '2', '2'),
(134, '6', '7', '2', '2'),
(135, '6', '8', '2', '2'),
(136, '6', '9', '2', '2'),
(137, '6', '10', '2', '2'),
(138, '6', '11', '2', '2'),
(139, '6', '12', '2', '2'),
(140, '6', '13', '3', '3'),
(141, '6', '14', '3', '3'),
(142, '6', '15', '1', '1'),
(143, '6', '16', '2', '2'),
(144, '6', '17', '3', '3'),
(145, '6', '18', '2', '2'),
(146, '6', '19', '2', '2'),
(147, '6', '20', '1', '1'),
(148, '7', '0', '2', '2'),
(149, '7', '1', '1', '1'),
(150, '7', '2', '2', '2'),
(151, '7', '3', '3', '3'),
(152, '7', '4', '3', '3'),
(153, '7', '5', '3', '3'),
(154, '7', '6', '2', '2'),
(155, '7', '7', '1', '1'),
(156, '7', '8', '1', '1'),
(157, '7', '9', '3', '3'),
(158, '7', '10', '2', '2'),
(159, '7', '11', '1', '1'),
(160, '7', '12', '2', '2'),
(161, '7', '13', '3', '3'),
(162, '7', '14', '3', '3'),
(163, '7', '15', '3', '3'),
(164, '7', '16', '1', '1'),
(165, '7', '17', '3', '3'),
(166, '7', '18', '3', '3'),
(167, '7', '19', '2', '2'),
(168, '7', '20', '3', '3'),
(169, '8', '0', '3', '3'),
(170, '8', '1', '2', '2'),
(171, '8', '2', '3', '3'),
(172, '8', '3', '3', '3'),
(173, '8', '4', '3', '3'),
(174, '8', '5', '2', '2'),
(175, '8', '6', '2', '2'),
(176, '8', '7', '3', '3'),
(177, '8', '8', '3', '3'),
(178, '8', '9', '3', '3'),
(179, '8', '10', '1', '1'),
(180, '8', '11', '3', '3'),
(181, '8', '12', '3', '3'),
(182, '8', '13', '3', '3'),
(183, '8', '14', '1', '1'),
(184, '8', '15', '3', '3'),
(185, '8', '16', '1', '1'),
(186, '8', '17', '2', '2'),
(187, '8', '18', '3', '3'),
(188, '8', '19', '3', '3'),
(189, '8', '20', '3', '3'),
(190, '9', '0', '1', '1'),
(191, '9', '1', '3', '3'),
(192, '9', '2', '2', '2'),
(193, '9', '3', '1', '1'),
(194, '9', '4', '2', '2'),
(195, '9', '5', '2', '2'),
(196, '9', '6', '1', '1'),
(197, '9', '7', '2', '2'),
(198, '9', '8', '1', '1'),
(199, '9', '9', '2', '2'),
(200, '9', '10', '2', '2'),
(201, '9', '11', '1', '1'),
(202, '9', '12', '2', '2'),
(203, '9', '13', '3', '3'),
(204, '9', '14', '1', '1'),
(205, '9', '15', '2', '2'),
(206, '9', '16', '1', '1'),
(207, '9', '17', '3', '3'),
(208, '9', '18', '2', '2'),
(209, '9', '19', '1', '1'),
(210, '9', '20', '3', '3'),
(211, '10', '0', '3', '3'),
(212, '10', '1', '2', '2'),
(213, '10', '2', '1', '1'),
(214, '10', '3', '2', '2'),
(215, '10', '4', '2', '2'),
(216, '10', '5', '2', '2'),
(217, '10', '6', '2', '2'),
(218, '10', '7', '3', '3'),
(219, '10', '8', '1', '1'),
(220, '10', '9', '3', '3'),
(221, '10', '10', '2', '2'),
(222, '10', '11', '3', '3'),
(223, '10', '12', '2', '2'),
(224, '10', '13', '3', '3'),
(225, '10', '14', '2', '2'),
(226, '10', '15', '1', '1'),
(227, '10', '16', '2', '2'),
(228, '10', '17', '2', '2'),
(229, '10', '18', '3', '3'),
(230, '10', '19', '1', '1'),
(231, '10', '20', '1', '1'),
(232, '11', '0', '2', '2'),
(233, '11', '1', '1', '1'),
(234, '11', '2', '1', '1'),
(235, '11', '3', '3', '3'),
(236, '11', '4', '3', '3'),
(237, '11', '5', '2', '2'),
(238, '11', '6', '1', '1'),
(239, '11', '7', '3', '3'),
(240, '11', '8', '2', '2'),
(241, '11', '9', '1', '1'),
(242, '11', '10', '3', '3'),
(243, '11', '11', '2', '2'),
(244, '11', '12', '2', '2'),
(245, '11', '13', '1', '1'),
(246, '11', '14', '2', '2'),
(247, '11', '15', '2', '2'),
(248, '11', '16', '1', '1'),
(249, '11', '17', '2', '2'),
(250, '11', '18', '2', '2'),
(251, '11', '19', '2', '2'),
(252, '11', '20', '1', '1'),
(253, '12', '0', '1', '1'),
(254, '12', '1', '1', '1'),
(255, '12', '2', '3', '3'),
(256, '12', '3', '2', '2'),
(257, '12', '4', '2', '2'),
(258, '12', '5', '3', '3'),
(259, '12', '6', '3', '3'),
(260, '12', '7', '1', '1'),
(261, '12', '8', '3', '3'),
(262, '12', '9', '2', '2'),
(263, '12', '10', '3', '3'),
(264, '12', '11', '1', '1'),
(265, '12', '12', '1', '1'),
(266, '12', '13', '1', '1'),
(267, '12', '14', '3', '3'),
(268, '12', '15', '3', '3'),
(269, '12', '16', '3', '3'),
(270, '12', '17', '2', '2'),
(271, '12', '18', '2', '2'),
(272, '12', '19', '3', '3'),
(273, '12', '20', '1', '1'),
(274, '13', '0', '2', '2'),
(275, '13', '1', '1', '1'),
(276, '13', '2', '3', '3'),
(277, '13', '3', '2', '2'),
(278, '13', '4', '1', '1'),
(279, '13', '5', '3', '3'),
(280, '13', '6', '2', '2'),
(281, '13', '7', '2', '2'),
(282, '13', '8', '3', '3'),
(283, '13', '9', '3', '3'),
(284, '13', '10', '1', '1'),
(285, '13', '11', '3', '3'),
(286, '13', '12', '2', '2'),
(287, '13', '13', '1', '1'),
(288, '13', '14', '2', '2'),
(289, '13', '15', '2', '2'),
(290, '13', '16', '2', '2'),
(291, '13', '17', '3', '3'),
(292, '13', '18', '1', '1'),
(293, '13', '19', '3', '3'),
(294, '13', '20', '1', '1'),
(295, '14', '0', '1', '1'),
(296, '14', '1', '1', '1'),
(297, '14', '2', '1', '1'),
(298, '14', '3', '2', '2'),
(299, '14', '4', '2', '2'),
(300, '14', '5', '1', '1'),
(301, '14', '6', '2', '2'),
(302, '14', '7', '1', '1'),
(303, '14', '8', '1', '1'),
(304, '14', '9', '2', '2'),
(305, '14', '10', '1', '1'),
(306, '14', '11', '2', '2'),
(307, '14', '12', '2', '2'),
(308, '14', '13', '2', '2'),
(309, '14', '14', '2', '2'),
(310, '14', '15', '3', '3'),
(311, '14', '16', '2', '2'),
(312, '14', '17', '1', '1'),
(313, '14', '18', '1', '1'),
(314, '14', '19', '1', '1'),
(315, '14', '20', '1', '1'),
(316, '15', '0', '1', '1'),
(317, '15', '1', '1', '1'),
(318, '15', '2', '2', '2'),
(319, '15', '3', '1', '1'),
(320, '15', '4', '1', '1'),
(321, '15', '5', '1', '1'),
(322, '15', '6', '2', '2'),
(323, '15', '7', '3', '3'),
(324, '15', '8', '3', '3'),
(325, '15', '9', '3', '3'),
(326, '15', '10', '1', '1'),
(327, '15', '11', '3', '3'),
(328, '15', '12', '1', '1'),
(329, '15', '13', '3', '3'),
(330, '15', '14', '1', '1'),
(331, '15', '15', '1', '1'),
(332, '15', '16', '1', '1'),
(333, '15', '17', '3', '3'),
(334, '15', '18', '2', '2'),
(335, '15', '19', '3', '3'),
(336, '15', '20', '3', '3'),
(337, '16', '0', '3', '3'),
(338, '16', '1', '3', '3'),
(339, '16', '2', '3', '3'),
(340, '16', '3', '3', '3'),
(341, '16', '4', '1', '1'),
(342, '16', '5', '1', '1'),
(343, '16', '6', '2', '2'),
(344, '16', '7', '3', '3'),
(345, '16', '8', '3', '3'),
(346, '16', '9', '1', '1'),
(347, '16', '10', '1', '1'),
(348, '16', '11', '3', '3'),
(349, '16', '12', '2', '2'),
(350, '16', '13', '3', '3'),
(351, '16', '14', '1', '1'),
(352, '16', '15', '3', '3'),
(353, '16', '16', '3', '3'),
(354, '16', '17', '3', '3'),
(355, '16', '18', '2', '2'),
(356, '16', '19', '2', '2'),
(357, '16', '20', '2', '2'),
(358, '17', '0', '2', '2'),
(359, '17', '1', '3', '3'),
(360, '17', '2', '3', '3'),
(361, '17', '3', '2', '2'),
(362, '17', '4', '1', '1'),
(363, '17', '5', '2', '2'),
(364, '17', '6', '1', '1'),
(365, '17', '7', '1', '1'),
(366, '17', '8', '3', '3'),
(367, '17', '9', '2', '2'),
(368, '17', '10', '1', '1'),
(369, '17', '11', '2', '2'),
(370, '17', '12', '2', '2'),
(371, '17', '13', '1', '1'),
(372, '17', '14', '1', '1'),
(373, '17', '15', '3', '3'),
(374, '17', '16', '2', '2'),
(375, '17', '17', '1', '1'),
(376, '17', '18', '1', '1'),
(377, '17', '19', '2', '2'),
(378, '17', '20', '2', '2'),
(379, '18', '0', '1', '1'),
(380, '18', '1', '2', '2'),
(381, '18', '2', '3', '3'),
(382, '18', '3', '2', '2'),
(383, '18', '4', '1', '1'),
(384, '18', '5', '3', '3'),
(385, '18', '6', '2', '2'),
(386, '18', '7', '3', '3'),
(387, '18', '8', '1', '1'),
(388, '18', '9', '3', '3'),
(389, '18', '10', '1', '1'),
(390, '18', '11', '1', '1'),
(391, '18', '12', '1', '1'),
(392, '18', '13', '3', '3'),
(393, '18', '14', '1', '1'),
(394, '18', '15', '2', '2'),
(395, '18', '16', '3', '3'),
(396, '18', '17', '3', '3'),
(397, '18', '18', '1', '1'),
(398, '18', '19', '3', '3'),
(399, '18', '20', '3', '3'),
(400, '19', '0', '1', '1'),
(401, '19', '1', '3', '3'),
(402, '19', '2', '2', '2'),
(403, '19', '3', '1', '1'),
(404, '19', '4', '1', '1'),
(405, '19', '5', '2', '2'),
(406, '19', '6', '2', '2'),
(407, '19', '7', '3', '3'),
(408, '19', '8', '1', '1'),
(409, '19', '9', '3', '3'),
(410, '19', '10', '3', '3'),
(411, '19', '11', '3', '3'),
(412, '19', '12', '3', '3'),
(413, '19', '13', '3', '3'),
(414, '19', '14', '2', '2'),
(415, '19', '15', '3', '3'),
(416, '19', '16', '2', '2'),
(417, '19', '17', '3', '3'),
(418, '19', '18', '1', '1'),
(419, '19', '19', '2', '2'),
(420, '19', '20', '2', '2'),
(421, '20', '0', '3', '3'),
(422, '20', '1', '2', '2'),
(423, '20', '2', '1', '1'),
(424, '20', '3', '2', '2'),
(425, '20', '4', '2', '2'),
(426, '20', '5', '2', '2'),
(427, '20', '6', '1', '1'),
(428, '20', '7', '3', '3'),
(429, '20', '8', '1', '1'),
(430, '20', '9', '1', '1'),
(431, '20', '10', '3', '3'),
(432, '20', '11', '1', '1'),
(433, '20', '12', '1', '1'),
(434, '20', '13', '3', '3'),
(435, '20', '14', '1', '1'),
(436, '20', '15', '2', '2'),
(437, '20', '16', '1', '1'),
(438, '20', '17', '3', '3'),
(439, '20', '18', '1', '1'),
(440, '20', '19', '1', '1'),
(441, '20', '20', '1', '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `nome` varchar(15) NOT NULL,
  `senha` varchar(20) NOT NULL,
  `ult_att` int(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `senha`, `ult_att`) VALUES
(1, 'ramon', '123456', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
