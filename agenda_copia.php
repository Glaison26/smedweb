<?php
// copia dados paa as seções com os dados do paciente

session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

// conexão dom o banco de dados
include("conexao.php");

// rotina de edição
$c_id = $_GET["id"];
// sql para capturar dados do paciente selecionado
$c_sql = "SELECT pacientes.id, pacientes.id_convenio, pacientes.nome, pacientes.fone, pacientes.email, pacientes.matricula, convenios.nome as convenio,
          convenios.id as idconvenio FROM pacientes JOIN convenios ON pacientes.id_convenio=convenios.id where pacientes.id='$c_id'";
$result = $conection->query($c_sql);
$c_linha = $result->fetch_assoc();
//
$_SESSION['nomepac'] = $c_linha['nome'];
$_SESSION['conveniopac'] = $c_linha['idconvenio'];
$_SESSION['telefonepac'] = $c_linha['fone'];
$_SESSION['emailpac'] = $c_linha['email'];
$_SESSION['matriculapac'] = $c_linha['matricula'];

echo "
<script>
alert('Dados Copiados!!');
</script>
";

header('location: /smedweb/agenda.php');


