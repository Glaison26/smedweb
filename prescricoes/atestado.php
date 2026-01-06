<?php
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

include_once "../lib_gop.php";
include("../conexao.php"); // conexão de banco de dados
include("../links.php");


//if ((!isset($_POST["btninclui"])))
if ($_SESSION['atestado'] == "") {
    $c_atestado = "Inserir texto do atestado aqui";
} else {
    $c_atestado = $_SESSION['atestado'];
}
//    $c_atestado = ""; // inicializa a variável para o atestado
if (isset($_GET["id"])) {
    $c_id = $_GET["id"]; // pego a id do paciente
    $_SESSION['refid'] = $c_id;
} else {
    $c_id = $_SESSION['refid'];
}
// sql para pegar dados do paciente selecionado
$c_sql = "select pacientes.id, pacientes.nome from pacientes where pacientes.id='$c_id'";
$result = $conection->query($c_sql);
// verifico se a query foi correto
if (!$result) {
    die("Erro ao Executar Sql!!" . $conection->connect_error);
}
$c_linha = $result->fetch_assoc();
// rotina de registro de atestado na história clinica do paciente
if ((isset($_POST["btnregistro"]))) {
    // verifico se paciente tem registro de historia
    $c_atestado = $_POST['id_texto'];
    $c_sql_contador = "select count(*) as contador from historia where id_paciente='$c_id'";

    $result_contador = $conection->query($c_sql_contador);
    $c_linha_contador = $result_contador->fetch_assoc();
    // se não tem historia insiro informação
    if ($c_linha_contador['contador'] == 0) {
        $c_historia = "$hoje" . "\r\n" . "Atestado Médico Emitido" .
            "\r\n" . $c_atestado;
        $c_sql_historia = "insert into historia (id_paciente, historia) value ('$c_id', '$c_historia')";
        $result_historia = $conection->query($c_sql_historia);
        // se tem história acrescento com update no registro do pacinte
    } else {
        $c_sql_historia = "select historia.historia from historia where historia.id_paciente='$c_id'";
        $c_result_historia = $conection->query($c_sql_historia);
        $c_linha_historia = $c_result_historia->fetch_assoc();
        $hoje = date('d/m/Y');
        $c_historia = $c_linha_historia['historia'] . "\r\n" . "\r\n" . "$hoje" . "\r\n" . "Atestado Médico Emitido" .
            "\r\n" . $c_atestado;
        $c_sql_historia = "update historia set historia = '$c_historia' where id_paciente='$c_id'";
        $result_historia = $conection->query($c_sql_historia);
        // log de registro do atestado na história clinica do paciente
        $d_data_acao = date('Y-m-d');
        $d_hora_acao = date('H:i:s');
        $usuario = $_SESSION['c_userId'];
        $c_informacao = "Atestado Médico registrado na história clinica do paciente id: " . $c_nome_paciente . '<br>' . "Data: " . date("d/m/Y", strtotime($d_data_acao)) . '<br>' . "Profissional: " . $_POST['profissional'];
        $c_sql_log = "INSERT INTO log_clinica (data,hora,id_usuario,descricao,registro)
        VALUES ('$d_data_acao','$d_hora_acao','$usuario','Registro de atestado médico na história clinica do paciente','$c_informacao')";
        $result_log = $conection->query($c_sql_log);
        // fim do log

        echo "
          <script>
          alert('Atestado registrado na história clinica do paciente!!!');
          </script>
        ";
    }
}

// botão para incluir texto de atestado padrão selecionado
if ((isset($_POST["btninclui"]))) {
    $c_id_atestado = $_POST['id_atestado'];
    $c_sql_texto = "select texto from atestados where id='$c_id_atestado'";
    $result_texto = $conection->query($c_sql_texto);
    // procuro o texto no cadastro de atestado para colocar no texto
    $c_linha_atestado = $result_texto->fetch_assoc();
    $c_atestado = $c_linha_atestado['texto'];
    $_SESSION['atestado'] = $c_atestado;
    //echo $c_atestado;
    // coloco o texto no campo de texto do atestado
    echo "<script>
            document.getElementById('obs').value = '$c_atestado';
          </script>";
}

