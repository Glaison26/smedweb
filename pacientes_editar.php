<?php // controle de acesso ao formulário
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

include_once "lib_gop.php";
include("conexao.php"); // conexão de banco de dados
include("links.php");

// rotina de post dos dados do formuário 

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
    $c_profissao = $registro['profissao'];
    $c_pai = $registro['pai'];
    $c_mae = $registro['mae'];
    $c_convenio = $registro['id_convenio'];
    $c_identidade = $registro['identidade'];
    //
    $c_estadocivil = $registro['estadocivil'];
    $c_indicacao = $registro['indicacao'];
    // definindo sexo do radio button
    $op_sexo_masc = "";
    $op_sexo_fem = "";
    if ($c_sexo == "M") {
        $op_sexo_masc = "checked";
    } else {
        $op_sexo_fem = "checked";
    }
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
    $c_profissao = $_POST['profissao'];
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

        // faço a alteração do registro
        $c_sql = "Update pacientes" .
            " SET nome='$c_nome', endereco='$c_endereco', bairro='$c_bairro', cidade='$c_cidade', cep='$c_cep', uf='$c_uf', email='$c_email',
         fone='$c_telefone1', fone2='$c_telefone2', obs='$c_obs', cpf='$c_cpf', identidade='$c_identidade', sexo='$c_sexo', datanasc='$c_datanasc',
         indicacao='$c_indicacao', profissao='$c_profissao', pai='$c_pai', mae='$c_mae', estadocivil='$c_estadocivil', cor='$c_cor',
         naturalidade='$c_naturalidade', procedencia='$c_procedencia', matricula='$c_matricula', classificacao='$c_classificacao', dataprimeira='$c_dataprimeira',
         id_convenio='$c_id_convenio'" .
         "where id=$c_id";
        echo $c_sql;

        $result = $conection->query($c_sql);

        // verifico se a query foi correto
        if (!$result) {
            die("Erro ao Executar Sql!!" . $conection->connect_error);
        }
        $msg_gravou = "Dados Gravados com Sucesso!!";
        header('location: /smedweb/pacientes_lista.php');
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
    <!-- função para negar acesso ao usuário não autorizado -->
    <script>
        function negar() {
            alert('Acesso não autorizado para o usuário, consulte o administrador do Sistema!!!');
            void(0);
        }
    </script>
    <!-- fim da função -->

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
                                        <input type="radio" name="genero" id="masculino" value="M" <?php echo $op_sexo_masc; ?>>
                                        <span>Masculino</span>
                                    </label>
                                    <label for="feminino">
                                        <input type="radio" name="genero" id="feminino" value="F" <?php echo $op_sexo_fem; ?>>
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

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Data Nascimento (*)</label>
                            <div class="col-sm-2">
                                <input type="text" maxlength="10" class="form-control" placeholder="dd/mm/yyyy" name="datanasc" id="datanasc" onkeypress="mascaraData(this)" value="<?php echo $c_datanasc; ?>">
                            </div>
                            <label class="col-sm-1 col-form-label">1a. Consulta (*)</label>
                            <div class="col-sm-2">
                                <input type="text" placeholder="dd/mm/yyyy" onkeypress="mascaraData(this)" class="form-control" id="dataprimeira" name="dataprimeira" value="<?php echo $c_dataprimeira; ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Estado Civil </label>
                            <div class="col-sm-3">
                                <select class="form-control form-control-lg" id="estadocivil" name="estadocivil">
                                    <option value="Solteiro" <?= ($c_estadocivil == 'Solteiro') ? 'selected' : '' ?>>Solteiro</option>
                                    <option value="Casado" <?= ($c_estadocivil == 'Casado') ? 'selected' : '' ?>>Casado</option>
                                    <option value="Viúvo" <?= ($c_estadocivil == 'Viúvo') ? 'selected' : '' ?>>Viúvo</option>
                                    <option value="Divorciado" <?= ($c_estadocivil == 'Divorciado') ? 'selected' : '' ?>>Divorciado</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Cor </label>
                            <div class="col-sm-3">
                                <select class="form-control form-control-lg" id="cor" name="cor">
                                    <option value="Leuco" <?= ($c_cor == 'Leuco') ? 'selected' : '' ?>>Leuco</option>
                                    <option value="Faio" <?= ($c_cor == 'Faio') ? 'selected' : '' ?>>Faio</option>
                                    <option value="Melano" <?= ($c_cor == 'Melano') ? 'selected' : '' ?>>Melano</option>

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
                                            $c_op = "";
                                            if ($c_linha['id'] == $c_convenio) {
                                                $c_op = "selected";
                                            }
                                            echo "
                                        <option $c_op>$c_linha[nome]</option>";
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
                    <hr>
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