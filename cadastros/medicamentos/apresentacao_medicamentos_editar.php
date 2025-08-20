<?php // controle de acesso ao formulário
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

include("../../conexao.php");
include("../../links.php");
include_once "../../lib_gop.php";

// rotina de post dos dados do formuário
$c_apresentacao = "";
$c_volume = "";
$c_quantidade = "";
$c_embalagem = "";
$c_uso = "";
$c_termo = "";
$c_veiculo = "";
$c_observacao = "";

$c_id = $_GET["id"];

// variaveis para mensagens de erro e suscessso da gravação
$msg_gravou = "";
$msg_erro = "";


if ($_SERVER['REQUEST_METHOD'] == 'GET') {  // metodo get para carregar dados no formulário
   
    if (!isset($_GET["id"])) {
        header('location: /smedweb/cadastros/medicamentos/apresentacao_medicamentos_lista.php');
        exit;
    }
    
    $c_sql = "SELECT medicamento_apresentacao.id, medicamentos.descricao as medicamento, medicamento_apresentacao.apresentacao,
             medicamento_apresentacao.volume, medicamento_apresentacao.quantidade, medicamento_apresentacao.embalagem,
             medicamento_apresentacao.uso, medicamento_apresentacao.termo, medicamento_apresentacao.observacao,
             medicamento_apresentacao.veiculo, medicamento_apresentacao.id_medicamento FROM medicamento_apresentacao
             JOIN medicamentos ON medicamento_apresentacao.id_medicamento=medicamentos.id 
             WHERE medicamento_apresentacao.id='$c_id'";

    $result = $conection->query($c_sql);
    $registro = $result->fetch_assoc();

    if (!$registro) {
        header('location: /smedweb/cadastros/medicamentosapresentacao_medicamentos_lista.php');
        exit;
    }
    $c_apresentacao = $registro['apresentacao'];
    $c_volume = $registro['volume'];
    $c_quantidade = $registro['quantidade'];
    $c_embalagem = $registro['embalagem'];
    $c_uso = $registro['uso'];
    $c_termo = $registro['termo'];
    $c_veiculo = $registro['veiculo'];
    $c_observacao = $registro['observacao'];
    
} else {
    // metodo post para atualizar dados
    //$c_id = $_POST["id"];
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

        // faço a alteração do registro
        $c_sql = "Update medicamento_apresentacao" .
            " SET apresentacao ='$c_apresentacao',  volume = '$c_volume', quantidade = '$c_quantidade'
            , embalagem = '$c_embalagem', uso = '$c_uso' , termo = '$c_termo',
            veiculo = '$c_veiculo', observacao = '$c_observacao' where id=$c_id";
        $result = $conection->query($c_sql);
        // verifico se a query foi correto
        if (!$result) {
            die("Erro ao Executar Sql!!" . $conection->connect_error);
        }
        $msg_gravou = "Dados Gravados com Sucesso!!";
        header('location: /smedweb/cadastros/medicamentos/apresentacao_medicamentos_lista.php');
    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
</head>

<body>
    <div class="panel panel-primary class">
        <div class="panel-heading text-center">
            <h4>SmartMed - Sistema Médico</h4>
            <h5>Novo Usuário do Sistema<h5>
        </div>
    </div>
    <br>
    <div class="container -my5">


        <?php
        if (!empty($msg_erro)) {
            echo "
            <div class='alert alert-danger' role='alert'>
                <h5>$msg_erro</h5>
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
                    <input type="text" required class="form-control" id="addapresentacaoField" name="addapresentacaoField" value="<?php echo $c_apresentacao; ?>">
                </div>

            </div>
            <div class="mb-3 row">
                <label for="addveiculoField" class="col-md-3 form-label">Veículo</label>
                <div class="col-md-3">
                    <input type="text" class="form-control" id="addveiculoField" name="addveiculoField" value="<?php echo $c_veiculo; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="addvolumeField" class="col-md-3 form-label">Volume</label>
                <div class="col-md-3">
                    <input type="text" class="form-control" id="addvolumeField" name="addvolumeField" value="<?php echo $c_volume; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="addquantidadeField" class="col-md-3 form-label">Quantidade</label>
                <div class="col-md-3">
                    <input type="text" class="form-control" id="addquantidadeField" name="addquantidadeField" value="<?php echo $c_quantidade; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="addembalagemField" class="col-md-3 form-label">Embalagem</label>
                <div class="col-md-3">
                    <input type="text" class="form-control" id="addembalagemField" name="addembalagemField" value="<?php echo $c_embalagem; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="addusoField" class="col-md-3 form-label">Uso</label>
                <div class="col-md-3">
                    <input type="text" class="form-control" id="addusoField" name="addusoField" value="<?php echo $c_uso; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="addtermoField" class="col-md-3 form-label">Termo de Utilização</label>
                <div class="col-md-3">
                    <input type="text" class="form-control" id="addtermoField" name="addtermoField" value="<?php echo $c_termo; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="addobsField" class="col-md-3 form-label">Observações</label>
                <div class="col-sm-6">
                    <textarea class="form-control" id="addobsField" name="addobsField" rows="5"><?php echo $c_observacao; ?></textarea>
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
            <footer>
                <div class="row mb-3">
                    <div class="offset-sm-3 col-sm-3 d-grid">
                        <button type="submit" class="btn btn-primary"><span class='glyphicon glyphicon-floppy-saved'></span> Salvar</button>
                        <a class='btn btn-danger' href='/smedweb/cadastros/medicamentos/apresentacao_medicamentos_lista.php'><span class='glyphicon glyphicon-remove'></span> Cancelar</a>
                    </div>

                </div>
            </footer>
        </form>
    </div>

</body>

</html>