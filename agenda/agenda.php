<?php
////////////////////////////////////////////////////////////
// rotina principal da agenda médica
///////////////////////////////////////////////////////////
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

include("../conexao.php");
include("../links.php");
include_once "../lib_gop.php";
date_default_timezone_set('America/Sao_Paulo');

//  rotina para sql de pacientes no post
$c_sql_pac = "";
$_SESSION['dataextra'] = "";
$_SESSION['id_profextra'] = "";
$_SESSION['incagenda'] = true;
// controle de acesso para o usuário
$c_login = $_SESSION['c_usuario'];
$c_sql = "SELECT usuario.id,usuario.tipo,agenda_marcacao,agenda_incluir,agenda_remanejar,agenda_desmarcar
          FROM usuario
		  JOIN perfil_usuarios_opcoes ON usuario.id_perfil=perfil_usuarios_opcoes.id
		  where usuario.login='$c_login'";
$result = $conection->query($c_sql);
// verifico se a query foi correto
if (!$result) {
    die("Erro ao Executar Sql !!" . $conection->connect_error);
}
$c_linha = $result->fetch_assoc();
// marcação
if (($c_linha['agenda_marcacao'] == 'S') || ($c_linha['tipo'] == '1')) {
    $op_marcacao = "S";
} else {
    $op_marcacao = "N";
}
// inclusão de paciente
if (($c_linha['agenda_incluir'] == 'S') || ($c_linha['tipo'] == '1')) {
    $op_incluir = "S";
} else {
    $op_incluir = "N";
}
// desmarcar paciente na agenda
if (($c_linha['agenda_desmarcar'] == 'S') || ($c_linha['tipo'] == '1')) {
    $op_desmarcar = "S";
} else {
    $op_desmarcar = "N";
}
// remanejar paciente na agenda
if (($c_linha['agenda_remanejar'] == 'S') || ($c_linha['tipo'] == '1')) {
    $op_remanejar = "S";
} else {
    $op_remanejar = "N";
}
// executo query se já foi escolhido médico e data
if ($_SESSION['sql'] != '') {
    $c_sql2 = $_SESSION['sql'];
    $result2 = $conection->query($c_sql2);

    // verifico se a query foi correto
    if (!$result2) {
        die("Erro ao Executar Sql !!" . $conection->connect_error);
    }
} else {
    $c_sql2 = "";
}
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
    // mudo a aba para cadastro de pacientes
    $_SESSION['aba_agenda'] = 2;
}
//$c_sql2 = "";
//$c_sql3 = "";
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
        case "0":
            $c_dia_semana = 'Domingo';
            break;
    }
    $c_sql2 = "SELECT agenda.id_profissional, agenda.id, agenda.id_convenio,
    agenda.`data`, agenda.dia, agenda.horario,
    agenda.nome, agenda.telefone, agenda.email, convenios.nome as convenio, agenda.observacao, agenda.matricula,
    agenda.paciente_compareceu, agenda.paciente_atendido, agenda.paciente_novo FROM agenda 
    JOIN convenios ON agenda.id_convenio=convenios.id
    WHERE id_profissional='$i_id_profissional' AND DATA = '$d_data' ORDER BY horario";
    $result2 = $conection->query($c_sql2);
    $_SESSION['sql'] = $c_sql2;
}

// pesquisa de histórico de agenda 
if ((isset($_POST["btnpesquisa_historico"])) && ($_SERVER['REQUEST_METHOD'] == 'POST')) {  // botão para executar sql de pesquisa de agenda

    $c_pesquisa_historico = $_POST['pesquisa_historico'];
    $c_sql3 = "SELECT agenda.id_profissional, agenda.id, agenda.id_convenio,
    agenda.`data`, agenda.dia, agenda.horario,
    agenda.nome, agenda.telefone, agenda.email, convenios.nome as convenio, agenda.observacao, agenda.matricula, profissionais.nome as medico FROM agenda 
    JOIN convenios ON agenda.id_convenio=convenios.id
    JOIN profissionais on agenda.id_profissional=profissionais.id";
    $c_sql3 = $c_sql3 . " where agenda.nome LIKE " .  "'" . $c_pesquisa_historico . "%'";
    $c_sql3 = $c_sql3 . " ORDER BY agenda.data,agenda.horario";
    $result3 = $conection->query($c_sql3);
    // verifico se a query foi correto
    if (!$result3) {
        die("Erro ao Executar Sql!!" . $conection->connect_error);
    }
}
?>

