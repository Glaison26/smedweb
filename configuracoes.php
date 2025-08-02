<?php // controle de acesso ao formulário
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

include_once "lib_gop.php";
include("conexao.php"); // conexão de banco de dados
include("links.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {  // metodo get para carregar dados no formulário

    // leitura do convenio através de sql usando id passada
    $c_sql = "select * from config";
    $result = $conection->query($c_sql);
    $registro = $result->fetch_assoc();

    if (!$registro) {
        header('location: /smedweb/menu.php');
        exit;
    }
    // atribuição dos valores do banco de dados as variáveis
    $c_nome_clinica = $registro['nome_clinica'];
    $c_endereco = $registro['endereco_clinica'];
    $c_telefone = $registro['telefone_clinica'];
    $c_email = $registro['email_clinica'];
    $c_cidade = $registro['cidade_clinica'];
    $c_cnpj = $registro['cnpj_clinica'];
}
?>


<!--   front end da edição do formulário de configuração do sistema -->
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
            <h5>Edição de Configurações Gerais do Sistema<h5>
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
            <hr>
            <div class="mb-3 row">

                <label for="up_descricaoField" class="col-md-3 form-label">Descrição (*)</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="up_descricaoField" name="up_descricaoField" value="<?php echo $c_descricao; ?>">
                </div>

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