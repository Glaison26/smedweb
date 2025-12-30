<?php
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

include("../conexao.php");
include("../links.php");
?>
<!-- Htm com mensagem de advertência para limpeza da lixeira da agenda -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Limpar Lixeira da Agenda</title>
</head>

<body>
    <!-- cabeçalho da página -->
    <div class="container-fluid">
        <div class="panel panel-primary class">
            <div class="panel-heading text-center">
                <h4>SmartMed - Sistema Médico</h4>
                <h5>Limpeza da Lixeira da Agenda<h5>
            </div>
        </div>

        <hr>
        <!-- corpo da página -->
        <div class="container">
            <p>Tem certeza que deseja limpar a lixeira da agenda?</p>
            <p>Esta ação não poderá ser desfeita!</p>
        </div>
        <div class="container">
            <!-- botões de confirmação ou cancelamento -->
            <a href="limpa_lixeira_executa.php" class="btn btn-danger">Sim, Limpar Lixeira</a>
            <a href="config_agenda.php" class="btn btn-secondary">Cancelar</a>
        </div>
    </div>
</body>

</html>

<!-- classe css container para centralizar o conteúdo -->
<style>
    .container {
        text-align: center;
        margin-top: 50px;
    }
</style>
<?php


