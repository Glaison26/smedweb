<?php // controle de acesso ao formulário
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

include_once "lib_gop.php";
include("conexao.php"); // conexão de banco de dados
include("links.php");

// leitura do convenio através de sql usando id passada
$c_sql = "select * from config";
$result = $conection->query($c_sql);
$registro = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {  // metodo get para carregar dados no formulário
    if (!$registro) {
        header('location: /smedweb/menu.php');
        exit;
    }
    // atribuição dos valores do banco de dados as variáveis
    $c_nome_clinica = $registro["nome_clinica"];
    $c_endereco_clinica = $registro['endereco_clinica'];
    $c_telefone_clinica = $registro['telefone_clinica'];
    $c_email_clinica = $registro['email_clinica'];
    $c_cidade_clinica = $registro['cidade_clinica'];
    $c_cnpj_clinica = $registro['cnpj_clinica'];
    $c_email_host = $registro['host_email'];
    $c_email_senha = $registro['senha_email'];
    $c_porta = $registro['porta_smtp'];
    $c_prazo = $registro['prazo_online'];
}
// metodo post para salvar os dados do formulário
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $c_nome_clinica = $_POST['nome_clinica'];
    $c_endereco_clinica = $_POST['endereco_clinica'];
    $c_telefone_clinica = $_POST['telefone_clinica'];
    $c_email_clinica = $_POST['email_clinica'];
    $c_cidade_clinica = $_POST['cidade_clinica'];
    $c_cnpj_clinica = $_POST['cnpj_clinica'];
    $c_email_host = $_POST['email_host'];
    $c_email_senha = $_POST['email_senha'];
    $c_porta = $_POST['porta'];
    $c_prazo = $_POST['prazo'];

    // validação dos campos obrigatórios
    if (empty($c_nome_clinica) || empty($c_endereco_clinica) || empty($c_telefone_clinica) || empty($c_email_clinica) || empty($c_cidade_clinica) || empty($c_cnpj_clinica)) {
        $msg_erro = "Preencha todos os campos obrigatórios (*)";
    } else {
        // comando sql de atualização
        $sql_update = "UPDATE config SET nome_clinica='$c_nome_clinica', endereco_clinica='$c_endereco_clinica', 
        telefone_clinica='$c_telefone_clinica', email_clinica='$c_email_clinica',
        cidade_clinica='$c_cidade_clinica', cnpj_clinica='$c_cnpj_clinica', host_email='$c_email_host', 
        senha_email='$c_email_senha', porta_smtp='$c_porta', prazo_online='$c_prazo' WHERE id=1";
        if ($conection->query($sql_update) === TRUE) {
            $msg_gravou = "Configurações atualizadas com sucesso!";
        } else {
            $msg_erro = "Erro ao atualizar configurações: " . $conection->error;
        }
    }
}
?>

<!--   front end da edição do formulário de configuração do sistema -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SmartWeb - Sistema Médico</title>

</head>

<body>
    <div class="container-fluid">
        <div class="panel panel-primary class">
            <div class="panel-heading text-center">
                <h4>SmartMed - Sistema Médico</h4>
                <h5>Edição de Configurações Gerais do Sistema<h5>
            </div>
        </div>
    </div>
    <br>
    <div class="container content-box">
        <?php
        if (!empty($msg_erro)) {
            echo "
            <div class='alert alert-danger' role='alert'>
                <h5>$msg_erro</h5>
            </div>
                ";
        }
        ?>
        <div class='alert alert-warning' role='alert'>
            <h5>Campos com (*) são obrigatórios</h5>
        </div>
        <form method="post">
            <hr>
            <div class="mb-3 row">
                <label class="col-md-3 form-label">Nome da Empresa*</label>
                <div class="col-md-6">
                    <input type="text" required class="form-control" id="nome_clinica" name="nome_clinica" value="<?php echo $c_nome_clinica; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-md-3 form-label">Endereço*</label>
                <div class="col-md-6">
                    <input type="text" required class="form-control" id="endereco_clinica" name="endereco_clinica" value="<?php echo $c_endereco_clinica; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-md-3 form-label">Telefone*</label>
                <div class="col-md-6">
                    <input type="text" required class="form-control" id="telefone_clinica" name="telefone_clinica" value="<?php echo $c_telefone_clinica; ?>">
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-md-3 form-label">Cidade*</label>
                <div class="col-md-6">
                    <input type="text" required class="form-control" id="cidade_clinica" name="cidade_clinica" value="<?php echo $c_cidade_clinica; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-md-3 form-label">CNPJ*</label>
                <div class="col-md-6">
                    <input type="text" required class="form-control" id="cnpj_clinica" name="cnpj_clinica" value="<?php echo $c_cnpj_clinica; ?>">
                </div>
            </div>
            <hr>
            <div class="mb-3 row">
                <label class="col-md-3 form-label">E-mail*</label>
                <div class="col-md-6">
                    <input type="text" required class="form-control" id="email_clinica" name="email_clinica" value="<?php echo $c_email_clinica; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-md-3 form-label">Host do e-mail*</label>
                <div class="col-md-6">
                    <input type="text" required class="form-control" id="email_host" name="email_host" value="<?php echo $c_email_host; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-md-3 form-label">Senha do e-mail *</label>
                <div class="col-md-6">
                    <input type="text" required class="form-control" id="email_senha" name="email_senha" value="<?php echo $c_email_senha; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-md-3 form-label">Porta SMTP*</label>
                <div class="col-md-2">
                    <input type="text" required class="form-control" id="porta" name="porta" value="<?php echo $c_porta; ?>">
                </div>
            </div>
            <hr>
            <div class="mb-3 row">
                <label class="col-md-3 form-label">Prazo para agenda online (em dias)*</label>
                <div class="col-md-2">
                    <input type="number" required class="form-control" id="prazo" placeholder="em dias" name="prazo" value="<?php echo $c_prazo; ?>">
                </div>
            </div>

            <hr>

            <div class="row mb-3">
                <div class="col-sm-3">
                    <button type="submit" id='btn_grava' name='btn_grava' class="btn btn-primary"><span class='glyphicon glyphicon-floppy-saved'></span> Salvar</button>
                    <a class='btn btn-danger' href='/smedweb/menu.php'><span class='glyphicon glyphicon-remove'></span> Fechar</a>
                </div>

            </div>
            <?php
            if (!empty($msg_gravou)) {
                echo "
                    <div class='row mb-3'>
                        <div class='offset-sm-3 col-sm-6'>
                             <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>$msg_gravou</strong>

                             </div>
                        </div>     
                    </div>    
                ";
            }
            ?>
            <br>
        </form>
    </div>

</body>

</html>