<?php
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

include_once "lib_gop.php";
include("conexao.php"); // conexão de banco de dados
$c_id = $_GET["id"]; // pego a id do paciente
// sql para pegar dados do paciente selecionado
$c_sql = "select pacientes.id, pacientes.nome from pacientes where pacientes.id='$c_id'";
$result = $conection->query($c_sql);
// verifico se a query foi correto
if (!$result) {
    die("Erro ao Executar Sql!!" . $conection->connect_error);
}
$c_linha = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smartmed - sistema Médico</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smed - Sistema Médico</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" type="imagex/png" href="./images/smed_icon.ico">
</head>

<body>
    <script scr="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script scr="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>

    <script>
        $(document).ready(function() {
            $('.tabpacientes').DataTable({
                // 
                "iDisplayLength": -1,
                "order": [1, 'asc'],
                "aoColumnDefs": [{
                    'bSortable': false,
                    'aTargets': [2]
                }, {
                    'aTargets': [0],
                    "visible": false
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
            <h5>Emissão de atestado Médico<h5>
        </div>
    </div>

    <div class="container -my5">
        <a class="btn btn-light" href="#"><img src='\smedweb\images\printer.png' alt='' width='20' height='20'> Emitir Atestado</a>
        <a class="btn btn-light" href="/smedweb/prescricao.php"><img src='\smedweb\images\voltar.png' alt='' width='20' height='20'> Voltar</a>
        <hr>
        <div class="panel panel-success">
            <div class="panel-heading">
                <h4>Identificação do Paciente:<?php echo ' ' . $c_linha['nome']; ?></h4>
            </div>
        </div>
        <!-- Formulário com os profissionais para seleção -->
        <form method="post">

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
                                    $c_op = "";
                                    if ($c_linha['nome'] == $c_profissional) {
                                        $c_op = "selected";
                                    }
                                    echo "
                                     <option $c_op>$c_linha[nome]</option>";
                                }
                                ?>
                            </select>

                        </div>
                    </div>

                </div>
            </div>
        </form>
        <!-- fim do formulário de profissionais -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#atestado" aria-controls="home" role="tab" data-toggle="tab">Editar Atestado</a></li>
            <li role="presentation"><a href="#modelos" aria-controls="modelos" role="tab" data-toggle="tab">Modelos de Atestados</a></li>

        </ul>
        <!-- paginas de edição e modelos de atestados -->
        <div class="tab-content">
            <!-- aba de edição do atestado -->
            <div role="tabpanel" class="tab-pane active" id="atestado">
                <div style="padding-top:5px;">
                    <p>
                        teste 1
                    </p>
                </div>
            </div>
            <!-- aba de modelos de atestados -->
            <div role="tabpanel" class="tab-pane" id="modelos">
                <div style="padding-top:5px;">
                    <p>
                        teste 2
                    </p>
                </div>
            </div>
        </div>
    </div>


</body>

</html>