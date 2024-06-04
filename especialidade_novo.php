<?php
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

// conexão dom o banco de dados
include("conexao.php");
// rotina de inclusão
$c_descricao = $_POST['c_descricao'];

// insere dados na tabela 
$c_sql = "Insert into especialidades (descricao) Value ('$c_descricao')";
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