<?php
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}
date_default_timezone_set('America/Sao_Paulo');
// conexão dom o banco de dados
include("../conexao.php");
// rotina de edição
$c_id = $_GET['id'];
$c_sql_dados = "select * from agenda where id='$c_id'";
$result = $conection->query($c_sql_dados);
$c_linha = $result->fetch_assoc();
if ($c_linha['nome']=='') {
    echo "
    <script>
    alert('Não existem dados para serem recortados!!!')
    </script>";
    header('location: /smedweb/agenda/agenda.php');
}
// jogo os dados para variaveis de memória
$_SESSION['nomepac'] = $c_linha['Nome'];
$_SESSION['conveniopac'] = $c_linha['id_convenio'];
$_SESSION['telefonepac'] = $c_linha['telefone'];
$_SESSION['emailpac'] = $c_linha['email'];
$_SESSION['matriculapac'] = $c_linha['matricula'];
$_SESSION['observacaopac'] = $c_linha['observacao'];
$_SESSION['paciente_novo'] = $c_linha['paciente_novo'];
$_SESSION['paciente_atendido'] = $c_linha['paciente_atendido'];
$_SESSION['paciente_compareceu'] = $c_linha['paciente_compareceu'];
// atualização do horario desmarcado na agenda
$c_sql = "Update agenda" .
" SET nome = '', id_convenio = '3', matricula = '',  telefone = '', email = '', observacao = '', 
paciente_novo='', paciente_atendido='', paciente_compareceu='' where id=$c_id";
//echo $_SESSION['nomepac'];
$result = $conection->query($c_sql);
// sql para capturar nome do convenio
$c_sql_convenio = "select convenios.nome from convenios where convenios.id='" . $_SESSION['conveniopac'] . "'";
$result_convenio = $conection->query($c_sql_convenio);
$c_linha_convenio = $result_convenio->fetch_assoc();
$c_nome_convenio = $c_linha_convenio['nome'];
// gero o log do recorte de consulta
$d_data_acao = date('Y-m-d');
// formato da data para o log
$d_hora_acao = date('H:i:s');
$c_data_formatada_agenda = date("d/m/Y", strtotime($_SESSION['data_selecionada']));
$c_descricao = "Recorte de consulta para " . $_SESSION['nomepac'] . " no dia " . $c_data_formatada_agenda .
" às " . $c_linha['horario'];
$c_informacao = 'Nome: '. $_SESSION['nomepac']. '<br>'. 'Convenio: '. $c_nome_convenio. '<br>'. 'Matricula: '. $_SESSION['matriculapac']. '<br>'.
'Telefone: '. $_SESSION['telefonepac']. '<br>'. 'E-mail: '. $_SESSION['emailpac']. '<br>'. 'Observação: '. nl2br($_SESSION['observacaopac']). '<br>'. 'Paciente Novo: '. $_SESSION['paciente_novo']. '<br>'.
'Paciente Compareceu: '. $_SESSION['paciente_compareceu']. '<br>'. 'Paciente Atendido: '. $_SESSION['paciente_atendido'];
$c_sql_log = "INSERT INTO log_agenda (id_usuario, id_agenda, data, hora, descricao, registro)" .
" VALUES (" . $_SESSION['c_userId'] . ", $c_id, '$d_data_acao', '$d_hora_acao', '$c_descricao', '$c_informacao')";
$result_log = $conection->query($c_sql_log);
// fim do log

header('location: /smedweb/agenda/agenda.php');
        

?>