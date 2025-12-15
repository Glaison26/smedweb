<?php // controle de acesso ao formulário
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

function carregadados()
{
    $c_tabela = $_POST['addtabelaField'];
    $c_custo = $_POST['addcustoField'];
}

include("../../conexao.php");
include_once "../../lib_gop.php";
include("../../links.php");

// rotina de post dos dados do formuário
$c_id = "";
$c_tabela = "";
$c_custo = "";
$c_valor = "";
$id_proc = $_SESSION['codigo_proc'];


// variaveis para mensagens de erro e suscessso da gravação
$msg_gravou = "";
$msg_erro = "";


if ($_SERVER['REQUEST_METHOD'] == 'GET') {  // metodo get para carregar dados no formulário

    if (!isset($_GET["id"])) {
        header('location: /smedweb/cadastros/procedimentos/procedimentos_tabela_lista.php');
        exit;
    }
    $c_id = $_GET["id"];
    // leitura do cliente através de sql usando id passada
    $c_sql = "SELECT procedimentos.descricao AS procedimento, procedimentos_tabelas.id_procedimento,
             procedimentos_tabelas.id_tabela, tabela.descricao as tabela,
             procedimentos_tabelas.id, procedimentos_tabelas.custo, procedimentos_tabelas.valorreal, indices.descricao as indice 
             FROM procedimentos_tabelas
             JOIN procedimentos ON procedimentos_tabelas.id_procedimento=procedimentos.id
             JOIN tabela ON procedimentos_tabelas.id_tabela=tabela.id
             JOIN indices ON tabela.id_indice=indices.id  where procedimentos_tabelas.id=$c_id";

    $result = $conection->query($c_sql);
    $registro = $result->fetch_assoc();

    if (!$registro) {
        header('location: /smedweb/cadastros/procedimentos/procedimentos_tabela_lista.php');
        exit;
    }
    $c_tabela = $registro["tabela"];
    $c_custo = $registro['custo'];
    $fmt = new NumberFormatter('de_DE', NumberFormatter::CURRENCY);
    $c_valor = $registro['valorreal'];
    $c_valor = 'R$ ' . $fmt->formatCurrency($c_valor, "   ") . "\n";
} else {
    // metodo post para atualizar dados
    $c_id = $_POST["id"];
    $c_tabela = $_POST['uptabelaField'];
    $c_custo = $_POST['upcustoField'];
    $c_tabela_anterior = $c_tabela;


    do {
        if (
            empty($c_tabela) || empty($c_custo)
        ) {
            $msg_erro = "Todos os Campos com (*) devem ser preenchidos, favor verificar!!";
            break;
        }

        // consistencia se já existe tabela cadastrado
        // consistencia se tabela selecionada já existe no procedimento
        $c_sql = "SELECT procedimentos_tabelas.id_tabela, tabela.descricao, procedimentos_tabelas.id 
                  FROM procedimentos_tabelas
                  JOIN tabela ON procedimentos_tabelas.id_tabela=tabela.id
                  WHERE tabela.descricao='$c_tabela' and procedimentos_tabelas.id_procedimento='$id_proc'
                   and procedimentos_tabelas.id<>'$c_id'";
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
        // faço a alteração do registro
        $c_sql = "Update procedimentos_tabelas" .
            " SET id_tabela = '$c_id_tabela', custo ='$c_custo',  valorreal = '$c_valor' where id=$c_id";
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
    <title>SmedWeb - Editar Tabela do Procedimento</title>

</head>

<body>
    <div class="container-fluid">
        <div class="panel panel-primary class">
            <div class="panel-heading text-center">
                <h4>SmartMed - Sistema Médico</h4>
                <h5>Novo Usuário do Sistema<h5>
            </div>
        </div>
    </div>
    <br>
    <div class="container content-box">
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
                <label class="col-md-3 form-label">Tabela (*)</label>
                <div class="col-sm-3">
                    <select class="form-control form-control-lg" id="uptabelaField" name="uptabelaField">
                        <?php
                        $c_sql = "SELECT tabela.id, tabela.descricao FROM tabela ORDER BY tabela.descricao";
                        $result = $conection->query($c_sql);

                        // insiro os registro do banco de dados na tabela 
                        while ($c_linha = $result->fetch_assoc()) {
                            $op = "";
                            if ($c_linha['descricao'] == $c_tabela) {
                                $op = 'Selected';
                            }
                            echo
                            "<option $op>$c_linha[descricao]</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="upcustoField" class="col-md-3 form-label">Custo (*)</label>
                <div class="col-md-3">
                    <input type="number" required class="form-control" id="addcustoField" name="upcustoField" value="<?php echo $c_custo; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="upvalorField" class="col-md-3 form-label">Valor em R$</label>
                <div class="col-md-3">
                    <input type="text" readonly class="form-control" id="upvalorField" name="upvalorField" value="<?php echo $c_valor; ?>">
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
                        <a class='btn btn-danger' href='/smedweb/cadastros/procedimentos/procedimentos_tabela_lista.php'><span class='glyphicon glyphicon-remove'></span> Cancelar</a>
                    </div>

                </div>
            </footer>
        </form>
    </div>

</body>

</html>