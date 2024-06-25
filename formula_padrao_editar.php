<?php // controle de acesso ao formulário
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

include("conexao.php");
include_once "lib_gop.php";

// rotina de post dos dados do formuário
$c_descricao = "";
$c_formula = "";

$c_id = $_GET["id"];

// variaveis para mensagens de erro e suscessso da gravação
$msg_gravou = "";
$msg_erro = "";


if ($_SERVER['REQUEST_METHOD'] == 'GET') {  // metodo get para carregar dados no formulário

    if (!isset($_GET["id"])) {
        header('location: /smedweb/formula_padrao_lista.php');
        exit;
    }

    $c_sql = "SELECT formulas_pre.id, formulas_pre.descricao, formulas_pre.formula FROM formulas_pre where formulas_pre.id='$c_id'";
    $result = $conection->query($c_sql);

    $registro = $result->fetch_assoc();

    if (!$registro) {
        header('location: /smedweb/formula_padrao_lista.php');
        exit;
    }
    $c_descricao = $registro['descricao'];
    $c_formula = $registro['formula'];
} else {
    if ((isset($_POST["btn_grava"])) && ($_SERVER['REQUEST_METHOD'] == 'POST')) {
        // metodo post para atualizar dados
        $c_id = $_POST["id"];
        $c_descricao = $_POST['up_descricaoField'];
        $c_formula = $_POST['up_formulaField'];

        do {
            if (
                empty($c_descricao)
            ) {
                $msg_erro = "Todos os Campos com (*) devem ser preenchidos, favor verificar!!";
                break;
            }

            // faço a alteração do registro
            $c_sql = "Update formulas_pre" .
                " SET descricao ='$c_descricao',  formula = '$c_formula' where id=$c_id";
            $result = $conection->query($c_sql);
            // verifico se a query foi correto
            if (!$result) {
                die("Erro ao Executar Sql!!" . $conection->connect_error);
            }
            $msg_gravou = "Dados Gravados com Sucesso!!";
            header('location: /smedweb/formula_padrao_lista.php');
        } while (false);
    } else
    if (isset($_POST["btn_componente"])) {
        // pego unidade do componente selecionado
        $c_componente = $_POST["Sel_componente"];
        $c_sql = "SELECT Componentes.unidade FROM Componentes where componentes.descricao='$c_componente'";
        //
        $result = $conection->query($c_sql);
        $c_linha = $result->fetch_assoc();
        $c_formula = $_POST["up_formulaField"] . $_POST["Sel_componente"] . "      " . $c_linha['unidade'] . "\r\n";
        $c_descricao = $_POST["up_descricaoField"]; 
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
            <input type="hidden" name="id" value="<?php echo $c_id; ?>">
            <div class="mb-3 row">

                <label for="up_descricaoField" class="col-md-3 form-label">Descrição (*)</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="up_descricaoField" name="up_descricaoField" value="<?php echo $c_descricao; ?>">
                </div>

            </div>
            <hr>
            <div class="mb-3 row">
                <label class="col-md-3 form-label">Componentes para Fórmula</label>
                <div class="col-sm-4">
                    <select class="form-control form-control-lg" id="Sel_componente" name="Sel_componente">
                        <?php
                        $c_sql = "SELECT componentes.id, Componentes.descricao FROM Componentes ORDER BY Componentes.descricao";
                        $result = $conection->query($c_sql);
                        // insiro os registro do banco de dados na tabela 
                        while ($c_linha = $result->fetch_assoc()) {
                            echo "<option>$c_linha[descricao]</option>";
                        }
                        ?>
                    </select>

                </div>
                <button class='btn btn-info' type="submit" id='btn_componente' name='btn_componente' title='Adicionar Componente a Fórmula'><span class='glyphicon glyphicon-plus'></span></button>
            </div>
            <div class="mb-3 row">
                <label for="up_formulaField" class="col-md-3 form-label">Texto da Fórmula</label>
                <div class="col-sm-6">
                    <textarea class="form-control" id="up_formulaField" name="up_formulaField" rows="15"><?php echo $c_formula ?></textarea>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-3">
                    <button type="submit" id='btn_grava' name='btn_grava' class="btn btn-primary"><span class='glyphicon glyphicon-floppy-saved'></span> Salvar</button>
                    <a class='btn btn-danger' href='/smedweb/formula_padrao_lista.php'><span class='glyphicon glyphicon-remove'></span> Cancelar</a>
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