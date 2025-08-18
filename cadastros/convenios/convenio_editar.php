<?php // controle de acesso ao formulário
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

include_once "../../lib_gop.php";
include("../../conexao.php"); // conexão de banco de dados
include("../../links.php");

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

// rotina de post dos dados do formuário
$c_id = "";
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

if ($_SERVER['REQUEST_METHOD'] == 'GET') {  // metodo get para carregar dados no formulário

    if (!isset($_GET["id"])) {
        header('location: /smedweb/cadastros/convenios/convenios_lista.php');
        exit;
    }

    $c_id = $_GET["id"];
    // leitura do convenio através de sql usando id passada
    $c_sql = "select * from convenios  where id=$c_id";
    $result = $conection->query($c_sql);
    $registro = $result->fetch_assoc();

    if (!$registro) {
        header('location: /smedweb/cadastros/convenios/convenios_lista.php');
        exit;
    }
    $c_nome = $registro['nome'];
    $c_razao = $registro['razaosocial'];
    $c_endereco = $registro['endereco'];
    $c_bairro = $registro['bairro'];
    $c_cep = $registro['cep'];
    $c_cidade = $registro['cidade'];
    $c_uf = $registro['uf'];
    $c_cnpj = $registro['cnpj'];
    $c_url = $registro['url'];
    $c_contato = $registro['contato'];
    $c_insc = $registro['inscestad'];
    $c_inscMunicipal = $registro['inscmunicipal'];
    $c_obs = $registro['obs'];
    $c_email = $registro['email'];
    $c_telefone1 = $registro['fone1'];
    $c_telefone2 = $registro['fone2'];
    $c_dia_pagamento = $registro['diapagamento'];
    $c_dia_envio = $registro['diaenvio'];
    $c_percent_ch = $registro['percentch'];
    $c_contato = $registro['contato'];
    $c_obs = $registro['obs'];
    // tabela
    $i_tabela = $registro['id_tabela'];


} else {
    // metodo post para atualizar dados
    $c_id = $_POST["id"];
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
    $c_tabela = $_POST['tabela'];
    

    do {
        if (
            empty($c_nome) || empty($c_razao) || empty($c_telefone1) || empty($c_cnpj) || empty($c_contato) || empty($c_email)
        ) {
            $msg_erro = "Todos os Campos com (*) devem ser preenchidos!!";
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
        // capturo ida da tabela selecionada
        $c_sqltabela = "select tabela.id from tabela where tabela.descricao='$c_tabela'";
        $result = $conection->query($c_sqltabela);
        $c_linha = $result->fetch_assoc();
        $i_tabela = $c_linha['id'];
        // grava dados no banco

        // faço a alteração do registro
        $c_sql = "Update convenios" .
            " SET nome = '$c_nome', razaosocial ='$c_razao',  endereco = '$c_endereco', bairro = '$c_bairro', cidade ='$c_cidade', cep='$c_cep', uf='$c_uf'" .
            ", cnpj='$c_cnpj', email ='$c_email',  url = '$c_url', fone1 = '$c_telefone1', fone2 ='$c_telefone2', contato='$c_contato'" .
            ", inscestad='$c_insc', obs='$c_obs', inscmunicipal= '$c_inscMunicipal', diaenvio='$c_dia_envio', diapagamento='$c_dia_pagamento'" .
            " ,percentch='$c_percent_ch', id_tabela='$i_tabela' where id=$c_id";

        $result = $conection->query($c_sql);
        
        // verifico se a query foi correto
        if (!$result) {
            die("Erro ao Executar Sql!!" . $conection->connect_error);
        }
        $msg_gravou = "Dados Gravados com Sucesso!!";
        header('location: /smedweb/cadastros/convenios/convenios_lista.php');
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

<body>
    <div class="panel panel-primary class">
        <div class="panel-heading text-center">
            <h4>SmartMed - Sistema Médico</h4>
            <h5>Editar Convênio<h5>
        </div>
    </div>
    <br>
    <div class="container -my5">
        <?php
        if (!empty($msg_erro)) {
            echo "
            <div class='alert alert-danger' role='alert'>
                <h4>$msg_erro</h4>
            </div>
                ";
        }
        ?>
        <div class='alert alert-warning' role='alert'>
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
                        <input type="hidden" name="id" value="<?php echo $c_id; ?>">
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Nome (*)</label>
                            <div class="col-sm-5">
                                <input type="text" required maxlength="200" class="form-control" name="nome" value="<?php echo $c_nome; ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Razão Social (*)</label>
                            <div class="col-sm-5">
                                <input type="text" required maxlength="200" class="form-control" name="razao" value="<?php echo $c_razao; ?>">
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
                                    <option value="AC" <?= ($c_uf == 'AC') ? 'selected' : '' ?>>AC</option>
                                    <option value="AL" <?= ($c_uf == 'AL') ? 'selected' : '' ?>>AL</option>
                                    <option value="AP" <?= ($c_uf == 'AP') ? 'selected' : '' ?>>AP</option>
                                    <option value="AM" <?= ($c_uf == 'AM') ? 'selected' : '' ?>>AM</option>
                                    <option value="BA" <?= ($c_uf == 'BA') ? 'selected' : '' ?>>BA</option>
                                    <option value="CE" <?= ($c_uf == 'CE') ? 'selected' : '' ?>>CE</option>
                                    <option value="DF" <?= ($c_uf == 'DF') ? 'selected' : '' ?>>DF</option>
                                    <option value="ES" <?= ($c_uf == 'ES') ? 'selected' : '' ?>>ES</option>
                                    <option value="GO" <?= ($c_uf == 'GO') ? 'selected' : '' ?>>GO</option>
                                    <option value="MA" <?= ($c_uf == 'MA') ? 'selected' : '' ?>>MA</option>
                                    <option value="MT" <?= ($c_uf == 'MT') ? 'selected' : '' ?>>MT</option>
                                    <option value="MS" <?= ($c_uf == 'MS') ? 'selected' : '' ?>>MS</option>
                                    <option value="MG" <?= ($c_uf == 'MG') ? 'selected' : '' ?>>MG</option>
                                    <option value="PA" <?= ($c_uf == 'PA') ? 'selected' : '' ?>>PA</option>
                                    <option value="PB" <?= ($c_uf == 'PB') ? 'selected' : '' ?>>PB</option>
                                    <option value="PR" <?= ($c_uf == 'PR') ? 'selected' : '' ?>>PR</option>
                                    <option value="PE" <?= ($c_uf == 'PE') ? 'selected' : '' ?>>PE</option>
                                    <option value="PI" <?= ($c_uf == 'PI') ? 'selected' : '' ?>>PI</option>
                                    <option value="RJ" <?= ($c_uf == 'RJ') ? 'selected' : '' ?>>RJ</option>
                                    <option value="RN" <?= ($c_uf == 'RN') ? 'selected' : '' ?>>RN</option>
                                    <option value="RS" <?= ($c_uf == 'RS') ? 'selected' : '' ?>>RS</option>
                                    <option value="RO" <?= ($c_uf == 'RO') ? 'selected' : '' ?>>RO</option>
                                    <option value="RR" <?= ($c_uf == 'RR') ? 'selected' : '' ?>>RR</option>
                                    <option value="SC" <?= ($c_uf == 'SC') ? 'selected' : '' ?>>SC</option>
                                    <option value="SP" <?= ($c_uf == 'SP') ? 'selected' : '' ?>>SP</option>
                                    <option value="SE" <?= ($c_uf == 'SE') ? 'selected' : '' ?>>SE</option>
                                    <option value="TO" <?= ($c_uf == 'TO') ? 'selected' : '' ?>>TO</option>
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
                                <input type="text" required maxlength="100" class="form-control" name="contato" value="<?php echo $c_contato; ?>">
                            </div>
                        </div>
                        <hr>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Fone 1 (*) </label>
                            <div class="col-sm-2">
                                <input type="tel" required maxlength="25" onkeyup="handlePhone(event)" class=" form-control" name="telefone1" value="<?php echo $c_telefone1; ?>">
                            </div>
                            <label class="col-sm-1 col-form-label">Fone 2</label>
                            <div class="col-sm-2">
                                <input type="tel" maxlength="25" onkeyup="handlePhone(event)" class="form-control" name="telefone2" value="<?php echo $c_telefone2; ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">E-mail (*)</label>
                            <div class="col-sm-5">
                                <input type="text" required maxlength="225" class="form-control" name="email" value="<?php echo $c_email; ?>">
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
                                <input type="number" required maxlength="18" placeholder="apenas números" class="form-control" name="cnpj" data-inputmask="'mask': '9', 'repeat': 10, 'greedy' : false" value="<?php echo $c_cnpj; ?>">
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
                                    while ($c_linha = $result->fetch_assoc()) {
                                        if ($c_linha['id'] == $i_tabela) {
                                            $op = 'selected';
                                        } else {
                                            $op = '';
                                        }
                                        echo "  
                                      <option $op>$c_linha[descricao]</option>
                                    ";
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
                        <a class='btn btn-danger' href='/smedweb/cadastros/convenios/convenios_lista.php'><span class='glyphicon glyphicon-remove'></span> Cancelar</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>