-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 28-Jun-2019 às 14:48
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
-- Structure for view `v_config_valores`
--

CREATE VIEW `v_config_valores`  AS  select `a`.`id` AS `id`,`a`.`nome` AS `nome`,`a`.`nome_interno` AS `nome_interno`,`a`.`descricao` AS `descricao`,`a`.`ativo` AS `ativo`,`b`.`valor` AS `valor` from (`configs` `a` join `config_valores` `b` on((`b`.`config_id` = `a`.`id`))) ;

--
-- VIEW  `v_config_valores`
-- Data: Nenhum
--

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
