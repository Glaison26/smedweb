<?php
// pego data e medico do formulário
session_start();
require_once '../conexao.php';
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