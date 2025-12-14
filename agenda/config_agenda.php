<?php // controle de acesso ao formulário
//session_start();
//if (!isset($_SESSION['newsession'])) {
//    die('Acesso não autorizado!!!');
//}
//if ($_SESSION['c_tipo'] != '1') {
//    header('location: /raxx/voltamenunegado.php');
//}
include("../conexao.php");
include("../links.php");
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
        function mensagem(msg) {
            alert(msg);
        }
    </script>


    <script>
        $(document).ready(function() {
            $('.tabprofissionais').DataTable({
                // 
                "iDisplayLength": 6,
                "order": [1, 'asc'],
                "aoColumnDefs": [{
                    'bSortable': false,
                    'aTargets': [3]
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
    <div class="container-fluid">
        <div class="panel panel-primary class">
            <div class="panel-heading text-center">
                <h4>SmartMed - Sistema Médico</h4>
                <h5>Lista de Profissionais para Configuração<h5>
            </div>
        </div>
        <br>
    </div>
    <div class="container -my5">
        <div class="container">
            <div class="col-lg-12" style="text-align: right;">
                <a class='btn btn-info' title="Voltar ao menu" href='/smedweb/menu.php'> <img src="\smedweb\images\voltar.png" alt="" width="15" height="15"> Voltar</a>
            </div>
            <a class='btn btn-warning' title="Suprimir datas para não serem geradas" href='datas_suprimidas_lista.php'> <img src="\smedweb\images\removerdata.png" alt="" width="15" height="15"> Suprimir Datas</a>
        </div>
        <hr>
        <table class="table display table-bordered tabprofissionais">
            <thead class="thead">
                <tr class="info">
                    <th scope="col">id</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Especialidade</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php

                // faço a Leitura da tabela com sql
                $c_sql = "SELECT profissionais.id, profissionais.nome, profissionais.fone1, profissionais.fone2, 
                especialidades.descricao  AS especialidade" .
                    " FROM profissionais JOIN especialidades ON profissionais.id_especialidade=especialidades.id
                where profissionais.gera_agenda='S'
                 order by profissionais.nome";
                $result = $conection->query($c_sql);
                // verifico se a query foi correto
                if (!$result) {
                    die("Erro ao Executar Sql!!" . $conection->connect_error);
                }

                // insiro os registro do banco de dados na tabela 
                while ($c_linha = $result->fetch_assoc()) {
                    // Coloco string sim ou não ao invés de s ou n
                    echo "
                    <tr>
                    <td>$c_linha[id]</td>
                    <td>$c_linha[nome]</td>
                    <td>$c_linha[especialidade]</td>
                            
                    <td>
                    <a class='btn btn-primary' title='Configuração da agenda do profissional' href='/smedweb/agenda/config_agenda_criacao.php?id=$c_linha[id]'>
                    <span class='glyphicon glyphicon-calendar'></span> Configurar Agenda</a>
                    <a class='btn btn-success' title='Gerar Agenda do Profissional' href='/smedweb/agenda/criacao_agenda.php?id=$c_linha[id]'>
                    <img src='\smedweb\images\gerar_agenda2.png' alt='' width='20' height='20'> Gerar Agenda</a>
                    
                    </td>

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