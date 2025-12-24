<?php
// inicio de sessão
session_start();
// pego os dados passados por GET
//$medico_id = $_GET['medico'];
//$data_agendamento = $_GET['data_agendamento'];
$horario_id = $_SESSION['horario_id'];

// incluo conexao e links
include("..\links.php");
include("..\conexao.php");
//rotina para garvar o agendamento na tabela agenda
// verifico de data já estão agendado para outro paciente
$c_sql_vago = "SELECT * FROM agenda WHERE id='$horario_id' AND (nome IS null or nome = '')";
$result_vago = $conection->query($c_sql_vago);
if ($result_vago->num_rows == 0) {
    // horário já está agendado
    echo "<script>alert('Erro: Horário já está agendado para outro paciente!'); window.location.href='agendamento.php';</script>";
    exit;
}
// preparo sql para atualizar o registro na tabela agenda com nome, telefone, email e convenio
$c_sql_atualiza = "UPDATE agenda SET nome='" .  $_SESSION['nome'] . "', telefone='" . $_POST['telefone'] . "',
 email='" . $_POST['email'] . "', id_convenio='" . $_SESSION['id_convenio']  . "',observacao='"."Agendamento feito online". "', matricula='" . $_SESSION['userId'] .
  "', paciente_novo='" . $_POST['primeira'] . "', paciente_compareceu='Não'".",paciente_atendido='Não'".
  " WHERE id='$horario_id'";
 //echo $c_sql_atualiza;
 //die();
// executo a query
if ($conection->query($c_sql_atualiza) === TRUE) {
    // agendamento realizado com sucesso
    
    echo "<script>alert('Agendamento realizado com sucesso!'); window.location.href='agendamento.php';</script>";
} else {
    // erro ao realizar agendamento
    echo "<script>alert('Erro ao realizar agendamento: " . $conection->error . "'); window.location.href='agendamento.php';</script>";
}
// rotina para enviar email de confirmação
// incluo o arquivo de envio de email
include 'envia_email_confirmacao.php';
?>