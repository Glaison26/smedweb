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
    <div class="panel panel-primary class">
        <div class="panel-heading text-center">
            <h4>SmartMed - Sistema Médico</h4>
            <h5>Lista de Conveniados<h5>
        </div>
    </div>
    <br>
    <div class="container -my5">
         <a class="btn btn-success btn-sm" href="/smedweb/cadastros/convenios/convenio_novo.php"><span class="glyphicon glyphicon-plus"></span> Incluir</a>
        <a class="btn btn-secondary btn-sm" href="/smedweb/cadastros/convenios/convenios_lista.php"><span class="glyphicon glyphicon-arrow-left"></span> Voltar</a>
    </div>
    <br>
    <div class="container">
        
        <table class="table display table-bordered tabconvenios">
            <thead>
                <tr class="info">
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Identificação</th>
                    <th>CPF</th>
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
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    
</body>
</html>

