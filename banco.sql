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
  `novo` char(1) DEFAULT NULL,
  `compareceu` char(1) DEFAULT NULL,
  `atendido` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_agenda_profissionais` (`id_profissional`),
  CONSTRAINT `FK_agenda_profissionais` FOREIGN KEY (`id_profissional`) REFERENCES `profissionais` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.agenda: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela smed.agendaconfig
CREATE TABLE IF NOT EXISTS `agendaconfig` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_agenda` int NOT NULL,
  `inicio1` time NOT NULL,
  `fim1` time NOT NULL,
  `duracao1` int NOT NULL,
  `inicio2` time NOT NULL,
  `fim2` time NOT NULL,
  `duracao2` int NOT NULL,
  `inicio3` time NOT NULL,
  `fim3` time NOT NULL,
  `duracao3` int NOT NULL,
  `Habilitado` char(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_agendaconfig_agenda` (`id_agenda`),
  CONSTRAINT `FK_agendaconfig_agenda` FOREIGN KEY (`id_agenda`) REFERENCES `agenda` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.agendaconfig: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela smed.atestados
CREATE TABLE IF NOT EXISTS `atestados` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(150) NOT NULL,
  `texto` blob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.atestados: ~0 rows (aproximadamente)
REPLACE INTO `atestados` (`id`, `descricao`, `texto`) VALUES
	(2, 'SEROSA', _binary 0x546578746f20646520617465737461646f207365726f7361),
	(8, 'RDPP', _binary 0x746573746520646520746573746f20706172612052445050),
	(10, 'AREOLAR', _binary 0x746578746f204152454f4c4152);

-- Copiando estrutura para tabela smed.atributos_parametros_eventos
CREATE TABLE IF NOT EXISTS `atributos_parametros_eventos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_parametro` int NOT NULL,
  `descricao` varchar(150) NOT NULL,
  `formato` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_atributos_parametros_eventos_parametros_eventos` (`id_parametro`),
  CONSTRAINT `FK_atributos_parametros_eventos_parametros_eventos` FOREIGN KEY (`id_parametro`) REFERENCES `parametros_eventos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.atributos_parametros_eventos: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela smed.componentes
CREATE TABLE IF NOT EXISTS `componentes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_grupo_componente` int NOT NULL DEFAULT '0',
  `descricao` varchar(100) NOT NULL,
  `unidade` varchar(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_componentes_grupo_componentes` (`id_grupo_componente`),
  CONSTRAINT `FK_componentes_grupo_componentes` FOREIGN KEY (`id_grupo_componente`) REFERENCES `grupo_componentes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.componentes: ~0 rows (aproximadamente)

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

-- Copiando estrutura para tabela smed.grupos_exames
CREATE TABLE IF NOT EXISTS `grupos_exames` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.grupos_exames: ~0 rows (aproximadamente)

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
  `id` int NOT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.grupo_componentes: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela smed.historia
CREATE TABLE IF NOT EXISTS `historia` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_paciente` int DEFAULT NULL,
  `historia` blob,
  `data` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_historia_pacientes` (`id_paciente`),
  CONSTRAINT `FK_historia_pacientes` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.historia: ~0 rows (aproximadamente)

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.medicamentos: ~2 rows (aproximadamente)
REPLACE INTO `medicamentos` (`id`, `id_grupo`, `descricao`) VALUES
	(1, 2, 'VITANOL-A'),
	(2, 1, 'TYLENOL');

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
  `observacao` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.medicamento_apresentacao: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela smed.pacientes
CREATE TABLE IF NOT EXISTS `pacientes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_convenio` int NOT NULL,
  `id_profissional` int NOT NULL,
  `nome` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `sexo` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `cor` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `datanasc` date NOT NULL,
  `estadocivil` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `mae` varchar(150) DEFAULT NULL,
  `pae` varchar(150) DEFAULT NULL,
  `endereco` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `bairro` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `cidade` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `cep` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `uf` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `fone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `fone2` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `profissao` varchar(100) DEFAULT NULL,
  `indicacao` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `dataprimeira` date NOT NULL,
  `obs` blob,
  `classificacao` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `naturalidade` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `procedencia` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `matricula` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_pacientes_convenios` (`id_convenio`),
  KEY `FK_pacientes_profissionais` (`id_profissional`),
  CONSTRAINT `FK_pacientes_convenios` FOREIGN KEY (`id_convenio`) REFERENCES `convenios` (`id`),
  CONSTRAINT `FK_pacientes_profissionais` FOREIGN KEY (`id_profissional`) REFERENCES `profissionais` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.pacientes: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela smed.parametros_eventos
CREATE TABLE IF NOT EXISTS `parametros_eventos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.parametros_eventos: ~0 rows (aproximadamente)

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
	(1, 2, 'Glaison Queiroz', '', '', '', '', 'MG', '(48) 2759-4679', '(31) 2121-2223', 'suporte@sabara.mg.gov.br', NULL, '4565465', '69551022653', '2009-07-13', 'M', 'S', _binary 0x7465737465206465206f627365727661c3a7c3a36f, '565465'),
	(2, 1, 'Maria de Souza Crus', 'Beco da Chica,100', 'Campeche', 'Belo Horizonte', '3450480', 'MG', '(31) 589-6369', '(31) 6995-5555', 'dasilva@gmail.com', NULL, '', '07415768051', '1997-11-04', 'M', 'S', _binary '', 'crm/mg 456456');

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
