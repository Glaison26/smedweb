<?php
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

// conexão dom o banco de dados
include("../conexao.php");

// rotina de edição
$c_id = $_POST['c_id'];
$c_dia = $_POST['c_dia'];
$c_inicio1 = $_POST['c_inicio1'];
$c_fim1 = $_POST['c_fim1'];
$c_duracao1 = $_POST['c_duracao1'];
$c_inicio2 = $_POST['c_inicio2'];
$c_fim2 = $_POST['c_fim2'];
$c_duracao2 = $_POST['c_duracao2'];
$c_inicio3 = $_POST['c_inicio3'];
$c_fim3 = $_POST['c_fim3'];
$c_duracao3 = $_POST['c_duracao3'];
// sql para alterar horários editados
$c_sql = "Update  agendaconfig" .
" SET inicio1 = '$c_inicio1', inicio2 = '$c_inicio2', inicio3 = '$c_inicio3'
, fim1='$c_fim1', fim2='$c_fim2', fim3='$c_fim3', duracao1='$c_duracao1', duracao2='$c_duracao2',
 duracao3='$c_duracao3'
 where id=$c_id";

$result = $conection->query($c_sql);

if($result ==true)
{
   
    $data = array(
        'status'=>'true',
       
    );
    // gero o log da edição de configuração de agenda
    $d_data_acao = date('Y-m-d');
    // formato da data para o log
    $d_hora_acao = date('H:i:s');
    $c_data_formatada = date("d/m/Y", strtotime($d_data_acao));
    $c_descricao = "Edição da configuração de agenda para o dia " . $c_dia;
    $c_informacao = 'Início 1: '. $c_inicio1. '<br>'. 'Fim 1: '. $c_fim1. '<br>'. 'Duração 1: '. $c_duracao1. '<br>'.
    'Início 2: '. $c_inicio2. '<br>'. 'Fim 2: '. $c_fim2. '<br>'. 'Duração 2: '. $c_duracao2. '<br>'.
    'Início 3: '. $c_inicio3. '<br>'. 'Fim 3: '. $c_fim3. '<br>'. 'Duração 3: '. $c_duracao3;
    $c_sql_log = "INSERT INTO log_criacao_agenda (id_usuario, data, hora, descricao, registro)" .
    " VALUES (" . $_SESSION['c_userId'] . ", '$d_data_acao', '$d_hora_acao', '$c_descricao',
     '$c_informacao')";
    $result_log = $conection->query($c_sql_log);
   
    // fim do log

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