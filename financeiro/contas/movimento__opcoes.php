<!-- página para solicitar periodos de movimentação de contas com opões de radio com todas as contas
 ,por convênio e por paciente   -->
<?php
// arquivo de conexao com o banco de dados
include_once('../../conexao.php');
include_once('../../links.php');
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smed - Opções de Movimento de Contas</title>
</head>

<body>
    <div class="container -my5">
        <header>
            <div class="panel panel-primary class">
                <div class="panel-heading text-center">
                    <h4>SmartMed - Sistema Médico</h4>
                    <h5>Opções de Movimento de Contas<h5>
                </div>
            </div>
        </header>
        <main>
            <form method="post" action="movimento_contas.php">
                <br>
                <div class="mb-3 row">
                    <label class="col-md-3 form-label">Período Inicial*</label>
                    <div class="col-md-3">
                        <input type="date" required class="form-control" id="data_inicial" name="data_inicial">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-md-3 form-label">Período Final*</label>
                    <div class="col-md-3">
                        <input type="date" required class="form-control" id="data_final" name="data_final">
                    </div>
                </div>
                <hr>
                <div class="mb-3 row">
                    <label class="col-md-3 form-label">Opções de Filtro*</label>
                    <div class="col-md-6">
                        <input type="radio" required name="filtro" value="todas"> Todas as Contas<br>
                        <input type="radio" required name="filtro" value="convenio"> Por Convênio<br>
                        <input type="radio" required name="filtro" value="paciente"> Por Paciente<br>
                    </div>
                </div>
                <!-- incluir campos de seleção de convênio e paciente via javascript se opção selecionada -->
                <!-- campo convênio -->
                <div class="mb-3 row" id="campo_convenio" style="display:none;">
                    <label class="col-md-3 form-label">Convênio</label>
                    <div class="col-md-6">
                        <select class="form-control form-control-lg" id="convenio_id" name="convenio_id">
                            <option value="">Selecione o Convênio</option>
                            <?php
                            $sql_convenios = "SELECT id, nome FROM convenios ORDER BY nome";
                            $result_convenios = $conection->query($sql_convenios);
                            while ($row = $result_convenios->fetch_assoc()) {
                                echo "<option value='" . $row['id'] . "'>" . $row['nome'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <!-- campo paciente -->
                <div class="mb-3 row" id="campo_paciente" style="display:none;">
                    <label class="col-md-3 form-label">Paciente</label>
                    <div class="col-md-6">
                        <select class="form-control form-control-lg" id="paciente_id" name="paciente_id">
                            <option value="">Selecione o Paciente</option>
                            <?php
                            $sql_pacientes = "SELECT id, nome FROM pacientes ORDER BY nome";
                            $result_pacientes = $conection->query($sql_pacientes);
                            while ($row = $result_pacientes->fetch_assoc()) {
                                echo "<option value='" . $row['id'] . "'>" . $row['nome'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <script>
                    // JavaScript para mostrar/ocultar campos com base na seleção do filtro
                    document.querySelectorAll('input[name="filtro"]').forEach((elem) => {
                        elem.addEventListener("change", function(event) {
                            var value = event.target.value;
                            if (value === "convenio") {
                                document.getElementById("campo_convenio").style.display = "block";
                                document.getElementById("campo_paciente").style.display = "none";
                            } else if (value === "paciente") {
                                document.getElementById("campo_convenio").style.display = "none";
                                document.getElementById("campo_paciente").style.display = "block";
                            } else {
                                document.getElementById("campo_convenio").style.display = "none";
                                document.getElementById("campo_paciente").style.display = "none";
                            }
                        });
                    });
                </script>
                <hr>
                <button type="submit" class="btn btn-primary">Consultar Movimento</button>
                <a class='btn btn-danger' href='/smedweb/menu.php'><span class='glyphicon glyphicon-remove'></span> Cancelar</a>
            </form>
        </main>
    </div>
</body>

</html>