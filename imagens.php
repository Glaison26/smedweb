<?php
include_once "lib_gop.php";
include("conexao.php"); // conexão de banco de dados
$c_id = $_GET["id"]; // pego a id do paciente
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $c_sql = "select pacientes.id, pacientes.nome from pacientes where pacientes.id='$c_id'";
    $result = $conection->query($c_sql);
    // verifico se a query foi correto
    if (!$result) {
        die("Erro ao Executar Sql!!" . $conection->connect_error);
    }
    $c_linha = $result->fetch_assoc();
}
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
            <h5>Gerenciamento de Imagens Clinicas do Paciente<h5>
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
                            <label>Nova Imagem: </label>
                            <input type="file" name="arquivo" accept="image/*"><br><br>
                            <button type="submit" name="btnfoto" id="btnfoto" class="btn btn-Ligth"> <img src="\smedweb\images\enviafoto.png" alt="" width="20" height="20"> Enviar Foto</button>
                            <a class='btn btn-Light' href='/smedweb/pacientes_lista.php'> <img src="\smedweb\images\voltar.png" alt="" width="15" height="15"> Voltar</a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">

                    <div style="padding-top:5px;">

                    </div>
                </div>
            </div>
        </form>
    </div>

</body>

</html>