<!-- front end da agenda -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    <!-- função para chamar marcação -->
    <script>
        function marcacao(id) {

            var acesso = $('#input_marcacao').val();
            if (acesso == 'S') {
                $(document).ready(function() {
                    const c_chk_compareceu = document.getElementById('chk_compareceu');
                    const c_chk_novopaciente = document.getElementById('chk_novopaciente');
                    const c_chk_atendido = document.getElementById('chk_atendido');
                    var c_valor_compareceu;
                    var c_valor_novo;
                    var c_valor_atendido;
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
                        $('#up_compareceu').val(data[9]);
                        $('#up_atendido').val(data[10]);
                        $('#up_novo').val(data[8]);


                    });

                    c_valor_novo = document.getElementById('up_novo').value;
                    if (c_valor_novo == 'Sim') {
                        c_chk_novopaciente.checked = true;
                    } else {
                        c_chk_novopaciente.checked = false;
                    }
                    c_valor_compareceu = document.getElementById('up_compareceu').value;
                    if (c_valor_compareceu == 'Sim') {
                        c_chk_compareceu.checked = true;
                    } else {
                        c_chk_compareceu.checked = false;
                    }
                    c_valor_atendido = document.getElementById('up_atendido').value;
                    if (c_valor_atendido == 'Sim') {
                        c_chk_atendido.checked = true;
                    } else {
                        c_chk_atendido.checked = false;
                    }

                });
            } else {
                alert('Acesso não autorizado para o usuário, consulte o administrador do Sistema!!!');
            }
        }
    </script>
    <!-- funcao para chamar rotina para incluir paciente através da marcação de agenda -->
    <script>
        function incluir(id) {
            var resposta = confirm("Deseja confirmar essa inclusão?");
            var acesso = $('#input_incluir').val();
            if (resposta == true) {
                if (acesso == "S") {
                    window.location.href = "/smedweb/paciente_agenda.php?id=" + id;
                } else {
                    alert('Acesso não autorizado para o usuário, consulte o administrador do Sistema!!!');
                }
            }
        }
    </script>

    <!-- funcao para chamar rotina para desmacar marcação de agenda -->
    <script language="Javascript">
        function desmarca(id) {
            var resposta = confirm("Deseja desmarcar essa agenda?");
            var acesso = $('#input_desmarcar').val();
            if (resposta == true) {
                if (acesso == "S") {
                    window.location.href = "/smedweb/agenda/agenda_desmarcar.php?id=" + id;
                } else {
                    alert('Acesso não autorizado para o usuário, consulte o administrador do Sistema!!!');
                }
            }
        }
    </script>
    <!-- funcao para chamar rotina para colar marcação de agenda -->
    <script>
        var acesso = $('#input_remanejar').val();

        function colar(id) {
            var acesso = $('#input_remanejar').val();
            if (acesso == "S") {
                window.location.href = "/smedweb/agenda/agenda_colar.php?id=" + id;
            } else {
                alert('Acesso não autorizado para o usuário, consulte o administrador do Sistema!!!');
            }
        }
    </script>
    <!-- funcao para chamar rotina para cortar registro marcação de agenda -->
    <script>
        function cortar(id) {
            var acesso = $('#input_remanejar').val();
            var resposta = confirm("Confirma Operação?");
            if (resposta == true) {
                if (acesso == "S") {
                    window.location.href = "/smedweb/agenda/agenda_recorta.php?id=" + id;
                } else {
                    alert('Acesso não autorizado para o usuário, consulte o administrador do Sistema!!!');
                }
            }

        }
    </script>
    <!-- funcao para chamar rotina para enviar email -->
    <script>
        function email(id) {
            var acesso = $('#input_marcacao').val();
            //confirmação de envio
            var resposta = confirm("Confirma o envio do e-mail?");
            if (resposta == false) {
                return false;
            }
            if (acesso == "S") {
                window.location.href = "/smedweb/agenda/agenda_email.php?id=" + id;
            } else {
                alert('Acesso não autorizado para o usuário, consulte o administrador do Sistema!!!');
            }
        }
    </script>

    <script>
        $(document).ready(function() {
            $('.tabagenda').DataTable({
                // 
                "iDisplayLength": 5,
                "order": [1, 'asc'],
                "aoColumnDefs": [{
                    'bSortable': false,
                    'aTargets': [0, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
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

    <script type="text/javascript">
        // Função javascript e ajax para ageda marcação
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
            var c_compareceu = $('#chk_compareceu').is(':checked') ? 'Sim' : 'Não';
            var c_novopaciente = $('#chk_novopaciente').is(':checked') ? 'Sim' : 'Não';
            var c_atendido = $('#chk_atendido').is(':checked') ? 'Sim' : 'Não';

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
                        c_obs: c_obs,
                        c_compareceu: c_compareceu,
                        c_novopaciente: c_novopaciente,
                        c_atendido: c_atendido

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
            <input type="hidden" id="input_marcacao" name="input_marcacao" value="<?php echo $op_marcacao; ?>">
            <input type="hidden" id="input_incluir" name="input_incluir" value="<?php echo $op_incluir; ?>">
            <input type="hidden" id="input_desmarcar" name="input_desmarcar" value="<?php echo $op_desmarcar; ?>">
            <input type="hidden" id="input_remanejar" name="input_remanejar" value="<?php echo $op_remanejar; ?>">
            <div class="row mb-3">
                <label class="col-md-1 form-label">Data da agenda</label>
                <div class="col-sm-2">
                    <input type="Date" maxlength="10" class="form-control" name="data1" id="data1" value=<?php echo $c_mostradata; ?> onkeypress="mascaraData(this)">
                </div>
                <label class="col-sm-1 col-form-label">Profissional</label>
                <div class="col-sm-2">
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
                <button type="submit" return false name='btnagenda' id='btnagenda' class="btn btn-primary"><img src="\smedweb\images\buscar.png" alt="" width="20" height="20"></span> Consultar</button>&nbsp;
                <a class='btn btn-info' title="Voltar ao menu" href='/smedweb/menu.php'> <img src="\smedweb\images\voltar.png" alt="" width="20" height="20"> Voltar</a>
            </div>
            <hr>

    </div>
    <!-- abas de agenda e cadstro de pacientes -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#agenda" aria-controls="home" role="tab" data-toggle="tab">Horários da Agenda</a></li>
        <li role="presentation"><a href="#cadastro" aria-controls="cadastro" role="tab" data-toggle="tab">Cadastro de Pacientes</a></li>
        <li role="presentation"><a href="#historico" aria-controls="historico" role="tab" data-toggle="tab">Histórico Agendamento</a></li>
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
                            <h4>Agenda de  $c_profissional | $c_dia_semana  $c_mostradata <h4>
                            ";
                        }
                        ?>
                    </div>
                </div>

                <hr>
                <!-- montagem da tabela de agenda -->
                <table class="table display table-striped table-bordered tabagenda">
                    <thead class="thead">
                        <tr class="info">
                            <th scope="col" style="width: 3px;"></th>
                            <th scope="col">Horário</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Matricula</th>
                            <th scope="col">Convênio</th>
                            <th scope="col">Telefone</th>
                            <th scope="col">e-mail</th>
                            <th scope="col">Observação</th>
                            <th scope="col">Novo</th>
                            <th scope="col">Compareceu</th>
                            <th scope="col">Atendido</th>
                            <th scope="col">Ações</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        // loop para dados da agenda
                        if (!empty($c_sql2)) {

                            while ($c_linha2 = $result2->fetch_assoc()) {
                                if ($c_linha2['convenio'] == 'Selecionar') {
                                    $c_linha2['convenio'] = '';
                                }
                                // coloco cor para novo paciente
                                if ($c_linha2['paciente_novo'] == 'Sim') {
                                   $c_cor_novo = "class='text-success'";
                                } if ($c_linha2['paciente_novo'] == 'Não')
                                {
                                    $c_cor_novo = "class='text-primary'";
                                }
                                if ($c_linha2['paciente_novo'] == '')
                                {
                                    $c_cor_novo = "";
                                }
                                // coloco cor para paciente que compareceu
                                if ($c_linha2['paciente_compareceu'] == 'Sim') {
                                    $c_cor_compareceu = "class='text-success'";
                                } if ($c_linha2['paciente_compareceu'] == 'Não') {
                                    $c_cor_compareceu = "class='text-warning'";
                                }
                                if ($c_linha2['paciente_compareceu'] == '') {
                                    $c_cor_compareceu = "";
                                }
                                // coloco cor para paciente que foi atendido
                                if ($c_linha2['paciente_atendido'] == 'Sim') {
                                    $c_cor_atendido = "class='text-success'";
                                } if ($c_linha2['paciente_atendido'] == 'Não') {
                                    $c_cor_atendido = "class='text-warning'";
                                }
                                if ($c_linha2['paciente_atendido'] == '') {
                                    $c_cor_atendido = "";
                                }
                                echo "
                                    <tr>
                                    <td  style='width: 3px;' class='some'>$c_linha2[id]</td>
                                    <td>$c_linha2[horario]</td>
                                    <td>$c_linha2[nome]</td>
                                    <td>$c_linha2[matricula]</td>
                                    <td>$c_linha2[convenio]</td>
                                    <td>$c_linha2[telefone]</td>
                                    <td>$c_linha2[email]</td>
                                    <td>$c_linha2[observacao]</td>
                                    <td $c_cor_novo style='text-align: center;' class='h4'>$c_linha2[paciente_novo]</td>
                                    <td $c_cor_compareceu style='text-align: center;' class='h4'>$c_linha2[paciente_compareceu]</td>
                                    <td $c_cor_atendido style='text-align: center;' class='h4'>$c_linha2[paciente_atendido]</td>
                                    <td>
                                   <button type='button' class='btn btn-light btn-sm editbtn' data-toggle=modal data-target='#editmodal' title='Marcação de consulta' onclick='marcacao($c_linha2[id])'><img src='\smedweb\images\calendario.png' alt='' width='15' height='15'> Marcação</button>
                                   <button type='button' name='btnincluir' onclick='incluir($c_linha2[id])' id='btnincluir' class='btn btn-light'><span class='glyphicon glyphicon-save-file'></span> Incluir</button>
                                   <button type='button' name='btncorta' onclick='cortar($c_linha2[id])' id='btncorta' class='btn btn-light'><img src='\smedweb\images\corta.png' alt='' width='15' height='15'> Cortar</button>
                                   <button type='button' name='btncola' onclick='colar($c_linha2[id])' id='btncola' class='btn btn-light'><img src='\smedweb\images\copiar.png' alt='' width='15' height='15'> Colar</button>
                                   <a class='btn btn-light btn-sm' title='Desmarcar consulta' href='javascript:func()'onclick='desmarca($c_linha2[id])'>
                                   <img src='\smedweb\images\borracha.png' alt='' width='15' height='15'> Desmarcar</a>
                                   <button type='button' name='btnemail' onclick='email($c_linha2[id])' id='btnemail' class='btn btn-light'><img src='\smedweb\images\o-email.png' alt='' width='15' height='15'> e-mail</button>
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

                <!-- tabela de pacientes -->
                <table class="table display table-bordered tabpacientes">
                    <thead class="thead">
                        <tr class="info">
                            <th scope="col" class="some" style="display:none">Número</th>
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
                                                  
                        <a class='btn btn-light' title='Copiar Dados'
                        href='/smedweb/agenda/agenda_copia.php?id=$c_linha_pac[id]'><img src='\smedweb\images\copiar.png'alt='' width='15' height='15'> Copiar</a>
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
        <!-- aba com o historico da agenda -->
        <div role="tabpanel" class="tab-pane" id="historico">
            <div style="padding-top:20px;">

                <div class="mb-5 row">
                    <hr>
                    <label for="up_parametroField" class="col-md-3 form-label">Nome para pesquisar</label>

                    <div class="col-md-7">
                        <input type="text" class="form-control" id="pesquisa_historico" name="pesquisa_historico">

                    </div>
                    <div class="col-md-2">
                        <button type="submit" id='bntpesquisa_historico' name='btnpesquisa_historico' class="btn btn-primary"><img src='\smedweb\images\pesquisapessoas.png' alt='' width='20' height='20'></span> Pesquisar</button>
                    </div>
                </div>

                <!-- montagem da tabela de histórico agenda -->
                <table class="table display tabagendahistorico">
                    <thead class="thead">
                        <tr class="info">
                            <th scope="col">Data</th>
                            <th scope="col">Horário</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Profissional</th>
                            <th scope="col">Matricula</th>
                            <th scope="col">Convênio</th>
                            <th scope="col">Telefone</th>
                            <th scope="col">e-mail</th>
                            <th scope="col">Observação</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // loop para dados da agenda historico
                        if (!empty($c_sql3)) {
                            while ($c_linha3 = $result3->fetch_assoc()) {
                                $c_data = date("d-m-y", strtotime(str_replace('/', '-', $c_linha3['data'])));
                                echo "
                                    <tr>
                                    <td>$c_data</td>
                                    <td>$c_linha3[horario]</td>
                                    <td>$c_linha3[nome]</td>
                                    <td>$c_linha3[medico]</td>
                                    <td>$c_linha3[matricula]</td>
                                    <td>$c_linha3[convenio]</td>
                                    <td>$c_linha3[telefone]</td>
                                    <td>$c_linha3[email]</td>
                                    <td>$c_linha3[observacao]</td>
                                    </tr>
                                    ";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        </form>
    </div>



    <!-- janela Modal para marcação de consulta -->

    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="editmodal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Agênda Médica - Marcação</h4>
                </div>
                <div class="modal-body">
                    <div class='alert alert-warning' role='alert'>
                        <h5>Campos com (*) são obrigatórios</h5>
                    </div>
                    <form id="frmadd" method="POST" action="">
                        <input type="hidden" id="up_idField" name="up_idField">
                        <input type="hidden" id="up_novo" name="up_novo">
                        <input type="hidden" id="up_atendido" name="up_atendido">
                        <input type="hidden" id="up_compareceu" name="up_compareceu">
                        <div class="mb-3 row">
                            <label for="up_horarioField" class="col-md-3 form-label">Horário</label>
                            <div class="col-md-4">
                                <input type="time" readonly class="form-control" id="up_horarioField" name="up_horarioField">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="up_nomeField" class="col-md-3 form-label">Nome (*) </label>
                            <div class="col-md-9">
                                <input type="text" required class="form-control" id="up_nomeField" name="up_nomeField">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="up_matriculaField" class="col-md-3 form-label">Matricula</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="up_matriculaField" name="up_matriculaField">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Convênio </label>
                            <div class="col-sm-6">
                                <select required class="form-control form-control-lg" id="up_convenioField" name="up_convenioField">
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
                                <input type="tel" required maxlength="25" onkeyup="handlePhone(event)" class=" form-control" id="up_telefoneField" name="up_telefoneField">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">E-mail</label>
                            <div class="col-sm-9">
                                <input type="text" required maxlength="225" class="form-control" id="up_emailField" name="up_emailField">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Observações</label>
                            <div class="col-sm-9">
                                <input type="text" maxlength="100" class="form-control" id="up_obsField" name="up_obsField">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Situação</label>

                        </div>
                        <div class="row mb-3">

                            <!-- checkbox para situação de paciente novo -->
                            <div class="col-sm-6">
                                <div class="form-check">
                                    <div class="col-sm-2">
                                        <input class="form-check-input" type="checkbox" id="chk_novopaciente">
                                    </div>
                                    <label class="form-check-label" for="chk_novopaciente">
                                        Paciente Novo
                                    </label>
                                </div>
                            </div>
                            <br>
                        </div>
                        <div class="row mb-3">
                            <!-- checkbox para situação de paciente comparecimento -->
                            <div class="col-sm-6">
                                <div class="form-check">
                                    <div class="col-sm-2">
                                        <input class="form-check-input" type="checkbox" name="chk_compareceu" id="chk_compareceu">
                                    </div>
                                    <label class="form-check-label" for="chk_compareceu">
                                        Paciente Compareceu
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <!-- checkbox para situação de paciente foi atendido -->
                            <div class="col-sm-6">
                                <div class="form-check">
                                    <div class="col-sm-2">
                                        <input class="form-check-input" type="checkbox" id="chk_atendido">
                                    </div>
                                    <label class="form-check-label" for="chk_atendido">
                                        Paciente foi atendido
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><span class='glyphicon glyphicon-floppy-saved'></span> Confirmar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>



</html>

<style>
    .some {
        visibility: collapse;
    }
</style>