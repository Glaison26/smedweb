<?php
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}
include("conexao.php");  // conexão
include("links.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {  // metodo get para carregar dados no formulário

    if (!isset($_GET["id"])) {
        header('location: /smedweb/perfil_acesso.php');
        exit;
    }

    $c_id = $_GET["id"];
    // leitura do convenio através de sql usando id passada
    $c_sql = "select * from perfil_usuarios_opcoes where id=$c_id";
    $result = $conection->query($c_sql);
    $registro = $result->fetch_assoc();

    if (!$registro) {
        header('location: /smedweb/perfil_acesso.php');
        exit;
    }
    // captura valores para as variaveis
    $c_descricao = $registro['descricao'];
       
    if ($registro['ativo']== 'S') {
        $c_ativo = 'checked';
    } else {
        $c_ativo = '';
    }

    if ($registro['fichaclinica']=='S') {
        $c_chkacessofichaclinica = 'checked';
    } else {
        $c_chkacessofichaclinica = '';
    }
    if ($registro['fichaclinica_editar']=='S') {
        $c_chkeditarfichaclinica = 'checked';
    } else {
        $c_chkeditarfichaclinica = '';
    }
    if ($registro['fichaclinica_historia']=='S') {
        $c_chkhistoriaclinica = 'checked';
    } else {
        $c_chkhistoriaclinica = '';
    }
    if ($registro['fichaclinica_imagens']=='S') {
        $c_chkimagens = 'checked';
    } else {
        $c_chkimagens = '';
    }
    if ($registro['fichaclinica_eventos']=='S') {
        $c_chkeventos = 'checked';
    } else {
        $c_chkeventos = '';
    }
    if ($registro['fichaclinica_excluir']=='S') {
        $c_chkexcluirpaciente = 'checked';
    } else {
        $c_chkexcluirpaciente = '';
    }
    if ($registro['agenda']=='S') {
        $c_chkagenda = 'checked';
    } else {
        $c_chkagenda = '';
    }
    if ($registro['agenda_criacao']=='S') {
        $c_chkconfig_agenda = 'checked';
    } else {
        $c_chkconfig_agenda = '';
    }
    if ($registro['agenda_marcacao']=='S') {
        $c_chkmarcacao = 'checked';
    } else {
        $c_chkmarcacao = '';
    }
    if ($registro['agenda_incluir']=='S') {
        $c_chkincluir = 'checked';
    } else {
        $c_chkincluir = '';
    }
    if ($registro['agenda_remanejar']=='S') {
        $c_chkremanejar = 'checked';
    } else {
        $c_chkremanejar = '';
    }
    if ($registro['agenda_desmarcar']=='S') {
        $c_chkdesmarcar = 'checked';
    } else {
        $c_chkdesmarcar = '';
    }
    if ($registro['prescricao']=='S') {
        $c_chkacessoprescricao = 'checked';
    } else {
        $c_chkacessoprescricao = '';
    }
    if ($registro['prescricao_atestado']=='S') {
        $c_chkatestado = 'checked';
    } else {
        $c_chkatestado = '';
    }
    if ($registro['prescricao_formula']=='S') {
        $c_chkformulas = 'checked';
    } else {
        $c_chkformulas = '';
    }
    if ($registro['prescricao_medicamento']=='S') {
        $c_chkmedicamentos = 'checked';
    } else {
        $c_chkmedicamentos = '';
    }
    if ($registro['prescricao_laudos']=='S') {
        $c_chklaudos = 'checked';
    } else {
        $c_chklaudos = '';
    }
    if ($registro['prescricao_orientacao']=='S') {
        $c_chkorientacoes = 'checked';
    } else {
        $c_chkorientacoes = '';
    }
    if ($registro['prescricao_relatorio']=='S') {
        $c_chkrelatorios = 'checked';
    } else {
        $c_chkrelatorios = '';
    }
    if ($registro['prescricao_configuracao']=='S') {
        $c_chkconfigprescricao = 'checked';
    } else {
        $c_chkconfigprescricao = '';
    }
    if ($registro['financeiro']=='S') {
        $c_chkfinanceiro = 'S';
    } else {
        $c_chkfinanceiro = 'N';
    }
    if ($registro['configuracoes']=='S') {
        $c_chkconfig = 'checked';
    } else {
        $c_chkconfig = '';
    }
    if ($registro['cad_profissionais']=='S') {
        $c_chkprofissionais = 'checked';
    } else {
        $c_chkprofissionais = '';
    }
    if ($registro['cad_convenios']=='S') {
        $c_chkconvenios = 'checked';
    } else {
        $c_chkconvenios = '';
    }
    if ($registro['cad_procedimentos']=='S') {
        $c_chkprocedimentos = 'checked';
    } else {
        $c_chkprocedimentos = '';
    }
    if ($registro['cad_itenslaudos']=='S') {
        $c_chkitenslaudos = 'checked';
    } else {
        $c_chkitenslaudos = '';
    }
    if  ($registro['cad_medicamentos']=='S') {
        $c_chkmedicamentos = 'checked';
    } else {
        $c_chkmedicamentos = '';
    }
    if  ($registro['cad_orientacoes']=='S') {
        $c_chkorientacoespadroes = 'checked';
    } else {
        $c_chkorientacoespadroes = '';
    }
    if ($registro['cad_formula']=='S'){
        $c_chkformulaspadroes = 'checked';
    } else {
        $c_chkformulaspadroes = '';
    }
    if ($registro['cad_atestado']=='S') {
        $c_chkatestadospadroes = 'checked';
    } else {
        $c_chkatestadospadroes = '';
    }
    if  ($registro['cad_grupo_medicamento']=='S') {
        $c_chkgruposmedicamentos = 'checked';
    } else {
        $c_chkgruposmedicamentos = '';
    }
    if ($registro['cad_grupo_exame']=='S') {
        $c_chkgruposexames = 'checked';
    } else {
        $c_chkgruposexames = '';
    }
    if  ($registro['cad_componente_formula']=='S') {
        $c_chkgruposformulas = 'checked';
    } else {
        $c_chkgruposformulas = '';
    }
    if  ($registro['cad_grupo_componentes']=='S') {
        $c_chkgruposcomponentes = 'checked';
    } else {
        $c_chkgruposcomponentes = '';
    }
    if  ($registro['cad_especialidades']=='S'){
        $c_chkespecialidades = 'checked';
    } else {
        $c_chkespecialidades = '';
    }
    if  ($registro['cad_parametros_eventos']=='S') {
        $c_chkconfig_eventos = 'checked';
    } else {
        $c_chkconfig_eventos = '';
    }
    if  ($registro['cad_diagnosticos']=='S') {
        $c_chkdiagnosticos = 'checked';
    } else {
        $c_chkdiagnosticos = '';
    }


}
?>

