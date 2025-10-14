<?php
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}
// anamnese_grava.php
// Script para gravar os dados da anamnese no banco de dados
// Inclui o arquivo de conexão com o banco de dados
include_once("../conexao.php");
$msg_erro = "";
// declaro variáveis com valores padrões
// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coleta os dados do formulário
    $id_paciente = $_SESSION['id_paciente'];
    $d_data = date('Y-m-d');
    $c_setor = $_POST['c_setor'];
    $c_cargo = $_POST['c_cargo'];
    $d_data_admissao = $_POST['c_admissao'];
    $c_atividade = $_POST['c_atividade'];
    $c_jornada = $_POST['c_jornada'];
    $c_descricao_atividades = $_POST['c_descricao_atividades'];
    // pego dados de uso de epis
    // radio de uso de epis sim ou não
    $c_uso_epi = $_POST['c_uso_epi'];
    // qual epis usa
    $c_quais_epi = $_POST['c_qual_epi'];
    // leitura do cheklist de riscos sendo (fisico, químico, biológico, ergonômico, acidente)
    // risco fisico
    if (isset($_POST['c_risco_fisico'])) {
        $c_risco_fisico = 'S';
    } else {
        $c_risco_fisico = 'N';
    }
    // risco químico
    if (isset($_POST['c_risco_quimico'])) {
        $c_risco_quimico = 'S';
    } else {
        $c_risco_quimico = 'N';
    }
    // risco biológico
    if (isset($_POST['c_risco_biologico'])) {
        $c_risco_biologico = 'S';
    } else {
        $c_risco_biologico = 'N';
    }
    // risco ergonômico
    if (isset($_POST['c_risco_ergonomico'])) {
        $c_risco_ergonomico = 'S';
    } else {
        $c_risco_ergonomico = 'N';
    }
    // risco acidente
    if (isset($_POST['c_risco_acidente'])) {
        $c_risco_acidente = 'S';
    } else {
        $c_risco_acidente = 'N';
    }
    // pego dados dos radios dos antecedentes pessoais
    // hipertensão arterial sim ou não
    $c_antecedente_hipertensao = $_POST['c_hipertensao'];
    // diabetes sim ou não
    $c_antecedente_diabetes = $_POST['c_diabetes'];
    // cardiopatia sim ou não
    $c_antecedente_cardiovasculares = $_POST['c_doencas_cardiovasculares'];
    // pneumopatia sim ou não
    $c_antecedente_asma_bronquite = $_POST['c_asma_bronquite'];
    // doenças renais sim ou não
    $c_doencas_renais = $_POST['c_doencas_renais'];
    // doenças neurológicas sim ou não
    $c_doencas_neurologicas = $_POST['c_doencas_neurologicas'];
    // doenças disturbios psiquiátricos sim ou não
    $c_disturbios_psiquiatricos = $_POST['c_disturbios_psiquiatricos'];
    // doenças cancer sim ou não
    $c_cancer = $_POST['c_cancer'];
    // doenças alergias sim ou não
    $c_alergias = $_POST['c_alergias'];
    // cirurgias sim ou não
    $c_cirurgias_previas = $_POST['c_cirurgias_previas'];
    // pego os dados do motivo da consulta
    $c_queixa_principal = $_POST['c_queixa_principal'];
    $c_historia_doenca_atual = $_POST['c_hda'];
    // pego o valor selecionado do combo box de motivo de consulta
    $c_motivo_consulta = $_POST['c_motivo_consulta'];
    // uso de medicação
    $c_uso_medicamentos = $_POST['c_medicamentos_uso'];
    // tabagismo
    $c_tabagismo = $_POST['c_tabagismo'];
    // quantidade de cigarros por dia
    // verifico se a quantidade de cigarros é numérica
    if (is_numeric($_POST['c_cigarros_dia'])) {
        $c_qtd_cigarros_dia = $_POST['c_cigarros_dia'];
    } else {
        $c_qtd_cigarros_dia = 0;
    }
    // tempo de tabagismo em anos  
    // verifico se tempo de tabagismo é numerico
    if (is_numeric($_POST['c_tempo_tabagismo'])) {
        $c_tempo_tabagismo_anos = $_POST['c_tempo_tabagismo'];
    } else {
        $c_tempo_tabagismo_anos = 0;
    }
    // alcolismo
    $c_alcoolismo = $_POST['c_alcoolismo'];
    // quantidade de doses por semana
    $c_qtd_doses_semana = $_POST['c_alcool_semana'];
    // atividade física
    $c_atividade_fisica = $_POST['c_atividade_fisica'];
    $c_quais_atividades_fisicas = $_POST["c_qual_atividade"];
    $c_frequencia_atividade_fisica = $_POST["c_frequencia_atividade"];
    // dados de antecedentes familiares capturados nos radios butons
    // hipertensão arterial sim ou não
    $c_familiar_hipertensao = $_POST['c_hipertensao_familiar'];
    $c_obs_familiar_hipertensao = $_POST['c_hipertensao_familiar_parentesco'];
    // diabetes sim ou não
    $c_familiar_diabetes = $_POST['c_diabetes_familiar'];
    $c_obs_familiar_diabetes = $_POST['c_diabetes_familiar_parentesco'];
    // cardiopatia sim ou não
    $c_familiar_cardiovasculares = $_POST['c_doencas_cardiovasculares_familiar'];
    $c_obs_familiar_cardiovasculares = $_POST['c_doencas_cardiovasculares_familiar_parentesco'];
    // cancer sim ou não
    $c_familiar_cancer = $_POST['c_cancer_familiar'];
    $c_obs_familiar_cancer = $_POST['c_cancer_familiar_parentesco'];
    //outras doenças sim ou não
    $c_familiar_outras_doencas = $_POST['c_outras_doencas_familiar'];
    $c_obs_familiar_outras_doencas = $_POST['c_outras_doencas_familiar_parentesco'];
    // Interrogatório Sintomatológico
    // campo com input de radio do interrogatório sintomatológico
    $c_geral = $_POST['c_geral'];
    $c_pele = $_POST['c_pele'];
    $c_cabeca_pescoco = $_POST['c_cabeca_pescoco'];
    $c_olhos = $_POST['c_olhos'];
    $c_ouvidos = $_POST['c_ouvidos'];
    $c_respiratorio = $_POST['c_respiratorio'];
    $c_cardiovascular = $_POST['c_cardiovascular'];
    $c_gastrointestinal = $_POST['c_gastrointestinal'];
    $c_genitourinario = $_POST['c_genitourinario'];
    $c_musculo_esqueletico = $_POST['c_musculoesqueletico'];
    $c_neurologico = $_POST['c_neurologico'];
    $c_psiquiatrico = $_POST['c_psiquiatrico'];
    // pego dados do exame físico
    // rotina de validação dos dados recebidos
    $c_pressao_arterial = $_POST['c_pressao_arterial'];
    // verifico se o valor da frequencia cardiaca é numerico
    if ((is_numeric($_POST['c_pressao_arterial']))) {
        $c_frequencia_cardiaca = $_POST['c_frequencia_cardiaca'];
    } else {
        $c_frequencia_cardiaca  = 0;
    }
    // verifico se o valor da frequencia respiratória é numerico
    if (is_numeric($_POST['c_frequencia_respiratoria'])) {
        $c_frequencia_respiratoria = $_POST['c_frequencia_respiratoria'];
    } else {
        $c_frequencia_respiratoria = 0;
    }
    // verifico se o valor do peso é numerico
    if (is_numeric($_POST['c_frequencia_respiratoria'])) {
        $c_peso = $_POST['c_peso'];
    } else {
        $c_peso = 0;
    }
    // verifico se o valor de altura é numérico
    if (is_numeric($_POST['c_altura'])) {
        $c_altura = $_POST['c_altura'];
    } else {
        $c_altura = 0;
    }
    // verifico se o valor de imc é numérico
    if (is_numeric($_POST['c_imc'])) {
        $c_imc = $_POST['c_imc'];
    } else {
        $c_imc = 0;
    }
    $c_ecotoscopia = $_POST['c_ectoscopia'];
    $c_aparelho_respiratorio = $_POST['c_aparelho_respiratorio'];
    $c_aparelho_cardiovascular = $_POST['c_aparelho_cardiovascular'];
    $c_aparelho_abdome = $_POST['c_aparelho_abdome'];
    $c_membros = $_POST['c_membros'];
    $c_coluna_vertebral = $_POST['c_coluna_vertebral'];
    $c_exame_neurologico = $_POST['c_exame_neurologico'];
    // conduta e parecer do médico
    $c_hipotese_diagnostica = $_POST['c_hipotese_diagnostica'];
    $c_conduta = $_POST['c_conduta'];
    $c_exames_complementares = $_POST['c_exames_complementares'];
    // radio butons com parecer do médico Apto para a função, Apto com restrições ou Inapto
    $c_parecer_medico = $_POST['c_parecer_medico'];
    // antecedentes pessoais com as observações
    $c_antecedente_hipertensao_obs = $_POST['c_hipertensao_obs'];
    $c_antecedente_diabetes_obs = $_POST['c_diabetes_obs'];
    $c_antecedente_cardiovasculares_obs = $_POST['c_doencas_cardiovasculares_obs'];
    $c_antecedente_asma_bronquite_obs = $_POST['c_asma_bronquite_obs'];
    $c_antecedente_doencas_renais_obs = $_POST['c_doencas_renais_obs'];
    $c_antecedente_doencas_neurologicas_obs = $_POST['c_doencas_neurologicas_obs'];
    $c_antecedente_disturbios_psiquiatricos_obs = $_POST['c_disturbios_psiquiatricos_obs'];
    $c_antecedentes_cancer_obs = $_POST['c_cancer_obs'];
    $c_antecedentes_alergias_obs = $_POST['c_alergias_obs'];
    $c_antecedentes_cirurgias_previa_obs = $_POST['c_cirurgias_previas_obs'];
    // conduta parecer medicos
    $c_hipotese_diagnostica = $_POST['c_hipotese_diagnostica'];
    $c_exames_complementares = $_POST['c_exames_complementares'];
    $c_conduta = $_POST['c_conduta'];
    $c_restricoes = $_POST['restricoes'];
    // apto para a função
    // risco ergonômico
    // parecer medico
    if (isset($_POST['c_parecer_medico_apto'])) {
        $c_parecer = 'A';
    } 
    if (isset($_POST['c_parecer_medico_apto_restricoes'])){
        $c_parecer = 'R';
    }
    if (isset($_POST['c_parecer_medico_inapto'])) {
        $c_parecer = 'I';
    }
    // Valida os dados (exemplo simples, você pode adicionar mais validações)
    if (empty($c_setor) || empty($c_cargo) || empty($d_data_admissao) || empty($c_atividade) || empty($c_jornada)) {
        $msg_erro = "Por favor, preencha todos os campos obrigatórios.";
    }
    if (strtotime($d_data_admissao) > strtotime(date('Y-m-d'))) {
        $msg_erro = "A data de admissão não pode ser no futuro.";
    }
    if ($c_motivo_consulta == "Selecione") {
        $msg_erro = "Por favor, selecione o motivo da consulta.";
    }
    if (!empty($msg_erro)) {
        // Se houver erros, exibe a mensagem e interrompe a execução
        die($msg_erro);
    }
    // Prepara a query SQL para inserção dos dados
    $c_sql = "INSERT INTO anamnese (id_paciente, data, setor, funcao, admissao, atividades, jornada, descricao_atividades,
    risco_fisico, risco_quimico, risco_biologico, risco_ergonomico, risco_acidentes, motivo_consulta, queixa_principal, hda,
    antecedente_hipertensao, antecedente_diabete, antecedente_cardiaco, antecedente_asma_bronquite, antecedente_renais, 
    antecedente_neurologica, antecedente_psquiatrico, antecedente_cancer, antecedente_alergia, antecedente_cirurgias, medicamentos_uso,
    habito_tabagismo, etilismo, atividade_fisica, atividade_fisica_qual, atividade_fisica_frequencia, tabagismo_qtd_dia, tabagismo_tempo, etilismo_frequencia, usa_epi, quais_epi,
    familiar_hipertensao, obs_familiar_hipertensao, familiar_diabetes, obs_familiar_diabetes,
    familiar_cardiaco, obs_familiar_cardiaco, familiar_cancer, obs_familiar_cancer,  familiar_outros, obs_familiar_outros,
    stm_geral, stm_pele, stm_cabeca_pescoso, stm_olhos, stm_ouvidos, stm_respiratorio, stm_cardiovascular,
    stm_gastro, stm_geniturario, stm_musculo_esqueletico, stm_neurologico, stm_pisiquico, exame_pa, exame_fc, exame_fr, exame_peso,
    exame_altura, exame_imc, exame_ectoscopia, exame_aparelho_respiratorio, exame_aparelho_cardio, exame_abdome,
    exame_membros, exame_coluna, exame_neurologico,
    obs_hipertensao, obs_diabete, obs_cardiaco, obs_asma_bronquite, obs_renais, obs_neurologia, obs_psiquiatrico, obs_cancer,
    obs_alergia, obs_cirurgia,conduta_hipotese_diag, conduta_exames_compl, conduta, parecer, restricoes)
            VALUES ('$id_paciente', '$d_data', '$c_setor', '$c_cargo', '$d_data_admissao', '$c_atividade', '$c_jornada', '$c_descricao_atividades',
            '$c_risco_fisico', '$c_risco_quimico', '$c_risco_biologico', '$c_risco_ergonomico', '$c_risco_acidente', '$c_motivo_consulta',
            '$c_queixa_principal', '$c_historia_doenca_atual', '$c_antecedente_hipertensao', '$c_antecedente_diabetes',
            '$c_antecedente_cardiovasculares', '$c_antecedente_asma_bronquite', '$c_doencas_renais', '$c_doencas_neurologicas',
            '$c_disturbios_psiquiatricos', '$c_cancer', '$c_alergias', '$c_cirurgias_previas', '$c_uso_medicamentos',
            '$c_tabagismo', '$c_alcoolismo', '$c_atividade_fisica', '$c_quais_atividades_fisicas', '$c_frequencia_atividade_fisica',
            '$c_qtd_cigarros_dia', '$c_tempo_tabagismo_anos', '$c_qtd_doses_semana'
            , '$c_uso_epi', '$c_quais_epi', '$c_familiar_hipertensao', '$c_obs_familiar_hipertensao', 
            '$c_familiar_diabetes', '$c_obs_familiar_diabetes',
             '$c_familiar_cardiovasculares', '$c_obs_familiar_cardiovasculares',
            '$c_familiar_cancer','$c_obs_familiar_cancer',
            '$c_familiar_outras_doencas', '$c_obs_familiar_outras_doencas',
             '$c_geral', '$c_pele', '$c_cabeca_pescoco', '$c_olhos', '$c_ouvidos',
            '$c_respiratorio', '$c_cardiovascular', '$c_gastrointestinal', '$c_genitourinario', '$c_musculo_esqueletico', 
            '$c_neurologico', '$c_psiquiatrico', '$c_pressao_arterial', '$c_frequencia_cardiaca', '$c_frequencia_respiratoria', '$c_peso',
            '$c_altura', '$c_imc', '$c_ecotoscopia', '$c_aparelho_respiratorio', '$c_aparelho_cardiovascular', '$c_aparelho_abdome',
            '$c_membros', '$c_coluna_vertebral', '$c_exame_neurologico',
            '$c_antecedente_hipertensao_obs', '$c_antecedente_diabetes_obs','$c_antecedente_cardiovasculares_obs',
            '$c_antecedente_asma_bronquite_obs','$c_antecedente_doencas_renais_obs', '$c_antecedente_doencas_neurologicas_obs',
            '$c_antecedente_disturbios_psiquiatricos_obs', '$c_antecedentes_cancer_obs', '$c_antecedentes_alergias_obs',
            '$c_antecedentes_cirurgias_previa_obs', '$c_hipotese_diagnostica','$c_exames_complementares','$c_conduta',
             '$c_parecer', '$c_restricoes')";
    //echo $c_sql;
    // Executa a query SQL        
    $result = $conection->query($c_sql);
    // verifico se a query foi correto
    if ($result === TRUE) {
        // Redireciona para a página de sucesso
        header("Location: anamnese_lista.php");
        exit();
    } else {
        // Exibe mensagem de erro
        echo "Erro ao gravar a anamnese: " . $conection->error;
    }
    // Fecha a conexão com o banco de dados

    $conection->close();
}
