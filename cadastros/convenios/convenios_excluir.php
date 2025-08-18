<?php // controle de acesso ao formulário
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}


if (!isset($_GET["id"])) {
    header('location: /smedweb/convenios_lista.php');
    exit;
}
include("../../conexao.php");
include("..\..\links.php");
$c_id = "";
$c_id = $_GET["id"];

// Exclusão do registro
$c_sql = "delete from convenios where id=$c_id";
// testando se existe algum registro vinculado ao convênio no cadastro de pacientes
$c_sql2 = "select * from pacientes where id_convenio=$c_id";
$result = $conection->query($c_sql2);
if ($result->num_rows > 0) {
    echo "<!doctype html>";
    echo "<html lang='en'>";
    echo "<br><br><br><br><br><br><br>";
    echo "<div class='alert alert-warning' role='warning'>";
    echo "<script>alert('Não é possível excluir o convênio, pois existem pacientes vinculados a ele!');</script>";
    echo "<div class='d-flex justify-content-center'>
    <a class='btn btn-primary' aling href='/smedweb/cadastros/convenios/convenios_lista.php'><span class='glyphicon glyphicon-off'></span> Voltar a Lista</a>
    </div></div>";
    exit;
}

try {
    $result = $conection->query($c_sql);
} catch (Exception $e) {
    echo 'Erro ao exluir registro: ',  $e->getMessage(), "\n";
}
header('location: /smedweb/convenios_lista.php');
