<?php
session_start();
//if (!isset($_SESSION['newsession'])) {
//    die('Acesso não autorizado!!!');
//}
//if ($_SESSION['c_tipo'] != '1') {
//    header('location: /raxx/voltamenunegado.php');
//}
include("../conexao.php");
include("../links.php");
// zerar variaveis de sessão
$_SESSION['atestado'] = "";
$_SESSION['formula'] = "";
$_SESSION['medicamento'] = "";
$_SESSION['laudo'] = "";
$_SESSION['orientacao'] = "";
$_SESSION['relatorio'] = "";

// query para capturar perfil do usuário logado
$c_login = $_SESSION['c_usuario'];
$c_sql = "SELECT usuario.id,usuario.tipo,
              prescricao,prescricao_atestado,prescricao_formula,prescricao_medicamento, prescricao_laudos,prescricao_orientacao,
              prescricao_relatorio, prescricao_configuracao
              FROM usuario
			  JOIN perfil_usuarios_opcoes ON usuario.id_perfil=perfil_usuarios_opcoes.id
			  where usuario.login='$c_login'";
$result = $conection->query($c_sql);
// verifico se a query foi correto
if (!$result) {
    die("Erro ao Executar Sql !!" . $conection->connect_error);
}
$c_linha = $result->fetch_assoc();
///////////////////////////////////////////////////////////////
// permissões das opções de entrada no menu
//////////////////////////////////////////////////////////////
// atestados
if (($c_linha['prescricao_atestado'] == 'S') || ($c_linha['tipo'] == '1')) {
    $op_atestado = "S";
} else {
    $op_atestado = "N";
}
// formulas
if (($c_linha['prescricao_formula'] == 'S') || ($c_linha['tipo'] == '1')) {
    $op_formula = "S";
} else {
    $op_formula = "N";
}
// prescrição de medicamentos
if (($c_linha['prescricao_medicamento'] == 'S') || ($c_linha['tipo'] == '1')) {
    $op_medicamento = "S";
} else {
    $op_medicamento = "N";
}
// prescrição de medicamentos
if (($c_linha['prescricao_laudos'] == 'S') || ($c_linha['tipo'] == '1')) {
    $op_laudo = "S";
} else {
    $op_laudo = "N";
}
// prescrição de orientações
if (($c_linha['prescricao_orientacao'] == 'S') || ($c_linha['tipo'] == '1')) {
    $op_orientacao = "S";
} else {
    $op_orientacao = "N";
}
// prescrição de relatório
if (($c_linha['prescricao_relatorio'] == 'S') || ($c_linha['tipo'] == '1')) {
    $op_relatorio = "S";
} else {
    $op_relatorio = "N";
}


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

    <!-- função para chamar atestados -->
    <script>
        function atestado(id) {
            var acesso = $('#input_atestado').val();
            if (acesso == 'S') {
                window.location.href = "/smedweb/prescricoes/atestado.php?id=" + id;
            } else {
                alert('Acesso não autorizado para o usuário, consulte o administrador do Sistema!!!');
            }
        }
    </script>
    <!-- função para chamar formula -->
    <script>
        function formula(id) {
            var acesso = $('#input_formula').val();
            if (acesso == 'S') {
                window.location.href = "/smedweb/prescricoes/prescricao_formulas.php?id=" + id;
            } else {
                alert('Acesso não autorizado para o usuário, consulte o administrador do Sistema!!!');
            }
        }
    </script>
    <!-- função para chamar prescrição de medicamentos -->
    <script>
        function medicamento(id) {
            var acesso = $('#input_medicamento').val();
            if (acesso == 'S') {
                window.location.href = "/smedweb/prescricoes/prescricao_medicamentos.php?id=" + id;
            } else {
                alert('Acesso não autorizado para o usuário, consulte o administrador do Sistema!!!');
            }
        }
    </script>
   
    <!-- função para chamar prescrição de Laudos -->
    <script>
        function laudo(id) {
            var acesso = $('#input_laudo').val();
            if (acesso == 'S') {
                window.location.href = "/smedweb/prescricoes/prescricoes_laudos.php?id=" + id;
            } else {
                alert('Acesso não autorizado para o usuário, consulte o administrador do Sistema!!!');
            }
        }
    </script>
    <!-- função para chamar prescrição de orientações -->
    <script>
        function orientacao(id) {
            var acesso = $('#input_orientacao').val();
            if (acesso == 'S') {
                window.location.href = "/smedweb/prescricoes/prescricao_orientacoes.php?id=" + id;
            } else {
                alert('Acesso não autorizado para o usuário, consulte o administrador do Sistema!!!');
            }
        }
    </script>
    <!-- função para chamar prescrição de relatórios -->
    <script>
        function relatorio(id) {
            var acesso = $('#input_relatorio').val();
            if (acesso == 'S') {
                window.location.href = "/smedweb/prescricoes/prescricao_relatorio.php?id=" + id;
            } else {
                alert('Acesso não autorizado para o usuário, consulte o administrador do Sistema!!!');
            }
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
    <div class="container-fluid -my5">

        <form id="frmpaciente" method="POST" action="">
            <input type="hidden" id="input_atestado" name="input_atestado" value="<?php echo $op_atestado; ?>">
            <input type="hidden" id="input_formula" name="input_formula" value="<?php echo $op_formula; ?>">
            <input type="hidden" id="input_medicamento" name="input_medicamento" value="<?php echo $op_medicamento; ?>">
            <input type="hidden" id="input_laudo" name="input_laudo" value="<?php echo $op_laudo; ?>">
            <input type="hidden" id="input_orientacao" name="input_orientacao" value="<?php echo $op_orientacao; ?>">
            <input type="hidden" id="input_relatorio" name="input_relatorio" value="<?php echo $op_relatorio; ?>">
            <!-- pesquisa -->
            <button type="submit" id='bntpesquisa' name='btnpesquisa' class="btn btn-primary"><img src='\smedweb\images\pesquisapessoas.png' alt=''
                    width='20' height='20'></span> Buscar</button>
            <a class="btn btn-info" href="/smedweb/menu.php"><img src='\smedweb\images\voltar.png' alt='' width='20' height='20'> Voltar</a>

            <hr>
            <div class="row mb-3">
                <label for="up_parametroField" class="col-md-2 form-label">Nome para Busca</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="pesquisa" name="pesquisa">
                </div>
            </div>
        </form>
        <br>
        <table  class="table display table-bordered tabpacientes">
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
                    <a class='btn btn-light btn-sm' title='Atestatos' href='javascript:func()'onclick='atestado($c_linha[id])'><img src='\smedweb\images\atestado.png'  width='20' height='20'> Atestados</a>
                    <a class='btn btn-light btn-sm' title='Formulas' href='javascript:func()'onclick='formula($c_linha[id])'><img src='\smedweb\images\as.png' width='20' height='20'> Fórmulas</a>
                    <a class='btn btn-light btn-sm' title='Laudos' href='javascript:func()'onclick='laudo($c_linha[id])'><img src='\smedweb\images\laudo.png' width='20' height='20'> Laudos</a>
                    <a class='btn btn-light btn-sm' title='Medicamentos' href='javascript:func()'onclick='medicamento($c_linha[id])'><img src='\smedweb\images\dio.png' width='20' height='20'> Medicamentos</a>
                    <a class='btn btn-light btn-sm' title='Orientações' href='javascript:func()'onclick='orientacao($c_linha[id])'><img src='\smedweb\images\orientacoes.png' width='20' height='20'> Orientações</a>
                    <a class='btn btn-light btn-sm' title='Relatórios' href='javascript:func()'onclick='relatorio($c_linha[id])'><img src='\smedweb\images\oto.png' width='20' height='20'> Relatórios</a>

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