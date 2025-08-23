<?php // controle de acesso ao formulário
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}
// validação do id
if (!isset($_GET["id"])) {
    header('location: /smedweb/cadastros/parametros_eventos/parametros_lista.php');
    exit;
}
include("../../conexao.php");
$c_id = $_GET["id"];

// Exclusão do registro
$c_sql = "delete from parametros_eventos where id=$c_id";

$result = $conection->query($c_sql);

header('location: /smedweb/cadastros/parametros_eventos/parametros_lista.php');