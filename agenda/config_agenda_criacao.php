<?php // controle de acesso ao formulário
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

include_once "../lib_gop.php";
include("../links.php");
include("../conexao.php"); // conexão de banco de dados

if ($_SERVER['REQUEST_METHOD'] == 'GET') {  // metodo get para carregar dados no formulário

    if (!isset($_GET["id"])) {
        header('location: /smedweb/agenda/config_agenda.php');
        exit;
    }
    $c_id = $_GET["id"];  // identificação do id do profissional
    //
    $c_sql_medico = "SELECT profissionais.nome FROM profissionais where id=$c_id";
    $result_medico = $conection->query($c_sql_medico);
    $c_linha_medico = $result_medico->fetch_assoc();

    // verifico se no arquivo de configurações ja existe registro dos dias da semana
    $c_sql = "SELECT COUNT(*) AS total FROM agendaconfig  where id_profissional='$c_id'";
    $result = $conection->query($c_sql);
    $c_linha = $result->fetch_assoc();
    // se não tem nenhum registro na tabela de configuração executo a rotina para criar os sete dias
    if ($c_linha['total'] == 0) {
        $i_contador = 1;
        while ($i_contador < 8) {
            $c_contador = strval($i_contador);
            $c_sql_insere = "Insert into agendaconfig (id_profissional, dia, inicio1, inicio2, inicio3
            , fim1, fim2, fim3, duracao1, duracao2, duracao3) 
            value ('$c_id', '$c_contador', '00:00', '00:00', '00:00'
            , '00:00', '00:00', '00:00', '0', '0', '0')";
            $result = $conection->query($c_sql_insere);
            $i_contador++;
            $c_sql = "select * from agendaconfig where id_profissional='$c_id'";
            $result = $conection->query($c_sql);
        }
    } else {  // já tem registros na tabela de configuração pego os dados no sql
        $c_sql = "select * from agendaconfig where id_profissional='$c_id'";
        $result = $conection->query($c_sql);
    }
}
?>


<!-- parte em HTML -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
</head>

