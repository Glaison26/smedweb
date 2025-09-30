<?php // controle de acesso ao formulário
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}
//if ($_SESSION['c_tipo'] != '1') {
//    header('location: /raxx/voltamenunegado.php');
//}
include("../conexao.php");
include("../links.php");
//include("../config_tabelas.php");

$c_login = $_SESSION['c_usuario'];
$c_sql = "SELECT usuario.id,usuario.tipo,fichaclinica,fichaclinica_editar,fichaclinica_historia,fichaclinica_imagens,
          fichaclinica_eventos,fichaclinica_excluir FROM usuario
	      JOIN perfil_usuarios_opcoes ON usuario.id_perfil=perfil_usuarios_opcoes.id
		  where usuario.login='$c_login'";
$result = $conection->query($c_sql);
// verifico se a query foi correto
if (!$result) {
    die("Erro ao Executar Sql !!" . $conection->connect_error);
}
$c_linha2 = $result->fetch_assoc();
///////////////////////////////////////////////////////////////
// permissões das opções de entrada no menu
//////////////////////////////////////////////////////////////
// ficha de pacientes
if (($c_linha2['fichaclinica_editar'] == 'S') || ($c_linha2['tipo'] == '1')) {
    $op_editar = "S";
} else {
    $op_editar = "N";
}
// historia clinica
if (($c_linha2['fichaclinica_historia'] == 'S') || ($c_linha2['tipo'] == '1')) {
    $op_historia = "S";
} else {
    $op_historia = "N";
}
// imagens
if (($c_linha2['fichaclinica_imagens'] == 'S') || ($c_linha2['tipo'] == '1')) {
    $op_imagem = "S";
} else {
    $op_imagem = "N";
}
// imagens
if (($c_linha2['fichaclinica_eventos'] == 'S') || ($c_linha2['tipo'] == '1')) {
    $op_eventos = "S";
} else {
    $op_eventos = "N";
}
// exclusão de pacientes
if (($c_linha2['fichaclinica_excluir'] == 'S') || ($c_linha2['tipo'] == '1')) {
    $op_excluir = "S";
} else {
    $op_excluir = "N";
}

// primeira entrada
$c_sql = "";
$_SESSION['incagenda'] = false;
// faço a Leitura da tabela de pacientes com sql
    $c_sql = "SELECT pacientes.id, pacientes.nome, pacientes.sexo, pacientes.fone, pacientes.fone2, convenios.nome as convenio, pacientes.matricula 
    FROM pacientes JOIN convenios ON pacientes.id_convenio=convenios.id order by pacientes.nome";

    $result = $conection->query($c_sql);
    // verifico se a query foi correto
    if (!$result) {
        die("Erro ao Executar Sql!!" . $conection->connect_error);
    }


?>

<!doctype html>
<html lang="en">

<body>
     <script>
        $(document).ready(function() {
            $('.tabpacientes').DataTable({
                // 
                "iDisplayLength": 5,
                "order": [1, 'asc'],
                "aoColumnDefs": [{
                    'bSortable': false,
                    'aTargets': [0]
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

    <!-- função para confirmação de exclusão de registro -->
    <script language="Javascript">
        function confirmacao(id) {
            var acesso = $('#input_excluir').val();
            var resposta = confirm("Deseja remover esse registro?");
            if (resposta == true) {
                if (acesso == 'S') {
                    window.location.href = "/smedweb/pacientes/pacientes_excluir.php?id=" + id;
                } else {
                    alert('Acesso não autorizado para o usuário, consulte o administrador do Sistema!!!');
                }
            }
        }
    </script>

    <!-- função para chamar edição de registro -->
    <script>
        function editar(id) {
            var acesso = $('#acesso').val();
            if (acesso == 'S') {
                window.location.href = "/smedweb/pacientes/pacientes_editar.php?id=" + id;
            } else {
                alert('Acesso não autorizado para o usuário, consulte o administrador do Sistema!!!');
            }
        }
    </script>

    <!-- função para chamar historia de paciente -->
    <script>
        function historia(id) {
            var acesso = $('#input_historia').val();
            if (acesso == 'S') {
                window.location.href = "/smedweb/pacientes/historia.php?id=" + id;
            } else {
                alert('Acesso não autorizado para o usuário, consulte o administrador do Sistema!!!');
            }

        }
    </script>

    <!-- função para chamar eventos de paciente -->
    <script>
        function evento(id) {
            var acesso = $('#input_evento').val();
            if (acesso == 'S') {
                window.location.href = "/smedweb/pacientes/eventos.php?id=" + id;
            } else {
                alert('Acesso não autorizado para o usuário, consulte o administrador do Sistema!!!');
            }

        }
    </script>

    <!-- função para chamar imagens de paciente -->
    <script>
        function imagem(id) {
            var acesso = $('#input_imagem').val();
            if (acesso == 'S') {
                window.location.href = "/smedweb/pacientes/imagens.php?id=" + id;
            } else {
                alert('Acesso não autorizado para o usuário, consulte o administrador do Sistema!!!');
            }

        }
    </script>

    <script language="Javascript">
        function mensagem(msg) {
            alert(msg);
        }
    </script>

    <div class="panel panel-primary class">
        <div class="panel-heading text-center">
            <h4>SmartMed - Sistema Médico</h4>
            <h5>Lista de Paciêntes do Sistema<h5>
        </div>
    </div>
    <br>
    <div class="container-fluid">
        <form id="frmpaciente" method="POST" action="">
            <!-- inputs desabilitados para controle de acesso de usuários -->
            <input type="hidden" id="acesso" name="acesso" value="<?php echo $op_editar; ?>">
            <input type="hidden" id="input_historia" name="input_historia" value="<?php echo $op_historia; ?>">
            <input type="hidden" id="input_imagem" name="input_imagem" value="<?php echo $op_imagem; ?>">
            <input type="hidden" id="input_evento" name="input_evento" value="<?php echo $op_eventos; ?>">
            <input type="hidden" id="input_excluir" name="input_excluir" value="<?php echo $op_excluir; ?>">
            <!-- -->
           
            <a class="btn btn-success" href="/smedweb/pacientes/pacientes_novo.php"><span class="glyphicon glyphicon-plus"></span> Incluir</a>
            <a class="btn btn-secondary" href="/smedweb/menu.php"><span class="glyphicon glyphicon-arrow-left"></span> Voltar</a>
         
        </form>
        <hr>
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
                    <a class='btn btn-light btn-sm' title='Editar Paciênte' href='javascript:func()'onclick='editar($c_linha[id])'><span class='glyphicon glyphicon-pencil'> Editar</span></a>
                    <a class='btn btn-light btn-sm' title='História Clinica' href='javascript:func()'onclick='historia($c_linha[id])'><span class='glyphicon glyphicon-header'> História</span></a>
                    <a class='btn btn-light btn-sm' title='Anamnese Clínica' href='javascript:func()'onclick='anamnese($c_linha[id])'><img src='\smedweb\images\anamnese2.png' alt='' width='20' height='20'>  Anamnese</span></a>
                    <a class='btn btn-light btn-sm' title='Imagens' href='javascript:func()'onclick='imagem($c_linha[id])'><img src='\smedweb\images\imagens.png' alt='' width='20' height='20'> Imagens</a>
                    <a class='btn btn-light btn-sm' title='Excluir Paciênte' href='javascript:func()'onclick='confirmacao($c_linha[id])'><span class='glyphicon glyphicon-trash'> Excluir</span></a>
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