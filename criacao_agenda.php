<?php
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

include_once "lib_gop.php";
include("conexao.php"); // conexão de banco de dados
$c_id = $_GET["id"];
// sql para pegar nome do medico
$c_sql_medico = "SELECT profissionais.nome FROM profissionais where id=$c_id";
$result_medico = $conection->query($c_sql_medico);
$c_linha_medico = $result_medico->fetch_assoc();
// inicio de rotina para geração da agenda
if ((isset($_POST["btncriacao"])) && ($_SERVER['REQUEST_METHOD'] == 'POST')) {
    $d_datainicio = $_POST['data1'];
    $d_datafim = $_POST['data2'];
    echo $d_datainicio."\n";
    echo $d_datafim;
    while (strtotime($d_datainicio) <= strtotime($d_datafim)) {
        
        // inserir na tabela de agenda
        $c_sql = "insert into agenda (id_profissional, data) value ('$c_id', '$d_datainicio')";
        $result = $conection->query($c_sql);
        $d_datainicio = date('y-m-d', strtotime("+1 days", strtotime($d_datainicio)));
    }
}
// 

?>
<!-- front end html -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smed - Sistema Médico</title>
    <link rel="shortcut icon" type="imagex/png" href="./images/smed_icon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link href="https://cdn.datatables.net/v/dt/jq-3.7.0/dt-2.0.3/datatables.min.css" rel="stylesheet">
    <link href="DataTables/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.css" />
</head>

<body>
    <div class="panel panel-primary class">
        <div class="panel-heading text-center">
            <h4>SmartMed - Sistema Médico</h4>
            <h5>Criação da Agenda do Sistema<h5>
        </div>
    </div>
    <div class="container -my5">

        <hr>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h4>Identificação do Profissional:<?php echo ' ' . $c_linha_medico['nome']; ?></h4>
            </div>
        </div>
        <form method="post">
            <br>
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">Intervalo de datas para geração da agenda</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="col-md-1 form-label">De</label>
                        <div class="col-sm-2">
                            <input type="Date" maxlength="10" class="form-control" name="data1" id="data1" value='<?php echo date("Y-m-d"); ?>' onkeypress="mascaraData(this)">
                        </div>
                        <label class="col-md-1 form-label">até</label>
                        <div class="col-sm-2">
                            <input type="Date" maxlength="10" class="form-control" name="data2" id="data2" value='<?php echo date("Y-m-d"); ?>' onkeypress="mascaraData(this)">
                        </div>
                        <button type="submit" name='btncriacao' id='btncriacao' class="btn btn-primary"><img src="\smedweb\images\configdatas.png" alt="" width="20" height="20"></span> Gerar Agenda</button>
                        <a class="btn btn-secondary" href="/smedweb/config_agenda.php"><span class="glyphicon glyphicon-arrow-left"></span> Voltar</a>
                    </div>
                </div>
            </div>
        </form>
        <div class="panel panel-info class">
            <div class="panel-heading text-left">
                <h5>Primeira data criada:</h5>
                <h5>Última data criada:</h5>

            </div>
        </div>
    </div>

</body>

</html>