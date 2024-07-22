<?php
// controle de acesso ao formulário
//session_start();
//if (!isset($_SESSION['newsession'])) {
//    die('Acesso não autorizado!!!');
//}

// funções 
include("conexao.php"); // conexão de banco de dados
include_once "lib_gop.php";

function carregadados()
{
    $c_nome = $_POST['nome'];
    $c_razao = $_POST['razao'];
    $c_endereco = $_POST['endereco'];
    $c_bairro = $_POST['bairro'];
    $c_cep = $_POST['cep'];
    $c_cidade = $_POST['cidade'];
    $c_uf = $_POST['uf'];
    $c_cnpj = $_POST['cnpj'];
    $c_url = $_POST['url'];
    $c_contato = $_POST['contato'];
    $c_insc = $_POST['insc'];
    $c_inscMunicipal = $_POST['insc_municipal'];
    $c_obs = $_POST['obs'];
    $c_email = $_POST['email'];
    $c_telefone1 = $_POST['telefone1'];
    $c_telefone2 = $_POST['telefone2'];
    $c_dia_pagamento = $_POST['dia_pagamento'];
    $c_dia_envio = $_POST['dia_envio'];
    $c_percent_ch = $_POST['percent_ch'];
    $c_contato = $_POST['contato'];
    $c_obs = $_POST['obs'];
}

$c_nome = "";
$c_razao =  "";
$c_endereco =  "";
$c_bairro =  "";
$c_cep =  "";
$c_cidade =  "";
$c_uf =  "";
$c_cnpj =  "";
$c_url =  "";
$c_contato =  "";
$c_insc =  "";
$c_inscMunicipal =  "";
$c_obs =  "";
$c_email =  "";
$c_telefone1 =  "";
$c_telefone2 =  "";
$c_dia_pagamento =  "";
$c_dia_envio =  "";
$c_percent_ch =  "";
$c_contato =  "";
$c_obs =  "";

// variaveis para mensagens de erro e suscessso da gravação
$msg_gravou = "";
$msg_erro = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $c_nome = $_POST['nome'];
    $c_razao = $_POST['razao'];
    $c_endereco = $_POST['endereco'];
    $c_bairro = $_POST['bairro'];
    $c_cep = $_POST['cep'];
    $c_cidade = $_POST['cidade'];
    $c_uf = $_POST['uf'];
    $c_cnpj = $_POST['cnpj'];
    $c_url = $_POST['url'];
    $c_contato = $_POST['contato'];
    $c_insc = $_POST['insc'];
    $c_inscMunicipal = $_POST['inscmunicipal'];
    $c_obs = $_POST['obs'];
    $c_email = $_POST['email'];
    $c_telefone1 = $_POST['telefone1'];
    $c_telefone2 = $_POST['telefone2'];
    $c_dia_pagamento = $_POST['diapag1'];
    $c_dia_envio = $_POST['dia_envio'];
    $c_percent_ch = $_POST['percent'];
    $c_contato = $_POST['contato'];
    $c_obs = $_POST['obs'];
    //
    do {
        if (
            empty($c_nome) || empty($c_razao) || empty($c_telefone1) || empty($c_cnpj) || empty($c_contato) || empty($c_email)
        ) {
            $msg_erro = "Todos os Campos com (*) devem ser preenchidos, favor verificar!!";
            break;
        }
        // consiste email
        if (!validaEmail($c_email)) {
            $msg_erro = " E-mail informado inválido!!";
            break;
        }

        if (!valida_cnpj($c_cnpj)) {
            $msg_erro = " CNPJ informado inválido!!";
            break;
        }
        //verifica se cnpj já foi cadastrado
        $c_sql = "select convenios.cnpj from convenios where cnpj='$c_cnpj'";
        $result = $conection->query($c_sql);
        $registro = $result->fetch_assoc();
        if ($registro) {
            $msg_erro = "Já existe este CNPJ deste convenio cadastrado!!";
            break;
        }
        // rotina para pegar id da tabela selecionada
        $c_tabela = $_POST['tabela'];
        $c_sqltabela = "SELECT tabela.id, tabela.descricao FROM tabela where tabela.descricao='$c_tabela'";
        $result = $conection->query($c_sqltabela);
        $c_linha = $result->fetch_assoc();
        $c_id_tabela = $c_linha['id'];
        // grava dados no banco
        // faço a Leitura da tabela com sql
        if ($c_percent_ch='') {
            $c_percent_ch='0';
        }
        $c_sql = "Insert into convenios (nome, razaosocial, endereco, bairro, cidade, cep, uf, cnpj, email, url, fone1, fone2, contato, inscestad, obs, 
            diapagamento, diaenvio, percentch, inscmunicipal, id_tabela )" .
            "Value ('$c_nome', '$c_razao', '$c_endereco', '$c_bairro', '$c_cidade', '$c_cep', '$c_uf', '$c_cnpj', '$c_email', '$c_url', '$c_telefone1', '$c_telefone2', 
            '$c_contato', '$c_insc', '$c_obs',  '$c_dia_pagamento', '$c_dia_envio', '$c_percent_ch', '$c_inscmunicipal', '$c_id_tabela')";

        $result = $conection->query($c_sql);
        // verifico se a query foi correto
        if (!$result) {
            die("Erro ao Executar Sql!!" . $conection->connect_error);
        }

        $msg_gravou = "Dados Gravados com Sucesso!!";

        header('location: /smedweb/convenios_lista.php');
    } while (false);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>

    <script type="text/javascript" src="js/funcoes.js"></script>

    <title>Smed - Sistema Médico </title>

    <title>SmartMed - Sistema Médico</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" type="imagex/png" href="./images/smed_icon.ico">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/jquery-1.2.6.pack.js"></script>
    <script type="text/javascript" src="js/jquery.maskedinput-1.1.4.pack.js"></script>
    <script scr="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script scr="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script scr="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>



    <script>
        const handlePhone = (event) => {
            let input = event.target
            input.value = phoneMask(input.value)
        }

        const phoneMask = (value) => {
            if (!value) return ""
            value = value.replace(/\D/g, '')
            value = value.replace(/(\d{2})(\d)/, "($1) $2")
            value = value.replace(/(\d)(\d{4})$/, "$1-$2")
            return value
        }
    </script>

