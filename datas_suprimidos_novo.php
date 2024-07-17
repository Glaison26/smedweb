<?php
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

// conexão dom o banco de dados
include("conexao.php");
// rotina de inclusão
// formata datas
$c_data1 = $_POST['c_data1'];
$c_data1 = date("Y-m-d", strtotime(str_replace('/', '-', $c_data1)));
$c_data2 = $_POST['c_data2'];
$c_data2 = date("Y-m-d", strtotime(str_replace('/', '-', $c_data2)));
//
$c_motivo = $_POST['c_motivo'];
// insere dados na tabela 
$c_sql = "Insert into datas_suprimidas (data_inicio, data_fim, motivo) Value ('$c_data1', '$c_data2', '$c_motivo')";
$result = $conection->query($c_sql);

if($result == true)  // sql ok
{
   $data = array(
        'status'=>'true',
       
    );
    echo json_encode($data);
}
else
{  // sql com erro
     $data = array(
        'status'=>'false',
      
    );

    echo json_encode($data);
} 


?>