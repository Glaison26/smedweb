<?php
include_once "../lib_gop.php";
include("../conexao.php"); // conexão de banco de dados
include("../links.php");
$c_id = $_GET["id"]; // pego a id do paciente
$c_historia = "";
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // sql para pegar dados do paciente selecionado
    $c_sql = "select pacientes.id, pacientes.nome from pacientes where pacientes.id='$c_id'";
    $result = $conection->query($c_sql);
    // verifico se a query foi correto
    if (!$result) {
        die("Erro ao Executar Sql!!" . $conection->connect_error);
    }
    $c_linha = $result->fetch_assoc();
    // Verifico numero de registros na historia para ver ser existe historia
    $c_sql = "select COUNT(*) AS qtd FROM historia where historia.id_paciente='$c_id'";
    $result = $conection->query($c_sql);
    $c_linha_qtd = $result->fetch_assoc();
    if ($c_linha_qtd['qtd'] == 0) {
        $c_sql = "insert into historia (id_paciente,historia) value ('$c_id','$c_historia')";
        $result = $conection->query($c_sql);
    } else {
        $c_sql = "select historia.historia from historia where historia.id_paciente='$c_id'";
        $result = $conection->query($c_sql);
        $c_linha_historia = $result->fetch_assoc();
        $c_historia = $c_linha_historia['historia'];
    }
}
// gravo dados da historia
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $c_historia = $_POST['historia'];
    $c_sql = "update historia set historia='$c_historia' where id_paciente='$c_id'";
    $result = $conection->query($c_sql);
    header('location: /smedweb/pacientes/pacientes_lista.php');
}
// sair da historia
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
            <h5>História Clinica do Paciente<h5>
        </div>
    </div>
    <div class="container -my5">
        <form method="post" class="form-horizontal">
           
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h4>Identificação do Paciente:<?php echo ' ' . $c_linha['nome']; ?></h4>
                </div>
                <div class="panel-body">
                    <div class="row mb-3">
                        <div class="offset-sm-0 col-sm-3">
                            <button type="submit" class="btn btn-Light"></span> <img src="\smedweb\images\salvar.png" alt="" width="15" height="15"> Salvar</button>
                            <a class='btn btn-Light' href='/smedweb/pacientes/pacientes_lista.php'> <img src="\smedweb\images\voltar.png" alt="" width="15" height="15"> Voltar</a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">

                    <div style="padding-top:5px;">

                        <div class="form-group">
                            <label class="col-sm-5 col-form-label">História Clinica</label>
                            <div class="col-sm-12">
                                <textarea class="form-control" id="historia" name="historia" rows="25"><?php echo $c_historia ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

</body>

</html>