<?php
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}
// conexão dom o banco de dados
include("conexao.php");
// rotina de inclusão
$c_diagnostico = rtrim($_POST['c_diagnostico']);
$c_cid = rtrim($_POST['c_cid']);
$c_sql = "Insert into diagnosticos (descricao,cid) Value ('$c_diagnostico', '$c_cid')";
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