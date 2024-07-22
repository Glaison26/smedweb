<?php
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

include("conexao.php");
include_once "lib_gop.php";
$c_sql2 = "";
$c_dia_semana = "-";
if ((isset($_POST["btnagenda"])) && ($_SERVER['REQUEST_METHOD'] == 'POST')) {  // botão para executar sql de pesquisa na agenda
    // pego a id do profissional selecionado
    $c_profissional = $_POST['profissional'];
    $c_sql_prof = "select profissionais.id from profissionais where nome = '$c_profissional'";
    $result = $conection->query($c_sql_prof);
    $c_linha = $result->fetch_assoc();
    $i_id_profissional = $c_linha['id'];
    $d_data = $_POST['data1'];
    $d_data = date("Y-m-d", strtotime(str_replace('/', '-', $d_data)));
    
    $c_dia_semana = date('w', strtotime($d_data));
    switch ($c_dia_semana) {
        case "1":
            $c_dia_semana = 'Segunda-Feira';
            break;
        case "2":
            $c_dia_semana = 'Terça-Feira';
            break;
        case "3":
            $c_dia_semana = 'Quarta-Feira';
            break;
        case "4":
            $c_dia_semana = 'Quinta-Feira';
            break;
        case "5":
            $c_dia_semana = 'Sexta-Feira';
            break;
        case "6":
            $c_dia_semana = 'Sábado';
            break;
        case "7":
            $c_dia_semana = 'Domingo';
            break;
    }
    $c_sql2 = "SELECT agenda.id_profissional, agenda.id, agenda.id_convenio,
    agenda.`data`, agenda.dia, agenda.horario,
    agenda.nome, agenda.telefone, agenda.email, convenios.nome as convenio, agenda.observacao FROM agenda 
    JOIN convenios ON agenda.id_convenio=convenios.id
    WHERE id_profissional='$i_id_profissional' AND DATA = '$d_data' ORDER BY horario";
    $result2 = $conection->query($c_sql2);
}
?>

<!-- front end da agenda -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SmartMed - Sistema Médico</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" type="imagex/png" href="./images/smed_icon.ico">

    <script scr="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script scr="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>

</head>

