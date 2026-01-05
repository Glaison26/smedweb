<?php
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

// conexão dom o banco de dados
include("../conexao.php");
date_default_timezone_set('America/Sao_Paulo');

// rotina de edição
$c_id = $_POST['c_id'];
$c_horario= $_POST['c_horario'];
$c_nome= $_POST['c_nome'];
$c_matricula = $_POST['c_matricula'];
$c_convenio= $_POST['c_convenio'];
$c_telefone= $_POST['c_telefone'];
$c_email= $_POST['c_email'];
$c_obs= $_POST['c_obs'];
$c_compareceu= $_POST['c_compareceu'];
$c_novopaciente= $_POST['c_novopaciente'];   
$c_atendido= $_POST['c_atendido'];
// sql para verifica se o horario já está marcado
$c_sql_verifica = "select * from agenda where id='$c_id' and nome<>'' and matricula<> '$c_matricula' and nome<> '$c_nome'";
$result_verifica = $conection->query($c_sql_verifica);
if ($result_verifica->num_rows > 0) {
    $data = array(
        'status' => 'jaexiste',
    );
    echo json_encode($data);
    exit;
}
// localizo na query codigo do convenio através do nome
$c_sql1 = "select convenios.id from convenios where convenios.nome='$c_convenio'";
$result = $conection->query($c_sql1);
$c_linha1 = $result->fetch_assoc();
$i_idconvenio = $c_linha1['id'];
//$i_idconvenio = 3;
// atualização do horario marcado na agenda
$c_sql = "Update agenda" .
" SET nome = '$c_nome', id_convenio = '$i_idconvenio', matricula = '$c_matricula',  telefone = '$c_telefone',
email = '$c_email', observacao = '$c_obs', paciente_compareceu='$c_compareceu', 
paciente_atendido='$c_atendido', paciente_novo='$c_novopaciente' where id=$c_id";

$result = $conection->query($c_sql);

if($result ==true)
{
   
    $data = array(
        'status'=>'true',
       
    );
    // gero o log da marcação ou edição de consulta
    $d_data_acao = date('Y-m-d');
    // formato da data para o log
    $d_hora_acao = date('H:i:s');
    $c_data_formatada = date("d/m/Y", strtotime($d_data_acao));
    $c_data_formatada_agenda = date("d/m/Y", strtotime($_SESSION['data_selecionada']));
    $c_informacao = $c_nome. '<br>'. 'Convenio: '. $c_convenio. '<br>'. 'Matricula: '. $c_matricula. '<br>'. 'Telefone: '. $c_telefone.
     '<br>'. 'E-mail: '. $c_email. '<br>'. 'Observação: '. nl2br($c_obs). '<br>'. 'Paciente Novo: '. $c_novopaciente. '<br>'. 
     'Paciente Compareceu: '. $c_compareceu. '<br>'. 'Paciente Atendido: '. $c_atendido;
    $c_descricao = "Marcação/edição de consulta para " . $c_nome . " no dia " . $c_data_formatada_agenda . 
    " às " . $c_horario;     
    $c_sql_log = "INSERT INTO log_agenda (id_usuario, id_agenda, data, hora, descricao, registro)" .
    " VALUES (" . $_SESSION['c_userId'] . ", $c_id, '$d_data_acao', '$d_hora_acao', '$c_descricao', '$c_informacao')";
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