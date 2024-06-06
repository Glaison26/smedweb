<?php
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

// conexão dom o banco de dados
include("conexao.php");

// rotina de edição
$c_id = $_POST['c_id'];
$c_procedimento = $_POST['c_procedimento'];
$c_especialidade = $_POST['c_especialidade'];
$c_codigoamb = $_POST['c_codigoamb'];
// sql para pegar id do indice coletado
$c_sql_epecialidade = "select id from especialidades where descricao = '$c_especialidade'";
$result_especialidade = $conection->query($c_sql_epecialidade);
$registro = $result_especialidade->fetch_assoc();
$i_id_especialidade = $registro["id"];
$c_sql = "Update procedimentos" .
" SET descricao = '$c_procedimento', id_especialidade = '$i_id_especialidade', codigoamb = '$c_codigoamb' where id=$c_id";
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