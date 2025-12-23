<?php
// copia dados paa as seções com os dados do paciente

session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

// conexão dom o banco de dados
include("../conexao.php");

// rotina de edição
$c_id = $_GET["id"];
// sql para capturar dados do paciente selecionado
$c_sql = "SELECT pacientes.id, pacientes.id_convenio, pacientes.nome, pacientes.fone, pacientes.email, pacientes.matricula, convenios.nome as convenio,
          convenios.id as idconvenio
          FROM pacientes JOIN convenios ON pacientes.id_convenio=convenios.id where pacientes.id='$c_id'";
$result = $conection->query($c_sql);
$c_linha = $result->fetch_assoc();
//
$_SESSION['nomepac'] = $c_linha['nome'];
$_SESSION['conveniopac'] = $c_linha['idconvenio'];
$_SESSION['telefonepac'] = $c_linha['fone'];
$_SESSION['emailpac'] = $c_linha['email'];
$_SESSION['matriculapac'] = $c_linha['matricula'];
$_SESSION['paciente_novo'] = 'Não';
$_SESSION['paciente_atendido'] = 'Não';
$_SESSION['paciente_compareceu'] = 'Não';
// mensagem de dados copiados
// gero log da cópia dos dados
$d_data_acao = date('Y-m-d');
$d_hora_acao = date('H:i:s');
$c_descricao = "Cópia dos dados do paciente " . $c_linha['nome'] . " para marcação de consulta.";
$c_sql_log = "INSERT INTO log_agenda (id_usuario, id_agenda, data, hora, descricao)" .
" VALUES (" . $_SESSION['c_userId'] . ", 1, '$d_data_acao', '$d_hora_acao', '$c_descricao')";
$result_log = $conection->query($c_sql_log);

echo "
<script>
alert('Dados Copiados!!');
</script>
";

header('location: /smedweb/agenda/agenda.php');


