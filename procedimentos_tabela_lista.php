<?php // controle de acesso ao formulário
session_start();
//if (!isset($_SESSION['newsession'])) {
//    die('Acesso não autorizado!!!');
//}
//if ($_SESSION['c_tipo'] != '1') {
//    header('location: /raxx/voltamenunegado.php');
//}
include("conexao.php");

// pego o id do procedimento
if ($_SESSION["controle"]=='1') {
    $_SESSION["controle"] = "2";
    $_SESSION['codigo_proc'] = $_GET["id"]; 
}
$c_id = $_SESSION['codigo_proc'];
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
                window.location.href = "/smedweb/procedimento_tabela_excluir.php?id=" + id;
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
            $('.tabproc_tabela').DataTable({
                // 
                "iDisplayLength": 6,
                "order": [1, 'asc'],
                "aoColumnDefs": [{
                    'bSortable': false,
                    'aTargets': [4]
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
            <h5>Lista de Tabelas por Procedimento do Sistema<h5>
        </div>
    </div>
    <br>
    <div class="container -my5">
        <?php
        // faço a Leitura da tabela com sql
        $c_sql = "SELECT procedimentos.descricao AS procedimento, procedimentos_tabelas.id_procedimento,
                  procedimentos_tabelas.id_tabela, tabela.descricao,
                  procedimentos_tabelas.id, procedimentos_tabelas.custo, procedimentos_tabelas.valorreal, indices.descricao as indice 
                  FROM procedimentos_tabelas
                  JOIN procedimentos ON procedimentos_tabelas.id_procedimento=procedimentos.id
                  JOIN tabela ON procedimentos_tabelas.id_tabela=tabela.id
                  JOIN indices ON tabela.id_indice=indices.id 
                  WHERE procedimentos_tabelas.id_procedimento='$c_id'";
        $result = $conection->query($c_sql);
        // verifico se a query foi correto
        if (!$result) {
            die("Erro ao Executar Sql!!" . $conection->connect_error);
        }
        $c_linhaproc = $result->fetch_assoc();
        $c_id_proc=$c_linhaproc['id_procedimento'];
        $c_idtabela = $c_linhaproc['id_tabela'];

        ?>
        <!-- Button trigger modal -->
        <a class='btn btn-success btn-sm' href='/smedweb/procedimentos_tabela_novo.php?id='$c_idtabela><span class="glyphicon glyphicon-plus"></span> Novo</a>
        <a class="btn btn-secondary btn-sm" href="/smedweb/procedimentos_lista.php"><span class="glyphicon glyphicon-arrow-left"></span> Voltar</a>

        <hr>
        <div class='alert alert-info' role='alert'>
            <h5>Procedimento :<?php echo " " . $c_linhaproc['procedimento'] ?> </h5>
        </div>
        <table class="table display table-bordered tabproc_tabela">
            <thead class="thead">
                <tr class="info">
                    <th scope="col" width="5%">No.</th>
                    <th scope="col" width="20%">Tabela</th>
                    <th scope="col" width="10%">Indice</th>
                    <th scope="col" width="10%">Custo</th>
                    <th scope="col" width="10%">Valor em R$</th>
                    <th scope="col" width="10%">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $fmt = new NumberFormatter('de_DE', NumberFormatter::CURRENCY);
                $result = $conection->query($c_sql);

                // insiro os registro do banco de dados na tabela 
                while ($c_linha = $result->fetch_assoc()) {
                    $n_valor = 'R$ ' . $fmt->formatCurrency($c_linha['valorreal'], "   ") . "\n";
                    //$n_valor=$c_linha['valor'];
                    echo "
                    <tr>
                    <td>$c_linha[id]</td>
                    <td>$c_linha[descricao]</td>
                    <td>$c_linha[indice]</td>
                    <td>$c_linha[custo]</td>
                    <td>$n_valor</td>
                    <td>
                    <a class='btn btn-info btn-sm' title='Editar Tabela X Procedimento' href='/smedweb/procedimentos_tabela_editar.php?id=$c_linha[id]'><span class='glyphicon glyphicon-pencil'></span></a>
                    <a class='btn btn-danger btn-sm' title='Excluir tabela X Procedimento' href='javascript:func()'onclick='confirmacao($c_linha[id])'><span class='glyphicon glyphicon-trash'></span></a>
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