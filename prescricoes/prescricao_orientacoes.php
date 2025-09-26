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

$c_orientacao = $_SESSION['orientacao'] ?? '';
$c_sql = "select pacientes.id, pacientes.nome from pacientes where pacientes.id='$c_id'";
$result = $conection->query($c_sql);
// verifico se a query foi correto
if (!$result) {
    die("Erro ao Executar Sql!!" . $conection->connect_error);
}
$c_linha = $result->fetch_assoc();
// rotina de registro de atestado na história clinica do paciente
if ((isset($_POST["btnregistro"]))) {
    // verifico se paciente tem registro de historia
    $c_orientacao = $_POST['id_texto'];
    $c_sql_contador = "select count(*) as contador from historia where id_paciente='$c_id'";

    $result_contador = $conection->query($c_sql_contador);
    $c_linha_contador = $result_contador->fetch_assoc();
    // se não tem historia insiro informação
    if ($c_linha_contador['contador'] == 0) {
        $c_historia = "$hoje" . "\r\n" . "Orientação Médica Emitido" .
            "\r\n" . $c_orientacao;
        $c_sql_historia = "insert into historia (id_paciente, historia) value ('$c_id', '$c_historia')";
        $result_historia = $conection->query($c_sql_historia);
        // se tem história acrescento com update no registro do pacinte
    } else {
        $c_sql_historia = "select historia.historia from historia where historia.id_paciente='$c_id'";
        $c_result_historia = $conection->query($c_sql_historia);
        $c_linha_historia = $c_result_historia->fetch_assoc();
        $hoje = date('d/m/Y');
        $c_historia = $c_linha_historia['historia'] . "\r\n" . "\r\n" . "$hoje" . "\r\n" . "Orientação Médica Emitido" .
            "\r\n" . $c_orientacao;
        $c_sql_historia = "update historia set historia = '$c_historia' where id_paciente='$c_id'";
        $result_historia = $conection->query($c_sql_historia);
        echo "
          <script>
          alert('Orientação Médica registrada na história clinica do paciente!!!');
          </script>
        ";
    }
}

// botão para incluir texto de orientação padrão selecionado
if ((isset($_POST["btninclui"]))) {
    $c_id_orientacao = $_POST['id_orientacao'];
    $c_sql_texto = "select texto from orientacoes_padrao where id='$c_id_orientacao'";
    $result_texto = $conection->query($c_sql_texto);
    // procuro o texto no cadastro de atestado para colocar no texto
    $c_linha_orientacao = $result_texto->fetch_assoc();
    $c_orientacao = $c_linha_orientacao['texto'];
}
// botão para emissão de orientação médica
// verifico se o botão foi pressionado
if ((isset($_POST["btnprint"]))) {
    $_SESSION['orientacao'] = $_POST['obs'];
    $_SESSION['paciente'] = $c_linha['nome'];
    $_SESSION['profissional'] = $_POST['profissional'];
    $c_orientacao = $_POST['obs'];
    echo "<script> window.open('/smedweb/prescricoes/rel_orientacao.php?id=', '_blank');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
    <!-- funcao para chamar rotina para cortar registro marcação de agenda -->
    <script>
        function pegaid(id) {
            document.getElementById('id_orientacao').value = id;
        }
    </script>
    <!-- funcao para chamar rotina de registro do atestado no histórico do paciênte -->
    <script>
        function registro(id) {}
    </script>


    <div class="panel panel-primary class">
        <div class="panel-heading text-center">
            <h4>SmartMed - Sistema Médico</h4>
            <h5>Emissão de Prescrição de Orientação Médica<h5>
        </div>
    </div>

    <div class="container -my5">
        <form method="post">

            <button type='submit' id='btnprint' name='btnprint' class='btn btn-light' data-toggle='modal' title='Emitir Orientação médica'>
                <img src='\smedweb\images\printer.png' alt='' width='20' height='20'> Emitir Prescrição
            </button>
            <button type='submit' id='btnregistro' name='btnregistro' class='btn btn-light' data-toggle='modal' title='Registra Orientação no histórico do paciente'>
                <img src='\smedweb\images\registro.png' alt='' width='20' height='20'> Registrar Orientação</button>
            <input type='hidden' name='id_texto' id='id_texto' value="<?php echo $c_orientacao ?>">
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
                <li role="presentation" class="active"><a href="#orientacao" aria-controls="home" role="tab" data-toggle="tab">Editar Orientação Médica</a></li>
                <li role="presentation"><a href="#modelos" aria-controls="modelos" role="tab" data-toggle="tab">Modelos de Orientações</a></li>
            </ul>
            <!-- paginas de edição e modelos de Orientações -->
            <div class="tab-content">
                <!-- aba de edição da Orientação -->
                <div role="tabpanel" class="tab-pane active" id="orientacao">
                    <div style="padding-top:5px;">
                        <div style="padding-top:20px;">
                            <div class="form-group">
                                <label class="col-sm-2 col-form-label">Texto da Orientação</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" id="obs" name="obs" rows="15"><?php echo $c_orientacao; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- aba de modelos de orientacões-->
                <div role="tabpanel" class="tab-pane" id="modelos">
                    <div style="padding-top:5px;">
                        <div class="table-responsive=lg">
                            <table style="width:100%" class="table display table-bordered tab">
                                <thead class="thead">
                                    <tr class="info">
                                        <th style='display:none' scope="col">No.</th>
                                        <th scope="col">Orientação</th>
                                        <th scope="col">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <form id='frmadd' method='POST' action=''>
                                        <!-- input para capturar id da orientação a ter o texto capturado -->
                                        <input type='hidden' name='id_orientacao' id='id_orientacao'>
                                        <?php
                                        // faço a Leitura da tabela com sql
                                        $c_sql = "SELECT orientacoes_padrao.id, orientacoes_padrao.descricao, orientacoes_padrao.texto 
                                    FROM orientacoes_padrao ORDER BY orientacoes_padrao.descricao";
                                        $result = $conection->query($c_sql);
                                        // verifico se a query foi correto
                                        if (!$result) {
                                            die("Erro ao Executar Sql!!" . $conection->connect_error);
                                        }
                                        // insiro os registro do banco de dados na tabela 
                                        while ($c_linha2 = $result->fetch_assoc()) {

                                            echo "
                                        <tr>
                                        <td style='display:none'>$c_linha2[id]</td>
                                        <td>$c_linha2[descricao]</td>
                   
                                        <td>
                                          <button type='submit' onclick='pegaid($c_linha2[id])'  id='btninclui' name='btninclui' class='btn btn-info btn-sm editbtn'
                                           data-toggle=modal' title='Copiar orientação'><img src='\smedweb\images\copiar.png' alt='' width='20' height='20'> Copiar Orientação</button>
                                        </td>

                                        </tr>
                                    ";
                                        }
                                        ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>