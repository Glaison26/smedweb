<?php
// controle de acesso ao formulário
session_start();
//if (!isset($_SESSION['newsession'])) {
//    die('Acesso não autorizado!!!');
//}

include("conexao.php");
include_once "lib_gop.php";
include("links.php");

$c_apresentacao = "";
$c_volume = "";
$c_quantidade = "";
$c_embalagem = "";
$c_uso = "";
$c_termo = "";
$c_veiculo = "";
$c_observacao = "";
$c_id =$_SESSION["id_medic"];
// variaveis para mensagens de erro e suscessso da gravação
$msg_gravou = "";
$msg_erro = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $c_apresentacao = $_POST['addapresentacaoField'];
    $c_volume = $_POST['addvolumeField'];
    $c_quantidade = $_POST['addquantidadeField'];
    $c_embalagem = $_POST['addembalagemField'];
    $c_uso = $_POST['addusoField'];
    $c_termo = $_POST['addtermoField'];
    $c_veiculo = $_POST['addveiculoField'];
    $c_observacao = $_POST['addobsField'];

    do {
        if (
            empty($c_apresentacao)) {
            $msg_erro = "Todos os Campos com (*) devem ser preenchidos, favor verificar!!";
            break;
        }
        
        // grava dados no banco
        // faço a Leitura da tabela com sql
        $c_sql = "Insert into medicamento_apresentacao (id_medicamento, apresentacao, volume, quantidade, embalagem, uso, termo, veiculo, observacao)" .
            "Value ('$c_id','$c_apresentacao','$c_volume','$c_quantidade','$c_embalagem','$c_uso','$c_termo','$c_veiculo','$c_observacao')";

        $result = $conection->query($c_sql);
        // verifico se a query foi correto
        if (!$result) {
            die("Erro ao Executar Sql!!" . $conection->connect_error);
        }

        $msg_gravou = "Dados Gravados com Sucesso!!";

        header('location: /smedweb/apresentacao_medicamentos_lista.php');
    } while (false);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartMed - Sistema Médico</title>
 
</head>
<div class="panel panel-primary class">
    <div class="panel-heading text-center">
        <h4>SmartMed - Sistema Médico</h4>
        <h5>Nova Apresentação de Medicamento<h5>
    </div>
</div>
<br>
<div class="container -my5">

    <body>
        <?php
        if (!empty($msg_erro)) {
            echo "
            <div class='alert alert-danger' role='alert'>
                <h4>$msg_erro</h4>
            </div>
                ";
        }
        ?>
        <div class='alert alert-warning' role='alert'>
            <h5>Campos com (*) são obrigatórios</h5>
        </div>
        <form method="post">
            <div class="mb-3 row">

                <label for="addcustoField" class="col-md-3 form-label">Apresentação (*)</label>
                <div class="col-md-3">
                    <input type="text" class="form-control" id="addapresentacaoField" name="addapresentacaoField">
                </div>

            </div>
            <div class="mb-3 row">
                <label for="addveiculoField" class="col-md-3 form-label">Veículo</label>
                <div class="col-md-3">
                    <input type="text" class="form-control" id="addveiculoField" name="addveiculoField">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="addvolumeField" class="col-md-3 form-label">Volume</label>
                <div class="col-md-3">
                    <input type="text" class="form-control" id="addvolumeField" name="addvolumeField">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="addquantidadeField" class="col-md-3 form-label">Quantidade</label>
                <div class="col-md-3">
                    <input type="text" class="form-control" id="addquantidadeField" name="addquantidadeField">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="addembalagemField" class="col-md-3 form-label">Embalagem</label>
                <div class="col-md-3">
                    <input type="text" class="form-control" id="addembalagemField" name="addembalagemField">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="addusoField" class="col-md-3 form-label">Uso</label>
                <div class="col-md-3">
                    <input type="text" class="form-control" id="addusoField" name="addusoField">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="addtermoField" class="col-md-3 form-label">Termo de Utilização</label>
                <div class="col-md-3">
                    <input type="text" class="form-control" id="addtermoField" name="addtermoField">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="addobsField" class="col-md-3 form-label">Observações</label>
                <div class="col-sm-6">
                    <textarea class="form-control" id="obs" name="addobsField" rows="5"></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3">
                    <button type="submit" class="btn btn-primary"><span class='glyphicon glyphicon-floppy-saved'></span> Salvar</button>
                    <a class='btn btn-danger' href='/smedweb/apresentacao_medicamentos_lista.php'><span class='glyphicon glyphicon-remove'></span> Cancelar</a>
                </div>

            </div>
            <?php
            if (!empty($msg_gravou)) {
                echo "
                    <div class='row mb-3'>
                        <div class='offset-sm-3 col-sm-6'>
                             <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>$msg_gravou</strong>

                             </div>
                        </div>     
                    </div>    
                ";
            }
            ?>
            <br>


</div>

</form>


</body>

</html>