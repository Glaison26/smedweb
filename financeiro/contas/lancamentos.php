<?php
include_once('../../links.php');
// arquivo de conexao com o banco de dados
include_once('../../conexao.php');
$msg_erro = "";

?>
<!-- html para lançamento de contas de pacientes -->
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smed - Lançamento de Contas</title>

</head>


<body>
    <div class="container -my5">
        <header>
            <div class="panel panel-primary class">
                <div class="panel-heading text-center">
                    <h4>SmartMed - Sistema Médico</h4>
                    <h5>Lançamento de Contas de Paciêntes<h5>
                </div>
            </div>

            <?php
            if (!empty($msg_erro)) {
                echo "
            <div class='alert alert-warning' role='alert'>
                <h4>$msg_erro</h4>
            </div>
                ";
            }
            ?>
            <div class='alert alert-info' role='alert'>
                <h5>Campos com (*) são obrigatórios</h5>
            </div>
        </header>
        <main>
            <form action="processar_lancamento.php" class="form-horizontal" method="POST">
                <div class="row mb-3">
                    <!-- Campo para selecionar o paciente -->
                    <label for="paciente_id" class="col-sm-2 col-form-label">*Paciente:</label>
                    <div class="col-sm-6">
                        <select class="form-control form-control-lg" id="paciente_id" name="paciente_id" required>
                            <option value="">Selecione o Paciente</option>
                            <?php
                            // SQL para buscar os pacientes
                            $sql_pacientes = "SELECT id, nome FROM pacientes ORDER BY nome ASC";
                            $result_pacientes = $conection->query($sql_pacientes);
                            while ($row = $result_pacientes->fetch_assoc()) {
                                echo "<option value='" . $row['id'] . "'>" . $row['nome'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <!-- campo para selecionar o procedimento -->
                <div class="row mb-3">
                    <label for="procedimento_id" class="col-sm-2 col-form-label">*Procedimento:</label>
                    <div class="col-sm-6">
                        <select class="form-control form-control-lg" id="procedimento_id" name="procedimento_id" required>
                            <option value="">Selecione o Procedimento</option>
                            <?php
                            // SQL para buscar os procedimentos
                            $sql_procedimentos = "SELECT id, descricao FROM procedimentos ORDER BY descricao ASC";
                            $result_procedimentos = $conection->query($sql_procedimentos);
                            while ($row = $result_procedimentos->fetch_assoc()) {
                                echo "<option value='" . $row['id'] . "'>" . $row['descricao'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <!-- campo para data, valor e descrição do lançamento -->
                <div class="row mb-6">
                    <label for="data" class="col-sm-2 col-form-label">*Data do Lançamento:</label>
                    <div class="col-sm-3">
                        <input type="date" class="form-control" id="data" name="data" required>
                    </div>
                </div>
                <br>
                <div class="row mb-3">
                    <label for="valor" class="col-sm-2 col-form-label">*Valor:</label>
                    <div class="col-sm-3">
                        <input type="number" class="form-control" id="valor" name="valor" step="0.01" required>
                    </div>
                </div>
                <div class="row mb-3">
                     <label for="descricao" class="col-sm-2 col-form-label">Descrição:</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="descricao" name="descricao" required></textarea>
                    </div>
                </div>
                <hr>
                <button class="btn btn-primary" type="submit"><span class='glyphicon glyphicon-floppy-saved'></span> Lançar Conta</button>
                <a class='btn btn-danger' href='/smedweb/menu.php'><span class='glyphicon glyphicon-remove'></span> Cancelar</a>
            </form>
        </main>
    </div>
</body>

</html>