<?php
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

include("conexao.php");
include_once "lib_gop.php";
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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/jquery-1.2.6.pack.js"></script>
    <script type="text/javascript" src="js/jquery.maskedinput-1.1.4.pack.js"></script>
    <script scr="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script scr="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script scr="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>
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
                    'aTargets': [9]
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
        <a class="btn btn-info" href="/smedweb/menu.php"><span class="glyphicon glyphicon-arrow-left"></span> Voltar</a>
        <hr>
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
        <!-- Formulário com as datas -->
        <form method="post">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center">Intervalo de datas para Consulta da Agenda</h5>
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
                        <button type="submit" name='btncriacao' id='btncriacao' class="btn btn-primary"><img src="\smedweb\images\buscar.png" alt="" width="20" height="20"></span> Consultar</button>

                    </div>
                </div>
            </div>
        </form>
        <br>
        <!-- abas de agenda e cadstro de pacientes -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#agenda" aria-controls="home" role="tab" data-toggle="tab">Horários da Agenda</a></li>
            <li role="presentation"><a href="#cadastro" aria-controls="cadastro" role="tab" data-toggle="tab">Cadastro de Pacientes</a></li>

        </ul>
        <!-- aba da agenda-->
        <div class="tab-content">

            <div role="tabpanel" class="tab-pane active" id="agenda">
                <div style="padding-top:20px;">
                    <!-- montagem da tabela de agenda -->
                    <table class="table display table-bordered tabagenda">
                        <thead class="thead">
                            <tr class="info">
                                <th scope="col">No.</th>
                                <th scope="col">Data</th>
                                <th scope="col">Dia</th>
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
                            while ($c_linha = $result->fetch_assoc()) {

                                echo "
                                    <tr>
                                    <td>$c_linha[id]</td>
                                    <td>$c_linha[data]</td>
                                    <td>$dia_semana</td>
                                    <td>$c_linha[horario]</td>
                                    <td>$c_linha[nome]</td>
                                    <td>$c_linha</td>

                                    <td>
                                    
                                    <a class='btn btn-info btn-sm' title='Marcação de Horários' href='/smedweb/agenda_marcar.php?id=$c_linha[id]'><span class='glyphicon glyphicon-calendar'></span></a>
                                    </td>

                                    </tr>
                                    ";
                            }
                            ?>
                        </tbody>
                    </table>

                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="cadastro">
                <div style="padding-top:20px;">
                    <p>cadastro</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>