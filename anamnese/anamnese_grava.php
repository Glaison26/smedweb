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
    if (isset($_POST['c_risco_biologico']) ) {
        $c_risco_biologico = 'S';
    } else {
        $c_risco_biologico = 'N';
    }   
    // risco ergonômico
    if (isset($_POST['c_risco_ergonomico']) ) {
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
    // pego o valor selecionado do combo box de motivo de consulta
    $c_motivo_consulta = $_POST['c_motivo_consulta'];
    // $c_outro_motivo = $_POST['c_outro_motivo
    // Valida os dados (exemplo simples, você pode adicionar mais validações)
    if (empty($c_setor) || empty($c_cargo) || empty($d_data_admissao) || empty($c_atividade) || empty($c_jornada) ) {
        $msg_erro = "Por favor, preencha todos os campos obrigatórios.";
    }
    if (strtotime($d_data_admissao) > strtotime(date('Y-m-d'))) {
        $msg_erro = "A data de admissão não pode ser no futuro.";
    }
    if  ($c_motivo_consulta == "Selecione") {
        $msg_erro = "Por favor, selecione o motivo da consulta.";
    }
    if (!empty($msg_erro)) {
        // Se houver erros, exibe a mensagem e interrompe a execução
        die($msg_erro);
    }
  
    // Prepara a query SQL para inserção dos dados
    $c_sql = "INSERT INTO anamnese (id_paciente, data, setor, funcao, admissao, atividades, jornada, descricao_atividades,
    risco_fisico, risco_quimico, risco_biologico, risco_ergonomico, risco_acidente, motivo_consulta) 
            VALUES ('$id_paciente', '$d_data', '$c_setor', '$c_cargo', '$d_data_admissao', '$c_atividade', '$c_jornada', '$c_descricao_atividades',
            '$c_risco_fisico', '$c_risco_quimico', '$c_risco_biologico', '$c_risco_ergonomico', '$c_risco_acidente', '$c_motivo_consulta')";
    echo $c_sql;
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
    header("Location: anamnese_lista.php");
    exit();
}
