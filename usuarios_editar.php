<?php // controle de acesso ao formulário
session_start();

if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

function carregadados()
{
    $msg_erro = "CPF Inválido! Favor verificar.";
    $c_nome = $_POST['nome'];
    $c_login = $_POST['login'];
    $c_senha = $_POST['senha'];
    $c_senha2 = $_POST['senha2'];
    $c_tipo = $_POST['tipo'];
    $c_email = $_POST['email'];
    $c_telefone = $_POST['telefone'];
    if (!isset($_POST['chkativo'])) {
        $c_ativo = 'N';
    } else {
        $c_ativo = 'S';
    }
}

include("conexao.php");
include("links.php");
include_once "lib_gop.php";

// rotina de post dos dados do formuário
$c_id = "";
$c_nome = "";
$c_login = "";
$c_senha = "";
$c_senha2 = "";
$c_tipo = "";
$c_email = '';
$c_telefone = '';
$c_ativo = "";


// variaveis para mensagens de erro e suscessso da gravação
$msg_gravou = "";
$msg_erro = "";


if ($_SERVER['REQUEST_METHOD'] == 'GET') {  // metodo get para carregar dados no formulário

    if (!isset($_GET["id"])) {
        header('location: /smedweb/usuarios_lista.php');
        exit;
    }
    $c_id = $_GET["id"];
    // leitura do cliente através de sql usando id passada
    $c_sql = "select * from usuario where id=$c_id";
    $result = $conection->query($c_sql);
    $registro = $result->fetch_assoc();

    if (!$registro) {
        header('location: /smedweb/usuarios_lista.php');
        exit;
    }
    $c_nome = $registro["nome"];
    $c_login = $registro['login'];

    $c_senha = base64_decode($registro['senha']);  // senha descriptografia
    $c_senha2 = $c_senha;
    $c_ativo = $registro['ativo'];
    $c_tipo = $registro['tipo'];
    $c_id_perfil = $registro['id_perfil'];

    $c_telefone = $registro['telefone'];
    $c_email = $registro['email'];

    if ($c_ativo == 'S') {
        $c_statusativo = 'checked';
    } else {
        $c_statusativo = '';
    }
    // tipo


} else {
    // metodo post para atualizar dados
    $c_id = $_POST["id"];
    $c_nome = $_POST['nome'];
    $c_login = $_POST['login'];
    $c_senha = $_POST['senha'];
    $c_senha2 = $_POST['senha2'];
    $c_tipo = $_POST['tipo'];
    $c_email = $_POST['email'];
    $c_telefone = $_POST['telefone'];
    
    if (!isset($_POST['chkativo'])) {
        $c_ativo = 'N';
    } else {
        $c_ativo = 'S';
    }
    if ($c_tipo == 'Administrador') {
        $c_tipo = '1';
    }
    if ($c_tipo == 'Operador') {
        $c_tipo = '2';
    }

    do {
        if (
            empty($c_nome) || empty($c_login) || empty($c_senha) || empty($c_tipo)
            || empty($c_senha2) || empty($c_email) || empty($c_telefone)
        ) {
            $msg_erro = "Todos os Campos com (*) devem ser preenchidos, favor verificar!!";
            break;
        }
        // consiste email
        if (!validaEmail($c_email)) {
            $msg_erro = " E-mail informado inválido!!";
            break;
        }

        // consiste se senha igual a confirmação
        if ($c_senha != $c_senha2) {
            $msg_erro = "Senha digitada diferente da senha de confirmação!!";
            break;
        }
        $i_tamsenha = strlen($c_senha);
        if (($i_tamsenha < 8) || ($i_tamsenha > 30)) {
            $msg_erro = "Campo Senha deve ter no mínimo 8 caracteres e no máximo 30 caracteres";
            carregadados();
            break;
        }
        // consistencia se já existe login cadastrado
        $c_sql = "select * from usuario where login='$c_login' and id<>$c_id";
        $result = $conection->query($c_sql);
        $registro = $result->fetch_assoc();
        if ($registro) {
            $msg_erro = "Já existe este login cadastrado!!";
            break;
        }
        // grava dados no banco
        // criptografo senha
        $c_senha = base64_encode($c_senha);
        //sql para pegar a id do perfil selecionado no combobox
        $c_descricao_perfil = $_POST['perfil'];
        $c_sql_perfil = "select perfil_usuarios_opcoes.id 
        from perfil_usuarios_opcoes where perfil_usuarios_opcoes.descricao='$c_descricao_perfil'";
        $result = $conection->query($c_sql_perfil);
        $c_linha = $result->fetch_assoc();
        $i_id_perfil = $c_linha['id'];

        // faço a alteração do registro
        $c_sql = "Update Usuario" .
            " SET nome = '$c_nome', login ='$c_login',  email = '$c_email', telefone = '$c_telefone',
             senha ='$c_senha', ativo='$c_ativo', tipo='$c_tipo', id_perfil='$i_id_perfil'" .
            " where id=$c_id";

        $result = $conection->query($c_sql);

        // verifico se a query foi correto
        if (!$result) {
            die("Erro ao Executar Sql!!" . $conection->connect_error);
        }
        $msg_gravou = "Dados Gravados com Sucesso!!";
        header('location: /smedweb/usuarios_lista.php');
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
            <input type="hidden" name="id" value="<?php echo $c_id; ?>">

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nome(*)</label>
                <div class="col-sm-5">
                    <input type="text" maxlength="120" class="form-control" name="nome" value="<?php echo $c_nome; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Login(*)</label>
                <div class="col-sm-4">
                    <input type="text" maxlength="40" class="form-control" name="login" value="<?php echo $c_login; ?>">
                </div>
            </div>
            <?php

            $op1 = '';
            $op2 = '';

            if ($c_tipo == '1') {
                $op1 = 'Selected';
            }
            if ($c_tipo == '2') {
                $op2 = 'Selected';
            }
            ?>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Tipo de usuário </label>
                <div class="col-sm-2">
                    <select class="form-control form-control-lg" id="tipo" name="tipo" value="<?php echo $c_tipo; ?>">
                        <option <?php echo $op1 ?>>Administrador</option>
                        <option <?php echo $op2 ?>>Operador</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Perfil do Usuário</label>
                <div class="col-sm-2">
                    <select class="form-control form-control-lg" id="perfil" name="perfil">
                        <?php
                        $c_sql = "SELECT perfil_usuarios_opcoes.id, perfil_usuarios_opcoes.descricao
                                  FROM perfil_usuarios_opcoes ORDER BY perfil_usuarios_opcoes.descricao";
                        $result = $conection->query($c_sql);
                        // insiro os registro do banco de dados na tabela 
                        while ($c_linha = $result->fetch_assoc()) {
                            if ($c_linha['id']==$c_id_perfil){
                                $c_op = 'selected';
                            }
                            else {
                                $c_op='';
                                }
                            echo "<option $c_op>$c_linha[descricao]</option>";
                        }
                        ?>

                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">e-mail(*)</label>
                <div class="col-sm-6">
                    <input type="text" maxlength="120" class="form-control" name="email" value="<?php echo $c_email; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Telefone(*)</label>
                <div class="col-sm-3">
                    <input type="text" maxlength="120" class="form-control" name="telefone" value="<?php echo $c_telefone; ?>">
                </div>
            </div>
            <hr>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Senha(*)</label>
                <div class="col-sm-3">
                    <input type="password" maxlength="32" class="form-control" name="senha" value="<?php echo $c_senha; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Senha de Confirmação(*)</label>
                <div class="col-sm-3">
                    <input type="password" maxlength="32" class="form-control" name="senha2" value="<?php echo $c_senha2; ?>">
                </div>
            </div>
            <hr>
            <div class="row mb-3">
                <div class="form-check col-sm-3">
                    <label class="form-check-label col-form-label">Usuário Ativo</label>
                    <div class="col-sm-3">
                        <input class="form-check-input" type="checkbox" value="S" name="chkativo" id="chkativo" checked>
                    </div>
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
                        <a class='btn btn-danger' href='/smedweb/usuarios_lista.php'><span class='glyphicon glyphicon-remove'></span> Cancelar</a>
                    </div>

                </div>
            </footer>
        </form>
    </div>

</body>

</html>