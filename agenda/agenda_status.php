<?php
// rotina para alterar o status do horario da agenda
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}
// conexão dom o banco de dados
include("../conexao.php");

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
