<?php
include_once "lib_gop.php";
include("conexao.php"); // conexão de banco de dados
date_default_timezone_set('America/Sao_Paulo');
session_start();
if (isset($_GET["id"])) { // pego a id do paciente
    $c_id = $_GET["id"];
    $_SESSION["id_paciente"] = $c_id;
} else {
    $c_id = $_SESSION["id_paciente"];
}

if  ((isset($_POST["btnfoto"]))&&($_SERVER['REQUEST_METHOD'] == 'POST')) {  // botão para incluir imagem
    $dir = "img/";
    $arquivo = $_FILES['arquivo'];
    $_SESSION['c_nomefoto'] = $_FILES['arquivo']['name'];

    $c_nomefoto = $arquivo["name"];
    move_uploaded_file($arquivo["tmp_name"], "$dir/" . $arquivo["name"]);
    //echo $c_nomefoto;
    // incluir registro da imagem no banco de dados
    $c_pasta = $dir . $c_nomefoto;

    $d_data = date('Y-m-d');
    $c_sql = "insert into imagens_pacientes (id_paciente, pasta_imagem, data) value ('$c_id', '$c_pasta', '$d_data')";
    $result = $conection->query($c_sql);
}



$c_sql = "select pacientes.id, pacientes.nome from pacientes where pacientes.id='$c_id'";
$result = $conection->query($c_sql);
// verifico se a query foi correto
if (!$result) {
    die("Erro ao Executar Sql!!" . $conection->connect_error);
}
$c_linha = $result->fetch_assoc();
$_SESSION["paciente_nome"] = $c_linha['nome'];
$c_caminho = '/smedweb/imagens_lista.php?id='.$c_id;

//
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

    <script>
        $(document).ready(function() {
            $('.tabimagens').DataTable({
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
            <h5>Gerenciamento de Imagens Clinicas do Paciente<h5>
        </div>
    </div>
    <div class="container -my5">
        <form method="post" enctype="multipart/form-data">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4>Identificação do Paciente:<?php echo ' ' . $c_linha['nome'] ?></h4>
                </div>
                <div class="panel panel-Light">
                    <!-- <button class="btn btn-info" onclick="document.getElementById('arquivo').click()"><img src="\smedweb\images\camera.png" alt="" width="20" height="20"> Nova Imagem</button> -->
                    <br>
                    <div style="padding-left:7px;">
                        
                        <button type="submit" name="btnfoto" id="btnfoto" class="btn btn-Ligth"> <img src="\smedweb\images\imagem2.png" alt="" width="20" height="20"> Carregar imagem</button>
                        <a class='btn btn-Light btn-sm' title='Lista de Imagens' href="<?php echo $c_caminho;?>"><span class='glyphicon glyphicon-list-alt'></span> Listar Imagens</a>
                        <a class='btn btn-Light' href='/smedweb/pacientes_lista.php'> <img src="\smedweb\images\voltar.png" alt="" width="15" height="15"> Voltar</a>
                        <hr>
                        <input type="file" name="arquivo" id="arquivo" accept="image/*">
                    </div>

                </div>

                <div class="panel-body">
                    <div style="padding-top:5px;">
                        <table class="table display table-bordered tabimagens">
                            <thead class="thead">
                                <tr class="info">
                                    <th scope="col">No.</th>
                                    <th scope="col">Data</th>
                                    <th scope="col">Descrição</th>
                                    <th scope="col">Pasta</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // faço a Leitura da tabela com imagens
                                $c_sql = "SELECT * FROM imagens_pacientes where imagens_pacientes.id_paciente='$c_id' ORDER BY imagens_pacientes.`data` desc";
                                $result = $conection->query($c_sql);
                                // verifico se a query foi correto
                                if (!$result) {
                                    die("Erro ao Executar Sql!!" . $conection->connect_error);
                                }

                                // insiro os registro do banco de dados na tabela 
                                while ($c_linha = $result->fetch_assoc()) {
                                    $c_data = DateTime::createFromFormat('Y-m-d', $c_linha['data']);
                                    $c_data = $c_data->format('d/m/y');
                                    echo "
                                        <tr>
                                            <td>$c_linha[id]</td>
                                            <td>$c_data</td>
                                            <td>$c_linha[descricao]</td>
                                            <td>$c_linha[pasta_imagem]</td>
                                            <td>
                                            <a class='btn btn-info btn-sm' title='Visualizar ' href='/smedweb/imagens_visualizar.php?id=$c_linha[id]'><span class='glyphicon glyphicon-eye-open'> Visualizar</span></a>
                                            <a class='btn btn-danger btn-sm' title='Excluir' href='javascript:func()'onclick='confirmacao($c_linha[id])'><span class='glyphicon glyphicon-trash'></span> Excluir</a>
                                            
                                            </td>

                                            </tr>
                                            ";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
    </div>

    </div>


</body>





</html>