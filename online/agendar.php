<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <script>
        function confirmarAgendamento() {
            return confirm("Confirma o agendamento para o horário selecionado?");
        }
    </script>
    <!-- monto formulários para pegar telefone e email do paciente e confirmar agendamento -->
    <?php
    include("..\links.php");
    include("..\conexao.php");
    // recebo os parâmetros da URL
    $medico_id = $_GET['medico'];
    $data_agendamento = $_GET['data_agendamento'];
    $horario_id = $_GET['horario_id'];
    // inicio de sessão
    session_start();
    // coloco id do horario na sessão
    $_SESSION['horario_id'] = $horario_id;
    // pego o id do convenio informado no select
    ?>
    <div class="container -my5">
        <div class="agendamento-container">

            <form action="finaliza_agendamento.php" method="POST" id="confirmaAgendamentoForm" onsubmit="return confirmarAgendamento()">
                <input type="hidden" name="medico_id" value="<?php echo $medico_id; ?>">
                <input type="hidden" name="data_agendamento" value="<?php echo $data_agendamento; ?>">
                <input type="hidden" name="horario_id" value="<?php echo $horario_id; ?>">
                <!-- radio button para primeira vez sim ou não -->
                <div class="form-group">
                    <label class="col-sm-6 col-form-label"><span>Primeira Consulta?</span></label>
                    <div class="form-check">
                        <label for="masculino">
                            <input type="radio" name="primeira" id="primeira_sim" value="Sim" checked>
                            <span>Sim</span>
                        </label>
                        <label for="feminino">
                            <input type="radio" name="primeira" id="primeira_nao" value="Não">
                            <span>Não</span>
                        </label>
                    </div>
                </div>

                <!-- select com os convênios disponíveis na tabela de convênios -->
                <div class="form-group">
                    <label for="convenio">Convênio:</label>
                    <select id="convenio" class="form-control form-control-lg" name="convenio" required>
                        <option value="">Selecione um convênio</option>
                        <?php
                        // preparo sql para buscar convênios na tabela convenios
                        $c_sql_convenio = "SELECT id, nome FROM convenios ORDER BY nome";
                        $resultado = $conection->query($c_sql_convenio);
                        while ($registro_convenio = $resultado->fetch_assoc()) {
                            echo "<option value='" . $registro_convenio['id'] . "'>" . $registro_convenio['nome'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="telefone">Telefone:</label>
                    <input type="text" class="form-control" id="telefone" name="telefone" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <button class="btn btn-primary btn-block" type="submit">Confirmar Agendamento
                </button>
            </form>
        </div>
    </div>
</body>

</html>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
    }

    .agendamento-container {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        max-width: 400px;
        margin: 50px auto;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    .form-control {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
    }

    .btn {
        background-color: #28a745;
        color: #fff;
        border: none;
        padding: 10px;
        cursor: pointer;
        width: 100%;
    }

    .btn:hover {
        background-color: #218838;
    }
</style>