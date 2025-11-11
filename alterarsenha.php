<!-- crio htmp para alterar senha -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMEDWEB - Alterar Senha</title>
    <?php include("links.php"); ?>
</head>

<body>
    <div class="container">
        <h2>Alterar Senha</h2>
        <form action="processa_alterar_senha.php" method="POST">
            <div class="form-group">
                <label for="senha_atual">Senha Atual:</label>
                <input type="password" class="form-control" id="senha_atual" name="senha_atual" required>
            </div>
            <div class="form-group">
                <label for="nova_senha">Nova Senha:</label>
                <input type="password" class="form-control" id="nova_senha" name="nova_senha" required>
            </div>
            <div class="form-group">
                <label for="confirma_senha">Confirme a Nova Senha:</label>
                <input type="password" class="form-control" id="confirma_senha" name="confirma_senha" required>
            </div>
            <button type="submit" class="btn btn-primary">Alterar Senha</button>
        </form>
    </div>
</body>

</html>

<!-- css modal para o formulário -->
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .container {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 300px;
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    input[type="password"] {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
    }

    .btn {
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn:hover {
        background-color: #0056b3;
    }   
</style>