<?php
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

include("conexao.php");
include_once "lib_gop.php";

//  rotina para sql de pacientes no post
$c_sql_pac = "";
$_SESSION['dataextra'] = "";
$_SESSION['id_profextra'] = "";
$_SESSION['incagenda'] = true;
// faço a Leitura da tabela de pacientes com sql
if ((isset($_POST["btnpesquisa"])) && ($_SERVER['REQUEST_METHOD'] == 'POST')) {  // botão para executar sql de pesquisa de paciente
    $c_pesquisa = $_POST['pesquisa'];
    $c_sql_pac = "SELECT pacientes.id, pacientes.nome, pacientes.sexo, pacientes.fone, pacientes.fone2, convenios.nome as convenio, pacientes.matricula 
    FROM pacientes JOIN convenios ON pacientes.id_convenio=convenios.id";
    if ($c_pesquisa != ' ') {
        $c_sql_pac = $c_sql_pac . " where pacientes.nome LIKE " .  "'" . $c_pesquisa . "%'";
    }
    $c_sql_pac = $c_sql_pac . " order by pacientes.nome";

    $result_pac = $conection->query($c_sql_pac);
    // verifico se a query foi correto
    if (!$result_pac) {
        die("Erro ao Executar Sql!!" . $conection->connect_error);
    }
}
$c_sql2 = "";
$c_dia_semana = "-";
$c_mostradata = date("Y-m-d");

if ((isset($_POST["btnagenda"])) && ($_SERVER['REQUEST_METHOD'] == 'POST')) {  // botão para executar sql de pesquisa na agenda
    // pego a id do profissional selecionado
    $c_mostradata = date("Y-m-d");
    $c_profissional = $_POST['profissional'];
    $c_sql_prof = "select profissionais.id from profissionais where nome = '$c_profissional'";
    $result = $conection->query($c_sql_prof);
    $c_linha = $result->fetch_assoc();
    $i_id_profissional = $c_linha['id'];
    $d_data = $_POST['data1'];
    $d_data = date("Y-m-d", strtotime(str_replace('/', '-', $d_data)));
    $_SESSION['dataextra'] = $d_data;
    $_SESSION['id_profextra'] = $i_id_profissional;

    $c_dia_semana = date('w', strtotime($d_data));
    switch ($c_dia_semana) {
        case "1":
            $c_dia_semana = 'Segunda-Feira';
            break;
        case "2":
            $c_dia_semana = 'Terça-Feira';
            break;
        case "3":
            $c_dia_semana = 'Quarta-Feira';
            break;
        case "4":
            $c_dia_semana = 'Quinta-Feira';
            break;
        case "5":
            $c_dia_semana = 'Sexta-Feira';
            break;
        case "6":
            $c_dia_semana = 'Sábado';
            break;
        case "7":
            $c_dia_semana = 'Domingo';
            break;
    }
    $c_sql2 = "SELECT agenda.id_profissional, agenda.id, agenda.id_convenio,
    agenda.`data`, agenda.dia, agenda.horario,
    agenda.nome, agenda.telefone, agenda.email, convenios.nome as convenio, agenda.observacao, agenda.matricula FROM agenda 
    JOIN convenios ON agenda.id_convenio=convenios.id
    WHERE id_profissional='$i_id_profissional' AND DATA = '$d_data' ORDER BY horario";
    $result2 = $conection->query($c_sql2);
}
?>

<!-- front end da agenda -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SmartMed - Sistema Médico</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" type="imagex/png" href="./images/smed_icon.ico">

    <script scr="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script scr="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>

    <!-- script para mascara de telefone -->
    <script>
        const handlePhone = (event) => {
            let input = event.target
            input.value = phoneMask(input.value)
        }

        const phoneMask = (value) => {
            if (!value) return ""
            value = value.replace(/\D/g, '')
            value = value.replace(/(\d{2})(\d)/, "($1) $2")
            value = value.replace(/(\d)(\d{4})$/, "$1-$2")
            return value
        }
    </script>

</head>

