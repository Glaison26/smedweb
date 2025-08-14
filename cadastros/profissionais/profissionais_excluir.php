<?php // controle de acesso ao formulário
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

if (!isset($_GET["id"])) {
    header('location: /smedweb/cadastros/profissionais/profissionais_lista.php');
    exit;
}
include("..\..\conexao.php");
include("..\..\links.php");
$c_id = "";
$c_id = $_GET["id"];
// testo se existe agenda vinculada ao profissional
$c_sql = "select * from agenda where id_profissional=$c_id";
$result = $conection->query($c_sql);
if ($result->num_rows > 0) {
    echo "<!doctype html>";
    echo "<html lang='en'>";
    echo "<br><br><br><br><br><br><br>";
    echo "<div class='alert alert-warning' role='warning'>";
    echo "<script>alert('Não é possível excluir o profissional, pois existe agenda vinculada a ele!');</script>";
    echo "<div class='d-flex justify-content-center'>
    <a class='btn btn-primary' aling href='/smedweb/cadastros/profissionais/profissionais_lista.php'><span class='glyphicon glyphicon-off'></span> Voltar a Lista</a>
    </div></div>";
} else {
    // Exclusão do registro
    $c_sql = "delete from profissionais where id=$c_id";
    try {
        $result = $conection->query($c_sql);
    } catch (Exception $e) {
        echo 'Erro ao exluir registro: ',  $e->getMessage(), "\n";
    }
    header('location: /smedweb/cadastros/profissionais/profissionais_lista.php');
}
