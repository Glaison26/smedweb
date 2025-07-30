<?php
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

// conexão dom o banco de dados
include("conexao.php");

// rotina de edição
$c_id = $_GET['id'];
$c_sql_dados = "select * from agenda where id='$c_id'";
$result = $conection->query($c_sql_dados);
$c_linha = $result->fetch_assoc();
if ($c_linha['nome']=='') {
    echo "
    <script>
    alert('Não existem dados para serem recortador!!!')
    </script>";
    header('location: /smedweb/agenda.php');
}
// jogo os dados para variaveis de memória
$_SESSION['nomepac'] = $c_linha['Nome'];
$_SESSION['conveniopac'] = $c_linha['id_convenio'];
$_SESSION['telefonepac'] = $c_linha['telefone'];
$_SESSION['emailpac'] = $c_linha['email'];
$_SESSION['matriculapac'] = $c_linha['matricula'];

// atualização do horario desmarcado na agenda
$c_sql = "Update agenda" .
" SET nome = '', id_convenio = '3', matricula = '',  telefone = '', email = '', observacao = '' where id=$c_id";
echo $_SESSION['nomepac'];
$result = $conection->query($c_sql);

header('location: /smedweb/agenda.php');
        

?>