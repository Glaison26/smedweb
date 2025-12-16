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
    $c_datanasc = $_POST['datanasc'];
    $c_datanasc = date("Y-m-d", strtotime(str_replace('/', '-', $c_datanasc)));
    $c_gera_agenda = $_POST['chkagenda'];
    $c_crm = $_POST['crm'];
    $c_especialidade = $_POST['especialidades'];
    $c_gera_agenda = $_POST['chkagenda'];
}

// rotina de post dos dados do formuário
$c_id = "";
$c_nome = "";
$c_endereco = "";
$c_bairro = "";
$c_cep = "";
$c_cidade = "";
$c_uf = "";
$c_email = "";
$c_fone1 = "";
$c_fone2 = "";
$c_obs = "";
$c_sexo = "";
$c_identidade = "";
$c_cpf = "";
$c_datanasc = "";
$c_gera_agenda = "";
$c_crm = "";
$c_id = $_GET["id"];
// variaveis para mensagens de erro e suscessso da gravação
$msg_gravou = "";
$msg_erro = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {  // metodo get para carregar dados no formulário

    if (!isset($_GET["id"])) {
        header('location: /smedweb/cadastro/profissionais/profissionais_lista.php');
        exit;
    }


    // leitura do cliente através de sql usando id passada
    $c_sql = "select * from profissionais where id=$c_id";
    $result = $conection->query($c_sql);
    $registro = $result->fetch_assoc();

    if (!$registro) {
        header('location: /smedweb/cadastro/profissionais/profissionais_lista.php');
        exit;
    }

    $c_nome = $registro["nome"];
    $c_endereco = $registro["endereco"];;
    $c_bairro = $registro["bairro"];;
    $c_cep = $registro["cep"];
    $c_cidade = $registro["cidade"];
    $c_uf = $registro["uf"];
    $c_email = $registro["email"];
    $c_fone1 = $registro["fone1"];
    $c_fone2 = $registro["fone2"];
    $c_obs = $registro["observacao"];
    $c_sexo = $registro["sexo"];
    $c_identidade = $registro["identidade"];
    $c_cpf = $registro["cpf"];
    $c_datanasc =  DateTime::createFromFormat('Y-m-d', $registro["datanasc"]);
    $c_datanasc = $c_datanasc->format('d/m/Y');
    $c_gera_agenda = $registro['gera_agenda'];
    $c_crm = $registro['crm'];
    $i_especialidade = $registro['id_especialidade'];
    $c_gera_agenda = $registro['gera_agenda'];
    // tipo

} else {  // metodo post para gravar dados



    $c_nome = $_POST['nome'];
    $c_endereco = $_POST['endereco'];
    $c_bairro = $_POST['bairro'];
    $c_cep = $_POST['cep'];
    $c_cidade = $_POST['cidade'];
    $c_uf = $_POST['uf'];
    $c_email = $_POST['email'];
    $c_fone1 = $_POST['fone1'];
    $c_fone2 = $_POST['fone2'];
    $c_obs = $_POST['obs'];
    $c_sexo = $_POST['genero'];
    $c_identidade = $_POST['identidade'];
    $c_cpf = $_POST['cpf'];
    $c_datanasc = $_POST['datanasc'];
    $c_datanasc = date("Y-m-d", strtotime(str_replace('/', '-', $c_datanasc)));
    if (isset($_POST['chkagenda'])) {
        $c_gera_agenda = 'S';
    } else {
        $c_gera_agenda = 'N';
    }
    $c_crm = $_POST['crm'];
    $c_especialidade = $_POST['especialidades'];

    do {

        // consiste email
        if (!validaEmail($c_email) && !empty($c_email)) {
            $msg_erro = "e-mail informado inválido!!";
            break;
        }

        if (!validaCPF($c_cpf)) {
            $msg_erro = "CPF informado inválido!!";
            break;
        }
        // grava dados no banco
        // verifica especialidade selecionada para gravar no registro
        $c_sql = "SELECT especialidades.id, especialidades.descricao FROM especialidades where especialidades.descricao='$c_especialidade'";
        $result = $conection->query($c_sql);
        // verifico se a query foi correto
        if (!$result) {
            die("Erro ao Executar Sql!!" . $conection->connect_error);
        }
        $c_linha = $result->fetch_assoc();
        $i_especialidade = $c_linha['id'];
        // faço a alteração do registro
        $c_sql = "Update profissionais" .
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
        header('location: /smedweb/cadastros/profissionais/profissionais_lista.php');
    } while (false);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/smedweb/css/basico.css">
    <title>SmedWeb - Editar Profissional</title>
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

    <script language="Javascript">
        function confirmacao(id) {
            var resposta = confirm("Deseja remover esse registro?");
            if (resposta == true) {
                window.location.href = "/smedweb/cadastros/profissionais/profissionais_excluir.php?id=" + id;
            }
        }
    </script>
</head>

<body>
    <div class="container-fluid">
        <div class="panel panel-primary class">
            <div class="panel-heading text-center">
                <h4>SmartMed - Sistema Médico</h4>
                <h5>Editar dados do Profissional<h5>
            </div>
        </div>
    </div>
    <br>
    <div class="container content-box">
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
            <li role="presentation" class="active"><a href="#dados_profissional" aria-controls="home" role="tab" data-toggle="tab">Dados do Profissional</a></li>
            <li role="presentation"><a href="#dados_contatos" aria-controls="dados_contatos" role="tab" data-toggle="tab">Contatos/Identificação</a></li>
            <li role="presentation"><a href="#dados_obs" aria-controls="dados_obs" role="tab" data-toggle="tab">Observações</a></li>
        </ul>

        <form method="post" class="form-horizontal">
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="dados_profissional">
                    <div style="padding-top:20px;">
                        <div class="row mb-3">
                            <div class="form-check col-sm-3">
                                <div class="col-sm-3">
                                    <input class="form-check-input" type="checkbox"  name="chkagenda" id="chkagenda" <?php echo ($c_gera_agenda == 'S') ? 'checked' : ''; ?>>
                                </div>
                                <label class="form-check-label col-form-label">Incluir na Agenda</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 col-form-label"><span>Selecione Genero</span></label>
                            <?php
                            $opMasculino = "";
                            $opFeminino = "";
                            if ($c_sexo == "M") {
                                $opMasculino = "checked";
                            } else {
                                $opFeminino = "checked";
                            }
                            ?>
                            <div class="form-check">
                                <label for="masculino">
                                    <input type="radio" name="genero" id="masculino" value="M" <?php echo $opMasculino; ?>>
                                    <span>Masculino</span>
                                </label>
                                <label for="feminino">
                                    <input type="radio" name="genero" id="feminino" value="F" <?php echo $opFeminino; ?>>
                                    <span>Feminino</span>
                                </label>
                            </div>

                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Nome (*)</label>
                            <div class="col-sm-5">
                                <input type="text" required maxlength="200" class="form-control" name="nome" value="<?php echo $c_nome; ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Especialidade</label>
                            <div class="col-sm-3">
                                <select class="form-control form-control-lg" id="especialidades" name="especialidades" value="<?php echo $c_especialidade; ?>">
                                    <?php
                                    // sql para os treinamentos de cursos de pré requisitos menos o treinamento que está sendo editado
                                    $c_sql = "SELECT especialidades.id, especialidades.descricao FROM especialidades";

                                    $result = $conection->query($c_sql);
                                    // verifico se a query foi correto
                                    if (!$result) {
                                        die("Erro ao Executar Sql!!" . $conection->connect_error);
                                    }
                                    while ($c_linha = $result->fetch_assoc()) {
                                        if ($c_linha['id'] == $i_especialidade) {
                                            $op = 'selected';
                                        } else {
                                            $op = '';
                                        }
                                        echo "
                                             <option $op>" . $c_linha['descricao'] . "</option>";
                                    }
                                    ?>

                                </select>
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

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Data Nascimento (*)</label>
                        <div class="col-sm-2">
                            <input type="text" maxlength="10" class="form-control" placeholder="dd/mm/yyyy" name="datanasc" id="datanasc" onkeypress="mascaraData(this)" value="<?php echo $c_datanasc; ?>">
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="dados_contatos">
                    <div style="padding-top:20px;">
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Fone 1 (*) </label>
                            <div class="col-sm-2">
                                <input type="tel" maxlength="25" required onkeyup="handlePhone(event)" class=" form-control" name="fone1" value="<?php echo $c_fone1; ?>">
                            </div>
                            <label class="col-sm-1 col-form-label">Fone 2</label>
                            <div class="col-sm-2">
                                <input type="tel" maxlength="25" onkeyup="handlePhone(event)" class="form-control" name="fone2" value="<?php echo $c_fone2; ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">E-mail (*)</label>
                            <div class="col-sm-5">
                                <input type="text" maxlength="225" class="form-control" name="email" value="<?php echo $c_email; ?>">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="col-sm-3 col-form-label">CPF (*)</label>
                            <div class="col-sm-2">
                                <input type="text" maxlength="11" required placeholder="apenas numeros" class="form-control" name="cpf" value="<?php echo $c_cpf; ?>">
                            </div>
                            <label class="col-sm-1 col-form-label">CI. (*)</label>
                            <div class="col-sm-2">
                                <input type="text" maxlength="20" class="form-control" name="identidade" value="<?php echo $c_identidade; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 col-form-label">CRM </label>
                            <div class="col-sm-2">
                                <input type="text" maxlength="20" class="form-control" name="crm" value="<?php echo $c_crm; ?>">
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
                        <a class='btn btn-danger' href='/smedweb/cadastros/profissionais/profissionais_lista.php'><span class='glyphicon glyphicon-remove'></span> Cancelar</a>
                    </div>
                </div>
            </div>
        </form>
    </div>

    </div>

</body>

</html>