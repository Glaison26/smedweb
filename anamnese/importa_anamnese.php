<?php
// rotina para enviar dados da anamnese do paciente para a história clínica
// Sessão
session_start();
// Conexão
require_once '../conexao.php';
// monto sql com registro da anamnese
$c_id = $_GET["id"];
$c_sql = "select * from anamnese where id ='$c_id'";

$result = $conection->query($c_sql);
$registro = $result->fetch_assoc();
// verifico se executou o sql
if (!$registro) {
    header('location: /smedweb/anamnese/anamnese_lista.php');
    exit;
}
// pego valores na tabela e jogo nas variaveis
$i_id_paciente_anamnese = $registro['id_paciente'];


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
if ($registro['parecer'] == 'A') {
    $c_chk_apto = "checked";
} else {
    $c_chk_apto = "";
}
if ($registro['parecer'] == 'R') {
    $c_chk_apto_restricoes = "checked";
} else {
    $c_chk_apto_restricoes = "";
}
if ($registro['parecer'] == 'I') {
    $c_chk_inapto = "checked";
} else {
    $c_chk_inapto = "";
}
if ($registro['parecer'] == 'R') {
    $c_habilita_restricao = "";
} else {
    $c_habilita_restricao = "disabled";
}
$c_restricoes = $registro['restricoes'];

// insiro dados das variaveis no histórico
$c_sql_historia = "select * from historia where id_paciente='$i_id_paciente_anamnese'";
$result = $conection->query($c_sql_historia);
$registro_historia = $result->fetch_assoc();
$hoje = date('d/m/Y');
$i_id_historia = $registro_historia['id']; // pego a id da historia a fim de fazer o update
$c_historia = $registro['historia'] . "\r\n" . "\r\n" . "        $hoje  -           " . "Anamnese do Paciente" . "\r\n" . "\r\n" .
    "Dados Ocupacionais" . "\r\n" . "\r\n" .
    "Setor :" . $registro['setor'] . "\r\n" . // setor
    "Cargo :" . $registro['funcao'] . "\r\n" . //cargo
    "Data de Admissão :" . $registro['admissao'] . "\r\n" .
    "Atividade :" . $registro['atividade'] . "\r\n" .
    "Descrição da Atividade :" . $registro['descricao_atividades'] . "\r\n" .
    "Jornada de Trabalho :" . $registro['jornada'] . "\r\n" .
    "Uso de EPI :" . $registro['usa_epi'] . "\r\n";
if ($registro['usa_epi'] == 'Sim') {
    $c_historia = $c_historia . "Qual EPI :" . $registro['quais_epi'] . "\r\n" . "\r\n";
}
// riscos ocupacionais
$c_historia = $c_historia . 'Riscos Ocupacionais :' . "\r\n" . "\r\n";
// risco fisico
if ($registro['risco_fisico'] == 'S') {
    $c_historia = $c_historia . 'Físico (Ruído, calor, frio, vibração, radiação) : Sim' . "\r\n";
} else {
    $c_historia = $c_historia . 'Físico (Ruído, calor, frio, vibração, radiação) : Não' . "\r\n";
}
// risco quimico
if ($registro['risco_quimico'] == 'S') {
    $c_historia = $c_historia . 'Químico (Poeira, fumos, gases,vapores, produtos químicos) : Sim' . "\r\n";
} else {
    $c_historia = $c_historia . 'Químico (Poeira, fumos, gases,vapores, produtos químicos) : Não' . "\r\n";
}
// risco biológico
if ($registro['risco_biologico'] == 'S') {
    $c_historia = $c_historia . 'Biológico (Vírus, bactérias, fungos, parasitas) : Sim' . "\r\n";
} else {
    $c_historia = $c_historia . 'Biológico (Vírus, bactérias, fungos, parasitas) : Não' . "\r\n";
}
// risco ergonomico
if ($registro['risco_ergonomico'] == 'S') {
    $c_historia = $c_historia . 'Ergonômico (Postura inadequada, esforço repetitivo, levantamento de peso) : Sim' . "\r\n";
} else {
    $c_historia = $c_historia . 'Ergonômico (Postura inadequada, esforço repetitivo, levantamento de peso) : Não' . "\r\n";
}
//risco Acidentes
if ($registro['risco_acidentes'] == 'S') {
    $c_historia = $c_historia . 'Acidentes (Máquinas sem proteção, risco de quedas, eletricidade) : Sim' . "\r\n";
} else {
    $c_historia = $c_historia . 'Acidentes (Máquinas sem proteção, risco de quedas, eletricidade) : Não' . "\r\n";
}
// Queixa Principal e História da Doença Atual (HDA)
$c_historia = $c_historia . 'Queixa Principal e História da Doença Atual (HDA)' . "\r\n" . "\r\n";
$c_historia = $c_historia . 'Motivo da Consulta: ' . $registro['motivo_consulta'] . "\r\n" .
    'Queixa Principal :' . $registro['queixa_principal'] . "\r\n" .
    'História da Doença Atual (HDA):' . $registro['hda'] . "\r\n";
// Antecedentes Pessoais
$c_historia = $c_historia ."\r\n".'Antecedentes Pessoais'."\r\n"."\r\n". 
'Hipertensão Arterial Sistêmica: '.$registro['antecedente_hipertensao']."\r\n".
'Diabetes Mellitus: '.$registro['antecedente_diabete']."\r\n".
'Doenças Cardiovasculares: '.$registro['antecedente_cardiaco']."\r\n".
'Asma/Bronquite: '.$registro['antecedente_asma_bronquite']."\r\n".
'Doenças Renais: '.$registro['antecedente_renais']."\r\n".
'Doenças Neurológicas: '.$registro['antecedente_neurologica']."\r\n".
'Distúrbios Psiquiátricos: '.$registro['antecedente_psiquiatrico']."\r\n".
'Câncer: '.$registro['antecedente_cancer']."\r\n".
'Alergias: '.$registro['antecedente_alergia']."\r\n".
'Cirurgias Prévias:'.$registro['antecedente_cirurgias']."\r\n"."\r\n".
'Medicamentos em Uso:'.$registro['medicamentos_uso']."\r\n"."\r\n".
'Hábitos de Vida :'."\r\n"."\r\n".
'Tabagismo: '.$registro['habito_tabagismo']."\r\n";
if ($registro['habito_tabagismo']=='Sim'){
    $c_historia = $c_historia.'Cigarros por dia :'.$registro['tabagismo_qtd_dia']."\r\n".
    'Há quanto tempo (anos):'.$registro['tabagismo_tempo']."\r\n"."\r\n";
}




// atualiza a historia
$c_sql_up = "UPDATE historia set  historia='$c_historia' where id = '$i_id_historia'";

$result = $conection->query($c_sql_up);
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


/////////////////////// fim de carregar registro /////////////////////////////////////
