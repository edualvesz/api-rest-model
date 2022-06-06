-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06-Jun-2022 às 19:21
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `integra_moodle_tray`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cupom_embaixador`
--

CREATE TABLE `cupom_embaixador` (
  `id_cupom` int(11) NOT NULL,
  `cupom` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `ano_referencia` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cupom_embaixador`
--

INSERT INTO `cupom_embaixador` (`id_cupom`, `cupom`, `email`, `ano_referencia`) VALUES
(5, '2022EMBAIXADOR001', 'fajaki2375@iconzap.com', '2022'),
(6, '2022EMBAIXADOR002', 'teste2@teste2.com', '2022');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cupom_embaixador`
--
ALTER TABLE `cupom_embaixador`
  ADD PRIMARY KEY (`id_cupom`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cupom_embaixador`
--
ALTER TABLE `cupom_embaixador`
  MODIFY `id_cupom` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
