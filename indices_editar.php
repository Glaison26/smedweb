<?php
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

// conexão dom o banco de dados
include("conexao.php");

// rotina de edição
$c_id = $_POST['c_id'];
$c_indice = rtrim($_POST['c_indice']);
$c_valor = $_POST['c_valor'];

$c_sql = "Update indices" .
" SET descricao = '$c_indice', valor = '$c_valor' where id=$c_id";
//" SET descricao = '$c_indice' where id=$c_id";
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