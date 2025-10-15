<?php
//controle de acesso ao formulário
session_start();
//if (!isset($_SESSION['newsession'])) {
//    die('Acesso não autorizado!!!');
//}
//
include_once("../links.php");
?>
<!DOCTYPE html>
<html lang="en">



<body>
    <div class="panel panel-primary class">
        <div class="panel-heading text-center">
            <h4>SmartMed - Sistema Médico</h4>
            <h5>Erro de Entrada de Dados<h5>
        </div>
    </div>

    <div class="container -my5">
        <div class="container">
            <div class="alert alert-danger">
                <h5><strong>Erro nas informações :<?php echo $_SESSION['msg_erro'] ?> </strong></h5>
            </div>
            <div class="alert alert-success">
                <h5><strong>Use o botão de Navegação para voltar ao formulário e corrigir a informação</strong></h5>
            </div>
        </div>
    </div>


</body>

</html>