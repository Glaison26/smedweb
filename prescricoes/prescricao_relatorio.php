<?php
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

include_once "../lib_gop.php";
include("../conexao.php"); // conexão de banco de dados
include("../links.php");

if (isset($_GET["id"])) {
    $c_id = $_GET["id"]; // pego a id do paciente
    $_SESSION['refid'] = $c_id;
} else {
    $c_id = $_SESSION['refid'];
}
// sql para pegar dados do paciente selecionado
// sql para pegar dados do paciente selecionado
if ($_SESSION['relatorio'] == "") {
    $c_relatorio = "Inserir texto do relatório aqui";
} else {
    $c_relatorio = $_SESSION['relatorio'];
}

$c_sql = "select pacientes.id, pacientes.nome from pacientes where pacientes.id='$c_id'";
$result = $conection->query($c_sql);
// verifico se a query foi correto
if (!$result) {
    die("Erro ao Executar Sql!!" . $conection->connect_error);
}
$c_linha = $result->fetch_assoc();
// rotina de registro de prescrição medicamento na história clinica do paciente
if ((isset($_POST["btnregistro"]))) {
    // verifico se paciente tem registro de historia
    $c_relatorio = $_POST['id_texto'];
    $c_sql_contador = "select count(*) as contador from historia where id_paciente='$c_id'";
    $result_contador = $conection->query($c_sql_contador);
    $c_linha_contador = $result_contador->fetch_assoc();
    // se não tem historia insiro informação
    $hoje = date('d/m/Y');
    if ($c_linha_contador['contador'] == 0) {
        $c_historia = "$hoje" . "\r\n" . "Relatório Médico Emitido" .
            "\r\n" . $c_prescricao;
        $c_sql_historia = "insert into historia (id_paciente, historia) value ('$c_id', '$c_historia')";
        $result_historia = $conection->query($c_sql_historia);
        // se tem história acrescento com update no registro do pacinte
    } else {
        $c_sql_historia = "select historia.historia from historia where historia.id_paciente='$c_id'";
        $c_result_historia = $conection->query($c_sql_historia);
        $c_linha_historia = $c_result_historia->fetch_assoc();

        $c_historia = $c_linha_historia['historia'] . "\r\n" . "\r\n" . "$hoje" . "\r\n" . "Relatório Médico Emitido" .
            "\r\n" . $c_relatorio;
        $c_sql_historia = "update historia set historia = '$c_historia' where id_paciente='$c_id'";
        $result_historia = $conection->query($c_sql_historia);
        echo "
          <script>
          alert('Relatório Medico registrado na história clinica do paciente!!!');
          </script>
        ";
    }
}

// botão para emissão de relatório médico
// verifico se o botão foi pressionado
if ((isset($_POST["btnprint"]))) {
    $_SESSION['relatorio'] = $_POST['prescricao'];
    $_SESSION['paciente'] = $c_linha['nome'];
    $_SESSION['profissional'] = $_POST['profissional'];
    $c_relatorio = $_POST['prescricao'];
    echo "<script> window.open('/smedweb/prescricoes/rel_relatorio.php?id=', '_blank');</script>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="panel panel-primary class">
        <div class="panel-heading text-center">
            <h4>SmartMed - Sistema Médico</h4>
            <h5>Relatório Médico<h5>
        </div>
    </div>

    <div class="container -my5">
        <form method="post">
            <button type='submit' id='btnprint' name='btnprint' class='btn btn-light' data-toggle='modal' title='Emitir relatório médico'>
                <img src='\smedweb\images\printer.png' alt='' width='20' height='20'> Emitir Prescrição
            </button>
            <button type='submit' id='btnregistro' name='btnregistro' class='btn btn-light' data-toggle='modal' title='Registra prescrição no histórico do paciente'>
                <img src='\smedweb\images\registro.png' alt='' width='20' height='20'> Registrar Prescrição</button>
            <input type='hidden' name='id_texto' id='id_texto' value="<?php echo $c_relatorio ?>">
            <a class="btn btn-light" href="/smedweb/prescricoes/prescricao.php"><img src='\smedweb\images\voltar.png' alt='' width='20' height='20'> Voltar</a>

            <hr>
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h4>Identificação do Paciente:<?php echo ' ' . $c_linha['nome']; ?></h4>
                </div>
            </div>
            <!-- Formulário com os profissionais para seleção -->
            <div class="panel panel-Linght">
                <div class="panel-heading">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Profissional</label>
                        <div class="col-sm-6">
                            <select class="form-control form-control-lg" id="profissional" name="profissional">
                                <?php
                                $c_sql = "SELECT profissionais.id, profissionais.nome FROM profissionais
                                        ORDER BY profissionais.nome";
                                $result = $conection->query($c_sql);
                                // insiro os registro do banco de dados na tabela 
                                while ($c_linha = $result->fetch_assoc()) {
                                    $c_op = "";
                                    if ($c_linha['nome'] == $c_profissional) {
                                        $c_op = "selected";
                                    }
                                    echo "
                                     <option $c_op>$c_linha[nome]</option>";
                                }
                                ?>
                            </select>

                        </div>
                    </div>
                </div>
            </div>
            <!-- fim do formulário de seleção de profissionais -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#prescricao" aria-controls="home" role="tab" data-toggle="tab">Editar Prescrição</a></li>

            </ul>
            <!-- paginas de edição medicamentos cadastrados -->
            <div class="tab-content">
                <!-- aba de edição de medicamentos -->
                <div role="tabpanel" class="tab-pane active" id="prescricao">
                    <div style="padding-top:5px;">
                        <div style="padding-top:20px;">
                            <div class="form-group">
                                <label class="col-sm-2 col-form-label">Texto da Prescrição</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" id="prescricao" name="prescricao" rows="15"><?php echo $c_relatorio; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>


</body>

</html>