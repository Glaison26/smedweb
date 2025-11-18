<?php
include("../links.php");
?>
<!-- html para entrada no sistema online solicitando numero de identificação  e cpf  -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Online de Agendamento</title>

</head>

<body>
    <div class="login-container">
        <!-- mensagem de erro no topo do navegador se login incorreto -->
        <?php
        if (isset($_GET['error']) && $_GET['error'] == 1) {
            echo "<div class='alert alert-warning' role='alert'>
            <h5>Identificação ou CPF incorretos. Tente novamente.</h5>
        </div>";
        }
        ?>

        <div class="panel panel-primary class">
            <div class="panel-heading text-center">
                <h5><strong>Login para Agendamento OnLine</strong></h5>
            </div>
        </div>
        <form action="process_login.php" method="POST" id="loginForm">
            <div class="form-group">
                <label for="userId">Número de Identificação:</label>
                <input type="text" id="userId" name="userId" required>
            </div>
            <div class="form-group">
                <label for="cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf" required>
            </div>
            <button type="submit">Entrar</button>
        </form>
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

    button {
        width: 100%;
        padding: 10px;
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover {
        background-color: #218838;
    }
</style>