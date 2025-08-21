<?php
// controle de acesso ao formulário
session_start();
//if (!isset($_SESSION['newsession'])) {
//    die('Acesso não autorizado!!!');
//}

include("../../conexao.php");
include_once "../../lib_gop.php";
include("../../links.php");

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
            empty($c_descricao)
        ) {
            $msg_erro = "Todos os Campos com (*) devem ser preenchidos, favor verificar!!";
            break;
        }
        // grava dados no banco
        // faço a Leitura da tabela com sql
        $c_sql = "Insert into formulas_pre  (descricao, formula)" .
            " Value ('$c_descricao','$c_formula')";
        $result = $conection->query($c_sql);
        // verifico se a query foi correto
        if (!$result) {
            die("Erro ao Executar Sql!!" . $conection->connect_error);
        }

        $msg_gravou = "Dados Gravados com Sucesso!!";

        header('location: /smedweb/cadastros/formula_padrao/formula_padrao_lista.php');
    } while (false);
} else {  // insiro cmponente na formula
    if (isset($_POST["btn_componente"])) {
        // pego unidade do componente selecionado
        // se não tiver componente selecionado não faz nada
        if ($_POST["Sel_componente"] == "-1") {
            $msg_erro = "Selecione um Componente para a Fórmula!!";
        } else {
            // pego o componente selecionado
            $c_componente = $_POST["Sel_componente"];
            $c_sql = "SELECT Componentes.unidade FROM Componentes where componentes.descricao='$c_componente'";
            //
            $result = $conection->query($c_sql);
            $c_linha = $result->fetch_assoc();
            $c_formula = $_POST["add_formulaField"] . $_POST["Sel_componente"] . "           " . $c_linha['unidade'] . "\r\n";
            $c_descricao = $_POST["add_descricaoField"];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
                <label class="col-md-3 form-label">Componentes para Fórmula</label>
                <div class="col-sm-4">
                    <select class="form-control form-control-lg" id="Sel_componente" name="Sel_componente">
                        <option value="-1">Selecione o Componente</option>
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
            <hr>
            <div class="mb-3 row">

                <label for="add_descricaoField" class="col-md-3 form-label">Descrição (*)</label>
                <div class="col-md-6">
                    <input type="text" requerid class="form-control" id="add_descricaoField" name="add_descricaoField">
                </div>
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
                    <a class='btn btn-danger' href='/smedweb/cadastros/formula_padrao/formula_padrao_lista.php'><span class='glyphicon glyphicon-remove'></span> Cancelar</a>
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