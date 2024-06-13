<?php
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

// conexão dom o banco de dados
include("conexao.php");

// rotina de edição
$c_id = $_POST['c_id'];
$c_nome = rtrim($_POST['c_nome']);
$c_grupo = rtrim($_POST['c_grupo']);
// sql para pegar id do indice coletado
$c_sql_grupo = "select id from grupos_medicamentos where descricao = '$c_grupo'";
$result_grupo = $conection->query($c_sql_grupo);
$registro = $result_grupo->fetch_assoc();
$i_id_grupo= $registro["id"];
$c_sql = "Update medicamentos" .
" SET descricao = '$c_nome', id_grupo = '$i_id_grupo' where id=$c_id";
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