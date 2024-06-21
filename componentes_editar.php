<?php
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

// conexão dom o banco de dados
include("conexao.php");

// rotina de edição
$c_id = $_POST['c_id'];
$c_descricao = rtrim($_POST['c_descricao']);
$c_grupo = rtrim($_POST['c_grupo']);
$c_unidade = rtrim($_POST['c_unidade']);
// sql para pegar id do indice coletado
$c_sql_grupo = "select id from grupo_componentes where descricao = '$c_grupo'";
$result_grupo = $conection->query($c_sql_grupo);
$registro = $result_grupo->fetch_assoc();
$i_id_grupo= $registro["id"];
$c_sql = "Update componentes" .
" SET descricao = '$c_descricao', id_grupo_componente = '$i_id_grupo', unidade='$c_unidade' where id=$c_id";
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