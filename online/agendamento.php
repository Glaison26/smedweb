<?php
// inicio de sessão
session_start();
include("..\links.php");
include("..\conexao.php");
// verifico se a sessão de login está ativa
if (!isset($_SESSION['userId'])) {
    header('Location: index.php');
    exit;
}
// pego o id do usuário logado
$userId = $_SESSION['userId'];

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Online de Agendamento</title>
</head>

<body>
    <!-- formulario de agendamento online -->
    <!-- solicito combobox com medicos da tabela profissionais medico e data para agendamento -->
    <div class="agendamento-container">
        <h2>Horários Disponíveis</h2>
        <form action="processa_agendamento.php" method="POST" id="agendamentoForm">
            <div class="form-group">
                <label for="medico">Médico:</label>
                <select id="medico"  class="form-control form-control-lg" name="medico" required>
                    <option value="">Selecione um médico</option>
                    <?php
                    // preparo sql para buscar medicos na tabela profissionais_medico
                    $c_sql = "SELECT id, nome FROM profissionais ORDER BY nome";
                    $result = $conection->query($c_sql);
                    while ($registro = $result->fetch_assoc()) {
                        echo "<option value='" . $registro['id'] . "'>" . $registro['nome'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="data_agendamento">Data do Agendamento:</label>
                <input type="date"  class="form-control" id="data_agendamento" name="data_agendamento" required>
            </div>
            <button class="btn btn-primary btn-block" type="submit">Pesquisar Horários disponíveis</button>
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

    .agendamento-container {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
</style>