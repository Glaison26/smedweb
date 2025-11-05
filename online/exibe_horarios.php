<?php
// monto tabela de horários disponíveis para o médico selecionado na data escolhida
include("..\links.php");
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container -my5">
        <!-- monto tabela de horários disponíveis para o médico selecionado na data escolhida -->
        <div class="panel panel-primary class">
            <div class="panel-heading text-center">
                <h4>SmartMed - Sistema Médico</h4>
                <h5>Lista de Horários Disponíveis<h5>
            </div>
        </div>
         <div class="panel panel-success class">
            <div class="panel-heading text-center">
               <!--mostro o nome do médico e a data escolhida-->
               <?php
                
                // recebo os dados do formulário
                $medico_id = $_POST['medico'];
                $data_agendamento = $_POST['data_agendamento'];
                // preparo sql para buscar o nome do médico
                $c_sql_medico = "SELECT nome FROM profissionais WHERE id = $medico_id";
                $result_medico = $conection->query($c_sql_medico);
                $registro_medico = $result_medico->fetch_assoc();
                $medico_nome = $registro_medico['nome'];
                echo "<h4>Médico: " . $medico_nome . " - Data: " . date('d/m/Y', strtotime($data_agendamento)) . "</h4>";
                ?>
            </div>
        </div>
        <table class="table display table-bordered tabhorários">
            <thead class="thead">
                <tr class="info">
                    <th scope="col">Horário Disponível</th>
                    <th scope="col">Agendar</th>

                </tr>
            </thead>
            <?php
            // verifico se há horários disponíveis
            if ($result->num_rows > 0) {
                // percorro os horários disponíveis
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['horario'] . "</td>";
                    echo "<td><a class='btn btn-success ' href='confirma_agendamento.php?horario_id=" . $row['id'] . "'>Agendar</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='2'>Nenhum horário disponível para o médico e data selecionados.</td></tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>