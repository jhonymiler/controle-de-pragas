-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11-Ago-2021 às 04:11
-- Versão do servidor: 10.4.19-MariaDB
-- versão do PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ratos`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `biologica`
--

CREATE TABLE `biologica` (
  `BIO_id` int(11) NOT NULL,
  `PON_id` varchar(200) NOT NULL,
  `ORD_id` int(11) NOT NULL,
  `BIO_dispositivo` int(11) NOT NULL,
  `BIO_porta_isca` int(11) NOT NULL,
  `BIO_porta_isca_substituida` int(11) NOT NULL,
  `BIO_captura` int(11) NOT NULL,
  `BIO_data_implantacao` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `biologica`
--

INSERT INTO `biologica` (`BIO_id`, `PON_id`, `ORD_id`, `BIO_dispositivo`, `BIO_porta_isca`, `BIO_porta_isca_substituida`, `BIO_captura`, `BIO_data_implantacao`) VALUES
(2, '150-1387478229969', 150, 1, 0, 0, 2, '2013-12-19');

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `CLI_id` int(11) NOT NULL,
  `CLI_nome` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `CLI_razao_social` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `CLI_cep` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `CLI_rua` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `CLI_num` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `CLI_complemento` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `CLI_bairro` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `CLI_cidade` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `CLI_uf` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `CLI_tel1` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `CLI_tel2` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `CLI_fax` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `CLI_cel` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `CLI_email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `CLI_classificacao` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `CLI_tipo` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `CLI_cpf_cnpj` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `CLI_rg_ie` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `CLI_nascimento` date NOT NULL,
  `CON_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`CLI_id`, `CLI_nome`, `CLI_razao_social`, `CLI_cep`, `CLI_rua`, `CLI_num`, `CLI_complemento`, `CLI_bairro`, `CLI_cidade`, `CLI_uf`, `CLI_tel1`, `CLI_tel2`, `CLI_fax`, `CLI_cel`, `CLI_email`, `CLI_classificacao`, `CLI_tipo`, `CLI_cpf_cnpj`, `CLI_rg_ie`, `CLI_nascimento`, `CON_id`) VALUES
(4, 'Office Web SoluÃ§Ãµes em internet', '', '18705-010', 'Rua Rio Grande do Sul', '1074', '', 'Centro', 'AvarÃ©', 'SP', '(14) 3022-1269', '(23) 2342-3412', '(21) 3412-3421', '', 'contato@officeweb.com.br', 'B', 'juridica', '23.423.423/4234-12', '23423412342341234', '0000-00-00', 0),
(6, 'Jonatas Miler de Oliveira', '', '18708-040', 'Avenida TrÃªs Marias', '320', '', 'Vila TrÃªs Marias', 'AvarÃ©', 'SP', '(12) 1231-2312', '(12) 3123-1231', '(12) 3123-1231', '', 'jonatas@officeweb.com.br', 'A', 'fisica', '234.213.412-34', '0897987098797', '0000-00-00', 0),
(7, 'Ki - Kakau Industria e comercia de chocolates LMTDA', '', '17340-000', 'Av José Erineu Ortigosa', '1329', '', 'Distrito industrial', 'Barra Bonita', 'SP', '(14) 3641-0955', '', '', '', '', 'A', 'juridica', '66.632.175/0003-91', '202034967117', '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `contatos`
--

CREATE TABLE `contatos` (
  `CON_id` int(11) NOT NULL,
  `CON_nome` varchar(200) NOT NULL,
  `CON_email` varchar(200) NOT NULL,
  `CON_fone` varchar(30) NOT NULL,
  `CON_cel` varchar(30) NOT NULL,
  `CLI_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `contrato`
--

