<?php // controle de acesso ao formulário
session_start();
//if (!isset($_SESSION['newsession'])) {
//    die('Acesso não autorizado!!!');
//}
//if ($_SESSION['c_tipo'] != '1') {
//    header('location: /raxx/voltamenunegado.php');
//}
include("conexao.php");
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    <script scr="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script scr="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>



    <script language="Javascript">
        function confirmacao(id) {
            var resposta = confirm("Deseja remover esse registro?");
            if (resposta == true) {
                window.location.href = "/smedweb/datas_suprimidos_excluir.php?id=" + id;
            }
        }
    </script>

    <script language="Javascript">
        function mensagem(msg) {
            alert(msg);
        }
    </script>




    <script type="text/javascript">
        // Função javascript e ajax para inclusão dos dados
        $(document).on('submit', '#frmadd', function(e) {
            e.preventDefault();
            var c_data1 = $('#add_data1Field').val();
            var c_data2 = $('#add_data2Field').val();
            var c_motivo = $('#add_motivoField').val();

            if (c_motivo != '' && c_data1 != '' && c_data2 != '') {

                $.ajax({
                    url: "datas_suprimidos_novo.php",
                    type: "post",
                    data: {
                        c_data1: c_data1,
                        c_data2: c_data2,
                        c_motivo: c_motivo
                    },
                    success: function(data) {
                        var json = JSON.parse(data);
                        var status = json.status;

                        location.reload();
                        if (status == 'true') {

                            $('#novaModal').modal('hide');
                            location.reload();
                        } else {
                            alert('falha ao incluir dados');
                        }
                    }
                });
            } else {
                alert('Preencha todos os campos obrigatórios');
            }
        });
    </script>

    <!-- Coleta dados da tabela para edição do registro -->
    <script>
        $(document).ready(function() {

            $('.editbtn').on('click', function() {

                $('#editmodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#up_idField').val(data[0]);
                $('#up_data1Field').val(data[3]);
                $('#up_data2Field').val(data[4]);
                $('#up_motivoField').val(data[2]);

            });
        });
    </script>

    <script type="text/javascript">
        // Função javascript e ajax para Alteração dos dados xxx
        $(document).on('submit', '#frmup', function(e) {
            e.preventDefault();
            var c_id = $('#up_idField').val();
            var c_data1 = $('#up_data1Field').val();
            var c_data2 = $('#up_data2Field').val();
            var c_motivo = $('#up_motivoField').val();

            if (c_motivo != '' && c_data1 != '' && c_data2 != '') {

                $.ajax({
                    url: "datas_suprimidos_editar.php",
                    type: "post",
                    data: {
                        c_id: c_id,
                        c_data1: c_data1,
                        c_data2: c_data2,
                        c_motivo: c_motivo
                    },
                    success: function(data) {
                        var json = JSON.parse(data);
                        var status = json.status;

                        if (status == 'true') {
                            $('#editmodal').modal('hide');
                            location.reload();
                        } else {
                            alert('falha ao incluir dados');
                        }
                    }
                });

            } else {
                alert('Todos os campos devem ser preenchidos!!');
            }
        });
    </script>


    <div class="panel panel-primary class">
        <div class="panel-heading text-center">
            <h4>SmartMed - Sistema Médico</h4>
            <h5>Lista de Datas Suprimidas da Agenda do Sistema<h5>
        </div>
    </div>
    <br>
    <div class="container -my5">
        <!-- A Botão trigger modal -->
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#novaModal"><span class="glyphicon glyphicon-plus"></span>
            Novo
        </button>
        <a class="btn btn-secondary btn-sm" href="/smedweb/config_agenda.php"><span class="glyphicon glyphicon-arrow-left"></span> Voltar</a>
        <hr>
        <table class="table display table-bordered tabsuprimidas">
            <thead class="thead">
                <tr class="info">
                    <th style='display:none' scope="col">No.</th>
                    <th scope="col">Período</th>
                    <th scope="col">Motivo</th>
                    <th style='display:none' scope="col">Inicio</th>
                    <th style='display:none' scope="col">Fim</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // faço a Leitura da tabela com sql
                $c_sql = "SELECT * FROM datas_suprimidas ORDER BY datas_suprimidas.data_inicio";
                $result = $conection->query($c_sql);
                // verifico  se a query foi correto
                if (!$result) {
                    die("Erro ao Executar Sql!!" . $conection->connect_error);
                }
                // insiro os registro do banco de dados na tabela 
                while ($c_linha = $result->fetch_assoc()) {
                    $c_dataini =  DateTime::createFromFormat('Y-m-d', $c_linha['data_inicio']);
                    $c_dataini = $c_dataini->format('d/m/Y');
                    $c_datafim =  DateTime::createFromFormat('Y-m-d', $c_linha['data_fim']);
                    $c_datafim = $c_datafim->format('d/m/Y');
                    $c_periodo = 'De ' . $c_dataini . ' a ' . $c_datafim;
                    echo  "
                    <tr>
                    <td style='display:none'>$c_linha[id]</td>
                    <td>$c_periodo</td>
                    <td>$c_linha[motivo]</td>
                    <td style='display:none'>$c_linha[data_inicio]</td>
                    <td style='display:none'>$c_linha[data_fim]</td>
                    <td>
                    <button class='btn btn-info btn-sm editbtn' data-toggle=modal' title='Editar Data Suprimida'><span class='glyphicon glyphicon-pencil'></span></button>
                    <a class='btn btn-danger btn-sm' title='Excluir Data Suprimida' href='javascript:func()'onclick='confirmacao($c_linha[id])'><span class='glyphicon glyphicon-trash'></span></a>
                    </td>

                    </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
    </div>


    <!-- janela Modal para inclusão de registro -->
    <div class="modal fade" id="novaModal" tabindex="-1" role="dialog" aria-labelledby="novaModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Período a ser suprimido</h4>
                </div>
                <div class="modal-body">
                    <div class='alert alert-warning' role='alert'>
                        <h5>Campos com (*) são obrigatórios</h5>
                    </div>
                    <form id="frmadd" action="">
                        <div class="mb-3 row">
                            <label for="add_data1Field" class="col-md-3 form-label">Data Inicio (*)</label>
                            <div class="col-md-4">
                                <input type="date" class="form-control" id="add_data1Field" name="add_data1Field">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="add_data2Field" class="col-md-3 form-label">Data Fim (*)</label>
                            <div class="col-md-4">
                                <input type="date" class="form-control" id="add_data2Field" name="add_data2Field">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="add_motivoField" class="col-md-3 form-label">Motivo (*)</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="add_motivoField" name="add_motivoField">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><span class='glyphicon glyphicon-floppy-saved'></span> Salvar</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class='glyphicon glyphicon-remove'></span> Fechar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal para edição dos dados -->
    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="editmodal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Editar Período a ser suprimido</h4>
                </div>
                <div class="modal-body">
                    <div class='alert alert-warning' role='alert'>
                        <h5>Campos com (*) são obrigatórios</h5>
                    </div>
                    <form id="frmup" action="">
                        <input type="hidden" id="up_idField" name="up_idField">
                        <div class="mb-3 row">
                            <label for="up_data1Field" class="col-md-3 form-label">Data Inicio (*)</label>
                            <div class="col-md-4">
                                <input type="date" class="form-control" id="up_data1Field" name="up_data1Field">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="up_data2Field" class="col-md-3 form-label">Data Fim (*)</label>
                            <div class="col-md-4">
                                <input type="date" class="form-control" id="up_data2Field" name="up_data2Field">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="up_motivoField" class="col-md-3 form-label">Motivo (*)</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="up_motivoField" name="up_motivoField">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><span class='glyphicon glyphicon-floppy-saved'></span> Salvar</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class='glyphicon glyphicon-remove'></span> Fechar</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>



</body>



</html>