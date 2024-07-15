<?php // controle de acesso ao formulário
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

include_once "lib_gop.php";
include("conexao.php"); // conexão de banco de dados
if ($_SERVER['REQUEST_METHOD'] == 'GET') {  // metodo get para carregar dados no formulário

    if (!isset($_GET["id"])) {
        header('location: /smedweb/config_agenda.php');
        exit;
    }
    $c_id = $_GET["id"];  // identificação do id do profissional
    //
    $c_sql_medico = "SELECT profissionais.nome FROM profissionais where id=$c_id";
    $result_medico = $conection->query($c_sql_medico);
    $c_linha_medico = $result_medico->fetch_assoc();

    // verifico se no arquivo de configurações ja existe registro dos dias da semana
    $c_sql = "SELECT COUNT(*) AS total FROM agendaconfig  where id_profissional='$c_id'";
    $result = $conection->query($c_sql);
    $c_linha = $result->fetch_assoc();
    // se não tem nenhum registro na tabela de configuração executo a rotina para criar os sete dias
    if ($c_linha['total'] == 0) {
        $i_contador = 1;
        while ($i_contador < 8) {
            $c_contador = strval($i_contador);
            $c_sql_insere = "Insert into agendaconfig (id_profissional, dia) value ('$c_id', '$c_contador')";
            $result = $conection->query($c_sql_insere);
            $i_contador++;
            $c_sql = "select * from agendaconfig where id_profissional='$c_id'";
            $result = $conection->query($c_sql);
        }
    } else {  // já tem registros na tabela de configuração pego os dados no sql
        $c_sql = "select * from agendaconfig where id_profissional='$c_id'";
        $result = $conection->query($c_sql);
    }
}
?>


<!-- parte em HTML -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartMed - Sistema Médico</title>
    <meta charset="utf-8">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link href="https://cdn.datatables.net/v/dt/jq-3.7.0/dt-2.0.3/datatables.min.css" rel="stylesheet">
    <link href="DataTables/datatables.min.css" rel="stylesheet">
</head>

<body>
    <!-- funções e chamadas em javascript -->
    <script scr="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script scr="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="DataTables/datatables.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://cdn.datatables.net/v/dt/jq-3.7.0/dt-2.0.3/datatables.min.js"></script>

    <div class="panel panel-primary class">
        <div class="panel-heading text-center">
            <h4>SmartMed - Sistema Médico</h4>
            <h5>Configuração da Agenda Médica<h5>
        </div>
    </div>

    <div class="container -my5">
        <a class='btn btn-Light' href='/smedweb/config_agenda.php'> <img src="\smedweb\images\voltar.png" alt="" width="15" height="15"> Voltar</a>
        <hr>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h4>Identificação do Paciente:<?php echo ' ' . $c_linha_medico['nome']; ?></h4>
            </div>
        </div>
      
        <hr>
        <table class="table display table-bordered tabconfig">
            <thead class="thead">
                <tr class="info">
                    <th scope="col" style="display:none">id</th>
                    <th scope="col">Dia</th>
                    <th class="bg-info" scope="col">Inicio</th>
                    <th class="bg-info" scope="col">Fim</th>
                    <th class="bg-info" scope="col">Duração</th>
                    <th class="bg-success" scope="col">Inicio</th>
                    <th class="bg-success" scope="col">Fim</th>
                    <th class="bg-success" scope="col">Duração</th>
                    <th class="bg-primary" scope="col">Inicio</th>
                    <th class="bg-primary" scope="col">Fim</th>
                    <th class="bg-primary" scope="col">Duração</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // insiro os registro do banco de dados na tabela 
                while ($c_linha = $result->fetch_assoc()) {
                    // montagem dos dias da semana
                    switch ($c_linha['dia']) {
                        case "1":
                            $c_dia = 'Segunda-Feira';
                            break;
                        case "2":
                            $c_dia = 'Terça-Feira';
                            break;
                        case "3":
                            $c_dia = 'Quarta-Feira';
                            break;
                        case "4":
                            $c_dia = 'Quinta-Feira';
                            break;
                        case "5":
                            $c_dia = 'Sexta-Feira';
                            break;
                        case "6":
                            $c_dia = 'Sábado-Feira';
                            break;
                        case "7":
                            $c_dia = 'Domingo';
                            break;
                    }
                    // Coloco string sim ou não ao invés de s ou n
                    echo "
                            <tr>
                            <td style='display:none'>$c_linha[id]</td>
                            <td>$c_dia</td>
                            <td>$c_linha[inicio1]</td>
                            <td>$c_linha[fim1]</td>
                            <td>$c_linha[duracao1]</td>
                            <td>$c_linha[inicio2]</td>
                            <td>$c_linha[fim2]</td>
                            <td>$c_linha[duracao2]</td>
                            <td>$c_linha[inicio3]</td>
                            <td>$c_linha[fim3]</td>
                            <td>$c_linha[duracao3]</td>
              
            </tr>
            ";
                }
                ?>
            </tbody>
        </table>
    </div>


</body>

</html>