CREATE TABLE `contrato` (
  `CON_id` int(11) NOT NULL,
  `CON_inicio` date NOT NULL,
  `CON_termino` date NOT NULL,
  `CON_duracao` varchar(5) NOT NULL,
  `CON_prorrogacao` date NOT NULL,
  `CON_monitoramento` varchar(200) NOT NULL,
  `CON_duracao_visita` varchar(5) NOT NULL,
  `CON_duracao_visita_obs` text NOT NULL,
  `CON_tratamento_quimico` varchar(200) NOT NULL,
  `CON_tratamento_quimico_duracao` varchar(5) NOT NULL,
  `CON_tratamento_quimico_obs` text NOT NULL,
  `CON_visita_gestor` varchar(200) NOT NULL,
  `CON_visita_gestor_duracao` varchar(5) NOT NULL,
  `CON_visita_gestor_obs` text NOT NULL,
  `CON_visitas_extras_qtd` int(11) NOT NULL,
  `CON_visitas_extras_horas` varchar(5) NOT NULL,
  `CON_visitas_extras_obs` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `contrato`
--

INSERT INTO `contrato` (`CON_id`, `CON_inicio`, `CON_termino`, `CON_duracao`, `CON_prorrogacao`, `CON_monitoramento`, `CON_duracao_visita`, `CON_duracao_visita_obs`, `CON_tratamento_quimico`, `CON_tratamento_quimico_duracao`, `CON_tratamento_quimico_obs`, `CON_visita_gestor`, `CON_visita_gestor_duracao`, `CON_visita_gestor_obs`, `CON_visitas_extras_qtd`, `CON_visitas_extras_horas`, `CON_visitas_extras_obs`) VALUES
(1, '2013-08-16', '2014-08-16', '12', '2014-09-16', '15', '01:00', 'sadasdf', '30', '01:00', 'sad fasdf ', '30', '01:00', ' sdfasd f', 11, '00:00', 'asdf asdf asdf '),
(2, '2013-08-16', '2014-08-16', '12', '2014-09-16', '30', '01:00', 'sadasdf', '30', '01:00', 'sad fasdf ', '30', '01:00', ' sdfasd f', 11, '01:00', 'asdf asdf asdf '),
(3, '2013-08-16', '2014-08-16', '12', '2014-09-16', '30', '01:00', 'sadasdf', '30', '01:00', 'sad fasdf ', '30', '01:00', ' sdfasd f', 11, '01:00', 'asdf asdf asdf '),
(4, '2013-08-19', '2014-08-19', '12', '2014-09-19', '15', '01:00', 'sdf asdf ', '15', '01:00', 'sadf asdf ', '30', '01:00', 'sadfasd f', 1, '01:00', 'asdf asdf asdf'),
(5, '2013-08-19', '2014-09-19', '13', '2014-10-19', '15', '01:00', 'asdfasdfasdf', '15', '01:00', 'asdfasdfasdfasdfasdfasdf asdfasdfasdf', '30', '01:00', 'asdfasdfasdf asdfasdfasdf', 2, '01:00', 'asdfasdfasdfasdfasdfasdfasdfasdfasdf asdfasdfasdfasdfasdfasdfasdfasdfasdf'),
(6, '2013-08-19', '2014-09-19', '13', '2014-10-19', '15', '01:00', 'asdfasdfasdf', '15', '01:00', 'asdfasdfasdfasdfasdfasdf asdfasdfasdf', '30', '01:00', 'asdfasdfasdf asdfasdfasdf', 2, '01:00', 'asdfasdfasdfasdfasdfasdfasdfasdfasdf asdfasdfasdfasdfasdfasdfasdfasdfasdf'),
(7, '2013-08-19', '2014-09-19', '13', '2014-10-19', '15', '01:00', 'asdfasdfasdf', '15', '01:00', 'asdfasdfasdfasdfasdfasdf asdfasdfasdf', '30', '01:00', 'asdfasdfasdf asdfasdfasdf', 2, '01:00', 'asdfasdfasdfasdfasdfasdfasdfasdfasdf asdfasdfasdfasdfasdfasdfasdfasdfasdf'),
(8, '2013-08-19', '2014-09-19', '13', '2014-10-19', '15', '01:00', 'asdfasdfasdf', '15', '01:00', 'asdfasdfasdfasdfasdfasdf asdfasdfasdf', '30', '01:00', 'asdfasdfasdf asdfasdfasdf', 2, '01:00', 'asdfasdfasdfasdfasdfasdfasdfasdfasdf asdfasdfasdfasdfasdfasdfasdfasdfasdf'),
(9, '2013-08-19', '2014-09-19', '13', '2014-10-19', '15', '01:00', 'asdfasdfasdf', '15', '01:00', 'asdfasdfasdfasdfasdfasdf asdfasdfasdf', '30', '01:00', 'asdfasdfasdf asdfasdfasdf', 2, '01:00', 'asdfasdfasdfasdfasdfasdfasdfasdfasdf asdfasdfasdfasdfasdfasdfasdfasdfasdf'),
(10, '2013-08-19', '2014-09-19', '13', '2014-10-19', '15', '01:00', 'asdfasdfasdf', '15', '01:00', 'asdfasdfasdfasdfasdfasdf asdfasdfasdf', '30', '01:00', 'asdfasdfasdf asdfasdfasdf', 2, '01:00', 'asdfasdfasdfasdfasdfasdfasdfasdfasdf asdfasdfasdfasdfasdfasdfasdfasdfasdf'),
(11, '2013-08-19', '2014-09-19', '13', '2014-10-19', '15', '01:00', 'asdfasdfasdf', '15', '01:00', 'asdfasdfasdfasdfasdfasdf asdfasdfasdf', '30', '01:00', 'asdfasdfasdf asdfasdfasdf', 2, '01:00', 'asdfasdfasdfasdfasdfasdfasdfasdfasdf asdfasdfasdfasdfasdfasdfasdfasdfasdf'),
(12, '2013-08-19', '2014-09-19', '13', '2014-10-19', '15', '01:00', 'asdfasdfasdf', '15', '01:00', 'asdfasdfasdfasdfasdfasdf asdfasdfasdf', '30', '01:00', 'asdfasdfasdf asdfasdfasdf', 2, '01:00', 'asdfasdfasdfasdfasdfasdfasdfasdfasdf asdfasdfasdfasdfasdfasdfasdfasdfasdf'),
(13, '2013-08-19', '2014-09-19', '13', '2014-10-19', '15', '01:00', 'asdfasdfasdf', '15', '01:00', 'asdfasdfasdfasdfasdfasdf asdfasdfasdf', '30', '01:00', 'asdfasdfasdf asdfasdfasdf', 2, '01:00', 'asdfasdfasdfasdfasdfasdfasdfasdfasdf asdfasdfasdfasdfasdfasdfasdfasdfasdf'),
(14, '2013-08-19', '2014-09-19', '13', '2014-10-19', '15', '01:00', 'asdfasdfasdf', '15', '01:00', 'asdfasdfasdfasdfasdfasdf asdfasdfasdf', '30', '01:00', 'asdfasdfasdf asdfasdfasdf', 2, '01:00', 'asdfasdfasdfasdfasdfasdfasdfasdfasdf asdfasdfasdfasdfasdfasdfasdfasdfasdf'),
(15, '2013-08-19', '2014-09-19', '13', '2014-10-19', '15', '01:00', 'asdfasdfasdf', '15', '01:00', 'asdfasdfasdfasdfasdfasdf asdfasdfasdf', '30', '01:00', 'asdfasdfasdf asdfasdfasdf', 2, '01:00', 'asdfasdfasdfasdfasdfasdfasdfasdfasdf asdfasdfasdfasdfasdfasdfasdfasdfasdf'),
(16, '2013-08-16', '2014-08-16', '12', '2014-09-16', '30', '01:00', 'sadasdf', '30', '01:00', 'sad fasdf ', '30', '01:00', ' sdfasd f', 11, '01:00', 'asdf asdf asdf '),
(17, '2013-08-26', '2014-08-26', '12', '2014-09-28', '30', '01:00', 'Descrição', '', '01:00', 'Descrição', '30', '01:00', 'Descrição', 2, '01:00', 'Descrição'),
(18, '2013-08-28', '2014-08-28', '12', '2014-09-28', '15', '01:00', '', '30', '01:00', '', '90', '01:00', '', 2, '01:00', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipes`
--

CREATE TABLE `equipes` (
  `EQU_id` int(11) NOT NULL,
  `EQU_nome` varchar(200) NOT NULL,
  `FUN_id` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `equipes`
--

INSERT INTO `equipes` (`EQU_id`, `EQU_nome`, `FUN_id`) VALUES
(68, 'Equipe 01', '[{\"id\":28,\"nome\":\"Jonatas Miler de Oliveira\"},{\"id\":34,\"nome\":\"Fulano Ciclano Bertano\"}]'),
(69, 'Equipe 02', '[{\"id\":28,\"nome\":\"Jonatas Miler de Oliveira\"},{\"id\":34,\"nome\":\"Fulano Ciclano Bertano\"}]'),
(70, 'Tsd', '[{\"id\":28,\"nome\":\"Jonatas Miler de Oliveira\"},{\"id\":34,\"nome\":\"Fulano Ciclano Bertano\"}]'),
(73, 'Equipe 03', '[{\"id\":28,\"nome\":\"Jonatas Miler de Oliveira\"},{\"id\":34,\"nome\":\"Fulano Ciclano Bertano\"}]');

-- --------------------------------------------------------

--
-- Estrutura da tabela `formacao_preco`
--

CREATE TABLE `formacao_preco` (
  `FOR_id` int(11) NOT NULL,
  `FOR_num_operadores` text NOT NULL,
  `FOR_distancia` text NOT NULL,
  `FOR_cobrar_hotel` int(1) NOT NULL DEFAULT 0,
  `FOR_cobrar_hotel_num_dias` int(11) NOT NULL DEFAULT 0,
  `FOR_qtd_dias_hotel` int(10) NOT NULL,
  `FOR_total_visitas` text NOT NULL,
  `FOR_total_duracao` text NOT NULL,
  `FOR_tipo_pgto` text NOT NULL,
  `FOR_num_parcelas` text NOT NULL,
  `FOR_valor_parcela` text NOT NULL,
  `FOR_total_sugerido` text NOT NULL,
  `FOR_desconto` text NOT NULL,
  `FOR_tipo_desconto` text NOT NULL,
  `FOR_total_negociado` varchar(11) NOT NULL,
  `FOR_valor_adicional` text NOT NULL,
  `FOR_valor_adicional_descricao` text NOT NULL,
  `FOR_valores_adicionais` text NOT NULL,
  `FOR_material_direto` text NOT NULL,
  `FOR_mao_obra` text NOT NULL,
  `FOR_deslocalmento` text NOT NULL,
  `FOR_outras_despesas` text NOT NULL,
  `FOR_comissao_valor` text NOT NULL,
  `FOR_administracao_valor` text NOT NULL,
  `FOR_total_despesas` float NOT NULL,
  `FOR_total` text NOT NULL,
  `FOR_lucro` text NOT NULL,
  `FOR_lucro_percent` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `formacao_preco`
--

INSERT INTO `formacao_preco` (`FOR_id`, `FOR_num_operadores`, `FOR_distancia`, `FOR_cobrar_hotel`, `FOR_cobrar_hotel_num_dias`, `FOR_qtd_dias_hotel`, `FOR_total_visitas`, `FOR_total_duracao`, `FOR_tipo_pgto`, `FOR_num_parcelas`, `FOR_valor_parcela`, `FOR_total_sugerido`, `FOR_desconto`, `FOR_tipo_desconto`, `FOR_total_negociado`, `FOR_valor_adicional`, `FOR_valor_adicional_descricao`, `FOR_valores_adicionais`, `FOR_material_direto`, `FOR_mao_obra`, `FOR_deslocalmento`, `FOR_outras_despesas`, `FOR_comissao_valor`, `FOR_administracao_valor`, `FOR_total_despesas`, `FOR_total`, `FOR_lucro`, `FOR_lucro_percent`) VALUES
(1, '2', '100', 0, 0, 5, '59', '48:00', 'PARCELADO', '12', '219.51', '2926.8', '10', 'porcentagem', '', '10.5', 'sadfsdf', '[{\"id\":1,\"valor\":\"0\",\"descricao\":\"teste\"},{\"valor\":\"100.50\",\"descricao\":\"sadfsdf\"},{\"valor\":\"10.5\",\"descricao\":\"sadfsdf\"}]', '9.8', '1740', '40', '111', '54', '15', 1915.8, '2634.1200000000003', '957', ''),
(2, '2', '100', 0, 0, 0, '47', '47:00', 'PARCELADO', '12', '182.51250000000002', '2433.5', '10', 'porcentagem', '', '', '', '[{\"id\":1,\"valor\":\"0\",\"descricao\":\"teste\"},{\"valor\":\"100.50\",\"descricao\":\"sadfsdf\"},{\"valor\":\"10.5\",\"descricao\":\"sadfsdf\"}]', '105', '1321.5', '40', '111', '45', '15', 1592.5, '2190.15', '796', ''),
(3, '2', '100', 0, 0, 0, '47', '47:00', 'PARCELADO', '12', '182.51250000000002', '2433.5', '10', 'porcentagem', '', '', '', '[{\"id\":1,\"valor\":\"0\",\"descricao\":\"teste\"},{\"valor\":\"100.50\",\"descricao\":\"sadfsdf\"},{\"valor\":\"10.5\",\"descricao\":\"sadfsdf\"}]', '105', '1321.5', '40', '111', '45', '15', 1592.5, '2190.15', '796', ''),
(17, '2', '25', 0, 0, 0, '26', '26:00', 'PARCELADO', '12', '244.50', '1646', '3.5', 'dinheiro', '2934', '', '', '[]', '105', '1516', '10', '0', '47', '15', 1646, '2934', '823', ''),
(18, '2', '50', 0, 0, 0, '42', '42:00', 'PARCELADO', '12', '241.25', '1901', '10', 'dinheiro', '2895.00', '', '', '[{\"id\":\"\",\"descricao\":\"\",\"valor\":0},{\"valor\":\"100\",\"descricao\":\"Pedu00e1gio\"},{\"valor\":\"30\",\"descricao\":\"Salgados\"}]', '98', '1638', '20', '130', '54', '15', 1901, '2895.00', '950', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedor`
--

CREATE TABLE `fornecedor` (
  `FOR_id` int(11) NOT NULL,
  `FOR_nome` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `FOR_razao_social` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `FOR_cep` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `FOR_rua` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `FOR_num` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `FOR_complemento` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `FOR_bairro` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `FOR_cidade` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `FOR_uf` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `FOR_tel1` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `FOR_tel2` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `FOR_fax` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `FOR_cel` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `FOR_email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `FOR_cnpj` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `FOR_ie` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `fornecedor`
--

INSERT INTO `fornecedor` (`FOR_id`, `FOR_nome`, `FOR_razao_social`, `FOR_cep`, `FOR_rua`, `FOR_num`, `FOR_complemento`, `FOR_bairro`, `FOR_cidade`, `FOR_uf`, `FOR_tel1`, `FOR_tel2`, `FOR_fax`, `FOR_cel`, `FOR_email`, `FOR_cnpj`, `FOR_ie`) VALUES
(3, 'Fornecedor', 'Testando cadastro de fornecedor', '18706-080', 'Rua Quinze de Novembro', '333', '', 'Vila Jussara Maria', 'AvarÃ©', 'SP', '(12) 3123-1231', '(12) 3123-1231', '(12) 3123-1231', '(12) 3123-1231', 'teste@teste.com', '23.421.341/2342-31', '234234234234'),
(4, 'Testando cadastro', 'Testando cadastro de fornecedor', '18708-040', 'Avenida TrÃªs Marias', '320', '', 'Vila TrÃªs Marias', 'AvarÃ©', 'SP', '(24) 3213-4123', '(98) 7987-9878', '(12) 3123-1231', '(97) 6897-6897', 'jonatas@officeweb.com.br', '34.123.412/3412-34', '9879879087'),
(5, 'Testando cadastro', 'Testando cadastro de fornecedor', '18708-040', 'Avenida TrÃªs Marias', '320', '', 'Vila TrÃªs Marias', 'AvarÃ©', 'SP', '(24) 3213-4123', '(98) 7987-9878', '(12) 3123-1231', '(97) 6897-6897', 'jonatas@officeweb.com.br', '34.123.412/3412-34', '9879879087');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `FUN_id` int(11) NOT NULL,
  `FUN_nome` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `FUN_cep` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `FUN_rua` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `FUN_num` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `FUN_complemento` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `FUN_bairro` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `FUN_cidade` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `FUN_uf` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `FUN_tel1` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `FUN_tel2` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `FUN_fax` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `FUN_cel` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `FUN_email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `FUN_depto` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `FUN_cpf` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `FUN_rg` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `FUN_nascimento` date NOT NULL,
  `FUN_adimissao` date NOT NULL,
  `FUN_cnh` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `FUN_facebook` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `FUN_permissao_area` varchar(240) COLLATE utf8_unicode_ci NOT NULL,
  `FUN_token` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `FUN_status` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `FUN_senha` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `FUN_cargo` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `funcionarios`
--

INSERT INTO `funcionarios` (`FUN_id`, `FUN_nome`, `FUN_cep`, `FUN_rua`, `FUN_num`, `FUN_complemento`, `FUN_bairro`, `FUN_cidade`, `FUN_uf`, `FUN_tel1`, `FUN_tel2`, `FUN_fax`, `FUN_cel`, `FUN_email`, `FUN_depto`, `FUN_cpf`, `FUN_rg`, `FUN_nascimento`, `FUN_adimissao`, `FUN_cnh`, `FUN_facebook`, `FUN_permissao_area`, `FUN_token`, `FUN_status`, `FUN_senha`, `FUN_cargo`) VALUES
(28, 'Jonatas Miler de Oliveira', '18705-010', 'Rua Rio Grande do Sul', '1074', '', 'Centro', 'AvarÃ©', 'SP', '(14) 3022-1269', '', '', '(14) 9736-6888', 'jonatas@email.com', '', '999.999.999-99', '99999999999', '1987-06-06', '0000-00-00', '9999999999', '100002910898091', '{\"cadastros\":[\"funcionarios\",\"clientes\"],\"relatorios\":[\"funcionarios\",\"clientes\"]}', 'CAAByKfWr90EBAIsAtyBZBla0TGdWNkYdta8oezJsduewcXZCuTcoYIGvhCosFyJBfGBoD4JnhL4BUoMHzIfQKMMPO0w83J6AsGexJkO6YG7Ki47I5FH4qXYSdDZCz3R19c9HgKId71XFx3NX1duMDfUJ3tyrZAe2f1sABHYb8nU1NMNIui7RO4geQfMj6ZCpD9uWJEE', '1', 'e7a3d94707400e3992cccbb6b41065f5', '0'),
(32, 'Antonio', '18707-000', 'Rua Bahia', '55', '', 'Alto', 'AvarÃ©', 'SP', '(99) 9999-9999', '(99) 9999-9999', '', '(99) 9999-9999', 'antonio@terraamiental.com.br', '', '999.999.999-99', '9999999999', '1970-05-05', '0000-00-00', '999999999', '', 'null', '184a2c2f972c1d9b5b2552057b81159e', '1', '4a181673429f0b6abbfd452f0f3b5950', '1'),
(35, 'Consultor 1', '18708-040', 'Avenida TrÃªs Marias', '320', '', 'Vila TrÃªs Marias', 'AvarÃ©', 'SP', '(99) 9999-9999', '(99) 9999-9999', '', '(99) 9999-9999', 'consultor@email.com', '', '999.999.999-99', '999999999', '0000-00-00', '0000-00-00', '99999', '', '{\"cadastros\":[\"funcionarios\",\"clientes\"],\"relatorios\":[\"funcionarios\",\"clientes\"]}', '', '1', 'e8d95a51f3af4a3b134bf6bb680a213a', '2'),
(34, 'Fulano Ciclano Bertano', '19705-010', 'Rua Fermino', '01', '', 'Vila jardim', 'AvarÃ©', 'SP', '(14) 9999-9999', '(99) 9999-9999', '', '(99) 9999-9999', 'user@email.com', '', '234.123.412-34', '234123412341', '1960-05-12', '2000-06-09', '123412314', '', '{\"cadastros\":[\"funcionarios\",\"clientes\"],\"relatorios\":[\"funcionarios\",\"clientes\"]}', '', '1', 'e8d95a51f3af4a3b134bf6bb680a213a', '0'),
(36, 'Consultor 2', '18705-010', 'Rua Rio Grande do Sul', '1274', '', 'Centro', 'AvarÃ©', 'SP', '(99) 9999-9999', '(99) 9999-9999', '', '(99) 9999-9999', 'consultor2@email.com', '', '999.999.999-99', '99999999999', '0000-00-00', '0000-00-00', '99999', '', '{\"cadastros\":[\"funcionarios\",\"clientes\"],\"relatorios\":[\"funcionarios\",\"clientes\"]}', '', '1', 'e8d95a51f3af4a3b134bf6bb680a213a', '2');

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupo`
--

CREATE TABLE `grupo` (
  `GRU_id` int(11) NOT NULL,
  `GRU_nome` varchar(200) NOT NULL,
  `GRU_descricao` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `grupo`
--

INSERT INTO `grupo` (`GRU_id`, `GRU_nome`, `GRU_descricao`) VALUES
(3, 'Defensivo Liq.', 'Defensivo LÃ­quido'),
(4, 'Defensivo sÃ³lido', 'Defensivo sÃ³lido'),
(5, 'EPI', 'Equipamento de ProteÃ§Ã£o Individual'),
(6, 'EspÃ­cula', 'EspÃ­cula'),
(7, 'Gel isenticida', 'Gel isenticida'),
(8, 'Gel repelente', 'Gel repelente'),
(9, 'Isca Luminosa', 'Isca Luminosa'),
(10, 'Iscas em geral', 'Iscas em geral'),
(11, 'Laudo', 'Laudo'),
(12, 'Material de EscritÃ³rio', 'Material de EscritÃ³rio'),
(13, 'Outros dispositivos de monitoramento', 'Outros dispositivos de monitoramento'),
(14, 'Placa Adesiva', 'Placa Adesiva'),
(15, 'PPE', 'Porta Iscas'),
(16, 'PPI', 'Porta Placas'),
(17, 'REDES', 'REDES'),
(18, 'Repelentes para pombos', 'Repelentes para pombos'),
(19, 'Reserva TÃ©cnica', 'Reserva TÃ©cnica'),
(20, 'ReservatÃ³rios', 'HifhiginenizaÃ§Ã£o de desinfecÃ§Ã£o de reservatÃ³rios'),
(21, 'Rodenticida parafinado', 'Rodenticida parafinado'),
(22, 'Rodenticida peletizado', 'Rodenticida peletizado'),
(23, 'Rodenticida pÃ³', 'Rodenticida pÃ³'),
(24, 'Sentricon', 'Sistema Sentricon');

-- --------------------------------------------------------

--
-- Estrutura da tabela `luminosa`
--

CREATE TABLE `luminosa` (
  `LUM_id` int(11) NOT NULL,
  `PON_id` varchar(200) NOT NULL,
  `ORD_id` int(11) NOT NULL,
  `LUM_dispositivo` int(11) NOT NULL,
  `LUM_placa_adesiva` int(11) NOT NULL,
  `LUM_captura` int(11) NOT NULL,
  `LUM_placa_adesiva_substituida` int(11) NOT NULL,
  `LUM_lampada` int(11) NOT NULL,
  `LUM_lampada_substituida` int(11) NOT NULL,
  `LUM_patrimonio` varchar(200) NOT NULL,
  `LUM_responsa_cliente` varchar(200) NOT NULL,
  `LUM_data_implantacao` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `luminosa`
--

INSERT INTO `luminosa` (`LUM_id`, `PON_id`, `ORD_id`, `LUM_dispositivo`, `LUM_placa_adesiva`, `LUM_captura`, `LUM_placa_adesiva_substituida`, `LUM_lampada`, `LUM_lampada_substituida`, `LUM_patrimonio`, `LUM_responsa_cliente`, `LUM_data_implantacao`) VALUES
(5, '150-1387476885463', 150, 1, 1, 0, 0, 0, 0, '0', '1', '2013-12-19');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ocorrencia_pragas`
--

CREATE TABLE `ocorrencia_pragas` (
  `OCO_id` int(11) NOT NULL,
  `OCO_ambiente` varchar(200) NOT NULL,
  `OCO_especie` varchar(200) NOT NULL,
  `OCO_vestigio` varchar(200) NOT NULL,
  `OCO_nivel` varchar(200) NOT NULL,
  `OCO_tratamento` varchar(200) NOT NULL,
  `OCO_data` date NOT NULL,
  `ORD_id` int(11) NOT NULL,
  `CLI_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ocorrencia_pragas`
--

INSERT INTO `ocorrencia_pragas` (`OCO_id`, `OCO_ambiente`, `OCO_especie`, `OCO_vestigio`, `OCO_nivel`, `OCO_tratamento`, `OCO_data`, `ORD_id`, `CLI_id`) VALUES
(10, 'sadf', '2 - ABELHAS', '(IN) Informação', '(AL) Alto', '11 - ISCAGEM', '2013-12-22', 290, 7),
(9, 'sdsdfsdfsdfsdf', '2 - ABELHAS', '(IN) Informação', '(BX) Baixo', '20 - TRINCHEIRA', '2013-12-22', 290, 7),
(15, 'Teste 2', '2 - ABELHAS', '(PF) Presença', '(BX) Baixo', '5 - BARREIRA FÍSICA', '2013-12-23', 285, 7),
(14, 'Teste de Ambiente', '2 - ABELHAS', '(IN) Informação', '(BX) Baixo', '4 - ATOMIZÇÃO', '2013-12-23', 285, 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `orcamentos`
--

CREATE TABLE `orcamentos` (
  `ORC_id` int(11) NOT NULL COMMENT 'Orçamento',
  `CLI_id` int(11) NOT NULL COMMENT 'Cliente',
  `CON_id` int(11) NOT NULL COMMENT 'Contrato',
  `FOR_id` int(11) NOT NULL COMMENT 'Formação de Preço',
  `REC_id` int(11) NOT NULL COMMENT 'Recursos Materiais',
  `VIS_id` int(11) NOT NULL COMMENT 'Vistoria',
  `ORC_dias_validade` varchar(3) NOT NULL,
  `ORC_data_criacao` date NOT NULL,
  `ORC_dificuldade_fechamento` int(2) NOT NULL,
  `ORC_status` int(2) NOT NULL,
  `ORC_motivo` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `orcamentos`
--

INSERT INTO `orcamentos` (`ORC_id`, `CLI_id`, `CON_id`, `FOR_id`, `REC_id`, `VIS_id`, `ORC_dias_validade`, `ORC_data_criacao`, `ORC_dificuldade_fechamento`, `ORC_status`, `ORC_motivo`) VALUES
(1, 7, 1, 1, 1, 1, '10', '2013-08-17', 0, 0, '0'),
(2, 7, 2, 2, 2, 2, '10', '2013-08-18', 0, 2, '0'),
(3, 7, 3, 3, 3, 3, '10', '2013-08-18', 0, 0, '0'),
(22, 4, 17, 17, 17, 17, '10', '2013-08-26', 0, 0, '0'),
(23, 7, 18, 18, 18, 18, '15', '2013-08-28', 0, 2, '4');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ordem_servico`
--

CREATE TABLE `ordem_servico` (
  `ORD_id` int(11) NOT NULL,
  `id_pai` int(200) NOT NULL DEFAULT 0,
  `ORC_id` int(11) NOT NULL,
  `ORD_data_visita` date NOT NULL,
  `ORD_hora_visita` varchar(11) NOT NULL,
  `ORD_duracao_visita` varchar(200) NOT NULL,
  `ORD_aguardando` varchar(100) NOT NULL,
  `ORD_agendado` varchar(100) NOT NULL,
  `ORD_tipo_visita` int(11) NOT NULL,
  `ORD_atividade` int(11) NOT NULL,
  `EQU_id` int(11) NOT NULL,
  `VEI_id` int(11) NOT NULL,
  `ORD_defensivos` text NOT NULL,
  `ORD_detalhes_tratamento` text NOT NULL,
  `ORD_partida` varchar(20) NOT NULL,
  `ORD_chegada` date NOT NULL,
  `ORD_chegada_hora` varchar(20) NOT NULL,
  `ORD_inicio_servico` varchar(20) NOT NULL,
  `ORD_km_partida` varchar(100) NOT NULL,
  `ORD_km_chegada` varchar(100) NOT NULL,
  `ORD_termino` date NOT NULL,
  `ORD_termino_hora` varchar(20) NOT NULL,
  `ORD_acompanhado_por` varchar(200) NOT NULL,
  `ORD_obs` text NOT NULL,
  `ORD_pontos` text NOT NULL,
  `ORD_status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ordem_servico`
--

INSERT INTO `ordem_servico` (`ORD_id`, `id_pai`, `ORC_id`, `ORD_data_visita`, `ORD_hora_visita`, `ORD_duracao_visita`, `ORD_aguardando`, `ORD_agendado`, `ORD_tipo_visita`, `ORD_atividade`, `EQU_id`, `VEI_id`, `ORD_defensivos`, `ORD_detalhes_tratamento`, `ORD_partida`, `ORD_chegada`, `ORD_chegada_hora`, `ORD_inicio_servico`, `ORD_km_partida`, `ORD_km_chegada`, `ORD_termino`, `ORD_termino_hora`, `ORD_acompanhado_por`, `ORD_obs`, `ORD_pontos`, `ORD_status`) VALUES
(144, 0, 23, '2013-11-06', '15:00', '01:00', 'Rafael', 'Ag. Jonatas', 0, 0, 68, 1001, '[{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '[{\r\n                                \"ambiente\":\"Teste\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(BX) Baixo\",\r\n                                \"te\":\"20 - TRINCHEIRA\",\r\n                                \r\n                           },{\"ambiente\":\"teste 2\",\"ep\":{\"nome\":\"2 - ABELHAS\"},\"ve\":\"(IN) InformaÃ§Ã£o\",\"ni\":\"(BX) Baixo\",\"te\":\"17 - REMOÃ‡ÃƒO FÃSICA\"},{\"ambiente\":\"teste 2\",\"ep\":{\"nome\":\"2 - ABELHAS\"},\"ve\":\"(PF) PresenÃ§a\",\"ni\":\"(BX) Baixo\",\"te\":\"19 - TERMONEBULIZAÃ‡ÃƒO\"},{\"ambiente\":\"teste 2\",\"ep\":{\"nome\":\"2 - ABELHAS\"},\"ve\":\"(PF) PresenÃ§a\",\"ni\":\"(BX) Baixo\",\"te\":\"19 - TERMONEBULIZAÃ‡ÃƒO\"}]', '14:30', '2013-12-26', '15:30', '15:30', '500000', '500040', '2013-12-26', '16:30', 'Gerente', '             Teste de ObservaÃ§Ãµes.', '[{\"id\":\"144-1387792663756\",\"tipo_dispositivo\":\"ppe\",\"num\":\"1\",\"descricao\":\"Portu00e3o da frente\",\"local\":\"Portu00e3o da frente\",\"dispositivo\":\"asdfasdf\",\"status\":\"1\"},{\"id\":\"144-1387792673756\",\"tipo_dispositivo\":\"ppe\",\"num\":\"2\",\"descricao\":\"Portu00e3o da frente\",\"local\":\"Portu00e3o da frente 2\",\"dispositivo\":\"asdfadf\",\"status\":\"1\"},{\"id\":\"144-1387792684100\",\"tipo_dispositivo\":\"ppe\",\"num\":\"3\",\"descricao\":\"Portu00e3o da frente\",\"local\":\"Portu00e3o da frente 3\",\"dispositivo\":\"sdfasdf\",\"status\":\"1\"},{\"id\":\"144-1387792692756\",\"tipo_dispositivo\":\"ppe\",\"num\":\"4\",\"descricao\":\"Portu00e3o da frente sdfasdf\",\"local\":\"Portu00e3o da frente 4\",\"dispositivo\":\"adfasdf\",\"status\":\"1\"},{\"id\":\"144-1387792737799\",\"tipo_dispositivo\":\"ppi\",\"num\":\"1\",\"descricao\":\"Salão produção\",\"local\":\"Salão produção\",\"dispositivo\":\"Salão produção\",\"status\":\"1\"},{\"id\":\"144-1387792744034\",\"tipo_dispositivo\":\"ppi\",\"num\":\"2\",\"descricao\":\"Salão produção\",\"local\":\"Salão produção\",\"dispositivo\":\"wewrwer\",\"status\":\"1\"},{\"id\":\"144-1387792751284\",\"tipo_dispositivo\":\"ppi\",\"num\":\"3\",\"descricao\":\"asdfasdf asdf\",\"local\":\"Salão produção\",\"dispositivo\":\"asdf asdf asdf \",\"status\":\"1\"},{\"id\":\"144-1387792760456\",\"tipo_dispositivo\":\"ppi\",\"num\":\"4\",\"descricao\":\"asdfasdf\",\"local\":\"Salão produção\",\"dispositivo\":\"sdfasdasdfad\",\"status\":\"1\"}]', 1),
(143, 0, 23, '2013-10-02', '00:00', '', 'Rafael', 'Ag. Jonatas', 0, 0, 68, 1001, '[{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '[{\r\n                                \"ambiente\":\"\",\r\n                                \"ep\":{\"nome\":\"0\"},\r\n                                \"ve\":\"0\",\r\n                                \"ni\":\"\",\r\n                                \"te\":\"\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           }]', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '', 0),
(145, 144, 23, '2014-01-15', '15:00', '01:00', 'Rafael', 'Ag. Jonatas', 4, 0, 68, 1001, '[{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '[{\"ambiente\":\"sd\",\"ep\":{\"nome\":\"2 - ABELHAS\"},\"ve\":\"(FE) Fezes\",\"ni\":\"(BX) Baixo\",\"te\":\"11 - ISCAGEM\"},{\"ambiente\":\"sd\",\"ep\":{\"nome\":\"2 - ABELHAS\"},\"ve\":\"(FE) Fezes\",\"ni\":\"(BX) Baixo\",\"te\":\"11 - ISCAGEM\"},{\"ambiente\":\"sd\",\"ep\":{\"nome\":\"2 - ABELHAS\"},\"ve\":\"(FE) Fezes\",\"ni\":\"(BX) Baixo\",\"te\":\"11 - ISCAGEM\"},{\"ambiente\":\"sd\",\"ep\":{\"nome\":\"2 - ABELHAS\"},\"ve\":\"(FE) Fezes\",\"ni\":\"(BX) Baixo\",\"te\":\"11 - ISCAGEM\"},{\"ambiente\":\"sd\",\"ep\":{\"nome\":\"2 - ABELHAS\"},\"ve\":\"(FE) Fezes\",\"ni\":\"(BX) Baixo\",\"te\":\"11 - ISCAGEM\"}]', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '[{\"id\":\"144-1387792663756\",\"tipo_dispositivo\":\"ppe\",\"num\":\"1\",\"descricao\":\"Portu00e3o da frente\",\"local\":\"Portu00e3o da frente\",\"dispositivo\":\"asdfasdf\",\"status\":\"1\"},{\"id\":\"144-1387792673756\",\"tipo_dispositivo\":\"ppe\",\"num\":\"2\",\"descricao\":\"Portu00e3o da frente\",\"local\":\"Portu00e3o da frente 2\",\"dispositivo\":\"asdfadf\",\"status\":\"1\"},{\"id\":\"144-1387792684100\",\"tipo_dispositivo\":\"ppe\",\"num\":\"3\",\"descricao\":\"Portu00e3o da frente\",\"local\":\"Portu00e3o da frente 3\",\"dispositivo\":\"sdfasdf\",\"status\":\"1\"},{\"id\":\"144-1387792692756\",\"tipo_dispositivo\":\"ppe\",\"num\":\"4\",\"descricao\":\"Portu00e3o da frente sdfasdf\",\"local\":\"Portu00e3o da frente 4\",\"dispositivo\":\"adfasdf\",\"status\":\"1\"},{\"id\":\"144-1387792737799\",\"tipo_dispositivo\":\"ppi\",\"num\":\"1\",\"descricao\":\"Salão produção\",\"local\":\"Salão produção\",\"dispositivo\":\"Salão produção\",\"status\":\"1\"},{\"id\":\"144-1387792744034\",\"tipo_dispositivo\":\"ppi\",\"num\":\"2\",\"descricao\":\"Salão produção\",\"local\":\"Salão produção\",\"dispositivo\":\"wewrwer\",\"status\":\"1\"},{\"id\":\"144-1387792751284\",\"tipo_dispositivo\":\"ppi\",\"num\":\"3\",\"descricao\":\"asdfasdf asdf\",\"local\":\"Salão produção\",\"dispositivo\":\"asdf asdf asdf \",\"status\":\"1\"},{\"id\":\"144-1387792760456\",\"tipo_dispositivo\":\"ppi\",\"num\":\"4\",\"descricao\":\"asdfasdf\",\"local\":\"Salão produção\",\"dispositivo\":\"sdfasdasdfad\",\"status\":\"1\"}]', 0),
(146, 144, 23, '2014-02-12', '15:00', '01:00', 'Rafael', 'Ag. Jonatas', 4, 0, 68, 1001, '[{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '[{\"ambiente\":\"sd\",\"ep\":{\"nome\":\"2 - ABELHAS\"},\"ve\":\"(FE) Fezes\",\"ni\":\"(BX) Baixo\",\"te\":\"11 - ISCAGEM\"},{\"ambiente\":\"sd\",\"ep\":{\"nome\":\"2 - ABELHAS\"},\"ve\":\"(FE) Fezes\",\"ni\":\"(BX) Baixo\",\"te\":\"11 - ISCAGEM\"},{\"ambiente\":\"sd\",\"ep\":{\"nome\":\"2 - ABELHAS\"},\"ve\":\"(FE) Fezes\",\"ni\":\"(BX) Baixo\",\"te\":\"11 - ISCAGEM\"},{\"ambiente\":\"sd\",\"ep\":{\"nome\":\"2 - ABELHAS\"},\"ve\":\"(FE) Fezes\",\"ni\":\"(BX) Baixo\",\"te\":\"11 - ISCAGEM\"},{\"ambiente\":\"sd\",\"ep\":{\"nome\":\"2 - ABELHAS\"},\"ve\":\"(FE) Fezes\",\"ni\":\"(BX) Baixo\",\"te\":\"11 - ISCAGEM\"}]', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '[{\"id\":\"144-1387792663756\",\"tipo_dispositivo\":\"ppe\",\"num\":\"1\",\"descricao\":\"Portu00e3o da frente\",\"local\":\"Portu00e3o da frente\",\"dispositivo\":\"asdfasdf\",\"status\":\"1\"},{\"id\":\"144-1387792673756\",\"tipo_dispositivo\":\"ppe\",\"num\":\"2\",\"descricao\":\"Portu00e3o da frente\",\"local\":\"Portu00e3o da frente 2\",\"dispositivo\":\"asdfadf\",\"status\":\"1\"},{\"id\":\"144-1387792684100\",\"tipo_dispositivo\":\"ppe\",\"num\":\"3\",\"descricao\":\"Portu00e3o da frente\",\"local\":\"Portu00e3o da frente 3\",\"dispositivo\":\"sdfasdf\",\"status\":\"1\"},{\"id\":\"144-1387792692756\",\"tipo_dispositivo\":\"ppe\",\"num\":\"4\",\"descricao\":\"Portu00e3o da frente sdfasdf\",\"local\":\"Portu00e3o da frente 4\",\"dispositivo\":\"adfasdf\",\"status\":\"1\"},{\"id\":\"144-1387792737799\",\"tipo_dispositivo\":\"ppi\",\"num\":\"1\",\"descricao\":\"Salão produção\",\"local\":\"Salão produção\",\"dispositivo\":\"Salão produção\",\"status\":\"1\"},{\"id\":\"144-1387792744034\",\"tipo_dispositivo\":\"ppi\",\"num\":\"2\",\"descricao\":\"Salão produção\",\"local\":\"Salão produção\",\"dispositivo\":\"wewrwer\",\"status\":\"1\"},{\"id\":\"144-1387792751284\",\"tipo_dispositivo\":\"ppi\",\"num\":\"3\",\"descricao\":\"asdfasdf asdf\",\"local\":\"Salão produção\",\"dispositivo\":\"asdf asdf asdf \",\"status\":\"1\"},{\"id\":\"144-1387792760456\",\"tipo_dispositivo\":\"ppi\",\"num\":\"4\",\"descricao\":\"asdfasdf\",\"local\":\"Salão produção\",\"dispositivo\":\"sdfasdasdfad\",\"status\":\"1\"}]', 0),
(147, 144, 23, '2014-03-12', '15:00', '01:00', 'Rafael', 'Ag. Jonatas', 4, 0, 68, 1001, '[{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '[{\"ambiente\":\"sd\",\"ep\":{\"nome\":\"2 - ABELHAS\"},\"ve\":\"(FE) Fezes\",\"ni\":\"(BX) Baixo\",\"te\":\"11 - ISCAGEM\"},{\"ambiente\":\"sd\",\"ep\":{\"nome\":\"2 - ABELHAS\"},\"ve\":\"(FE) Fezes\",\"ni\":\"(BX) Baixo\",\"te\":\"11 - ISCAGEM\"},{\"ambiente\":\"sd\",\"ep\":{\"nome\":\"2 - ABELHAS\"},\"ve\":\"(FE) Fezes\",\"ni\":\"(BX) Baixo\",\"te\":\"11 - ISCAGEM\"},{\"ambiente\":\"sd\",\"ep\":{\"nome\":\"2 - ABELHAS\"},\"ve\":\"(FE) Fezes\",\"ni\":\"(BX) Baixo\",\"te\":\"11 - ISCAGEM\"},{\"ambiente\":\"sd\",\"ep\":{\"nome\":\"2 - ABELHAS\"},\"ve\":\"(FE) Fezes\",\"ni\":\"(BX) Baixo\",\"te\":\"11 - ISCAGEM\"}]', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '[{\"id\":\"144-1387792663756\",\"tipo_dispositivo\":\"ppe\",\"num\":\"1\",\"descricao\":\"Portu00e3o da frente\",\"local\":\"Portu00e3o da frente\",\"dispositivo\":\"asdfasdf\",\"status\":\"1\"},{\"id\":\"144-1387792673756\",\"tipo_dispositivo\":\"ppe\",\"num\":\"2\",\"descricao\":\"Portu00e3o da frente\",\"local\":\"Portu00e3o da frente 2\",\"dispositivo\":\"asdfadf\",\"status\":\"1\"},{\"id\":\"144-1387792684100\",\"tipo_dispositivo\":\"ppe\",\"num\":\"3\",\"descricao\":\"Portu00e3o da frente\",\"local\":\"Portu00e3o da frente 3\",\"dispositivo\":\"sdfasdf\",\"status\":\"1\"},{\"id\":\"144-1387792692756\",\"tipo_dispositivo\":\"ppe\",\"num\":\"4\",\"descricao\":\"Portu00e3o da frente sdfasdf\",\"local\":\"Portu00e3o da frente 4\",\"dispositivo\":\"adfasdf\",\"status\":\"1\"},{\"id\":\"144-1387792737799\",\"tipo_dispositivo\":\"ppi\",\"num\":\"1\",\"descricao\":\"Salão produção\",\"local\":\"Salão produção\",\"dispositivo\":\"Salão produção\",\"status\":\"1\"},{\"id\":\"144-1387792744034\",\"tipo_dispositivo\":\"ppi\",\"num\":\"2\",\"descricao\":\"Salão produção\",\"local\":\"Salão produção\",\"dispositivo\":\"wewrwer\",\"status\":\"1\"},{\"id\":\"144-1387792751284\",\"tipo_dispositivo\":\"ppi\",\"num\":\"3\",\"descricao\":\"asdfasdf asdf\",\"local\":\"Salão produção\",\"dispositivo\":\"asdf asdf asdf \",\"status\":\"1\"},{\"id\":\"144-1387792760456\",\"tipo_dispositivo\":\"ppi\",\"num\":\"4\",\"descricao\":\"asdfasdf\",\"local\":\"Salão produção\",\"dispositivo\":\"sdfasdasdfad\",\"status\":\"1\"}]', 0),
(148, 144, 23, '2014-04-09', '15:00', '01:00', 'Rafael', 'Ag. Jonatas', 4, 0, 68, 1001, '[{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '[{\"ambiente\":\"sd\",\"ep\":{\"nome\":\"2 - ABELHAS\"},\"ve\":\"(FE) Fezes\",\"ni\":\"(BX) Baixo\",\"te\":\"11 - ISCAGEM\"},{\"ambiente\":\"sd\",\"ep\":{\"nome\":\"2 - ABELHAS\"},\"ve\":\"(FE) Fezes\",\"ni\":\"(BX) Baixo\",\"te\":\"11 - ISCAGEM\"},{\"ambiente\":\"sd\",\"ep\":{\"nome\":\"2 - ABELHAS\"},\"ve\":\"(FE) Fezes\",\"ni\":\"(BX) Baixo\",\"te\":\"11 - ISCAGEM\"},{\"ambiente\":\"sd\",\"ep\":{\"nome\":\"2 - ABELHAS\"},\"ve\":\"(FE) Fezes\",\"ni\":\"(BX) Baixo\",\"te\":\"11 - ISCAGEM\"},{\"ambiente\":\"sd\",\"ep\":{\"nome\":\"2 - ABELHAS\"},\"ve\":\"(FE) Fezes\",\"ni\":\"(BX) Baixo\",\"te\":\"11 - ISCAGEM\"}]', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '[{\"id\":\"144-1387792663756\",\"tipo_dispositivo\":\"ppe\",\"num\":\"1\",\"descricao\":\"Portu00e3o da frente\",\"local\":\"Portu00e3o da frente\",\"dispositivo\":\"asdfasdf\",\"status\":\"1\"},{\"id\":\"144-1387792673756\",\"tipo_dispositivo\":\"ppe\",\"num\":\"2\",\"descricao\":\"Portu00e3o da frente\",\"local\":\"Portu00e3o da frente 2\",\"dispositivo\":\"asdfadf\",\"status\":\"1\"},{\"id\":\"144-1387792684100\",\"tipo_dispositivo\":\"ppe\",\"num\":\"3\",\"descricao\":\"Portu00e3o da frente\",\"local\":\"Portu00e3o da frente 3\",\"dispositivo\":\"sdfasdf\",\"status\":\"1\"},{\"id\":\"144-1387792692756\",\"tipo_dispositivo\":\"ppe\",\"num\":\"4\",\"descricao\":\"Portu00e3o da frente sdfasdf\",\"local\":\"Portu00e3o da frente 4\",\"dispositivo\":\"adfasdf\",\"status\":\"1\"},{\"id\":\"144-1387792737799\",\"tipo_dispositivo\":\"ppi\",\"num\":\"1\",\"descricao\":\"Salão produção\",\"local\":\"Salão produção\",\"dispositivo\":\"Salão produção\",\"status\":\"1\"},{\"id\":\"144-1387792744034\",\"tipo_dispositivo\":\"ppi\",\"num\":\"2\",\"descricao\":\"Salão produção\",\"local\":\"Salão produção\",\"dispositivo\":\"wewrwer\",\"status\":\"1\"},{\"id\":\"144-1387792751284\",\"tipo_dispositivo\":\"ppi\",\"num\":\"3\",\"descricao\":\"asdfasdf asdf\",\"local\":\"Salão produção\",\"dispositivo\":\"asdf asdf asdf \",\"status\":\"1\"},{\"id\":\"144-1387792760456\",\"tipo_dispositivo\":\"ppi\",\"num\":\"4\",\"descricao\":\"asdfasdf\",\"local\":\"Salão produção\",\"dispositivo\":\"sdfasdasdfad\",\"status\":\"1\"}]', 0),
(149, 144, 23, '2014-05-07', '15:00', '01:00', 'Rafael', 'Ag. Jonatas', 4, 0, 68, 1001, '[{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '[{\"ambiente\":\"sd\",\"ep\":{\"nome\":\"2 - ABELHAS\"},\"ve\":\"(FE) Fezes\",\"ni\":\"(BX) Baixo\",\"te\":\"11 - ISCAGEM\"},{\"ambiente\":\"sd\",\"ep\":{\"nome\":\"2 - ABELHAS\"},\"ve\":\"(FE) Fezes\",\"ni\":\"(BX) Baixo\",\"te\":\"11 - ISCAGEM\"},{\"ambiente\":\"sd\",\"ep\":{\"nome\":\"2 - ABELHAS\"},\"ve\":\"(FE) Fezes\",\"ni\":\"(BX) Baixo\",\"te\":\"11 - ISCAGEM\"},{\"ambiente\":\"sd\",\"ep\":{\"nome\":\"2 - ABELHAS\"},\"ve\":\"(FE) Fezes\",\"ni\":\"(BX) Baixo\",\"te\":\"11 - ISCAGEM\"},{\"ambiente\":\"sd\",\"ep\":{\"nome\":\"2 - ABELHAS\"},\"ve\":\"(FE) Fezes\",\"ni\":\"(BX) Baixo\",\"te\":\"11 - ISCAGEM\"}]', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '[{\"id\":\"144-1387792663756\",\"tipo_dispositivo\":\"ppe\",\"num\":\"1\",\"descricao\":\"Portu00e3o da frente\",\"local\":\"Portu00e3o da frente\",\"dispositivo\":\"asdfasdf\",\"status\":\"1\"},{\"id\":\"144-1387792673756\",\"tipo_dispositivo\":\"ppe\",\"num\":\"2\",\"descricao\":\"Portu00e3o da frente\",\"local\":\"Portu00e3o da frente 2\",\"dispositivo\":\"asdfadf\",\"status\":\"1\"},{\"id\":\"144-1387792684100\",\"tipo_dispositivo\":\"ppe\",\"num\":\"3\",\"descricao\":\"Portu00e3o da frente\",\"local\":\"Portu00e3o da frente 3\",\"dispositivo\":\"sdfasdf\",\"status\":\"1\"},{\"id\":\"144-1387792692756\",\"tipo_dispositivo\":\"ppe\",\"num\":\"4\",\"descricao\":\"Portu00e3o da frente sdfasdf\",\"local\":\"Portu00e3o da frente 4\",\"dispositivo\":\"adfasdf\",\"status\":\"1\"},{\"id\":\"144-1387792737799\",\"tipo_dispositivo\":\"ppi\",\"num\":\"1\",\"descricao\":\"Salão produção\",\"local\":\"Salão produção\",\"dispositivo\":\"Salão produção\",\"status\":\"1\"},{\"id\":\"144-1387792744034\",\"tipo_dispositivo\":\"ppi\",\"num\":\"2\",\"descricao\":\"Salão produção\",\"local\":\"Salão produção\",\"dispositivo\":\"wewrwer\",\"status\":\"1\"},{\"id\":\"144-1387792751284\",\"tipo_dispositivo\":\"ppi\",\"num\":\"3\",\"descricao\":\"asdfasdf asdf\",\"local\":\"Salão produção\",\"dispositivo\":\"asdf asdf asdf \",\"status\":\"1\"},{\"id\":\"144-1387792760456\",\"tipo_dispositivo\":\"ppi\",\"num\":\"4\",\"descricao\":\"asdfasdf\",\"local\":\"Salão produção\",\"dispositivo\":\"sdfasdasdfad\",\"status\":\"1\"}]', 0),
(150, 144, 23, '2014-06-04', '14:00', '01:00', 'Rafael', 'Ag. Jonatas', 4, 0, 68, 1001, '[{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '[{\"ambiente\":\"sd\",\"ep\":{\"nome\":\"2 - ABELHAS\"},\"ve\":\"(FE) Fezes\",\"ni\":\"(BX) Baixo\",\"te\":\"11 - ISCAGEM\"},{\"ambiente\":\"sd\",\"ep\":{\"nome\":\"2 - ABELHAS\"},\"ve\":\"(FE) Fezes\",\"ni\":\"(BX) Baixo\",\"te\":\"11 - ISCAGEM\"},{\"ambiente\":\"sd\",\"ep\":{\"nome\":\"2 - ABELHAS\"},\"ve\":\"(FE) Fezes\",\"ni\":\"(BX) Baixo\",\"te\":\"11 - ISCAGEM\"},{\"ambiente\":\"sd\",\"ep\":{\"nome\":\"2 - ABELHAS\"},\"ve\":\"(FE) Fezes\",\"ni\":\"(BX) Baixo\",\"te\":\"11 - ISCAGEM\"},{\"ambiente\":\"sd\",\"ep\":{\"nome\":\"2 - ABELHAS\"},\"ve\":\"(FE) Fezes\",\"ni\":\"(BX) Baixo\",\"te\":\"11 - ISCAGEM\"}]', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '[{\"id\":\"144-1387792663756\",\"tipo_dispositivo\":\"ppe\",\"num\":\"1\",\"descricao\":\"Portu00e3o da frente\",\"local\":\"Portu00e3o da frente\",\"dispositivo\":\"asdfasdf\",\"status\":\"1\"},{\"id\":\"144-1387792673756\",\"tipo_dispositivo\":\"ppe\",\"num\":\"2\",\"descricao\":\"Portu00e3o da frente\",\"local\":\"Portu00e3o da frente 2\",\"dispositivo\":\"asdfadf\",\"status\":\"1\"},{\"id\":\"144-1387792684100\",\"tipo_dispositivo\":\"ppe\",\"num\":\"3\",\"descricao\":\"Portu00e3o da frente\",\"local\":\"Portu00e3o da frente 3\",\"dispositivo\":\"sdfasdf\",\"status\":\"1\"},{\"id\":\"144-1387792692756\",\"tipo_dispositivo\":\"ppe\",\"num\":\"4\",\"descricao\":\"Portu00e3o da frente sdfasdf\",\"local\":\"Portu00e3o da frente 4\",\"dispositivo\":\"adfasdf\",\"status\":\"1\"},{\"id\":\"144-1387792737799\",\"tipo_dispositivo\":\"ppi\",\"num\":\"1\",\"descricao\":\"Salão produção\",\"local\":\"Salão produção\",\"dispositivo\":\"Salão produção\",\"status\":\"1\"},{\"id\":\"144-1387792744034\",\"tipo_dispositivo\":\"ppi\",\"num\":\"2\",\"descricao\":\"Salão produção\",\"local\":\"Salão produção\",\"dispositivo\":\"wewrwer\",\"status\":\"1\"},{\"id\":\"144-1387792751284\",\"tipo_dispositivo\":\"ppi\",\"num\":\"3\",\"descricao\":\"asdfasdf asdf\",\"local\":\"Salão produção\",\"dispositivo\":\"asdf asdf asdf \",\"status\":\"1\"},{\"id\":\"144-1387792760456\",\"tipo_dispositivo\":\"ppi\",\"num\":\"4\",\"descricao\":\"asdfasdf\",\"local\":\"Salão produção\",\"dispositivo\":\"sdfasdasdfad\",\"status\":\"1\"}]', 0),
(151, 144, 23, '2014-07-02', '15:00', '01:00', 'Rafael', 'Ag. Jonatas', 4, 0, 68, 1001, '[{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '[{\"ambiente\":\"sd\",\"ep\":{\"nome\":\"2 - ABELHAS\"},\"ve\":\"(FE) Fezes\",\"ni\":\"(BX) Baixo\",\"te\":\"11 - ISCAGEM\"},{\"ambiente\":\"sd\",\"ep\":{\"nome\":\"2 - ABELHAS\"},\"ve\":\"(FE) Fezes\",\"ni\":\"(BX) Baixo\",\"te\":\"11 - ISCAGEM\"},{\"ambiente\":\"sd\",\"ep\":{\"nome\":\"2 - ABELHAS\"},\"ve\":\"(FE) Fezes\",\"ni\":\"(BX) Baixo\",\"te\":\"11 - ISCAGEM\"},{\"ambiente\":\"sd\",\"ep\":{\"nome\":\"2 - ABELHAS\"},\"ve\":\"(FE) Fezes\",\"ni\":\"(BX) Baixo\",\"te\":\"11 - ISCAGEM\"},{\"ambiente\":\"sd\",\"ep\":{\"nome\":\"2 - ABELHAS\"},\"ve\":\"(FE) Fezes\",\"ni\":\"(BX) Baixo\",\"te\":\"11 - ISCAGEM\"}]', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '[{\"id\":\"144-1387792663756\",\"tipo_dispositivo\":\"ppe\",\"num\":\"1\",\"descricao\":\"Portu00e3o da frente\",\"local\":\"Portu00e3o da frente\",\"dispositivo\":\"asdfasdf\",\"status\":\"1\"},{\"id\":\"144-1387792673756\",\"tipo_dispositivo\":\"ppe\",\"num\":\"2\",\"descricao\":\"Portu00e3o da frente\",\"local\":\"Portu00e3o da frente 2\",\"dispositivo\":\"asdfadf\",\"status\":\"1\"},{\"id\":\"144-1387792684100\",\"tipo_dispositivo\":\"ppe\",\"num\":\"3\",\"descricao\":\"Portu00e3o da frente\",\"local\":\"Portu00e3o da frente 3\",\"dispositivo\":\"sdfasdf\",\"status\":\"1\"},{\"id\":\"144-1387792692756\",\"tipo_dispositivo\":\"ppe\",\"num\":\"4\",\"descricao\":\"Portu00e3o da frente sdfasdf\",\"local\":\"Portu00e3o da frente 4\",\"dispositivo\":\"adfasdf\",\"status\":\"1\"},{\"id\":\"144-1387792737799\",\"tipo_dispositivo\":\"ppi\",\"num\":\"1\",\"descricao\":\"Salão produção\",\"local\":\"Salão produção\",\"dispositivo\":\"Salão produção\",\"status\":\"1\"},{\"id\":\"144-1387792744034\",\"tipo_dispositivo\":\"ppi\",\"num\":\"2\",\"descricao\":\"Salão produção\",\"local\":\"Salão produção\",\"dispositivo\":\"wewrwer\",\"status\":\"1\"},{\"id\":\"144-1387792751284\",\"tipo_dispositivo\":\"ppi\",\"num\":\"3\",\"descricao\":\"asdfasdf asdf\",\"local\":\"Salão produção\",\"dispositivo\":\"asdf asdf asdf \",\"status\":\"1\"},{\"id\":\"144-1387792760456\",\"tipo_dispositivo\":\"ppi\",\"num\":\"4\",\"descricao\":\"asdfasdf\",\"local\":\"Salão produção\",\"dispositivo\":\"sdfasdasdfad\",\"status\":\"1\"}]', 0),
(152, 144, 23, '2014-08-06', '15:00', '01:00', 'Rafael', 'Ag. Jonatas', 4, 0, 68, 1001, '[{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '[{\"ambiente\":\"sd\",\"ep\":{\"nome\":\"2 - ABELHAS\"},\"ve\":\"(FE) Fezes\",\"ni\":\"(BX) Baixo\",\"te\":\"11 - ISCAGEM\"},{\"ambiente\":\"sd\",\"ep\":{\"nome\":\"2 - ABELHAS\"},\"ve\":\"(FE) Fezes\",\"ni\":\"(BX) Baixo\",\"te\":\"11 - ISCAGEM\"},{\"ambiente\":\"sd\",\"ep\":{\"nome\":\"2 - ABELHAS\"},\"ve\":\"(FE) Fezes\",\"ni\":\"(BX) Baixo\",\"te\":\"11 - ISCAGEM\"},{\"ambiente\":\"sd\",\"ep\":{\"nome\":\"2 - ABELHAS\"},\"ve\":\"(FE) Fezes\",\"ni\":\"(BX) Baixo\",\"te\":\"11 - ISCAGEM\"},{\"ambiente\":\"sd\",\"ep\":{\"nome\":\"2 - ABELHAS\"},\"ve\":\"(FE) Fezes\",\"ni\":\"(BX) Baixo\",\"te\":\"11 - ISCAGEM\"}]', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '[{\"id\":\"144-1387792663756\",\"tipo_dispositivo\":\"ppe\",\"num\":\"1\",\"descricao\":\"Portu00e3o da frente\",\"local\":\"Portu00e3o da frente\",\"dispositivo\":\"asdfasdf\",\"status\":\"1\"},{\"id\":\"144-1387792673756\",\"tipo_dispositivo\":\"ppe\",\"num\":\"2\",\"descricao\":\"Portu00e3o da frente\",\"local\":\"Portu00e3o da frente 2\",\"dispositivo\":\"asdfadf\",\"status\":\"1\"},{\"id\":\"144-1387792684100\",\"tipo_dispositivo\":\"ppe\",\"num\":\"3\",\"descricao\":\"Portu00e3o da frente\",\"local\":\"Portu00e3o da frente 3\",\"dispositivo\":\"sdfasdf\",\"status\":\"1\"},{\"id\":\"144-1387792692756\",\"tipo_dispositivo\":\"ppe\",\"num\":\"4\",\"descricao\":\"Portu00e3o da frente sdfasdf\",\"local\":\"Portu00e3o da frente 4\",\"dispositivo\":\"adfasdf\",\"status\":\"1\"},{\"id\":\"144-1387792737799\",\"tipo_dispositivo\":\"ppi\",\"num\":\"1\",\"descricao\":\"Salão produção\",\"local\":\"Salão produção\",\"dispositivo\":\"Salão produção\",\"status\":\"1\"},{\"id\":\"144-1387792744034\",\"tipo_dispositivo\":\"ppi\",\"num\":\"2\",\"descricao\":\"Salão produção\",\"local\":\"Salão produção\",\"dispositivo\":\"wewrwer\",\"status\":\"1\"},{\"id\":\"144-1387792751284\",\"tipo_dispositivo\":\"ppi\",\"num\":\"3\",\"descricao\":\"asdfasdf asdf\",\"local\":\"Salão produção\",\"dispositivo\":\"asdf asdf asdf \",\"status\":\"1\"},{\"id\":\"144-1387792760456\",\"tipo_dispositivo\":\"ppi\",\"num\":\"4\",\"descricao\":\"asdfasdf\",\"local\":\"Salão produção\",\"dispositivo\":\"sdfasdasdfad\",\"status\":\"1\"}]', 0),
(282, 260, 23, '2014-08-06', '00:00', '01:00', 'Rafael', 'Ag. Jonatas', 4, 0, 68, 1001, '[{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '[{\r\n                                \"ambiente\":\"\",\r\n                                \"ep\":{\"nome\":\"0\"},\r\n                                \"ve\":\"0\",\r\n                                \"ni\":\"\",\r\n                                \"te\":\"\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           }]', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '[{\"id\":\"260-1387743226455\",\"tipo_dispositivo\":\"ppe\",\"num\":\"dfs\",\"descricao\":\" asdfasdf\",\"local\":\"sdfas\",\"dispositivo\":\"asdfasdf\",\"status\":\"1\"},{\"id\":\"260-1387743238455\",\"tipo_dispositivo\":\"ppi\",\"num\":\"sadasd\",\"descricao\":\"asdf asdf \",\"local\":\"asdfasdf\",\"dispositivo\":\"sadfasdf \",\"status\":\"1\"},{\"id\":\"260-1387743263961\",\"tipo_dispositivo\":\"luminosa\",\"num\":\"sadf asdf\",\"descricao\":\" asdf asdf asdf \",\"local\":\"sadf asdf\",\"dispositivo\":\"asdf asdf asdf \",\"status\":\"1\"},{\"id\":\"262-1387743998547\",\"tipo_dispositivo\":\"ppe\",\"num\":\"asdf\",\"descricao\":\"asdf asdf asdf \",\"local\":\"sadfasdf\",\"dispositivo\":\"asdfasdasdf\",\"status\":\"1\"}]', 0),
(283, 260, 23, '2014-08-20', '00:00', '01:00', 'Rafael', 'Ag. Jonatas', 4, 0, 68, 1001, '[{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '[{\r\n                                \"ambiente\":\"\",\r\n                                \"ep\":{\"nome\":\"0\"},\r\n                                \"ve\":\"0\",\r\n                                \"ni\":\"\",\r\n                                \"te\":\"\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           }]', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '[{\"id\":\"260-1387743226455\",\"tipo_dispositivo\":\"ppe\",\"num\":\"dfs\",\"descricao\":\" asdfasdf\",\"local\":\"sdfas\",\"dispositivo\":\"asdfasdf\",\"status\":\"1\"},{\"id\":\"260-1387743238455\",\"tipo_dispositivo\":\"ppi\",\"num\":\"sadasd\",\"descricao\":\"asdf asdf \",\"local\":\"asdfasdf\",\"dispositivo\":\"sadfasdf \",\"status\":\"1\"},{\"id\":\"260-1387743263961\",\"tipo_dispositivo\":\"luminosa\",\"num\":\"sadf asdf\",\"descricao\":\" asdf asdf asdf \",\"local\":\"sadf asdf\",\"dispositivo\":\"asdf asdf asdf \",\"status\":\"1\"},{\"id\":\"262-1387743998547\",\"tipo_dispositivo\":\"ppe\",\"num\":\"asdf\",\"descricao\":\"asdf asdf asdf \",\"local\":\"sadfasdf\",\"dispositivo\":\"asdfasdasdf\",\"status\":\"1\"}]', 0),
(281, 260, 23, '2014-07-23', '00:00', '01:00', 'Rafael', 'Ag. Jonatas', 4, 0, 68, 1001, '[{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '[{\r\n                                \"ambiente\":\"\",\r\n                                \"ep\":{\"nome\":\"0\"},\r\n                                \"ve\":\"0\",\r\n                                \"ni\":\"\",\r\n                                \"te\":\"\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           }]', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '[{\"id\":\"260-1387743226455\",\"tipo_dispositivo\":\"ppe\",\"num\":\"dfs\",\"descricao\":\" asdfasdf\",\"local\":\"sdfas\",\"dispositivo\":\"asdfasdf\",\"status\":\"1\"},{\"id\":\"260-1387743238455\",\"tipo_dispositivo\":\"ppi\",\"num\":\"sadasd\",\"descricao\":\"asdf asdf \",\"local\":\"asdfasdf\",\"dispositivo\":\"sadfasdf \",\"status\":\"1\"},{\"id\":\"260-1387743263961\",\"tipo_dispositivo\":\"luminosa\",\"num\":\"sadf asdf\",\"descricao\":\" asdf asdf asdf \",\"local\":\"sadf asdf\",\"dispositivo\":\"asdf asdf asdf \",\"status\":\"1\"},{\"id\":\"262-1387743998547\",\"tipo_dispositivo\":\"ppe\",\"num\":\"asdf\",\"descricao\":\"asdf asdf asdf \",\"local\":\"sadfasdf\",\"dispositivo\":\"asdfasdasdf\",\"status\":\"1\"}]', 0),
(279, 260, 23, '2014-06-25', '00:00', '01:00', 'Rafael', 'Ag. Jonatas', 4, 0, 68, 1001, '[{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '[{\r\n                                \"ambiente\":\"\",\r\n                                \"ep\":{\"nome\":\"0\"},\r\n                                \"ve\":\"0\",\r\n                                \"ni\":\"\",\r\n                                \"te\":\"\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           }]', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '[{\"id\":\"260-1387743226455\",\"tipo_dispositivo\":\"ppe\",\"num\":\"dfs\",\"descricao\":\" asdfasdf\",\"local\":\"sdfas\",\"dispositivo\":\"asdfasdf\",\"status\":\"1\"},{\"id\":\"260-1387743238455\",\"tipo_dispositivo\":\"ppi\",\"num\":\"sadasd\",\"descricao\":\"asdf asdf \",\"local\":\"asdfasdf\",\"dispositivo\":\"sadfasdf \",\"status\":\"1\"},{\"id\":\"260-1387743263961\",\"tipo_dispositivo\":\"luminosa\",\"num\":\"sadf asdf\",\"descricao\":\" asdf asdf asdf \",\"local\":\"sadf asdf\",\"dispositivo\":\"asdf asdf asdf \",\"status\":\"1\"},{\"id\":\"262-1387743998547\",\"tipo_dispositivo\":\"ppe\",\"num\":\"asdf\",\"descricao\":\"asdf asdf asdf \",\"local\":\"sadfasdf\",\"dispositivo\":\"asdfasdasdf\",\"status\":\"1\"}]', 0),
(280, 260, 23, '2014-07-09', '00:00', '01:00', 'Rafael', 'Ag. Jonatas', 4, 0, 68, 1001, '[{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '[{\r\n                                \"ambiente\":\"\",\r\n                                \"ep\":{\"nome\":\"0\"},\r\n                                \"ve\":\"0\",\r\n                                \"ni\":\"\",\r\n                                \"te\":\"\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           }]', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '[{\"id\":\"260-1387743226455\",\"tipo_dispositivo\":\"ppe\",\"num\":\"dfs\",\"descricao\":\" asdfasdf\",\"local\":\"sdfas\",\"dispositivo\":\"asdfasdf\",\"status\":\"1\"},{\"id\":\"260-1387743238455\",\"tipo_dispositivo\":\"ppi\",\"num\":\"sadasd\",\"descricao\":\"asdf asdf \",\"local\":\"asdfasdf\",\"dispositivo\":\"sadfasdf \",\"status\":\"1\"},{\"id\":\"260-1387743263961\",\"tipo_dispositivo\":\"luminosa\",\"num\":\"sadf asdf\",\"descricao\":\" asdf asdf asdf \",\"local\":\"sadf asdf\",\"dispositivo\":\"asdf asdf asdf \",\"status\":\"1\"},{\"id\":\"262-1387743998547\",\"tipo_dispositivo\":\"ppe\",\"num\":\"asdf\",\"descricao\":\"asdf asdf asdf \",\"local\":\"sadfasdf\",\"dispositivo\":\"asdfasdasdf\",\"status\":\"1\"}]', 0),
(288, 260, 23, '2013-10-02', '00:00', '01:00', 'Rafael', 'Ag. Jonatas', 4, 8, 68, 1001, '[{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '[{\r\n                                \"ambiente\":\"\",\r\n                                \"ep\":{\"nome\":\"0\"},\r\n                                \"ve\":\"0\",\r\n                                \"ni\":\"\",\r\n                                \"te\":\"\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           }]', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '[{\"id\":\"260-1387743226455\",\"tipo_dispositivo\":\"ppe\",\"num\":\"dfs\",\"descricao\":\" asdfasdf\",\"local\":\"sdfas\",\"dispositivo\":\"asdfasdf\",\"status\":\"1\"},{\"id\":\"260-1387743238455\",\"tipo_dispositivo\":\"ppi\",\"num\":\"sadasd\",\"descricao\":\"asdf asdf \",\"local\":\"asdfasdf\",\"dispositivo\":\"sadfasdf \",\"status\":\"1\"},{\"id\":\"260-1387743263961\",\"tipo_dispositivo\":\"luminosa\",\"num\":\"sadf asdf\",\"descricao\":\" asdf asdf asdf \",\"local\":\"sadf asdf\",\"dispositivo\":\"asdf asdf asdf \",\"status\":\"1\"}]', 0),
(286, 260, 23, '2014-03-26', '00:00', '01:00', 'Rafael', 'Ag. Jonatas', 4, 14, 68, 1001, '[{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '[{\r\n                                \"ambiente\":\"\",\r\n                                \"ep\":{\"nome\":\"0\"},\r\n                                \"ve\":\"0\",\r\n                                \"ni\":\"\",\r\n                                \"te\":\"\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           }]', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '[{\"id\":\"260-1387743226455\",\"tipo_dispositivo\":\"ppe\",\"num\":\"dfs\",\"descricao\":\" asdfasdf\",\"local\":\"sdfas\",\"dispositivo\":\"asdfasdf\",\"status\":\"1\"},{\"id\":\"260-1387743238455\",\"tipo_dispositivo\":\"ppi\",\"num\":\"sadasd\",\"descricao\":\"asdf asdf \",\"local\":\"asdfasdf\",\"dispositivo\":\"sadfasdf \",\"status\":\"1\"},{\"id\":\"260-1387743263961\",\"tipo_dispositivo\":\"luminosa\",\"num\":\"sadf asdf\",\"descricao\":\" asdf asdf asdf \",\"local\":\"sadf asdf\",\"dispositivo\":\"asdf asdf asdf \",\"status\":\"1\"},{\"id\":\"262-1387743998547\",\"tipo_dispositivo\":\"ppe\",\"num\":\"asdf\",\"descricao\":\"asdf asdf asdf \",\"local\":\"sadfasdf\",\"dispositivo\":\"asdfasdasdf\",\"status\":\"1\"}]', 0);
INSERT INTO `ordem_servico` (`ORD_id`, `id_pai`, `ORC_id`, `ORD_data_visita`, `ORD_hora_visita`, `ORD_duracao_visita`, `ORD_aguardando`, `ORD_agendado`, `ORD_tipo_visita`, `ORD_atividade`, `EQU_id`, `VEI_id`, `ORD_defensivos`, `ORD_detalhes_tratamento`, `ORD_partida`, `ORD_chegada`, `ORD_chegada_hora`, `ORD_inicio_servico`, `ORD_km_partida`, `ORD_km_chegada`, `ORD_termino`, `ORD_termino_hora`, `ORD_acompanhado_por`, `ORD_obs`, `ORD_pontos`, `ORD_status`) VALUES
(287, 260, 23, '2014-06-18', '00:00', '01:00', 'Rafael', 'Ag. Jonatas', 4, 14, 68, 1001, '[{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '[{\r\n                                \"ambiente\":\"\",\r\n                                \"ep\":{\"nome\":\"0\"},\r\n                                \"ve\":\"0\",\r\n                                \"ni\":\"\",\r\n                                \"te\":\"\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           }]', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '[{\"id\":\"260-1387743226455\",\"tipo_dispositivo\":\"ppe\",\"num\":\"dfs\",\"descricao\":\" asdfasdf\",\"local\":\"sdfas\",\"dispositivo\":\"asdfasdf\",\"status\":\"1\"},{\"id\":\"260-1387743238455\",\"tipo_dispositivo\":\"ppi\",\"num\":\"sadasd\",\"descricao\":\"asdf asdf \",\"local\":\"asdfasdf\",\"dispositivo\":\"sadfasdf \",\"status\":\"1\"},{\"id\":\"260-1387743263961\",\"tipo_dispositivo\":\"luminosa\",\"num\":\"sadf asdf\",\"descricao\":\" asdf asdf asdf \",\"local\":\"sadf asdf\",\"dispositivo\":\"asdf asdf asdf \",\"status\":\"1\"},{\"id\":\"262-1387743998547\",\"tipo_dispositivo\":\"ppe\",\"num\":\"asdf\",\"descricao\":\"asdf asdf asdf \",\"local\":\"sadfasdf\",\"dispositivo\":\"asdfasdasdf\",\"status\":\"1\"}]', 0),
(285, 260, 23, '2013-12-25', '00:00', '01:00', 'Rafael', 'Ag. Jonatas', 4, 14, 68, 1001, '[{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '[{\r\n                                \"ambiente\":\"\",\r\n                                \"ep\":{\"nome\":\"0\"},\r\n                                \"ve\":\"0\",\r\n                                \"ni\":\"\",\r\n                                \"te\":\"\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           }]', '13:30', '2013-12-25', '14:30', '14:30', '654654', '54654', '2013-12-25', '15:30', 'dfdsf', ' dfsdfsdf', '[{\"id\":\"260-1387743226455\",\"tipo_dispositivo\":\"ppe\",\"num\":\"dfs\",\"descricao\":\" asdfasdf\",\"local\":\"sdfas\",\"dispositivo\":\"asdfasdf\",\"status\":\"1\"},{\"id\":\"260-1387743238455\",\"tipo_dispositivo\":\"ppi\",\"num\":\"sadasd\",\"descricao\":\"asdf asdf \",\"local\":\"asdfasdf\",\"dispositivo\":\"sadfasdf \",\"status\":\"1\"},{\"id\":\"260-1387743263961\",\"tipo_dispositivo\":\"luminosa\",\"num\":\"sadf asdf\",\"descricao\":\" asdf asdf asdf \",\"local\":\"sadf asdf\",\"dispositivo\":\"asdf asdf asdf \",\"status\":\"1\"},{\"id\":\"262-1387743998547\",\"tipo_dispositivo\":\"ppe\",\"num\":\"asdf\",\"descricao\":\"asdf asdf asdf \",\"local\":\"sadfasdf\",\"dispositivo\":\"asdfasdasdf\",\"status\":\"1\"}]', 1),
(284, 260, 23, '2013-10-02', '00:00', '01:00', 'Rafael', 'Ag. Jonatas', 4, 14, 68, 1001, '[{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '[{\r\n                                \"ambiente\":\"\",\r\n                                \"ep\":{\"nome\":\"0\"},\r\n                                \"ve\":\"0\",\r\n                                \"ni\":\"\",\r\n                                \"te\":\"\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           }]', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '[{\"id\":\"260-1387743226455\",\"tipo_dispositivo\":\"ppe\",\"num\":\"dfs\",\"descricao\":\" asdfasdf\",\"local\":\"sdfas\",\"dispositivo\":\"asdfasdf\",\"status\":\"1\"},{\"id\":\"260-1387743238455\",\"tipo_dispositivo\":\"ppi\",\"num\":\"sadasd\",\"descricao\":\"asdf asdf \",\"local\":\"asdfasdf\",\"dispositivo\":\"sadfasdf \",\"status\":\"1\"},{\"id\":\"260-1387743263961\",\"tipo_dispositivo\":\"luminosa\",\"num\":\"sadf asdf\",\"descricao\":\" asdf asdf asdf \",\"local\":\"sadf asdf\",\"dispositivo\":\"asdf asdf asdf \",\"status\":\"1\"}]', 0),
(265, 260, 23, '2013-12-11', '00:00', '01:00', 'Rafael', 'Ag. Jonatas', 4, 0, 68, 1001, '[{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '[{\r\n                                \"ambiente\":\"\",\r\n                                \"ep\":{\"nome\":\"0\"},\r\n                                \"ve\":\"0\",\r\n                                \"ni\":\"\",\r\n                                \"te\":\"\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           }]', '15:00', '2013-12-11', '16:00', '16:30', '234234234', '234234', '2013-12-11', '17:00', 'wdasdfasd', ' fasdf asdf asfasdfasdf', '[{\"id\":\"260-1387743226455\",\"tipo_dispositivo\":\"ppe\",\"num\":\"dfs\",\"descricao\":\" asdfasdf\",\"local\":\"sdfas\",\"dispositivo\":\"asdfasdf\",\"status\":\"1\"},{\"id\":\"260-1387743238455\",\"tipo_dispositivo\":\"ppi\",\"num\":\"sadasd\",\"descricao\":\"asdf asdf \",\"local\":\"asdfasdf\",\"dispositivo\":\"sadfasdf \",\"status\":\"1\"},{\"id\":\"260-1387743263961\",\"tipo_dispositivo\":\"luminosa\",\"num\":\"sadf asdf\",\"descricao\":\" asdf asdf asdf \",\"local\":\"sadf asdf\",\"dispositivo\":\"asdf asdf asdf \",\"status\":\"1\"},{\"id\":\"262-1387743998547\",\"tipo_dispositivo\":\"ppe\",\"num\":\"asdf\",\"descricao\":\"asdf asdf asdf \",\"local\":\"sadfasdf\",\"dispositivo\":\"asdfasdasdf\",\"status\":\"1\"}]', 1),
(262, 260, 23, '2013-10-30', '00:00', '01:00', 'Rafael', 'Ag. Jonatas', 4, 0, 68, 1001, '[{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '[{\r\n                                \"ambiente\":\"\",\r\n                                \"ep\":{\"nome\":\"0\"},\r\n                                \"ve\":\"0\",\r\n                                \"ni\":\"\",\r\n                                \"te\":\"\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           }]', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '[{\"id\":\"260-1387743226455\",\"tipo_dispositivo\":\"ppe\",\"num\":\"dfs\",\"descricao\":\" asdfasdf\",\"local\":\"sdfas\",\"dispositivo\":\"asdfasdf\",\"status\":\"1\"},{\"id\":\"260-1387743238455\",\"tipo_dispositivo\":\"ppi\",\"num\":\"sadasd\",\"descricao\":\"asdf asdf \",\"local\":\"asdfasdf\",\"dispositivo\":\"sadfasdf \",\"status\":\"1\"},{\"id\":\"260-1387743263961\",\"tipo_dispositivo\":\"luminosa\",\"num\":\"sadf asdf\",\"descricao\":\" asdf asdf asdf \",\"local\":\"sadf asdf\",\"dispositivo\":\"asdf asdf asdf \",\"status\":\"1\"},{\"id\":\"262-1387743998547\",\"tipo_dispositivo\":\"ppe\",\"num\":\"asdf\",\"descricao\":\"asdf asdf asdf \",\"local\":\"sadfasdf\",\"dispositivo\":\"asdfasdasdf\",\"status\":\"1\"}]', 0),
(260, 0, 23, '2013-10-02', '00:00', '01:00', 'Rafael', 'Ag. Jonatas', 0, 0, 68, 1001, '[{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '[{\r\n                                \"ambiente\":\"\",\r\n                                \"ep\":{\"nome\":\"0\"},\r\n                                \"ve\":\"0\",\r\n                                \"ni\":\"\",\r\n                                \"te\":\"\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           }]', '17:30', '2013-12-31', '19:30', '17:30', '23412', '231234', '2013-12-31', '18:30', 'asdf', ' sadf asdf asdf asd f', '[{\"id\":\"260-1387743226455\",\"tipo_dispositivo\":\"ppe\",\"num\":\"dfs\",\"descricao\":\" asdfasdf\",\"local\":\"sdfas\",\"dispositivo\":\"asdfasdf\",\"status\":\"1\"},{\"id\":\"260-1387743238455\",\"tipo_dispositivo\":\"ppi\",\"num\":\"sadasd\",\"descricao\":\"asdf asdf \",\"local\":\"asdfasdf\",\"dispositivo\":\"sadfasdf \",\"status\":\"1\"},{\"id\":\"260-1387743263961\",\"tipo_dispositivo\":\"luminosa\",\"num\":\"sadf asdf\",\"descricao\":\" asdf asdf asdf \",\"local\":\"sadf asdf\",\"dispositivo\":\"asdf asdf asdf \",\"status\":\"1\"}]', 1),
(261, 260, 23, '2013-10-16', '00:00', '01:00', 'Rafael', 'Ag. Jonatas', 4, 0, 68, 1001, '[{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '[{\r\n                                \"ambiente\":\"\",\r\n                                \"ep\":{\"nome\":\"0\"},\r\n                                \"ve\":\"0\",\r\n                                \"ni\":\"\",\r\n                                \"te\":\"\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           }]', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '[{\"id\":\"260-1387743226455\",\"tipo_dispositivo\":\"ppe\",\"num\":\"dfs\",\"descricao\":\" asdfasdf\",\"local\":\"sdfas\",\"dispositivo\":\"asdfasdf\",\"status\":\"1\"},{\"id\":\"260-1387743238455\",\"tipo_dispositivo\":\"ppi\",\"num\":\"sadasd\",\"descricao\":\"asdf asdf \",\"local\":\"asdfasdf\",\"dispositivo\":\"sadfasdf \",\"status\":\"1\"},{\"id\":\"260-1387743263961\",\"tipo_dispositivo\":\"luminosa\",\"num\":\"sadf asdf\",\"descricao\":\" asdf asdf asdf \",\"local\":\"sadf asdf\",\"dispositivo\":\"asdf asdf asdf \",\"status\":\"1\"}]', 0),
(278, 260, 23, '2014-06-11', '00:00', '01:00', 'Rafael', 'Ag. Jonatas', 4, 0, 68, 1001, '[{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '[{\r\n                                \"ambiente\":\"\",\r\n                                \"ep\":{\"nome\":\"0\"},\r\n                                \"ve\":\"0\",\r\n                                \"ni\":\"\",\r\n                                \"te\":\"\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           }]', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '[{\"id\":\"260-1387743226455\",\"tipo_dispositivo\":\"ppe\",\"num\":\"dfs\",\"descricao\":\" asdfasdf\",\"local\":\"sdfas\",\"dispositivo\":\"asdfasdf\",\"status\":\"1\"},{\"id\":\"260-1387743238455\",\"tipo_dispositivo\":\"ppi\",\"num\":\"sadasd\",\"descricao\":\"asdf asdf \",\"local\":\"asdfasdf\",\"dispositivo\":\"sadfasdf \",\"status\":\"1\"},{\"id\":\"260-1387743263961\",\"tipo_dispositivo\":\"luminosa\",\"num\":\"sadf asdf\",\"descricao\":\" asdf asdf asdf \",\"local\":\"sadf asdf\",\"dispositivo\":\"asdf asdf asdf \",\"status\":\"1\"},{\"id\":\"262-1387743998547\",\"tipo_dispositivo\":\"ppe\",\"num\":\"asdf\",\"descricao\":\"asdf asdf asdf \",\"local\":\"sadfasdf\",\"dispositivo\":\"asdfasdasdf\",\"status\":\"1\"}]', 0),
(277, 260, 23, '2014-05-28', '00:00', '01:00', 'Rafael', 'Ag. Jonatas', 4, 0, 68, 1001, '[{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '[{\r\n                                \"ambiente\":\"\",\r\n                                \"ep\":{\"nome\":\"0\"},\r\n                                \"ve\":\"0\",\r\n                                \"ni\":\"\",\r\n                                \"te\":\"\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           }]', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '[{\"id\":\"260-1387743226455\",\"tipo_dispositivo\":\"ppe\",\"num\":\"dfs\",\"descricao\":\" asdfasdf\",\"local\":\"sdfas\",\"dispositivo\":\"asdfasdf\",\"status\":\"1\"},{\"id\":\"260-1387743238455\",\"tipo_dispositivo\":\"ppi\",\"num\":\"sadasd\",\"descricao\":\"asdf asdf \",\"local\":\"asdfasdf\",\"dispositivo\":\"sadfasdf \",\"status\":\"1\"},{\"id\":\"260-1387743263961\",\"tipo_dispositivo\":\"luminosa\",\"num\":\"sadf asdf\",\"descricao\":\" asdf asdf asdf \",\"local\":\"sadf asdf\",\"dispositivo\":\"asdf asdf asdf \",\"status\":\"1\"},{\"id\":\"262-1387743998547\",\"tipo_dispositivo\":\"ppe\",\"num\":\"asdf\",\"descricao\":\"asdf asdf asdf \",\"local\":\"sadfasdf\",\"dispositivo\":\"asdfasdasdf\",\"status\":\"1\"}]', 0),
(276, 260, 23, '2014-05-14', '00:00', '01:00', 'Rafael', 'Ag. Jonatas', 4, 0, 68, 1001, '[{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '[{\r\n                                \"ambiente\":\"\",\r\n                                \"ep\":{\"nome\":\"0\"},\r\n                                \"ve\":\"0\",\r\n                                \"ni\":\"\",\r\n                                \"te\":\"\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           }]', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '[{\"id\":\"260-1387743226455\",\"tipo_dispositivo\":\"ppe\",\"num\":\"dfs\",\"descricao\":\" asdfasdf\",\"local\":\"sdfas\",\"dispositivo\":\"asdfasdf\",\"status\":\"1\"},{\"id\":\"260-1387743238455\",\"tipo_dispositivo\":\"ppi\",\"num\":\"sadasd\",\"descricao\":\"asdf asdf \",\"local\":\"asdfasdf\",\"dispositivo\":\"sadfasdf \",\"status\":\"1\"},{\"id\":\"260-1387743263961\",\"tipo_dispositivo\":\"luminosa\",\"num\":\"sadf asdf\",\"descricao\":\" asdf asdf asdf \",\"local\":\"sadf asdf\",\"dispositivo\":\"asdf asdf asdf \",\"status\":\"1\"},{\"id\":\"262-1387743998547\",\"tipo_dispositivo\":\"ppe\",\"num\":\"asdf\",\"descricao\":\"asdf asdf asdf \",\"local\":\"sadfasdf\",\"dispositivo\":\"asdfasdasdf\",\"status\":\"1\"}]', 0),
(275, 260, 23, '2014-04-30', '00:00', '01:00', 'Rafael', 'Ag. Jonatas', 4, 0, 68, 1001, '[{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '[{\r\n                                \"ambiente\":\"\",\r\n                                \"ep\":{\"nome\":\"0\"},\r\n                                \"ve\":\"0\",\r\n                                \"ni\":\"\",\r\n                                \"te\":\"\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           }]', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '[{\"id\":\"260-1387743226455\",\"tipo_dispositivo\":\"ppe\",\"num\":\"dfs\",\"descricao\":\" asdfasdf\",\"local\":\"sdfas\",\"dispositivo\":\"asdfasdf\",\"status\":\"1\"},{\"id\":\"260-1387743238455\",\"tipo_dispositivo\":\"ppi\",\"num\":\"sadasd\",\"descricao\":\"asdf asdf \",\"local\":\"asdfasdf\",\"dispositivo\":\"sadfasdf \",\"status\":\"1\"},{\"id\":\"260-1387743263961\",\"tipo_dispositivo\":\"luminosa\",\"num\":\"sadf asdf\",\"descricao\":\" asdf asdf asdf \",\"local\":\"sadf asdf\",\"dispositivo\":\"asdf asdf asdf \",\"status\":\"1\"},{\"id\":\"262-1387743998547\",\"tipo_dispositivo\":\"ppe\",\"num\":\"asdf\",\"descricao\":\"asdf asdf asdf \",\"local\":\"sadfasdf\",\"dispositivo\":\"asdfasdasdf\",\"status\":\"1\"}]', 0),
(274, 260, 23, '2014-04-16', '00:00', '01:00', 'Rafael', 'Ag. Jonatas', 4, 0, 68, 1001, '[{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '[{\r\n                                \"ambiente\":\"\",\r\n                                \"ep\":{\"nome\":\"0\"},\r\n                                \"ve\":\"0\",\r\n                                \"ni\":\"\",\r\n                                \"te\":\"\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           }]', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '[{\"id\":\"260-1387743226455\",\"tipo_dispositivo\":\"ppe\",\"num\":\"dfs\",\"descricao\":\" asdfasdf\",\"local\":\"sdfas\",\"dispositivo\":\"asdfasdf\",\"status\":\"1\"},{\"id\":\"260-1387743238455\",\"tipo_dispositivo\":\"ppi\",\"num\":\"sadasd\",\"descricao\":\"asdf asdf \",\"local\":\"asdfasdf\",\"dispositivo\":\"sadfasdf \",\"status\":\"1\"},{\"id\":\"260-1387743263961\",\"tipo_dispositivo\":\"luminosa\",\"num\":\"sadf asdf\",\"descricao\":\" asdf asdf asdf \",\"local\":\"sadf asdf\",\"dispositivo\":\"asdf asdf asdf \",\"status\":\"1\"},{\"id\":\"262-1387743998547\",\"tipo_dispositivo\":\"ppe\",\"num\":\"asdf\",\"descricao\":\"asdf asdf asdf \",\"local\":\"sadfasdf\",\"dispositivo\":\"asdfasdasdf\",\"status\":\"1\"}]', 0),
(273, 260, 23, '2014-04-02', '00:00', '01:00', 'Rafael', 'Ag. Jonatas', 4, 0, 68, 1001, '[{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '[{\r\n                                \"ambiente\":\"\",\r\n                                \"ep\":{\"nome\":\"0\"},\r\n                                \"ve\":\"0\",\r\n                                \"ni\":\"\",\r\n                                \"te\":\"\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           }]', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '[{\"id\":\"260-1387743226455\",\"tipo_dispositivo\":\"ppe\",\"num\":\"dfs\",\"descricao\":\" asdfasdf\",\"local\":\"sdfas\",\"dispositivo\":\"asdfasdf\",\"status\":\"1\"},{\"id\":\"260-1387743238455\",\"tipo_dispositivo\":\"ppi\",\"num\":\"sadasd\",\"descricao\":\"asdf asdf \",\"local\":\"asdfasdf\",\"dispositivo\":\"sadfasdf \",\"status\":\"1\"},{\"id\":\"260-1387743263961\",\"tipo_dispositivo\":\"luminosa\",\"num\":\"sadf asdf\",\"descricao\":\" asdf asdf asdf \",\"local\":\"sadf asdf\",\"dispositivo\":\"asdf asdf asdf \",\"status\":\"1\"},{\"id\":\"262-1387743998547\",\"tipo_dispositivo\":\"ppe\",\"num\":\"asdf\",\"descricao\":\"asdf asdf asdf \",\"local\":\"sadfasdf\",\"dispositivo\":\"asdfasdasdf\",\"status\":\"1\"}]', 0),
(271, 260, 23, '2014-03-05', '00:00', '01:00', 'Rafael', 'Ag. Jonatas', 4, 0, 68, 1001, '[{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '[{\r\n                                \"ambiente\":\"\",\r\n                                \"ep\":{\"nome\":\"0\"},\r\n                                \"ve\":\"0\",\r\n                                \"ni\":\"\",\r\n                                \"te\":\"\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           }]', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '[{\"id\":\"260-1387743226455\",\"tipo_dispositivo\":\"ppe\",\"num\":\"dfs\",\"descricao\":\" asdfasdf\",\"local\":\"sdfas\",\"dispositivo\":\"asdfasdf\",\"status\":\"1\"},{\"id\":\"260-1387743238455\",\"tipo_dispositivo\":\"ppi\",\"num\":\"sadasd\",\"descricao\":\"asdf asdf \",\"local\":\"asdfasdf\",\"dispositivo\":\"sadfasdf \",\"status\":\"1\"},{\"id\":\"260-1387743263961\",\"tipo_dispositivo\":\"luminosa\",\"num\":\"sadf asdf\",\"descricao\":\" asdf asdf asdf \",\"local\":\"sadf asdf\",\"dispositivo\":\"asdf asdf asdf \",\"status\":\"1\"},{\"id\":\"262-1387743998547\",\"tipo_dispositivo\":\"ppe\",\"num\":\"asdf\",\"descricao\":\"asdf asdf asdf \",\"local\":\"sadfasdf\",\"dispositivo\":\"asdfasdasdf\",\"status\":\"1\"}]', 0),
(272, 260, 23, '2014-03-19', '00:00', '01:00', 'Rafael', 'Ag. Jonatas', 4, 0, 68, 1001, '[{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '[{\r\n                                \"ambiente\":\"\",\r\n                                \"ep\":{\"nome\":\"0\"},\r\n                                \"ve\":\"0\",\r\n                                \"ni\":\"\",\r\n                                \"te\":\"\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           }]', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '[{\"id\":\"260-1387743226455\",\"tipo_dispositivo\":\"ppe\",\"num\":\"dfs\",\"descricao\":\" asdfasdf\",\"local\":\"sdfas\",\"dispositivo\":\"asdfasdf\",\"status\":\"1\"},{\"id\":\"260-1387743238455\",\"tipo_dispositivo\":\"ppi\",\"num\":\"sadasd\",\"descricao\":\"asdf asdf \",\"local\":\"asdfasdf\",\"dispositivo\":\"sadfasdf \",\"status\":\"1\"},{\"id\":\"260-1387743263961\",\"tipo_dispositivo\":\"luminosa\",\"num\":\"sadf asdf\",\"descricao\":\" asdf asdf asdf \",\"local\":\"sadf asdf\",\"dispositivo\":\"asdf asdf asdf \",\"status\":\"1\"},{\"id\":\"262-1387743998547\",\"tipo_dispositivo\":\"ppe\",\"num\":\"asdf\",\"descricao\":\"asdf asdf asdf \",\"local\":\"sadfasdf\",\"dispositivo\":\"asdfasdasdf\",\"status\":\"1\"}]', 0);
INSERT INTO `ordem_servico` (`ORD_id`, `id_pai`, `ORC_id`, `ORD_data_visita`, `ORD_hora_visita`, `ORD_duracao_visita`, `ORD_aguardando`, `ORD_agendado`, `ORD_tipo_visita`, `ORD_atividade`, `EQU_id`, `VEI_id`, `ORD_defensivos`, `ORD_detalhes_tratamento`, `ORD_partida`, `ORD_chegada`, `ORD_chegada_hora`, `ORD_inicio_servico`, `ORD_km_partida`, `ORD_km_chegada`, `ORD_termino`, `ORD_termino_hora`, `ORD_acompanhado_por`, `ORD_obs`, `ORD_pontos`, `ORD_status`) VALUES
(270, 260, 23, '2014-02-19', '00:00', '01:00', 'Rafael', 'Ag. Jonatas', 4, 0, 68, 1001, '[{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '[{\r\n                                \"ambiente\":\"\",\r\n                                \"ep\":{\"nome\":\"0\"},\r\n                                \"ve\":\"0\",\r\n                                \"ni\":\"\",\r\n                                \"te\":\"\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           }]', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '[{\"id\":\"260-1387743226455\",\"tipo_dispositivo\":\"ppe\",\"num\":\"dfs\",\"descricao\":\" asdfasdf\",\"local\":\"sdfas\",\"dispositivo\":\"asdfasdf\",\"status\":\"1\"},{\"id\":\"260-1387743238455\",\"tipo_dispositivo\":\"ppi\",\"num\":\"sadasd\",\"descricao\":\"asdf asdf \",\"local\":\"asdfasdf\",\"dispositivo\":\"sadfasdf \",\"status\":\"1\"},{\"id\":\"260-1387743263961\",\"tipo_dispositivo\":\"luminosa\",\"num\":\"sadf asdf\",\"descricao\":\" asdf asdf asdf \",\"local\":\"sadf asdf\",\"dispositivo\":\"asdf asdf asdf \",\"status\":\"1\"},{\"id\":\"262-1387743998547\",\"tipo_dispositivo\":\"ppe\",\"num\":\"asdf\",\"descricao\":\"asdf asdf asdf \",\"local\":\"sadfasdf\",\"dispositivo\":\"asdfasdasdf\",\"status\":\"1\"}]', 0),
(269, 260, 23, '2014-02-05', '00:00', '01:00', 'Rafael', 'Ag. Jonatas', 4, 0, 68, 1001, '[{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '[{\r\n                                \"ambiente\":\"\",\r\n                                \"ep\":{\"nome\":\"0\"},\r\n                                \"ve\":\"0\",\r\n                                \"ni\":\"\",\r\n                                \"te\":\"\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           }]', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '[{\"id\":\"260-1387743226455\",\"tipo_dispositivo\":\"ppe\",\"num\":\"dfs\",\"descricao\":\" asdfasdf\",\"local\":\"sdfas\",\"dispositivo\":\"asdfasdf\",\"status\":\"1\"},{\"id\":\"260-1387743238455\",\"tipo_dispositivo\":\"ppi\",\"num\":\"sadasd\",\"descricao\":\"asdf asdf \",\"local\":\"asdfasdf\",\"dispositivo\":\"sadfasdf \",\"status\":\"1\"},{\"id\":\"260-1387743263961\",\"tipo_dispositivo\":\"luminosa\",\"num\":\"sadf asdf\",\"descricao\":\" asdf asdf asdf \",\"local\":\"sadf asdf\",\"dispositivo\":\"asdf asdf asdf \",\"status\":\"1\"},{\"id\":\"262-1387743998547\",\"tipo_dispositivo\":\"ppe\",\"num\":\"asdf\",\"descricao\":\"asdf asdf asdf \",\"local\":\"sadfasdf\",\"dispositivo\":\"asdfasdasdf\",\"status\":\"1\"}]', 0),
(268, 260, 23, '2014-01-22', '00:00', '01:00', 'Rafael', 'Ag. Jonatas', 4, 0, 68, 1001, '[{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '[{\r\n                                \"ambiente\":\"\",\r\n                                \"ep\":{\"nome\":\"0\"},\r\n                                \"ve\":\"0\",\r\n                                \"ni\":\"\",\r\n                                \"te\":\"\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           }]', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '[{\"id\":\"260-1387743226455\",\"tipo_dispositivo\":\"ppe\",\"num\":\"dfs\",\"descricao\":\" asdfasdf\",\"local\":\"sdfas\",\"dispositivo\":\"asdfasdf\",\"status\":\"1\"},{\"id\":\"260-1387743238455\",\"tipo_dispositivo\":\"ppi\",\"num\":\"sadasd\",\"descricao\":\"asdf asdf \",\"local\":\"asdfasdf\",\"dispositivo\":\"sadfasdf \",\"status\":\"1\"},{\"id\":\"260-1387743263961\",\"tipo_dispositivo\":\"luminosa\",\"num\":\"sadf asdf\",\"descricao\":\" asdf asdf asdf \",\"local\":\"sadf asdf\",\"dispositivo\":\"asdf asdf asdf \",\"status\":\"1\"},{\"id\":\"262-1387743998547\",\"tipo_dispositivo\":\"ppe\",\"num\":\"asdf\",\"descricao\":\"asdf asdf asdf \",\"local\":\"sadfasdf\",\"dispositivo\":\"asdfasdasdf\",\"status\":\"1\"}]', 0),
(267, 260, 23, '2014-01-08', '00:00', '01:00', 'Rafael', 'Ag. Jonatas', 4, 0, 68, 1001, '[{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '[{\r\n                                \"ambiente\":\"\",\r\n                                \"ep\":{\"nome\":\"0\"},\r\n                                \"ve\":\"0\",\r\n                                \"ni\":\"\",\r\n                                \"te\":\"\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           }]', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '[{\"id\":\"260-1387743226455\",\"tipo_dispositivo\":\"ppe\",\"num\":\"dfs\",\"descricao\":\" asdfasdf\",\"local\":\"sdfas\",\"dispositivo\":\"asdfasdf\",\"status\":\"1\"},{\"id\":\"260-1387743238455\",\"tipo_dispositivo\":\"ppi\",\"num\":\"sadasd\",\"descricao\":\"asdf asdf \",\"local\":\"asdfasdf\",\"dispositivo\":\"sadfasdf \",\"status\":\"1\"},{\"id\":\"260-1387743263961\",\"tipo_dispositivo\":\"luminosa\",\"num\":\"sadf asdf\",\"descricao\":\" asdf asdf asdf \",\"local\":\"sadf asdf\",\"dispositivo\":\"asdf asdf asdf \",\"status\":\"1\"},{\"id\":\"262-1387743998547\",\"tipo_dispositivo\":\"ppe\",\"num\":\"asdf\",\"descricao\":\"asdf asdf asdf \",\"local\":\"sadfasdf\",\"dispositivo\":\"asdfasdasdf\",\"status\":\"1\"}]', 0),
(266, 260, 23, '2013-12-25', '00:00', '01:00', 'Rafael', 'Ag. Jonatas', 4, 0, 68, 1001, '[{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '[{\r\n                                \"ambiente\":\"\",\r\n                                \"ep\":{\"nome\":\"0\"},\r\n                                \"ve\":\"0\",\r\n                                \"ni\":\"\",\r\n                                \"te\":\"\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           }]', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '[{\"id\":\"260-1387743226455\",\"tipo_dispositivo\":\"ppe\",\"num\":\"dfs\",\"descricao\":\" asdfasdf\",\"local\":\"sdfas\",\"dispositivo\":\"asdfasdf\",\"status\":\"1\"},{\"id\":\"260-1387743238455\",\"tipo_dispositivo\":\"ppi\",\"num\":\"sadasd\",\"descricao\":\"asdf asdf \",\"local\":\"asdfasdf\",\"dispositivo\":\"sadfasdf \",\"status\":\"1\"},{\"id\":\"260-1387743263961\",\"tipo_dispositivo\":\"luminosa\",\"num\":\"sadf asdf\",\"descricao\":\" asdf asdf asdf \",\"local\":\"sadf asdf\",\"dispositivo\":\"asdf asdf asdf \",\"status\":\"1\"},{\"id\":\"262-1387743998547\",\"tipo_dispositivo\":\"ppe\",\"num\":\"asdf\",\"descricao\":\"asdf asdf asdf \",\"local\":\"sadfasdf\",\"dispositivo\":\"asdfasdasdf\",\"status\":\"1\"}]', 0),
(263, 260, 23, '2013-11-13', '00:00', '01:00', 'Rafael', 'Ag. Jonatas', 4, 0, 68, 1001, '[{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '[{\r\n                                \"ambiente\":\"\",\r\n                                \"ep\":{\"nome\":\"0\"},\r\n                                \"ve\":\"0\",\r\n                                \"ni\":\"\",\r\n                                \"te\":\"\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           }]', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '[{\"id\":\"260-1387743226455\",\"tipo_dispositivo\":\"ppe\",\"num\":\"dfs\",\"descricao\":\" asdfasdf\",\"local\":\"sdfas\",\"dispositivo\":\"asdfasdf\",\"status\":\"1\"},{\"id\":\"260-1387743238455\",\"tipo_dispositivo\":\"ppi\",\"num\":\"sadasd\",\"descricao\":\"asdf asdf \",\"local\":\"asdfasdf\",\"dispositivo\":\"sadfasdf \",\"status\":\"1\"},{\"id\":\"260-1387743263961\",\"tipo_dispositivo\":\"luminosa\",\"num\":\"sadf asdf\",\"descricao\":\" asdf asdf asdf \",\"local\":\"sadf asdf\",\"dispositivo\":\"asdf asdf asdf \",\"status\":\"1\"},{\"id\":\"262-1387743998547\",\"tipo_dispositivo\":\"ppe\",\"num\":\"asdf\",\"descricao\":\"asdf asdf asdf \",\"local\":\"sadfasdf\",\"dispositivo\":\"asdfasdasdf\",\"status\":\"1\"}]', 0),
(264, 260, 23, '2013-11-27', '00:00', '01:00', 'Rafael', 'Ag. Jonatas', 4, 0, 68, 1001, '[{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '[{\r\n                                \"ambiente\":\"\",\r\n                                \"ep\":{\"nome\":\"0\"},\r\n                                \"ve\":\"0\",\r\n                                \"ni\":\"\",\r\n                                \"te\":\"\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           }]', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '[{\"id\":\"260-1387743226455\",\"tipo_dispositivo\":\"ppe\",\"num\":\"dfs\",\"descricao\":\" asdfasdf\",\"local\":\"sdfas\",\"dispositivo\":\"asdfasdf\",\"status\":\"1\"},{\"id\":\"260-1387743238455\",\"tipo_dispositivo\":\"ppi\",\"num\":\"sadasd\",\"descricao\":\"asdf asdf \",\"local\":\"asdfasdf\",\"dispositivo\":\"sadfasdf \",\"status\":\"1\"},{\"id\":\"260-1387743263961\",\"tipo_dispositivo\":\"luminosa\",\"num\":\"sadf asdf\",\"descricao\":\" asdf asdf asdf \",\"local\":\"sadf asdf\",\"dispositivo\":\"asdf asdf asdf \",\"status\":\"1\"},{\"id\":\"262-1387743998547\",\"tipo_dispositivo\":\"ppe\",\"num\":\"asdf\",\"descricao\":\"asdf asdf asdf \",\"local\":\"sadfasdf\",\"dispositivo\":\"asdfasdasdf\",\"status\":\"1\"}]', 0),
(289, 260, 23, '2013-11-06', '00:00', '01:00', 'Rafael', 'Ag. Jonatas', 4, 8, 68, 1001, '[{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '[{\r\n                                \"ambiente\":\"\",\r\n                                \"ep\":{\"nome\":\"0\"},\r\n                                \"ve\":\"0\",\r\n                                \"ni\":\"\",\r\n                                \"te\":\"\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           }]', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '[{\"id\":\"260-1387743226455\",\"tipo_dispositivo\":\"ppe\",\"num\":\"dfs\",\"descricao\":\" asdfasdf\",\"local\":\"sdfas\",\"dispositivo\":\"asdfasdf\",\"status\":\"1\"},{\"id\":\"260-1387743238455\",\"tipo_dispositivo\":\"ppi\",\"num\":\"sadasd\",\"descricao\":\"asdf asdf \",\"local\":\"asdfasdf\",\"dispositivo\":\"sadfasdf \",\"status\":\"1\"},{\"id\":\"260-1387743263961\",\"tipo_dispositivo\":\"luminosa\",\"num\":\"sadf asdf\",\"descricao\":\" asdf asdf asdf \",\"local\":\"sadf asdf\",\"dispositivo\":\"asdf asdf asdf \",\"status\":\"1\"},{\"id\":\"262-1387743998547\",\"tipo_dispositivo\":\"ppe\",\"num\":\"asdf\",\"descricao\":\"asdf asdf asdf \",\"local\":\"sadfasdf\",\"dispositivo\":\"asdfasdasdf\",\"status\":\"1\"}]', 0),
(290, 260, 23, '2013-12-04', '00:00', '01:00', 'Rafael', 'Ag. Jonatas', 4, 8, 68, 1001, '[{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '[{\r\n                                \"ambiente\":\"\",\r\n                                \"ep\":{\"nome\":\"0\"},\r\n                                \"ve\":\"0\",\r\n                                \"ni\":\"\",\r\n                                \"te\":\"\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           }]', '12:30', '2013-12-11', '13:30', '13:30', '654654', '5465466', '2013-12-11', '14:30', 'teste', ' asdfasdf asdf asdf asd fasdf', '[{\"id\":\"260-1387743226455\",\"tipo_dispositivo\":\"ppe\",\"num\":\"dfs\",\"descricao\":\" asdfasdf\",\"local\":\"sdfas\",\"dispositivo\":\"asdfasdf\",\"status\":\"1\"},{\"id\":\"260-1387743238455\",\"tipo_dispositivo\":\"ppi\",\"num\":\"sadasd\",\"descricao\":\"asdf asdf \",\"local\":\"asdfasdf\",\"dispositivo\":\"sadfasdf \",\"status\":\"1\"},{\"id\":\"260-1387743263961\",\"tipo_dispositivo\":\"luminosa\",\"num\":\"sadf asdf\",\"descricao\":\" asdf asdf asdf \",\"local\":\"sadf asdf\",\"dispositivo\":\"asdf asdf asdf \",\"status\":\"1\"},{\"id\":\"262-1387743998547\",\"tipo_dispositivo\":\"ppe\",\"num\":\"asdf\",\"descricao\":\"asdf asdf asdf \",\"local\":\"sadfasdf\",\"dispositivo\":\"asdfasdasdf\",\"status\":\"1\"}]', 1),
(291, 260, 23, '2014-01-01', '00:00', '01:00', 'Rafael', 'Ag. Jonatas', 4, 8, 68, 1001, '[{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '[{\r\n                                \"ambiente\":\"\",\r\n                                \"ep\":{\"nome\":\"0\"},\r\n                                \"ve\":\"0\",\r\n                                \"ni\":\"\",\r\n                                \"te\":\"\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           }]', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '[{\"id\":\"260-1387743226455\",\"tipo_dispositivo\":\"ppe\",\"num\":\"dfs\",\"descricao\":\" asdfasdf\",\"local\":\"sdfas\",\"dispositivo\":\"asdfasdf\",\"status\":\"1\"},{\"id\":\"260-1387743238455\",\"tipo_dispositivo\":\"ppi\",\"num\":\"sadasd\",\"descricao\":\"asdf asdf \",\"local\":\"asdfasdf\",\"dispositivo\":\"sadfasdf \",\"status\":\"1\"},{\"id\":\"260-1387743263961\",\"tipo_dispositivo\":\"luminosa\",\"num\":\"sadf asdf\",\"descricao\":\" asdf asdf asdf \",\"local\":\"sadf asdf\",\"dispositivo\":\"asdf asdf asdf \",\"status\":\"1\"},{\"id\":\"262-1387743998547\",\"tipo_dispositivo\":\"ppe\",\"num\":\"asdf\",\"descricao\":\"asdf asdf asdf \",\"local\":\"sadfasdf\",\"dispositivo\":\"asdfasdasdf\",\"status\":\"1\"}]', 0),
(292, 260, 23, '2014-02-05', '00:00', '01:00', 'Rafael', 'Ag. Jonatas', 4, 8, 68, 1001, '[{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '[{\r\n                                \"ambiente\":\"\",\r\n                                \"ep\":{\"nome\":\"0\"},\r\n                                \"ve\":\"0\",\r\n                                \"ni\":\"\",\r\n                                \"te\":\"\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           }]', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '[{\"id\":\"260-1387743226455\",\"tipo_dispositivo\":\"ppe\",\"num\":\"dfs\",\"descricao\":\" asdfasdf\",\"local\":\"sdfas\",\"dispositivo\":\"asdfasdf\",\"status\":\"1\"},{\"id\":\"260-1387743238455\",\"tipo_dispositivo\":\"ppi\",\"num\":\"sadasd\",\"descricao\":\"asdf asdf \",\"local\":\"asdfasdf\",\"dispositivo\":\"sadfasdf \",\"status\":\"1\"},{\"id\":\"260-1387743263961\",\"tipo_dispositivo\":\"luminosa\",\"num\":\"sadf asdf\",\"descricao\":\" asdf asdf asdf \",\"local\":\"sadf asdf\",\"dispositivo\":\"asdf asdf asdf \",\"status\":\"1\"},{\"id\":\"262-1387743998547\",\"tipo_dispositivo\":\"ppe\",\"num\":\"asdf\",\"descricao\":\"asdf asdf asdf \",\"local\":\"sadfasdf\",\"dispositivo\":\"asdfasdasdf\",\"status\":\"1\"}]', 0),
(293, 260, 23, '2014-03-12', '00:00', '01:00', 'Rafael', 'Ag. Jonatas', 4, 8, 68, 1001, '[{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '[{\r\n                                \"ambiente\":\"\",\r\n                                \"ep\":{\"nome\":\"0\"},\r\n                                \"ve\":\"0\",\r\n                                \"ni\":\"\",\r\n                                \"te\":\"\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           }]', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '[{\"id\":\"260-1387743226455\",\"tipo_dispositivo\":\"ppe\",\"num\":\"dfs\",\"descricao\":\" asdfasdf\",\"local\":\"sdfas\",\"dispositivo\":\"asdfasdf\",\"status\":\"1\"},{\"id\":\"260-1387743238455\",\"tipo_dispositivo\":\"ppi\",\"num\":\"sadasd\",\"descricao\":\"asdf asdf \",\"local\":\"asdfasdf\",\"dispositivo\":\"sadfasdf \",\"status\":\"1\"},{\"id\":\"260-1387743263961\",\"tipo_dispositivo\":\"luminosa\",\"num\":\"sadf asdf\",\"descricao\":\" asdf asdf asdf \",\"local\":\"sadf asdf\",\"dispositivo\":\"asdf asdf asdf \",\"status\":\"1\"},{\"id\":\"262-1387743998547\",\"tipo_dispositivo\":\"ppe\",\"num\":\"asdf\",\"descricao\":\"asdf asdf asdf \",\"local\":\"sadfasdf\",\"dispositivo\":\"asdfasdasdf\",\"status\":\"1\"}]', 0),
(294, 260, 23, '2014-04-09', '00:00', '01:00', 'Rafael', 'Ag. Jonatas', 4, 8, 68, 1001, '[{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '[{\r\n                                \"ambiente\":\"\",\r\n                                \"ep\":{\"nome\":\"0\"},\r\n                                \"ve\":\"0\",\r\n                                \"ni\":\"\",\r\n                                \"te\":\"\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           }]', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '[{\"id\":\"260-1387743226455\",\"tipo_dispositivo\":\"ppe\",\"num\":\"dfs\",\"descricao\":\" asdfasdf\",\"local\":\"sdfas\",\"dispositivo\":\"asdfasdf\",\"status\":\"1\"},{\"id\":\"260-1387743238455\",\"tipo_dispositivo\":\"ppi\",\"num\":\"sadasd\",\"descricao\":\"asdf asdf \",\"local\":\"asdfasdf\",\"dispositivo\":\"sadfasdf \",\"status\":\"1\"},{\"id\":\"260-1387743263961\",\"tipo_dispositivo\":\"luminosa\",\"num\":\"sadf asdf\",\"descricao\":\" asdf asdf asdf \",\"local\":\"sadf asdf\",\"dispositivo\":\"asdf asdf asdf \",\"status\":\"1\"},{\"id\":\"262-1387743998547\",\"tipo_dispositivo\":\"ppe\",\"num\":\"asdf\",\"descricao\":\"asdf asdf asdf \",\"local\":\"sadfasdf\",\"dispositivo\":\"asdfasdasdf\",\"status\":\"1\"}]', 0),
(295, 260, 23, '2014-05-14', '00:00', '01:00', 'Rafael', 'Ag. Jonatas', 4, 8, 68, 1001, '[{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '[{\r\n                                \"ambiente\":\"\",\r\n                                \"ep\":{\"nome\":\"0\"},\r\n                                \"ve\":\"0\",\r\n                                \"ni\":\"\",\r\n                                \"te\":\"\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           }]', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '[{\"id\":\"260-1387743226455\",\"tipo_dispositivo\":\"ppe\",\"num\":\"dfs\",\"descricao\":\" asdfasdf\",\"local\":\"sdfas\",\"dispositivo\":\"asdfasdf\",\"status\":\"1\"},{\"id\":\"260-1387743238455\",\"tipo_dispositivo\":\"ppi\",\"num\":\"sadasd\",\"descricao\":\"asdf asdf \",\"local\":\"asdfasdf\",\"dispositivo\":\"sadfasdf \",\"status\":\"1\"},{\"id\":\"260-1387743263961\",\"tipo_dispositivo\":\"luminosa\",\"num\":\"sadf asdf\",\"descricao\":\" asdf asdf asdf \",\"local\":\"sadf asdf\",\"dispositivo\":\"asdf asdf asdf \",\"status\":\"1\"},{\"id\":\"262-1387743998547\",\"tipo_dispositivo\":\"ppe\",\"num\":\"asdf\",\"descricao\":\"asdf asdf asdf \",\"local\":\"sadfasdf\",\"dispositivo\":\"asdfasdasdf\",\"status\":\"1\"}]', 0),
(296, 260, 23, '2014-06-11', '00:00', '01:00', 'Rafael', 'Ag. Jonatas', 4, 8, 68, 1001, '[{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '[{\r\n                                \"ambiente\":\"\",\r\n                                \"ep\":{\"nome\":\"0\"},\r\n                                \"ve\":\"0\",\r\n                                \"ni\":\"\",\r\n                                \"te\":\"\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           }]', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '[{\"id\":\"260-1387743226455\",\"tipo_dispositivo\":\"ppe\",\"num\":\"dfs\",\"descricao\":\" asdfasdf\",\"local\":\"sdfas\",\"dispositivo\":\"asdfasdf\",\"status\":\"1\"},{\"id\":\"260-1387743238455\",\"tipo_dispositivo\":\"ppi\",\"num\":\"sadasd\",\"descricao\":\"asdf asdf \",\"local\":\"asdfasdf\",\"dispositivo\":\"sadfasdf \",\"status\":\"1\"},{\"id\":\"260-1387743263961\",\"tipo_dispositivo\":\"luminosa\",\"num\":\"sadf asdf\",\"descricao\":\" asdf asdf asdf \",\"local\":\"sadf asdf\",\"dispositivo\":\"asdf asdf asdf \",\"status\":\"1\"},{\"id\":\"262-1387743998547\",\"tipo_dispositivo\":\"ppe\",\"num\":\"asdf\",\"descricao\":\"asdf asdf asdf \",\"local\":\"sadfasdf\",\"dispositivo\":\"asdfasdasdf\",\"status\":\"1\"}]', 0);
INSERT INTO `ordem_servico` (`ORD_id`, `id_pai`, `ORC_id`, `ORD_data_visita`, `ORD_hora_visita`, `ORD_duracao_visita`, `ORD_aguardando`, `ORD_agendado`, `ORD_tipo_visita`, `ORD_atividade`, `EQU_id`, `VEI_id`, `ORD_defensivos`, `ORD_detalhes_tratamento`, `ORD_partida`, `ORD_chegada`, `ORD_chegada_hora`, `ORD_inicio_servico`, `ORD_km_partida`, `ORD_km_chegada`, `ORD_termino`, `ORD_termino_hora`, `ORD_acompanhado_por`, `ORD_obs`, `ORD_pontos`, `ORD_status`) VALUES
(297, 260, 23, '2014-07-09', '00:00', '01:00', 'Rafael', 'Ag. Jonatas', 4, 8, 68, 1001, '[{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '[{\r\n                                \"ambiente\":\"\",\r\n                                \"ep\":{\"nome\":\"0\"},\r\n                                \"ve\":\"0\",\r\n                                \"ni\":\"\",\r\n                                \"te\":\"\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           }]', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '[{\"id\":\"260-1387743226455\",\"tipo_dispositivo\":\"ppe\",\"num\":\"dfs\",\"descricao\":\" asdfasdf\",\"local\":\"sdfas\",\"dispositivo\":\"asdfasdf\",\"status\":\"1\"},{\"id\":\"260-1387743238455\",\"tipo_dispositivo\":\"ppi\",\"num\":\"sadasd\",\"descricao\":\"asdf asdf \",\"local\":\"asdfasdf\",\"dispositivo\":\"sadfasdf \",\"status\":\"1\"},{\"id\":\"260-1387743263961\",\"tipo_dispositivo\":\"luminosa\",\"num\":\"sadf asdf\",\"descricao\":\" asdf asdf asdf \",\"local\":\"sadf asdf\",\"dispositivo\":\"asdf asdf asdf \",\"status\":\"1\"},{\"id\":\"262-1387743998547\",\"tipo_dispositivo\":\"ppe\",\"num\":\"asdf\",\"descricao\":\"asdf asdf asdf \",\"local\":\"sadfasdf\",\"dispositivo\":\"asdfasdasdf\",\"status\":\"1\"}]', 0),
(298, 260, 23, '2014-08-13', '00:00', '01:00', 'Rafael', 'Ag. Jonatas', 4, 8, 68, 1001, '[{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '[{\r\n                                \"ambiente\":\"\",\r\n                                \"ep\":{\"nome\":\"0\"},\r\n                                \"ve\":\"0\",\r\n                                \"ni\":\"\",\r\n                                \"te\":\"\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           }]', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '[{\"id\":\"260-1387743226455\",\"tipo_dispositivo\":\"ppe\",\"num\":\"dfs\",\"descricao\":\" asdfasdf\",\"local\":\"sdfas\",\"dispositivo\":\"asdfasdf\",\"status\":\"1\"},{\"id\":\"260-1387743238455\",\"tipo_dispositivo\":\"ppi\",\"num\":\"sadasd\",\"descricao\":\"asdf asdf \",\"local\":\"asdfasdf\",\"dispositivo\":\"sadfasdf \",\"status\":\"1\"},{\"id\":\"260-1387743263961\",\"tipo_dispositivo\":\"luminosa\",\"num\":\"sadf asdf\",\"descricao\":\" asdf asdf asdf \",\"local\":\"sadf asdf\",\"dispositivo\":\"asdf asdf asdf \",\"status\":\"1\"},{\"id\":\"262-1387743998547\",\"tipo_dispositivo\":\"ppe\",\"num\":\"asdf\",\"descricao\":\"asdf asdf asdf \",\"local\":\"sadfasdf\",\"dispositivo\":\"asdfasdasdf\",\"status\":\"1\"}]', 0),
(299, 260, 23, '2014-09-10', '00:00', '01:00', 'Rafael', 'Ag. Jonatas', 4, 8, 68, 1001, '[{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '[{\r\n                                \"ambiente\":\"\",\r\n                                \"ep\":{\"nome\":\"0\"},\r\n                                \"ve\":\"0\",\r\n                                \"ni\":\"\",\r\n                                \"te\":\"\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           }]', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '[{\"id\":\"260-1387743226455\",\"tipo_dispositivo\":\"ppe\",\"num\":\"dfs\",\"descricao\":\" asdfasdf\",\"local\":\"sdfas\",\"dispositivo\":\"asdfasdf\",\"status\":\"1\"},{\"id\":\"260-1387743238455\",\"tipo_dispositivo\":\"ppi\",\"num\":\"sadasd\",\"descricao\":\"asdf asdf \",\"local\":\"asdfasdf\",\"dispositivo\":\"sadfasdf \",\"status\":\"1\"},{\"id\":\"260-1387743263961\",\"tipo_dispositivo\":\"luminosa\",\"num\":\"sadf asdf\",\"descricao\":\" asdf asdf asdf \",\"local\":\"sadf asdf\",\"dispositivo\":\"asdf asdf asdf \",\"status\":\"1\"},{\"id\":\"262-1387743998547\",\"tipo_dispositivo\":\"ppe\",\"num\":\"asdf\",\"descricao\":\"asdf asdf asdf \",\"local\":\"sadfasdf\",\"dispositivo\":\"asdfasdasdf\",\"status\":\"1\"}]', 0),
(300, 260, 23, '2013-10-02', '00:00', '01:00', 'Rafael', 'Ag. Jonatas', 7, 2, 68, 1001, '[{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '[{\r\n                                \"ambiente\":\"\",\r\n                                \"ep\":{\"nome\":\"0\"},\r\n                                \"ve\":\"0\",\r\n                                \"ni\":\"\",\r\n                                \"te\":\"\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           }]', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '[{\"id\":\"260-1387743226455\",\"tipo_dispositivo\":\"ppe\",\"num\":\"dfs\",\"descricao\":\" asdfasdf\",\"local\":\"sdfas\",\"dispositivo\":\"asdfasdf\",\"status\":\"1\"},{\"id\":\"260-1387743238455\",\"tipo_dispositivo\":\"ppi\",\"num\":\"sadasd\",\"descricao\":\"asdf asdf \",\"local\":\"asdfasdf\",\"dispositivo\":\"sadfasdf \",\"status\":\"1\"},{\"id\":\"260-1387743263961\",\"tipo_dispositivo\":\"luminosa\",\"num\":\"sadf asdf\",\"descricao\":\" asdf asdf asdf \",\"local\":\"sadf asdf\",\"dispositivo\":\"asdf asdf asdf \",\"status\":\"1\"}]', 0),
(301, 260, 23, '2014-03-19', '00:00', '01:00', 'Rafael', 'Ag. Jonatas', 7, 2, 68, 1001, '[{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '[{\r\n                                \"ambiente\":\"\",\r\n                                \"ep\":{\"nome\":\"0\"},\r\n                                \"ve\":\"0\",\r\n                                \"ni\":\"\",\r\n                                \"te\":\"\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           },{\r\n                                \"ambiente\":\"we\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(FE) Fezes\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"12 - JATEAMENTO DAS PAREDES\",\r\n                                \r\n                           }]', '', '0000-00-00', '', '', '', '', '0000-00-00', '', '', '', '[{\"id\":\"260-1387743226455\",\"tipo_dispositivo\":\"ppe\",\"num\":\"dfs\",\"descricao\":\" asdfasdf\",\"local\":\"sdfas\",\"dispositivo\":\"asdfasdf\",\"status\":\"1\"},{\"id\":\"260-1387743238455\",\"tipo_dispositivo\":\"ppi\",\"num\":\"sadasd\",\"descricao\":\"asdf asdf \",\"local\":\"asdfasdf\",\"dispositivo\":\"sadfasdf \",\"status\":\"1\"},{\"id\":\"260-1387743263961\",\"tipo_dispositivo\":\"luminosa\",\"num\":\"sadf asdf\",\"descricao\":\" asdf asdf asdf \",\"local\":\"sadf asdf\",\"dispositivo\":\"asdf asdf asdf \",\"status\":\"1\"},{\"id\":\"262-1387743998547\",\"tipo_dispositivo\":\"ppe\",\"num\":\"asdf\",\"descricao\":\"asdf asdf asdf \",\"local\":\"sadfasdf\",\"dispositivo\":\"asdfasdasdf\",\"status\":\"1\"}]', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `outros`
--

CREATE TABLE `outros` (
  `OUT_id` int(11) NOT NULL,
  `PON_id` varchar(200) NOT NULL,
  `ORD_id` int(11) NOT NULL,
  `OUT_baixa` int(11) NOT NULL,
  `OUT_dispositivo_captura` int(11) NOT NULL,
  `OUT_substituido` int(11) NOT NULL,
  `OUT_capturados` int(11) NOT NULL,
  `OUT_data_implantacao` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `outros`
--

INSERT INTO `outros` (`OUT_id`, `PON_id`, `ORD_id`, `OUT_baixa`, `OUT_dispositivo_captura`, `OUT_substituido`, `OUT_capturados`, `OUT_data_implantacao`) VALUES
(9, '150-1387479134119', 150, 0, 0, 0, 15, '2013-12-19');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ponto`
--

CREATE TABLE `ponto` (
  `PON_id` int(11) NOT NULL,
  `ORD_id` int(11) NOT NULL,
  `PON_num` int(11) NOT NULL,
  `PON_local` varchar(200) NOT NULL,
  `PON_tipo_dispositivo` varchar(200) NOT NULL,
  `PON_tipo_ponto` varchar(200) NOT NULL,
  `PON_descricao` text NOT NULL,
  `PON_status` varchar(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ponto`
--

INSERT INTO `ponto` (`PON_id`, `ORD_id`, `PON_num`, `PON_local`, `PON_tipo_dispositivo`, `PON_tipo_ponto`, `PON_descricao`, `PON_status`) VALUES
(1, 144, 1, 'Local', 'Isca usada', 'ppe', 'Descrição do ponto', '0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ppe`
--

CREATE TABLE `ppe` (
  `PPE_id` int(11) NOT NULL,
  `PON_id` varchar(200) NOT NULL,
  `ORD_id` int(11) NOT NULL,
  `PPE_dispositivo` varchar(2) NOT NULL,
  `PPE_baixa` varchar(11) NOT NULL,
  `PPE_porta_isca` varchar(2) NOT NULL,
  `PPE_porta_isca_substituido` varchar(2) NOT NULL,
  `PPE_isca` varchar(2) NOT NULL,
  `PPE_isca_substituida` varchar(2) NOT NULL,
  `PPE_data_implantacao` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ppe`
--

INSERT INTO `ppe` (`PPE_id`, `PON_id`, `ORD_id`, `PPE_dispositivo`, `PPE_baixa`, `PPE_porta_isca`, `PPE_porta_isca_substituido`, `PPE_isca`, `PPE_isca_substituida`, `PPE_data_implantacao`) VALUES
(12, '144-1387420702919', 150, '', '1', '0', '0', '0', '0', '2013-12-19'),
(13, '260-1387743226455', 263, '', '1', '1', '0', '1', '0', '2013-12-22'),
(14, '262-1387743998547', 263, '', '1', '1', '0', '1', '0', '2013-12-22'),
(15, '144-1387773659849', 144, '', '1', '1', '1', '1', '1', '2013-12-23'),
(16, '144-1387773671209', 144, '', '1', '0', '0', '1', '0', '2013-12-23'),
(17, '144-1387773688834', 144, '', '1', '0', '0', '1', '1', '2013-12-23'),
(18, '144-1387792663756', 144, '', '1', '0', '0', '0', '0', '2013-12-23'),
(19, '144-1387792673756', 144, '', '1', '1', '0', '1', '0', '2013-12-23'),
(20, '144-1387792684100', 144, '', '1', '0', '0', '0', '1', '2013-12-23'),
(21, '144-1387792692756', 144, '', '1', '0', '0', '1', '0', '2013-12-23');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ppi`
--

CREATE TABLE `ppi` (
  `PPI_id` int(11) NOT NULL,
  `PON_id` varchar(200) NOT NULL,
  `ORD_id` int(11) NOT NULL,
  `PPI_dispositivo` int(11) NOT NULL,
  `PPI_porta_placa` int(11) NOT NULL,
  `PPI_porta_placa_substituido` int(11) NOT NULL,
  `PPI_placa` int(11) NOT NULL,
  `PPI_placa_substituida` int(11) NOT NULL,
  `PPI_data_implantacao` date NOT NULL,
  `PPI_tipo` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ppi`
--

INSERT INTO `ppi` (`PPI_id`, `PON_id`, `ORD_id`, `PPI_dispositivo`, `PPI_porta_placa`, `PPI_porta_placa_substituido`, `PPI_placa`, `PPI_placa_substituida`, `PPI_data_implantacao`, `PPI_tipo`) VALUES
(6, '144-1387420702919', 150, 1, 1, 0, 0, 0, '2013-12-19', ''),
(7, '144-1387773659849', 144, 1, 0, 0, 0, 0, '2013-12-23', ''),
(8, '144-1387773671209', 144, 1, 0, 0, 1, 0, '2013-12-23', ''),
(9, '144-1387773688834', 144, 1, 0, 0, 0, 0, '2013-12-23', ''),
(10, '144-1387773706724', 144, 1, 0, 0, 0, 0, '2013-12-23', ''),
(11, '144-1387792737799', 144, 1, 0, 0, 0, 1, '2013-12-23', ''),
(12, '144-1387792744034', 144, 1, 0, 0, 1, 0, '2013-12-23', ''),
(13, '144-1387792751284', 144, 1, 2, 0, 1, 0, '2013-12-23', ''),
(14, '144-1387792760456', 144, 2, 0, 0, 0, 1, '2013-12-23', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pragas`
--

CREATE TABLE `pragas` (
  `PRA_id` int(11) NOT NULL,
  `PRA_sigla` varchar(200) NOT NULL,
  `PRA_nome` varchar(200) NOT NULL,
  `SER_id` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pragas`
--

INSERT INTO `pragas` (`PRA_id`, `PRA_sigla`, `PRA_nome`, `SER_id`) VALUES
(2, 'AB', 'ABELHAS', '[\"10\",\"20\"]');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `PRO_id` int(11) NOT NULL,
  `PRO_sigla` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `PRO_nome` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `PRO_fabricante` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `PRO_modelo` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `GRU_id` int(11) NOT NULL,
  `PRO_descricao` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `PRO_estoqueminimo` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `PRO_unid_cliente` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `PRO_unid_estoque` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `PRO_baixa` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `PRO_conver_estoque` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `PRO_conver_cliente` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `PRO_preco_custo` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `PRO_porcent_lucro` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `PRO_preco_final` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `PRO_parecer_tecnico` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `PRO_grupo_quimico` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `PRO_princ_ativo` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `PRO_concentracao` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `PRO_num_registro` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `PRO_antidoto` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `PRO_diluicao_fispq` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `PRO_qtd_area` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `PRO_medida_produto` float NOT NULL,
  `PRO_qtd_estoque` float NOT NULL,
  `PRA_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `TRA_id` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`PRO_id`, `PRO_sigla`, `PRO_nome`, `PRO_fabricante`, `PRO_modelo`, `GRU_id`, `PRO_descricao`, `PRO_estoqueminimo`, `PRO_unid_cliente`, `PRO_unid_estoque`, `PRO_baixa`, `PRO_conver_estoque`, `PRO_conver_cliente`, `PRO_preco_custo`, `PRO_porcent_lucro`, `PRO_preco_final`, `PRO_parecer_tecnico`, `PRO_grupo_quimico`, `PRO_princ_ativo`, `PRO_concentracao`, `PRO_num_registro`, `PRO_antidoto`, `PRO_diluicao_fispq`, `PRO_qtd_area`, `PRO_medida_produto`, `PRO_qtd_estoque`, `PRA_id`, `TRA_id`) VALUES
(6, '', 'nome do produto', 'fabricante', 'modelo', 7, ' descricao', '10', 'ML', 'LT', '1', '0.01', '1000', '350', '40', '490', 'parecer tecnico', 'grupo quimico', 'principio ativo', '50', '41111111', 'antidoto', '10/100', '200mÂ²', 1, 10, '[\"2\"]', '[\"8\",\"10\",\"13\",\"15\"]');

-- --------------------------------------------------------

--
-- Estrutura da tabela `recursos_materiais`
--

CREATE TABLE `recursos_materiais` (
  `REC_id` int(11) NOT NULL,
  `REC_dados_recursos` text NOT NULL,
  `REC_dados_recursos_produtos` text NOT NULL,
  `REC_ambientes_internos` text NOT NULL,
  `REC_condicoes_especificas` text NOT NULL,
  `REC_ambientes_externos` text NOT NULL,
  `REC_descr_urbano` text NOT NULL,
  `PRO_id` int(11) NOT NULL,
  `ORD_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `recursos_materiais`
--

INSERT INTO `recursos_materiais` (`REC_id`, `REC_dados_recursos`, `REC_dados_recursos_produtos`, `REC_ambientes_internos`, `REC_condicoes_especificas`, `REC_ambientes_externos`, `REC_descr_urbano`, `PRO_id`, `ORD_id`) VALUES
(1, '[null,{\"nAplic\":\"1\",\"ambiente\":\"asd wqd\",\"ep\":{\"nome\":\"2 - ABELHAS\"},\"ve\":\"(IN) Informau00e7u00e3o\",\"ni\":\"(BX) Baixo\",\"te\":\"13 - LAUDO DE POTABILIDADE\"},{\"nAplic\":\"1\",\"ambiente\":\"asd wqd\",\"ep\":{\"nome\":\"2 - ABELHAS\"},\"ve\":\"(IN) Informau00e7u00e3o\",\"ni\":\"(BX) Baixo\",\"te\":\"13 - LAUDO DE POTABILIDADE\"},{\"nAplic\":\"1\",\"ambiente\":\"asd wqd\",\"ep\":{\"nome\":\"2 - ABELHAS\"},\"ve\":\"(IN) Informau00e7u00e3o\",\"ni\":\"(BX) Baixo\",\"te\":\"13 - LAUDO DE POTABILIDADE\"},{\"nAplic\":\"1\",\"ambiente\":\"asd wqd\",\"ep\":{\"nome\":\"2 - ABELHAS\"},\"ve\":\"(IN) Informau00e7u00e3o\",\"ni\":\"(BX) Baixo\",\"te\":\"13 - LAUDO DE POTABILIDADE\"}]', '[null,{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"1\",\"nAplic\":\"1\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"1\",\"nAplic\":\"1\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', 'df asdf asdf ', 'asdf asdf asdf', ' asdf asf asdf as', 'df asf asf asf asdf asf', 0, 0),
(2, '[null,{\"nAplic\":\"5\",\"ambiente\":\"sadfsdasd \",\"ep\":{\"nome\":\"2\"},\"ve\":\"(FE) Fezes\",\"ni\":\"(PR) Preventivo\",\"te\":\"3 - ASSESSORIA SANITu00c1RIA\"},{\"nAplic\":\"5\",\"ambiente\":\"sadfsdasd \",\"ep\":{\"nome\":\"2\"},\"ve\":\"(FE) Fezes\",\"ni\":\"(AL) Alto\",\"te\":\"5 - BARREIRA FISu00cdCA\"}]', '[null,{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"nAplic\":\"4\",\"med\":\"10GR\",\"valor\":\"21\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"3\",\"nAplic\":\"4\",\"med\":\"10GR\",\"valor\":\"21\"}]', 'df asdf asdf ', 'asdf asdf asdf', ' asdf asf asdf as', 'df asf asf asf asdf asf', 0, 0),
(3, '[null,{\"nAplic\":\"5\",\"ambiente\":\"sadfsdasd \",\"ep\":{\"nome\":\"2\"},\"ve\":\"(FE) Fezes\",\"ni\":\"(PR) Preventivo\",\"te\":\"3 - ASSESSORIA SANITu00c1RIA\"},{\"nAplic\":\"5\",\"ambiente\":\"sadfsdasd \",\"ep\":{\"nome\":\"2\"},\"ve\":\"(FE) Fezes\",\"ni\":\"(AL) Alto\",\"te\":\"5 - BARREIRA FISu00cdCA\"}]', '[null,{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"nAplic\":\"4\",\"med\":\"10GR\",\"valor\":\"21\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"3\",\"nAplic\":\"4\",\"med\":\"10GR\",\"valor\":\"21\"}]', 'df asdf asdf ', 'asdf asdf asdf', ' asdf asf asdf as', 'df asf asf asf asdf asf', 0, 0),
(17, '[{\r\n                                \"ambiente\":\"\",\r\n                                \"ep\":{\"nome\":\"\"},\r\n                                \"ve\":\"0\",\r\n                                \"ni\":\"\",\r\n                                \"te\":\"\",\r\n                                \"nAplic\":\"\"\r\n                           },{\r\n                                \"ambiente\":\"Almoxarifado\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(IN) Informação\",\r\n                                \"ni\":\"(BX) Baixo\",\r\n                                \"te\":\"\",\r\n                                \"nAplic\":\"10\"\r\n                           },{\r\n                                \"ambiente\":\"Galpão\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(IN) Informação\",\r\n                                \"ni\":\"(BX) Baixo\",\r\n                                \"te\":\"\",\r\n                                \"nAplic\":\"10\"\r\n                           }]', '[null,{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"nAplic\":\"4\",\"med\":\"10GR\",\"valor\":\"21\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"3\",\"nAplic\":\"4\",\"med\":\"10GR\",\"valor\":\"21\"}]', 'Descrição  dos ambientes internos  \r\n', 'Condições específicas de edificação', 'Descrição dos ambientes externos\r\n', 'Descrição do meio urbano próximo\r\n', 0, 100),
(18, '[{\r\n                                \"ambiente\":\"\",\r\n                                \"ep\":{\"nome\":\"0\"},\r\n                                \"ve\":\"0\",\r\n                                \"ni\":\"\",\r\n                                \"te\":\"\",\r\n                                \"nAplic\":\"\"\r\n                           },{\r\n                                \"ambiente\":\"Galpão\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(IN) Informação\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"\",\r\n                                \"nAplic\":\"2\"\r\n                           },{\r\n                                \"ambiente\":\"Almoxarifado\",\r\n                                \"ep\":{\"nome\":\"2 - ABELHAS\"},\r\n                                \"ve\":\"(PF) Presença\",\r\n                                \"ni\":\"(AL) Alto\",\r\n                                \"te\":\"\",\r\n                                \"nAplic\":\"2\"\r\n                           }]', '[{\"id\":\"\",\"qtd\":0,\"valor\":0,\"disp\":\"\",\"nAplic\":\"\",\"med\":\"\",\"ni\":\"\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"20\",\"nAplic\":\"5\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', '', '', '', '', 0, 0),
(15, '[{\"ambiente\":\"\",\"ep\":{\"nome\":0},\"ve\":0,\"ni\":\"\",\"te\":\"\",\"nAplic\":\"\"},{\"nAplic\":\"12\",\"ambiente\":\"asdf asdf asdf\",\"ep\":{\"nome\":\"2\"},\"ve\":\"(FE) Fezes\",\"ni\":\"(BX) Baixo\",\"te\":\"3 - ASSESSORIA SANITu00c3u0081RIA\"}]', '[{\"id\":\"\",\"qtd\":0,\"valor\":0,\"disp\":\"\",\"nAplic\":\"\",\"med\":\"\",\"ni\":\"\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"2\",\"nAplic\":\"2\",\"med\":\"10 GR\",\"valor\":\"21\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"1\",\"nAplic\":\"2\",\"med\":\"10 GR\",\"valor\":\"21\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"12\",\"nAplic\":\"2\",\"med\":\"10 GR\",\"valor\":\"21\"}]', 'asd fasd f', 'sadf asdf ', 'sadf asd fasdf asd f', ' asdf asdfasdf asdf asdf ', 0, 0),
(19, '[null,{\"nAplic\":\"1\",\"ambiente\":\"asd wqd\",\"ep\":{\"nome\":\"2 - ABELHAS\"},\"ve\":\"(IN) Informau00e7u00e3o\",\"ni\":\"(BX) Baixo\",\"te\":\"13 - LAUDO DE POTABILIDADE\"},{\"nAplic\":\"1\",\"ambiente\":\"asd wqd\",\"ep\":{\"nome\":\"2 - ABELHAS\"},\"ve\":\"(IN) Informau00e7u00e3o\",\"ni\":\"(BX) Baixo\",\"te\":\"13 - LAUDO DE POTABILIDADE\"},{\"nAplic\":\"1\",\"ambiente\":\"asd wqd\",\"ep\":{\"nome\":\"2 - ABELHAS\"},\"ve\":\"(IN) Informau00e7u00e3o\",\"ni\":\"(BX) Baixo\",\"te\":\"13 - LAUDO DE POTABILIDADE\"},{\"nAplic\":\"1\",\"ambiente\":\"asd wqd\",\"ep\":{\"nome\":\"2 - ABELHAS\"},\"ve\":\"(IN) Informau00e7u00e3o\",\"ni\":\"(BX) Baixo\",\"te\":\"13 - LAUDO DE POTABILIDADE\"}]', '[null,{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"1\",\"nAplic\":\"1\",\"med\":\"10 ML\",\"valor\":\"4.9\"},{\"id\":\"6\",\"produto\":\"nome do produto\",\"qtd\":\"1\",\"nAplic\":\"1\",\"med\":\"10 ML\",\"valor\":\"4.9\"}]', 'df asdf asdf ', 'asdf asdf asdf', ' asdf asf asdf as', 'df asf asf asf asdf asf', 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `servicos`
--

CREATE TABLE `servicos` (
  `SER_id` int(11) NOT NULL,
  `SER_nome` varchar(200) NOT NULL,
  `SER_descricao` varchar(200) NOT NULL,
  `SER_valor` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `servicos`
--

INSERT INTO `servicos` (`SER_id`, `SER_nome`, `SER_descricao`, `SER_valor`) VALUES
(2, 'ASSESSORIA-BPF', 'ASSESSORIA SANITÃRIA E MANUAL DE BOAS PRATICAS', 590),
(3, 'BPF', 'BOAS PRÃTICAS DE FÃBRICA', 316),
(4, 'CAL', 'COMODATO ARMADINHA LUMINOSA', 762),
(5, 'CAM', 'CONTROLE DE AVES E MORCEGOS', 331),
(6, 'CAP', 'CAPINA QUÃMICA', 454),
(7, 'CAR', 'CONTROLE DE ARACNÃDEOS', 166),
(8, 'CIR', 'CONTROLE DE INSETOS RASTEIROS', 262),
(9, 'CIR-CRO', 'CONTROLE DE INSETOS RASTEIROS E ROEDORES', 511),
(10, 'CIV', 'CONTROLE DE INSETOS VOADORES', 439),
(11, 'CIX', 'CONTROLE DE INSETOS XILÃ“FAGOS', 163),
(12, 'CRO', 'CONTROLE DE ROEDORES', 727),
(13, 'EX', 'EXPURGO', 421),
(14, 'HDR', 'HIGIENIZAÃ‡ÃƒO DE RESERVATÃ“RIOS', 198),
(15, 'HDR-PROCIP', 'HDR - PROGRAMA DE CONTROLE INTEGRADO DE PRAGAS', 366),
(16, 'HSA HIGIENE PROFISSIONAL', 'HSA - HIGIENE PROFISSIONAL', 346),
(17, 'IMPERMEABILIZAÃ‡ÃƒO', 'IMPERMEABILIZAÃ‡ÃƒO DE RESERVATÃ“RIOS', 608),
(18, 'LP', 'LAUDO POTABILIDADE', 363),
(19, 'MAL', 'MONITORAMENTO ARMADINHA LUMINOSA', 513),
(20, 'PROCIP', 'PROGRAMA DE CONTROLE INTEGRADO DE PRAGAS', 238),
(21, 'SIS', 'SISTEMA SENTRICON', 647);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tratamentos`
--

CREATE TABLE `tratamentos` (
  `TRA_id` int(11) NOT NULL,
  `TRA_sigla` varchar(2) NOT NULL,
  `TRA_nome` varchar(200) NOT NULL,
  `TRA_descricao` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tratamentos`
--

INSERT INTO `tratamentos` (`TRA_id`, `TRA_sigla`, `TRA_nome`, `TRA_descricao`) VALUES
(2, 'AS', 'ASPERSÃO', 'INTERVENÇÃO QUÍMICA'),
(3, 'SA', 'ASSESSORIA SANITÁRIA', '3 - MONITORAMENTO'),
(4, 'AT', 'ATOMIZÇÃO', 'INTERVENÇÃO QUÍMICA'),
(5, 'BF', 'BARREIRA FÍSICA', 'ATIVIDADES COMPLEMENTARES'),
(6, 'BQ', 'BARREIRA QUÍMICA', 'INTERVENÇÃO QUÍMICA'),
(7, 'DS', 'DESINFECÇÃO', 'ATIVIDADES COMPLEMENTARES'),
(8, 'FU', 'FUMIGAÇÃO', 'INTERVENÇÃO QUÍMICA'),
(9, 'IM', 'IMPERMEABILIZAÇÃO DE RESERVATÁÓRIOS ', 'ATIVIDADES COMPLEMENTARES'),
(10, 'IN', 'INJEÇÃO', 'INTERVENÇÃO QUÍMICA'),
(11, 'IS', 'ISCAGEM', 'ATIVIDADES COMPLEMENTARES'),
(12, 'JA', 'JATEAMENTO DAS PAREDES', 'INTERVENÇÃO QUÍMICA'),
(13, 'LP', 'LAUDO DE POTABILIDADE', 'ATIVIDADES COMPLEMENTARES'),
(14, 'MN', 'MONITORAMENTO', 'MONITORAMENTO'),
(15, 'PI', 'PINCELAMENTO', 'INTERVENÇÃO QUÍMICA'),
(16, 'PO', 'POLVILHAMENTO', 'ATIVIDADES COMPLEMENTARES'),
(17, 'RF', 'REMOÇÃO FÍSICA', 'ATIVIDADES COMPLEMENTARES'),
(18, 'RP', 'REPELÊNCIA', 'ATIVIDADES COMPLEMENTARES'),
(19, 'TN', 'TERMONEBULIZAÇÃO', 'INTERVENÇÃO QUÍMICA'),
(20, 'TC', 'TRINCHEIRA', 'ATIVIDADES COMPLEMENTARES');

-- --------------------------------------------------------

--
-- Estrutura da tabela `valores`
--

CREATE TABLE `valores` (
  `VAL_id` int(11) NOT NULL,
  `VAL_refeicao` float NOT NULL,
  `VAL_dia_operador` float NOT NULL,
  `VAL_dia_gestor` float NOT NULL,
  `VAL_hotel` float NOT NULL,
  `VAL_km` float NOT NULL,
  `VAL_material_escritorio` float NOT NULL,
  `VAL_lucro` float NOT NULL,
  `VAL_imposto` float NOT NULL,
  `VAL_comissao` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `valores`
--

INSERT INTO `valores` (`VAL_id`, `VAL_refeicao`, `VAL_dia_operador`, `VAL_dia_gestor`, `VAL_hotel`, `VAL_km`, `VAL_material_escritorio`, `VAL_lucro`, `VAL_imposto`, `VAL_comissao`) VALUES
(8, 15, 4.5, 50, 80, 0.4, 15, 50, 8.5, 1.43);

-- --------------------------------------------------------

--
-- Estrutura da tabela `veiculos`
--

CREATE TABLE `veiculos` (
  `VEI_id` int(11) NOT NULL,
  `VEI_codigo` int(11) NOT NULL,
  `VEI_veiculo` varchar(200) NOT NULL,
  `VEI_modelo` varchar(200) NOT NULL,
  `VEI_ano` varchar(200) NOT NULL,
  `VEI_placa` varchar(200) NOT NULL,
  `VEI_km_aquisicao` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `veiculos`
--

INSERT INTO `veiculos` (`VEI_id`, `VEI_codigo`, `VEI_veiculo`, `VEI_modelo`, `VEI_ano`, `VEI_placa`, `VEI_km_aquisicao`) VALUES
(1000, 1060, 'Gol 1.0 16v', '2011', '2010', 'BQP-1899', '15000'),
(1001, 1552, 'Gol 1.0 16v', '2012', '2011', 'QEE-6658', '152236');

-- --------------------------------------------------------

--
-- Estrutura da tabela `vestigios`
--

CREATE TABLE `vestigios` (
  `VES_id` int(11) NOT NULL,
  `VES_nome` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `vistoria`
--

CREATE TABLE `vistoria` (
  `VIS_id` int(11) NOT NULL,
  `SER_id` int(11) NOT NULL,
  `VIS_tipo` varchar(200) NOT NULL,
  `VIS_consultor1_id` int(11) NOT NULL,
  `VIS_consultor1_comissao` int(3) NOT NULL,
  `VIS_consultor2_id` int(11) NOT NULL,
  `VIS_consultor2_comissao` int(3) NOT NULL,
  `VIS_gestor_id` int(11) NOT NULL,
  `VIS_terreno_area` varchar(100) NOT NULL,
  `VIS_terreno_perimetro` varchar(20) NOT NULL,
  `VIS_construcao_area` varchar(20) NOT NULL,
  `VIS_construcao_perimetro` varchar(20) NOT NULL,
  `VIS_atividades_complementares` text NOT NULL,
  `VIS_ambientes_internos` text NOT NULL,
  `VIS_edificacoes` text NOT NULL,
  `VIS_ambientes_externos` text NOT NULL,
  `VIS_meio_urbano` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `vistoria`
--

INSERT INTO `vistoria` (`VIS_id`, `SER_id`, `VIS_tipo`, `VIS_consultor1_id`, `VIS_consultor1_comissao`, `VIS_consultor2_id`, `VIS_consultor2_comissao`, `VIS_gestor_id`, `VIS_terreno_area`, `VIS_terreno_perimetro`, `VIS_construcao_area`, `VIS_construcao_perimetro`, `VIS_atividades_complementares`, `VIS_ambientes_internos`, `VIS_edificacoes`, `VIS_ambientes_externos`, `VIS_meio_urbano`) VALUES
(1, 10, '', 28, 0, 34, 0, 32, '2.1342', '2342', '23423', '2.3123', 'sadfasdf', 'sdfasdfas d', 'fasdfasdf', 'asdf asdfas', 'dfasdf asdfasdf'),
(2, 10, '', 34, 0, 28, 0, 32, '2.1342', '2342', '23423', '2.3123', 'sadfasdf', 'sdfasdfas d', 'fasdfasdf', 'asdf asdfas', 'dfasdf asdfasdf'),
(3, 10, '', 28, 0, 34, 0, 32, '2.1342', '2342', '23423', '2.3123', 'sadfasdf', 'sdfasdfas d', 'fasdfasdf', 'asdf asdfas', 'dfasdf asdfasdf'),
(15, 10, '', 0, 0, 0, 0, 0, '23', '234', '4323', '23', 'asdfasd', 'asdfasdf', 'asdfasdfa', 'sdfasdfasd', 'fasdfasdfasdfa'),
(17, 10, '', 34, 0, 28, 0, 32, '21343', '2323', '122', '2324', 'Atividades complementares', 'Descri??o dos ambientes internos\r\n', 'Condi??es espec?ficas de edifica??o\r\n', 'Descri??o dos ambientes externos\r\n', 'Descri??o do meio urbano pr?ximo\r\n'),
(18, 10, '', 34, 0, 28, 0, 32, '654654', '654654', '654654', '654654', 'Atividades complementares\r\n', 'Descrição dos ambientes internos\r\n', 'Condições específicas de edificação\r\n', 'Descrição dos ambientes externos\r\n', 'Descrição do meio urbano próximo\r\n');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `biologica`
--
ALTER TABLE `biologica`
  ADD PRIMARY KEY (`BIO_id`);

--
-- Índices para tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`CLI_id`);

--
-- Índices para tabela `contatos`
--
ALTER TABLE `contatos`
  ADD PRIMARY KEY (`CON_id`);

--
-- Índices para tabela `contrato`
--
ALTER TABLE `contrato`
  ADD PRIMARY KEY (`CON_id`);

--
-- Índices para tabela `equipes`
--
ALTER TABLE `equipes`
  ADD PRIMARY KEY (`EQU_id`);

--
-- Índices para tabela `formacao_preco`
--
ALTER TABLE `formacao_preco`
  ADD PRIMARY KEY (`FOR_id`);

--
-- Índices para tabela `fornecedor`
--
ALTER TABLE `fornecedor`
  ADD PRIMARY KEY (`FOR_id`);

--
-- Índices para tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`FUN_id`);

--
-- Índices para tabela `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`GRU_id`);

--
-- Índices para tabela `luminosa`
--
ALTER TABLE `luminosa`
  ADD PRIMARY KEY (`LUM_id`);

--
-- Índices para tabela `ocorrencia_pragas`
--
ALTER TABLE `ocorrencia_pragas`
  ADD PRIMARY KEY (`OCO_id`);

--
-- Índices para tabela `orcamentos`
--
ALTER TABLE `orcamentos`
  ADD PRIMARY KEY (`ORC_id`);

--
-- Índices para tabela `ordem_servico`
--
ALTER TABLE `ordem_servico`
  ADD PRIMARY KEY (`ORD_id`);

--
-- Índices para tabela `outros`
--
ALTER TABLE `outros`
  ADD PRIMARY KEY (`OUT_id`);

--
-- Índices para tabela `ponto`
--
ALTER TABLE `ponto`
  ADD PRIMARY KEY (`PON_id`);

--
-- Índices para tabela `ppe`
--
ALTER TABLE `ppe`
  ADD PRIMARY KEY (`PPE_id`);

--
-- Índices para tabela `ppi`
--
ALTER TABLE `ppi`
  ADD PRIMARY KEY (`PPI_id`);

--
-- Índices para tabela `pragas`
--
ALTER TABLE `pragas`
  ADD PRIMARY KEY (`PRA_id`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`PRO_id`);

--
-- Índices para tabela `recursos_materiais`
--
ALTER TABLE `recursos_materiais`
  ADD PRIMARY KEY (`REC_id`);

--
-- Índices para tabela `servicos`
--
ALTER TABLE `servicos`
  ADD PRIMARY KEY (`SER_id`);

--
-- Índices para tabela `tratamentos`
--
ALTER TABLE `tratamentos`
  ADD PRIMARY KEY (`TRA_id`);

--
-- Índices para tabela `valores`
--
ALTER TABLE `valores`
  ADD PRIMARY KEY (`VAL_id`);

--
-- Índices para tabela `veiculos`
--
ALTER TABLE `veiculos`
  ADD PRIMARY KEY (`VEI_id`);

--
-- Índices para tabela `vestigios`
--
ALTER TABLE `vestigios`
  ADD PRIMARY KEY (`VES_id`);

--
-- Índices para tabela `vistoria`
--
ALTER TABLE `vistoria`
  ADD PRIMARY KEY (`VIS_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `biologica`
--
ALTER TABLE `biologica`
  MODIFY `BIO_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `CLI_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `contatos`
--
ALTER TABLE `contatos`
  MODIFY `CON_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `contrato`
--
ALTER TABLE `contrato`
  MODIFY `CON_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `equipes`
--
ALTER TABLE `equipes`
  MODIFY `EQU_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT de tabela `formacao_preco`
--
ALTER TABLE `formacao_preco`
  MODIFY `FOR_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `fornecedor`
--
ALTER TABLE `fornecedor`
  MODIFY `FOR_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `FUN_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de tabela `grupo`
--
ALTER TABLE `grupo`
  MODIFY `GRU_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `luminosa`
--
ALTER TABLE `luminosa`
  MODIFY `LUM_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `ocorrencia_pragas`
--
ALTER TABLE `ocorrencia_pragas`
  MODIFY `OCO_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `orcamentos`
--
ALTER TABLE `orcamentos`
  MODIFY `ORC_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Orçamento', AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `ordem_servico`
--
ALTER TABLE `ordem_servico`
  MODIFY `ORD_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=302;

--
-- AUTO_INCREMENT de tabela `outros`
--
ALTER TABLE `outros`
  MODIFY `OUT_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `ponto`
--
ALTER TABLE `ponto`
  MODIFY `PON_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `ppe`
--
ALTER TABLE `ppe`
  MODIFY `PPE_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `ppi`
--
ALTER TABLE `ppi`
  MODIFY `PPI_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `pragas`
--
ALTER TABLE `pragas`
  MODIFY `PRA_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `PRO_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `recursos_materiais`
--
ALTER TABLE `recursos_materiais`
  MODIFY `REC_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `servicos`
--
ALTER TABLE `servicos`
  MODIFY `SER_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `tratamentos`
--
ALTER TABLE `tratamentos`
  MODIFY `TRA_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `valores`
--
ALTER TABLE `valores`
  MODIFY `VAL_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `veiculos`
--
ALTER TABLE `veiculos`
  MODIFY `VEI_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1002;

--
-- AUTO_INCREMENT de tabela `vestigios`
--
ALTER TABLE `vestigios`
  MODIFY `VES_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `vistoria`
--
ALTER TABLE `vistoria`
  MODIFY `VIS_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
