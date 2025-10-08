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


-- Copiando estrutura do banco de dados para smed
CREATE DATABASE IF NOT EXISTS `smed` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `smed`;

-- Copiando estrutura para tabela smed.agenda
CREATE TABLE IF NOT EXISTS `agenda` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_profissional` int NOT NULL,
  `id_convenio` int DEFAULT NULL,
  `data` date NOT NULL,
  `dia` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `horario` time DEFAULT NULL,
  `Nome` varchar(120) DEFAULT NULL,
  `telefone` varchar(40) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `observacao` varchar(100) DEFAULT NULL,
  `matricula` varchar(25) DEFAULT NULL,
  `paciente_novo` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `paciente_compareceu` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `paciente_atendido` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_agenda_profissionais` (`id_profissional`),
  KEY `FK_agenda_convenios` (`id_convenio`),
  CONSTRAINT `FK_agenda_convenios` FOREIGN KEY (`id_convenio`) REFERENCES `convenios` (`id`),
  CONSTRAINT `FK_agenda_profissionais` FOREIGN KEY (`id_profissional`) REFERENCES `profissionais` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.agenda: ~31 rows (aproximadamente)
INSERT INTO `agenda` (`id`, `id_profissional`, `id_convenio`, `data`, `dia`, `horario`, `Nome`, `telefone`, `email`, `observacao`, `matricula`, `paciente_novo`, `paciente_compareceu`, `paciente_atendido`) VALUES
	(4, 4, 3, '2025-09-24', '3', '08:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(5, 4, 3, '2025-09-24', '3', '08:30:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(6, 4, 3, '2025-09-24', '3', '09:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(7, 4, 3, '2025-09-24', '3', '09:30:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(8, 4, 1, '2025-09-24', '3', '10:00:00', 'Glaison Queiroz', '(31) 9854-5555', 'teste@gmail.com', '', '45646546', 'Sim', 'Sim', 'Sim'),
	(9, 4, 3, '2025-09-24', '3', '10:30:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(10, 4, 3, '2025-09-24', '3', '11:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(11, 4, 2, '2025-09-25', '4', '07:00:00', 'Florentina de Jesus', '', 'flore@gmail.com', '', '8032566', 'Sim', 'Não', 'Não'),
	(12, 4, 2, '2025-09-25', '4', '07:30:00', 'Maria da Graça', '(31) 6995-5666', '', '', '45646546', 'Não', 'Não', 'Não'),
	(13, 4, 3, '2025-09-25', '4', '08:00:00', '', '', '', '', '', '', '', ''),
	(14, 4, 1, '2025-09-25', '4', '08:30:00', 'Glaison Queiroz', '(31) 9854-5555', 'teste@gmail.com', '', '747474', 'Sim', 'Não', 'Não'),
	(15, 4, 4, '2025-09-25', '4', '09:00:00', 'paciente de teste', '(31) 9854-5555', 'teste@gmail.com', '', '98798', 'Não', 'Não', 'Não'),
	(16, 4, 3, '2025-09-25', '4', '09:30:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(17, 4, 3, '2025-09-25', '4', '10:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(18, 4, 3, '2025-09-25', '4', '14:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(19, 4, 3, '2025-09-25', '4', '14:15:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(20, 4, 3, '2025-09-25', '4', '14:30:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(21, 4, 3, '2025-09-25', '4', '14:45:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(22, 4, 3, '2025-09-25', '4', '15:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(23, 4, 3, '2025-09-25', '4', '15:15:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(24, 4, 3, '2025-09-25', '4', '15:30:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(25, 4, 3, '2025-09-25', '4', '15:45:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(26, 4, 3, '2025-09-25', '4', '16:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(27, 4, 3, '2025-09-25', '4', '16:15:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(28, 4, 3, '2025-09-25', '4', '16:30:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(29, 4, 3, '2025-09-25', '4', '16:45:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(30, 4, 3, '2025-09-25', '4', '17:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(31, 4, 3, '2025-09-25', '4', '17:15:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(32, 4, 3, '2025-09-25', '4', '17:30:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(33, 4, 3, '2025-09-25', '4', '17:45:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(34, 4, 3, '2025-09-25', '4', '18:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
  `Habilitado` char(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_agendaconfig_profissionais` (`id_profissional`),
  CONSTRAINT `FK_agendaconfig_profissionais` FOREIGN KEY (`id_profissional`) REFERENCES `profissionais` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.agendaconfig: ~21 rows (aproximadamente)
INSERT INTO `agendaconfig` (`id`, `id_profissional`, `dia`, `inicio1`, `fim1`, `duracao1`, `inicio2`, `fim2`, `duracao2`, `inicio3`, `fim3`, `duracao3`, `Habilitado`) VALUES
	(21, 1, 1, '09:00:00', '11:00:00', 30, '14:00:00', '18:00:00', 20, '00:00:00', '00:00:00', 0, NULL),
	(22, 1, 2, '08:00:00', '12:00:00', 30, '13:00:00', '18:00:00', 15, '00:00:00', '00:00:00', 0, NULL),
	(23, 1, 3, '07:00:00', '11:00:00', 15, '12:00:00', '17:00:00', 30, '00:00:00', '00:00:00', 0, NULL),
	(24, 1, 4, '07:00:00', '12:00:00', 30, '13:00:00', '17:00:00', 30, '00:00:00', '00:00:00', 0, NULL),
	(25, 1, 5, '08:00:00', '12:00:00', 30, '13:00:00', '17:00:00', 30, '19:00:00', '21:00:00', 15, NULL),
	(26, 1, 6, '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, NULL),
	(27, 1, 7, '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, NULL),
	(28, 2, 1, '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, NULL),
	(29, 2, 2, '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, NULL),
	(30, 2, 3, '08:00:00', '10:00:00', 30, '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, NULL),
	(31, 2, 4, '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, NULL),
	(32, 2, 5, '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, NULL),
	(33, 2, 6, '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, NULL),
	(34, 2, 7, '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, NULL),
	(35, 4, 1, '07:00:00', '15:00:00', 30, '15:30:00', '18:00:00', 30, '00:00:00', '00:00:00', 0, NULL),
	(36, 4, 2, '08:00:00', '12:00:00', 30, '13:00:00', '17:00:00', 20, '00:00:00', '00:00:00', 0, NULL),
	(37, 4, 3, '08:00:00', '11:00:00', 30, '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, NULL),
	(38, 4, 4, '07:00:00', '10:00:00', 30, '14:00:00', '18:00:00', 15, '00:00:00', '00:00:00', 0, NULL),
	(39, 4, 5, '08:00:00', '11:00:00', 15, '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, NULL),
	(40, 4, 6, '07:00:00', '08:00:00', 15, '13:00:00', '18:00:00', 30, '00:00:00', '00:00:00', 0, NULL),
	(41, 4, 7, '07:00:00', '11:00:00', 30, '00:00:00', '00:00:00', 0, '00:00:00', '00:00:00', 0, NULL);

-- Copiando estrutura para tabela smed.anamnese
CREATE TABLE IF NOT EXISTS `anamnese` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_paciente` int DEFAULT NULL,
  `data` date DEFAULT NULL,
  `setor` varchar(100) DEFAULT NULL,
  `funcao` varchar(100) DEFAULT NULL,
  `admissao` date DEFAULT NULL,
  `jornada` varchar(50) DEFAULT NULL,
  `atividades` varchar(120) DEFAULT NULL,
  `descricao_atividades` varchar(150) DEFAULT NULL,
  `risco_fisico` char(3) DEFAULT NULL,
  `risco_quimico` char(3) DEFAULT NULL,
  `risco_biologico` char(3) DEFAULT NULL,
  `risco_ergonomico` char(3) DEFAULT NULL,
  `risco_acidente` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `usa_epi` char(3) DEFAULT NULL,
  `quais_epi` varchar(150) DEFAULT NULL,
  `motivo_consulta` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `queixa_principal` blob,
  `hda` blob,
  `antecedente_hipertensao` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `obs_hipertensao` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `antecedente_diabete` char(3) DEFAULT NULL,
  `obs_diabete` varchar(150) DEFAULT NULL,
  `antecedente_cardiaco` char(3) DEFAULT NULL,
  `obs_cardiaco` varchar(150) DEFAULT NULL,
  `antecedente_asma_bronquite` char(3) DEFAULT NULL,
  `obs_asma_bronquite` varchar(150) DEFAULT NULL,
  `antecedente_renais` char(3) DEFAULT NULL,
  `obs_renais` varchar(150) DEFAULT NULL,
  `antecedente_neurologica` char(3) DEFAULT NULL,
  `obs_neurologia` varchar(150) DEFAULT NULL,
  `antecedente_psquiatrico` char(3) DEFAULT NULL,
  `obs_psiquiatrico` varchar(150) DEFAULT NULL,
  `antecedente_cancer` char(3) DEFAULT NULL,
  `obs_cancer` varchar(150) DEFAULT NULL,
  `antecedente_alergia` char(3) DEFAULT NULL,
  `obs_alergia` varchar(150) DEFAULT NULL,
  `antecedente_cirurgias` char(3) DEFAULT NULL,
  `obs_cirurgia` varchar(150) DEFAULT NULL,
  `medicamentos_uso` blob,
  `habito_tabagismo` char(3) DEFAULT NULL,
  `tabagismo_tempo` int DEFAULT NULL,
  `tabagismo_qtd_dia` int DEFAULT NULL,
  `etilismo` char(3) DEFAULT NULL,
  `etilismo_frequencia` varchar(80) DEFAULT NULL,
  `atividade_fisica` char(3) DEFAULT NULL,
  `atividade_fisica_qual` int DEFAULT NULL,
  `atividade_fisica_frequencia` varchar(80) DEFAULT NULL,
  `familiar_hipertencao` char(3) DEFAULT NULL,
  `obs_familiar_hipertencao` varchar(150) DEFAULT NULL,
  `familiar_cancer` char(3) DEFAULT NULL,
  `obs_familiar_cancer` varchar(150) DEFAULT NULL,
  `familiar_cardiaco` char(3) DEFAULT NULL,
  `obs_familiar_cardiaco` varchar(150) DEFAULT NULL,
  `familiar_diabetes` char(3) DEFAULT NULL,
  `obs_familiar_diabetes` varchar(150) DEFAULT NULL,
  `familiar_outros` char(3) DEFAULT NULL,
  `obs_familiar_outros` varchar(150) DEFAULT NULL,
  `stm_geral` char(3) DEFAULT NULL,
  `stm_pele` char(3) DEFAULT NULL,
  `stm_cabeca_pescoso` char(3) DEFAULT NULL,
  `stm_olhos` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `stm_ouvidos` char(3) DEFAULT NULL,
  `stm_respiratorio` char(3) DEFAULT NULL,
  `stm_cardiovascular` char(3) DEFAULT NULL,
  `stm_gastro` char(3) DEFAULT NULL,
  `stm_geniturario` char(3) DEFAULT NULL,
  `stm_musculo_esqueletico` char(3) DEFAULT NULL,
  `stm_neurologico` char(3) DEFAULT NULL,
  `stm_pisiquico` char(3) DEFAULT NULL,
  `exame_pa` varchar(15) DEFAULT NULL,
  `exame_fc` int DEFAULT NULL,
  `exame_fr` int DEFAULT NULL,
  `exame_peso` float DEFAULT NULL,
  `exame_altura` float DEFAULT NULL,
  `exame_imc` float DEFAULT NULL,
  `exame_ectoscopia` varchar(100) DEFAULT NULL,
  `exame_aparelho_respiratorio` varchar(100) DEFAULT NULL,
  `exame_aparelho_cardio` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `exame_abdome` varchar(100) DEFAULT NULL,
  `exame_membros` varchar(100) DEFAULT NULL,
  `exame_coluna` varchar(100) DEFAULT NULL,
  `exame_neurologico` varchar(100) DEFAULT NULL,
  `conduta_hipotese_diag` blob,
  `conduta_exames_compl` blob,
  `conduta` blob,
  `parecer` char(1) DEFAULT NULL,
  `restricoes` blob,
  PRIMARY KEY (`id`),
  KEY `FK_anamnese_pacientes` (`id_paciente`),
  CONSTRAINT `FK_anamnese_pacientes` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.anamnese: ~7 rows (aproximadamente)
INSERT INTO `anamnese` (`id`, `id_paciente`, `data`, `setor`, `funcao`, `admissao`, `jornada`, `atividades`, `descricao_atividades`, `risco_fisico`, `risco_quimico`, `risco_biologico`, `risco_ergonomico`, `risco_acidente`, `usa_epi`, `quais_epi`, `motivo_consulta`, `queixa_principal`, `hda`, `antecedente_hipertensao`, `obs_hipertensao`, `antecedente_diabete`, `obs_diabete`, `antecedente_cardiaco`, `obs_cardiaco`, `antecedente_asma_bronquite`, `obs_asma_bronquite`, `antecedente_renais`, `obs_renais`, `antecedente_neurologica`, `obs_neurologia`, `antecedente_psquiatrico`, `obs_psiquiatrico`, `antecedente_cancer`, `obs_cancer`, `antecedente_alergia`, `obs_alergia`, `antecedente_cirurgias`, `obs_cirurgia`, `medicamentos_uso`, `habito_tabagismo`, `tabagismo_tempo`, `tabagismo_qtd_dia`, `etilismo`, `etilismo_frequencia`, `atividade_fisica`, `atividade_fisica_qual`, `atividade_fisica_frequencia`, `familiar_hipertencao`, `obs_familiar_hipertencao`, `familiar_cancer`, `obs_familiar_cancer`, `familiar_cardiaco`, `obs_familiar_cardiaco`, `familiar_diabetes`, `obs_familiar_diabetes`, `familiar_outros`, `obs_familiar_outros`, `stm_geral`, `stm_pele`, `stm_cabeca_pescoso`, `stm_olhos`, `stm_ouvidos`, `stm_respiratorio`, `stm_cardiovascular`, `stm_gastro`, `stm_geniturario`, `stm_musculo_esqueletico`, `stm_neurologico`, `stm_pisiquico`, `exame_pa`, `exame_fc`, `exame_fr`, `exame_peso`, `exame_altura`, `exame_imc`, `exame_ectoscopia`, `exame_aparelho_respiratorio`, `exame_aparelho_cardio`, `exame_abdome`, `exame_membros`, `exame_coluna`, `exame_neurologico`, `conduta_hipotese_diag`, `conduta_exames_compl`, `conduta`, `parecer`, `restricoes`) VALUES
	(8, 4, '2025-10-06', 'teste', 'teste', '2025-10-06', 'teste', 'teste', 'teste', 'S', 'S', 'S', 'N', 'N', NULL, NULL, 'Admissional', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(9, 4, '2025-10-06', 'teste', 'teste', '2025-10-01', 'teste', 'teste', 'teste', 'S', 'S', 'N', 'N', 'N', NULL, NULL, 'Admissional', _binary 0x517565697861, _binary 0x68697374c3b372696120646f656ec3a761, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(10, 4, '2025-10-06', 'teste', 'teste', '2025-10-06', 'teste', 'teste', 'teste', 'S', 'S', 'S', 'N', 'N', NULL, NULL, 'Admissional', _binary 0x7465737465, _binary 0x686668666768, 'Sim', NULL, 'Sim', NULL, 'Não', NULL, 'Não', NULL, 'Sim', NULL, 'Sim', NULL, 'Sim', NULL, 'Sim', NULL, 'Sim', NULL, 'Sim', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(11, 4, '2025-10-06', 'teste', 'teste', '2025-10-06', 'teste', 'teste', 'teste', 'S', 'S', 'S', 'N', 'N', NULL, NULL, 'Admissional', _binary 0x7465737465, _binary 0x72717765727477, 'Sim', NULL, 'Sim', NULL, 'Sim', NULL, 'Não', NULL, 'Não', NULL, 'Não', NULL, 'Não', NULL, 'Não', NULL, 'Não', NULL, 'Não', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(12, 4, '2025-10-07', 'teste', 'teste', '2025-10-07', 'teste', 'teste', 'teste', 'S', 'S', 'S', 'N', 'N', NULL, NULL, 'Periódico', _binary 0x517565697861, _binary 0x6673686667, 'Sim', NULL, 'Sim', NULL, 'Sim', NULL, 'Sim', NULL, 'Sim', NULL, 'Sim', NULL, 'Sim', NULL, 'Sim', NULL, 'Sim', NULL, 'Sim', NULL, _binary 0x6667666866686668, 'Sim', 10, 15, 'Sim', '30', 'Não', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(13, 4, '2025-10-07', 'teste', 'teste', '2025-10-07', 'teste', 'teste', 'teste', 'S', 'S', 'S', 'N', 'N', 'Sim', 'Cinto de segurança', 'Periódico', _binary 0x7465737465, _binary 0x657772776572717765, 'Sim', NULL, 'Sim', NULL, 'Sim', NULL, 'Sim', NULL, 'Sim', NULL, 'Não', NULL, 'Não', NULL, 'Não', NULL, 'Não', NULL, 'Não', NULL, _binary 0x73646661736466736466, 'Sim', 5, 12, 'Sim', '12', 'Sim', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(14, 4, '2025-10-07', 'teste', 'teste', '2025-10-07', 'teste', 'teste', 'teste', 'S', 'S', 'S', 'N', 'N', 'Sim', 'Cinto de segurança', 'Periódico', _binary 0x7465737465, _binary 0x7465737465, 'Sim', NULL, 'Sim', NULL, 'Sim', NULL, 'Sim', NULL, 'Não', NULL, 'Não', NULL, 'Não', NULL, 'Não', NULL, 'Não', NULL, 'Não', NULL, _binary 0x7465737465, 'Sim', 4, 3, 'Sim', '2', 'Sim', NULL, NULL, 'Sim', NULL, 'Sim', NULL, 'Sim', NULL, 'Sim', NULL, 'Sim', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(15, 4, '2025-10-07', 'teste', 'teste', '2025-10-07', 'teste', 'teste', 'teste', 'S', 'S', 'S', 'N', 'N', '', '', 'Retorno ao Trabalho', _binary 0x7465737465, _binary 0x68666768686667, 'Sim', NULL, 'Sim', NULL, 'Sim', NULL, 'Sim', NULL, 'Sim', NULL, 'Não', NULL, '', NULL, 'Não', NULL, 'Não', NULL, 'Não', NULL, _binary 0x676866686667, 'Sim', 3, 3, 'Sim', '2', 'Sim', NULL, NULL, 'Sim', NULL, 'Não', NULL, 'Não', NULL, 'Sim', NULL, 'Não', NULL, 'Sim', 'Não', 'Sim', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(16, 4, '2025-10-07', 'teste', 'teste', '2025-10-07', 'teste', 'teste', 'teste', 'S', 'S', 'S', 'N', 'N', '', '', 'Retorno ao Trabalho', _binary 0x7465737465, _binary 0x6766686766, 'Não', NULL, 'Não', NULL, 'Não', NULL, 'Não', NULL, 'Não', NULL, 'Não', NULL, 'Não', NULL, 'Não', NULL, 'Não', NULL, 'Não', NULL, _binary 0x7364617364, 'Sim', 1, 1, 'Sim', '1', 'Não', NULL, NULL, 'Não', NULL, 'Não', NULL, 'Não', NULL, 'Não', NULL, 'Não', NULL, 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', '120/90', 90, 12, 84, 1.8, 23, 'fsdf', 'sdfsd', 'sdfs', 'sdf', 'sdf', 'sdf', 'sdf', NULL, NULL, NULL, NULL, NULL),
	(17, 4, '2025-10-07', 'teste', 'teste', '2025-10-07', 'teste', 'teste', 'teste', 'S', 'S', 'S', 'N', 'N', 'Sim', 'Cinto de segurança', 'Outros', _binary 0x7465737465, _binary 0x6a676a6768, 'Não', NULL, 'Não', NULL, 'Não', NULL, 'Não', NULL, 'Não', NULL, 'Não', NULL, 'Não', NULL, 'Não', NULL, 'Não', NULL, 'Não', NULL, _binary 0x676767, 'Não', 0, 0, 'Não', '0', 'Não', NULL, NULL, 'Não', NULL, 'Não', NULL, 'Não', NULL, 'Não', NULL, 'Não', NULL, 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', 'Não', '12/80', 70, 16, 70, 1.75, 22.8, 'fsdf', 'sdfsd', 'sdfs', 'sdf', 'sdf', 'sdf', 'sdf', NULL, NULL, NULL, NULL, NULL);

-- Copiando estrutura para tabela smed.atestados
CREATE TABLE IF NOT EXISTS `atestados` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(150) NOT NULL,
  `texto` blob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.atestados: ~4 rows (aproximadamente)
INSERT INTO `atestados` (`id`, `descricao`, `texto`) VALUES
	(2, 'ATESTADO DE APTIDÃO FÍSICA', _binary 0x41746573746f2c2070617261206f732064657669646f732066696e732c20717565206f2861292053722e286129205b4e6f6d6520436f6d706c65746f20646f2050616369656e74655d2c0a706f727461646f7228612920646f205247206ec2ba205b4ec3ba6d65726f20646f2052475d206520435046206ec2ba205b4ec3ba6d65726f20646f204350465d2c20666f6920706f72206d696d0a6578616d696e61646f286129206e657374612064617461206520656e636f6e7472612d7365206170746f28612920706172612061207072c3a174696361206465205b5469706f206465204174697669646164650a46c3ad736963612c2065783a20617469766964616465732066c3ad736963617320656d20676572616c2c206e617461c3a7c3a36f2c2061636164656d69615d2e0a0a0a),
	(8, 'Atestado de Doença/Afastamento', _binary 0x41746573746f2c2070617261206f732064657669646f732066696e732c20717565206f2861292053722e286129205b4e6f6d6520436f6d706c65746f20646f2050616369656e74655d2c0a706f727461646f7228612920646f205247206ec2ba205b4ec3ba6d65726f20646f2052475d206520435046206ec2ba205b4ec3ba6d65726f20646f204350465d2c2065737465766520736f62206d6575730a6375696461646f732070726f66697373696f6e616973206e6f20706572c3ad6f646f206465205b4461746120646520496ec3ad63696f20646f204166617374616d656e746f5d2061205b446174612064650a54c3a9726d696e6f20646f204166617374616d656e746f5d2c206e65636573736974616e646f206465206166617374616d656e746f2064652073756173206174697669646164657320706f720a5b4ec3ba6d65726f20646520446961735d20285b4ec3ba6d65726f206465204469617320706f7220457874656e736f5d2920646961732c206120706172746972206465205b4461746120646520496ec3ad63696f20646f0a4166617374616d656e746f5d2c2064657669646f2061205b446961676ec3b3737469636f206f75204349442c207365206175746f72697a61646f2070656c6f2070616369656e74655d2e0a0a),
	(10, 'ATESTADO DE COMPARECIMENTO', _binary 0x41746573746f2c2070617261206f732064657669646f732066696e732c20717565206f2861292053722e286129205b4e6f6d6520436f6d706c65746f20646f2050616369656e74655d2c0a706f727461646f7228612920646f205247206ec2ba205b4ec3ba6d65726f20646f2052475d206520435046206ec2ba205b4ec3ba6d65726f20646f204350465d2c20636f6d70617265636575206120657374610a756e6964616465206465207361c3ba64652f636f6e73756c74c3b372696f206dc3a96469636f206e6f20646961205b4461746120646f204174656e64696d656e746f5d2c20c3a073205b486f726120646f0a4174656e64696d656e746f5d2c2070617261205b4d6f7469766f20646f20436f6d7061726563696d656e746f2c2065783a20636f6e73756c7461206dc3a9646963612c206578616d652c0a70726f636564696d656e746f5d2e0a0a0a0a),
	(12, 'ATESTADO MÉDICO PARA GESTANTE', _binary 0x41746573746f2c2070617261206f732064657669646f732066696e732c207175652061205372612e205b4e6f6d6520436f6d706c65746f2064612050616369656e74655d2c20706f727461646f726120646f0a5247206ec2ba205b4ec3ba6d65726f20646f2052475d206520435046206ec2ba205b4ec3ba6d65726f20646f204350465d2c20656e636f6e7472612d736520656d205b4ec3ba6d65726f2064650a53656d616e61735d2073656d616e6173206465206765737461c3a7c3a36f2c20636f6d20646174612070726f76c3a176656c20646f20706172746f20656d205b446174612050726f76c3a176656c20646f0a506172746f5d2e0a5265636f6d656e646f205b5265636f6d656e6461c3a7c3b56573204573706563c3ad66696361732c2065783a207265706f75736f2c206166617374616d656e746f20646520617469766964616465730a717565206578696a616d206573666f72c3a76f2066c3ad7369636f2c2061636f6d70616e68616d656e746f207072c3a92d6e6174616c5d2e0a);

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
INSERT INTO `atributos_parametros_eventos` (`id`, `id_parametro`, `descricao`, `formato`) VALUES
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
INSERT INTO `bateria` (`id`, `descricao`, `exames`) VALUES
	(1, 'PADRÃO', _binary 0x312e20416e7465636564656e74657320436972c3ba726769636f733a0d0a0d0a0d0a0d0a322e20416e7465636564656e74657320436cc3ad6e69636f733a0d0a0d0a0d0a0d0a332e20456e6665726d696461646520417475616c203a0d0a0d0a0d0a342e204d6564696361c3a7c3a36f20656d2055736f3a0d0a0d0a0d0a352e20486970657273656e736962696c6964616465204d65646963616d656e746f7361203a0d0a0d0a0d0a362e2048c3a16269746f730d0a0d0a0d0a372e204578616d652046c3ad7369636f203a0d0a0d0a0d0a502e413a20202020202020202020202020202020202020462e433a202020202020202020202020202020205065736f3a0d0a0d0a0d0a382e204578616d657320436f6d706c656d656e7461726573203a0d0a0d0a0d0a392e20436f6e636c7573c3a36f203a0d0a0d0a),
	(2, 'Exame de Rotina', _binary 0x312e2050616369656e746520656d20626f6d2065737461646f20676572616c2c2073617564c3a176656c3c62723e0d0a322e20525455204445205052c39353544154413c62723e0d0a);

-- Copiando estrutura para tabela smed.componentes
CREATE TABLE IF NOT EXISTS `componentes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_grupo_componente` int NOT NULL DEFAULT '0',
  `descricao` varchar(100) NOT NULL,
  `unidade` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_componentes_grupo_componentes` (`id_grupo_componente`),
  CONSTRAINT `FK_componentes_grupo_componentes` FOREIGN KEY (`id_grupo_componente`) REFERENCES `grupo_componentes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.componentes: ~2 rows (aproximadamente)
INSERT INTO `componentes` (`id`, `id_grupo_componente`, `descricao`, `unidade`) VALUES
	(24, 3, 'componente', 'un'),
	(25, 1, 'Componente 2', 'un');

-- Copiando estrutura para tabela smed.config
CREATE TABLE IF NOT EXISTS `config` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome_clinica` varchar(200) DEFAULT NULL,
  `endereco_clinica` varchar(200) DEFAULT NULL,
  `telefone_clinica` varchar(25) DEFAULT NULL,
  `email_clinica` varchar(120) DEFAULT NULL,
  `cidade_clinica` varchar(150) DEFAULT NULL,
  `cnpj_clinica` varchar(18) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.config: ~0 rows (aproximadamente)
INSERT INTO `config` (`id`, `nome_clinica`, `endereco_clinica`, `telefone_clinica`, `email_clinica`, `cidade_clinica`, `cnpj_clinica`) VALUES
	(1, 'Clinica Belo Horizonte', 'Rua Comendador viana 148', '32323', 'teste@gmail.com', 'Belo Horizonte', '102842912342');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.convenios: ~4 rows (aproximadamente)
INSERT INTO `convenios` (`id`, `id_tabela`, `nome`, `razaosocial`, `cnpj`, `inscestad`, `inscmunicipal`, `endereco`, `bairro`, `cidade`, `cep`, `uf`, `fone1`, `fone2`, `email`, `url`, `diaenvio`, `diapagamento`, `percentch`, `contato`, `obs`) VALUES
	(1, 2, 'Unimed', 'Unimed SA', '75515874000180', '411432', '41234123', 'teste', 'tste', 'Belo Horizonte', '34505480', 'MG', '(31) 589-6369', '(31) 6958-5544', 'unimed@unimed.com.br', 'teste', '', '', '100', 'Joelson', _binary ''),
	(2, 1, 'Casu', 'Casu SA', '00172442000115', '', '', '', '', '', '', 'AC', '(48) 2759-4679', '(31) 6995-5555', 'suporte@sabara.mg.gov.br', '', '', '', '', 'Glaison', _binary ''),
	(3, 2, 'Selecionar', 'Selecionar', '99999999', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '99999', NULL, 'teste', NULL, NULL, NULL, NULL, NULL, NULL),
	(4, 2, 'Particular', 'Particular', '62616951000147', '', '', '', '', '', '', 'AC', '(99) 9999-9999', '', 'glaison26.queiroz@gmail.com', '', '', '', '', 'Particular', _binary '');

-- Copiando estrutura para tabela smed.datas_suprimidas
CREATE TABLE IF NOT EXISTS `datas_suprimidas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
  `motivo` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.datas_suprimidas: ~3 rows (aproximadamente)
INSERT INTO `datas_suprimidas` (`id`, `data_inicio`, `data_fim`, `motivo`) VALUES
	(1, '2024-12-23', '2024-12-31', 'Férias de Fim de Ano'),
	(2, '2024-10-01', '2024-10-04', 'Seminário de Dermatologia'),
	(4, '2024-08-01', '2024-08-01', 'Seminário médico');

-- Copiando estrutura para tabela smed.diagnosticos
CREATE TABLE IF NOT EXISTS `diagnosticos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cid` varchar(10) DEFAULT NULL,
  `descricao` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.diagnosticos: ~2 rows (aproximadamente)
INSERT INTO `diagnosticos` (`id`, `cid`, `descricao`) VALUES
	(1, 'A00', 'Cólera'),
	(6, 'G00', 'Meningite Bacteriana Não Classificada em Outra Parte');

-- Copiando estrutura para tabela smed.especialidades
CREATE TABLE IF NOT EXISTS `especialidades` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.especialidades: ~3 rows (aproximadamente)
INSERT INTO `especialidades` (`id`, `descricao`) VALUES
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
INSERT INTO `exames` (`id`, `id_grupo`, `descricao`, `material`, `metodo`, `valref`) VALUES
	(1, 1, 'Paciente em bom estado geral, saudável', 'Sangue, Urina e Fezes', 'Analise de laboratorial', _binary 0x50616369656e746520656d20626f6d2065737461646f20676572616c2c2073617564c3a176656c),
	(3, 2, 'RISCO CIRURGICO DISCRETO', 'Sangue e Urina', 'Laboratorial', _binary 0x524953434f2043495255524749434f20444953435245544f2028415341204949204f5520474f4c444d414e20494929),
	(4, 4, 'RTU DE PRÓSTATA', 'Não se aplica', 'Toque', _binary 0x53656e736962696c696461646522);

-- Copiando estrutura para tabela smed.formulas_pre
CREATE TABLE IF NOT EXISTS `formulas_pre` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(150) DEFAULT NULL,
  `formula` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.formulas_pre: ~2 rows (aproximadamente)
INSERT INTO `formulas_pre` (`id`, `descricao`, `formula`) VALUES
	(1, 'Formula Fixa', _binary 0x546578746f206465207072696d6569726120666f726d756c613c62723e0d0a0d0ac3816369646f2062c3b37269636f20203135202020756e3c62723e0d0ac3816369646f2062c3b37269636f2020323020202020756e3c62723e0d0ac3816369646f2062c3b37269636f2020203133202020756e3c62723e0d0ac3816369646f2062c3b37269636f2020203132202020756e3c62723e0d0a466f736661746f20203220202020756e3c62723e0d0ac3816369646f2062c3b37269636f20202036202020756e3c62723e0d0ac3816369646f2062c3b37269636f20203720202020756e3c62723e0d0a416dc3b46e696120202038202020756e3c62723e0d0a),
	(2, 'Formula Padrão', _binary 0xc3816369646f2062c3b37269636f2031322020202020756e3c62723e0d0a466f736661746f2020313520202020756e3c62723e0d0a);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.grupos_formulas: ~3 rows (aproximadamente)
INSERT INTO `grupos_formulas` (`id`, `descricao`) VALUES
	(1, 'formula tipo 1'),
	(2, 'formula tipo 2'),
	(3, 'Grupo3');

-- Copiando estrutura para tabela smed.grupos_laudos
CREATE TABLE IF NOT EXISTS `grupos_laudos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.grupos_laudos: ~5 rows (aproximadamente)
INSERT INTO `grupos_laudos` (`id`, `descricao`) VALUES
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

-- Copiando dados para a tabela smed.grupos_medicamentos: ~2 rows (aproximadamente)
INSERT INTO `grupos_medicamentos` (`id`, `descricao`) VALUES
	(1, 'Analgésicos'),
	(2, 'Medicamentos Dermatológicos');

-- Copiando estrutura para tabela smed.grupo_componentes
CREATE TABLE IF NOT EXISTS `grupo_componentes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.grupo_componentes: ~4 rows (aproximadamente)
INSERT INTO `grupo_componentes` (`id`, `descricao`) VALUES
	(1, 'Exames Acidos'),
	(2, 'Exames de sangue'),
	(3, 'Exames de Feses'),
	(5, 'teste');

-- Copiando estrutura para tabela smed.historia
CREATE TABLE IF NOT EXISTS `historia` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_paciente` int DEFAULT NULL,
  `historia` blob,
  `data` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_historia_pacientes` (`id_paciente`),
  CONSTRAINT `FK_historia_pacientes` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.historia: ~4 rows (aproximadamente)
INSERT INTO `historia` (`id`, `id_paciente`, `historia`, `data`) VALUES
	(1, 1, _binary 0x0d0a0d0a30382f30382f323032340d0a4f7269656e7461c3a7c3a36f204dc3a96469636120456d697469646f0d0a436f72726572203130206b6d0d0a50756c617220436f7264610d0a436f7274617220616c696d656e746f7320476f726475726f736f73, NULL),
	(2, 3, _binary 0x0d0a0d0a30332f30382f323032340d0a417465737461646f204dc3a96469636f20456d697469646f0d0a746578746f204152454f4c41520d0a0d0a30332f30382f323032340d0a417465737461646f204dc3a96469636f20456d697469646f0d0a746578746f204152454f4c41520d0a0d0a30332f30382f323032340d0a417465737461646f204dc3a96469636f20456d697469646f0d0a436f6d6572206d656e6f732061c3a775636172, NULL),
	(6, 4, _binary 0x436f6d6572206d656e6f732061c3a7756361720d0a0d0a0d0a30352f30382f323032340d0a50726573637269c3a7c3a36f206465204d65646963616d656e746f20456d697469646f0d0a504f564944494e452e2e2e2e0d0a50534f5245582e2e2e2e0d0a54594c454e4f4c2e2e2e2e0d0a564954414e4f4c2d412e2e2e2e0d0a0d0a0d0a0d0a, NULL),
	(7, 5, _binary 0x417465737461646f204dc3a96469636f20456d697469646f0d0a0d0a74657374650d0a0d0a0d0a33312f30372f323032350d0a417465737461646f204dc3a96469636f20456d697469646f0d0a746573746520646520746573746f207061726120524450500d0a, NULL);

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

-- Copiando dados para a tabela smed.imagens_pacientes: ~6 rows (aproximadamente)
INSERT INTO `imagens_pacientes` (`id`, `id_paciente`, `pasta_imagem`, `data`, `descricao`) VALUES
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
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.indices: ~7 rows (aproximadamente)
INSERT INTO `indices` (`id`, `descricao`, `valor`) VALUES
	(1, 'Real', 1),
	(21, 'Dollar', 5.5),
	(22, 'UTR', 30),
	(30, '1', 1),
	(31, '2', 2),
	(32, '3', 3),
	(33, '5', 5);

-- Copiando estrutura para tabela smed.medicamentos
CREATE TABLE IF NOT EXISTS `medicamentos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_grupo` int DEFAULT NULL,
  `descricao` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `FK_medicamentos_grupos_medicamentos` (`id_grupo`),
  CONSTRAINT `FK_medicamentos_grupos_medicamentos` FOREIGN KEY (`id_grupo`) REFERENCES `grupos_medicamentos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.medicamentos: ~4 rows (aproximadamente)
INSERT INTO `medicamentos` (`id`, `id_grupo`, `descricao`) VALUES
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
INSERT INTO `medicamento_apresentacao` (`id`, `id_medicamento`, `apresentacao`, `volume`, `quantidade`, `embalagem`, `uso`, `termo`, `veiculo`, `observacao`) VALUES
	(1, 3, 'Pastilha', '30 ml', '12', 'Caixa', 'Oral', 'remedio', 'Oral', _binary 0x7465737465),
	(2, 3, 'Ampola', '15 ml', '20', 'Caixa', 'Injetável', 'Intra Muscular', 'Oral', _binary 0x7465737465),
	(3, 3, 'Ampola', '120 ml', '1 dose', 'frasco', 'diário', 'continuo', 'Injetavel', _binary '');

-- Copiando estrutura para tabela smed.orientacoes_padrao
CREATE TABLE IF NOT EXISTS `orientacoes_padrao` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(150) DEFAULT NULL,
  `texto` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.orientacoes_padrao: ~2 rows (aproximadamente)
INSERT INTO `orientacoes_padrao` (`id`, `descricao`, `texto`) VALUES
	(9, 'Promoção de Hábitos Saudáveis', _binary 0x416c696d656e7461c3a7c3a36f2041646571756164610a556d6120646965746120657175696c69627261646120c3a92061206261736520706172612061207361c3ba64652e205265636f6d656e64612d7365206f20636f6e73756d6f206162756e64616e74652064650a6672757461732c2076656765746169732c206772c3a36f7320696e7465677261697320652070726f7465c3ad6e6173206d61677261732e20412072656475c3a7c3a36f20646f20636f6e73756d6f2064650a616c696d656e746f732070726f6365737361646f732c2061c3a7c3ba636172657320726566696e61646f73206520676f7264757261732073617475726164617320c3a92066756e64616d656e74616c20706172610a70726576656e697220646f656ec3a7617320636f6d6f206f62657369646164652c206469616265746573207469706f2032206520646f656ec3a761732063617264696f76617363756c617265732e20410a68696472617461c3a7c3a36f2061646571756164612c20636f6d206120696e67657374c3a36f20646520c3a167756120737566696369656e746520616f206c6f6e676f20646f206469612c2074616d62c3a96d20c3a90a766974616c2070617261206f20626f6d2066756e63696f6e616d656e746f20646f206f7267616e69736d6f2e0a4578657263c3ad63696f732046c3ad7369636f730a41207072c3a17469636120726567756c617220646520617469766964616465732066c3ad736963617320c3a920696e64697370656e73c3a176656c2e204164756c746f7320646576656d206275736361722070656c6f0a6d656e6f7320313530206d696e75746f732064652061746976696461646520616572c3b36269636120646520696e74656e736964616465206d6f646572616461206f75203735206d696e75746f732064650a696e74656e736964616465207669676f726f736120706f722073656d616e612c20616cc3a96d206465206578657263c3ad63696f7320646520666f7274616c6563696d656e746f206d757363756c617220647561730a76657a657320706f722073656d616e612e204f732062656e6566c3ad63696f7320696e636c75656d20636f6e74726f6c65206465207065736f2c206d656c686f7261206461207361c3ba64650a63617264696f76617363756c61722c20666f7274616c6563696d656e746f20c3b37373656f2065206d757363756c61722c20652072656475c3a7c3a36f20646f2065737472657373652e20c38920696d706f7274616e74650a616461707461722061206174697669646164652066c3ad7369636120c3a020636f6e6469c3a7c3a36f20696e646976696475616c206520627573636172206f7269656e7461c3a7c3a36f2070726f66697373696f6e616c2e0a536f6e6f206465205175616c69646164650a4f20736f6e6f20c3a920756d2070696c6172206461207361c3ba64652c206d75697461732076657a657320737562657374696d61646f2e2041206d61696f72696120646f73206164756c746f730a6e656365737369746120646520372061203920686f72617320646520736f6e6f20706f72206e6f6974652e20556d20736f6e6f20726570617261646f7220636f6e747269627569207061726120610a7265637570657261c3a7c3a36f2066c3ad736963612065206d656e74616c2c206d656c686f726120612066756ec3a7c3a36f20636f676e69746976612c20666f7274616c656365206f2073697374656d610a696d756e6f6cc3b36769636f206520726567756c61206f2068756d6f722e204573746162656c6563657220756d6120726f74696e6120646520736f6e6f2c20637269617220756d20616d6269656e74650a70726f70c3ad63696f20652065766974617220657374696d756c616e74657320616e74657320646520646f726d69722073c3a36f207072c3a17469636173207265636f6d656e64616461732e0a),
	(10, 'Vacinação e Exames de Rotina', _binary 0x566163696e61c3a7c3a36f0a4120766163696e61c3a7c3a36f20c3a920756d612064617320696e74657276656ec3a7c3b56573206465207361c3ba64652070c3ba626c696361206d6169732065666963617a65732e204d616e746572206f0a63616c656e64c3a172696f20646520766163696e61c3a7c3a36f20617475616c697a61646f2c20636f6e666f726d65206173207265636f6d656e6461c3a7c3b56573207061726120636164612066616978610a6574c3a1726961206520636f6e6469c3a7c3a36f206465207361c3ba64652c20c3a920657373656e6369616c20706172612070726576656e697220646f656ec3a7617320696e66656363696f736173206772617665732e204973736f0a696e636c756920766163696e617320636f6e7472612067726970652c2074c3a974616e6f2c2064696674657269612c20736172616d706f2c20636178756d62612c20727562c3a96f6c612c206865706174697465732c0a4850562c20656e747265206f75747261732e204120766163696e61c3a7c3a36f206ec3a36f2070726f74656765206170656e6173206f20696e646976c3ad64756f2c206d61732074616d62c3a96d20610a636f6d756e69646164652c206174726176c3a97320646120696d756e696461646520646520726562616e686f2e0a4578616d657320646520526f74696e610a4578616d6573206dc3a96469636f7320726567756c61726573207065726d6974656d2061206465746563c3a7c3a36f20707265636f636520646520636f6e6469c3a7c3b56573206465207361c3ba6465206520610a696e74657276656ec3a7c3a36f20616e7465732071756520736520746f726e656d206d616973206772617665732e2041206672657175c3aa6e6369612065206f207469706f206465206578616d65732076617269616d0a636f6e666f726d652069646164652c207365786f2c2068697374c3b37269636f2066616d696c6961722065206661746f72657320646520726973636f2e204578656d706c6f7320696e636c75656d206578616d65730a64652073616e6775652028636f6c65737465726f6c2c20676c6963656d6961292c206d656469c3a7c3a36f206461207072657373c3a36f20617274657269616c2c206d616d6f6772616669612c0a706170616e69636f6c61752c20636f6c6f6e6f73636f7069612065206578616d6573206465207072c3b373746174612e20412064697363757373c3a36f20636f6d206f206dc3a96469636f20736f627265206f0a68697374c3b37269636f20706573736f616c20652066616d696c69617220c3a9206372756369616c207061726120646566696e6972206f20706c616e6f206465206578616d657320616465717561646f2e0a),
	(11, 'teste', _binary 0xc3800a53656372657461726961206465205265637572736f732048756d616e6f730a536f6c6963697461c3a7c3a36f2064652066c3a9726961730a0a5072657a61646f732053656e686f7265732c0a0a4661766f7220636f6e63656465722066c3a97269617320726567756c616d656e7461726573206465203137206469617320c3ba746569732c2070617261206f207365727669646f7220476c6169736f6e2051756569726f7a2c206c6f7461646f206e6120436f6f7264656e61c3a7c3a36f2064652053697374656d61732c20476572c3aa6e636961206465204d6f6465726e697a61c3a7c3a36f2041646d696e6973747261746976612c205365637265746172696120646520506c616e656a616d656e746f2c20612070617274697220646f206469612030312f30392f323032352e0a53656d206d6169732070617261206f206d6f6d656e746f206e6f7320636f6c6f63616d6f73206120646973706f7369c3a7c3a36f207061726120717561697371756572206573636c61726563696d656e746f732e0a);

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.pacientes: ~4 rows (aproximadamente)
INSERT INTO `pacientes` (`id`, `id_convenio`, `id_profissional`, `nome`, `sexo`, `cor`, `datanasc`, `estadocivil`, `mae`, `pai`, `endereco`, `bairro`, `cidade`, `cep`, `uf`, `email`, `fone`, `fone2`, `profissao`, `indicacao`, `dataprimeira`, `obs`, `classificacao`, `naturalidade`, `procedencia`, `matricula`, `cpf`, `identidade`) VALUES
	(1, 1, 2, 'Glaison Queiroz ', 'M', 'Faio', '1968-10-26', 'Casado', 'Emilia ', 'Valdir Queiroz', 'Ruada Intendência, 316', 'Centro', 'Sabará', '34505480', 'SP', 'glaison26.queiroz@gmail.com', '(31)36722550', '(31)984262508', 'Programador', 'não se aplica', '2024-07-01', _binary 0x7465737465, 'Clinica', 'Brasileiro', 'Sabará', '88845665', '69551022653', 'm4662097'),
	(3, 2, NULL, 'Maria da Graça', 'F', 'Leuco', '1985-11-26', 'Solteiro', '', '', '', '', '', '', 'MG', '', '(31) 6995-5666', '', '', '', '2024-07-03', _binary '', '', '', '', '45646546', '', ''),
	(4, 2, NULL, 'Florentina de Jesus', 'M', 'Leuco', '1940-10-08', 'Solteiro', '', '', '', '', '', '', 'MG', 'flore@gmail.com', '', '', '', '', '2024-07-26', _binary '', '', '', '', '8032566', '69551022653', ''),
	(5, 2, NULL, 'Glaison Queiroz', 'M', 'Leuco', '2025-07-02', 'Solteiro', '', '', '', '', '', '', 'MG', '', '(31) 5687-7777', '', '', '', '2025-07-09', _binary '', '', '', '', '', '69551022653', ''),
	(7, 4, NULL, 'paciente de teste', 'M', 'Leuco', '2025-08-06', 'Solteiro', '', '', '', '', '', '', 'MG', 'teste@gmail.com', '(31) 9854-5555', '', '', '', '2025-08-27', _binary '', '', '', '', '', '69551022653', '');

-- Copiando estrutura para tabela smed.parametros_eventos
CREATE TABLE IF NOT EXISTS `parametros_eventos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.parametros_eventos: ~2 rows (aproximadamente)
INSERT INTO `parametros_eventos` (`id`, `descricao`) VALUES
	(1, 'Parametro de Testes'),
	(2, 'Segundo Parâmetro');

-- Copiando estrutura para tabela smed.perfil_usuarios_opcoes
CREATE TABLE IF NOT EXISTS `perfil_usuarios_opcoes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) NOT NULL,
  `ativo` char(1) DEFAULT NULL,
  `fichaclinica` char(1) DEFAULT NULL,
  `fichaclinica_editar` char(1) DEFAULT NULL,
  `fichaclinica_historia` char(1) DEFAULT NULL,
  `fichaclinica_imagens` char(1) DEFAULT NULL,
  `fichaclinica_eventos` char(1) DEFAULT NULL,
  `fichaclinica_excluir` char(1) DEFAULT NULL,
  `agenda` char(1) DEFAULT NULL,
  `agenda_marcacao` char(1) DEFAULT NULL,
  `agenda_incluir` char(1) DEFAULT NULL,
  `agenda_remanejar` char(1) DEFAULT NULL,
  `agenda_desmarcar` char(1) DEFAULT NULL,
  `agenda_criacao` char(1) DEFAULT NULL,
  `prescricao_atestado` char(1) DEFAULT NULL,
  `prescricao` char(1) DEFAULT NULL,
  `prescricao_formula` char(1) DEFAULT NULL,
  `prescricao_medicamento` char(1) DEFAULT NULL,
  `prescricao_laudos` char(1) DEFAULT NULL,
  `prescricao_orientacao` char(1) DEFAULT NULL,
  `prescricao_relatorio` char(1) DEFAULT NULL,
  `prescricao_configuracao` char(1) DEFAULT NULL,
  `financeiro` char(1) DEFAULT NULL,
  `cad_profissionais` char(1) DEFAULT NULL,
  `cad_convenios` char(1) DEFAULT NULL,
  `cad_procedimentos` char(1) DEFAULT NULL,
  `cad_itenslaudos` char(1) DEFAULT NULL,
  `cad_medicamentos` char(1) DEFAULT NULL,
  `cad_orientacoes` char(1) DEFAULT NULL,
  `cad_formula` char(1) DEFAULT NULL,
  `cad_atestado` char(1) DEFAULT NULL,
  `cad_grupo_medicamento` char(1) DEFAULT NULL,
  `cad_grupo_exame` char(1) DEFAULT NULL,
  `cad_componente_formula` char(1) DEFAULT NULL,
  `cad_grupo_componentes` char(1) DEFAULT NULL,
  `cad_especialidades` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `cad_parametros_eventos` char(1) DEFAULT NULL,
  `cad_diagnosticos` char(1) DEFAULT NULL,
  `configuracoes` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.perfil_usuarios_opcoes: ~2 rows (aproximadamente)
INSERT INTO `perfil_usuarios_opcoes` (`id`, `descricao`, `ativo`, `fichaclinica`, `fichaclinica_editar`, `fichaclinica_historia`, `fichaclinica_imagens`, `fichaclinica_eventos`, `fichaclinica_excluir`, `agenda`, `agenda_marcacao`, `agenda_incluir`, `agenda_remanejar`, `agenda_desmarcar`, `agenda_criacao`, `prescricao_atestado`, `prescricao`, `prescricao_formula`, `prescricao_medicamento`, `prescricao_laudos`, `prescricao_orientacao`, `prescricao_relatorio`, `prescricao_configuracao`, `financeiro`, `cad_profissionais`, `cad_convenios`, `cad_procedimentos`, `cad_itenslaudos`, `cad_medicamentos`, `cad_orientacoes`, `cad_formula`, `cad_atestado`, `cad_grupo_medicamento`, `cad_grupo_exame`, `cad_componente_formula`, `cad_grupo_componentes`, `cad_especialidades`, `cad_parametros_eventos`, `cad_diagnosticos`, `configuracoes`) VALUES
	(1, 'Gestor Total', 'S', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N'),
	(2, 'Médico', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'N', 'N', 'N', 'N', 'N', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'N', 'S', 'N', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'N', 'S', 'S', 'N'),
	(3, 'Secretária', 'S', 'N', 'S', 'N', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', '', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S', 'S');

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
INSERT INTO `procedimentos` (`id`, `id_especialidade`, `descricao`, `codigoamb`) VALUES
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
INSERT INTO `procedimentos_tabelas` (`id`, `id_procedimento`, `id_tabela`, `custo`, `valorreal`) VALUES
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.profissionais: ~3 rows (aproximadamente)
INSERT INTO `profissionais` (`id`, `id_especialidade`, `nome`, `endereco`, `bairro`, `cidade`, `cep`, `uf`, `fone1`, `fone2`, `email`, `url`, `identidade`, `cpf`, `datanasc`, `sexo`, `gera_agenda`, `observacao`, `crm`) VALUES
	(1, 2, 'Dr. Arthur Queiroz', '', '', '', '', 'MG', '(48) 2759-4679', '(31) 2121-2223', 'suporte@sabara.mg.gov.br', NULL, '4565465', '69551022653', '2009-07-13', 'M', 'S', _binary 0x7465737465206465206f627365727661c3a7c3a36f, '565465'),
	(2, 1, 'Dra. Maria de Souza Cruz', 'Beco da Chica,100', 'Campeche', 'Belo Horizonte', '3450480', 'MG', '(31) 589-6369', '(31) 6995-5555', 'dasilva@gmail.com', NULL, '', '07415768051', '1997-11-04', 'M', 'S', _binary '', 'crm/mg 456456'),
	(4, 4, 'Dr. Abcedario', '', '', '', '', 'MG', '(48) 2759-4679', '', 'suporte@sabara.mg.gov.br', NULL, '', '02908681064', '1970-10-26', 'M', 'S', _binary '', '123456789');

-- Copiando estrutura para tabela smed.tabela
CREATE TABLE IF NOT EXISTS `tabela` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_indice` int DEFAULT NULL,
  `descricao` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tabela_indices` (`id_indice`),
  CONSTRAINT `FK_tabela_indices` FOREIGN KEY (`id_indice`) REFERENCES `indices` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.tabela: ~3 rows (aproximadamente)
INSERT INTO `tabela` (`id`, `id_indice`, `descricao`) VALUES
	(1, 1, 'TUSS'),
	(2, 21, 'Tabela1');

-- Copiando estrutura para tabela smed.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_perfil` int DEFAULT NULL,
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
  PRIMARY KEY (`id`),
  KEY `FK_usuario_perfil_usuarios_opcoes` (`id_perfil`),
  CONSTRAINT `FK_usuario_perfil_usuarios_opcoes` FOREIGN KEY (`id_perfil`) REFERENCES `perfil_usuarios_opcoes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela smed.usuario: ~3 rows (aproximadamente)
INSERT INTO `usuario` (`id`, `id_perfil`, `nome`, `login`, `senha`, `ativo`, `prescricoes`, `pacientesdados`, `pacienteshistoria`, `agendamarcacao`, `agendageracao`, `cadastros`, `tipo`, `email`, `telefone`) VALUES
	(1, 1, 'Glaison Queiroz', 'Glaison', 'MTIzNDU2Nzg=', 'S', NULL, NULL, NULL, NULL, NULL, NULL, '1', 'glaison26.queiroz@gmail.com', '3136712550'),
	(3, 2, 'Dr. José da Silva', 'dasilva', 'MTIzNDU2Nzg=', 'S', NULL, NULL, NULL, NULL, NULL, NULL, '2', 'dasilva@gmail.com', '3678985412'),
	(4, 2, 'Dr. Manoel da Costa e Silva', 'ManoelSilva', 'MTIzNDU2Nzg=', 'S', NULL, NULL, NULL, NULL, NULL, NULL, '2', 'glaison26.queiroz@gmail.com', '36712550'),
	(5, 1, 'teste da silva', 'teste', 'c2FiYXJhQDIwMjU=', 'S', NULL, NULL, NULL, NULL, NULL, NULL, '1', 'teste@gmail.com', '3198545555');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
