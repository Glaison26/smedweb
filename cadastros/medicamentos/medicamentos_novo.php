<?php
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}
if (!isset($_POST["c_nome"]) || !isset($_POST["c_grupo"])) {
    header('location: /smedweb/cadastros/medicamentos/medicamentos_lista.php');
    exit;
}
// conexão dom o banco de dados
include("../../conexao.php");

// rotina de inclusão
$c_nome = $_POST['c_nome'];
$c_grupo = $_POST['c_grupo'];
// sql para pegar id do grupo coletado
$c_sql_grupo = "select id from grupos_medicamentos where descricao = '$c_grupo'";
$result_grupo = $conection->query($c_sql_grupo);
$registro = $result_grupo->fetch_assoc();
$i_id_grupo= $registro["id"];
// insere dados na tabela 
$c_sql = "Insert into medicamentos (descricao, id_grupo) Value ('$c_nome','$i_id_grupo')";
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