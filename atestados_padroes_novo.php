<?php
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}
// conexão dom o banco de dados
include("conexao.php");
// rotina de inclusão
$c_atestado = rtrim($_POST['c_atestado']);
$c_texto = $_POST['c_texto'];
$c_sql = "Insert into atestados (descricao,texto) Value ('$c_atestado', '$c_texto')";
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