<body>
    <!-- funcao para chamar rotina para incluir paciente através da marcação de agenda -->
    <script>
        function incluir(id) {
            var resposta = confirm("Deseja confirmar essa inclusão?");
            if (resposta == true) {
                window.location.href = "/smedweb/paciente_agenda.php?id=" + id;
            }
        }
    </script>

    <!-- funcao para chamar rotina para desmacar marcação de agenda -->
    <script language="Javascript">
        function desmarca(id) {
            var resposta = confirm("Deseja desmarcar essa marcação?");
            if (resposta == true) {
                window.location.href = "/smedweb/agenda_desmarcar.php?id=" + id;
            }
        }
    </script>
    <!-- funcao para chamar rotina para colar marcação de agenda -->
    <script>
        function colar(id) {
            window.location.href = "/smedweb/agenda_colar.php?id=" + id;
        }
    </script>
    <!-- funcao para chamar rotina para cortar registro marcação de agenda -->
    <script>
        function cortar(id) {
            window.location.href = "/smedweb/agenda_recorta.php?id=" + id;
        }
    </script>

    <script>
        $(document).ready(function() {
            $('.tabagenda').DataTable({
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
                $('#up_horarioField').val(data[1]);
                $('#up_nomeField').val(data[2]);
                $('#up_matriculaField').val(data[3]);
                $('#up_convenioField').val(data[4]);
                $('#up_telefoneField').val(data[5]);
                $('#up_emailField').val(data[6]);
                $('#up_obsField').val(data[7]);
            });
        });
    </script>

    <script type="text/javascript">
        // Função javascript e ajax para Alteração dos dados
        $(document).on('submit', '#frmadd', function(e) {
            e.preventDefault();
            var c_id = $('#up_idField').val();
            var c_horario = $('#up_horarioField').val();
            var c_nome = $('#up_nomeField').val();
            var c_matricula = $('#up_matriculaField').val();
            var c_convenio = $('#up_convenioField').val();
            var c_telefone = $('#up_telefoneField').val()
            var c_email = $('#up_emailField').val();
            var c_obs = $('#up_obsField').val();

            if (c_nome != '') {

                $.ajax({
                    url: "agenda_marcacao.php",
                    type: "post",
                    data: {
                        c_id: c_id,
                        c_horario: c_horario,
                        c_nome: c_nome,
                        c_matricula: c_matricula,
                        c_convenio: c_convenio,
                        c_telefone: c_telefone,
                        c_email: c_email,
                        c_obs: c_obs

                    },
                    success: function(data) {
                        var json = JSON.parse(data);
                        var status = json.status;
                        if (status == 'true') {
                            $('#editmodal').modal('hide');
                            location.reload();
                        } else {
                            alert('falha ao alterar dados');
                        }
                    }
                });

            } else {
                alert('Todos os campos com (*) devem ser preenchidos!!');
            }

        });
    </script>

    <div class="panel panel-primary class">
        <div class="panel-heading text-center">
            <h4>SmartMed - Sistema Médico</h4>
            <h5>Agenda Médica do Sistema<h5>
        </div>
    </div>
    <?php
    if (isset($d_data)) {
        $c_mostradata = date("d-m-y", strtotime(str_replace('/', '-', $d_data)));
    }
    ?>
    <div class="container-fluid">

        <!-- Formulário com as datas -->
        <form method="post">
            <label class="col-md-2 form-label">Data da agenda</label>
            <div class="col-sm-2">
                <input type="Date" maxlength="10" class="form-control" name="data1" id="data1" value=<?php echo $c_mostradata; ?> onkeypress="mascaraData(this)">
            </div>
            <button type="submit" return false name='btnagenda' id='btnagenda' class="btn btn-primary"><img src="\smedweb\images\buscar.png" alt="" width="20" height="20"></span> Consultar</button>
            <a class='btn btn-info' title="Voltar ao menu" href='/smedweb/menu.php'> <img src="\smedweb\images\voltar.png" alt="" width="15" height="15"> Voltar</a>
            <br>
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
        </form>

        <!-- abas de agenda e cadstro de pacientes -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#agenda" aria-controls="home" role="tab" data-toggle="tab">Horários da Agenda</a></li>
            <li role="presentation"><a href="#cadastro" aria-controls="cadastro" role="tab" data-toggle="tab">Cadastro de Pacientes</a></li>

        </ul>
        <!-- aba da agenda-->
        <div class="tab-content">

            <div role="tabpanel" class="tab-pane active" id="agenda">
                <div style="padding-top:5px;">
                    <div class="panel panel-info">
                        <div class="panel-heading text-left">
                            <?php
                            if (isset($d_data)) {

                                echo "
                            <h5>Agenda de  $c_profissional | $c_dia_semana  $c_mostradata <h5>
                            ";
                            }
                            ?>
                        </div>
                    </div>

                    <hr>
                    <!-- montagem da tabela de agenda -->
                    <table class="table display  tabagenda">
                        <thead class="thead">
                            <tr class="info">
                                <th scope="col">No.</th>
                                <th scope="col">Horário</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Matricula</th>
                                <th scope="col">Convênio</th>
                                <th scope="col">Telefone</th>
                                <th scope="col">e-mail</th>
                                <th scope="col">Observação</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            // loop para dados da agenda
                            if (!empty($c_sql2)) {

                                while ($c_linha2 = $result2->fetch_assoc()) {

                                    echo "
                                    <tr>
                                    <td>$c_linha2[id]</td>
                                    <td>$c_linha2[horario]</td>
                                    <td>$c_linha2[nome]</td>
                                    <td>$c_linha2[matricula]</td>
                                    <td>$c_linha2[convenio]</td>
                                    <td>$c_linha2[telefone]</td>
                                    <td>$c_linha2[email]</td>
                                    <td>$c_linha2[observacao]</td>
                                    <td>
                                    
                                   <button class='btn btn-light btn-sm editbtn' data-toggle=modal' data-target='#editmodal' title='Marcação de consulta'><img src='\smedweb\images\calendario.png' alt='' width='15' height='15'> Marcação</button>
                                   <button name='btnincluir' onclick='incluir($c_linha2[id])' id='btnincluir' class='btn btn-light'><span class='glyphicon glyphicon-save-file'></span> Incluir</button>
                                   <button name='btncorta' onclick='cortar($c_linha2[id])' id='btncorta' class='btn btn-light'><img src='\smedweb\images\corta.png' alt='' width='15' height='15'> Cortar</button>
                                   <button name='btncola' onclick='colar($c_linha2[id])' id='btncola' class='btn btn-light'><img src='\smedweb\images\copiar.png' alt='' width='15' height='15'> Colar</button>
                                   <a class='btn btn-light btn-sm' title='Desmarcar consulta' href='javascript:func()'onclick='desmarca($c_linha2[id])'>
                                   <img src='\smedweb\images\borracha.png' alt='' width='15' height='15'> Desmarcar</a>
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
            <!-- aba com o cadastro de pacientes -->
            <div role="tabpanel" class="tab-pane" id="cadastro">
                <div style="padding-top:20px;">
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
                    <!-- tabela de pacientes -->
                    <table class="table display table-bordered tabpacientes">
                        <thead class="thead">
                            <tr class="info">
                                <th scope="col" style="display:none">Número</th>
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
                            if (!empty($c_sql_pac)) {
                                // insiro os registro do banco de dados na tabela 
                                while ($c_linha_pac = $result_pac->fetch_assoc()) {
                                    // Coloco string masculino ou feminino ao invés de m ou f
                                    if ($c_linha_pac['sexo'] == 'M') {
                                        $c_sexo = "Masculino";
                                    } else {
                                        $c_sexo = "Feminino";
                                    }
                                    echo "
                    <tr>
                    <td style='display:none'>$c_linha_pac[id] </td>
                    <td>$c_linha_pac[nome]</td>
                    <td>$c_linha_pac[convenio]</td>
                    <td>$c_linha_pac[matricula]</td>
                    <td>$c_sexo</td>
                    <td>$c_linha_pac[fone]</td>
                    <td>$c_linha_pac[fone2]</td>
                                     
                    <td>
                                                  
                        <a class='btn btn-secondary' title='Copiar Dados'
                        href='/smedweb/agenda_copia.php?id=$c_linha_pac[id]'><img src='\smedweb\images\copiar.png'alt='' width='15' height='15'> Copiar</a>
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
        </div>
    </div>

    <!-- janela Modal para marcação de consulta -->
    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="editmodal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Agênda Médica</h4>
                </div>
                <div class="modal-body">
                    <div class='alert alert-warning' role='alert'>
                        <h5>Campos com (*) são obrigatórios</h5>
                    </div>
                    <form id="frmadd" method="POST" action="">
                        <input type="hidden" id="up_idField" name="up_idField">
                        <div class="mb-3 row">
                            <label for="up_horarioField" class="col-md-3 form-label">Horário</label>
                            <div class="col-md-4">
                                <input type="time" readonly class="form-control" id="up_horarioField" name="up_horarioField">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="up_nomeField" class="col-md-3 form-label">Nome (*) </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="up_nomeField" name="up_nomeField">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="up_matriculaField" class="col-md-3 form-label">Matricula </label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="up_matriculaField" name="up_matriculaField">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Convênio </label>
                            <div class="col-sm-6">
                                <select class="form-control form-control-lg" id="up_convenioField" name="up_convenioField">
                                    <?php
                                    $c_sql3 = "SELECT convenios.id, convenios.nome FROM convenios ORDER BY convenios.nome";
                                    $result3 = $conection->query($c_sql3);
                                    // insiro os registro do banco de dados na tabela 
                                    while ($c_linha3 = $result3->fetch_assoc()) {

                                        echo "
                                        <option $c_op>$c_linha3[nome]</option>";
                                    }
                                    ?>
                                </select>

                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Telefone </label>
                            <div class="col-sm-4">
                                <input type="tel" maxlength="25" onkeyup="handlePhone(event)" class=" form-control" id="up_telefoneField" name="up_telefoneField">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">E-mail</label>
                            <div class="col-sm-9">
                                <input type="text" maxlength="225" class="form-control" id="up_emailField" name="up_emailField">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Observações</label>
                            <div class="col-sm-9">
                                <input type="text" maxlength="100" class="form-control" id="up_obsField" name="up_obsField">
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><span class='glyphicon glyphicon-floppy-saved'></span> Confirmar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class='glyphicon glyphicon-remove'></span> Fechar</button>
                </div>
                </form>
            </div>
        </div>
    </div>




</body>

</html>