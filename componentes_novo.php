<?php
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

// conexão dom o banco de dados
include("conexao.php");

// rotina de inclusão
$c_descricao = $_POST['c_descricao'];
$c_grupo = $_POST['c_grupo'];
$c_unidade = $_POST['c_unidade'];
// sql para pegar id do grupo coletado
$c_sql_grupo = "select id from grupo_componentes where descricao = '$c_grupo'";
$result_grupo = $conection->query($c_sql_grupo);
$registro = $result_grupo->fetch_assoc();
$i_id_grupo= $registro["id"];
// insere dados na tabela 
$c_sql = "Insert into componentes (descricao, id_grupo_componente, unidade ) Value ('$c_descricao','$i_id_grupo', '$c_unidade')";
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