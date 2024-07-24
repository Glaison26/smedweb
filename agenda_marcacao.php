<?php
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

// conexão dom o banco de dados
include("conexao.php");

// rotina de edição
$c_id = $_POST['c_id'];
$c_horario= $_POST['c_horario'];
$c_nome= $_POST['c_nome'];
$c_matricula = $_POST['c_matricula'];
$c_convenio= $_POST['c_convenio'];
$c_telefone= $_POST['c_telefone'];
$c_email= $_POST['c_email'];
$c_obs= $_POST['c_obs'];


// localizo na query codigo do convenio através do nome
$c_sql1 = "select convenios.id from convenios where convenios.nome='$c_convenio'";
$result = $conection->query($c_sql1);
$c_linha1 = $result->fetch_assoc();
$i_idconvenio = $c_linha1['id'];
//$i_idconvenio = 3;
// atualização do horario marcado na agenda
$c_sql = "Update agenda" .
" SET nome = '$c_nome', id_convenio = '$i_idconvenio', matricula = '$c_matricula',  telefone = '$c_telefone', email = '$c_email', observacao = '$c_obs' where id=$c_id";

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