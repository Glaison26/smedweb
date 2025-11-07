<?php
// pego data e medico do formulário
session_start();
require_once '../conexao.php';
// verifico através de sql se existem agendamento com a id do paciente e data igual ou superior a data atual
$c_sql_verifica = "SELECT * FROM agenda WHERE matricula='{$_SESSION['userId']}' AND data >= CURDATE() AND (nome IS NOT null and nome <> '')";
$result_verifica = $conection->query($c_sql_verifica);
if ($result_verifica->num_rows > 0) {
    // já existe agendamento, redireciono para página de aviso
    header('Location: aviso_agendamento.php');
    exit;
}
$medico_id = $_POST['medico'];
// sql para pegar a id do médico na tabela profissionais
$c_sql_medico = "SELECT id FROM profissionais WHERE id='$medico_id'";

$data_agendamento = $_POST['data_agendamento'];
// pego a data atual
$data_hoje = date('Y-m-d');
// preparo sql para buscar horários disponíveis para o medico com data e medicos escolhidos e data superior a data do dia e nome vazio
$c_sql = "SELECT * FROM agenda WHERE id_profissional='$medico_id' AND data='$data_agendamento'
 AND (nome IS null or nome = '') ORDER BY horario";
 // executo a query
$result = $conection->query($c_sql);
// verifico se executou o sql
if (!$result) {
    die("Erro ao Executar Sql !!" . $conection->connect_error);
}
// chamo arquivo de exibição dos horários disponíveis
include 'exibe_horarios.php';




?>