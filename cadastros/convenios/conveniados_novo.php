<?php
// inicia sessao
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}
include("..\..\conexao.php");
include("..\..\lib_gop.php");
// rotina para gravar dados do conveniado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // recebo os dados via post
    $c_nome = $_POST['c_nome'];
    $c_cpf = $_POST['c_cpf'];
    if (validaCPF($c_cpf) == false) {
        $response = array("status" => "invalid_cpf");
        echo json_encode($response);
        exit;
    }

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
