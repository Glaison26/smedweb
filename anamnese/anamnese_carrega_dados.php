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
