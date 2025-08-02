<?php
// controle de acesso ao formulário
session_start();
//if (!isset($_SESSION['newsession'])) {
//    die('Acesso não autorizado!!!');
//}

// funções 
include("conexao.php"); // conexão de banco de dados
include_once "lib_gop.php";
include("links.php");


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
$d_dataprimeira = "";
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
// se a inclusão do paciente veio da agenda preencho com os dados do agendamento
if ($_SESSION['incagenda']==true){
    // seções para agenda
    $c_nome=$_SESSION['nomepac'];
    $c_convenio=$_SESSION['conveniopac'];
    $c_telefone1=$_SESSION['telefonepac'];
    $c_email=$_SESSION['emailpac'];
    $c_matricula=$_SESSION['matriculapac'];
  
}
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
    //
    do {
      
        
        // consiste email
        if (!validaEmail($c_email) && !empty($c_email)) {
            $msg_erro = "E-mail informado inválido!!";
            break;
        }

        if (!validaCPF($c_cpf)&& !empty($c_cpf)) {
            $msg_erro = "CPF informado inválido!!";
            break;
        }
             
        // rotina para pegar id da especialidade selecionada
        $c_convenio  = $_POST['convenio'];
        $c_sql_convenio = "SELECT convenios.id, convenios.nome FROM convenios where convenios.nome='$c_convenio'";
        $result = $conection->query($c_sql_convenio);
        $c_linha = $result->fetch_assoc();
        $c_id_convenio = $c_linha['id'];
        // grava dados no banco
        // faço a Leitura da tabela com sql

        $c_sql = "Insert into pacientes (nome, endereco, bairro, cidade, cep, uf, email,
         fone, fone2, obs, cpf, identidade, sexo, datanasc, indicacao, profissao, 
         pai, mae, estadocivil, cor, naturalidade, procedencia, matricula, classificacao, dataprimeira, id_convenio)" .
            " Value ('$c_nome', '$c_endereco', '$c_bairro', '$c_cidade', '$c_cep', '$c_uf','$c_email', '$c_telefone1', '$c_telefone2', 
             '$c_obs', '$c_cpf', '$c_identidade', '$c_sexo', '$d_datanasc', '$c_indicacao', '$c_profissao', '$c_pai', '$c_mae'
             , '$c_estadocivil', '$c_cor',  '$c_naturalidade', '$c_procedencia', '$c_matricula', '$c_classificacao', '$d_dataprimeira', '$c_id_convenio')";
         echo $c_sql;   
        $result = $conection->query($c_sql);
        // verifico se a query foi correto
        if (!$result) {
            die("Erro ao Executar Sql!!" . $conection->connect_error);
        }

        $msg_gravou = "Dados Gravados com Sucesso!!";
        if ($_SESSION['incagenda']==false){
            header('location: /smedweb/pacientes_lista.php');
        }else{
            header('location: /smedweb/agenda.php');
        }
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
                <h5>Novo Paciente<h5>
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
                                <input type="text" required maxlength="200" class="form-control" name="nome" value="<?php echo $c_nome; ?>">
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
                            <input type="date" required maxlength="10" class="form-control" placeholder="dd/mm/yyyy" name="datanasc" id="datanasc" onkeypress="mascaraData(this)" value="<?php echo $d_datanasc; ?>">
                        </div>
                        <label class="col-sm-1 col-form-label">1a. Consulta (*)</label>
                        <div class="col-sm-2">
                            <input type="date" required placeholder="dd/mm/yyyy" onkeypress="mascaraData(this)" class="form-control" id="dataprimeira" name="dataprimeira">
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
                                <select class="form-control form-control-lg" id="convenio" name="convenio" required>
                                    <?php
                                    $c_sql = "SELECT convenios.id, convenios.nome FROM convenios ORDER BY convenios.nome";
                                    $result = $conection->query($c_sql);
                                    echo "<option></option>";
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
                                <input type="tel" required maxlength="25" onkeyup="handlePhone(event)" class=" form-control"  id="telefone1" name="telefone1" value="<?php echo $c_telefone1; ?>">
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
                                <input type="text" required maxlength="11" placeholder="apenas numeros" class="form-control" name="cpf" value="<?php echo $c_cpf; ?>">
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
                        <?php
                        if ($_SESSION['incagenda']==false){
                            echo "<a class='btn btn-danger' href='/smedweb/pacientes_lista.php'><span class='glyphicon glyphicon-remove'></span> Cancelar</a>";
                        }else
                        {
                            echo "<a class='btn btn-danger' href='/smedweb/agenda.php'><span class='glyphicon glyphicon-remove'></span> Cancelar</a>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </form>
    </body>
</div>

</html>