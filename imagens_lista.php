<?php // controle de acesso ao formulário
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

include("conexao.php");
include_once "lib_gop.php";
include("links.php");
$c_id = $_GET["id"];
$c_descricao = "";
// sql para contar numero de refistros
// sql para capturar as imagens
$c_sql_conta = "SELECT Count(*) as total FROM imagens_pacientes where imagens_pacientes.id_paciente='$c_id' ORDER BY imagens_pacientes.`data` desc";
$result_conta = $conection->query($c_sql_conta);
$c_linha_conta = $result_conta->fetch_assoc();
$c_conta = $c_linha_conta['total'];
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
            <h5>Imagens do Paciente<h5>
        </div>
    </div>
    <br>
    <div class="container -my5">
        <div class="class='mb-3 row">
            <a class='btn btn-Light' href='/smedweb/imagens.php'> <img src="\smedweb\images\voltar.png" alt="" width="15" height="15"> Voltar</a>
        </div><br>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h4>Identificação do Paciente:<?php echo ' ' . $_SESSION["paciente_nome"] ?></h4>
            </div>
        </div>

        <?php
        // sql para capturar as imagens
        $c_sql = "SELECT * FROM imagens_pacientes where imagens_pacientes.id_paciente='$c_id' ORDER BY imagens_pacientes.`data` desc";
        $result = $conection->query($c_sql);
        $i_contador = 1;
        while ($c_linha = $result->fetch_assoc()) {
            $d_data =  DateTime::createFromFormat('Y-m-d', $c_linha["data"]);
            $d_data = $d_data->format('d/m/Y');
            $c_descricao = $c_linha['descricao'];
            $c_pasta = $c_linha['pasta_imagem'];
            $c_pasta = substr($c_pasta, 4);
            $c_caminho = "\smedweb\img\ ";
            $c_caminho = rtrim($c_caminho) . $c_pasta;

            // string para montagem do html
            $c_texto = "<div class='panel panel-primary class'>
                         <div class='panel-heading text-center'>
                              <h4>Imagem $i_contador de $c_conta</h4>
                               
                        </div>
                     </div>" .
                "<div class='row mb-3'>
            <label class='col-md-3 form-label'>Data</label>
            <div class='col-md-2'>
                <input type='text' readonly maxlength='10' class='form-control' placeholder='dd/mm/yyyy' name='data' id='data' onkeypress='mascaraData(this)'' value='$d_data'>
            </div>
        </div>
        <div class='mb-3 row'>

            <label for='up_descricaoField' class='col-md-3 form-label'>Descrição</label>
            <div class='col-md-6'>
                <input type='text' readonly class='form-control' id='up_descricaoField' name='up_descricaoField' value='$c_descricao'>
            </div>

        </div>" .
                "<div class='mb-3 row'>" .

                "<label for='up_arquivoField' class='col-md-3 form-label'>Arquivo</label>
            <div class='col-md-6'>
                <input type='text' readonly class='form-control' id='up_arquivoField' name='up_arquivoField' value='$c_pasta'>
            </div>

        </div>" .


                "<div class='mb-3 row'>
                            <label class='col-md-3 form-label'>Imagem</label>
                                <div class='panel panel-success'>
                                    <div class='panel-body'>
                                        <img class='rounded mx-auto d-block' class='img-responsive' src='$c_caminho' class='img-fluid' style='height :500px' style='width:500px'>
                                    </div>
                                </div>
                         </div>";



            echo $c_texto;
            $i_contador++;
        }
        ?>
    </div>

</body>

</html>