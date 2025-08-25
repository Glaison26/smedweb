<?php
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

// conexão dom o banco de dados
include("conexao.php");
$c_id = $_POST['c_id'];
// rotina de edição
// formata datas
$c_data1 = $_POST['c_data1'];
$c_data1 = date("Y-m-d", strtotime(str_replace('/', '-', $c_data1)));
$c_data2 = $_POST['c_data2'];
$c_data2 = date("Y-m-d", strtotime(str_replace('/', '-', $c_data2)));
//
$c_motivo = $_POST['c_motivo'];
$c_sql = "Update datas_suprimidas" .
" SET data_inicio = '$c_data1', data_fim = '$c_data2', motivo = '$c_motivo' where id=$c_id";

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