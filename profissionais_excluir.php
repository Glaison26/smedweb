<?php // controle de acesso ao formulário
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

if (!isset($_GET["id"])) {
    header('location: /smedweb/profissionais_lista.php');
    exit;
}
include("conexao.php");
$c_id = "";
$c_id = $_GET["id"];

// Exclusão do registro
$c_sql = "delete from profissionais where id=$c_id";

try {
    $result = $conection->query($c_sql);
} catch (Exception $e) {
    echo 'Erro ao exluir registro: ',  $e->getMessage(), "\n";
}
header('location: /smedweb/profissionais_lista.php');
