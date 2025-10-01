<?php
// Sessão
session_start();
// Conexão
require_once '../conexao.php';
// require com link.php
require_once '../links.php';
// pego o id do paciente
$idpaciente = $_GET['idpaciente'];
// monto a query para pegar dados da anamnese
$c_sql = "SELECT * FROM anamnese WHERE id_paciente = $idpaciente";
$result = $conection->query($c_sql);
if (!$result) {
    die("Erro ao Executar Sql !!" . $conection->connect_error);
}

// pego o nome do paciente
$c_sql2 = "SELECT nome FROM pacientes WHERE id = $idpaciente";
$result2 = $conection->query($c_sql2);
if (!$result2) {
    die("Erro ao Executar Sql !!" . $conection->connect_error);
}
$c_linha2 = $result2->fetch_assoc();
$nomepaciente = $c_linha2['nome'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<!--  html para tabela com anamneses do paciente  -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
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
            <h5>Anamnese Clínica do Paciente<h5>
        </div>
    </div>
    <div class="container -my5">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h4>Identificação do Paciente:<?php echo ' ' . $nomepaciente; ?></h4>
            </div>
        </div>
        <hr>
         <a class="btn btn-success" href="/smedweb/anamnese/anamnese_nova.php"><span class="glyphicon glyphicon-plus"></span> Nova Anamnese</a>
         <a class="btn btn-secondary" href="/smedweb/pacientes/pacientes_lista.php"><span class="glyphicon glyphicon-arrow-left"></span> Voltar</a>
         <hr>
        <!-- tabela com as anamneses do paciente selecionado -->
        <table class="table table-striped table-bordered tabpacientes">
            <thead>
                <tr>

                    <th>Data da Anamnese</th>
                    <th>Motivo da Consulta</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($c_linha = $result->fetch_assoc()) {
                    if ($c_linha['motivo_consulta'] == '1') {
                        $c_motivo = 'Admissional';
                    } elseif ($c_linha['motivo_consulta'] == '2') {
                        $c_motivo = 'Periódico';
                    } elseif ($c_linha['motivo_consulta'] == '3') {
                        $c_motivo = 'Demissional';
                    } elseif ($c_linha['motivo_consulta'] == '4') {
                        $c_motivo = 'Mudança de Função';
                    } elseif ($c_linha['motivo_consulta'] == '5') {
                        $c_motivo = 'Retorno ao Trabalho';
                    } elseif ($c_linha['motivo_consulta'] == '6') {
                        $c_motivo = 'Outros';
                    }
                    echo "<tr>";
                    echo "<td>" . date('d/m/Y', strtotime($c_linha['data'])) . "</td>";
                    echo "<td>" . $c_motivo . "</td>";
                    echo "<td>
                                <a class='btn btn-light btn-sm' title='Editar Anamnese' href='javascript:func()'onclick='editar($c_linha[id])'>
                                <span class='glyphicon glyphicon-pencil'> Editar</span></a>
                   
                          </td>";
                    echo "</tr>";
                }

                ?>
            </tbody>
        </table>
    </div>


</body>

</html>