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

    while (strtotime($d_datainicio) <= strtotime($d_datafim)) {

        // loop para inserir os horários configurados na data
        // pego dia da semana via sql
        $dia_semana = date('w', strtotime($d_datainicio));  // pego dia da semana 0=domi 1=seg 2=ter 3=qua 4=qui 5=sex 6=sab
        $dia_semana = $dia_semana;
        $c_sql_horario = "select * from agendaconfig where id_profissional='$c_id' and dia='$dia_semana'";
       
        $result = $conection->query($c_sql_horario);
        $result_dias = $result->fetch_assoc();
        // loop para periodo da manhã
        $inicio_manha = $result_dias['inicio1'];
        $inicio_tarde = $result_dias['inicio2'];
        $inicio_noite = $result_dias['inicio2'];
        $fim_manha = $result_dias['fim1'];
        $fim_tarde = $result_dias['fim2'];
        $fim_noite = $result_dias['fim3'];
        $duracao_manha = $result_dias['duracao1'];
        $duracao_tarde = $result_dias['duracao2'];
        $duracao_noite = $result_dias['duracao3'];
        $minuto_soma = "00:".$duracao_manha;
        // geração do turno da manhã
        while (strtotime($inicio_manha) <= strtotime($fim_manha)) {  // loop de icremento de hora do turno da manhã
            // inserir dados na tabela de agenda
            $c_sql = "insert into agenda (id_profissional, data, horario, dia) value ('$c_id', '$d_datainicio', '$inicio_manha','$dia_semana')";
            $result = $conection->query($c_sql);
            $inicio_manha = gmdate('H:i:s', strtotime($inicio_manha) + strtotime($minuto_soma) );
        }
        // geração do turno da tarde
        $minuto_soma = "00:".$duracao_tarde;
        while (strtotime($inicio_tarde) <= strtotime($fim_tarde)) {  // loop de icremento de hora do turno da manhã
            // inserir dados na tabela de agenda
            $c_sql = "insert into agenda (id_profissional, data, horario,  dia) value ('$c_id', '$d_datainicio', '$inicio_tarde','$dia_semana')";
            $result = $conection->query($c_sql);
            $inicio_tarde = gmdate('H:i:s', strtotime($inicio_tarde) + strtotime($minuto_soma) );
        }
         // geração do turno da noite
         $minuto_soma = "00:".$duracao_noite;
         while (strtotime($inicio_noite) <= strtotime($fim_noite)) {  // loop de icremento de hora do turno da manhã
            // inserir dados na tabela de agenda
            $c_sql = "insert into agenda (id_profissional, data, horario,  dia) value ('$c_id', '$d_datainicio', '$inicio_noite','$dia_semana')";
            $result = $conection->query($c_sql);
            $inicio_noite = gmdate('H:i:s', strtotime($inicio_noite) + strtotime($minuto_soma) );
        }
        // incremento data 
        $d_datainicio = date('y-m-d', strtotime("+1 days", strtotime($d_datainicio))); // incremento 1 dia a data do loop
     
    }
    echo "
        <script>
          alert('Geração da agenda realizada com sucesso!!!')
        </script>
    ";
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