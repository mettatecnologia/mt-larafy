-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 28-Jun-2019 às 14:42
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

--
-- Extraindo dados da tabela `pessoas`
--

INSERT INTO `pessoas` (`id`, `nome`, `email`, `papel`, `dtanascimento`, `logradouro_tipo`, `logradouro`, `logradouro_numero`, `bairro`, `telefone`, `ativo`) VALUES
(1, 'database', 'database@ficticio.com', 'SYS', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(2, 'app', 'app@ficticio.com', 'SYS', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(3, 'joabe', 'joabemachadodeabreu@gmail.com', 'ADM', NULL, NULL, NULL, NULL, NULL, NULL, 1);

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `pessoa_id`, `password`, `email_verified_at`, `remember_token`, `ativo`) VALUES
(1, 1, ' ', NULL, NULL, 1),
(2, 2, ' ', NULL, NULL, 1),
(3, 3, '$2y$10$Cv6rmMV8CKUXlSO5lRNewO0BownaR0y5nzAE4hefo85ZMN2IknDRy', NULL, NULL, 1);
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
