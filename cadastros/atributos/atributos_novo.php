<?php
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}
// conexão dom o banco de dados
include("conexao.php");
// rotina de inclusão
$c_atributo = rtrim($_POST['c_atributo']);
$c_formato = $_POST['c_formato'];
$c_id_parametro = $_SESSION['id_parametro'];
$c_sql = "Insert into atributos_parametros_eventos (descricao, id_parametro, formato) Value ('$c_atributo', '$c_id_parametro', '$c_formato')";
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
