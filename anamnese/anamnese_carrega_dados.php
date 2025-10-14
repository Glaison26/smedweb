<?php
// carrega dados do registro selecionado para a variaveis do formulário
// monto sql com os dados 
$c_sql = "select * from anamnese where id ='$c_id'";
$result = $conection->query($c_sql);
$registro = $result->fetch_assoc();
// verifico se executou o sql
if (!$registro) {
    header('location: /smedweb/anamenese/anamnese_lista.php');
    exit;
}
// pego valores e jogo nas variaveis
$c_setor = $registro['setor'];
$c_cargo = $registro['funcao'];
$c_admissao = $registro['admissao'];
$c_atividade = $registro['atividades'];
$c_descricao_atividade = $registro['descricao_atividades'];
$c_jornada = $registro['jornada'];
// risco fisico
if ($registro['risco_fisico'] == 'S') {
    $c_risco_fisico = "checked";
} else {
    $c_risco_fisico = "";
}
// risco quimico
if ($registro['risco_quimico'] == 'S') {
    $c_risco_quimico = "checked";
} else {
    $c_risco_quimico = "";
}
// risco biologico
if ($registro['risco_biologico'] == 'S') {
    $c_risco_biologico = "checked";
} else {
    $c_risco_biologico = "";
}
// risco ergonomico
if ($registro['risco_ergonomico'] == 'S') {
    $c_risco_ergonomico = "checked";
} else {
    $c_risco_ergonomico = "";
}
// risco acidentes
if ($registro['risco_acidentes'] == 'S') {
    $c_risco_acidentes = "checked";
} else {
    $c_risco_acidentes = "";
}
// uso de epi sim ou não
if ($registro['usa_epi'] == 'Sim') {
    $c_check_usa_epi_sim = 'checked';
    $c_check_usa_epi_nao = "";
    $c_habilita_qual_epi = "";
    $c_qual_epi = $registro['quais_epi'];
} else {
    $c_check_usa_epi_sim = "";
    $c_check_usa_epi_nao = "checked";
    $c_habilita_qual_epi = "disabled";
    $c_qual_epi = "";
}
// motivo da consulta
$c_motivo_consulta = $registro['motivo_consulta'];
// queixa principal
$c_queixa_principal = $registro['queixa_principal'];
// hda
$c_hda = $registro['hda'];
// Antecedentes pessoais
// hipertensão sistemica 
if ($registro['antecedente_hipertensao'] == 'Sim') {
    $c_check_antecedente_hipertensao_sim = "checked";
    $c_check_antecedente_hipertensao_nao = "";
    $c_habilita_antecedente_hipertensao_obs = "";
    $c_hipertensao_obs = $registro['obs_hipertensao'];
} else {
    $c_check_antecedente_hipertensao_sim = "";
    $c_check_antecedente_hipertensao_nao = "checked";
    $c_habilita_antecedente_hipertensao_obs = "disabled";
    $c_hipertensao_obs = "";
}
// diabetis melinus
if ($registro['antecedente_diabete'] == 'Sim') {
    $c_check_antecedente_diabete_sim = "checked";
    $c_check_antecedente_diabete_nao = "";
    $c_habilita_antecedente_diabete_obs = "";
    $c_diabete_obs = $registro['obs_diabete'];
} else {
    $c_check_antecedente_diabete_sim = "";
    $c_check_antecedente_diabete_nao = "checked";
    $c_habilita_antecedente_diabete_obs = "disabled";
    $c_diabete_obs = "";
}
// doenças cardiovasculares
if ($registro['antecedente_cardiaco'] == 'Sim') {
    $c_check_antecedente_cardiaco_sim = "checked";
    $c_check_antecedente_cardiaco_nao = "";
    $c_habilita_antecedente_cardiaco_obs = "";
    $c_cardiaco_obs = $registro['obs_cardiaco'];
} else {
    $c_check_antecedente_cardiaco_sim = "";
    $c_check_antecedente_cardiaco_nao = "checked";
    $c_habilita_antecedente_cardiaco_obs = "disabled";
    $c_cardiaco_obs = "";
}

