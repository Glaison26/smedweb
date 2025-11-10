<?php
// 
// inicia sessao
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}
// grava dados editados do conveniado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("..\..\conexao.php");
    // recebo os dados via post
    $c_id = $_POST['up_id'];
    $c_nome = $_POST['up_nome'];
    $c_cpf = $_POST['up_cpf'];
    $c_numero = $_POST['up_numero'];
    
    // preparo sql para atualização
    $c_sql = "UPDATE clientes 
              SET nome = '$c_nome', cpf = '$c_cpf', identificacao = '$c_numero' 
              WHERE id = $c_id";
    // executo o sql
    if ($conection->query($c_sql) === TRUE) {
        $response = array("status" => "true");
    } else {
        $response = array("status" => "false");
    }
    // retorno o status em json
    echo json_encode($response);
    exit;
}
?>