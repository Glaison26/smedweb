<?php
// executa a limpeza da lixeira da agenda
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}
include("../conexao.php");
// rotina para apagar todos os dados da lixeira da agenda
$c_sql_delete = "DELETE FROM lixeira_agenda";
$result_delete = $conection->query($c_sql_delete);
// mensagem de confirmação da limpeza e retorno para a página de configuração da agenda
echo "
<script>
alert('Lixeira da agenda limpa com sucesso!!!');
window.location.href = '/smedweb/agenda/config_agenda.php';
</script>
";
?>