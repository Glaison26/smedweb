<?php // controle de acesso ao formulário
session_start();
//if (!isset($_SESSION['newsession'])) {
//    die('Acesso não autorizado!!!');
//}
//if ($_SESSION['c_tipo'] != '1') {
//    header('location: /raxx/voltamenunegado.php');
//}
include("conexao.php");
include("links.php");
// primeira entrada
$c_sql = "";
$_SESSION['incagenda'] = false;
// faço a Leitura da tabela de pacientes com sql
if ((isset($_POST["btnpesquisa"])) && ($_SERVER['REQUEST_METHOD'] == 'POST')) {  // botão para executar sql de pesquisa de paciente
    $c_pesquisa = $_POST['pesquisa'];
    $c_sql = "SELECT pacientes.id, pacientes.nome, pacientes.sexo, pacientes.fone, pacientes.fone2, convenios.nome as convenio, pacientes.matricula 
    FROM pacientes JOIN convenios ON pacientes.id_convenio=convenios.id";
    if ($c_pesquisa != ' ') {
        $c_sql = $c_sql . " where pacientes.nome LIKE " .  "'" . $c_pesquisa . "%'";
    }
    $c_sql = $c_sql . " order by pacientes.nome";

    $result = $conection->query($c_sql);
    // verifico se a query foi correto
    if (!$result) {
        die("Erro ao Executar Sql!!" . $conection->connect_error);
    }
}

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
                window.location.href = "/smedweb/pacientes_excluir.php?id=" + id;
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
            $('.tabpacientes').DataTable({
                // 
                "iDisplayLength": -1,
                "order": [1, 'asc'],
                "aoColumnDefs": [{
                    'bSortable': false,
                    'aTargets': [5]
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
            <h5>Lista de Paciêntes do Sistema<h5>
        </div>
    </div>
    <br>
    <div class="container-fluid">

        <a class="btn btn-success btn-sm" href="/smedweb/pacientes_novo.php"><span class="glyphicon glyphicon-plus"></span> Incluir</a>
        <a class="btn btn-secondary btn-sm" href="/smedweb/menu.php"><span class="glyphicon glyphicon-arrow-left"></span> Voltar</a>
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

        <table class="table display table-bordered tabpacientes">
            <thead class="thead">
                <tr class="info">
                    <th scope="col">Número</th>
                    <th scope="col">Nome do Paciênte</th>
                    <th scope="col">Convênio</th>
                    <th scope="col">Matrícula</th>
                    <th scope="col">Sexo</th>
                    <th scope="col">Telefone 1</th>
                    <th scope="col">Telefone 2</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($c_sql)) {
                    // insiro os registro do banco de dados na tabela 
                    while ($c_linha = $result->fetch_assoc()) {
                        // Coloco string masculino ou feminino ao invés de m ou f
                        if ($c_linha['sexo'] == 'M') {
                            $c_sexo = "Masculino";
                        } else {
                            $c_sexo = "Feminino";
                        }
                        echo "
                    <tr>
                    <td>$c_linha[id]</td>
                    <td>$c_linha[nome]</td>
                    <td>$c_linha[convenio]</td>
                    <td>$c_linha[matricula]</td>
                    <td>$c_sexo</td>
                    <td>$c_linha[fone]</td>
                    <td>$c_linha[fone2]</td>
                                     
                    <td>
                    <a class='btn btn-light btn-sm' title='Editar Paciênte' href='/smedweb/pacientes_editar.php?id=$c_linha[id]'><span class='glyphicon glyphicon-pencil'> Editar</span></a>
                    <a class='btn btn-light btn-sm' title='História Clinica' href='/smedweb/historia.php?id=$c_linha[id]'><span class='glyphicon glyphicon-header'> História</span></a>
                    <a class='btn btn-light btn-sm' title='Imagens' href='/smedweb/imagens.php?id=$c_linha[id]'><img src='\smedweb\images\imagens.png' alt='' width='20' height='20'> Imagens</a>
                    <a class='btn btn-light btn-sm' title='Eventos' href='#'><span class='glyphicon glyphicon-book'> Eventos</span></a>
                    <a class='btn btn-danger btn-sm' title='Excluir Paciênte' href='javascript:func()'onclick='confirmacao($c_linha[id])'><span class='glyphicon glyphicon-trash'> Excluir</span></a>
                    </td>

                    </td>

                    </tr>
                    ";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>



</html>