<!-- formulário de edição dos perfis -->


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
                                        <input class="form-check-input" type="checkbox"  name="chkativo" id="chkativo" <?php echo $c_ativo ?>>
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
                                        <input class="form-check-input" type="checkbox"name="chkacessofichaclinica" id="chkacessofichaclinica" <?php echo $c_chkacessofichaclinica ?>>
                                    </div>
                                </div>
                                <div class="form-check col-sm-3">
                                    <label class="form-check-label col-form-label">Editar Ficha Clinica</label>
                                    <div class="col-sm-3">
                                        <input class="form-check-input" type="checkbox"  name="chkeditarfichaclinica" id="chkeditarfichaclinica"  <?php echo $c_chkeditarfichaclinica ?>>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="form-check col-sm-3">
                                    <label class="form-check-label col-form-label">Acessar História Clinica</label>
                                    <div class="col-sm-3">
                                        <input class="form-check-input" type="checkbox"  name="chkhistoriaclinica" id="chkhistoriaclinica" <?php echo $c_chkhistoriaclinica ?>>
                                    </div>
                                </div>
                                <div class="form-check col-sm-3">
                                    <label class="form-check-label col-form-label">Acessar Imagens Paciente</label>
                                    <div class="col-sm-3">
                                        <input class="form-check-input" type="checkbox"   name="chkimagens" id="chkimagens" <?php echo $c_chkimagens ?>>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="form-check col-sm-3">
                                    <label class="form-check-label col-form-label">Acessar Eventos Clinicos</label>
                                    <div class="col-sm-3">
                                        <input class="form-check-input" type="checkbox"   name="chkeventos" id="chkeventos" <?php echo $c_chkeventos ?>>
                                    </div>
                                </div>
                                <div class="form-check col-sm-3">
                                    <label class="form-check-label col-form-label">Excluir Paciente</label>
                                    <div class="col-sm-3">
                                        <input class="form-check-input" type="checkbox"   name="chkexcluirpaciente" id="chkexcluirpaciente" <?php echo $c_chkexcluirpaciente ?>>
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
                                        <input class="form-check-input" type="checkbox"   name="chkagenda" id="chkagenda" <?php echo $c_chkagenda ?>>
                                    </div>
                                </div>
                                <div class="form-check col-sm-4">
                                    <label class="form-check-label col-form-label">Acessar Criação e configuração da Agenda</label>
                                    <div class="col-sm-2">
                                        <input class="form-check-input" type="checkbox"   name="chkconfig_agenda" id="chkconfig_agenda" <?php echo $c_chkconfig_agenda ?>>
                                    </div>
                                </div>

                            </div>
                            <div class="row mb-3">
                                <div class="form-check col-sm-3">
                                    <label class="form-check-label col-form-label">Marcação de Consultas</label>
                                    <div class="col-sm-3">
                                        <input class="form-check-input" type="checkbox"   name="chkmarcacao" id="chkmarcacao" <?php echo $c_chkmarcacao ?>>
                                    </div>
                                </div>
                                <div class="form-check col-sm-3">
                                    <label class="form-check-label col-form-label">Incluir Paciente</label>
                                    <div class="col-sm-3">
                                        <input class="form-check-input" type="checkbox"   name="chkincluir" id="chkincluir" <?php echo $c_chkincluir ?>>
                                    </div>

                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-check col-sm-3">
                                    <label class="form-check-label col-form-label">Remanejar Marcação</label>
                                    <div class="col-sm-3">
                                        <input class="form-check-input" type="checkbox"   name="chkremanejar" id="chkremanejar" <?php echo $c_chkremanejar ?>>
                                    </div>
                                </div>
                                <div class="form-check col-sm-3">
                                    <label class="form-check-label col-form-label">Desmarcar</label>
                                    <div class="col-sm-3">
                                        <input class="form-check-input" type="checkbox"   name="chkdesmarcar" id="chkdesmacar" <?php echo $c_chkdesmarcar ?>>
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
                                        <input class="form-check-input" type="checkbox"   name="chkacessoprescricao" id="chkacessoprescricao" <?php echo $c_chkacessoprescricao ?>>
                                    </div>
                                </div>
                                <div class="form-check col-sm-3">
                                    <label class="form-check-label col-form-label">Atestados Médicos</label>
                                    <div class="col-sm-3">
                                        <input class="form-check-input" type="checkbox"   name="chkatestado" id="chkatestado" <?php echo $c_chkatestado ?>>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-check col-sm-3">
                                    <label class="form-check-label col-form-label">Elaboração de Fórmulas</label>
                                    <div class="col-sm-3">
                                        <input class="form-check-input" type="checkbox"   name="chkformulas" id="chkformulas" <?php echo $c_chkformulas ?>>
                                    </div>
                                </div>
                                <div class="form-check col-sm-4">
                                    <label class="form-check-label col-form-label">Prescrição de Medicamentos</label>
                                    <div class="col-sm-2">
                                        <input class="form-check-input" type="checkbox"   name="chkmedicamentos" id="chkmedicamentos" <?php echo $c_chkmedicamentos ?>>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-check col-sm-3">
                                    <label class="form-check-label col-form-label">Emissão de Laudos</label>
                                    <div class="col-sm-3">
                                        <input class="form-check-input" type="checkbox"   name="chklaudos" id="chklaudos" <?php echo $c_chklaudos ?>>
                                    </div>
                                </div>
                                <div class="form-check col-sm-4">
                                    <label class="form-check-label col-form-label">Orientações Médicas</label>
                                    <div class="col-sm-2">
                                        <input class="form-check-input" type="checkbox"   name="chkorientacoes" id="chkorientacoes" <?php echo $c_chkorientacoes ?>>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-check col-sm-3">
                                    <label class="form-check-label col-form-label">Relatórios Médicos</label>
                                    <div class="col-sm-3">
                                        <input class="form-check-input" type="checkbox"   name="chkrelatorios" id="chkrelatorios" <?php echo $c_chkrelatorios ?>>
                                    </div>
                                </div>
                                <div class="form-check col-sm-4">
                                    <label class="form-check-label col-form-label">Configurações Prescrições</label>
                                    <div class="col-sm-2">
                                        <input class="form-check-input" type="checkbox"   name="chkconfigprescricao" id="chkconfigprescricao" <?php echo $c_chkconfigprescricao ?>>
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
                                        <input class="form-check-input" type="checkbox"   name="chkfinanceiro" id="chkfinanceiro" <?php echo $c_chkfinanceiro ?>>
                                    </div>
                                </div>
                                <div class="form-check col-sm-4">
                                    <label class="form-check-label col-form-label">Acesso as configurações</label>
                                    <div class="col-sm-2">
                                        <input class="form-check-input" type="checkbox"   name="chkconfig" id="chkconfig" <?php echo $c_chkconfig ?>>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-check col-sm-3">
                                    <label class="form-check-label col-form-label">Profissionais</label>
                                    <div class="col-sm-3">
                                        <input class="form-check-input" type="checkbox"   name="chkprofissionais" id="chkprofissionais" <?php echo $c_chkprofissionais ?>>
                                    </div>
                                </div>
                                <div class="form-check col-sm-4">
                                    <label class="form-check-label col-form-label">Convênios</label>
                                    <div class="col-sm-2">
                                        <input class="form-check-input" type="checkbox"   name="chkconvenios" id="chkconvenios" <?php echo $c_chkconvenios ?>>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-check col-sm-3">
                                    <label class="form-check-label col-form-label">Procedimentos</label>
                                    <div class="col-sm-3">
                                        <input class="form-check-input" type="checkbox"   name="chkprocedimentos" id="chkprocedimentos" <?php echo $c_chkprocedimentos ?>>
                                    </div>
                                </div>
                                <div class="form-check col-sm-4">
                                    <label class="form-check-label col-form-label">Itens de Laudos</label>
                                    <div class="col-sm-2">
                                        <input class="form-check-input" type="checkbox"   name="chkitenslaudos" id="chkitenslaudos" <?php echo $c_chkitenslaudos ?>>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-check col-sm-3">
                                    <label class="form-check-label col-form-label">Medicamentos</label>
                                    <div class="col-sm-3">
                                        <input class="form-check-input" type="checkbox"   name="chkmedicamentos" id="chkmedicamentos" <?php echo $c_chkmedicamentos ?>>
                                    </div>
                                </div>
                                <div class="form-check col-sm-4">
                                    <label class="form-check-label col-form-label">Orientações padrões</label>
                                    <div class="col-sm-2">
                                        <input class="form-check-input" type="checkbox"   name="chkorientacoespadroes" id="chkorientacoespadroes" <?php echo $c_chkorientacoespadroes ?>>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-check col-sm-3">
                                    <label class="form-check-label col-form-label">Fórmulas padrões</label>
                                    <div class="col-sm-3">
                                        <input class="form-check-input" type="checkbox"   name="chkformulaspadroes" id="chkformulaspadroes" <?php echo $c_chkformulaspadroes ?>>
                                    </div>
                                </div>
                                <div class="form-check col-sm-4">
                                    <label class="form-check-label col-form-label">Atestados padrões</label>
                                    <div class="col-sm-2">
                                        <input class="form-check-input" type="checkbox"   name="chkatestadospadroes" id="chkatestadospadroes" <?php echo $c_chkatestadospadroes ?>>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-check col-sm-3">
                                    <label class="form-check-label col-form-label">Grupos de Medicamentos</label>
                                    <div class="col-sm-3">
                                        <input class="form-check-input" type="checkbox"   name="chkgruposmedicamentos" id="chkgruposmedicamentos" <?php echo $c_chkgruposmedicamentos ?>>
                                    </div>
                                </div>
                                <div class="form-check col-sm-4">
                                    <label class="form-check-label col-form-label">Grupos de Exames</label>
                                    <div class="col-sm-2">
                                        <input class="form-check-input" type="checkbox"   name="chkgruposexames" id="chkgruposexames" <?php echo $c_chkgruposexames ?>>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-check col-sm-3">
                                    <label class="form-check-label col-form-label">Grupos de Fórmulas</label>
                                    <div class="col-sm-3">
                                        <input class="form-check-input" type="checkbox"   name="chkgruposformulas" id="chkgruposformulas" <?php echo $c_chkgruposformulas ?>>
                                    </div>
                                </div>
                                <div class="form-check col-sm-4">
                                    <label class="form-check-label col-form-label">Grupos de Componentes</label>
                                    <div class="col-sm-2">
                                        <input class="form-check-input" type="checkbox"   name="chkgruposcomponentes" id="chkgruposcomponentes" <?php echo $c_chkgruposcomponentes ?>>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-check col-sm-3">
                                    <label class="form-check-label col-form-label">Especialidades</label>
                                    <div class="col-sm-3">
                                        <input class="form-check-input" type="checkbox"   name="chkespecialidades" id="chkespecialidades" <?php echo $c_chkespecialidades ?>>
                                    </div>
                                </div>
                                <div class="form-check col-sm-4">
                                    <label class="form-check-label col-form-label">Configuração de Eventos </label>
                                    <div class="col-sm-2">
                                        <input class="form-check-input" type="checkbox"   name="chkconfig_eventos" id="chkconfig_eventos" <?php echo $c_chkconfig_eventos ?>>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-check col-sm-3">
                                    <label class="form-check-label col-form-label">Diagnósticos</label>
                                    <div class="col-sm-3">
                                        <input class="form-check-input" type="checkbox"   name="chkdiagnosticos" id="chkdiagnosticos" <?php echo $c_chkdiagnosticos ?>>
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
