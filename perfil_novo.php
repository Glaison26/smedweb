<?php
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}
include("conexao.php");  // conexão
include("links.php");
include("config_tabelas.php");
$c_descricao = "";
// gravação das informações do perfil do formulário
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // criação das variaaveis com check ou não check 
    if (isset($_POST['chkativo'])) {
        $c_ativo = 'S';
    } else {
        $c_ativo = 'N';
    }
    if (isset($_POST['chkacessofichaclinica'])) {
        $c_chkacessofichaclinica = 'S';
    } else {
        $c_chkacessofichaclinica = 'N';
    }
    if (isset($_POST['chkeditarfichaclinica'])) {
        $c_chkeditarfichaclinica = 'S';
    } else {
        $c_chkeditarfichaclinica = 'N';
    }
    if (isset($_POST['chkhistoriaclinica'])) {
        $c_chkhistoriaclinica = 'S';
    } else {
        $c_chkhistoriaclinica = 'N';
    }
    if (isset($_POST['chkimagens'])) {
        $c_chkimagens = 'S';
    } else {
        $c_chkimagens = 'N';
    }
    if (isset($_POST['chkeventos'])) {
        $c_chkeventos = 'S';
    } else {
        $c_chkeventos = 'N';
    }
    if (isset($_POST['chkexcluirpaciente'])) {
        $c_chkexcluirpaciente = 'S';
    } else {
        $c_chkexcluirpaciente = 'N';
    }
    if (isset($_POST['chkagenda'])) {
        $c_chkagenda = 'S';
    } else {
        $c_chkagenda = 'N';
    }
    if (isset($_POST['chkconfig_agenda'])) {
        $c_chkconfig_agenda = 'S';
    } else {
        $c_chkconfig_agenda = 'N';
    }
    if (isset($_POST['chkmarcacao'])) {
        $c_chkmarcacao = 'S';
    } else {
        $c_chkmarcacao = 'N';
    }
    if (isset($_POST['chkincluir'])) {
        $c_chkincluir = 'S';
    } else {
        $c_chkincluir = 'N';
    }
    if (isset($_POST['chkremanejar'])) {
        $c_chkremanejar = 'S';
    } else {
        $c_chkremanejar = 'N';
    }
    if (isset($_POST['chkdesmarcar'])) {
        $c_chkdesmarcar = 'S';
    } else {
        $c_chkdesmarcar = 'N';
    }
    if (isset($_POST['chkacessoprescricao'])) {
        $c_chkacessoprescricao = 'S';
    } else {
        $c_chkacessoprescricao = 'N';
    }
    if (isset($_POST['chkatestado'])) {
        $c_chkatestado = 'S';
    } else {
        $c_chkatestado = 'N';
    }
    if (isset($_POST['chkformulas'])) {
        $c_chkformulas = 'S';
    } else {
        $c_chkformulas = 'N';
    }
    if (isset($_POST['chkmedicamentos'])) {
        $c_chkmedicamentos = 'S';
    } else {
        $c_chkmedicamentos = 'N';
    }
    if (isset($_POST['chklaudos'])) {
        $c_chklaudos = 'S';
    } else {
        $c_chklaudos = 'N';
    }
    if (isset($_POST['chkorientacoes'])) {
        $c_chkorientacoes = 'S';
    } else {
        $c_chkorientacoes = 'N';
    }
    if (isset($_POST['chkrelatorios'])) {
        $c_chkrelatorios = 'S';
    } else {
        $c_chkrelatorios = 'N';
    }
    if (isset($_POST['chkconfigprescricao'])) {
        $c_chkconfigprescricao = 'S';
    } else {
        $c_chkconfigprescricao = 'N';
    }
    if (isset($_POST['chkfinanceiro'])) {
        $c_chkfinanceiro = 'S';
    } else {
        $c_chkfinanceiro = 'N';
    }
    if (isset($_POST['chkconfig'])) {
        $c_chkconfig = 'S';
    } else {
        $c_chkconfig = 'N';
    }
    if (isset($_POST['chkprofissionais'])) {
        $c_chkprofissionais = 'S';
    } else {
        $c_chkprofissionais = 'N';
    }
    if (isset($_POST['chkconvenios'])) {
        $c_chkconvenios = 'S';
    } else {
        $c_chkconvenios = 'N';
    }
    if (isset($_POST['chkprocedimentos'])) {
        $c_chkprocedimentos = 'S';
    } else {
        $c_chkprocedimentos = 'N';
    }
    if (isset($_POST['chkitenslaudos'])) {
        $c_chkitenslaudos = 'S';
    } else {
        $c_chkitenslaudos = 'N';
    }
    if (isset($_POST['chkmedicamentos'])) {
        $c_chkmedicamentos = 'S';
    } else {
        $c_chkmedicamentos = 'N';
    }
    if (isset($_POST['chkorientacoespadroes'])) {
        $c_chkorientacoespadroes = 'S';
    } else {
        $c_chkorientacoespadroes = 'N';
    }
    if (isset($_POST['chkformulaspadroes'])) {
        $c_chkformulaspadroes = 'S';
    } else {
        $c_chkformulaspadroes = 'N';
    }
    if (isset($_POST['chkatestadospadroes'])) {
        $c_chkatestadospadroes = 'S';
    } else {
        $c_chkatestadospadroes = 'N';
    }
    if (isset($_POST['chkgruposmedicamentos'])) {
        $c_chkgruposmedicamentos = 'S';
    } else {
        $c_chkgruposmedicamentos = 'N';
    }
    if (isset($_POST['chkgruposexames'])) {
        $c_chkgruposexames = 'S';
    } else {
        $c_chkgruposexames = 'N';
    }
    if (isset($_POST['chkgruposformulas'])) {
        $c_chkgruposformulas = 'S';
    } else {
        $c_chkgruposformulas = 'N';
    }
    if (isset($_POST['chkgruposcomponentes'])) {
        $c_chkgruposcomponentes = 'S';
    } else {
        $c_chkgruposcomponentes = 'N';
    }
    if (isset($_POST['chkespecialidades'])) {
        $c_chkespecialidades = 'S';
    } else {
        $c_chkespecialidades = 'N';
    }
    if (isset($_POST['chkconfig_eventos'])) {
        $c_chkconfig_eventos = 'S';
    } else {
        $c_chkconfig_eventos = 'N';
    }
    if (isset($_POST['chkdiagnosticos'])) {
        $c_chkdiagnosticos = 'S';
    } else {
        $c_chkdiagnosticos = 'N';
    }
    if (isset($_POST['chkconfig_geral'])) {
        $c_chkconfig_geral = 'S';
    } else {
        $c_chkconfig_geral = 'N';
    }
    // gravo os dados com sql
    $c_sql = "Insert into perfil_usuarios_opcoes (descricao, ativo, bairro, cidade, cep, uf, email,
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
    header('location: /smedweb/perfil_acesso.php');
    
}
?>