// asma / bronquite 
if ($registro['antecedente_asma_bronquite'] == 'Sim') {
    $c_check_antecedente_asma_bronquite_sim = "checked";
    $c_check_antecedente_asma_bronquite_nao = "";
    $c_habilita_antecedente_asma_bronquite_obs = "";
    $c_asma_bronquite_obs = $registro['obs_asma_bronquite'];
} else {
    $c_check_antecedente_asma_bronquite_sim = "";
    $c_check_antecedente_asma_bronquite_nao = "checked";
    $c_habilita_antecedente_asma_bronquite_obs = "disabled";
    $c_asma_bronquite_obs = "";
}
// Doenças renais
if ($registro['antecedente_renais'] == 'Sim') {
    $c_check_antecedente_renais_sim = "checked";
    $c_check_antecedente_renais_nao = "";
    $c_habilita_antecedente_renais_obs = "";
    $c_renais_obs = $registro['obs_renais'];
} else {
    $c_check_antecedente_renais_sim = "";
    $c_check_antecedente_renais_nao = "checked";
    $c_habilita_antecedente_renais_obs = "disabled";
    $c_renais_obs = "";
}
// antecedente neurologicos
if ($registro['antecedente_neurologica'] == 'Sim') {
    $c_check_antecedente_neurologicos_sim = "checked";
    $c_check_antecedente_neurologicos_nao = "";
    $c_habilita_antecedente_neurologicos_obs = "";
    $c_neurologicos_obs = $registro['obs_neurologia'];
} else {
    $c_check_antecedente_neurologicos_sim = "";
    $c_check_antecedente_neurologicos_nao = "checked";
    $c_habilita_antecedente_neurologicos_obs = "disabled";
    $c_neurologicos_obs = "";
}
// antecedentes psquiatricos
if ($registro['antecedente_psquiatrico'] == 'Sim') {
    $c_check_antecedente_psquiatrico_sim = "checked";
    $c_check_antecedente_psquiatrico_nao = "";
    $c_habilita_antecedente_psiquiatrico_obs = "";
    $c_psquiatrico_obs = $registro['obs_psquiatrico'];
} else {
    $c_check_antecedente_psquiatrico_sim = "";
    $c_check_antecedente_psquiatrico_nao = "checked";
    $c_habilita_antecedente_psiquiatrico_obs = "disabled";
    $c_psquiatrico_obs = "";
}
// Câncer
if ($registro['antecedente_cancer'] == 'Sim') {
    $c_check_antecedente_cancer_sim = "checked";
    $c_check_antecedente_cancer_nao = "";
    $c_habilita_antecedente_cancer_obs = "";
    $c_cancer_obs = $registro['obs_cancer'];
} else {
    $c_check_antecedente_cancer_sim = "";
    $c_check_antecedente_cancer_nao = "checked";
    $c_habilita_antecedente_cancer_obs = "disabled";
    $c_cancer_obs = "";
}
// Alergias
if ($registro['antecedente_alergia'] == 'Sim') {
    $c_check_antecedente_alergia_sim = "checked";
    $c_check_antecedente_alergia_nao = "";
    $c_habilita_antecedente_alergia_obs = "";
    $c_alergia_obs = $registro['obs_alergia'];
} else {
    $c_check_antecedente_alergia_sim = "";
    $c_check_antecedente_alergia_nao = "checked";
    $c_habilita_antecedente_alergia_obs = "disabled";
    $c_alergia_obs = "";
}
// cirurgias prévia
if ($registro['antecedente_cirurgias'] == 'Sim') {
    $c_check_antecedente_cirurgias_sim = "checked";
    $c_check_antecedente_cirurgias_nao = "";
    $c_habilita_antecedente_cirurgias_obs = "";
    $c_cirurgia_obs = $registro['obs_cirurgia'];
} else {
    $c_check_antecedente_cirurgias_sim = "";
    $c_check_antecedente_cirurgias_nao = "checked";
    $c_habilita_antecedente_cirurgias_obs = "disabled";
    $c_cirurgia_obs = "";
}
// medicamentos em uso (texto livre)
$c_medicamento_uso = $registro['medicamentos_uso'];
// tabagismo sim ou não
if ($registro['habito_tabagismo'] == 'Sim') {
    $c_check_tabagismo_sim = "checked";
    $c_check_tabagismo_nao = "";
    $c_Habilita_qtd_cigarros = "";
    $c_habilita_tempo_cigarro = "";
    $i_qtd_cigarros = $registro['tabagismo_qtd_dia'];
    $i_tempo_cigarros = $registro['tabagismo_tempo'];
} else {
    $c_check_tabagismo_sim = "";
    $c_check_tabagismo_nao = "checked";
    $c_Habilita_qtd_cigarros = "disabled";
    $c_habilita_tempo_cigarro = "disabled";
    $i_qtd_cigarros = "";
    $i_tempo_cigarros = "";
}
// Etilismo sim ou não
if ($registro['etilismo']) {
    $c_check_etilismo_sim = "checked";
    $c_check_etilismo_nao = "";
    $c_habilita_elitismo_freq = "";
    $c_etilismo_freq = $registro['etilismo_frequencia'];
} else {
    $c_check_etilismo_sim = "";
    $c_check_etilismo_nao = "checked";
    $c_habilita_elitismo_freq = "disabled";
    $c_etilismo_freq = "";
}
// atividade fisica
if ($registro['atividade_fisica'] == 'Sim') {
    $c_check_atividade_fisica_sim = "checked";
    $c_check_atividade_fisica_nao = "";
    $c_Habilita_atividade_fisica_qual = "";
    $c_habilita_atividade_fisica_freq = "";
    $c_atividade_fisica_qual = $registro['atividade_fisica_qual'];
    $c_atividade_fisica_freq = $registro['atividade_fisica_frequencia'];
} else {
    $c_check_atividade_fisica_sim = "";
    $c_check_atividade_fisica_nao = "checked";
    $c_Habilita_atividade_fisica_qual = "enabled";
    $c_habilita_atividade_fisica_freq = "enabled";
    $c_atividade_fisica_qual = "";
    $c_atividade_fisica_freq = "";
}
// antecedentes familiares
// hipertensão
if ($registro['familiar_hipertensao'] == 'Sim') {
    $c_check_famimilar_hipertencao_sim = "checked";
    $c_check_famimilar_hipertencao_nao = "";
    $c_habilita_parentesco_hipertensao = "";
    $c_parentesco_hipertensao = $registro['obs_familiar_hipertensao'];
} else {
    $c_check_famimilar_hipertencao_sim = "";
    $c_check_famimilar_hipertencao_nao = "checked";
    $c_habilita_parentesco_hipertensao = "disabled";
    $c_parentesco_hipertensao = "";
}
// Diabetes
if ($registro['familiar_diabetes'] == 'Sim') {
    $c_check_famimilar_diabetes_sim = "checked";
    $c_check_famimilar_diabetes_nao = "";
    $c_habilita_parentesco_diabetes = "";
    $c_parentesco_diabetes = $registro['obs_familiar_diabetes'];
} else {
    $c_check_famimilar_diabetes_sim = "";
    $c_check_famimilar_diabetes_nao = "checked";
    $c_habilita_parentesco_diabetes = "disabled";
    $c_parentesco_diabetes = "";
}
// Doenças cardiovasculares
if ($registro['familiar_cardiaco'] == 'Sim') {
    $c_check_famimilar_cardiaco_sim = "checked";
    $c_check_famimilar_cardiaco_nao = "";
    $c_habilita_parentesco_cardiaco = "";
    $c_parentesco_cardiaco = $registro['obs_familiar_cardiaco'];
} else {
    $c_check_famimilar_cardiaco_sim = "";
    $c_check_famimilar_cardiaco_nao = "checked";
    $c_habilita_parentesco_cardiaco = "disabled";
    $c_parentesco_cardiaco = "";
}
// familiar cancer
if ($registro['familiar_cancer'] == 'Sim') {
    $c_check_famimilar_cancer_sim = "checked";
    $c_check_famimilar_cancer_nao = "";
    $c_habilita_parentesco_cancer = "";
    $c_parentesco_cancer = $registro['obs_familiar_cancer'];
} else {
    $c_check_famimilar_cancer_sim = "";
    $c_check_famimilar_cancer_nao = "checked";
    $c_habilita_parentesco_cancer = "disabled";
    $c_parentesco_cancer = "";
}
// paretescos outras donças
if ($registro['familiar_outros'] == 'Sim') {
    $c_check_famimilar_outros_sim = "checked";
    $c_check_famimilar_outros_nao = "";
    $c_habilita_parentesco_outros = "";
    $c_parentesco_outros = $registro['obs_familiar_outros'];
} else {
    $c_check_famimilar_outros_sim = "";
    $c_check_famimilar_outros_nao = "checked";
    $c_habilita_parentesco_outros = "disabled";
    $c_parentesco_outros = "";
}
// Interrogatório Sintomatológico (Revisão por Sistemas)
// Geral (Febre, perda de peso, fadiga)
if ($registro['stm_geral'] == 'Sim') {
    $c_check_smtp_geral_sim = "checked";
    $c_check_smtp_geral_nao = "";
} else {
    $c_check_smtp_geral_sim = "";
    $c_check_smtp_geral_nao = "checked";
}
// Cabeça/Pescoço (Dor de cabeça, tontura, dor no pescoço)
if ($registro['stm_cabeca_pescoso'] == 'Sim') {
    $c_check_smtp_cabeca_pescoco_sim = "checked";
    $c_check_smtp_cabeca_pescoco_nao = "";
} else {
    $c_check_smtp_cabeca_pescoco_sim = "";
    $c_check_smtp_cabeca_pescoco_nao = "checked";
}
// pele
if ($registro['stm_pele'] == 'Sim') {
    $c_check_smtp_pele_sim = "checked";
    $c_check_smtp_pele_nao = "";
} else {
    $c_check_smtp_pele_sim = "";
    $c_check_smtp_pele_nao = "checked";
}
// olhos
if ($registro['stm_olhos'] == 'Sim') {
    $c_check_smtp_olhos_sim = "checked";
    $c_check_smtp_olhos_nao = "";
} else {
    $c_check_smtp_olhos_sim = "";
    $c_check_smtp_olhos_nao = "checked";
}
// ouvidos
if ($registro['stm_ouvidos'] == 'Sim') {
    $c_check_smtp_ouvidos_sim = "checked";
    $c_check_smtp_ouvidos_nao = "";
} else {
    $c_check_smtp_ouvidos_sim = "";
    $c_check_smtp_ouvidos_nao = "checked";
}
// Respiratório (Tosse, falta de ar, dor no peito)
if ($registro['stm_respiratorio'] == 'Sim') {
    $c_check_smtp_respiratorio_sim = "checked";
    $c_check_smtp_respiratorio_nao = "";
} else {
    $c_check_smtp_respiratorio_sim = "";
    $c_check_smtp_respiratorio_nao = "checked";
}
// Cardiovascular (Palpitações, dor no peito, inchaço)
if ($registro['stm_cardiovascular'] == 'Sim') {
    $c_check_smtp_cardiovascular_sim = "checked";
    $c_check_smtp_cardiovascular_nao = "";
} else {
    $c_check_smtp_cardiovascular_sim = "";
    $c_check_smtp_cardiovascular_nao = "checked";
}
// Gastrointestinal (Dor abdominal, náusea, vômito)
if ($registro['stm_gastro'] == 'Sim') {
    $c_check_smtp_gastro_sim = "checked";
    $c_check_smtp_gastro_nao = "";
} else {
    $c_check_smtp_gastro_sim = "";
    $c_check_smtp_gastro_nao = "checked";
}
// Geniturario
if ($registro['stm_geniturario'] == 'Sim') {
    $c_check_smtp_geniturario_sim = "checked";
    $c_check_smtp_geniturario_nao = "";
} else {
    $c_check_smtp_geniturario_sim = "";
    $c_check_smtp_geniturario_nao = "checked";
}
// Musculoesquelético (Dor nas articulações, fraqueza muscular)
if ($registro['stm_musculo_esqueletico'] == 'Sim') {
    $c_check_smtp_musculo_esqueletico_sim = "checked";
    $c_check_smtp_musculo_esqueletico_nao = "";
} else {
    $c_check_smtp_musculo_esqueletico_sim = "";
    $c_check_smtp_musculo_esqueletico_nao = "checked";
}
// Neurológico (Tontura, fraqueza, convulsões)
if ($registro['stm_neurologico'] == 'Sim') {
    $c_check_smtp_musculo_neurologico_sim = "checked";
    $c_check_smtp_musculo_neurologico_nao = "";
} else {
    $c_check_smtp_musculo_neurologico_sim = "";
    $c_check_smtp_musculo_neurologico_nao = "checked";
}
// Psiquiátrico (Ansiedade, depressão, insônia)
if ($registro['stm_pisiquico'] == 'Sim') {
    $c_check_smtp_musculo_psiquiatrico_sim = "checked";
    $c_check_smtp_musculo_psiquiatrico_nao = "";
} else {
    $c_check_smtp_musculo_psiquiatrico_sim = "";
    $c_check_smtp_musculo_psiquiatrico_nao = "checked";
}

