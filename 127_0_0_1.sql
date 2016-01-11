-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 05-Jan-2016 às 17:31
-- Versão do servidor: 10.1.9-MariaDB-log
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `esof`
--
CREATE DATABASE IF NOT EXISTS `esof` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `esof`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `condutor_veiculo`
--

CREATE TABLE `condutor_veiculo` (
  `id_condutor_veiculo` int(11) NOT NULL,
  `veiculo_id` int(11) NOT NULL,
  `condutor_id` int(11) NOT NULL,
  `active` int(11) DEFAULT '1',
  `created_at` timestamp(6) NULL DEFAULT CURRENT_TIMESTAMP
) ;

--
-- Extraindo dados da tabela `condutor_veiculo`
--

INSERT INTO `condutor_veiculo` (`id_condutor_veiculo`, `veiculo_id`, `condutor_id`, `active`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, '2016-01-05 15:18:16.608309', '2016-01-05 15:18:16.608309'),
(2, 7, 2, 1, '2016-01-05 15:20:58.409056', '2016-01-05 15:20:58.409056'),
(3, 8, 1, 1, '2016-01-05 15:22:06.514198', '2016-01-05 15:22:06.514198');

-- --------------------------------------------------------

--
-- Estrutura da tabela `condutores`
--

CREATE TABLE `condutores` (
  `id_condutor` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `contacto` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `condutores`
--

INSERT INTO `condutores` (`id_condutor`, `nome`, `contacto`) VALUES
(1, 'Rui Filipe Vinha', '933598578'),
(2, '"Rui Filipe Vinha"', '933598578');

-- --------------------------------------------------------

--
-- Estrutura da tabela `localizacoes`
--

CREATE TABLE `localizacoes` (
  `id_localizacao` int(11) NOT NULL,
  `updated_at` timestamp(6) NULL DEFAULT CURRENT_TIMESTAMP
) ;

--
-- Extraindo dados da tabela `localizacoes`
--

INSERT INTO `localizacoes` (`id_localizacao`, `updated_at`, `created_at`, `coordenadas`, `veiculo_id`) VALUES
(1, '2016-01-05 15:40:39.404155', '2016-01-03 01:13:54.216154', '-33.8669710,151.1958750', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `manutencoes`
--

CREATE TABLE `manutencoes` (
  `id_manutencao` int(11) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP
) ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `percursos`
--

CREATE TABLE `percursos` (
  `id_percuso` int(11) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP
) ;

--
-- Extraindo dados da tabela `percursos`
--

INSERT INTO `percursos` (`id_percuso`, `created_at`, `veiculo_id`, `updated_at`, `inicio`, `fim`) VALUES
(1, '2016-01-03 01:13:46.815300', 1, '2016-01-03 01:13:46.815300', '41.1834066,-8.6397608', '41.1795184,-8.650091200000002');

-- --------------------------------------------------------

--
-- Estrutura da tabela `veiculos`
--

CREATE TABLE `veiculos` (
  `id_veiculo` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `capacidade` int(11) DEFAULT NULL,
  `autonomia` bigint(5) DEFAULT NULL,
  `matricula` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `veiculos`
--

INSERT INTO `veiculos` (`id_veiculo`, `estado`, `capacidade`, `autonomia`, `matricula`) VALUES
(1, 1, 5, 900, ''),
(2, 1, 5, 900, '16-68-cl'),
(3, 1, 5, 900, '16-68-cl'),
(4, 1, 5, 900, '16-68-cl'),
(5, 1, 5, 900, '16-68-cl'),
(6, 1, 5, 900, '16-68-cl'),
(7, 1, 5, 900, '16-68-cl'),
(8, 1, 21, 213, '16-68-cl');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `condutores`
--
ALTER TABLE `condutores`
  ADD PRIMARY KEY (`id_condutor`);

--
-- Indexes for table `veiculos`
--
ALTER TABLE `veiculos`
  ADD PRIMARY KEY (`id_veiculo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `condutor_veiculo`
--
ALTER TABLE `condutor_veiculo`
  MODIFY `id_condutor_veiculo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `condutores`
--
ALTER TABLE `condutores`
  MODIFY `id_condutor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `localizacoes`
--
ALTER TABLE `localizacoes`
  MODIFY `id_localizacao` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `manutencoes`
--
ALTER TABLE `manutencoes`
  MODIFY `id_manutencao` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `percursos`
--
ALTER TABLE `percursos`
  MODIFY `id_percuso` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `veiculos`
--
ALTER TABLE `veiculos`
  MODIFY `id_veiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
