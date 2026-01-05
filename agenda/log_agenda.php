<?php
// link de sessão
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}
include("../conexao.php");
// link bootstrap
include("../links.php");
date_default_timezone_set('America/Sao_Paulo');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmedWeb - Log Agenda</title>

</head>

<body>
    <div class="container-fluid">
        <div class="panel panel-primary class">
            <div class="panel-heading text-center">
                <h4>SmartMed - Sistema Médico</h4>
                <h5>Log da Agenda Médica<h5>
            </div>
        </div>
        <a class='btn btn-info' title="Voltar para a agenda" href='/smedweb/agenda/agenda.php'>
        <img src="\smedweb\images\voltar.png" alt="" width="20" height="20"> Voltar</a>
        <hr>
        <!-- Tabela de exibição do log da agenda -->
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Hora</th>
                            <th>Usuário</th>
                            <th>Descrição</th>
                            <th>Informações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $c_idagenda = $_GET['id'];
                        $c_sql = "SELECT log_agenda.data, log_agenda.hora, usuario.nome AS nome_usuario, log_agenda.descricao, log_agenda.registro 
                                  FROM log_agenda 
                                  JOIN usuario ON log_agenda.id_usuario = usuario.id 
                                  WHERE log_agenda.id_agenda = $c_idagenda 
                                  ORDER BY log_agenda.data DESC, log_agenda.hora DESC";
                        $result = $conection->query($c_sql);
                        while ($c_linha = $result->fetch_assoc()) {
                            // variavel com data formatada
                            $c_data_formatada = date("d/m/Y", strtotime($c_linha['data']));

                            echo "<tr>";
                            echo "<td>" . $c_data_formatada . "</td>";
                            echo "<td>" . $c_linha['hora'] . "</td>";
                            echo "<td>" . $c_linha['nome_usuario'] . "</td>";
                            echo "<td>" . $c_linha['descricao'] . "</td>";
                            echo "<td>" . nl2br($c_linha['registro']) . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>