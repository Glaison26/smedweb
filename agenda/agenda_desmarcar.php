<?php
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

// conexão dom o banco de dados
include("../conexao.php");
date_default_timezone_set('America/Sao_Paulo');
// rotina de edição
$c_id = $_GET['id'];
// sql para capturar dados da agenda selecionada
$c_sql_dados = "select * from agenda where id='$c_id'";
$result = $conection->query($c_sql_dados);
$c_linha = $result->fetch_assoc();
// atualização do horario desmarcado na agenda
$c_sql = "Update agenda" .
" SET nome = '', id_convenio = '3', matricula = '',  telefone = '', email = '', observacao = '', 
paciente_novo='', paciente_atendido='', paciente_compareceu=''  where id=$c_id";
$result = $conection->query($c_sql);
// gero o log da desmarcação de consulta
$d_data_acao = date('Y-m-d');
// formato da data para o log
$d_hora_acao = date('H:i:s');
$c_data_formatada_agenda = date("d/m/Y", strtotime($_SESSION['data_selecionada']));
$c_descricao = "Desmarcação de consulta no dia " . $c_data_formatada_agenda;
$c_informacao = 'Consulta desmarcada no dia '. $c_data_formatada_agenda.'<br>'. 'Horário: '. $c_linha['horario']. '<br>'. 'Nome: '. $c_linha['Nome']. '<br>'. 'Convenio: '. $c_linha['id_convenio']. '<br>'. 'Matricula: '. $c_linha['matricula']. '<br>'.
'Telefone: '. $c_linha['telefone']. '<br>'. 'E-mail: '. $c_linha['email']. '<br>'. 'Observação: '. nl2br($c_linha['observacao']). '<br>'. 'Paciente Novo: '. $c_linha['paciente_novo']. '<br>'.
'Paciente Compareceu: '. $c_linha['paciente_compareceu']. '<br>'. 'Paciente Atendido: '. $c_linha['paciente_atendido'];
$c_sql_log = "INSERT INTO log_agenda (id_usuario, id_agenda, data, hora, descricao, registro)" .
" VALUES (" . $_SESSION['c_userId'] . ", $c_id, '$d_data_acao', '$d_hora_acao', '$c_descricao', '$c_informacao')";
$result_log = $conection->query($c_sql_log);
// fim do log

header('location: /smedweb/agenda/agenda.php');
        

?>