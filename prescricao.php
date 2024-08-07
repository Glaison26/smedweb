<?php
session_start();
//if (!isset($_SESSION['newsession'])) {
//    die('Acesso não autorizado!!!');
//}
//if ($_SESSION['c_tipo'] != '1') {
//    header('location: /raxx/voltamenunegado.php');
//}
include("conexao.php");
include("links.php");

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

<!DOCTYPE html>
<html lang="en">

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
            <h5>Emissão de Prescrições<h5>
        </div>
    </div>
    <br>
    <div class="container-fluid">

        <form id="frmpaciente" method="POST" action="">

            <hr>
            <label for="up_parametroField" class="col-md-2 form-label">Nome para pesquisar</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="pesquisa" name="pesquisa">
            </div>
            <button type="submit" id='bntpesquisa' name='btnpesquisa' class="btn btn-primary"><img src='\smedweb\images\pesquisapessoas.png' alt='' width='20' height='20'></span> Pesquisar</button>
            <a class="btn btn-info" href="/smedweb/menu.php"><img src='\smedweb\images\voltar.png' alt='' width='20' height='20'> Voltar</a>
        </form>
        <br>
        <table class="table display table-bordered tabpacientes">
            <thead class="thead">
                <tr class="info">
                    <th scope="col">Número</th>
                    <th scope="col">Nome do Paciênte</th>
                    <th scope="col">Sexo</th>
                    <th scope="col">Matrícula</th>
                    <th scope="col">Opções de Prescrições</th>
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
                    <td>$c_sexo</td>
                    <td>$c_linha[matricula]</td>
          
                                                       
                    <td>
                    <a class='btn btn-light btn-sm' title='Atestatos' href='/smedweb/atestado.php?id=$c_linha[id]'><img src='\smedweb\images\atestado.png'  width='20' height='20'> Atestados</a>
                    <a class='btn btn-light btn-sm' title='Formulas' href='/smedweb/prescricao_formulas.php?id=$c_linha[id]'><img src='\smedweb\images\as.png' width='20' height='20'> Fórmulas</a>
                    <a class='btn btn-light btn-sm' title='Laudos' href='/smedweb/prescricoes_laudos.php?id=$c_linha[id]'><img src='\smedweb\images\laudo.png' width='20' height='20'> Laudos</a>
                    <a class='btn btn-light btn-sm' title='Medicamentos' href='/smedweb/prescricao_medicamentos.php?id=$c_linha[id]'><img src='\smedweb\images\dio.png' width='20' height='20'> Medicamentos</a>
                    <a class='btn btn-light btn-sm' title='Orientações' href='/smedweb/prescricao_orientacoes.php?id=$c_linha[id]'><img src='\smedweb\images\orientacoes.png' width='20' height='20'> Orientações</a>
                    <a class='btn btn-light btn-sm' title='Relatórios' href='/smedweb/prescricao_relatorio.php?id=$c_linha[id]'><img src='\smedweb\images\oto.png' width='20' height='20'> Relatórios</a>

                    </td>
                        
                    </tr>
                    ";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    </div>

</body>

</html>