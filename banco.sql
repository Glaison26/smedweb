-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.30 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Copiando estrutura para tabela smed.agenda
CREATE TABLE IF NOT EXISTS `agenda` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_profissional` int NOT NULL,
  `data` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_agenda_profissionais` (`id_profissional`),
  CONSTRAINT `FK_agenda_profissionais` FOREIGN KEY (`id_profissional`) REFERENCES `profissionais` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.agenda: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela smed.agendaconfig
CREATE TABLE IF NOT EXISTS `agendaconfig` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_profissional` int NOT NULL,
  `dia` int NOT NULL,
  `inicio1` time DEFAULT NULL,
  `fim1` time DEFAULT NULL,
  `duracao1` int DEFAULT NULL,
  `inicio2` time DEFAULT NULL,
  `fim2` time DEFAULT NULL,
  `duracao2` int DEFAULT NULL,
  `inicio3` time DEFAULT NULL,
  `fim3` time DEFAULT NULL,
  `duracao3` int DEFAULT NULL,
  `Habilitado` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_agendaconfig_profissionais` (`id_profissional`),
  CONSTRAINT `FK_agendaconfig_profissionais` FOREIGN KEY (`id_profissional`) REFERENCES `profissionais` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.agendaconfig: ~0 rows (aproximadamente)
