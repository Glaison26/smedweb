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
$c_bateria = "";


// variaveis para mensagens de erro e suscessso da gravação
$msg_gravou = "";
$msg_erro = "";

if ((isset($_POST["btn_grava"])) && ($_SERVER['REQUEST_METHOD'] == 'POST')) {
    $c_descricao = $_POST['add_descricaoField'];
    $c_bateria = $_POST['add_bateriaField'];

    do {
        if (
            empty($c_descricao)
        ) {
            $msg_erro = "Todos os Campos com (*) devem ser preenchidos, favor verificar!!";
            break;
        }
        // grava dados no banco
        // faço a Leitura da tabela com sql
        $c_sql = "Insert into bateria  (descricao, exames)" .
            " Value ('$c_descricao','$c_bateria')";

        $result = $conection->query($c_sql);

        // verifico se a query foi correto
        if (!$result) {
            die("Erro ao Executar Sql!!" . $conection->connect_error);
        }

        $msg_gravou = "Dados Gravados com Sucesso!!";

        header('location: /smedweb/cadastros/itenslaudos/baterias_lista.php');
    } while (false);
} else {  // insiro cmponente na formula
    if (isset($_POST["btn_bateria"])) {
        // pego unidade do componente selecionado

        $c_bateria = $_POST["add_bateriaField"] . $_POST["Sel_exame"] . "\r\n";
        $c_descricao = $_POST["add_descricaoField"];
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
        <h5>Nova Bateria de Exames do Sistema<h5>
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
                <label class="col-md-3 form-label">Exames para inserir</label>
                <div class="col-sm-4">
                    <select class="form-control form-control-lg" id="Sel_exame" name="Sel_exame">
                        <?php
                        $c_sql = "SELECT exames.id, exames.descricao FROM exames ORDER BY exames.descricao";
                        $result = $conection->query($c_sql);

                        // insiro os registro do banco de dados na tabela 
                        while ($c_linha = $result->fetch_assoc()) {
                            echo "<option>$c_linha[descricao]</option>";
                        }
                        ?>
                    </select>

                </div>
                <button class='btn btn-info' type="submit" id='btn_bateria' name='btn_bateria' title='Adicionar Exame a Bateria'><span class='glyphicon glyphicon-plus'></span></button>
            </div>
            <hr>
            <div class="mb-3 row">

                <label for="add_descricaoField" class="col-md-3 form-label">Descrição (*)</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="add_descricaoField" name="add_descricaoField">
                </div>

            </div>
            
            <div class="mb-3 row">
                <label for="add_bateriaField" class="col-md-3 form-label">Texto da Bateria</label>
                <div class="col-sm-6">
                    <textarea class="form-control" id="add_bateriaField" name="add_bateriaField" rows="15"><?php echo $c_bateria ?></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3">
                    <button type="submit" id='btn_grava' name='btn_grava' class="btn btn-primary"><span class='glyphicon glyphicon-floppy-saved'></span> Salvar</button>
                    <a class='btn btn-danger' href='/smedweb/cadastros/itenslaudos/baterias_lista.php'><span class='glyphicon glyphicon-remove'></span> Cancelar</a>
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
</div>

</form>


</body>

</html>