<!-- front end com logs de ações na agenda -->
<?php
session_start();
include_once("../conexao.php");
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}
include("../links.php");
// configuração de timezone
date_default_timezone_set('America/Sao_Paulo');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Smed - Log de Ações na Agenda</title>
</head>
<!-- corpo da página -->
<body>
    <div class="container-fluid">
        <div class="panel panel-primary class">
            <div class="panel-heading text-center">
                <h4>SmartMed - Sistema Médico</h4>
                <h5>Log de Ações na Agenda<h5>
            </div>
        </div>
        <br>
    </div>

    <div class="container -my5">
        <!-- botão para voltar ao menu -->
        <a href="config_agenda.php" class="btn btn-primary">Voltar</a>
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead">
                    <tr>
                        <th>Data</th>
                        <th>Hora</th>
                        <th>Usuário</th>
                        <th>Ação</th>
                        <th>Detalhes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // consulta para obter os logs de ações na agenda
                    $query = "SELECT data, hora, nome as usuario, descricao, registro FROM log_criacao_agenda
                    JOIN usuario on log_criacao_agenda.id_usuario = usuario.id
                    ORDER BY data,hora DESC";
                    $result = $conection->query($query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['data'] . "</td>";
                        echo "<td>" . $row['hora'] . "</td>";
                        echo "<td>" . $row['usuario'] . "</td>";
                        echo "<td>" . $row['descricao'] . "</td>";
                        echo "<td>" . $row['registro'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>