REPLACE INTO `agendaconfig` (`id`, `id_profissional`, `dia`, `inicio1`, `fim1`, `duracao1`, `inicio2`, `fim2`, `duracao2`, `inicio3`, `fim3`, `duracao3`, `Habilitado`) VALUES
	(7, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(8, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(9, 1, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(10, 1, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(11, 1, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(12, 1, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(13, 1, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- Copiando estrutura para tabela smed.atestados
CREATE TABLE IF NOT EXISTS `atestados` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(150) NOT NULL,
  `texto` blob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.atestados: ~3 rows (aproximadamente)
REPLACE INTO `atestados` (`id`, `descricao`, `texto`) VALUES
	(2, 'Dieta para diabetes', _binary 0x436f6d6572206d656e6f732061c3a775636172),
	(8, 'RDPP', _binary 0x746573746520646520746573746f20706172612052445050),
	(10, 'AREOLAR', _binary 0x746578746f204152454f4c4152);

-- Copiando estrutura para tabela smed.atributos_parametros_eventos
CREATE TABLE IF NOT EXISTS `atributos_parametros_eventos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_parametro` int NOT NULL,
  `descricao` varchar(150) NOT NULL,
  `formato` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_atributos_parametros_eventos_parametros_eventos` (`id_parametro`),
  CONSTRAINT `FK_atributos_parametros_eventos_parametros_eventos` FOREIGN KEY (`id_parametro`) REFERENCES `parametros_eventos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.atributos_parametros_eventos: ~4 rows (aproximadamente)
REPLACE INTO `atributos_parametros_eventos` (`id`, `id_parametro`, `descricao`, `formato`) VALUES
	(1, 1, 'Atributo 1', '999'),
	(2, 1, 'atributo 2', '99.99'),
	(3, 1, 'atributo 3', '99'),
	(6, 2, 'atributo 33', '999.99');

-- Copiando estrutura para tabela smed.bateria
CREATE TABLE IF NOT EXISTS `bateria` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(200) NOT NULL DEFAULT '',
  `exames` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.bateria: ~2 rows (aproximadamente)
REPLACE INTO `bateria` (`id`, `descricao`, `exames`) VALUES
	(1, 'PADRÃO', _binary 0x312e20416e7465636564656e74657320436972fa726769636f733a0d0a0d0a0d0a0d0a322e20416e7465636564656e74657320436c696e69636f733a0d0a0d0a0d0a0d0a332e20456e6665726d696461646520417475616c203a0d0a0d0a0d0a342e204d6564696361e7e36f20656d20557375616c3a0d0a0d0a0d0a352e20486970657273656e736962696c6964616465204d65646963616d656e746f7361203a0d0a0d0a0d0a362e2048e16269746f730d0a0d0a0d0a372e204578616d652046ed7369636f203a0d0a0d0a0d0a502e413a20202020202020202020202020202020202020462e433a202020202020202020202020202020205065736f3a0d0a0d0a0d0a382e204578616d657320436f6d706c656d656e7461726573203a0d0a0d0a0d0a392e20436f6e636c7573e36f203a0d0a0d0a),
	(2, 'Exame de Rotina', _binary 0x0d0a312e2050616369656e746520656d20626f6d2065737461646f20676572616c2c2073617564c3a176656c0d0a322e20525455204445205052c39353544154410d0a);

-- Copiando estrutura para tabela smed.componentes
CREATE TABLE IF NOT EXISTS `componentes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_grupo_componente` int NOT NULL DEFAULT '0',
  `descricao` varchar(100) NOT NULL,
  `unidade` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_componentes_grupo_componentes` (`id_grupo_componente`),
  CONSTRAINT `FK_componentes_grupo_componentes` FOREIGN KEY (`id_grupo_componente`) REFERENCES `grupo_componentes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.componentes: ~4 rows (aproximadamente)
REPLACE INTO `componentes` (`id`, `id_grupo_componente`, `descricao`, `unidade`) VALUES
	(19, 1, 'Fenoratica', 'un'),
	(20, 1, 'Ácido bórico', 'un'),
	(21, 2, 'Amônia', 'un'),
	(22, 3, 'Fosfato', 'un');

-- Copiando estrutura para tabela smed.convenios
CREATE TABLE IF NOT EXISTS `convenios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_tabela` int DEFAULT NULL,
  `nome` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `razaosocial` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `cnpj` varchar(18) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `inscestad` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `inscmunicipal` varchar(14) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `endereco` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `bairro` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `cidade` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `cep` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `uf` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `fone1` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `fone2` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `diaenvio` char(2) DEFAULT NULL,
  `diapagamento` char(2) DEFAULT NULL,
  `percentch` varchar(3) DEFAULT NULL,
  `contato` varchar(100) DEFAULT NULL,
  `obs` blob,
  PRIMARY KEY (`id`),
  KEY `FK_convenios_tabela` (`id_tabela`),
  CONSTRAINT `FK_convenios_tabela` FOREIGN KEY (`id_tabela`) REFERENCES `tabela` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.convenios: ~2 rows (aproximadamente)
REPLACE INTO `convenios` (`id`, `id_tabela`, `nome`, `razaosocial`, `cnpj`, `inscestad`, `inscmunicipal`, `endereco`, `bairro`, `cidade`, `cep`, `uf`, `fone1`, `fone2`, `email`, `url`, `diaenvio`, `diapagamento`, `percentch`, `contato`, `obs`) VALUES
	(1, 2, 'Unimed', 'Unimed SA', '75515874000180', '411432', '41234123', 'teste', 'tste', 'Belo Horizonte', '34505480', 'MG', '(31) 589-6369', '(31) 6958-5544', 'unimed@unimed.com.br', 'teste', '', '', '100', 'Joelson', _binary ''),
	(2, 1, 'Casu', 'Casu SA', '00172442000115', '', '', '', '', '', '', 'AC', '(48) 2759-4679', '(31) 6995-5555', 'suporte@sabara.mg.gov.br', '', '', '', '', 'Glaison', _binary '');

-- Copiando estrutura para tabela smed.diagnosticos
CREATE TABLE IF NOT EXISTS `diagnosticos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cid` varchar(10) DEFAULT NULL,
  `descricao` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.diagnosticos: ~3 rows (aproximadamente)
REPLACE INTO `diagnosticos` (`id`, `cid`, `descricao`) VALUES
	(1, 'A00', 'Cólera'),
	(6, 'G00', 'Meningite Bacteriana Não Classificada em Outra Parte');

-- Copiando estrutura para tabela smed.especialidades
CREATE TABLE IF NOT EXISTS `especialidades` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.especialidades: ~4 rows (aproximadamente)
REPLACE INTO `especialidades` (`id`, `descricao`) VALUES
	(1, 'Pediatria'),
	(2, 'Oftalmologia'),
	(4, 'Geriatria 1');

-- Copiando estrutura para tabela smed.exames
CREATE TABLE IF NOT EXISTS `exames` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_grupo` int DEFAULT NULL,
  `descricao` varchar(200) DEFAULT NULL,
  `material` varchar(150) DEFAULT NULL,
  `metodo` varchar(150) DEFAULT NULL,
  `valref` blob,
  PRIMARY KEY (`id`),
  KEY `FK_exames_grupos_laudos` (`id_grupo`),
  CONSTRAINT `FK_exames_grupos_laudos` FOREIGN KEY (`id_grupo`) REFERENCES `grupos_laudos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.exames: ~3 rows (aproximadamente)
REPLACE INTO `exames` (`id`, `id_grupo`, `descricao`, `material`, `metodo`, `valref`) VALUES
	(1, 1, 'Paciente em bom estado geral, saudável', 'Sangue, Urina e Fezes', 'Analise de laboratorial', _binary 0x666673646666617364),
	(3, 2, 'RISCO CIRURGICO DISCRETO', 'Sangue e Urina', 'Laboratorial', _binary 0x524953434f2043495255524749434f20444953435245544f2028415341204949204f5520474f4c444d414e20494929),
	(4, 4, 'RTU DE PRÓSTATA', 'Não se aplica', 'Toque', _binary 0x53656e736962696c696461646522);

-- Copiando estrutura para tabela smed.formulas_pre
CREATE TABLE IF NOT EXISTS `formulas_pre` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(150) DEFAULT NULL,
  `formula` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.formulas_pre: ~3 rows (aproximadamente)
REPLACE INTO `formulas_pre` (`id`, `descricao`, `formula`) VALUES
	(1, 'Formula Fixa', _binary 0x546578746f206465207072696d6569726120666f726d756c610d0ac3816369646f2062c3b37269636f202020202020756e0d0ac3816369646f2062c3b37269636f202020202020756e0d0ac3816369646f2062c3b37269636f202020202020756e0d0ac3816369646f2062c3b37269636f202020202020756e0d0a466f736661746f202020202020756e0d0ac3816369646f2062c3b37269636f202020202020756e0d0ac3816369646f2062c3b37269636f202020202020756e0d0a0d0a416dc3b46e6961202020202020756e0d0a),
	(2, 'Formula Padrão', _binary 0xc3816369646f2062c3b37269636f2031322020202020756e0d0a466f736661746f2020313520202020756e0d0a);

-- Copiando estrutura para tabela smed.grupos_exames
CREATE TABLE IF NOT EXISTS `grupos_exames` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.grupos_exames: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela smed.grupos_formulas
CREATE TABLE IF NOT EXISTS `grupos_formulas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(150) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.grupos_formulas: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela smed.grupos_laudos
CREATE TABLE IF NOT EXISTS `grupos_laudos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.grupos_laudos: ~4 rows (aproximadamente)
REPLACE INTO `grupos_laudos` (`id`, `descricao`) VALUES
	(1, 'Exames Físicos'),
	(2, 'Antecedentes Cirúrgicos'),
	(4, 'PROSTATECTOMIA'),
	(5, 'PSORÍASE'),
	(6, 'ABDOMENOPLASTIA');

-- Copiando estrutura para tabela smed.grupos_medicamentos
CREATE TABLE IF NOT EXISTS `grupos_medicamentos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.grupos_medicamentos: ~3 rows (aproximadamente)
REPLACE INTO `grupos_medicamentos` (`id`, `descricao`) VALUES
	(1, 'Analgésicos'),
	(2, 'Medicamentos Dermatológicos');

-- Copiando estrutura para tabela smed.grupo_componentes
CREATE TABLE IF NOT EXISTS `grupo_componentes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.grupo_componentes: ~4 rows (aproximadamente)
REPLACE INTO `grupo_componentes` (`id`, `descricao`) VALUES
	(1, 'Exames Acidos'),
	(2, 'Exames de sangue'),
	(3, 'Exames de Feses');

-- Copiando estrutura para tabela smed.historia
CREATE TABLE IF NOT EXISTS `historia` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_paciente` int DEFAULT NULL,
  `historia` blob,
  `data` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_historia_pacientes` (`id_paciente`),
  CONSTRAINT `FK_historia_pacientes` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.historia: ~2 rows (aproximadamente)
REPLACE INTO `historia` (`id`, `id_paciente`, `historia`, `data`) VALUES
	(1, 1, _binary 0x48697374c3b372696120436cc3ad6e69636120646f2050616369656e7465, NULL),
	(2, 3, _binary '', NULL);

-- Copiando estrutura para tabela smed.imagens_pacientes
CREATE TABLE IF NOT EXISTS `imagens_pacientes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_paciente` int NOT NULL,
  `pasta_imagem` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `data` date NOT NULL,
  `descricao` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_imagens_pacientes_pacientes` (`id_paciente`),
  CONSTRAINT `FK_imagens_pacientes_pacientes` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.imagens_pacientes: ~7 rows (aproximadamente)
REPLACE INTO `imagens_pacientes` (`id`, `id_paciente`, `pasta_imagem`, `data`, `descricao`) VALUES
	(2, 1, 'img/WhatsApp Image 2023-06-19 at 14.10.15.jpeg6260.png', '2024-07-09', NULL),
	(3, 1, 'img/WhatsApp Image 2023-06-19 at 14.10.15.jpeg6260.png', '2024-07-09', NULL),
	(4, 1, 'img/WhatsApp Image 2023-06-19 at 14.10.15.jpeg6260.png', '2024-07-09', NULL),
	(5, 3, 'img/imagem1.jpeg', '2024-07-01', 'Procedimento inicial'),
	(6, 3, 'img/imagem2.jpeg', '2024-07-07', 'Procedimento com lazer'),
	(7, 3, 'img/imagem3.jpeg', '2024-07-09', 'Resultado Final Ultima consulta');

-- Copiando estrutura para tabela smed.indices
CREATE TABLE IF NOT EXISTS `indices` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `valor` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.indices: ~4 rows (aproximadamente)
REPLACE INTO `indices` (`id`, `descricao`, `valor`) VALUES
	(1, 'Real', 1),
	(21, 'Dollar', 5.5),
	(22, 'UTR', 30);

-- Copiando estrutura para tabela smed.medicamentos
CREATE TABLE IF NOT EXISTS `medicamentos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_grupo` int DEFAULT NULL,
  `descricao` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `FK_medicamentos_grupos_medicamentos` (`id_grupo`),
  CONSTRAINT `FK_medicamentos_grupos_medicamentos` FOREIGN KEY (`id_grupo`) REFERENCES `grupos_medicamentos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.medicamentos: ~5 rows (aproximadamente)
REPLACE INTO `medicamentos` (`id`, `id_grupo`, `descricao`) VALUES
	(1, 2, 'VITANOL-A'),
	(2, 1, 'TYLENOL'),
	(3, 1, 'PSOREX'),
	(4, 2, 'POVIDINE');

-- Copiando estrutura para tabela smed.medicamento_apresentacao
CREATE TABLE IF NOT EXISTS `medicamento_apresentacao` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_medicamento` int NOT NULL,
  `apresentacao` varchar(50) NOT NULL DEFAULT '',
  `volume` varchar(50) DEFAULT NULL,
  `quantidade` varchar(50) DEFAULT NULL,
  `embalagem` varchar(50) DEFAULT NULL,
  `uso` varchar(50) DEFAULT NULL,
  `termo` varchar(50) DEFAULT NULL,
  `veiculo` varchar(50) DEFAULT NULL,
  `observacao` blob,
  PRIMARY KEY (`id`),
  KEY `FK_medicamento_apresentacao_medicamentos` (`id_medicamento`),
  CONSTRAINT `FK_medicamento_apresentacao_medicamentos` FOREIGN KEY (`id_medicamento`) REFERENCES `medicamentos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.medicamento_apresentacao: ~3 rows (aproximadamente)
REPLACE INTO `medicamento_apresentacao` (`id`, `id_medicamento`, `apresentacao`, `volume`, `quantidade`, `embalagem`, `uso`, `termo`, `veiculo`, `observacao`) VALUES
	(1, 3, 'Pastilha', '30 ml', '12', 'Caixa', 'Oral', 'remedio', 'Oral', _binary 0x7465737465),
	(2, 3, 'Ampola', '15 ml', '20', 'Caixa', 'Injetável', 'Intra Muscular', 'Oral', _binary 0x7465737465),
	(3, 3, 'Ampola', '120 ml', '1 dose', 'frasco', 'diário', 'continuo', 'Injetavel', _binary '');

-- Copiando estrutura para tabela smed.orientacoes_padrao
CREATE TABLE IF NOT EXISTS `orientacoes_padrao` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(150) DEFAULT NULL,
  `texto` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.orientacoes_padrao: ~2 rows (aproximadamente)
REPLACE INTO `orientacoes_padrao` (`id`, `descricao`, `texto`) VALUES
	(1, 'Dieta para hipertensão', _binary 0x436f72726572203130206b6d0d0a50756c617220436f7264610d0a436f7274617220616c696d656e746f7320476f726475726f736f73),
	(2, 'Dieta para diabetes', _binary 0x436f6d6572206d656e6f732061c3a7756361722e0a0a5072617469636172206578657263c3ad63696f732046c3ad7369636f732e);

-- Copiando estrutura para tabela smed.pacientes
CREATE TABLE IF NOT EXISTS `pacientes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_convenio` int NOT NULL,
  `id_profissional` int DEFAULT NULL,
  `nome` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `sexo` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `cor` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `datanasc` date DEFAULT NULL,
  `estadocivil` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `mae` varchar(150) DEFAULT NULL,
  `pai` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `endereco` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `bairro` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `cidade` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `cep` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `uf` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `fone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `fone2` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `profissao` varchar(100) DEFAULT NULL,
  `indicacao` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `dataprimeira` date DEFAULT NULL,
  `obs` blob,
  `classificacao` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `naturalidade` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `procedencia` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `matricula` varchar(50) DEFAULT NULL,
  `cpf` varchar(11) DEFAULT NULL,
  `identidade` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_pacientes_convenios` (`id_convenio`),
  KEY `FK_pacientes_profissionais` (`id_profissional`),
  CONSTRAINT `FK_pacientes_convenios` FOREIGN KEY (`id_convenio`) REFERENCES `convenios` (`id`),
  CONSTRAINT `FK_pacientes_profissionais` FOREIGN KEY (`id_profissional`) REFERENCES `profissionais` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.pacientes: ~1 rows (aproximadamente)
REPLACE INTO `pacientes` (`id`, `id_convenio`, `id_profissional`, `nome`, `sexo`, `cor`, `datanasc`, `estadocivil`, `mae`, `pai`, `endereco`, `bairro`, `cidade`, `cep`, `uf`, `email`, `fone`, `fone2`, `profissao`, `indicacao`, `dataprimeira`, `obs`, `classificacao`, `naturalidade`, `procedencia`, `matricula`, `cpf`, `identidade`) VALUES
	(1, 1, 2, 'Glaison Queiroz ', 'M', 'Faio', '1968-10-26', 'Casado', 'Emilia ', 'Valdir Queiroz', 'Ruada Intendência, 316', 'Centro', 'Sabará', '34505480', 'SP', 'glaison26.queiroz@gmail.com', '(31)36722550', '(31)984262508', 'Programador', 'não se aplica', '2024-07-01', _binary 0x7465737465, 'Clinica', 'Brasileiro', 'Sabará', '88845665', '69551022653', 'm4662097'),
	(3, 2, NULL, 'Maria da Graça', 'M', 'Leuco', '1985-11-26', 'Solteiro', '', '', '', '', '', '', 'MG', '', '(31) 6995-5666', '', '', '', '2024-07-03', _binary '', '', '', '', '45646546', '', '');

-- Copiando estrutura para tabela smed.parametros_eventos
CREATE TABLE IF NOT EXISTS `parametros_eventos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.parametros_eventos: ~2 rows (aproximadamente)
REPLACE INTO `parametros_eventos` (`id`, `descricao`) VALUES
	(1, 'Parametro de Testes'),
	(2, 'Segundo Parâmetro');

-- Copiando estrutura para tabela smed.procedimentos
CREATE TABLE IF NOT EXISTS `procedimentos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_especialidade` int DEFAULT NULL,
  `descricao` varchar(200) NOT NULL,
  `codigoamb` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_procedimentos_especialidades` (`id_especialidade`),
  CONSTRAINT `FK_procedimentos_especialidades` FOREIGN KEY (`id_especialidade`) REFERENCES `especialidades` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.procedimentos: ~2 rows (aproximadamente)
REPLACE INTO `procedimentos` (`id`, `id_especialidade`, `descricao`, `codigoamb`) VALUES
	(12, 1, 'Ligadura Elástica do Esôfago, Estômago e Duodeno', '45658789'),
	(13, 2, 'Laringoscopia/Traqueoscopia para Intubação Oro ou Nasotraqueal', '24010080');

-- Copiando estrutura para tabela smed.procedimentos_tabelas
CREATE TABLE IF NOT EXISTS `procedimentos_tabelas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_procedimento` int NOT NULL,
  `id_tabela` int NOT NULL,
  `custo` float DEFAULT NULL,
  `valorreal` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_procedimentos_tabelas_tabela` (`id_tabela`),
  KEY `FK_procedimentos_tabelas_procedimentos` (`id_procedimento`),
  CONSTRAINT `FK_procedimentos_tabelas_procedimentos` FOREIGN KEY (`id_procedimento`) REFERENCES `procedimentos` (`id`),
  CONSTRAINT `FK_procedimentos_tabelas_tabela` FOREIGN KEY (`id_tabela`) REFERENCES `tabela` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.procedimentos_tabelas: ~4 rows (aproximadamente)
REPLACE INTO `procedimentos_tabelas` (`id`, `id_procedimento`, `id_tabela`, `custo`, `valorreal`) VALUES
	(2, 12, 1, 20, 20),
	(4, 12, 2, 300, 1650),
	(6, 13, 1, 40, 40),
	(8, 13, 2, 63, 346.5);

-- Copiando estrutura para tabela smed.profissionais
CREATE TABLE IF NOT EXISTS `profissionais` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_especialidade` int NOT NULL,
  `nome` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `endereco` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `bairro` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `cidade` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `cep` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `uf` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `fone1` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `fone2` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `url` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `identidade` varchar(20) DEFAULT NULL,
  `cpf` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `datanasc` date DEFAULT NULL,
  `sexo` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `gera_agenda` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `observacao` blob,
  `crm` varchar(13) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_profissionais_especialidades` (`id_especialidade`),
  CONSTRAINT `FK_profissionais_especialidades` FOREIGN KEY (`id_especialidade`) REFERENCES `especialidades` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.profissionais: ~2 rows (aproximadamente)
REPLACE INTO `profissionais` (`id`, `id_especialidade`, `nome`, `endereco`, `bairro`, `cidade`, `cep`, `uf`, `fone1`, `fone2`, `email`, `url`, `identidade`, `cpf`, `datanasc`, `sexo`, `gera_agenda`, `observacao`, `crm`) VALUES
	(1, 2, 'Dr. Glaison Queiroz', '', '', '', '', 'MG', '(48) 2759-4679', '(31) 2121-2223', 'suporte@sabara.mg.gov.br', NULL, '4565465', '69551022653', '2009-07-13', 'M', 'S', _binary 0x7465737465206465206f627365727661c3a7c3a36f, '565465'),
	(2, 1, 'Dr. Maria de Souza Crus', 'Beco da Chica,100', 'Campeche', 'Belo Horizonte', '3450480', 'MG', '(31) 589-6369', '(31) 6995-5555', 'dasilva@gmail.com', NULL, '', '07415768051', '1997-11-04', 'M', 'S', _binary '', 'crm/mg 456456');

-- Copiando estrutura para tabela smed.tabela
CREATE TABLE IF NOT EXISTS `tabela` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_indice` int DEFAULT NULL,
  `descricao` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tabela_indices` (`id_indice`),
  CONSTRAINT `FK_tabela_indices` FOREIGN KEY (`id_indice`) REFERENCES `indices` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.tabela: ~2 rows (aproximadamente)
REPLACE INTO `tabela` (`id`, `id_indice`, `descricao`) VALUES
	(1, 1, 'TUSS'),
	(2, 21, 'Tabela1');

-- Copiando estrutura para tabela smed.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(250) DEFAULT NULL,
  `login` varchar(30) DEFAULT NULL,
  `senha` varchar(20) DEFAULT NULL,
  `ativo` char(1) DEFAULT NULL,
  `prescricoes` char(1) DEFAULT NULL,
  `pacientesdados` char(1) DEFAULT NULL,
  `pacienteshistoria` char(1) DEFAULT NULL,
  `agendamarcacao` char(1) DEFAULT NULL,
  `agendageracao` char(1) DEFAULT NULL,
  `cadastros` char(1) DEFAULT NULL,
  `tipo` char(1) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.usuario: ~3 rows (aproximadamente)
REPLACE INTO `usuario` (`id`, `nome`, `login`, `senha`, `ativo`, `prescricoes`, `pacientesdados`, `pacienteshistoria`, `agendamarcacao`, `agendageracao`, `cadastros`, `tipo`, `email`, `telefone`) VALUES
	(1, 'Glaison Queiroz', 'Glaison', 'MTIzNDU2Nzg=', 'S', NULL, NULL, NULL, NULL, NULL, NULL, '1', 'glaison26.queiroz@gmail.com', '3136712550'),
	(2, 'Glaison Queiroz', 'Glaison2', 'MTIzNDU2Nzg=', 'S', NULL, NULL, NULL, NULL, NULL, NULL, '1', 'suporte@sabara.mg.gov.br', '3136712550'),
	(3, 'José da Silva', 'dasilva', 'MTIzNDU2Nzg=', 'S', NULL, NULL, NULL, NULL, NULL, NULL, '2', 'dasilva@gmail.com', '3678985412');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
