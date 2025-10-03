<?php
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}
// anamnese_grava.php
// Script para gravar os dados da anamnese no banco de dados
// Inclui o arquivo de conexão com o banco de dados
include_once("../conexao.php");
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
    $c_atividades = $_POST['c_descricao_atividades'];
    // Prepara a query SQL para inserção dos dados
    $sql = "INSERT INTO anamnese (id_paciente, data, setor, cargo, data_admissao, atividade, jornada, descricao_atividades) 
            VALUES ()";
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
