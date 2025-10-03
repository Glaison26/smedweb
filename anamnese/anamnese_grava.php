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
    // consistencia básica dos dados
    if (empty($c_setor) || empty($c_cargo) || empty($d_data_admissao) || empty($c_atividade) || empty($c_jornada)) {
        // Redireciona de volta ao formulário com uma mensagem de erro
        $msg_erro = "Por favor, preencha todos os campos obrigatórios.";
        $_SESSION['msg_erro'] = $msg_erro;
        header("Location: anamnese_form.php?error=1");

    }
    // Prepara a query SQL para inserção dos dados
    $c_sql = "INSERT INTO anamnese (id_paciente, data, setor, funcao, admissao, atividades, jornada, descricao_atividades) 
            VALUES ('$id_paciente', '$d_data', '$c_setor', '$c_cargo', '$d_data_admissao', '$c_atividade', '$c_jornada', '$c_descricao_atividades')";
    $result = $conection->query($c_sql);
    // verifico se a query foi correto
    if ($result === TRUE) {
        // Redireciona para a página de sucesso
        header("Location: anamnese_sucesso.php");
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