<!DOCTYPE html>
<html lang="en">

<body>

    <div class="panel panel-primary class">
        <div class="panel-heading text-center">
            <h4>SmartMed - Sistema Médico</h4>
            <h5>Novo Perfil de Usuários do Sistema<h5>
        </div>
    </div>
    <br>
    <div class="container -my5">

        <body>

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
            <!-- Definição das tabs  -->
            <form method="post">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#descricao" aria-controls="home" role="tab" data-toggle="tab">Descrição</a></li>
                    <li role="presentation"><a href="#fichaclinica" aria-controls="fichaclinica" role="tab" data-toggle="tab">Ficha Clinica</a></li>
                    <li role="presentation"><a href="#agenda" aria-controls="agenda" role="tab" data-toggle="tab">Agenda</a></li>
                    <li role="presentation"><a href="#prescricao" aria-controls="prescricao" role="tab" data-toggle="tab">Prescrições</a></li>
                    <li role="presentation"><a href="#cadastros" aria-controls="cadastros" role="tab" data-toggle="tab">Cadastros</a></li>

                </ul>
                <div class="tab-content">
                    <!-- aba de descrição -->
                    <div role="tabpanel" class="tab-pane active" id="descricao">
                        <div style="padding-top:20px;">
                            <div class="row mb-3">
                                <div class="form-check col-sm-2">
                                    <label class="form-check-label col-form-label">Perfil Ativo</label>
                                    <div class="col-sm-3">
                                        <input class="form-check-input" type="checkbox" value="S" name="chkativo" id="chkativo" checked>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="mb-3 row">
                                <label for="add_descricaoField" class="col-md-2 form-label">Descrição do Perfil (*)</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="add_descricaoField" name="add_descricaoField" Value="<?php echo $c_descricao; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- aba de ficha clinica -->
                    <div role="tabpanel" class="tab-pane" id="fichaclinica">
                        <div style="padding-top:20px;">
                            <div class="row mb-3">
                                <div class="form-check col-sm-3">
                                    <label class="form-check-label col-form-label">Acessar Ficha Clinica</label>
                                    <div class="col-sm-3">
                                        <input class="form-check-input" type="checkbox" value="S" name="chkacessofichaclinica" id="chkacessofichaclinica" checked>
                                    </div>
                                </div>
                                <div class="form-check col-sm-3">
                                    <label class="form-check-label col-form-label">Editar Ficha Clinica</label>
                                    <div class="col-sm-3">
                                        <input class="form-check-input" type="checkbox" value="S" name="chkeditarfichaclinica" id="chkeditarfichaclinica" checked>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="form-check col-sm-3">
                                    <label class="form-check-label col-form-label">Acessar História Clinica</label>
                                    <div class="col-sm-3">
                                        <input class="form-check-input" type="checkbox" value="S" name="chkhistoriaclinica" id="chkhistoriaclinica" checked>
                                    </div>
                                </div>
                                <div class="form-check col-sm-3">
                                    <label class="form-check-label col-form-label">Acessar Imagens Paciente</label>
                                    <div class="col-sm-3">
                                        <input class="form-check-input" type="checkbox" value="S" name="chkimagens" id="chkimagens" checked>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="form-check col-sm-3">
                                    <label class="form-check-label col-form-label">Acessar Eventos Clinicos</label>
                                    <div class="col-sm-3">
                                        <input class="form-check-input" type="checkbox" value="S" name="chkeventos" id="chkeventos" checked>
                                    </div>
                                </div>
                                <div class="form-check col-sm-3">
                                    <label class="form-check-label col-form-label">Excluir Paciente</label>
                                    <div class="col-sm-3">
                                        <input class="form-check-input" type="checkbox" value="S" name="chkexcluirpaciente" id="chkexcluirpaciente" checked>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- aba de agenda -->
                    <div role="tabpanel" class="tab-pane" id="agenda">
                        <div style="padding-top:20px;">
                            <div class="row mb-3">
                                <div class="form-check col-sm-3">
                                    <label class="form-check-label col-form-label">Acessar Agenda</label>
                                    <div class="col-sm-3">
                                        <input class="form-check-input" type="checkbox" value="S" name="chkagenda" id="chkagenda" checked>
                                    </div>
                                </div>
                                <div class="form-check col-sm-4">
                                    <label class="form-check-label col-form-label">Acessar Criação e configuração da Agenda</label>
                                    <div class="col-sm-2">
                                        <input class="form-check-input" type="checkbox" value="S" name="chkconfig_agenda" id="chkconfig_agenda" checked>
                                    </div>
                                </div>

                            </div>
                            <div class="row mb-3">
                                <div class="form-check col-sm-3">
                                    <label class="form-check-label col-form-label">Marcação de Consultas</label>
                                    <div class="col-sm-3">
                                        <input class="form-check-input" type="checkbox" value="S" name="chkmarcacao" id="chkmarcacao" checked>
                                    </div>
                                </div>
                                <div class="form-check col-sm-3">
                                    <label class="form-check-label col-form-label">Incluir Paciente</label>
                                    <div class="col-sm-3">
                                        <input class="form-check-input" type="checkbox" value="S" name="chkincluir" id="chkincluir" checked>
                                    </div>

                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-check col-sm-3">
                                    <label class="form-check-label col-form-label">Remanejar Marcação</label>
                                    <div class="col-sm-3">
                                        <input class="form-check-input" type="checkbox" value="S" name="chkremanejar" id="chkremanejar" checked>
                                    </div>
                                </div>
                                <div class="form-check col-sm-3">
                                    <label class="form-check-label col-form-label">Desmarcar</label>
                                    <div class="col-sm-3">
                                        <input class="form-check-input" type="checkbox" value="S" name="chkdesmarcar" id="chkdesmacar" checked>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- aba de prescrições -->
                    <div role="tabpanel" class="tab-pane" id="prescricao">
                        <div style="padding-top:20px;">
                            <div class="row mb-3">
                                <div class="form-check col-sm-3">
                                    <label class="form-check-label col-form-label">Acesso as Prescrições</label>
                                    <div class="col-sm-3">
                                        <input class="form-check-input" type="checkbox" value="S" name="chkacessoprescricao" id="chkacessoprescricao" checked>
                                    </div>
                                </div>
                                <div class="form-check col-sm-3">
                                    <label class="form-check-label col-form-label">Atestados Médicos</label>
                                    <div class="col-sm-3">
                                        <input class="form-check-input" type="checkbox" value="S" name="chkatestado" id="chkatestado" checked>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-check col-sm-3">
                                    <label class="form-check-label col-form-label">Elaboração de Fórmulas</label>
                                    <div class="col-sm-3">
                                        <input class="form-check-input" type="checkbox" value="S" name="chkformulas" id="chkformulas" checked>
                                    </div>
                                </div>
                                <div class="form-check col-sm-4">
                                    <label class="form-check-label col-form-label">Prescrição de Medicamentos</label>
                                    <div class="col-sm-2">
                                        <input class="form-check-input" type="checkbox" value="S" name="chkmedicamentos" id="chkmedicamentos" checked>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-check col-sm-3">
                                    <label class="form-check-label col-form-label">Emissão de Laudos</label>
                                    <div class="col-sm-3">
                                        <input class="form-check-input" type="checkbox" value="S" name="chklaudos" id="chklaudos" checked>
                                    </div>
                                </div>
                                <div class="form-check col-sm-4">
                                    <label class="form-check-label col-form-label">Orientações Médicas</label>
                                    <div class="col-sm-2">
                                        <input class="form-check-input" type="checkbox" value="S" name="chkorientacoes" id="chkorientacoes" checked>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-check col-sm-3">
                                    <label class="form-check-label col-form-label">Relatórios Médicos</label>
                                    <div class="col-sm-3">
                                        <input class="form-check-input" type="checkbox" value="S" name="chkrelatorios" id="chkrelatorios" checked>
                                    </div>
                                </div>
                                <div class="form-check col-sm-4">
                                    <label class="form-check-label col-form-label">Configurações Prescrições</label>
                                    <div class="col-sm-2">
                                        <input class="form-check-input" type="checkbox" value="S" name="chkconfigprescricao" id="chkconfigprescricao" checked>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- aba de  cadastros -->
                    <div role="tabpanel" class="tab-pane" id="cadastros">
                        <div style="padding-top:20px;">
                            <div class="row mb-3">
                                <div class="form-check col-sm-3">
                                    <label class="form-check-label col-form-label">Acesso ao Financeiro</label>
                                    <div class="col-sm-3">
                                        <input class="form-check-input" type="checkbox" value="S" name="chkfinanceiro" id="chkfinanceiro" checked>
                                    </div>
                                </div>
                                <div class="form-check col-sm-4">
                                    <label class="form-check-label col-form-label">Acesso as configurações</label>
                                    <div class="col-sm-2">
                                        <input class="form-check-input" type="checkbox" value="S" name="chkconfig" id="chkconfig" checked>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-check col-sm-3">
                                    <label class="form-check-label col-form-label">Profissionais</label>
                                    <div class="col-sm-3">
                                        <input class="form-check-input" type="checkbox" value="S" name="chkprofissionais" id="chkprofissionais" checked>
                                    </div>
                                </div>
                                <div class="form-check col-sm-4">
                                    <label class="form-check-label col-form-label">Convênios</label>
                                    <div class="col-sm-2">
                                        <input class="form-check-input" type="checkbox" value="S" name="chkconvenios" id="chkconvenios" checked>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-check col-sm-3">
                                    <label class="form-check-label col-form-label">Procedimentos</label>
                                    <div class="col-sm-3">
                                        <input class="form-check-input" type="checkbox" value="S" name="chkprocedimentos" id="chkprocedimentos" checked>
                                    </div>
                                </div>
                                <div class="form-check col-sm-4">
                                    <label class="form-check-label col-form-label">Itens de Laudos</label>
                                    <div class="col-sm-2">
                                        <input class="form-check-input" type="checkbox" value="S" name="chkitenslaudos" id="chkitenslaudos" checked>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-check col-sm-3">
                                    <label class="form-check-label col-form-label">Medicamentos</label>
                                    <div class="col-sm-3">
                                        <input class="form-check-input" type="checkbox" value="S" name="chkmedicamentos" id="chkmedicamentos" checked>
                                    </div>
                                </div>
                                <div class="form-check col-sm-4">
                                    <label class="form-check-label col-form-label">Orientações padrões</label>
                                    <div class="col-sm-2">
                                        <input class="form-check-input" type="checkbox" value="S" name="chkorientacoespadroes" id="chkorientacoespadroes" checked>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-check col-sm-3">
                                    <label class="form-check-label col-form-label">Fórmulas padrões</label>
                                    <div class="col-sm-3">
                                        <input class="form-check-input" type="checkbox" value="S" name="chkformulaspadroes" id="chkformulaspadroes" checked>
                                    </div>
                                </div>
                                <div class="form-check col-sm-4">
                                    <label class="form-check-label col-form-label">Atestados padrões</label>
                                    <div class="col-sm-2">
                                        <input class="form-check-input" type="checkbox" value="S" name="chkatestadospadroes" id="chkatestadospadroes" checked>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-check col-sm-3">
                                    <label class="form-check-label col-form-label">Grupos de Medicamentos</label>
                                    <div class="col-sm-3">
                                        <input class="form-check-input" type="checkbox" value="S" name="chkgruposmedicamentos" id="chkgruposmedicamentos" checked>
                                    </div>
                                </div>
                                <div class="form-check col-sm-4">
                                    <label class="form-check-label col-form-label">Grupos de Exames</label>
                                    <div class="col-sm-2">
                                        <input class="form-check-input" type="checkbox" value="S" name="chkgruposexames" id="chkgruposexames" checked>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-check col-sm-3">
                                    <label class="form-check-label col-form-label">Grupos de Fórmulas</label>
                                    <div class="col-sm-3">
                                        <input class="form-check-input" type="checkbox" value="S" name="chkgruposformulas" id="chkgruposformulas" checked>
                                    </div>
                                </div>
                                <div class="form-check col-sm-4">
                                    <label class="form-check-label col-form-label">Grupos de Componentes</label>
                                    <div class="col-sm-2">
                                        <input class="form-check-input" type="checkbox" value="S" name="chkgruposcomponentes" id="chkgruposcomponentes" checked>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-check col-sm-3">
                                    <label class="form-check-label col-form-label">Especialidades</label>
                                    <div class="col-sm-3">
                                        <input class="form-check-input" type="checkbox" value="S" name="chkespecialidades" id="chkespecialidades" checked>
                                    </div>
                                </div>
                                <div class="form-check col-sm-4">
                                    <label class="form-check-label col-form-label">Configuração de Eventos </label>
                                    <div class="col-sm-2">
                                        <input class="form-check-input" type="checkbox" value="S" name="chkconfig_eventos" id="chkconfig_eventos" checked>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-check col-sm-3">
                                    <label class="form-check-label col-form-label">Diagnósticos</label>
                                    <div class="col-sm-3">
                                        <input class="form-check-input" type="checkbox" value="S" name="chkdiagnosticos" id="chkdiagnosticos" checked>
                                    </div>
                                </div>
                                <div class="form-check col-sm-4">
                                    <label class="form-check-label col-form-label">Configurações Gerais</label>
                                    <div class="col-sm-2">
                                        <input class="form-check-input" type="checkbox" value="S" name="chkconfig_geral" id="chkconfig_geral" checked>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <hr>
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <button type="submit" id='btn_grava' name='btn_grava' class="btn btn-primary"><span class='glyphicon glyphicon-floppy-saved'></span> Salvar</button>
                        <a class='btn btn-danger' href='/smedweb/perfil_acesso.php'><span class='glyphicon glyphicon-remove'></span> Cancelar</a>
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

        </body>
    </div>

</html>