$c_pa = $registro['exame_pa']; // Pressão Arterial
$c_fc = $registro['exame_fc']; // frequencia cardiaca
$c_fr = $registro['exame_fr']; // frequencia respiratoria
$n_peso = $registro['exame_peso']; // peso
$n_altura = $registro['exame_altura']; // altura
$n_imc = $registro['exame_imc']; // indice de massa coorporal
//
$c_ectoscopia = $registro['exame_ectoscopia'];
$c_exame_aparelho_respiratorio = $registro['exame_aparelho_respiratorio'];
$c_exame_aparelho_cardio = $registro['exame_aparelho_cardio'];
$c_exame_abdome = $registro['exame_abdome'];
$c_exame_membros = $registro['exame_membros'];
$c_exame_coluna = $registro['exame_coluna'];
$c_exame_neurologico = $registro['exame_neurologico'];
// conduta e parecer Médico
$c_hipotese_diagnostica = $registro['conduta_hipotese_diag'];
$c_exames_complementares = $registro['conduta_exames_compl'];
$c_conduta = $registro['conduta'];
// parecer 
if ($registro['parecer']=='A') {
    // cria variavel para check
}
if ($registro['parecer']=='R') {
    $c_parecer = 'R';
}
if ($registro['parecer']=='I') {
    $c_parecer = 'I';
}
