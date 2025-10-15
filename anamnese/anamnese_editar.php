<?php
include_once("../links.php");
// Conexão
require_once('../conexao.php');
// pego id da anamenese
$c_id = $_GET["id"];
// php para carregar dos para variavies
include('anamnese_carrega_dados.php');
?>

<!--  html para nova anamnese  -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
    <script src="habilitar.js"></script>

   
    <!-- painel com título -->
    <div class="panel panel-primary class">
        <div class="panel-heading text-center">
            <h4>SmartMed - Sistema Médico</h4>
            <h5>Editar dados de Anamnese<h5>
        </div>
    </div>
    <?php
    if (!empty($msg_erro)) {
        echo "
            <div class='alert alert-warning' role='alert'>
                <h4>$msg_erro</h4>
            </div>
                ";
    }
    ?>
    <div class="container-fluid">

        <form method="post" action="anamnese_altera.php">
            <!-- botões salvar e cancelar -->
            <div class="row mb-3">
                <div class="offset-sm-0 col-sm-3">
                    <button type="submit" class="btn btn-primary"><span class='glyphicon glyphicon-floppy-saved'></span> Salvar</button>
                    <a class='btn btn-danger' href='/smedweb/anamnese/anamnese_lista.php'><span class='glyphicon glyphicon-remove'></span> Cancelar</a>
                </div>
            </div>
            <hr>
            <div class='alert alert-info' role='alert'>
                <h5>Campos com (*) são obrigatórios</h5>
            </div>
            <!-- abas para os diferentes tópicos da anamnese -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#home">Dados Ocupacionais</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu1">Queixa Principal e História da Doença Atual (HDA)</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu2">Antecedentes Pessoais</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu3">Antecedentes Familiares</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu4">Interrogatório Sintomatológico (Revisão por Sistemas)</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu5">Exame Físico (A ser preenchido pelo médico)</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu6">Conduta e Parecer Médico</a>
                </li>
            </ul>
            <!-- Conteúdo das abas -->

            <div class="tab-content">
                <div id="home" class="tab-pane active"><br>
                    <h4>Dados Ocupacionais</h4>
                    <hr>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="c_setor">Setor: *</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="c_setor" name="c_setor" value="<?php echo $c_setor; ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="c_cargo">Cargo: *</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="c_cargo" name="c_cargo" value="<?php echo $c_cargo; ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="c_admissao">Admissao: *</label>
                        <div class="col-sm-2">
                            <input type="date" class="form-control" id="c_admissao" name="c_admissao" value="<?php echo $c_admissao; ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="c_atividade">Atividade: *</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="c_atividade" name="c_atividade" value="<?php echo $c_atividade; ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="c_jornada">Jornada de Trabalho: *</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" id="c_jornada" name="c_jornada" value="<?php echo $c_jornada; ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="c_descricao_atividades">Descrição Atividades : *</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="c_descricao_atividades" name="c_descricao_atividades" value="<?php echo $c_descricao_atividade; ?>" required>
                        </div>
                    </div>
                    <!-- radio com sim ou não para uso de epi -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="c_uso_epi">Uso de EPI (Equipamento de Proteção Individual): *</label>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-check">
                                    <label for="c_uso_epi">
                                        <input type="radio" onClick="habilitacao()" name="c_uso_epi" id="c_uso_epi_sim" value="Sim" <?php echo $c_check_usa_epi_sim; ?>>
                                        <span>Sim</span>
                                    </label>
                                    <label for="c_uso_epi">
                                        <input type="radio" onClick="habilitacao()" name="c_uso_epi" id="c_uso_epi_nao" value="Não" <?php echo $c_check_usa_epi_nao; ?>>
                                        <span>Não</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Qual EPI utiliza -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="c_qual_epi">Qual?</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="c_qual_epi" name="c_qual_epi" value="<?php echo $c_qual_epi ?>" <?php echo $c_habilita_qual_epi; ?> placeholder="Qual EPI utiliza?">
                        </div>
                    </div>


                    <hr>
                    <h4>Riscos Ocupacionais</h4>
                    <div class="row mb-2">
                        <div class="form-check col-sm-7">
                            <label class="form-check-label col-form-label">Físico (Ruído, calor, frio, vibração, radiação)</label>
                            <div class="col-sm-1">
                                <input class="form-check-input" type="checkbox" name="c_risco_fisico" id="c_fisico" <?php echo $c_risco_fisico; ?>>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="form-check col-sm-7">
                            <label class="form-check-label col-form-label">Químico (Poeira, fumos, gases,vapores, produtos químicos)</label>
                            <div class="col-sm-1">
                                <input class="form-check-input" type="checkbox" name="c_risco_quimico" id="c_quimico" <?php echo $c_risco_quimico; ?>>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="form-check col-sm-7">
                            <label class="form-check-label col-form-label">Biológico (Vírus, bactérias, fungos, parasitas)</label>
                            <div class="col-sm-1">
                                <input class="form-check-input" type="checkbox" name="c_risco_biologico" id="c_biologico" <?php echo $c_risco_biologico; ?>>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="form-check col-sm-7">
                            <label class="form-check-label col-form-label">Ergonômico (Postura inadequada, esforço repetitivo, levantamento de peso)</label>
                            <div class="col-sm-1">
                                <input class="form-check-input" type="checkbox" name="c_risco_ergonomico" id="c_ergonomico" <?php echo $c_risco_ergonomico; ?>>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="form-check col-sm-7">
                            <label class="form-check-label col-form-label">Acidentes (Máquinas sem proteção, risco de quedas, eletricidade)</label>
                            <div class="col-sm-1">
                                <input class="form-check-input" type="checkbox" name="c_risco_acidente" id="c_risco_acidente" <?php echo $c_risco_acidentes; ?>>
                            </div>
                        </div>
                    </div>
                    <hr>

                </div>
                <div id="menu1" class="tab-pane fade"><br>
                    <h4>Queixa Principal e História da Doença Atual (HDA)</h4>
                    <hr>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="c_motivo_consulta">Motivo da Consulta: *</label>
                        <div class="col-sm-3">
                            <select class="form-control form-control-lg" id="c_motivo_consulta" name="c_motivo_consulta" required>
                                <option value="Admissional" <?= ($c_motivo_consulta == 'Admissional') ? 'selected' : '' ?>>Admissional</option>
                                <option value="Periódico" <?= ($c_motivo_consulta == 'Periódico') ? 'selected' : '' ?>>Periódico</option>
                                <option value="Demissional" <?= ($c_motivo_consulta == 'Demissional') ? 'selected' : '' ?>>Demissional</option>
                                <option value="Mudança de Função" <?= ($c_motivo_consulta == 'Mudança de Função') ? 'selected' : '' ?>>Mudança de Função</option>
                                <option value="Retorno ao Trabalho" <?= ($c_motivo_consulta == 'Retorno ao Trabalho') ? 'selected' : '' ?>>Retorno ao Trabalho</option>
                                <option value="Outros" <?= ($c_motivo_consulta == 'Outros') ? 'selected' : '' ?>>Outros</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="c_queixa_principal">Queixa Principal: *</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="c_queixa_principal" name="c_queixa_principal" value="<?php echo $c_queixa_principal; ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="c_hda">História da Doença Atual (HDA): *</label>
                        <div class="col-sm-7">
                            <textarea class="form-control" id="c_hda" name="c_hda" rows="15" required><?php echo $c_hda; ?></textarea>
                        </div>
                    </div>
                </div>
                <div id="menu2" class="tab-pane fade"><br>
                    <h4>Antecedentes Pessoais</h4>
                    <hr>
                    <div class="row mb-2">
                        <!-- radios com opções de  sim ou não dos antecedentes pessoais -->
                        <label class="col-sm-2 col-form-label" for="c_hipertensao">Hipertensão Arterial Sistêmica: *</label>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-check">
                                    <label for="c_hipertensao">
                                        <input type="radio" name="c_hipertensao" onClick="habilitacao()" id="c_hipertensao_sim" value="Sim" <?php echo $c_check_antecedente_hipertensao_sim; ?>>
                                        <span>Sim</span>
                                    </label>
                                    <label for="c_hipertensao">
                                        <input type="radio" name="c_hipertensao" onClick="habilitacao()" id="c_hipertensao_nao" value="Não" <?php echo $c_check_antecedente_hipertensao_nao; ?>>
                                        <span>Não</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- campo de observação para hipertensão -->
                        <div class="col-sm-6">
                            <input type="text" class="form-control" <?php echo $c_habilita_antecedente_hipertensao_obs; ?>
                                id="c_hipertensao_obs" name="c_hipertensao_obs" placeholder="Observações" value="<?php echo $c_hipertensao_obs; ?>">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label class="col-sm-2 col-form-label" for="c_diabetes">Diabetes Mellitus: *</label>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-check">
                                    <label for="c_diabetes">
                                        <input type="radio" name="c_diabetes" onClick="habilitacao()" id="c_diabetes_sim" <?php echo $c_check_antecedente_diabete_sim; ?> value="Sim">
                                        <span>Sim</span>
                                    </label>
                                    <label for="c_diabetes">
                                        <input type="radio" name="c_diabetes" onClick="habilitacao()" id="c_diabetes_nao" <?php echo $c_check_antecedente_diabete_nao; ?> value="Não">
                                        <span>Não</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- campo de observação para diabetes -->
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="c_diabetes_obs" name="c_diabetes_obs"
                                <?php echo $c_habilita_antecedente_diabete_obs; ?> placeholder="Observações" value="<?php echo $c_diabete_obs; ?>">
                        </div>
                    </div>
                    <!-- doenças cardiovasculares -->
                    <div class="row mb-2">
                        <label class="col-sm-2 col-form-label" for="c_doencas_cardiovasculares">Doenças Cardiovasculares: *</label>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-check">
                                    <label for="c_doencas_cardiovasculares">
                                        <input type="radio" name="c_doencas_cardiovasculares" onClick="habilitacao()"
                                            id="c_doencas_cardiovasculares_sim" <?php echo $c_check_antecedente_cardiaco_sim; ?> value="Sim">
                                        <span>Sim</span>
                                    </label>
                                    <label for="c_doencas_cardiovasculares">
                                        <input type="radio" name="c_doencas_cardiovasculares" onClick="habilitacao()"
                                            id="c_doencas_cardiovasculares_nao" <?php echo $c_check_antecedente_cardiaco_nao; ?> value="Não">
                                        <span>Não</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- campo de observação para doenças cardiovasculares -->
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="c_doencas_cardiovasculares_obs"
                                <?php echo $c_habilita_antecedente_cardiaco_obs; ?> name="c_doencas_cardiovasculares_obs"
                                value="<?php echo $c_cardiaco_obs; ?>" placeholder="Observações">
                        </div>
                    </div>
                    <!-- Doenças Respiratórias asma / bronquite -->
                    <div class="row mb-2">
                        <label class="col-sm-2 col-form-label" for="c_asma_bronquite">Asma/Bronquite: *</label>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-check">
                                    <label for="c_asma_bronquite">
                                        <input type="radio" name="c_asma_bronquite" onClick="habilitacao()"
                                            id="c_asma_bronquite_sim" <?php echo $c_check_antecedente_asma_bronquite_sim; ?> value="Sim">
                                        <span>Sim</span>
                                    </label>
                                    <label for="c_asma_bronquite">
                                        <input type="radio" name="c_asma_bronquite" onClick="habilitacao()"
                                            id="c_asma_bronquite_nao" <?php echo $c_check_antecedente_asma_bronquite_nao; ?> value="Não">
                                        <span>Não</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- campo de observação para asma/bronquite -->
                        <div class="col-sm-6">
                            <input type="text" class="form-control" disabled id="c_asma_bronquite_obs"
                                name="c_asma_bronquite_obs" placeholder="Observações"
                                <?php echo $c_habilita_antecedente_asma_bronquite_obs; ?> value="<?php echo $c_asma_bronquite_obs; ?>">
                        </div>
                    </div>
                    <!-- Doenças Renais -->
                    <div class="row mb-2">
                        <label class="col-sm-2 col-form-label" for="c_doencas_renais">Doenças Renais: *</label>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-check  ">
                                    <label for="c_doencas_renais">
                                        <input type="radio" name="c_doencas_renais" onClick="habilitacao()"
                                            id="c_doencas_renais_sim" value="Sim" <?php echo $c_check_antecedente_renais_sim; ?>>
                                        <span>Sim</span>
                                    </label>
                                    <label for="c_doencas_renais">
                                        <input type="radio" name="c_doencas_renais" onClick="habilitacao()"
                                            id="c_doencas_renais_nao" value="Não" <?php echo $c_check_antecedente_renais_nao; ?>>
                                        <span>Não</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- campo de observação para doenças renais -->
                        <div class="col-sm-6">
                            <input type="text" class="form-control"  id="c_doencas_renais_obs" name="c_doencas_renais_obs"
                                placeholder="Observações" <?php echo $c_habilita_antecedente_renais_obs; ?> value="<?php echo $c_renais_obs; ?>">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label class="col-sm-2 col-form-label" for="c_doencas_neurologicas">Doenças Neurológicas: *</label>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-check">
                                    <label for="c_doencas_neurologicas">
                                        <input type="radio" name="c_doencas_neurologicas" onClick="habilitacao()"
                                            id="c_doencas_neurologicas_sim" value="Sim" <?php echo $c_check_antecedente_neurologicos_sim; ?>>
                                        <span>Sim</span>
                                    </label>
                                    <label for="c_doencas_neurologicas">
                                        <input type="radio" name="c_doencas_neurologicas" onClick="habilitacao()"
                                            id="c_doencas_neurologicas_nao" value="Não" <?php echo $c_check_antecedente_neurologicos_nao; ?>>
                                        <span>Não</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- campo de observação para doenças neurológicas -->
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="c_doencas_neurologicas_obs" name="c_doencas_neurologicas_obs"
                                placeholder="Observações" <?php echo $c_habilita_antecedente_neurologicos_obs; ?> value="<?php echo $c_neurologicos_obs; ?>">
                        </div>

                    </div>
                    <!-- Disturbios Psiquiátricas -->
                    <div class="row mb-2">
                        <label class="col-sm-2 col-form-label" for="c_disturbios_psiquiatricos">Distúrbios Psiquiátricos: *</label>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-check">
                                    <label for="c_disturbios_psiquiatricos">
                                        <input type="radio" name="c_disturbios_psiquiatricos" onClick="habilitacao()"
                                            id="c_disturbios_psiquiatricos_sim" value="Sim" <?php echo $c_check_antecedente_psquiatrico_sim; ?>>
                                        <span>Sim</span>
                                    </label>
                                    <label for="c_disturbios_psiquiatricos">
                                        <input type="radio" name="c_disturbios_psiquiatricos" onClick="habilitacao()"
                                            id="c_disturbios_psiquiatricos_nao" value="Não" <?php echo $c_check_antecedente_psquiatrico_nao; ?>>
                                        <span>Não</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- campo de observação para disturbios psiquiátricas -->
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="c_disturbios_psiquiatricos_obs" name="c_disturbios_psiquiatricos_obs"
                                placeholder="Observações" <?php echo $c_habilita_antecedente_psiquiatrico_obs; ?> value="<?php echo $c_psquiatrico_obs; ?>">
                        </div>
                    </div>
                    <!-- Câncer -->
                    <div class="row mb-2">
                        <label class="col-sm-2 col-form-label" for="c_cancer">Câncer: *</label>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-check">
                                    <label for="c_cancer">
                                        <input type="radio" name="c_cancer" onClick="habilitacao()"
                                            id="c_cancer_sim" value="Sim" <?php echo $c_check_antecedente_cancer_sim; ?>>
                                        <span>Sim</span>
                                    </label>
                                    <label for="c_cancer">
                                        <input type="radio" name="c_cancer" onClick="habilitacao()"
                                            id="c_cancer_nao" value="Não" <?php echo $c_check_antecedente_cancer_nao; ?>>
                                        <span>Não</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- campo de observação para câncer -->
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="c_cancer_obs" name="c_cancer_obs"
                                placeholder="Observações" <?php echo $c_habilita_antecedente_cancer_obs; ?> value="<?php echo $c_cancer_obs; ?>">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <!--Alergias -->
                        <label class="col-sm-2 col-form-label" for="c_alergias">Alergias: *</label>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-check">
                                    <label for="c_alergias">
                                        <input type="radio" name="c_alergias" onClick="habilitacao()"
                                            id="c_alergias_sim" value="Sim" <?php echo $c_check_antecedente_alergia_sim; ?>>
                                        <span>Sim</span>
                                    </label>
                                    <label for="c_alergias">
                                        <input type="radio" name="c_alergias" onClick="habilitacao()"
                                            id="c_alergias_nao" value="Não" <?php echo $c_check_antecedente_alergia_nao; ?>>
                                        <span>Não</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- campo de observação para alergias -->
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="c_alergias_obs" name="c_alergias_obs"
                                placeholder="Observações" <?php echo $c_habilita_antecedente_alergia_obs; ?> value="<?php echo $c_alergia_obs; ?>">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <!-- Cirurgias prévia   -->
                        <label class="col-sm-2 col-form-label" for="c_cirurgias_previas">Cirurgias Prévias: *</label>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-check">
                                    <label for="c_cirurgias_previas">
                                        <input type="radio" name="c_cirurgias_previas" onClick="habilitacao()"
                                            id="c_cirurgias_previas_sim" value="Sim" <?php echo $c_check_antecedente_cirurgias_sim; ?>>
                                        <span>Sim</span>
                                    </label>
                                    <label for="c_cirurgias_previas">
                                        <input type="radio" name="c_cirurgias_previas" onClick="habilitacao()"
                                            id="c_cirurgias_previas_nao" value="Não" <?php echo $c_check_antecedente_cirurgias_nao; ?>>
                                        <span>Não</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- campo de observação para cirurgias prévias -->
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="c_cirurgias_previas_obs" name="c_cirurgias_previas_obs"
                                placeholder="Observações" <?php echo $c_habilita_antecedente_cirurgias_obs; ?> value="<?php echo $c_cirurgia_obs; ?>">
                        </div>
                    </div>
                    <!-- input para medicamentos em uso text area livre -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="c_medicamentos_uso">Medicamentos em Uso: *</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" id="c_medicamentos_uso" name="c_medicamentos_uso" rows="4" required><?php echo $c_medicamento_uso?></textarea>
                        </div>
                    </div>
                    <h4>Hábitos de Vida</h4>
                    <!-- radios com opções de  sim ou não dos hábitos de vida -->
                    <div class="row mb-2">
                        <label class="col-sm-2 col-form-label" for="c_tabagismo">Tabagismo: *</label>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-check">
                                    <label for="c_tabagismo">
                                        <input type="radio" name="c_tabagismo" onClick="habilitacao()"
                                            id="c_tabagismo_sim" value="Sim" <?php echo $c_check_tabagismo_sim; ?>>
                                        <span>Sim</span>
                                    </label>
                                    <label for="c_tabagismo">
                                        <input type="radio" name="c_tabagismo" onClick="habilitacao()"
                                            id="c_tabagismo_nao" value="Não" <?php echo $c_check_tabagismo_nao; ?>>
                                        <span>Não</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--quando sim, perguntar quantos cigarros por dia e há quanto tempo -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="c_cigarros_dia">Cigarros por dia:</label>
                        <div class="col-sm-1">
                            <input type="number" class="form-control" id="c_cigarros_dia" name="c_cigarros_dia" min="0"
                                <?php echo $c_Habilita_qtd_cigarros; ?> value="<?php echo $i_qtd_cigarros; ?>">
                        </div>
                        <label class="col-sm-2 col-form-label" for="c_tempo_tabagismo">Há quanto tempo (anos):</label>
                        <div class="col-sm-1">
                            <input type="number" class="form-control" id="c_tempo_tabagismo" name="c_tempo_tabagismo" min="0"
                                <?php echo $c_habilita_tempo_cigarro; ?> value="<?php echo $i_tempo_cigarros; ?>">
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="c_alcoolismo">Etilismo: *</label>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-check">
                                    <label for="c_alcoolismo">
                                        <input type="radio" name="c_alcoolismo" onClick="habilitacao()"
                                         id="c_alcoolismo_sim" value="Sim" <?php echo $c_check_etilismo_sim; ?>>
                                        <span>Sim</span>
                                    </label>
                                    <label for="c_alcoolismo">
                                        <input type="radio" name="c_alcoolismo" onClick="habilitacao()"
                                         id="c_alcoolismo_nao" value="Não" <?php echo $c_check_etilismo_nao; ?>>
                                        <span>Não</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="c_alcool_semana">Doses Semanais:</label>
                        <div class="col-sm-1">
                            <input type="number" class="form-control" id="c_alcool_semana" name="c_alcool_semana" min="0" 
                            <?php echo $c_habilita_elitismo_freq; ?> value="<?php echo $c_etilismo_freq; ?>" >
                        </div>
                    </div>
                    <!--quando sim, perguntar quantas doses por semana e há quanto tempo -->
                    <!-- quantidade de álcool por semana e tipo de bebida -->
                    <hr>
                    <div class="row mb-2">
                        <label class="col-sm-2 col-form-label" for="c_atividade_fisica">Atividade Física: *</label>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-check">
                                    <label for="c_atividade_fisica">
                                        <input type="radio" name="c_atividade_fisica" onClick="habilitacao()"
                                         id="c_atividade_fisica_sim" value="Sim" <?php echo $c_check_atividade_fisica_sim; ?> >
                                        <span>Sim</span>
                                    </label>
                                    <label for="c_atividade_fisica">
                                        <input type="radio" name="c_atividade_fisica" onClick="habilitacao()" 
                                        id="c_atividade_fisica_nao" value="Não" <?php echo $c_check_atividade_fisica_nao; ?> >
                                        <span>Não</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Qual a atividade e frequencia -->
                    <div class="row mb-2">
                        <label class="col-sm-2 col-form-label" for="c_qual_atividade">Quais ?</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="c_qual_atividade" name="c_qual_atividade"
                             <?php echo $c_Habilita_atividade_fisica_qual; ?> value="<?php echo $c_atividade_fisica_qual; ?>" >
                        </div>
                        <label class="col-sm-1 col-form-label" for="c_frequencia_atividade">Frequência</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" id="c_frequencia_atividade" name="c_frequencia_atividade"
                            <?php echo $c_habilita_atividade_fisica_freq; ?> value="<?php echo $c_atividade_fisica_freq; ?>">
                        </div>
                    </div>
                </div> <!-- fim do menu2 -->
                <div id="menu3" class="tab-pane fade"><br>
                    <h4>Antecedentes Familiares</h4>
                    <hr>
                    <!--input radio sim ou não para doenças familiares-->
                    <!-- Hipertensão -->
                    <div class="row mb-2">
                        <label class="col-sm-2 col-form-label" for="c_hipertensao_familiar">Hipertensão Arterial Sistêmica: *</label>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-check">
                                    <label for="c_hipertensao_familiar">
                                        <input type="radio" name="c_hipertensao_familiar" onClick="habilitacao()"
                                         id="c_hipertensao_familiar_sim" value="Sim" <?php echo $c_check_famimilar_hipertencao_sim; ?>>
                                        <span>Sim</span>
                                    </label>
                                    <label for="c_hipertensao_familiar">
                                        <input type="radio" name="c_hipertensao_familiar" onClick="habilitacao()"
                                         id="c_hipertensao_familiar_nao" value="Não" <?php echo $c_check_famimilar_hipertencao_nao; ?>>
                                        <span>Não</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- input com parentesco da pessoa com a doença -->
                        <div class="col-sm-6 mt-2">
                            <input type="text" class="form-control" id="c_hipertensao_familiar_parentesco" name="c_hipertensao_familiar_parentesco"
                             placeholder="Parentesco"  <?php echo $c_habilita_parentesco_hipertensao; ?> value="<?php echo $c_parentesco_hipertensao; ?>">
                        </div>
                    </div>
                    <!-- Diabetes mellitus  -->
                    <div class="row mb-2">
                        <label class="col-sm-2 col-form-label" for="c_diabetes_familiar">Diabetes Mellitus: *</label>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-check">
                                    <label for="c_diabetes_familiar">
                                        <input type="radio" name="c_diabetes_familiar" onClick="habilitacao()" 
                                        id="c_diabetes_familiar_sim" value="Sim" <?php echo $c_check_famimilar_diabetes_sim;?>>
                                        <span>Sim</span>
                                    </label>
                                    <label for="c_diabetes_familiar">
                                        <input type="radio" name="c_diabetes_familiar" onClick="habilitacao()"
                                         id="c_diabetes_familiar_nao" value="Não" <?php echo $c_check_famimilar_diabetes_nao;?>>
                                        <span>Não</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- input com parentesco da pessoa com a doença -->
                        <div class="col-sm-6 mt-2">
                            <input type="text" class="form-control"  id="c_diabetes_familiar_parentesco" name="c_diabetes_familiar_parentesco"
                             placeholder="Parentesco"  <?php echo $c_habilita_parentesco_diabetes; ?> value="<?php echo $c_parentesco_diabetes; ?>">
                        </div>
                    </div>
                    <!-- doenças cardiovasculares -->
                    <div class="row mb-2">
                        <label class="col-sm-2 col-form-label" for="c_doencas_cardiovasculares_familiar">Doenças Cardiovasculares: *</label>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-check">
                                    <label for="c_doencas_cardiovasculares_familiar">
                                        <input type="radio" onClick="habilitacao()" name="c_doencas_cardiovasculares_familiar" 
                                        id="c_doencas_cardiovasculares_familiar_sim" value="Sim" <?php echo $c_check_famimilar_cardiaco_sim;?>>
                                        <span>Sim</span>
                                    </label>
                                    <label for="c_doencas_cardiovasculares_familiar">
                                        <input type="radio" onClick="habilitacao()" name="c_doencas_cardiovasculares_familiar" 
                                        id="c_doencas_cardiovasculares_familiar_nao" value="Não" <?php echo $c_check_famimilar_cardiaco_nao;?>>
                                        <span>Não</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- input com parentesco da pessoa com a doença -->
                        <div class="col-sm-6 mt-2">
                            <input type="text" class="form-control" id="c_doencas_cardiovasculares_familiar_parentesco"
                             name="c_doencas_cardiovasculares_familiar_parentesco" placeholder="Parentesco" 
                             <?php echo $c_habilita_parentesco_cardiaco; ?> value="<?php echo $c_parentesco_cardiaco; ?>">
                        </div>
                    </div>
                    <!-- Câncer -->
                    <div class="row mb-2">
                        <label class="col-sm-2 col-form-label" for="c_cancer_familiar">Câncer: *</label>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-check">
                                    <label for="c_cancer_familiar">
                                        <input type="radio" onClick="habilitacao()" name="c_cancer_familiar"
                                         id="c_cancer_familiar_sim" value="Sim" <?php echo $c_check_famimilar_cancer_sim;?>>
                                        <span>Sim</span>
                                    </label>
                                    <label for="c_cancer_familiar">
                                        <input type="radio" onClick="habilitacao()" name="c_cancer_familiar" 
                                        id="c_cancer_familiar_nao" value="Não" <?php echo $c_check_famimilar_cancer_nao;?>>
                                        <span>Não</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- input com parentesco da pessoa com a doença -->
                        <div class="col-sm-6 mt-2">
                            <input type="text" class="form-control" id="c_cancer_familiar_parentesco" name="c_cancer_familiar_parentesco"
                            placeholder="Parentesco" <?php echo $c_habilita_parentesco_cancer; ?> value="<?php echo $c_parentesco_cancer; ?>">
                        </div>
                    </div>
                    <!--  input com radio sim ou não Outras doenças -->
                    <div class="row mb-2">
                        <label class="col-sm-2 col-form-label" for="c_outras_doencas_familiar">Outras Doenças: *</label>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-check">
                                    <label for="c_outras_doencas_familiar">
                                        <input type="radio" onClick="habilitacao()" name="c_outras_doencas_familiar"
                                         id="c_outras_doencas_familiar_sim" value="Sim" <?php echo $c_check_famimilar_outros_sim;?>>
                                        <span>Sim</span>
                                    </label>
                                    <label for="c_outras_doencas_familiar">
                                        <input type="radio" onClick="habilitacao()" name="c_outras_doencas_familiar"
                                         id="c_outras_doencas_familiar_nao" value="Não" <?php echo $c_check_famimilar_outros_nao;?>>
                                        <span>Não</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- input com parentesco da pessoa com a doença -->
                        <div class="col-sm-6 mt-2">
                            <input type="text" class="form-control" id="c_outras_doencas_familiar_parentesco" 
                            name="c_outras_doencas_familiar_parentesco" placeholder="Parentesco"
                            <?php echo $c_habilita_parentesco_outros; ?> value="<?php echo $c_parentesco_outros; ?>">
                        </div>
                    </div>

                </div> <!-- fim do menu3 -->
                <div id="menu4" class="tab-pane fade"><br>
                    <h4>Interrogatório Sintomatológico (Revisão por Sistemas)</h4>
                    <hr>
                    <!-- input radio sim ou não geral Febre, perda de peso, fadiga -->
                    <div class="row mb-2">
                        <label class="col-sm-3 col-form-label" for="c_geral">Geral (Febre, perda de peso, fadiga): *</label>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-check">
                                    <label for="c_geral">
                                        <input type="radio" name="c_geral" id="c_geral_sim" value="Sim" <?php echo $c_check_smtp_geral_sim;?>>
                                        <span>Sim</span>
                                    </label>
                                    <label for="c_geral">
                                        <input type="radio" name="c_geral" id="c_geral_nao" value="Não" <?php echo $c_check_smtp_geral_nao;?>>
                                        <span>Não</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <label class="col-sm-3 col-form-label" for="c_pele">Pele (Lesões, coceira, manchas): *</label>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-check">
                                    <label for="c_pele">
                                        <input type="radio" name="c_pele" id="c_pele_sim" value="Sim" <?php echo $c_check_smtp_pele_sim;?>>
                                        <span>Sim</span>
                                    </label>
                                    <label for="c_pele">
                                        <input type="radio" name="c_pele" id="c_pele_nao" value="Não" <?php echo $c_check_smtp_pele_nao;?>>
                                        <span>Não</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- input radio sim ou não cabeça/Pescoço (Dor de cabeça, tontura, dor no pescoço)  -->
                    <div class="row mb-2">
                        <label class="col-sm-3 col-form-label" for="c_cabeca_pescoco">Cabeça/Pescoço (Dor de cabeça, tontura, dor no pescoço): *</label>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-check">
                                    <label for="c_cabeca_pescoco">
                                        <input type="radio" name="c_cabeca_pescoco" id="c_cabeca_pescoco_sim" value="Sim" <?php echo $c_check_smtp_cabeca_pescoco_sim;?>>
                                        <span>Sim</span>
                                    </label>
                                    <label for="c_cabeca_pescoco">
                                        <input type="radio" name="c_cabeca_pescoco" id="c_cabeca_pescoco_nao" value="Não" <?php echo $c_check_smtp_cabeca_pescoco_nao;?>>
                                        <span>Não</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <label class="col-sm-3 col-form-label" for="c_olhos">Olhos (Alteração visual, dor, vermelhidão): *</label>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-check">
                                    <label for="c_olhos">
                                        <input type="radio" name="c_olhos" id="c_olhos_sim" value="Sim" <?php echo $c_check_smtp_olhos_sim;?>>
                                        <span>Sim</span>
                                    </label>
                                    <label for="c_olhos">
                                        <input type="radio" name="c_olhos" id="c_olhos_nao" value="Não" <?php echo $c_check_smtp_olhos_nao;?>>
                                        <span>Não</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- input radio sim ou não ouvidos (Dor, zumbido, perda auditiva) -->
                    <div class="row mb-2">
                        <label class="col-sm-3 col-form-label" for="c_ouvidos">Ouvidos (Dor, zumbido, perda auditiva): *</label>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-check">
                                    <label for="c_ouvidos">
                                        <input type="radio" name="c_ouvidos" id="c_ouvidos_sim" value="Sim" <?php echo $c_check_smtp_ouvidos_sim;?>>
                                        <span>Sim</span>
                                    </label>
                                    <label for="c_ouvidos">
                                        <input type="radio" name="c_ouvidos" id="c_ouvidos_nao" value="Não" <?php echo $c_check_smtp_ouvidos_nao; ?>>
                                        <span>Não</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <label class="col-sm-3 col-form-label" for="c_respiratorio">Respiratório (Tosse, falta de ar, dor no peito): *</label>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-check">
                                    <label for="c_respiratorio">
                                        <input type="radio" name="c_respiratorio" id="c_respiratorio_sim" value="Sim" <?php echo $c_check_smtp_respiratorio_sim;?>>
                                        <span>Sim</span>
                                    </label>
                                    <label for="c_respiratorio">
                                        <input type="radio" name="c_respiratorio" id="c_respiratorio_nao" value="Não" <?php echo $c_check_smtp_respiratorio_nao;?>>
                                        <span>Não</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- input radio sim ou não Cardiovascular (Palpitações, dor no peito, inchaço) -->
                    <div class="row mb-2">
                        <label class="col-sm-3 col-form-label" for="c_cardiovascular">Cardiovascular (Palpitações, dor no peito, inchaço): *</label>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-check">
                                    <label for="c_cardiovascular">
                                        <input type="radio" name="c_cardiovascular" id="c_cardiovascular_sim" value="Sim" <?php echo $c_check_smtp_cardiovascular_sim;?> >
                                        <span>Sim</span>
                                    </label>
                                    <label for="c_cardiovascular">
                                        <input type="radio" name="c_cardiovascular" id="c_cardiovascular_nao" value="Não" <?php echo $c_check_smtp_cardiovascular_nao;?>>
                                        <span>Não</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <label class="col-sm-3 col-form-label" for="c_gastrointestinal">Gastrointestinal (Dor abdominal, náusea, vômito): *</label>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-check">
                                    <label for="c_gastrointestinal">
                                        <input type="radio" name="c_gastrointestinal" id="c_gastrointestinal_sim" value="Sim" <?php echo $c_check_smtp_gastro_sim;?> >
                                        <span>Sim</span>
                                    </label>
                                    <label for="c_gastrointestinal">
                                        <input type="radio" name="c_gastrointestinal" id="c_gastrointestinal_nao" value="Não" <?php echo $c_check_smtp_gastro_nao;?>>
                                        <span>Não</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- input radio sim ou não Genitourinário (Dor ao urinar, sangue na urina, incontinência) -->
                    <div class="row mb-2">
                        <label class="col-sm-3 col-form-label" for="c_genitourinario">Genitourinário (Dor ao urinar, sangue na urina, incontinência): *</label>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-check">
                                    <label for="c_genitourinario">
                                        <input type="radio" name="c_genitourinario" id="c_genitourinario_sim" value="Sim" <?php echo $c_check_smtp_geniturario_sim ?> >
                                        <span>Sim</span>
                                    </label>
                                    <label for="c_genitourinario">
                                        <input type="radio" name="c_genitourinario" id="c_genitourinario_nao" value="Não" <?php echo $c_check_smtp_geniturario_nao ?> >
                                        <span>Não</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <label class="col-sm-3 col-form-label" for="c_musculoesqueletico">Musculoesquelético (Dor nas articulações, fraqueza muscular): *</label>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-check">
                                    <label for="c_musculoesqueletico">
                                        <input type="radio" name="c_musculoesqueletico" id="c_musculoesqueletico_sim" value="Sim" <?php echo $c_check_smtp_musculo_esqueletico_sim?>>
                                        <span>Sim</span>
                                    </label>
                                    <label for="c_musculoesqueletico">
                                        <input type="radio" name="c_musculoesqueletico" id="c_musculoesqueletico_nao" value="Não" <?php echo $c_check_smtp_musculo_esqueletico_nao?>>
                                        <span>Não</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- input radio sim ou não Neurológico (Tontura, fraqueza, convulsões) -->
                    <div class="row mb-2">
                        <label class="col-sm-3 col-form-label" for="c_neurologico">Neurológico (Tontura, fraqueza, convulsões): *</label>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-check">
                                    <label for="c_neurologico">
                                        <input type="radio" name="c_neurologico" id="c_neurologico_sim" value="Sim" <?php echo $c_check_smtp_musculo_neurologico_sim?>>
                                        <span>Sim</span>
                                    </label>
                                    <label for="c_neurologico">
                                        <input type="radio" name="c_neurologico" id="c_neurologico_nao" value="Não" <?php echo $c_check_smtp_musculo_neurologico_nao?>>
                                        <span>Não</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <label class="col-sm-3 col-form-label" for="c_psiquiatrico">Psiquiátrico (Ansiedade, depressão, insônia): *</label>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-check">
                                    <label for="c_psiquiatrico">
                                        <input type="radio" name="c_psiquiatrico" id="c_psiquiatrico_sim" value="Sim" <?php echo $c_check_smtp_musculo_psiquiatrico_sim?>>
                                        <span>Sim</span>
                                    </label>
                                    <label for="c_psiquiatrico">
                                        <input type="radio" name="c_psiquiatrico" id="c_psiquiatrico_nao" value="Não" <?php echo $c_check_smtp_musculo_psiquiatrico_nao?>>
                                        <span>Não</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- fim do menu4 -->

                <!-- menu5 -->
                <div id="menu5" class="tab-pane fade"><br>
                    <h4>Exame Físico</h4>
                    <hr>
                    <!-- input para sinais vitais -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="c_pressao_arterial">Pressão Arterial (mmHg):</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" id="c_pressao_arterial" name="c_pressao_arterial" 
                            placeholder="Ex: 120/80" value="<?php echo $c_pa; ?>">
                        </div>
                        <label class="col-sm-2 col-form-label" for="c_frequencia_cardiaca">Frequência Cardíaca (bpm):</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" id="c_frequencia_cardiaca" name="c_frequencia_cardiaca" min="0" placeholder="Ex: 70"
                            value = "<?php echo $c_fc; ?>">
                        </div>
                        <label class="col-sm-2 col-form-label" for="c_frequencia_respiratoria">Frequência Respiratória (rpm):</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" id="c_frequencia_respiratoria" name="c_frequencia_respiratoria" min="0" placeholder="Ex: 16"
                            value = "<?php echo $c_fr; ?>">
                        </div>
                    </div>
                    <!-- input de peso altura e IMC -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="c_peso">Peso (kg):</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" id="c_peso" name="c_peso" step="0.1" min="0" placeholder="Ex: 70.5"
                            value = "<?php echo $n_peso ?>">
                        </div>
                        <label class="col-sm-2 col-form-label" for="c_altura">Altura (m):</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" id="c_altura" name="c_altura" step="0.01" min="0" placeholder="Ex: 1.75"
                            value = "<?php echo $n_altura; ?>">
                        </div>
                        <label class="col-sm-2 col-form-label" for="c_imc">IMC:</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" id="c_imc" name="c_imc" step="0.1" min="0" placeholder="Ex: 22.9"
                            value = "<?php echo $n_imc; ?>">
                        </div>
                    </div>
                    <hr>
                    <!-- input tipo text para ectoscopia -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="c_ectoscopia">Ectoscopia:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="c_ectoscopia" name="c_ectoscopia" placeholder="Descrição da ectoscopia"
                            value = "<?php echo $c_ectoscopia ?>">
                        </div>
                    </div>
                    <!-- input tipo text para aparelho respirtório -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="c_aparelho_respiratorio">Aparelho Respiratório:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="c_aparelho_respiratorio" name="c_aparelho_respiratorio" 
                            placeholder="Descrição do aparelho respiratório" value = "<?php echo $c_exame_aparelho_respiratorio ?>">
                        </div>
                    </div>
                    <!-- input tipo text para aparelho cardiovascular -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="c_aparelho_cardiovascular">Aparelho Cardiovascular:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="c_aparelho_cardiovascular" name="c_aparelho_cardiovascular" 
                            placeholder="Descrição do aparelho cardiovascular" value = "<?php echo $c_exame_aparelho_cardio ?>">
                        </div>
                    </div>
                    <!-- input tipo text para aparelho abdome -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="c_aparelho_abdome">Aparelho Abdome:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="c_aparelho_abdome" name="c_aparelho_abdome" 
                            placeholder="Descrição do aparelho abdome" value = "<?php echo $c_exame_abdome ?>">
                        </div>
                    </div>
                    <!-- input tipo text para membros   -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="c_membros">Membros:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="c_membros" name="c_membros" 
                            placeholder="Descrição dos membros" value = "<?php echo $c_exame_membros ?>">
                        </div>
                    </div>
                    <!-- input tipo text para coluna vertebral   -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="c_coluna_vertebral">Coluna Vertebral:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="c_coluna_vertebral" name="c_coluna_vertebral" 
                            placeholder="Descrição da coluna vertebral" value = "<?php echo $c_exame_coluna ?>">
                        </div>
                    </div>
                    <!-- input tipo text para Exme Neurologico   -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="c_exame_neurologico">Exame Neurológico:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="c_exame_neurologico" name="c_exame_neurologico" 
                            placeholder="Descrição do exame neurológico" value = "<?php echo $c_exame_neurologico ?>">
                        </div>
                    </div>
                </div> <!-- fim do menu5 -->
                <!-- menu6 Conduta e Parecer Médico -->
                <div id="menu6" class="tab-pane fade"><br>
                    <h4>Conduta e Parecer Médico</h4>
                    <hr>
                    <!-- input pra Hipótese Diagnóstica -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="c_hipotese_diagnostica">Hipótese Diagnóstica:</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="c_hipotese_diagnostica" name="c_hipotese_diagnostica" 
                            placeholder="Descrição da hipótese diagnóstica" rows="4" required><?php echo $c_hipotese_diagnostica; ?></textarea>
                        </div>
                    </div>
                    <!-- input para Exames Complementares Solicitados -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="c_exames_complementares">Exames Complementares Solicitados:</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="c_exames_complementares" name="c_exames_complementares" 
                            placeholder="Descrição dos exames complementares solicitados" rows="4" required><?php echo $c_exames_complementares; ?></textarea>
                        </div>
                    </div>
                    <!-- input tipo text para conduta -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="c_conduta">Conduta:</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="c_conduta" name="c_conduta" 
                            placeholder="Descrição da conduta" rows="4" required><?php echo $c_conduta; ?></textarea>
                        </div>
                    </div>
                    <hr>
                    <!-- input tipo radio para parecer médico contendo ( ) Apto para a função ( ) Apto para a função com restrições. Inapto para função -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="c_parecer_medico">Parecer Médico: *</label>
                        <div class="col-sm-9">
                            <div class="form-group">
                                <div class="form-check">
                                    <div class="row mb-2">
                                        <label for="c_parecer_medico">
                                            <input type="radio" name="c_parecer_medico" onClick="habilitacao()" id="c_parecer_medico_apto"
                                             value="A" <?php echo $c_chk_apto ?>>
                                            <span>Apto para a função</span>
                                        </label>
                                    </div>
                                      <div class="row mb-2">
                                        <label for="c_parecer_medico">
                                            <input type="radio" onClick="habilitacao()" name="c_parecer_medico" id="c_parecer_medico_inapto"
                                             value="I" <?php echo $c_chk_inapto ?>>
                                            <span>Inapto para a função</span>
                                        </label>
                                    </div>
                                    <div class="row mb-2">
                                        <label for="c_parecer_medico">
                                            <input type="radio" name="c_parecer_medico" onClick="habilitacao()" 
                                            id="c_parecer_medico_apto_restricoes" value="R" <?php echo $c_chk_apto_restricoes ?>>
                                            <span>Apto para a função com restrições</span>
                                        </label>
                                        <!-- input para descrever as restrições -->
                                        <input type="text" class="form-control mt-2"  id="c_restricoes" name="c_restricoes"
                                         placeholder="Descreva as restrições" <?php echo $c_habilita_restricao ?> value = "<?php echo $c_restricoes ?>">
                                    </div>
                                  
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- fim do tab content -->
            </div> <!-- fim do painel body -->
        </form>

    </div> <!-- fim do container principal -->
</body>

</html>