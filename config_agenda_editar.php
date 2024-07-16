<?php
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

// conexão dom o banco de dados
include("conexao.php");

// rotina de edição
$c_id = $_POST['c_id'];
$c_dia = $_POST['c_dia'];
$c_inicio1 = $_POST['c_inicio1'];
$c_fim1 = $_POST['c_fim1'];
$c_duracao1 = $_POST['c_duracao1'];
$c_inicio2 = $_POST['c_inicio2'];
$c_fim2 = $_POST['c_fim2'];
$c_duracao2 = $_POST['c_duracao2'];
$c_inicio3 = $_POST['c_inicio3'];
$c_fim3 = $_POST['c_fim3'];
$c_duracao3 = $_POST['c_duracao3'];

$c_sql = "Update  agendaconfig" .
" SET inicio1 = '$c_inicio1', inicio2 = '$c_inicio2', inicio3 = '$c_inicio3' where id=$c_id";

$result = $conection->query($c_sql);

if($result ==true)
{
   
    $data = array(
        'status'=>'true',
       
    );

    echo json_encode($data);
}
else
{
     $data = array(
        'status'=>'false',
    
    );

    echo json_encode($data);
} 


?>