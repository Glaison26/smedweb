<?php // controle de acesso ao formulário
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

include("../../conexao.php");
include("../../links.php");
?>

<!-- página de exibição do resultado da pesquisa de movimentação de contas -->
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body>
    <script language="Javascript">
        function confirmacao(id) {
            var resposta = confirm("Deseja remover esse registro?");
            if (resposta == true) {
                window.location.href = "/smedweb/financeiro/contas/movimento_excluir.php?id=" + id;
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
            $('.tabmovimento').DataTable({
                // 
                "iDisplayLength": -1,
                "order": [1, 'asc'],
                "aoColumnDefs": [{
                    'bSortable': false,
                    'aTargets': [6]
                }, {
                    'aTargets': [0],
                    "visible":true 
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


        $(document).on('submit', '#frmaddtabela', function(e) {
            e.preventDefault();
            var c_tabela = $('#addtabelaField').val();
            var c_indice = $('#addindiceField').val();

            if (c_tabela != '') {

                $.ajax({
                    url: "tabela_novo.php",
                    type: "post",
                    data: {
                        c_indice: c_indice,
                        c_tabela: c_tabela
                    },
                    success: function(data) {
                        var json = JSON.parse(data);
                        var status = json.status;

                        location.reload();
                        if (status == 'true') {

                            $('#novatabelaModal').modal('hide');
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
                $('#up_tabelaField').val(data[1]);
                $('#up_indiceField').val(data[2]);

            });
        });
    </script>

    <script type="text/javascript">
        // Função javascript e ajax para Alteração dos dados
        $(document).on('submit', '#frmtabela', function(e) {
            e.preventDefault();
            var c_id = $('#up_idField').val();
            var c_tabela = $('#up_tabelaField').val();
            var c_indice = $('#up_indiceField').val();

            if (c_tabela != '') {

                $.ajax({
                    url: "tabela_editar.php",
                    type: "post",
                    data: {
                        c_id: c_id,
                        c_indice: c_indice,
                        c_tabela: c_tabela
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
                <h5>Movimentação Financeira<h5>
            </div>
        </div>
    <div class="container -my5">

       
        <a class="btn btn-secondary btn-sm" href="/smedweb/financeiro/contas/movimento__opcoes.php"><span class="glyphicon glyphicon-arrow-left"></span> Voltar</a>
        <hr>
        <!--painel com os filtros de pesquisa-->
        <div class="alert alert-info" role="alert">
            <h5>Período de Movimentação: <?php echo $_SESSION['data_inicial']; ?> até <?php echo $_SESSION['data_final']; ?></h5>
            <?php
            if ($_SESSION['filtro_movimento'] == 'convenio') {
                echo "<h5>Filtrado por Convênio: " . $_SESSION['nome_convenio'] . "</h5>";
            } elseif ($_SESSION['filtro_movimento'] == 'paciente') {
                echo "<h5>Filtrado por Paciente: " . $_SESSION['nome_paciente'] . "</h5>";
            } else {
                echo "<h5>Sem Filtro - Todas as Contas</h5>";
            }
            echo "<hr>";
            // coloco valor total da movimentação no período
            $c_sql_total = $_SESSION['sql_movimento_contas'];
            $result_total = $conection->query($c_sql_total);
            $total_movimentacao = 0;
            $total_pendente = 0;
            $total_recebido = 0;
            while ($c_linha_total = $result_total->fetch_assoc()) {
                $total_movimentacao += $c_linha_total['valor'];
                if ($c_linha_total['status'] == 'Pendente') {
                    $total_pendente += $c_linha_total['valor'];
                }
                if ($c_linha_total['status'] == 'Recebido') {
                    $total_recebido += $c_linha_total['valor'];
                }   
            }
            $fmt = new NumberFormatter('de_DE', NumberFormatter::CURRENCY);
            $n_total_movimentacao = 'R$ ' . $fmt->formatCurrency($total_movimentacao, "   ") . "\n";
            echo "<h5>Valor Total da Movimentação: " . $n_total_movimentacao . "</h5>";
            $n_total_pendente = 'R$ ' . $fmt->formatCurrency($total_pendente, "   ") . "\n";
            echo "<h5>Valor Total Pendente: " . $n_total_pendente . "</h5>";
            $n_total_recebido = 'R$ ' . $fmt->formatCurrency($total_recebido, "   ") . "\n";
            echo "<h5>Valor Total Recebido: " . $n_total_recebido . "</h5>";
            ?>
        </div>


        <!-- tabela de exibição dos resultados da pesquisa -->
        <hr>
        <table class="table display table-bordered tabmovimento">
            <thead class="thead">
                <tr class="info">
                    <th scope="col">#</th>
                    <th scope="col">Data</th>
                    <th scope="col">Paciente</th>
                    <th scope="col">Convênio</th>
                    <th scope="col">Procedimento</th>
                    <th scope="col">Valor em R$</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $fmt = new NumberFormatter('de_DE', NumberFormatter::CURRENCY);
                // faço a Leitura da tabela com sql
                $c_sql = $_SESSION['sql_movimento_contas'];
                $result = $conection->query($c_sql);
                // verifico se a query foi correto
                if (!$result) {
                    die("Erro ao Executar Sql!!" . $conection->connect_error);
                }
                // insiro os registro do banco de dados na tabela 
                while ($c_linha = $result->fetch_assoc()) {
                    $n_valor = 'R$ ' . $fmt->formatCurrency($c_linha['valor'], "   ") . "\n";
                    $d_data = date("d/m/Y", strtotime(str_replace('-', '/', $c_linha['data'])));
                    
                    echo "
                    <tr>
                    <td>$c_linha[id_lancamento]</td>
                    <td>$d_data</td>
                    <td>$c_linha[nome]</td>
                    <td>$c_linha[convenio]</td>
                    <td>$c_linha[procedimento_descricao]</td>
                    <td>$n_valor</td>
                    <td>
                    <button class='btn btn-info btn-sm editbtn' data-toggle=modal' title='Editar Lançamento'><span class='glyphicon glyphicon-pencil'></span></button>
                    <a class='btn btn-danger btn-sm' title='Excluir Lançamento' href='javascript:func()'onclick='confirmacao($c_linha[id_lancamento])'><span class='glyphicon glyphicon-trash'></span></a>
                    </td>

                    </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
    </div>


    <!-- Modal para edição dos dados -->
    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="editmodal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Editar dados do Indice</h4>
                </div>
                <div class="modal-body">
                    <div class='alert alert-warning' role='alert'>
                        <h5>Campos com (*) são obrigatórios</h5>
                    </div>
                    <form id="frmtabela" method="POST" action="">
                        <input type="hidden" id="up_idField" name="up_idField">
                        <div class="mb-3 row">
                            <label for="up_tabelaField" class="col-md-3 form-label">Tabela(*)</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" id="up_tabelaField" name="up_tabelaField">
                            </div>
                        </div>

                        <div class="mb-3 row">

                            <label class="col-md-3 form-label">Indice</label>
                            <div class="col-sm-7">
                                <select class="form-control form-control-lg" id="up_indiceField" name="up_indiceField">
                                    <?php
                                    $c_sql = "SELECT indices.id, indices.descricao FROM indices ORDER BY indices.descricao";
                                    $result = $conection->query($c_sql);

                                    // insiro os registro do banco de dados na tabela 
                                    while ($c_linha = $result->fetch_assoc()) {
                                        echo "
                                        <option>$c_linha[descricao]</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><span class='glyphicon glyphicon-floppy-saved'></span> Salvar</button>
                            <button class="btn btn-secondary" data-dismiss="modal"><span class='glyphicon glyphicon-remove'></span> Fechar</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>



</body>



</html>