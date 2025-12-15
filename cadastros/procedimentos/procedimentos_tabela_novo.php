<?php
// controle de acesso ao formulário
session_start();
//if (!isset($_SESSION['newsession'])) {
//    die('Acesso não autorizado!!!');
//}

include("../../conexao.php");
include_once "../../lib_gop.php";
include("../../links.php");

$c_tabela = "";
$c_custo = 0;
$c_valor = 0;
// variaveis para mensagens de erro e suscessso da gravação
$msg_gravou = "";
$msg_erro = "";
$c_id_tabela = $_GET["id"];
$id_proc = $_SESSION['codigo_proc'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $c_tabela = $_POST['addtabelaField'];
    $c_custo = $_POST['addcustoField'];

    do {
        if (
            empty($c_tabela) || empty($c_custo)
        ) {
            $msg_erro = "Todos os Campos com (*) devem ser preenchidos, favor verificar!!";
            break;
        }
        // consistencia se tabela selecionada já existe no procedimento
        $c_sql = "SELECT procedimentos_tabelas.id_tabela, tabela.descricao, procedimentos_tabelas.id 
                  FROM procedimentos_tabelas
                  JOIN tabela ON procedimentos_tabelas.id_tabela=tabela.id
                  WHERE tabela.descricao='$c_tabela' and procedimentos_tabelas.id_procedimento='$id_proc'";
        $result = $conection->query($c_sql);
        $registro = $result->fetch_assoc();
        if ($registro) {
            $msg_erro = "Já tabela cadastrada para esse procedimento!!";
            break;
        }
        // pego codigo da tabela selecionada
        $c_sql = "select * from tabela where descricao='$c_tabela'";
        $result = $conection->query($c_sql);
        $registro = $result->fetch_assoc();
        $c_id_tabela = $registro['id'];  // pego id da tabelaselecionada
        $i_indice = $registro['id_indice']; // pego a id do incice utilizado
        // sql para pegar o valor do indice
        $c_sqlindice = "select * from indices where id='$i_indice'";
        $resultindice = $conection->query($c_sqlindice);
        $registroindice = $resultindice->fetch_assoc();
        $c_valor = ($registroindice['valor'] * $c_custo);
        echo $registroindice['valor'];
        echo $c_valor;
        // grava dados no banco
        // faço a Leitura da tabela com sql
        $c_sql = "Insert into procedimentos_tabelas (id_procedimento, id_tabela, custo, valorreal)" .
            "Value ('$id_proc', '$c_id_tabela', '$c_custo', '$c_valor' )";

        $result = $conection->query($c_sql);
        // verifico se a query foi correto
        if (!$result) {
            die("Erro ao Executar Sql!!" . $conection->connect_error);
        }

        $msg_gravou = "Dados Gravados com Sucesso!!";

        header('location: /smedweb/cadastros/procedimentos/procedimentos_tabela_lista.php');
    } while (false);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/smedweb/css/basico.css">
    <title>SmedWeb - Nova Tabela do Procedimento</title>
</head>

<div class="container-fluid">
    <div class="panel panel-primary class">
        <div class="panel-heading text-center">
            <h4>SmartMed - Sistema Médico</h4>
            <h5>Nova Tabela do Procedimento<h5>
        </div>
    </div>
</div>
<br>
<div class="container content-box">

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
                <label class="col-md-3 form-label">Tabela (*)</label>
                <div class="col-sm-3">
                    <select class="form-control form-control-lg" id="addtabelaField" name="addtabelaField">
                        <?php
                        $c_sql = "SELECT tabela.id, tabela.descricao FROM tabela ORDER BY tabela.descricao";
                        $result = $conection->query($c_sql);

                        // insiro os registro do banco de dados na tabela 
                        while ($c_linha = $result->fetch_assoc()) {
                            echo
                            "<option>$c_linha[descricao]</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="addcustoField" class="col-md-3 form-label">Custo (*)</label>
                <div class="col-md-3">
                    <input type="number" class="form-control" id="addcustoField" name="addcustoField">
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
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3">
                    <button type="submit" class="btn btn-primary"><span class='glyphicon glyphicon-floppy-saved'></span> Salvar</button>
                    <a class='btn btn-danger' href='/smedweb/cadastros/procedimentos/procedimentos_tabela_lista.php'><span class='glyphicon glyphicon-remove'></span> Cancelar</a>
                </div>

            </div>
        </form>
</div>

</body>

</html>