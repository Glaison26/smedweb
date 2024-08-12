<?php
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}
include("conexao.php");  // conexão
include("links.php");
include("config_tabelas.php");
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
                                    <input type="text" class="form-control" id="add_descricaoField" name="add_descricaoField">
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