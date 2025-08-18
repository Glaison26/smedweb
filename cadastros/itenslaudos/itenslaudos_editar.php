<?php // controle de acesso ao formulário
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

include("../../conexao.php");
include_once "../../lib_gop.php";
include("../../links.php");

// rotina de post dos dados do formuário
$c_descricao = "";
$c_grupo = "";
$c_metodo = "";
$c_material = "";
$c_valref = "";

$c_id = $_GET["id"];

// variaveis para mensagens de erro e suscessso da gravação
$msg_gravou = "";
$msg_erro = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {  // metodo get para carregar dados no formulário

    if (!isset($_GET["id"])) {
        header('location: /smedweb/cadastros/itenslaudos/itenslaudos_lista.php');
        exit;
    }

    $c_sql = "SELECT exames.id, exames.descricao, exames.material, exames.id_grupo, exames.metodo, exames.valref, grupos_laudos.descricao AS grupo FROM 
    exames JOIN grupos_laudos ON exames.id_grupo=grupos_laudos.id where exames.id='$c_id'";
    $result = $conection->query($c_sql);

    $registro = $result->fetch_assoc();

    if (!$registro) {
        header('location: /smedweb/cadastros/itenslaudos/itenslaudos_padrao_lista.php');
        exit;
    }
    $c_descricao = $registro['descricao'];
    $c_grupo = $registro['id_grupo'];
    $c_metodo = $registro['metodo'];
    $c_material = $registro['material'];
    $c_valref = $registro['valref'];
} else {
    if ((isset($_POST["btn_grava"])) && ($_SERVER['REQUEST_METHOD'] == 'POST')) {
        // metodo post para atualizar dados
        $c_id = $_POST["id"];
        $c_descricao = $_POST['up_descricaoField'];
        $c_grupo = $_POST['up_grupoField'];
        $c_metodo = $_POST['up_metodoField'];
        $c_material = $_POST['up_materialField'];
        $c_valor_ref = $_POST['up_valrefField'];

        do {
            if (
                empty($c_descricao)
            ) {
                $msg_erro = "Todos os Campos com (*) devem ser preenchidos, favor verificar!!";
                break;
            }
            // pego codigo do grupo selecionado
            $c_sqlgrupo = "select id from grupos_laudos where grupos_laudos.descricao='$c_grupo'";
            $result = $conection->query($c_sqlgrupo);
            $c_linha = $result->fetch_assoc();
            $c_id_grupo = $c_linha['id'];
            // verifico se a query foi correto
            if (!$result) {
                die("Erro ao Executar Sql!!" . $conection->connect_error);
            }
            // faço a alteração do registro
            $c_sql = "Update exames" .
                " SET descricao ='$c_descricao',  metodo = '$c_metodo', material = '$c_material', id_grupo= '$c_id_grupo', valref='$c_valor_ref' where id=$c_id";
            $result = $conection->query($c_sql);
            // verifico se a query foi correto
            if (!$result) {
                die("Erro ao Executar Sql!!" . $conection->connect_error);
            }
            $msg_gravou = "Dados Gravados com Sucesso!!";
            header('location: /smedweb/cadastros/itenslaudos/itenslaudos_lista.php');
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
</head>

<body>
    <div class="panel panel-primary class">
        <div class="panel-heading text-center">
            <h4>SmartMed - Sistema Médico</h4>
            <h5>Editar Exame de Laudo do Sistema<h5>
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
                    <input type="text" required class="form-control" id="up_descricaoField" name="up_descricaoField" value="<?php echo $c_descricao; ?>">
                </div>

            </div>
            <hr>
            <div class="mb-3 row">
                <label class="col-md-3 form-label">Grupo do Exame (*)</label>
                <div class="col-sm-4">
                    <select class="form-control form-control-lg" id="up_grupoField" name="up_grupoField">
                        <?php
                        $c_sql2 = "select grupos_laudos.id, grupos_laudos.descricao from grupos_laudos ORDER BY grupos_laudos.descricao";
                        $result2 = $conection->query($c_sql2);

                        // insiro os registro do banco de dados na tabela 
                        while ($c_linha = $result2->fetch_assoc()) {
                            $c_op = "";

                            if ($c_linha['id'] == $c_grupo) {
                                $c_op = "selected";
                            }
                            echo "<option $c_op>$c_linha[descricao]</option>";
                        }
                        ?>
                    </select>

                </div>

            </div>
            <div class="mb-3 row">
                <label for="up_materialField" class="col-md-3 form-label">Material</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="up_materialField" name="up_materialField" value="<?php echo $c_material; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="up_metodoField" class="col-md-3 form-label">Metodo</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="up_metodoField" name="up_metodoField" value="<?php echo $c_metodo; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="up_valref" class="col-md-3 form-label">Valor de Referência</label>
                <div class="col-sm-6">
                    <textarea class="form-control" id="up_valrefField" name="up_valrefField" rows="10"><?php echo $c_valref; ?>"</textarea>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3">
                    <button type="submit" id='btn_grava' name='btn_grava' class="btn btn-primary"><span class='glyphicon glyphicon-floppy-saved'></span> Salvar</button>
                    <a class='btn btn-danger' href='/smedweb/cadastros/itenslaudos/itenslaudos_lista.php'><span class='glyphicon glyphicon-remove'></span> Cancelar</a>
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