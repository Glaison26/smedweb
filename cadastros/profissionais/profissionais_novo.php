<?php
// controle de acesso ao formulário
//session_start();
//if (!isset($_SESSION['newsession'])) {
//    die('Acesso não autorizado!!!');
//}

// funções 
include("..\..\conexao.php"); // conexão de banco de dados
include_once "..\..\lib_gop.php";
include("..\..\links.php");

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
    $d_datanasc = $_POST['datanasc'];
    $c_gera_agenda = $_POST['chkagenda'];
    $c_crm = $_POST['crm'];
}

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
$d_datanasc = "";
$c_gera_agenda = "";
$c_crm = "";

// variaveis para mensagens de erro e suscessso da gravação
$msg_gravou = "";
$msg_erro = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
    $c_gera_agenda = $_POST['chkagenda'];
    $c_especialidade = $_POST['especialidade'];
    $c_crm = $_POST['crm'];
    $c_identidade = $_POST['identidade'];
    //
    do {
        
        // consiste email
        if (!validaEmail($c_email) && !empty($c_email)) {
            $msg_erro = "E-mail informado inválido!!";
            break;
        }

        if (!validaCPF($c_cpf)) {
            $msg_erro = "CPF informado inválido!!";
            break;
        }
        //verifica se cnpj já foi cadastrado
        $c_sql = "select profissionais.cpf from profissionais where cpf='$c_cpf'";
        $result = $conection->query($c_sql);
        $registro = $result->fetch_assoc();
        if ($registro) {
            $msg_erro = "Já existe este CPF deste profissional cadastrado!!";
            break;
        }
        // rotina para pegar id da especialidade selecionada
        $c_especialidade = $_POST['especialidade'];
        $c_sqlespecialidade = "SELECT especialidades.id, especialidades.descricao FROM especialidades where especialidades.descricao='$c_especialidade'";
        $result = $conection->query($c_sqlespecialidade);
        $c_linha = $result->fetch_assoc();
        $c_id_especialidade = $c_linha['id'];
        // grava dados no banco
        // faço a Leitura da tabela com sql

        $c_sql = "Insert into profissionais (nome, endereco, bairro, cidade, cep, uf, email,
         fone1, fone2, observacao, id_especialidade, cpf, identidade, sexo, datanasc, gera_agenda, crm)" .
            "Value ('$c_nome', '$c_endereco', '$c_bairro', '$c_cidade', '$c_cep', '$c_uf','$c_email', '$c_telefone1', '$c_telefone2', 
             '$c_obs', '$c_id_especialidade', '$c_cpf', '$c_idendidade', '$c_sexo', '$d_datanasc', '$c_gera_agenda', '$c_crm')";

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

<div class="container -my5">

    <body>
        <div class="panel panel-primary class">
            <div class="panel-heading text-center">
                <h4>SmartMed - Sistema Médico</h4>
                <h5>Novo Profissional<h5>
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
                                    <input class="form-check-input" type="checkbox" value="S" name="chkagenda" id="chkagenda" checked>
                                </div>
                                <label class="form-check-label col-form-label">Gerar Agenda</label>
                            </div>
                        </div>
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
                                <input type="text" required maxlength="200" class="form-control" name="nome" value="<?php echo $c_nome; ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Especialidade</label>
                            <div class="col-sm-3">
                                <select class="form-control form-control-lg" id="especialidade" name="especialidade" required>
                                    <option></option>";
                                    <?php
                                    $c_sql = "SELECT especialidades.id, especialidades.descricao FROM especialidades ORDER BY especialidades.descricao";
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
                            <input type="date" required maxlength="10" class="form-control" placeholder="dd/mm/yyyy" name="datanasc" id="datanasc" onkeypress="mascaraData(this)" value="<?php echo $d_datanasc; ?>">
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="dados_contatos">
                    <div style="padding-top:20px;">
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Fone 1 (*) </label>
                            <div class="col-sm-2">
                                <input type="tel" maxlength="25" required onkeyup="handlePhone(event)" class=" form-control" name="telefone1" value="<?php echo $c_telefone1; ?>">
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
    </body>
</div>

</html>