// botão para emissão de atestado
if ((isset($_POST["btnprint"]))) {
    $_SESSION['atestado'] = $_POST['obs'];
    $_SESSION['paciente'] = $c_linha['nome'];
    $_SESSION['profissional'] = $_POST['profissional'];
    echo "<script> window.open('/smedweb/prescricoes/rel_atestado.php?id=', '_blank');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
    <!-- funcao para chamar rotina para cortar registro marcação de agenda -->
    <script>
        function pegaid(id) {
            document.getElementById('id_atestado').value = id;
        }
    </script>
    <!-- funcao para chamar rotina de registro do atestado no histórico do paciênte -->
    <script>
        function registro(id) {

        }
    </script>

    <script>
        $(document).ready(function() {
            $('.tabatestado').DataTable({
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
    <form method="post">
        <div class="container -my5">

            <button type='submit' id='btnprint' name='btnprint' class='btn btn-light' data-toggle='modal' title='Emitir atestado'>
                <img src='\smedweb\images\printer.png' alt='' width='20' height='20'> Emitir Prescrição
            </button>

            <button type='submit' id='btnregistro' name='btnregistro' class='btn btn-light' data-toggle='modal' title='Registra atestado no histórico do paciente'>
                <img src='\smedweb\images\registro.png' alt='' width='20' height='20'> Registrar Atestado
            </button>
            <input type='hidden' name='id_texto' id='id_texto' value="<?php echo $c_atestado ?>">
            <a class="btn btn-light" href="/smedweb/prescricoes/prescricao.php"><img src='\smedweb\images\voltar.png' alt='' width='20' height='20'> Voltar</a>
            <hr>
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h4>Identificação do Paciente:<?php echo ' ' . $c_linha['nome']; ?></h4>
                    <?php $c_nome_paciente = $c_linha['nome']; ?>
                </div>
            </div>
            <!-- Formulário com os profissionais para seleção -->
            <!--<form method="post"> -->

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
                <li role="presentation" class="active"><a href="#atestado" aria-controls="home" role="tab" data-toggle="tab">Editar Atestado</a></li>
                <li role="presentation"><a href="#modelos" aria-controls="modelos" role="tab" data-toggle="tab">Modelos de Atestados</a></li>
            </ul>
            <!-- paginas de edição e modelos de atestados -->
            <div class="tab-content">
                <!-- aba de edição do atestado -->

                <div role="tabpanel" class="tab-pane active" id="atestado">
                    <div style="padding-top:5px;">
                        <div style="padding-top:20px;">
                            <div class="form-group">
                                <label class="col-sm-2 col-form-label">Texto do Atestado</label>
                                <div class="col-sm-12">
                                    <textarea required class="form-control" id="obs" name="obs" rows="15"><?php echo $c_atestado; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- aba de modelos de atestados -->
                <div role="tabpanel" class="tab-pane" id="modelos">
                    <div style="padding-top:5px;">

                        <div class="table-responsive=lg">
                            <table class="table display table-bordered tabatestados">
                                <thead class="thead">
                                    <tr class="info">
                                        <th style='display:none' scope="col">No.</th>
                                        <th scope="col">Atestado</th>
                                        <th scope="col">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <!-- input para capturar id do atestado a ter o texto capturado -->
                                    <input type='hidden' name='id_atestado' id='id_atestado'>
                                    <?php
                                    // faço a Leitura da tabela com sql
                                    $c_sql = "SELECT atestados.id, atestados.descricao, atestados.texto FROM atestados ORDER BY atestados.descricao";
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
                   
                                        <td>
                                          <button type='submit' onclick='pegaid($c_linha2[id])'  id='btninclui' name='btninclui' class='btn btn-info btn-sm editbtn' data-toggle=modal' title='Copiar atestado'><img src='\smedweb\images\copiar.png' alt='' width='20' height='20'> Copiar Atestado</button>
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
        </div>

    </form>



</body>

</html>