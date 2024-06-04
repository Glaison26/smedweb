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
$c_tabela = rtrim($_POST['c_tabela']);
// sql para pegar id do indice coletado
$c_sql_indice = "select id from indices where descricao = '$c_indice'";
$result_indice = $conection->query($c_sql_indice);
$registro = $result_indice->fetch_assoc();
$i_id_indice= $registro["id"];
$c_sql = "Update tabela" .
" SET descricao = '$c_tabela', id_indice = '$i_id_indice' where id=$c_id";
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