<?php
// rotina para alterar o status do horario da agenda
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}
// conexão dom o banco de dados
include("../conexao.php");
date_default_timezone_set('America/Sao_Paulo');

// rotina de edição
$c_id = $_GET["id"];
// sql para capturar dados do paciente selecionado
// primeiro verifico o status atual
$c_sql = "SELECT status FROM agenda where id='$c_id'";
$result = $conection->query($c_sql);
$c_linha = $result->fetch_assoc();
// verifico o status atual e altero para o oposto
if ($c_linha['status'] == 'SIM') {
    $novo_status = 'NÃO';
} else {
    $novo_status = 'SIM';
}
// atualização do status do horario na agenda
$c_sql = "Update agenda SET status = '$novo_status' where id=$c_id";
$result = $conection->query($c_sql);
if ($result == true) {
    // gero log de mudança de status

    $d_data_acao = date('Y-m-d');
// formato da data para o log
$d_hora_acao = date('H:i:s');
$c_data_formatada_agenda = date("d/m/Y", strtotime($_SESSION['data_selecionada']));
$c_descricao = "Mudança de Status no dia " . $c_data_formatada_agenda. ' as '. $d_hora_acao;
$c_informacao = 'Mudou para Ativo = '. $novo_status;
$c_sql_log = "INSERT INTO log_agenda (id_usuario, id_agenda, data, hora, descricao, registro)" .
" VALUES (" . $_SESSION['c_userId'] . ", $c_id, '$d_data_acao', '$d_hora_acao', '$c_descricao', '$c_informacao')";
$result_log = $conection->query($c_sql_log);
// fim do log
    echo "
    <script>
    alert('Status do horário alterado com sucesso!!');
    window.location.href = '/smedweb/agenda/agenda.php';
    </script>
    ";
    
} else {
    echo "
    <script>
    alert('Erro ao alterar status do horário!!');
    window.location.href = '/smedweb/agenda/agenda.php';
    </script>
    ";
}
?>
