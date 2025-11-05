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
    <!-- monto tabela de horários disponíveis para o médico selecionado na data escolhida -->
    <h2>Horários Disponíveis</h2>
    <table border="1" cellpadding="10">
        <tr>
            <th>Horário</th>
            <th>Ação</th>
        </tr>
        <?php
        // verifico se há horários disponíveis
        if ($result->num_rows > 0) {
            // percorro os horários disponíveis
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['horario'] . "</td>";
                echo "<td><a href='confirma_agendamento.php?horario_id=" . $row['id'] . "'>Agendar</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='2'>Nenhum horário disponível para o médico e data selecionados.</td></tr>";
        }
        ?>
</body>
</html>