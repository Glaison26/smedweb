<?php // controle de acesso ao formulário
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

if (!isset($_GET["id"])) {
    header('location: /smedweb/cadastros/diagnosticos/diagnosticos_lista.php');
    exit;
}
include("../../conexao.php");
$c_id = $_GET["id"];

// Exclusão do registro
$c_sql = "delete from diagnosticos where id=$c_id";
$result = $conection->query($c_sql);
header('location: /smedweb/cadastros/diagnosticos/diagnosticos_lista.php');