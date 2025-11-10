<?php
// inicia sessao
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}
// rotina para gravar dados do conveniado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("..\..\conexao.php");
    // recebo os dados via post
    $c_nome = $_POST['c_nome'];
    $c_cpf = $_POST['c_cpf'];
    $c_numero = $_POST['c_numero'];
    $c_id_convenio = $_POST['c_id_convenio'];
    // preparo sql para inserção
    $c_sql = "INSERT INTO clientes (nome, cpf, identificacao, id_convenio) 
              VALUES ('$c_nome', '$c_cpf', '$c_numero', $c_id_convenio)";
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