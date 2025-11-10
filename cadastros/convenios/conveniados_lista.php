<?php
// sessão não iniciada, inicio a sessão
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}
// link de conexão e links
include("..\..\conexao.php");
include("..\..\links.php");
// verifico se o id do convênio foi passado por GET
if (!isset($_GET["id"])) {
    header('location: /smedweb/cadastros/convenios/convenios_lista.php');
    exit;
}

$c_id_convenio = $_GET["id"];  // id do convênio
// preparo sql para buscar os conveniados do convênio
$c_sql = "SELECT * FROM clientes WHERE id_convenio = $c_id_convenio ORDER BY nome";
$result = $conection->query($c_sql);
if (!$result) {
    die("Erro ao Executar Sql !!" . $conection->connect_error);
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Convêniados</title>
</head>

<body>

    <script type="text/javascript">
        // Função javascript e ajax para inclusão dos dados

        $(document).on('submit', '#frmadd', function(e) {
            e.preventDefault();
            var c_nome = $('#addnomeField').val();
            var c_cpf = $('#addcpfField').val();
            var c_numero = $('#addnumeroField').val();
            if (c_nome != '' && c_cpf != '' && c_numero != '') {

                $.ajax({
                    url: "conveniados_novo.php",
                    type: "post",
                    data: {
                        c_nome: c_nome,
                        c_cpf: c_cpf,
                        c_numero: c_numero,
                        c_id_convenio: <?php echo $c_id_convenio; ?>
                    },
                    success: function(data) {
                        var json = JSON.parse(data);
                        var status = json.status;

                        location.reload();
                        if (status == 'true') {

                            $('#novomodal').modal('hide');
                            location.reload();
                        } else {
                            alert('falha ao incluir dados');
                        }
                    }
                });
            } else {
                alert('Preencha todos os campos obrigatórios');
            }
        });
    </script>

    <!-- script javascript para Coleta dados da tabela para edição do registro -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('.editbtn').on('click', function() {
                $('#editmodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#up_idField').val(data[0]);
                $('#upnomeField').val(data[1]);
                $('#upnumeroField').val(data[2]);
                $('#upcpfField').val(data[3]);
            });
        });
    </script>

    <script type="text/javascript">
        // Função javascript e ajax para atualização dos dados


        $(document).on('submit', '#frmup', function(e) {
            e.preventDefault();
            var up_id = $('#up_idField').val();
            var up_nome = $('#upnomeField').val();
            var up_cpf = $('#upcpfField').val();
            var up_numero = $('#upnumeroField').val();

            if (up_id != '' && up_nome != '' && up_cpf != '' && up_numero != '') {

                $.ajax({
                    url: "conveniados_editar.php",
                    type: "post",
                    data: {
                        up_id: up_id,
                        up_nome: up_nome,
                        up_cpf: up_cpf,
                        up_numero: up_numero
                    },
                    success: function(data) {
                        var json = JSON.parse(data);
                        var status = json.status;

                        location.reload();
                        if (status == 'true') {

                            $('#editmodal').modal('hide');
                            location.reload();
                        } else {
                            alert('falha ao atualizar dados');
                        }
                    }
                });
            } else {
                alert('Preencha todos os campos obrigatórios');
            }
        });
    </script>

    <div class="panel panel-primary class">
        <div class="panel-heading text-center">
            <h4>SmartMed - Sistema Médico</h4>
            <h5>Lista de Conveniados<h5>
        </div>
    </div>
    <br>
    <div class="container -my5">
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#novomodal"><span class="glyphicon glyphicon-plus"></span>
            Novo
        </button>
        <a class="btn btn-secondary btn-sm" href="/smedweb/cadastros/convenios/convenios_lista.php"><span class="glyphicon glyphicon-arrow-left"></span> Voltar</a>
    </div>
    <br>
    <div class="container">

        <table class="table display table-bordered tabcoveniados">
            <thead>
                <tr class="info">
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Identificação</th>
                    <th>CPF</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // laço para listar os conveniados
                while ($c_linha = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>$c_linha[id]</td>";
                    echo "<td>$c_linha[nome]</td>";
                    echo "<td>$c_linha[identificacao]</td>";
                    echo "<td>$c_linha[cpf]</td>";
                    echo "<td>
                    <button class='btn btn-info btn-sm editbtn' data-toggle=modal title='Editar Conveniado'><span class='glyphicon glyphicon-pencil'></span></button>
                    <a class='btn btn-danger btn-sm' title='Excluir Conveniado' href='javascript:func()'onclick='confirmacao($c_linha[id])'><span class='glyphicon glyphicon-trash'></span></a>
                    </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- janela Modal para inclusão de registro -->
    <div class="modal fade" id="novomodal" tabindex="-1" role="dialog" aria-labelledby="novomodal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Dados do Conveniado</h4>
                </div>
                <div class="modal-body">
                    <div class='alert alert-warning' role='alert'>
                        <h5>Campos com (*) são obrigatórios</h5>
                    </div>
                    <form id="frmadd" action="">
                        <div class="mb-3 row">
                            <label for="addnomeField" class="col-md-3 form-label">Nome*</label>
                            <div class="col-md-9">
                                <input type="text" required class="form-control" id="addnomeField" name="addnomeField">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="addcpfField" class="col-md-3 form-label">CPF*</label>
                            <div class="col-md-4">
                                <input type="text" required class="form-control" id="addcpfField" name="addcpfField">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="addnumeroField" class="col-md-3 form-label">Identificação*</label>
                            <div class="col-md-4">
                                <input type="text" required class="form-control" id="addnumeroField" name="addnumeroField">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><span class='glyphicon glyphicon-floppy-saved'></span> Salvar</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class='glyphicon glyphicon-remove'></span> Fechar</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <!-- Modal para edição dos dados -->
    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="editmodal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Editar dados do Convêniado</h4>
                </div>
                <div class="modal-body">
                    <div class='alert alert-warning' role='alert'>
                        <h5>Campos com (*) são obrigatórios</h5>
                    </div>
                    <form id="frmup" method="POST" action="">
                        <input type="hidden" id="up_idField" name="up_idField">
                        <div class="mb-3 row">
                            <label for="upnomeField" class="col-md-3 form-label">Nome*</label>
                            <div class="col-md-9">
                                <input type="text" required class="form-control" id="upnomeField" name="upnomeField">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="upcpfField" class="col-md-3 form-label">CPF*</label>
                            <div class="col-md-4">
                                <input type="text" required class="form-control" id="upcpfField" name="upcpfField">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="upnumeroField" class="col-md-3 form-label">Identificação*</label>
                            <div class="col-md-4">
                                <input type="text" required class="form-control" id="upnumeroField" name="upnumeroField">
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><span class='glyphicon glyphicon-floppy-saved'></span> Salvar</button>
                            <button class="btn btn-secondary" data-dismiss="modal"><span class='glyphicon glyphicon-remove'></span> Fechar</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


</body>

</html>