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
$c_historia = $c_historia . "\r\n" . 'Antecedentes Pessoais' . "\r\n" . "\r\n" .
    'Hipertensão Arterial Sistêmica: ' . $registro['antecedente_hipertensao'].' - '.$registro['obs_hipertensao'] . "\r\n" .
    'Diabetes Mellitus: ' . $registro['antecedente_diabete'] . ' - '.$registro['obs_diabete']. "\r\n" .
    'Doenças Cardiovasculares: ' . $registro['antecedente_cardiaco'] . ' - '.$registro['obs_cardiaco'] ."\r\n" .
    'Asma/Bronquite: ' . $registro['antecedente_asma_bronquite'] . ' - '.$registro['obs_asma_bronquite']. "\r\n" .
    'Doenças Renais: ' . $registro['antecedente_renais'] . ' - '.$registro['obs_renais'] ."\r\n" .
    'Doenças Neurológicas: ' . $registro['antecedente_neurologica'] . ' - '.$registro['obs_neurologia']. "\r\n" .
    'Distúrbios Psiquiátricos: ' . $registro['antecedente_psiquiatrico'] . ' - '.$registro['obs_psiquiatrico']. "\r\n" .
    'Câncer: ' . $registro['antecedente_cancer'] . ' - '.$registro['obs_cancer']. "\r\n" .
    'Alergias: ' . $registro['antecedente_alergia'] . ' - '.$registro['obs_alergia'] ."\r\n" .
    'Cirurgias Prévias:' . $registro['antecedente_cirurgias'] . ' - '.$registro['obs_cirurgia'] ."\r\n" . "\r\n" .
    'Medicamentos em Uso:' . $registro['medicamentos_uso'] . "\r\n" . "\r\n" .
    'Hábitos de Vida :' . "\r\n" . "\r\n" .
    'Tabagismo: ' . $registro['habito_tabagismo'] . "\r\n";
