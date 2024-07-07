<?php
include_once "lib_gop.php";
include("conexao.php"); // conexão de banco de dados
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
    header('location: /smedweb/pacientes_lista.php');
}
// sair da historia




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smed - Sistema Médico</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/jquery-1.2.6.pack.js"></script>
    <script type="text/javascript" src="js/jquery.maskedinput-1.1.4.pack.js"></script>
    <script type="text/javascript" src="js/funcoes.js"></script>
    <script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>
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
            <div style="padding-bottom:20px;">

                <div class="row mb-3">
                    <div class="offset-sm-0 col-sm-3">
                        <button type="submit" class="btn btn-primary"><span class='glyphicon glyphicon-floppy-saved'></span> Salvar</button>
                        <a class='btn btn-danger' href='/smedweb/pacientes_lista.php'><span class='glyphicon glyphicon-remove'></span> Voltar</a>
                    </div>
                </div>
            </div>
            <div class="panel panel-success">
                <div class="panel-heading"><h4>Identificação do Paciente:<?php echo '' . $c_linha['nome']; ?></h4></div>
                <div class="panel-body">

                    <div style="padding-top:20px;">

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