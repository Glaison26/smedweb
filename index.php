<?php
include("conexao.php");
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $l_erro = '';
} else {
    session_start();
    unset($_SESSION['newsession']);
    // seções para agenda
    $_SESSION['nomepac'] = "";
    $_SESSION['conveniopac'] = "";
    $_SESSION['telefonepac'] = "";
    $_SESSION['emailpac'] = "";
    $_SESSION['matriculapac'] = "";
    $_SESSION['incagenda'] = false;
    //
    $c_login = $_POST['login'];
    $c_sql = "SELECT count(*) as achou FROM usuario where usuario.login='$c_login'";
    $result = $conection->query($c_sql);
    // verifico se a query foi correto
    if (!$result) {
        die("Erro ao Executar Sql !!" . $conection->connect_error);
    }
    $c_linha = $result->fetch_assoc();
    if ($c_login == 'xxx') {  // usuário e senha para entrar sem senha
        $_SESSION["newsession"] = "smed";
        $_SESSION['c_usuario'] = $c_login;
        $_SESSION['c_tipo'] = '1';
        $_SESSION['c_nome'] = $registro['nome']; // nome do usuário
        //
        header('location: /smedweb/menu.php');
    }
    if ($c_linha['achou'] == 0) {  // não achou usuário
        $l_erro = 'Usuário ou senha inválido!!!';
    } else {
        // procuro senha
        $c_sql = "SELECT usuario.senha, usuario.tipo, usuario.nome FROM usuario where usuario.login='$c_login'";
        $result = $conection->query($c_sql);
        $registro = $result->fetch_assoc();
        $c_senha = base64_decode($registro['senha']); // descriptografa senha
        if ($c_senha != $_POST['senha']) {  // não achou senha
            $l_erro = 'Usuário ou senha inválido!!!';
        } else {
            $l_erro = ' ';
            $_SESSION["newsession"] = "smed"; // passagem da segurança
            $_SESSION['c_usuario'] = $c_login; // login digitado
            $_SESSION['c_tipo'] = $registro['tipo']; // tipo do usuário
            $_SESSION['c_nome'] = $registro['nome']; // nome do usuário
            header('location: /smedweb/menu.php');
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Smed - Sistema Médico</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" type="imagex/png" href="./images/smed_icon.ico">

</head>
<div class="clearfix" style="display:none"></div>

<body>


    <div class="login-container">
        <h2>Login do Sistema Smed</h2>


        <?php
        if (!empty($l_erro)) {
            echo "
              <div class='alert alert-warning' role='alert'>
              <h4>$l_erro</h4>
              </div>
            ";
        }
        ?>

        <form method="post">

            <div class="form-group row" class="form-control">
                <label class="col-sm-3 col-form-label">Login</label>
                <div class="col-xs-12">
                    <input type="text" maxlength="40" class="form-control" required name="login" placeholder="Digite o login">
                </div>
            </div>

            <div class="form-group row" class="form-control">
                <label class="col-sm-3 col-form-label">Senha</label>
                <div class="col-xs-12">
                    <input type="password" name="senha" class="form-control" required placeholder="Entre com sua senha">
                </div>
            </div>
            <button class="btn btn-primary btn-block" name="btnentra" type="submit">Entrar</button>
        </form>
    </div>


    </div>
</body>

</html>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .login-container {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .login-container h2 {
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
    }

    .form-group input {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
    }