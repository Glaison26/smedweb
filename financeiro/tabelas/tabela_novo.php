<?php
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

// conexão dom o banco de dados
include("../../conexao.php");

// rotina de inclusão
$c_indice = $_POST['c_indice'];
$c_tabela = $_POST['c_tabela'];
// sql para pegar id do indice coletado
$c_sql_indice = "select id from indices where descricao = '$c_indice'";
$result_indice = $conection->query($c_sql_indice);
$registro = $result_indice->fetch_assoc();
$i_id_indice= $registro["id"];
// insere dados na tabela 
$c_sql = "Insert into tabela (descricao, id_indice) Value ('$c_tabela','$i_id_indice')";
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