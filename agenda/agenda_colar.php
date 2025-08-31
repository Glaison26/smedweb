<?php
// copia dados paa as seções com os dados do paciente

session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

// conexão dom o banco de dados
include("../conexao.php");

// rotina de edição
$c_id = $_GET["id"];

$c_convenio= $_SESSION['conveniopac'];
$c_nome= $_SESSION['nomepac'];
$c_matricula = $_SESSION['matriculapac'];
$c_telefone= $_SESSION['telefonepac'];
$c_email= $_SESSION['emailpac'];
$c_observacao= $_SESSION['observacaopac'];
$c_paciente_novo= $_SESSION['paciente_novo'];   
$c_paciente_atendido= $_SESSION['paciente_atendido'];
$c_paciente_compareceu= $_SESSION['paciente_compareceu'];

// localizo na query codigo do convenio através do nome
 
$c_sql1 = "select convenios.id from convenios where convenios.id='$c_convenio'";
echo $c_sql1;
$result = $conection->query($c_sql1);
$c_linha1 = $result->fetch_assoc();
$i_idconvenio = $c_linha1['id'];

$c_sql = "Update agenda" .
" SET nome = '$c_nome', id_convenio = '$i_idconvenio', matricula = '$c_matricula',  telefone = '$c_telefone', email = '$c_email'
, observacao='$c_observacao', paciente_novo='$c_paciente_novo', paciente_compareceu='$c_paciente_compareceu', paciente_atendido='$c_paciente_atendido'
 where id=$c_id";
echo $c_sql;
$result = $conection->query($c_sql);
header('location: /smedweb/agenda/agenda.php');


