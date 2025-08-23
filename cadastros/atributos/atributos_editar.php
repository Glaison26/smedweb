<?php
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

// conexão dom o banco de dados
include("conexao.php");

// rotina de edição
$c_id = $_POST['c_id'];
$c_atributo = rtrim($_POST['c_atributo']);
$c_formato = $_POST['c_formato'];

$c_sql = "Update atributos_parametros_eventos " .
    " SET descricao = '$c_atributo', formato = '$c_formato' where id=$c_id";

$result = $conection->query($c_sql);

if ($result == true) {

    $data = array(
        'status' => 'true',

    );

    echo json_encode($data);
} else {
    $data = array(
        'status' => 'false',

    );

    echo json_encode($data);
}