</head>
<div class="panel panel-primary class">
    <div class="panel-heading text-center">
        <h4>SmartMed - Sistema Médico</h4>
        <h5>Novo Convênio<h5>
    </div>
</div>
<br>
<div class="container -my5">

    <body>
        <?php
        if (!empty($msg_erro)) {
            echo "
            <div class='alert alert-warning' role='alert'>
                <h4>$msg_erro</h4>
            </div>
                ";
        }
        ?>
        <div class='alert alert-info' role='alert'>
            <h5>Campos com (*) são obrigatórios</h5>
        </div>
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#dados_convenios" aria-controls="home" role="tab" data-toggle="tab">Dados do Convênio</a></li>
            <li role="presentation"><a href="#dados_contato" aria-controls="dados_faturamento" role="tab" data-toggle="tab">Dados de Contato</a></li>
            <li role="presentation"><a href="#dados_faturamento" aria-controls="dados_faturamento" role="tab" data-toggle="tab">Dados de Faturamento</a></li>
            <li role="presentation"><a href="#dados_obs" aria-controls="dados_obs" role="tab" data-toggle="tab">Observações</a></li>
        </ul>

        <form method="post" class="form-horizontal">
            <div class="tab-content">

                <div role="tabpanel" class="tab-pane active" id="dados_convenios">
                    <div style="padding-top:20px;">
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Nome (*)</label>
                            <div class="col-sm-5">
                                <input type="text" maxlength="200" class="form-control" name="nome" value="<?php echo $c_nome; ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Razão Social (*)</label>
                            <div class="col-sm-5">
                                <input type="text" maxlength="200" class="form-control" name="razao" value="<?php echo $c_razao; ?>">
                            </div>

                        </div>
                        <hr>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Endereço </label>
                            <div class="col-sm-5">
                                <input type="text" maxlength="150" class="form-control" name="endereco" value="<?php echo $c_endereco; ?>">
                            </div>

                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Bairro</label>
                            <div class="col-sm-5">
                                <input type="text" maxlength="100" class="form-control" name="bairro" value="<?php echo $c_bairro; ?>">
                            </div>

                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Cidade</label>
                            <div class="col-sm-5">
                                <input type="text" maxlength="100" class="form-control" name="cidade" value="<?php echo $c_cidade; ?>">
                            </div>

                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Cep</label>
                            <div class="col-sm-2">
                                <input type="text" placeholder="Somente números" maxlength="11" class="form-control" name="cep" value="<?php echo $c_cep; ?>">
                            </div>
                            <label class="col-sm-1 col-form-label">Estado </label>
                            <div class="col-sm-2">
                                <select class="form-control form-control-lg" id="uf" name="uf">
                                    <option>AC</option>
                                    <option>AL</option>
                                    <option>AP</option>
                                    <option>AM</option>
                                    <option>BA</option>
                                    <option>CE</option>
                                    <option>DF</option>
                                    <option>ES</option>
                                    <option>GO</option>
                                    <option>MA</option>
                                    <option>MT</option>
                                    <option>MS</option>
                                    <option select>MG</option>
                                    <option>PA</option>
                                    <option>PB</option>
                                    <option>PE</option>
                                    <option>PR</option>
                                    <option>PI</option>
                                    <option>RJ</option>
                                    <option>RN</option>
                                    <option>RS</option>
                                    <option>RO</option>
                                    <option>RR</option>
                                    <option>SC</option>
                                    <option>SE</option>
                                    <option>SP</option>
                                    <option>TO</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane" id="dados_contato">
                    <div style="padding-top:20px;">

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Contato (*)</label>
                            <div class="col-sm-4">
                                <input type="text" maxlength="100" class="form-control" name="contato" value="<?php echo $c_contato; ?>">
                            </div>
                        </div>
                        <hr>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Fone 1 (*) </label>
                            <div class="col-sm-2">
                                <input type="tel" maxlength="25" onkeyup="handlePhone(event)" class=" form-control" name="telefone1" value="<?php echo $c_telefone1; ?>">
                            </div>
                            <label class="col-sm-1 col-form-label">Fone 2</label>
                            <div class="col-sm-2">
                                <input type="tel" maxlength="25" onkeyup="handlePhone(event)" class="form-control" name="telefone2" value="<?php echo $c_telefone2; ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">E-mail (*)</label>
                            <div class="col-sm-5">
                                <input type="text" maxlength="225" class="form-control" name="email" value="<?php echo $c_email; ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Home Page</label>
                            <div class="col-sm-5">
                                <input type="text" maxlength="225" class="form-control" name="url" value="<?php echo $c_url; ?>">
                            </div>
                        </div>

                        <hr>
                    </div>
                </div>


                <div role="tabpanel" class="tab-pane" id="dados_faturamento">
                    <div style="padding-top:20px;">
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">CNPJ (*)</label>
                            <div class="col-sm-3">
                                <input type="number" maxlength="18" placeholder="apenas números" class="form-control" name="cnpj" data-inputmask="'mask': '9', 'repeat': 10, 'greedy' : false" value="<?php echo $c_cnpj; ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Insc. Estad.</label>
                            <div class="col-sm-3">
                                <input type="number" maxlength="20" placeholder="apenas números" class="form-control" name="insc" value="<?php echo $c_insc; ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Insc. Municipal.</label>
                            <div class="col-sm-3">
                                <input type="number" maxlength="20" placeholder="apenas números" class="form-control" name="inscmunicipal" value="<?php echo $c_inscMunicipal; ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Tabela</label>
                            <div class="col-sm-3">
                                <select class="form-control form-control-lg" id="tabela" name="tabela">
                                    <?php
                                    $c_sql = "SELECT tabela.id, tabela.descricao FROM tabela ORDER BY tabela.descricao";
                                    $result = $conection->query($c_sql);
                                    // insiro os registro do banco de dados na tabela 
                                    while ($c_linha = $result->fetch_assoc()) {
                                        echo "
                                        <option>$c_linha[descricao]</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Percentual %</label>
                            <div class="col-sm-1">
                                <input type="number" maxlength="2" class="form-control" name="percent" value="<?php echo $c_percent_ch; ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Dia de pagamento 1</label>
                            <div class="col-sm-1">
                                <input type="number" maxlength="2" class="form-control" name="diapag1" value="<?php echo $c_diapag1; ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Dia de envio</label>
                            <div class="col-sm-1">
                                <input type="number" maxlength="2" class="form-control" name="dia_envio" value="<?php echo $c_diapag2; ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane" id="dados_obs">
                    <div style="padding-top:20px;">
                        <div class="form-group">
                            <label class="col-sm-1 col-form-label">Observação</label>
                            <div class="col-sm-7">
                                <textarea class="form-control" id="obs" name="obs" rows="5"><?php echo $c_obs; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row mb-3">
                    <div class="offset-sm-0 col-sm-3">
                        <button type="submit" class="btn btn-primary"><span class='glyphicon glyphicon-floppy-saved'></span> Salvar</button>
                        <a class='btn btn-danger' href='/smedweb/convenios_lista.php'><span class='glyphicon glyphicon-remove'></span> Cancelar</a>
                    </div>
                </div>
            </div>
        </form>
    </body>
</div>

</html>