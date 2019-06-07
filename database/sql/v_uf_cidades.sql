-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 07-Jun-2019 às 20:15
-- Versão do servidor: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `larafy`
--

-- --------------------------------------------------------

--
-- Structure for view `v_uf_cidades`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`larafy`@`127.0.0.1` SQL SECURITY DEFINER VIEW `v_uf_cidades`  AS  select `a`.`cod` AS `uf_cod`,`a`.`uf` AS `uf`,`a`.`nome` AS `uf_nome`,`b`.`cod` AS `cidade_cod`,`b`.`codcomdv` AS `cidadecodcomdv`,`b`.`nome` AS `cidade_nome` from (`uf` `a` join `cidades` `b` on((`b`.`cod_uf` = `a`.`cod`))) ;

--
-- VIEW  `v_uf_cidades`
-- Data: Nenhum
--

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
