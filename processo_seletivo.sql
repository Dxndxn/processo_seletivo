-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24/07/2023 às 12:31
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `processo_seletivo`
--

-- Copiando estrutura do banco de dados
CREATE DATABASE IF NOT EXISTS `processo_seletivo` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `processo_seletivo`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `bairros`
--

CREATE TABLE `bairros` (
  `BAIRRO_ID` int(11) NOT NULL,
  `BAIRRO_NOME` varchar(50) NOT NULL,
  `BAIRRO_ATIVO` tinyint(1) NOT NULL DEFAULT 1,
  `BAIRRO_CADASTRADO_EM` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `bairros`
--

INSERT INTO `bairros` (`BAIRRO_ID`, `BAIRRO_NOME`, `BAIRRO_ATIVO`, `BAIRRO_CADASTRADO_EM`) VALUES
(22, 'Diamante (Barreiro)', 1, '2023-07-24 10:22:12'),
(23, 'Dona Clara', 1, '2023-07-24 10:25:19'),
(24, 'Prado', 1, '2023-07-24 10:27:03'),
(25, 'Castelo', 1, '2023-07-24 10:29:10'),
(26, 'Floresta', 1, '2023-07-24 10:29:54');

-- --------------------------------------------------------

--
-- Estrutura para tabela `bairros_cep`
--

CREATE TABLE `bairros_cep` (
  `BAIRRO_CEP_ID` int(11) NOT NULL,
  `BAIRRO_ID` int(11) NOT NULL,
  `BAIRRO_CLIENTE_ID` int(11) DEFAULT NULL,
  `BAIRRO_CEP_DESC` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `bairros_cep`
--

INSERT INTO `bairros_cep` (`BAIRRO_CEP_ID`, `BAIRRO_ID`, `BAIRRO_CLIENTE_ID`, `BAIRRO_CEP_DESC`) VALUES
(49, 22, 75, '30660240'),
(50, 22, 76, '30660240'),
(51, 22, 77, '30626002'),
(52, 23, 78, '31260310'),
(53, 24, 79, '30110063'),
(54, 24, 80, '30110063'),
(55, 24, 81, '30110067'),
(56, 25, 82, '31330000'),
(57, 26, 83, '30110005'),
(58, 22, 84, '30626002');

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `CLIENTE_ID` int(11) NOT NULL,
  `CLIENTE_NOME` varchar(255) NOT NULL,
  `CLIENTE_CPF` varchar(11) NOT NULL,
  `CLIENTE_CEP` varchar(9) NOT NULL,
  `CLIENTE_ENDERECO` varchar(150) NOT NULL,
  `CLIENTE_NUMERO` int(11) NOT NULL,
  `CLIENTE_BAIRRO` varchar(50) NOT NULL,
  `CLIENTE_CIDADE` varchar(50) NOT NULL,
  `CLIENTE_ESTADO` char(2) NOT NULL,
  `CLIENTE_ATIVO` tinyint(1) NOT NULL DEFAULT 1,
  `CLIENTE_CADASTRADO_EM` timestamp NOT NULL DEFAULT current_timestamp(),
  `CLIENTE_EDITADO_EM` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`CLIENTE_ID`, `CLIENTE_NOME`, `CLIENTE_CPF`, `CLIENTE_CEP`, `CLIENTE_ENDERECO`, `CLIENTE_NUMERO`, `CLIENTE_BAIRRO`, `CLIENTE_CIDADE`, `CLIENTE_ESTADO`, `CLIENTE_ATIVO`, `CLIENTE_CADASTRADO_EM`, `CLIENTE_EDITADO_EM`) VALUES
(75, 'Daniel Felipe Lourenço', '15451162611', '30660240', 'Rua Tinado Luchesi', 35, 'Diamante (Barreiro)', 'Belo Horizonte', 'MG', 1, '2023-07-24 10:22:12', '0000-00-00 00:00:00'),
(76, 'Joshua Miller', '10534230040', '30660240', 'Rua Tinado Luchesi', 35, 'Diamante (Barreiro)', 'Belo Horizonte', 'MG', 1, '2023-07-24 10:24:45', '0000-00-00 00:00:00'),
(77, 'Marcos Antonio', '93970533023', '30626002', 'Rua Aurélio Lopes', 23, 'Diamante (Barreiro)', 'Belo Horizonte', 'MG', 1, '2023-07-24 10:25:03', '0000-00-00 00:00:00'),
(78, 'Julio Arantes', '78622959007', '31260310', 'Avenida Brigadeiro Antônio Cabral', 34, 'Dona Clara', 'Belo Horizonte', 'MG', 1, '2023-07-24 10:25:19', '0000-00-00 00:00:00'),
(79, 'Alexia Pontes', '95709413089', '30110063', 'Avenida do Contorno', 35, 'Prado', 'Belo Horizonte', 'MG', 1, '2023-07-24 10:27:03', '0000-00-00 00:00:00'),
(80, 'Leonardo Reis', '80701918055', '30110063', 'Avenida do Contorno', 800, 'Prado', 'Belo Horizonte', 'MG', 1, '2023-07-24 10:27:40', '0000-00-00 00:00:00'),
(81, 'Raul Freire', '27844503092', '30110067', 'Avenida do Contorno', 10, 'Prado', 'Belo Horizonte', 'MG', 1, '2023-07-24 10:28:36', '0000-00-00 00:00:00'),
(82, 'Amanda Lima', '28399679011', '31330000', 'Avenida Altamiro Avelino Soares', 123, 'Castelo', 'Belo Horizonte', 'MG', 1, '2023-07-24 10:29:10', '0000-00-00 00:00:00'),
(83, 'Marcela Antonieta', '08302237035', '30110005', 'Avenida do Contorno', 3423, 'Floresta', 'Belo Horizonte', 'MG', 1, '2023-07-24 10:29:54', '0000-00-00 00:00:00'),
(84, 'Julia Nogueira', '98238173086', '30626002', 'Rua Aurélio Lopes', 423, 'Diamante (Barreiro)', 'Belo Horizonte', 'MG', 1, '2023-07-24 10:30:49', '0000-00-00 00:00:00');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `bairros`
--
ALTER TABLE `bairros`
  ADD PRIMARY KEY (`BAIRRO_ID`);

--
-- Índices de tabela `bairros_cep`
--
ALTER TABLE `bairros_cep`
  ADD PRIMARY KEY (`BAIRRO_CEP_ID`);

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`CLIENTE_ID`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `bairros`
--
ALTER TABLE `bairros`
  MODIFY `BAIRRO_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `bairros_cep`
--
ALTER TABLE `bairros_cep`
  MODIFY `BAIRRO_CEP_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `CLIENTE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
