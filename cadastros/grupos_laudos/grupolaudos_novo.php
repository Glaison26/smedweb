<?php
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}
// conexão dom o banco de dados
include("../../conexao.php");
// rotina de inclusão
$c_grupo = rtrim($_POST['c_grupo']);
$c_sql = "Insert into grupos_laudos (descricao) Value ('$c_grupo')";
$result = $conection->query($c_sql);

if($result ==true)
{
    // Verifica se a inserção foi bem-sucedida
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