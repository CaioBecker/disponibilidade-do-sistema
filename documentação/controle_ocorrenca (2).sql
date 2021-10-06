-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06-Out-2021 às 19:44
-- Versão do servidor: 10.4.14-MariaDB
-- versão do PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `controle_ocorrenca`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `ocorrencias_sistema`
--

CREATE TABLE `ocorrencias_sistema` (
  `cd_ocorrencia` int(15) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `cd_servico` int(10) NOT NULL,
  `ds_ocorrencia` varchar(100) NOT NULL,
  `ds_detalhada` varchar(300) DEFAULT NULL,
  `dt_inicio` datetime NOT NULL,
  `dt_fim` datetime DEFAULT NULL,
  `cd_usuario` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `ocorrencias_sistema`
--

INSERT INTO `ocorrencias_sistema` (`cd_ocorrencia`, `titulo`, `cd_servico`, `ds_ocorrencia`, `ds_detalhada`, `dt_inicio`, `dt_fim`, `cd_usuario`) VALUES
(19, 'teste caixa', 7, 'teste caixa', 'teste concluido', '2021-10-04 14:33:00', '2021-10-04 16:59:00', 'cbmescandell'),
(20, 'teste mais de um', 7, 'teste caixa mais e um', NULL, '2021-10-04 15:35:00', '1970-01-01 01:00:00', 'cbmescandell'),
(22, 'teste', 5, 'teste', NULL, '2021-10-03 16:01:00', '2021-10-03 17:01:00', 'cbmescandell'),
(23, 'teste serv', 9, 'teste', '', '2021-10-03 16:03:00', '2021-10-03 17:48:00', 'cbmescandell'),
(24, 'teste data fim', 7, 'teste da data fim', NULL, '2021-10-01 17:11:00', NULL, 'cbmescandell');

-- --------------------------------------------------------

--
-- Estrutura da tabela `servicos`
--

CREATE TABLE `servicos` (
  `cd_servico` int(10) NOT NULL,
  `servico` varchar(50) NOT NULL,
  `cd_usuario` varchar(15) NOT NULL COMMENT 'usuário que cadastrou o serviço'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `servicos`
--

INSERT INTO `servicos` (`cd_servico`, `servico`, `cd_usuario`) VALUES
(5, 'teste model', 'cbmescandell'),
(7, 'teste', 'cbmescandell'),
(9, 'teste segato', 'cbmescandell');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `cd_usuario` varchar(15) NOT NULL,
  `nm_usuario` varchar(50) NOT NULL,
  `setor` varchar(50) NOT NULL,
  `cd_senha` varchar(25) NOT NULL,
  `sn_ativo` varchar(3) NOT NULL,
  `adm` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`cd_usuario`, `nm_usuario`, `setor`, `cd_senha`, `sn_ativo`, `adm`) VALUES
('cbmescandell', 'caio becker molina escandell', 'T.I.', 't', 'S', 'S'),
('hssampaio', 'heitor', 'T.I.', 'teste', 'S', 'S'),
('teste', 'teste model', 'T.I.', 'model', 'N', 'N');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `ocorrencias_sistema`
--
ALTER TABLE `ocorrencias_sistema`
  ADD PRIMARY KEY (`cd_ocorrencia`);

--
-- Índices para tabela `servicos`
--
ALTER TABLE `servicos`
  ADD PRIMARY KEY (`cd_servico`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `ocorrencias_sistema`
--
ALTER TABLE `ocorrencias_sistema`
  MODIFY `cd_ocorrencia` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `servicos`
--
ALTER TABLE `servicos`
  MODIFY `cd_servico` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
