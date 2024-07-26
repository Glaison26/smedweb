<?php
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}
// conexão dom o banco de dados
include("conexao.php");
// rotina de inclusão
$c_horario = $_POST['c_horario'];

$c_profissional = $_POST['c_profissional'];
$c_data = $_POST['c_data'];
$c_sql = "insert into agenda (id_profissional, data, horario, id_convenio) value ('$c_profissional', '$c_data', '$c_horario', 3)";
$c_data =$c_sql;
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