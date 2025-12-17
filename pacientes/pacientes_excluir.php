<?php // controle de acesso ao formulário
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

if (!isset($_GET["id"])) {
    header('location: /smedweb/pacientes/pacientes_lista.php');
    exit;
}
include("../conexao.php"); // conexão de banco de dados

$c_id = $_GET["id"];
// checo se existe algum registro de atendimento para este paciente na tabela de historia clinica
$c_sql = "select count(*) as total from historia where id_paciente=$c_id";
$result = $conection->query($c_sql);
$c_linha = $result->fetch_assoc();
if ($c_linha['total'] > 0) {
    // existe registro de atendimento para este paciente, não deixo excluir
    echo "<script>alert('Paciente possui registro de atendimento na história clínica, exclusão não permitida!!!');</script>";
    echo "<script>location.href='/smedweb/pacientes/pacientes_lista.php';</script>";
    exit;
}
// checo se existe algum registro de atendimento para este paciente na tabela de anamnese
$c_sql = "select count(*) as total from anamnese where id_paciente=$c_id";
$result = $conection->query($c_sql);
$c_linha = $result->fetch_assoc();
if ($c_linha['total'] > 0) {
    // existe registro de atendimento para este paciente, não deixo excluir
    echo "<script>alert('Paciente possui registro de atendimento na anamnese, exclusão não permitida!!!');</script>";
    echo "<script>location.href='/smedweb/pacientes/pacientes_lista.php';</script>";
    exit;
}


// Exclusão do registro
$c_sql = "delete from pacientes where id=$c_id";

$result = $conection->query($c_sql);

header('location: /smedweb/pacientes/pacientes_lista.php');