<?php
// controle de acesso ao formulário
session_start();
//if (!isset($_SESSION['newsession'])) {
//    die('Acesso não autorizado!!!');
//}

include("conexao.php");
include_once "lib_gop.php";

$c_descricao = "";
$c_formula = "";


// variaveis para mensagens de erro e suscessso da gravação
$msg_gravou = "";
$msg_erro = "";

if ((isset($_POST["btn_grava"])) && ($_SERVER['REQUEST_METHOD'] == 'POST')) {
    $c_descricao = $_POST['add_descricaoField'];
    $c_formula = $_POST['add_formulaField'];

    do {
        if (
            empty($c_descricao) || empty($c_formula)
        ) {
            $msg_erro = "Todos os Campos com (*) devem ser preenchidos, favor verificar!!";
            break;
        }

        // grava dados no banco
        // faço a Leitura da tabela com sql
        $c_sql = "Insert into  (descricao, formula)" .
            "Value ('$c_descricao','$c_formula')";

        $result = $conection->query($c_sql);
        // verifico se a query foi correto
        if (!$result) {
            die("Erro ao Executar Sql!!" . $conection->connect_error);
        }

        $msg_gravou = "Dados Gravados com Sucesso!!";

        header('location: /smedweb/formula_padrao_lista.php');
    } while (false);
} else {  // insiro cmponente na formula
    if (isset($_POST["btn_componente"])) {
        // pego unidade do componente selecionado
        $c_componente=$_POST["Sel_componente"];
        $c_sql = "SELECT Componentes.unidade FROM Componentes where componentes.descricao='$c_componente'";
        //
        $result = $conection->query($c_sql);
        $c_linha = $result->fetch_assoc();
        $c_formula = $_POST["add_formulaField"] .$_POST["Sel_componente"]."      ".$c_linha['unidade'] ."\r\n";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartMed - Sistema Médico</title>
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



<div class="panel panel-primary class">
    <div class="panel-heading text-center">
        <h4>SmartMed - Sistema Médico</h4>
        <h5>Nova Fórmula Padrão do Sistema<h5>
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

                <label for="add_descricaoField" class="col-md-3 form-label">Descrição (*)</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="add_descricaoField" name="add_descricaoField">
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
                <label for="add_formulaField" class="col-md-3 form-label">Texto da Fórmula</label>
                <div class="col-sm-6">
                    <textarea class="form-control" id="add_formulaField" name="add_formulaField" rows="15"><?php echo $c_formula ?></textarea>
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


</div>

</form>


</body>

</html>