<body>
    <!-- funções e chamadas em javascript -->
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
                $('#up_dia').val(data[1]);
                // manhã
                $('#up_inicio1').val(data[2]);
                $('#up_fim1').val(data[3]);
                $('#up_duracao1').val(data[4]);
                // tarde
                $('#up_inicio2').val(data[5]);
                $('#up_fim2').val(data[6]);
                $('#up_duracao2').val(data[7]);
                // noite
                $('#up_inicio3').val(data[8]);
                $('#up_fim3').val(data[9]);
                $('#up_duracao3').val(data[10]);

            });
        });
    </script>

    <script type="text/javascript">
        // Função javascript e ajax para Alteração dos dados
        $(document).on('submit', '#frmhorario', function(e) {
            e.preventDefault();
            var c_id = $('#up_idField').val();
            var c_dia = $('#up_dia').val();
            var c_inicio1 = $('#up_inicio1').val();
            var c_fim1 = $('#up_fim1').val();
            var c_duracao1 = $('#up_duracao1').val();
            //    
            var c_inicio2 = $('#up_inicio2').val();
            var c_fim2 = $('#up_fim2').val();
            var c_duracao2 = $('#up_duracao2').val();

            var c_inicio3 = $('#up_inicio3').val();
            var c_fim3 = $('#up_fim3').val();
            var c_duracao3 = $('#up_duracao3').val();
            //
            if (c_dia != '') {
                
                $.ajax({
                    url: "config_agenda_editar.php",
                    type: "post",
                    data: {
                        c_id: c_id,
                        c_dia: c_dia,
                        c_inicio1: c_inicio1,
                        c_fim1: c_fim1,
                        c_duracao1: c_duracao1,
                        //    
                        c_inicio2: c_inicio2,
                        c_fim2: c_fim2,
                        c_duracao2: c_duracao2,
                        //
                        c_inicio3: c_inicio3,
                        c_fim3: c_fim3,
                        c_duracao3: c_duracao3

                    },
                    
                    success: function(data) {
                        var json = JSON.parse(data);
                        var status = json.status;

                        if (status == 'true') {
                            $('#editmodal').modal('hide');
                            location.reload();
                        } else {
                            alert('falha ao incluir dados');
                        }
                    }
                });

            } else {
                alert('Todos os campos devem ser preenchidos!!');
            }
        });
    </script>


    <div class="panel panel-primary class">
        <div class="panel-heading text-center">
            <h4>SmartMed - Sistema Médico</h4>
            <h5>Configuração da Agenda Médica<h5>
        </div>
    </div>

    <div class="container -my5">

        <hr>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h4>Identificação do Profissional:<?php echo ' ' . $c_linha_medico['nome']; ?></h4>
            </div>
        </div>

        <hr>
        <table class="table display table-bordered tabconfig">
            <thead class="thead">
                <tr class="info">
                    <th scope="col" style="display:none">id</th>
                    <th scope="col">Dia</th>
                    <th scope="col">Inicio Manhã</th>
                    <th scope="col">Fim Manhã</th>
                    <th scope="col">Duração</th>
                    <th scope="col">Inicio Tarde</th>
                    <th scope="col">Fim Tarde</th>
                    <th scope="col">Duração</th>
                    <th scope="col">Inicio Noite</th>
                    <th scope="col">Fim Noite</th>
                    <th scope="col">Duração</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // insiro os registro do banco de dados na tabela 
                while ($c_linha = $result->fetch_assoc()) {
                    // montagem dos dias da semana
                    switch ($c_linha['dia']) {
                        case "1":
                            $c_dia = 'Segunda-Feira';
                            break;
                        case "2":
                            $c_dia = 'Terça-Feira';
                            break;
                        case "3":
                            $c_dia = 'Quarta-Feira';
                            break;
                        case "4":
                            $c_dia = 'Quinta-Feira';
                            break;
                        case "5":
                            $c_dia = 'Sexta-Feira';
                            break;
                        case "6":
                            $c_dia = 'Sábado';
                            break;
                        case "7":
                            $c_dia = 'Domingo';
                            break;
                    }
                    // Coloco string sim ou não ao invés de s ou n
                    echo "
                            <tr>
                            <td style='display:none'>$c_linha[id]</td>
                            <td class='info'>$c_dia</td>
                            <td>$c_linha[inicio1]</td>
                            <td>$c_linha[fim1]</td>
                            <td>$c_linha[duracao1]</td>
                            <td>$c_linha[inicio2]</td>
                            <td>$c_linha[fim2]</td>
                            <td>$c_linha[duracao2]</td>
                            <td>$c_linha[inicio3]</td>
                            <td>$c_linha[fim3]</td>
                            <td>$c_linha[duracao3]</td>
                            <td><button type='button' class='btn btn-info editbtn' data-toggle='modal' data-target='#editmodal' title='Editar Horários'><span class='glyphicon glyphicon-pencil'> Configurar
                            </span></button></td>
                            </tr>
                                ";  
                }
                ?>
            </tbody>
        </table>
        <hr>
        <a class='btn btn-info' href='/smedweb/agenda/config_agenda.php'> <img src="\smedweb\images\voltar.png" alt="" width="15" height="15"> Voltar</a>
    </div>


    <!-- janela modal para edição dos dados dos horários -->

    <!-- Modal para edição dos dados -->
    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="editmodal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Configurar horário</h4>
                </div>
                <div class="modal-body">

                    <form id="frmhorario" method="POST" action="">
                        <input type="hidden" id="up_idField" name="up_idField">
                        
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Dia da Semana</label>
                            <div class="col-sm-7">
                                <input type="text" readonly class="form-control" name="up_dia" id="up_dia">
                            </div>
                        </div>
                        <!-- horários da manhã -->
                        <label>
                            <h4><b>Manhã</b></h4>
                        </label>
                        <div class="row mb-9">
                            <label class="col-sm-4 col-form-label">Inicio</label>
                            <div class="col-sm-3">
                                <input type="time" class="form-control" name="up_inicio1" id="up_inicio1">
                            </div>
                            <label class="col-sm-1 col-form-label">Fim</label>
                            <div class="col-sm-3">
                                <input type="time" class="form-control" name="up_fim1" id="up_fim1">
                            </div>
                        </div>
                        <br>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Duração (em minutos)</label>
                            <div class="col-sm-3">
                                <input type="number" class="form-control" name="up_duracao1" id="up_duracao1">
                            </div>
                        </div>
                        <hr>
                        <!-- horários da tarde -->
                        <label>
                            <h4><b>Tarde</b></h4>
                        </label>
                        <div class="row mb-9">
                            <label class="col-sm-4 col-form-label">Inicio</label>
                            <div class="col-sm-3">
                                <input type="time" class="form-control" name="up_inicio2" id="up_inicio2">
                            </div>
                            <label class="col-sm-1 col-form-label">Fim</label>
                            <div class="col-sm-3">
                                <input type="time" class="form-control" name="up_fim2" id="up_fim2">
                            </div>
                        </div>
                        <br>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Duração (em minutos)</label>
                            <div class="col-sm-3">
                                <input type="number" class="form-control" name="up_duracao2" id="up_duracao2">
                            </div>
                        </div>
                        <hr>
                        <!-- horários da noite -->
                        <label>
                            <h4><b>Noite</b></h4>
                        </label>
                        <div class="row mb-9">
                            <label class="col-sm-4 col-form-label">Inicio</label>
                            <div class="col-sm-3">
                                <input type="time" class="form-control" name="up_inicio3" id="up_inicio3">
                            </div>
                            <label class="col-sm-1 col-form-label">Fim</label>
                            <div class="col-sm-3">
                                <input type="time" class="form-control" name="up_fim3" id="up_fim3">
                            </div>
                        </div>
                        <br>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Duração (em minutos)</label>
                            <div class="col-sm-3">
                                <input type="number" class="form-control" name="up_duracao3" id="up_duracao3">
                            </div>
                        </div>

                        <div class="modal-footer">
                         
                            <button type="submit" class="btn btn-primary"><span class='glyphicon glyphicon-floppy-saved'></span> Salvar</button>
                             <!--<button class="btn btn-secondary" data-dismiss="modal"><span class='glyphicon glyphicon-remove'></span> Fechar</button>-->
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


</body>

</html>