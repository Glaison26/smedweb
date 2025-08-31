<?php
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

// conexão dom o banco de dados
include("../conexao.php");

// rotina de edição
$c_id = $_GET['id'];
// atualização do horario desmarcado na agenda
$c_sql = "Update agenda" .
" SET nome = '', id_convenio = '3', matricula = '',  telefone = '', email = '', observacao = '', 
paciente_novo='', paciente_atendido='', paciente_compareceu=''  where id=$c_id";

$result = $conection->query($c_sql);

header('location: /smedweb/agenda/agenda.php');
        

?>