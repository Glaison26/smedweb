<?php
//////////////////////////////////////////////////////////////
// rotina para chamar inclusão de pacientes atrves da agenda
//////////////////////////////////////////////////////////////
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

// conexão dom o banco de dados
include("../conexao.php");

// rotina de edição
$c_id = $_GET['id'];
$c_sql_dados = "select * from agenda where id='$c_id'";
$result = $conection->query($c_sql_dados);
$c_linha = $result->fetch_assoc();
// jogo os dados para variaveis de memória
$_SESSION['nomepac'] = $c_linha['Nome'];
$_SESSION['conveniopac'] = $c_linha['id_convenio'];
$_SESSION['telefonepac'] = $c_linha['telefone'];
$_SESSION['emailpac'] = $c_linha['email'];
$_SESSION['matriculapac'] = $c_linha['matricula'];

header('location: /smedweb/pacientes/pacientes_novo.php');
        

?>