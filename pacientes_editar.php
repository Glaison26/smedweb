<?php // controle de acesso ao formulário
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

include_once "lib_gop.php";
include("conexao.php"); // conexão de banco de dados

// rotina de post dos dados do formuário
$c_nome = "";
$c_endereco = "";
$c_bairro = "";
$c_cep = "";
$c_cidade = "";
$c_uf = "";
$c_email = "";
$c_telefone1 = "";
$c_telefone2 = "";
$c_obs = "";
$c_sexo = "";
$c_identidade = "";
$c_cpf = "";
$c_datanasc = "";
$c_dataprimeira = "";
$c_matricula = "";
$c_cor = "";
$c_classificacao = "";
$c_cor = "";
$c_naturalidade = "";
$c_procedencia = "";
$c_pai = "";
$c_mae = "";
$c_convenio = "";
$c_profissional = "";
$c_estadocivil = "";
$c_indicacao = "";
$c_profissao = "";
$c_identidade = "";
$c_id = $_GET["id"];
// variaveis para mensagens de erro e suscessso da gravação
$msg_gravou = "";
$msg_erro = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {  // metodo get para carregar dados no formulário

    if (!isset($_GET["id"])) {
        header('location: /smedweb/pacientes_lista.php');
        exit;
    }


    // leitura do paciente através de sql usando id passada
    $c_sql = "select * from pacientes where id=$c_id";
    $result = $conection->query($c_sql);
    $registro = $result->fetch_assoc();

    if (!$registro) {
        header('location: /smedweb/pacientes_lista.php');
        exit;
    }

    $c_nome = $registro['nome'];
    $c_endereco = $registro['endereco'];
    $c_bairro = $registro['bairro'];
    $c_cep = $registro['cep'];
    $c_cidade = $registro['cidade'];
    $c_uf = $registro['uf'];
    $c_email = $registro['email'];
    $c_telefone1 = $registro['fone'];
    $c_telefone2 = $registro['fone2'];
    $c_obs = $registro['obs'];
    $c_sexo = $registro['sexo'];
    $c_identidade = $registro['identidade'];
    $c_cpf = $registro['cpf'];
    $c_matricula = $registro['matricula'];
    $c_cor = $registro['cor'];
    $c_classificacao = $registro['classificacao'];
    $c_cor = $registro['cor'];
    $c_naturalidade = $registro['naturalidade'];
    $c_procedencia = $registro['procedencia'];
    $c_pai = $registro['pai'];
    $c_mae = $registro['mae'];
    $c_convenio = $registro['id_convenio'];
    $c_identidade = $registro['identidade'];
    //
    $c_estadocivil = $registro['estadocivil'];
    $c_indicacao = $registro['indicacao'];
    // datas
    $c_datanasc =  DateTime::createFromFormat('Y-m-d', $registro["datanasc"]);
    $c_datanasc = $c_datanasc->format('d/m/Y');
    $c_dataprimeira =  DateTime::createFromFormat('Y-m-d', $registro["dataprimeira"]);
    $c_dataprimeira = $c_dataprimeira->format('d/m/Y');

    $i_convenio = $registro['id_convenio'];
    // tipo

} else {  // metodo post para gravar dados

    $c_nome = $_POST['nome'];
    $c_endereco = $_POST['endereco'];
    $c_bairro = $_POST['bairro'];
    $c_cep = $_POST['cep'];
    $c_cidade = $_POST['cidade'];
    $c_uf = $_POST['uf'];
    $c_email = $_POST['email'];
    $c_telefone1 = $_POST['telefone1'];
    $c_telefone2 = $_POST['telefone2'];
    $c_obs = $_POST['obs'];
    $c_sexo = $_POST['genero'];
    $c_identidade = $_POST['identidade'];
    $c_cpf = $_POST['cpf'];
    $d_datanasc = $_POST['datanasc'];
    $d_dataprimeira = $_POST['dataprimeira'];
    $c_matricula = $_POST['matricula'];
    $c_cor = $_POST['cor'];
    $c_classificacao = $_POST['classificacao'];
    $c_cor = $_POST['cor'];
    $c_naturalidade = $_POST['naturalidade'];
    $c_procedencia = $_POST['procedencia'];
    $c_pai = $_POST['pai'];
    $c_mae = $_POST['mae'];
    $c_convenio = $_POST['convenio'];
    $c_identidade = $_POST['identidade'];

    $c_estadocivil = $_POST['estadocivil'];
    $c_indicacao = $_POST['indicacao'];

    // dtratamento de datas
    $c_datanasc = $_POST['datanasc'];
    $c_datanasc = date("Y-m-d", strtotime(str_replace('/', '-', $c_datanasc)));
    $c_dataprimeira = $_POST['dataprimeira'];
    $c_dataprimeira = date("Y-m-d", strtotime(str_replace('/', '-', $c_dataprimeira)));

    do {

        if (
            empty($c_nome) || empty($c_telefone1) || empty($d_datanasc) || empty($d_dataprimeira)
        ) {
            $msg_erro = "Todos os Campos com (*) devem ser preenchidos, favor verificar!!";
            break;
        }
        // consiste email
        if (!validaEmail($c_email) && !empty($c_email)) {
            $msg_erro = "E-mail informado inválido!!";
            break;
        }

        if (!validaCPF($c_cpf) && !empty($c_cpf)) {
            $msg_erro = "CPF informado inválido!!";
            break;
        }
        // grava dados no banco
        // verifica especialidade selecionada para gravar no registro
        // rotina para pegar id da especialidade selecionada
        $c_convenio  = $_POST['convenio'];
        $c_sql_convenio = "SELECT convenios.id, convenios.nome FROM convenios where convenios.nome='$c_convenio'";
        $result = $conection->query($c_sql_convenio);
        $c_linha = $result->fetch_assoc();
        $c_id_convenio = $c_linha['id'];
        // verifico se a query foi correto
        if (!$result) {
            die("Erro ao Executar Sql!!" . $conection->connect_error);
        }
        $c_linha = $result->fetch_assoc();
        $i_convenio = $c_linha['id'];

        //$c_sql = "Insert into pacientes (nome, endereco, bairro, cidade, cep, uf, email,
        // fone, fone2, obs, cpf, identidade, sexo, datanasc, indicacao, profissao, 
        // pai, mae, estadocivil, cor, naturalidade, procedencia, matricula, classificacao, dataprimeira, id_convenio)" .
        //    " Value ('$c_nome', '$c_endereco', '$c_bairro', '$c_cidade', '$c_cep', '$c_uf','$c_email', '$c_telefone1', '$c_telefone2', 
        //     '$c_obs', '$c_cpf', '$c_identidade', '$c_sexo', '$d_datanasc', '$c_indicacao', '$c_profissao', '$c_pai', '$c_mae'
        //     , '$c_estadocivil', '$c_cor',  '$c_naturalidade', '$c_procedencia', '$c_matricula', '$c_classificacao', '$d_dataprimeira', $c_id_convenio')";

        // faço a alteração do registro
        $c_sql = "Update pacientes" .
            " SET nome='$c_nome',sexo='$c_sexo',endereco='$c_endereco',bairro='$c_bairro',cidade='$c_cidade',cep='$c_cep',uf='$c_uf'" .
            ",cpf='$c_cpf',identidade='$c_identidade',datanasc='$c_datanasc',fone1='$c_fone1',fone2='$c_fone2',email='$c_email'," .
            "observacao='$c_obs', gera_agenda='$c_gera_agenda', crm= '$c_crm', id_especialidade='$i_especialidade'" .
            " where id=$c_id";
        echo $c_sql;

        $result = $conection->query($c_sql);

        // verifico se a query foi correto
        if (!$result) {
            die("Erro ao Executar Sql!!" . $conection->connect_error);
        }
        $msg_gravou = "Dados Gravados com Sucesso!!";
        header('location: /smedweb/profissionais_lista.php');
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
    <div class="container -my5">

        <body>
            <div class="panel panel-primary class">
                <div class="panel-heading text-center">
                    <h4>SmartMed - Sistema Médico</h4>
                    <h5>Editar dados do Paciente<h5>
                </div>
            </div>
            <br>
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
                <li role="presentation" class="active"><a href="#dados_apresentacao" aria-controls="home" role="tab" data-toggle="tab">Apresentação</a></li>
                <li role="presentation"><a href="#dados_contatos" aria-controls="dados_contatos" role="tab" data-toggle="tab">Contatos/Identificação</a></li>
                <li role="presentation"><a href="#dados_obs" aria-controls="dados_obs" role="tab" data-toggle="tab">Observações</a></li>
            </ul>

            <form method="post" class="form-horizontal">
                <div class="tab-content">
                   
                        <div role="tabpanel" class="tab-pane active" id="dados_apresentacao">
                            <div style="padding-top:20px;">

                                <div class="form-group">
                                    <label class="col-sm-3 col-form-label"><span>Selecione Genero</span></label>
                                    <div class="form-check">
                                        <label for="masculino">
                                            <input type="radio" name="genero" id="masculino" value="M" checked>
                                            <span>Masculino</span>
                                        </label>
                                        <label for="feminino">
                                            <input type="radio" name="genero" id="feminino" value="F">
                                            <span>Feminino</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Nome (*)</label>
                                    <div class="col-sm-5">
                                        <input type="text" maxlength="200" class="form-control" name="nome" value="<?php echo $c_nome; ?>">
                                    </div>
                                </div>
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
                                            <option selected>MG</option>
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

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Data Nascimento (*)</label>
                                <div class="col-sm-2">
                                    <input type="date" maxlength="10" class="form-control" placeholder="dd/mm/yyyy" name="datanasc" id="datanasc" onkeypress="mascaraData(this)" value="<?php echo $d_datanasc; ?>">
                                </div>
                                <label class="col-sm-1 col-form-label">1a. Consulta (*)</label>
                                <div class="col-sm-2">
                                    <input type="date" placeholder="dd/mm/yyyy" onkeypress="mascaraData(this)" class="form-control" id="dataprimeira" name="dataprimeira">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Estado Civil </label>
                                <div class="col-sm-3">
                                    <select class="form-control form-control-lg" id="estadocivil" name="estadocivil">
                                        <option>Solteiro</option>
                                        <option>Casado</option>
                                        <option>Viúvo</option>
                                        <option>Divorciado</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Cor </label>
                                <div class="col-sm-3">
                                    <select class="form-control form-control-lg" id="cor" name="cor">
                                        <option>Leuco</option>
                                        <option>Faio</option>
                                        <option>Melano</option>

                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Nome do Pai</label>
                                <div class="col-sm-5">
                                    <input type="text" maxlength="150" class="form-control" name="pai" value="<?php echo $c_pai; ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Nome da Mãe</label>
                                <div class="col-sm-5">
                                    <input type="text" maxlength="150" class="form-control" name="mae" value="<?php echo $c_mae; ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Naturalidade</label>
                                <div class="col-sm-5">
                                    <input type="text" maxlength="100" class="form-control" name="naturalidade" value="<?php echo $c_naturalidade; ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Profissão</label>
                                <div class="col-sm-5">
                                    <input type="text" maxlength="100" class="form-control" name="profissao" value="<?php echo $c_profissao; ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Procedência</label>
                                <div class="col-sm-5">
                                    <input type="text" maxlength="100" class="form-control" name="procedencia" value="<?php echo $c_procedencia; ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Classificação</label>
                                <div class="col-sm-5">
                                    <input type="text" maxlength="100" class="form-control" name="classificacao" value="<?php echo $c_classificacao; ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Indicação</label>
                                <div class="col-sm-5">
                                    <input type="text" maxlength="100" class="form-control" name="indicacao" value="<?php echo $c_indicacao; ?>">
                                </div>
                            </div>
                        </div>
                        <!--  Aba de contatos -->
                        <div role="tabpanel" class="tab-pane" id="dados_contatos">
                            <div style="padding-top:20px;">
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Convênio </label>
                                    <div class="col-sm-3">
                                        <select class="form-control form-control-lg" id="convenio" name="convenio">
                                            <?php
                                            $c_sql = "SELECT convenios.id, convenios.nome FROM convenios ORDER BY convenios.nome";
                                            $result = $conection->query($c_sql);
                                            // insiro os registro do banco de dados na tabela 
                                            while ($c_linha = $result->fetch_assoc()) {
                                                echo "
                                        <option>$c_linha[nome]</option>";
                                            }
                                            ?>
                                        </select>

                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Matricula</label>
                                    <div class="col-sm-3">
                                        <input type="text" maxlength="50" class="form-control" name="matricula" value="<?php echo $c_matricula; ?>">
                                    </div>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Fone 1 (*) </label>
                                    <div class="col-sm-2">
                                        <input type="tel" maxlength="25" onkeyup="handlePhone(event)" class=" form-control" id="telefone1" name="telefone1" value="<?php echo $c_telefone1; ?>">
                                    </div>
                                    <label class="col-sm-1 col-form-label">Fone 2</label>
                                    <div class="col-sm-2">
                                        <input type="tel" maxlength="25" onkeyup="handlePhone(event)" class="form-control" id="telefone2" name="telefone2" value="<?php echo $c_telefone2; ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">E-mail</label>
                                    <div class="col-sm-5">
                                        <input type="text" maxlength="225" class="form-control" name="email" value="<?php echo $c_email; ?>">
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label class="col-sm-3 col-form-label">CPF</label>
                                    <div class="col-sm-2">
                                        <input type="text" maxlength="11" placeholder="apenas numeros" class="form-control" name="cpf" value="<?php echo $c_cpf; ?>">
                                    </div>
                                    <label class="col-sm-1 col-form-label">CI. </label>
                                    <div class="col-sm-2">
                                        <input type="text" maxlength="20" class="form-control" name="identidade" value="<?php echo $c_identidade; ?>">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- pagina Observações -->
                        <div role="tabpanel" class="tab-pane" id="dados_obs">
                            <div style="padding-top:20px;">
                                <div class="form-group">
                                    <label class="col-sm-1 col-form-label">Observação</label>
                                    <div class="col-sm-7">
                                        <textarea class="form-control" id="obs" name="obs" rows="15"><?php echo $c_obs; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="offset-sm-0 col-sm-3">
                                <button type="submit" class="btn btn-primary"><span class='glyphicon glyphicon-floppy-saved'></span> Salvar</button>
                                <a class='btn btn-danger' href='/smedweb/pacientes_lista.php'><span class='glyphicon glyphicon-remove'></span> Cancelar</a>
                            </div>
                        </div>
                  
            </form>
        </body>
    </div>

</body>

</html>