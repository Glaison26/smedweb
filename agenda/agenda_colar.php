<?php
// copia dados paa as seções com os dados do paciente

session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

// conexão dom o banco de dados
include("../conexao.php");
date_default_timezone_set('America/Sao_Paulo');
// rotina de edição
$c_id = $_GET["id"];

// verifica se a sessão com nome do paciente está preenchida
if (!isset($_SESSION['nomepac'])|| $_SESSION['nomepac'] == '') {
    echo "
    <script>
    alert('Nenhum dado copiado para colar!!!');
    window.location.href = '/smedweb/agenda/agenda.php';
    </script>
    ";
    exit;
}
 
$c_nome= $_SESSION['nomepac'];
$c_convenio= $_SESSION['conveniopac'];
$c_matricula = $_SESSION['matriculapac'];
$c_telefone= $_SESSION['telefonepac'];
$c_email= $_SESSION['emailpac'];
$c_observacao= $_SESSION['observacaopac'];
$c_paciente_novo= $_SESSION['paciente_novo'];   
$c_paciente_atendido= $_SESSION['paciente_atendido'];
$c_paciente_compareceu= $_SESSION['paciente_compareceu'];
// localizo na query codigo do convenio através do nome
$c_sql1 = "select convenios.id, convenios.nome from convenios where convenios.id='$c_convenio'";
//echo $c_sql1;
$result = $conection->query($c_sql1);
$c_linha1 = $result->fetch_assoc();
$i_idconvenio = $c_linha1['id'];
$c_nome_convenio = $c_linha1['nome'];
$c_sql = "Update agenda" .
" SET nome = '$c_nome', id_convenio = '$i_idconvenio', matricula = '$c_matricula',  telefone = '$c_telefone', email = '$c_email'
, observacao='$c_observacao', paciente_novo='$c_paciente_novo', paciente_compareceu='$c_paciente_compareceu', paciente_atendido='$c_paciente_atendido'
 where id=$c_id";
//echo $c_sql;
$result = $conection->query($c_sql);
// gero o log da colagem de consulta
$d_data_acao = date('Y-m-d');
// formato da data para o log
$d_hora_acao = date('H:i:s');
$c_data_formatada_agenda = date("d/m/Y", strtotime($_SESSION['data_selecionada']));
$c_descricao = "Colagem de consulta para " . $c_nome . " no dia " . $c_data_formatada_agenda;
$c_informacao = 'Consulta colada'.'<br>'. 'Nome: '. $c_nome. '<br>'. 'Convenio: '. $c_nome_convenio. '<br>'. 'Matricula: '. $c_matricula. '<br>'.
'Telefone: '. $c_telefone. '<br>'. 'E-mail: '. $c_email. '<br>'. 'Observação: '. nl2br($c_observacao). '<br>'. 'Paciente Novo: '. $c_paciente_novo. '<br>'.
'Paciente Compareceu: '. $c_paciente_compareceu. '<br>'. 'Paciente Atendido: '. $c_paciente_atendido;
$c_sql_log = "INSERT INTO log_agenda (id_usuario, id_agenda, data, hora, descricao, registro)" .
" VALUES (" . $_SESSION['c_userId'] . ", $c_id, '$d_data_acao', '$d_hora_acao', '$c_descricao', '$c_informacao')";
$result_log = $conection->query($c_sql_log);
// fim do log
header('location: /smedweb/agenda/agenda.php');


