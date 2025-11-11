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
// preparo sql para atualizar o registro na tabela agenda com nome, telefone, email e convenio
$c_sql_atualiza = "UPDATE agenda SET nome='" .  $_SESSION['nome'] . "', telefone='" . $_POST['telefone'] . "',
 email='" . $_POST['email'] . "', id_convenio='" . $_SESSION['id_convenio']  . "', matricula='" . $_SESSION['userId'] .
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