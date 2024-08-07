<?php
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

include_once "lib_gop.php";
include("conexao.php"); // conexão de banco de dados
include("links.php");
if (isset($_GET["id"])) {
    $c_id = $_GET["id"]; // pego a id do paciente
    $_SESSION['refid'] = $c_id;
} else {
    $c_id = $_SESSION['refid'];
}
// sql para pegar dados do paciente selecionado
$c_prescricao = "";
$c_sql = "select pacientes.id, pacientes.nome from pacientes where pacientes.id='$c_id'";
$result = $conection->query($c_sql);
// verifico se a query foi correto
if (!$result) {
    die("Erro ao Executar Sql!!" . $conection->connect_error);
}
$c_linha = $result->fetch_assoc();
// rotina de registro de prescrição medicamento na história clinica do paciente
if ((isset($_POST["btnregistro"]))) {
    // verifico se paciente tem registro de historia
    $c_prescricao = $_POST['id_texto'];
    $c_sql_contador = "select count(*) as contador from historia where id_paciente='$c_id'";
    $result_contador = $conection->query($c_sql_contador);
    $c_linha_contador = $result_contador->fetch_assoc();
    // se não tem historia insiro informação
    $hoje = date('d/m/Y');
    if ($c_linha_contador['contador'] == 0) {
        $c_historia = "$hoje" . "\r\n" . "Prescrição de Medicamento Emitido" .
            "\r\n" . $c_prescricao;
        $c_sql_historia = "insert into historia (id_paciente, historia) value ('$c_id', '$c_historia')";
        $result_historia = $conection->query($c_sql_historia);
        // se tem história acrescento com update no registro do pacinte
    } else {
        $c_sql_historia = "select historia.historia from historia where historia.id_paciente='$c_id'";
        $c_result_historia = $conection->query($c_sql_historia);
        $c_linha_historia = $c_result_historia->fetch_assoc();

        $c_historia = $c_linha_historia['historia'] . "\r\n" . "\r\n" . "$hoje" . "\r\n" . "Prescrição de Medicamento Emitido" .
            "\r\n" . $c_prescricao;
        $c_sql_historia = "update historia set historia = '$c_historia' where id_paciente='$c_id'";
        $result_historia = $conection->query($c_sql_historia);
        echo "
          <script>
          alert('Prescrição de Medicamentos registrado na história clinica do paciente!!!');
          </script>
        ";
    }
}

// botão para incluir texto de medicamento selecionado
if ((isset($_POST["btninclui"]))) {

    $c_id_medicamento = $_POST['id_medicamento'];
    $c_sql_medicamento = "select descricao from medicamentos where id='$c_id_medicamento'";
    $result_medicamento = $conection->query($c_sql_medicamento);
    // procuro o texto no cadastro de medicamentos para colocar no texto
    $c_linha_medicamento = $result_medicamento->fetch_assoc();
    $c_prescricao = $_POST['prescricao'] . $c_linha_medicamento['descricao'] . "...." . "\r\n";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <!-- funcao para chamar rotina para cortar registro de medicamento -->
    <script>
        function pegaid(id) {
            document.getElementById('id_medicamento').value = id;

        }
    </script>

    <script>
        $(document).ready(function() {
            $('.tabmedicamentos').DataTable({
                // 
                "iDisplayLength": -1,
                "order": [1, 'asc'],
                "aoColumnDefs": [{
                    'bSortable': false,
                    'aTargets': [3]
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
            <h5>Prescrição de Medicamentos<h5>
        </div>
    </div>

    <div class="container -my5">
        <form method="post">
            <a class="btn btn-light" href="#"><img src='\smedweb\images\printer.png' alt='' width='20' height='20'> Emitir Prescrição</a>
            <button type='submit' id='btnregistro' name='btnregistro' class='btn btn-light' data-toggle='modal' title='Registra prescrição no histórico do paciente'>
                <img src='\smedweb\images\registro.png' alt='' width='20' height='20'> Registrar Prescrição</button>
            <input type='hidden' name='id_texto' id='id_texto' value="<?php echo $c_prescricao ?>">
            <a class="btn btn-light" href="/smedweb/prescricao.php"><img src='\smedweb\images\voltar.png' alt='' width='20' height='20'> Voltar</a>

            <hr>
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h4>Identificação do Paciente:<?php echo ' ' . $c_linha['nome']; ?></h4>
                </div>
            </div>
            <!-- Formulário com os profissionais para seleção -->
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
            <!-- fim do formulário de seleção de profissionais -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#prescricao" aria-controls="home" role="tab" data-toggle="tab">Editar Prescrição</a></li>
                <li role="presentation"><a href="#modelos" aria-controls="modelos" role="tab" data-toggle="tab">Lista de Medicamentos</a></li>
            </ul>
            <!-- paginas de edição medicamentos cadastrados -->
            <div class="tab-content">
                <!-- aba de edição de medicamentos -->
                <div role="tabpanel" class="tab-pane active" id="prescricao">
                    <div style="padding-top:5px;">
                        <div style="padding-top:20px;">
                            <div class="form-group">
                                <label class="col-sm-2 col-form-label">Texto da Prescrição</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" id="prescricao" name="prescricao" rows="15"><?php echo $c_prescricao; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- aba de medicamentos cadastrados -->
                <div role="tabpanel" class="tab-pane" id="modelos">
                    <div style="padding-top:5px;">
                        <div class="table-responsive=lg">
                            <table style="width:100%" class="table display table-bordered tabmedicamentos">
                                <thead class="thead">
                                    <tr class="info">
                                        <th style='display:none' scope="col">No.</th>
                                        <th scope="col">Medicamento</th>
                                        <th scope="col">Grupo</th>
                                        <th scope="col">Ações</th>
                                    </tr>
                                </thead>
                                <!-- input para capturar id da prescricao a ter o texto capturado -->
                                <input type='hidden' name='id_medicamento' id='id_medicamento'>
                                <tbody>

                                    <?php
                                    // faço a Leitura da tabela com sql
                                    $c_sql = "SELECT medicamentos.id, medicamentos.descricao, grupos_medicamentos.descricao AS grupo from medicamentos
                                            JOIN  grupos_medicamentos ON medicamentos.id_grupo=grupos_medicamentos.id
                                            ORDER BY medicamentos.descricao";
                                    $result = $conection->query($c_sql);
                                    // verifico se a query foi correto
                                    if (!$result) {
                                        die("Erro ao Executar Sql!!" . $conection->connect_error);
                                    }
                                    // insiro os registro do banco de dados na tabela 
                                    while ($c_linha2 = $result->fetch_assoc()) {

                                        echo "
                                        <tr>
                                        <td style='display:none'>$c_linha2[id]</td>
                                        <td>$c_linha2[descricao]</td>
                                        <td>$c_linha2[grupo]</td>
                   
                                        <td>
                                          <button type='submit' onclick='pegaid($c_linha2[id])'  id='btninclui' name='btninclui' class='btn btn-info btn-sm editbtn' 
                                          data-toggle='modal' title='Selecionar Medicamento'><img src='\smedweb\images\copiar.png' alt='' width='20' height='20'> Selecionar Medicamento</button>
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
            </div>
        </form>
    </div>


</body>

</html>