if ($registro['habito_tabagismo'] == 'Sim') {
    $c_historia = $c_historia . 'Cigarros por dia :' . $registro['tabagismo_qtd_dia'] . "\r\n" .
        'Há quanto tempo (anos):' . $registro['tabagismo_tempo'] . "\r\n" . "\r\n";
}
// etilismo
$c_historia = $c_historia . 'Etilismo :' . $registro['etilismo'] . "\r\n";
if ($registro['etilismo'] == 'Sim') {
    $c_historia = $c_historia . 'Doses Semanais: ' . $registro['etilismo_frequencia'] . "\r\n" . "\r\n";
}
// atividade fisica
$c_historia = $c_historia . 'Atividade Física :' . $registro['atividade_fisica'] . "\r\n";
if ($registro['atividade_fisica'] == 'Sim') {
    $c_historia = $c_historia . 'Quais atividades Físicas :' . $registro['atividade_fisica_qual'] . "\r\n" .
        'Frequência :' . $registro['atividade_fisica_frequencia'] . "\r\n". "\r\n";
}
// Antecedentes Familiares
$c_historia = $c_historia . "Antecedentes Familiares"."\r\n"."\r\n".
'Hipertensão Arterial Sistêmica: '.$registro['familiar_hipertensao'].' - '.$registro['obs_familiar_hipertensao']."\r\n".
'Diabetes Mellitus: '.$registro['familiar_diabetes'].' - '.$registro['obs_familiar_diabetes']."\r\n".
'Doenças Cardiovasculares: '.$registro['familiar_cardiaco'].' - '.$registro['obs_familiar_cardiaco']."\r\n".
'Câncer: '.$registro['familiar_cancer'].' - '.$registro['obs_familiar_cancer']."\r\n".
'Outras Doenças: '.$registro['familiar_outros'].' - '.$registro['obs_familiar_outros']."\r\n". "\r\n";
// Interrogatório Sintomatológico (Revisão por Sistemas)
$c_historia = $c_historia . "Interrogatório Sintomatológico (Revisão por Sistemas)". "\r\n". "\r\n".
'Geral (Febre, perda de peso, fadiga): '.$registro['stm_geral']. "\r\n".
'Cabeça/Pescoço (Dor de cabeça, tontura, dor no pescoço): '.$registro['stm_cabeca_pescoso']. "\r\n".
'Ouvidos (Dor, zumbido, perda auditiva): '.$registro['stm_ouvidos']. "\r\n".
'Cardiovascular (Palpitações, dor no peito, inchaço):  '.$registro['stm_cardiovascular']. "\r\n".
'Genitourinário (Dor ao urinar, sangue na urina, incontinência): '.$registro['stm_geniturario']. "\r\n".
'Neurológico (Tontura, fraqueza, convulsões):'.$registro['stm_neurologico']. "\r\n".
'Pele (Lesões, coceira, manchas):  '.$registro['stm_pele']. "\r\n".
'Olhos (Alteração visual, dor, vermelhidão):'.$registro['stm_olhos']. "\r\n".
'Respiratório (Tosse, falta de ar, dor no peito): '.$registro['stm_respiratorio']. "\r\n".
'Gastrointestinal (Dor abdominal, náusea, vômito):  '.$registro['stm_gastro']. "\r\n".
'Musculoesquelético (Dor nas articulações, fraqueza muscular): '.$registro['stm_musculo_esqueletico']. "\r\n".
'Psiquiátrico (Ansiedade, depressão, insônia): '.$registro['stm_pisiquico']. "\r\n"."\r\n";
// Exame Físico
$c_historia = $c_historia . 'Exame Físico' ."\r\n". "\r\n".
'Pressão Arterial (mmHg): '.$registro['exame_pa']."\r\n".
'Frequência Cardíaca (bpm): '.$registro['exame_fc']."\r\n".
'Frequência Respiratória (rpm): '.$registro['exame_fr']."\r\n".
'Peso (kg): '.$registro['exame_peso']."\r\n".
'Altura (m):'.$registro['exame_altura']."\r\n".
'IMC: '.$registro['exame_imc']."\r\n".
'Ectoscopia: '.$registro['exame_ectoscopia']."\r\n".
'Aparelho Respiratório: '.$registro['exame_aparelho_respiratorio']."\r\n".
'Aparelho Cardiovascular: '.$registro['exame_aparelho_cardio']."\r\n".
'Aparelho Abdome: '.$registro['exame_abdome']."\r\n".
'Membros: '.$registro['exame_membros']."\r\n".
'Coluna Vertebral: '.$registro['exame_coluna']."\r\n".
'Exame Neurológico: '.$registro['exame_neurologico']."\r\n"."\r\n";
// Conduta e Parecer Médico
$c_historico = $c_historico . 'Conduta e Parecer Médico'."\r\n"."\r\n".
'Hipótese Diagnóstica: '.$registro['conduta_hipotese_diag']. "\r\n".
'Exames Complementares Solicitados: '.$registro['conduta_exames_compl']."\r\n".
'Conduta: '.$registro['conduta']."\r\n";
// 
$c_parecer = '';
$c_restricoes = '';
if ($registro['parecer']=='A'){
    $c_parecer = 'Apto para a funçao';
}
if ($registro['parecer']=='I'){
    $c_parecer = 'Inapto para a função';
}
if ($registro['parecer']=='R'){
    $c_parecer = 'Apto para a função com restrições';
    $c_restricoes = $registro['restricoes'];
}
$c_historia = $c_historia . 'Parecer Médico: '. $c_parecer."\r\n";
if ($c_restricoes!='R'){
   $c_historia = $c_historia . 'Restrições: '. $c_restricoes."\r\n"; 
}





// atualiza a historia
$c_sql_up = "UPDATE historia set historia='$c_historia' where id = '$i_id_historia'";

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
