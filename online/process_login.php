<?php
// rotina para consistencia de dados de login no sistema online
// Sessão
session_start();
// Conexão
require_once '../conexao.php';
// verifico se existe identificação e cpf digitados no formulário na tabela clientes  
if (isset($_POST['userId']) && isset($_POST['cpf'])) {
    $userId = $_POST['userId'];
    $cpf = $_POST['cpf'];

    // preparo sql para consulta
    $c_sql = "SELECT * FROM clientes WHERE id='$userId' AND cpf='$cpf'";
    $result = $conection->query($c_sql);
    $registro = $result->fetch_assoc();

    // verifico se encontrou o registro
    if ($registro) {
        // dados corretos, inicio sessão e redireciono para área de agendamento
        $_SESSION['userId'] = $registro['id'];
        $_SESSION['nome'] = $registro['nome'];
        header('Location: agendamento.php');
        exit;
    } else {
        // dados incorretos, redireciono de volta para o formulário com mensagem de erro
        header('Location: index.php?error=1');
        exit;
    }
}

?>