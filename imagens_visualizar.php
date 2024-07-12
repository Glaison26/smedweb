<?php // controle de acesso ao formulário
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

include("conexao.php");
include_once "lib_gop.php";

// rotina de post dos dados do formuário
$c_descricao = "";
$d_data = "";

$c_id = $_GET["id"];

// variaveis para mensagens de erro e suscessso da gravação
$msg_gravou = "";
$msg_erro = "";
//

if ($_SERVER['REQUEST_METHOD'] == 'GET') {  // metodo get para carregar dados no formulário

    if (!isset($_GET["id"])) {
        header('location: /smedweb/imagens.php');
        exit;
    }


    $c_sql = "SELECT * FROM imagens_pacientes where imagens_pacientes.id='$c_id'";
    $result = $conection->query($c_sql);

    $registro = $result->fetch_assoc();

    if (!$registro) {
        header('location: /smedweb/imagens.php');
        exit;
    }
    $c_descricao = $registro['descricao'];
    $d_data =  DateTime::createFromFormat('Y-m-d', $registro["data"]);
    $d_data = $d_data->format('d/m/Y');
    $c_pasta = $registro['pasta_imagem'];
    $c_pasta = substr($c_pasta, 4);
    //
    $c_arquivo = $registro['pasta_imagem'];
} else { // post da innformações
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // metodo post para atualizar dados
        $c_id = $_POST["id"];
        $c_descricao = $_POST['up_descricaoField'];
        $d_data = $_POST['data'];
        $d_data = date("Y-m-d", strtotime(str_replace('/', '-', $d_data)));
        do {
            // faço a alteração do registro
            $c_sql = "Update imagens_pacientes" .
                " SET descricao ='$c_descricao',  data = '$d_data' where id=$c_id";
            $result = $conection->query($c_sql);
            // verifico se a query foi correto
            if (!$result) {
                die("Erro ao Executar Sql!!" . $conection->connect_error);
            }
            $msg_gravou = "Dados Gravados com Sucesso!!";
            header('location: /smedweb/imagens.php');
        } while (false);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SmartWeb - Sistema Médico</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/jquery-1.2.6.pack.js"></script>
    <script type="text/javascript" src="js/jquery.maskedinput-1.1.4.pack.js"></script>



</head>

<body>
    <div class="panel panel-primary class">
        <div class="panel-heading text-center">
            <h4>SmartMed - Sistema Médico</h4>
            <h5>Imagens do Paciente<h5>
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

        <form method="post">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4>Identificação do Paciente:<?php echo ' ' . $_SESSION["paciente_nome"] ?></h4>
                </div>
            </div>
            <hr>
            <input type="hidden" name="id" value="<?php echo $c_id; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Data</label>
                <div class="col-sm-2">
                    <input type="text" maxlength="10" class="form-control" placeholder="dd/mm/yyyy" name="data" id="data" onkeypress="mascaraData(this)" value="<?php echo $d_data; ?>">
                </div>
            </div>
            <div class="mb-3 row">

                <label for="up_descricaoField" class="col-md-3 form-label">Descrição</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="up_descricaoField" name="up_descricaoField" value="<?php echo $c_descricao; ?>">
                </div>

            </div>
            <div class="mb-3 row">

                <label for="up_arquivoField" class="col-md-3 form-label">Arquivo</label>
                <div class="col-md-6">
                    <input type="text" readonly class="form-control" id="up_arquivoField" name="up_arquivoField" value="<?php echo $c_pasta; ?>">
                </div>

            </div>
            <div class="mb-3 row">
                <label class="col-md-3 form-label">Imagem</label>
                <div class="panel panel-success">
                    <div class="panel-body">
                        <img class="rounded mx-auto d-block" class="img-responsive" src="\smedweb\img\<?php echo $c_pasta; ?>" class="img-fluid" style="height :500px" style="width:500px">
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3">
                    <button type="submit" id='btn_grava' name='btn_grava' class="btn btn-Light"><span class='glyphicon glyphicon-floppy-saved'></span> Salvar</button>
                    <a class='btn btn-Light' href='/smedweb/imagens.php'> <img src="\smedweb\images\voltar.png" alt="" width="15" height="15"> Voltar</a>
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
        </form>
    </div>

</body>

</html>