<body>
    <script>
        $(document).ready(function() {
            $('.tabagenda').DataTable({
                // 
                "iDisplayLength": 6,
                "order": [1, 'asc'],
                "aoColumnDefs": [{
                    'bSortable': false,
                    'aTargets': [2]
                }, {
                    'aTargets': [0],
                    "visible": true
                }],
                "oLanguage": {
                    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    "sLengthMenu": "_MENU_ resultados por página",
                    "sInfoFiltered": " - filtrado de _MAX_ registros",
                    "oPaginate": {
                        "spagingType": "full_number",
                        "sNext": "Próximo",
                        "sPrevious": "Anterior",
                        "sFirst": "Primeiro",
                        "sLoadingRecords": "Carregando...",
                        "sProcessing": "Processando...",
                        "sZeroRecords": "Nenhum registro encontrado",

                        "sLast": "Último"
                    },
                    "sSearch": "Pesquisar",
                    "sLengthMenu": 'Mostrar <select>' +
                        '<option value="5">5</option>' +
                        '<option value="10">10</option>' +
                        '<option value="20">20</option>' +
                        '<option value="30">30</option>' +
                        '<option value="40">40</option>' +
                        '<option value="50">50</option>' +
                        '<option value="-1">Todos</option>' +
                        '</select> Registros'

                }

            });

        });
    </script>




    <div class="panel panel-primary class">
        <div class="panel-heading text-center">
            <h4>SmartMed - Sistema Médico</h4>
            <h5>Agenda Médica dos Sistema<h5>
        </div>
    </div>
    <div class="container -my5">

        <!-- Formulário com as datas -->
        <form method="post">
            <label class="col-md-2 form-label">Data da agenda</label>
            <div class="col-sm-2">
                <input type="Date" maxlength="10" class="form-control" name="data1" id="data1" value='<?php echo date("Y-m-d"); ?>' onkeypress="mascaraData(this)">
            </div>

            <button type="submit" name='btnagenda' id='btnagenda' class="btn btn-primary"><img src="\smedweb\images\buscar.png" alt="" width="20" height="20"></span> Consultar Agenda</button>
            <a class='btn btn-info' title="Voltar ao menu" href='/smedweb/menu.php'> <img src="\smedweb\images\voltar.png" alt="" width="15" height="15"> Sair da Agenda</a>

            <br>

            <div class="panel panel-Linght">
                <div class="panel-heading">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Profissional</label>
                        <div class="col-sm-6">
                            <select class="form-control form-control-lg" id="profissional" name="profissional">
                                <?php
                                $c_sql = "SELECT profissionais.id, profissionais.nome FROM profissionais
                            ORDER BY profissionais.nome";
                                $result = $conection->query($c_sql);
                                // insiro os registro do banco de dados na tabela 
                                while ($c_linha = $result->fetch_assoc()) {
                                    echo "
                                     <option>$c_linha[nome]</option>";
                                }
                                ?>
                            </select>

                        </div>
                    </div>

                </div>
            </div>
        </form>

        <!-- abas de agenda e cadstro de pacientes -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#agenda" aria-controls="home" role="tab" data-toggle="tab">Horários da Agenda</a></li>
            <li role="presentation"><a href="#cadastro" aria-controls="cadastro" role="tab" data-toggle="tab">Cadastro de Pacientes</a></li>

        </ul>
        <!-- aba da agenda-->
        <div class="tab-content">

            <div role="tabpanel" class="tab-pane active" id="agenda">
                <div style="padding-top:5px;">
                    <div class="panel panel-primary class">
                        <div class="panel-heading text-left">
                            <h4>Agenda de <?php echo $c_dia_semana; ?> na data de  <?php echo ' '. date("d-m-y", strtotime(str_replace('/', '-', $_POST['data1'])))?><h4>
                        </div>
                    </div>

                    <!-- montagem da tabela de agenda -->
                    <table class="table display  tabagenda">
                        <thead class="thead">
                            <tr class="info">
                                <th scope="col">No.</th>
                                <th scope="col">Horário</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Convênio</th>
                                <th scope="col">Telefone</th>
                                <th scope="col">e-mail</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            // loop para dados da agenda
                            if (!empty($c_sql2)) {

                                while ($c_linha2 = $result2->fetch_assoc()) {

                                    echo "
                                    <tr>
                                    <td >$c_linha2[id]</td>
                                    <td>$c_linha2[horario]</td>
                                    <td>$c_linha2[nome]</td>
                                    <td>$c_linha2[convenio]</td>
                                    <td>$c_linha2[telefone]</td>
                                    <td>$c_linha2[email]</td>
                                    <td>
                                    
                                    <a class='btn btn-info btn-sm' title='Marcação de Horários'
                                     href='/smedweb/agenda_marcar.php?id=$c_linha2[id]'>
                                     <span class='glyphicon glyphicon-calendar'></span> Marcação</a>
                                    </td>

                                    </tr>
                                    ";
                                }
                            }
                            ?>
                        </tbody>
                    </table>

                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="cadastro">
                <div style="padding-top:20px;">
                    <form id="frmpaciente" method="POST" action="">
                        <div class="mb-5 row">
                            <hr>
                            <label for="up_parametroField" class="col-md-3 form-label">Nome para pesquisar</label>

                            <div class="col-md-7">
                                <input type="text" class="form-control" id="pesquisa" name="pesquisa">

                            </div>
                            <div class="col-md-2">
                                <button type="submit" id='bntpesquisa' name='btnpesquisa' class="btn btn-primary"><img src='\smedweb\images\pesquisapessoas.png' alt='' width='20' height='20'></span> Pesquisar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>