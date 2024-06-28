<?php // controle de acesso ao formulário
session_start();
//if (!isset($_SESSION['newsession'])) {
//    die('Acesso não autorizado!!!');
//}
//if ($_SESSION['c_tipo'] != '1') {
//    header('location: /raxx/voltamenunegado.php');
//}
include("conexao.php");
if (isset($_GET["id"])) {
    $c_id = $_GET["id"];
    $_SESSION["id_parametro"] = $c_id;
} else {
    $c_id=$_SESSION["id_parametro"];
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Smed - Sistema Médico</title>

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
                window.location.href = "/smedweb/atributo_excluir.php?id=" + id;
            }
        }
    </script>

    <script language="Javascript">
        function mensagem(msg) {
            alert(msg);
        }
    </script>


    <script>
        $(document).ready(function() {
            $('.tabatributo').DataTable({
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


    <script type="text/javascript">
        // Função javascript e ajax para inclusão dos dados

        $(document).on('submit', '#frmaddatributo', function(e) {
            e.preventDefault();
            var c_atributo = $('#addatributoField').val();
            var c_formato = $('#addformatoField').val();

            if (c_atributo != '') {

                $.ajax({
                    url: "atributos_novo.php",
                    type: "post",
                    data: {
                        c_atributo: c_atributo,
                        c_formato: c_formato
                    },
                    success: function(data) {
                        var json = JSON.parse(data);
                        var status = json.status;

                        location.reload();
                        if (status == 'true') {

                            $('#novoatributoModal').modal('hide');
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
                $('#up_atributoField').val(data[1]);
                $('#up_formatoField').val(data[2]);


            });
        });
    </script>

    <script type="text/javascript">
        ~
        // Função javascript e ajax para Alteração dos dados
        $(document).on('submit', '#frmatributo', function(e) {
            e.preventDefault();
            var c_id = $('#up_idField').val();
            var c_atributo = $('#up_atributoField').val();
            var c_formato = $('#up_formatoField').val();


            if (c_atributo != '') {

                $.ajax({
                    url: "atributos_editar.php",
                    type: "post",
                    data: {
                        c_id: c_id,
                        c_atributo: c_atributo,
                        c_formato: c_formato
                    },
                    success: function(data) {
                        var json = JSON.parse(data);
                        var status = json.status;
                        if (status == 'true') {
                            $('#editmodal').modal('hide');
                            location.reload();
                        } else {
                            alert('falha ao alterar dados');
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
            <h5>Lista de Atributos de Parâmetros de Eventos<h5>
        </div>
    </div>
    <br>
    <div class="container -my5">

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#novoatributoModal"><span class="glyphicon glyphicon-plus"></span>
            Novo
        </button>
        <a class="btn btn-secondary btn-sm" href="/smedweb/parametros_lista.php"><span class="glyphicon glyphicon-arrow-left"></span> Voltar</a>
        <hr>
        <table class="table display table-bordered tabatributo">
            <thead class="thead">
                <tr class="info">
                    <th scope="col">No.</th>
                    <th scope="col">Atributo</th>
                    <th scope="col">Formato</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php

                // faço a Leitura da tabela com sql
                $c_sql = "SELECT atributos_parametros_eventos.id, atributos_parametros_eventos.descricao, atributos_parametros_eventos.formato" .
                    " FROM atributos_parametros_eventos where atributos_parametros_eventos.id_parametro='$c_id' " .
                    " ORDER BY atributos_parametros_eventos.descricao";
                $result = $conection->query($c_sql);
                // verifico se a query foi correto
                if (!$result) {
                    die("Erro ao Executar Sql!!" . $conection->connect_error);
                }
                // insiro os registro do banco de dados na tabela 
                while ($c_linha = $result->fetch_assoc()) {

                    echo "
                    <tr>
                    <td>$c_linha[id]</td>
                    <td>$c_linha[descricao]</td>
                    <td>$c_linha[formato]</td>
                    <td>
                    <button class='btn btn-info btn-sm editbtn' data-toggle=modal' title='Editar Atributo'><span class='glyphicon glyphicon-pencil'></span></button>
                    <a class='btn btn-danger btn-sm' title='Excluir Atributo' href='javascript:func()'onclick='confirmacao($c_linha[id])'><span class='glyphicon glyphicon-trash'></span></a>
                    </td>

                    </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
    </div>


    <!-- janela Modal para inclusão de registro -->
    <div class="modal fade" id="novoatributoModal" tabindex="-1" role="dialog" aria-labelledby="novoatributoModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Dados de Novo Atributo</h4>
                </div>
                <div class="modal-body">
                    <div class='alert alert-warning' role='alert'>
                        <h5>Campos com (*) são obrigatórios</h5>
                    </div>
                    <form id="frmaddatributo" action="">
                        <div class="mb-3 row">
                            <label for="addatributoField" class="col-md-3 form-label">Descrição do Atributo (*)</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="addatributoField" name="addatributoField">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="addformatoField" class="col-md-3 form-label">Formato de Entrada de Dados</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="addformatoField" name="addformatoField" MAXLENGTH=12>
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
                    <h4 class="modal-title" id="exampleModalLabel">Editar dados do Atributo (*)</h4>
                </div>
                <div class="modal-body">
                    <div class='alert alert-warning' role='alert'>
                        <h5>Campos com (*) são obrigatórios</h5>
                    </div>
                    <form id="frmatributo" method="POST" action="">
                        <input type="hidden" id="up_idField" name="up_idField">
                        <div class="mb-3 row">
                            <label for="up_atributoField" class="col-md-3 form-label">Descrição do Atributo (*)</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="up_atributoField" name="up_atributoField">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="up_formatoField" class="col-md-3 form-label">Formato de Entrada de Dados</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="up_formatoField" name="up_formatoField">
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