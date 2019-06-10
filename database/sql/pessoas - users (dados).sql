-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 07-Jun-2019 às 20:23
-- Versão do servidor: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET FOREIGN_KEY_CHECKS=0;
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
-- Extraindo dados da tabela `pessoas`
--

INSERT INTO `pessoas` (`id`, `nome`, `email`, `dtanascimento`, `logradouro_tipo`, `logradouro`, `logradouro_numero`, `logradouro_bairro`, `telefone`, `ativo`) VALUES
(1, 'admin', 'admin@admin.com', NULL, NULL, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--


--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `pessoa_id`, `password`, `papel`, `email_verified_at`, `remember_token`, `ativo`) VALUES
(1, 1, '$2y$10$Cv6rmMV8CKUXlSO5lRNewO0BownaR0y5nzAE4hefo85ZMN2IknDRy', 'ADM', NULL, 'G1dC3AO07KX4lwDhcElJr7AWoCCObsKX4UZdG2svv0Kfr25lppw2FKtZSff3', '1');

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
