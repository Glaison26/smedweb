<?php
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

// conexão dom o banco de dados
include("conexao.php");

// rotina de inclusão
$c_procedimento = $_POST['c_procedimento'];
$c_especialidade = $_POST['c_especialidade'];
$c_codigoamb = $_POST['c_codigoamb'];
// sql para pegar id do indice coletado
//$c_sql_epecialidade = "select id from especialidades where descricao = '$c_especialidade'";
//$result_especialidade = $conection->query($c_sql_especialidade);
//$registro = $result_especialidade->fetch_assoc();
//$i_id_especialidade=$registro["id"];
// insere dados na tabela 
$i_id_especialidade = 1;
$c_sql = "Insert into procedimentos (descricao, id_especialidade, codigoamb) Value ('$c_procedimento','$i_id_especialidade','$c_codigoamb')";
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