<?php // controle de acesso ao formulário
//session_start();
//if (!isset($_SESSION['newsession'])) {
//    die('Acesso não autorizado!!!');
//}
//if ($_SESSION['c_tipo'] != '1') {
//    header('location: /raxx/voltamenunegado.php');
//}
include("../../conexao.php");
include("../../links.php");
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Smed - Sistema Médico</title>
  
</head>
<body>
    <script language="Javascript">
        function confirmacao(id) {
            var resposta = confirm("Deseja remover esse registro?");
            if (resposta == true) {
                window.location.href = "/smedweb/cadastros/itenslaudos/baterias_excluir.php?id=" + id;
            }
        }
    </script>

    <script language="Javascript">
        function mensagem(msg) {
            alert(msg);
        }
    </script>
<body>
  

    <script language="Javascript">
        function mensagem(msg) {
            alert(msg);
        }
    </script>


    <script>
        $(document).ready(function() {
            $('.tabexames').DataTable({
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
            <h5>Lista de baterias de Exames para Laudos<h5>
        </div>
    </div>
    <br>
    <div class="container -my5">
        <!-- Button trigger modal -->
        <a class="btn btn-success btn-sm" href="/smedweb/cadastros/itenslaudos/baterias_novo.php"><span class="glyphicon glyphicon-plus"></span> Incluir</a>
        <a class="btn btn-secondary btn-sm" href="/smedweb/cadastros/itenslaudos/itenslaudos_lista.php"><span class="glyphicon glyphicon-arrow-left"></span> Voltar</a>
        <hr>
        <table class="table display table-bordered tabexames">
            <thead class="thead">
                <tr class="info">
                    <th scope="col">No.</th>
                    <th scope="col">Descricao</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // faço a Leitura da tabela com sql
                $c_sql = "SELECT bateria.id, bateria.descricao FROM bateria ORDER BY bateria.descricao";
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
                    <td>
                    <a class='btn btn-info btn-sm' title='Editar Exame ' href='/smedweb/cadastros/itenslaudos/baterias_editar.php?id=$c_linha[id]'><span class='glyphicon glyphicon-pencil'></span></a>
                    <a class='btn btn-danger btn-sm' title='Excluir Exame' href='javascript:func()'onclick='confirmacao($c_linha[id])'><span class='glyphicon glyphicon-trash'></span></a>
                    </td>

                    </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>