<?php
include_once("../links.php");
// Conexão
require_once('../conexao.php');

?>

<!--  html para nova anamnese  -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
    <div class="panel panel-primary class">
        <div class="panel-heading text-center">
            <h4>SmartMed - Sistema Médico</h4>
            <h5>Nova Anamnese<h5>
        </div>
    </div>
    <div class="container  px-0 mt-4">
        <div class='alert alert-info' role='alert'>
            <h5>Campos com (*) são obrigatórios</h5>
        </div>

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
        <form method="post" action="anamnese_grava.php">
            <div class="tab-content">
                <div id="home" class="tab-pane active"><br>
                    <h4>Dados Ocupacionais</h4>
                    <hr>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="c_setor">Setor: *</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="c_setor" name="c_setor" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="c_cargo">Cargo: *</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="c_cargo" name="c_cargo" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="c_admissao">Admissao: *</label>
                        <div class="col-sm-2">
                            <input type="date" class="form-control" id="c_admissao" name="c_admissao" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="c_atividade">Atividade: *</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="c_atividade" name="c_atividade" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="c_jornada">Jornada de Trabalho: *</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="c_jornada" name="c_jornada" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="c_descricao_atividades">Descrição Atividades : *</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="c_descricao_atividades" name="c_descricao_atividades" required>
                        </div>
                    </div>

                    <h4>Riscos Ocupacionais</h4>
                    <div class="row mb-3">
                        <div class="form-check col-sm-7">
                            <label class="form-check-label col-form-label">Físico (Ruído, calor, frio, vibração, radiação)</label>
                            <div class="col-sm-1">
                                <input class="form-check-input" type="checkbox" name="chk_fisico" id="chk_fisico" value="Sim">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="form-check col-sm-7">
                            <label class="form-check-label col-form-label">Químico (Poeira, fumos, gases,vapores, produtos químicos)</label>
                            <div class="col-sm-1">
                                <input class="form-check-input" type="checkbox" name="chk_fisico" id="chk_fisico" value="Sim">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="form-check col-sm-7">
                            <label class="form-check-label col-form-label">Biológico (Vírus, bactérias, fungos, parasitas)</label>
                            <div class="col-sm-1">
                                <input class="form-check-input" type="checkbox" name="chk_fisico" id="chk_fisico" value="Sim">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="form-check col-sm-7">
                            <label class="form-check-label col-form-label">Ergonômico (Postura inadequada, esforço repetitivo, levantamento de peso)</label>
                            <div class="col-sm-1">
                                <input class="form-check-input" type="checkbox" name="chk_fisico" id="chk_fisico" value="Sim">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="form-check col-sm-7">
                            <label class="form-check-label col-form-label">Acidentes (Máquinas sem proteção, risco de quedas, eletricidade)</label>
                            <div class="col-sm-1">
                                <input class="form-check-input" type="checkbox" name="chk_fisico" id="chk_fisico" value="Sim">
                            </div>
                        </div>
                    </div>
                </div>
                <div id="menu1" class="tab-pane fade"><br>
                    <h4>Queixa Principal e História da Doença Atual (HDA)</h4>
                    <hr>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="c_motivo_consulta">Motivo da Consulta: *</label>
                        <div class="col-sm-3">
                            <select class="form-control form-control-lg" id="c_motivo_consulta" name="c_motivo_consulta" required>
                                <option value="">Selecione</option>
                                <option value="1">Admissional</option>
                                <option value="2">Periódico</option>
                                <option value="3">Demissional</option>
                                <option value="4">Mudança de Função</option>
                                <option value="5">Retorno ao Trabalho</option>
                                <option value="6">Outros</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="c_queixa_principal">Queixa Principal: *</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="c_queixa_principal" name="c_queixa_principal" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="c_hda">História da Doença Atual (HDA): *</label>
                        <div class="col-sm-7">
                            <textarea class="form-control" id="c_hda" name="c_hda" rows="8" required></textarea>
                        </div>
                    </div>
                </div>
                <div id="menu2" class="tab-pane fade"><br>
                    <h4>Antecedentes Pessoais</h4>
                    <hr>
                    <div class="row mb-2">
                        <!-- radios com opções de  sim ou não dos antecedentes pessoais -->
                        <label class="col-sm-4 col-form-label" for="c_hipertensao">Hipertensão Arterial Sistêmica: *</label>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-check">
                                    <label for="c_hipertencao">
                                        <input type="radio" name="c_hipertencao" id="c_hipertencao_sim" value="Sim">
                                        <span>Sim</span>
                                    </label>
                                    <label for="c_hipertencao">
                                        <input type="radio" name="c_hipertencao" id="c_hipertencao_nao" value="Não">
                                        <span>Não</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <label class="col-sm-4 col-form-label" for="c_diabetes">Diabetes Mellitus: *</label>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-check">
                                    <label for="c_diabetes">
                                        <input type="radio" name="c_diabetes" id="c_diabetes_sim" value="Sim">
                                        <span>Sim</span>
                                    </label>
                                    <label for="c_diabetes">
                                        <input type="radio" name="c_diabetes" id="c_diabetes_nao" value="Não">
                                        <span>Não</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- doenças cardiovasculares -->
                    <div class="row mb-2">
                        <label class="col-sm-4 col-form-label" for="c_doencas_cardiovasculares">Doenças Cardiovasculares: *</label>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-check">
                                    <label for="c_doencas_cardiovasculares">
                                        <input type="radio" name="c_doencas_cardiovasculares" id="c_doencas_cardiovasculares_sim" value="Sim">
                                        <span>Sim</span>
                                    </label>
                                    <label for="c_doencas_cardiovasculares">
                                        <input type="radio" name="c_doencas_cardiovasculares" id="c_doencas_cardiovasculares_nao" value="Não">
                                        <span>Não</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <label class="col-sm-4 col-form-label" for="c_asma_bronquite">Asma/Bronquite: *</label>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-check">
                                    <label for="c_asma_bronquite">
                                        <input type="radio" name="c_asma_bronquite" id="c_asma_bronquite_sim" value="Sim">
                                        <span>Sim</span>
                                    </label>
                                    <label for="c_asma_bronquite">
                                        <input type="radio" name="c_asma_bronquite" id="c_asma_bronquite_nao" value="Não">
                                        <span>Não</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Doenças Renais -->
                    <div class="row mb-2">
                        <label class="col-sm-4 col-form-label" for="c_doencas_renais">Doenças Renais: *</label>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-check  ">
                                    <label for="c_doencas_renais">
                                        <input type="radio" name="c_doencas_renais" id="c_doencas_renais_sim" value="Sim">
                                        <span>Sim</span>
                                    </label>
                                    <label for="c_doencas_renais">
                                        <input type="radio" name="c_doencas_renais" id="c_doencas_renais_nao" value="Não">
                                        <span>Não</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <label class="col-sm-4 col-form-label" for="c_doencas_neurologicas">Doenças Neurológicas: *</label>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-check">
                                    <label for="c_doencas_neurologicas">
                                        <input type="radio" name="c_doencas_neurologicas" id="c_doencas_neurologicas_sim" value="Sim">
                                        <span>Sim</span>
                                    </label>
                                    <label for="c_doencas_neurologicas">
                                        <input type="radio" name="c_doencas_neurologicas" id="c_doencas_neurologicas_nao" value="Não">
                                        <span>Não</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Disturbios Psiquiátricas -->
                    <div class="row mb-2">
                        <label class="col-sm-4 col-form-label" for="c_disturbios_psiquiatricos">Distúrbios Psiquiátricos: *</label>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-check">
                                    <label for="c_disturbios_psiquiatricos">
                                        <input type="radio" name="c_disturbios_psiquiatricos" id="c_disturbios_psiquiatricos_sim" value="Sim">
                                        <span>Sim</span>
                                    </label>
                                    <label for="c_disturbios_psiquiatricos">
                                        <input type="radio" name="c_disturbios_psiquiatricos" id="c_disturbios_psiquiatricos_nao" value="Não">
                                        <span>Não</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <label class="col-sm-4 col-form-label" for="c_cancer">Câncer: *</label>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-check">
                                    <label for="c_cancer">
                                        <input type="radio" name="c_cancer" id="c_cancer_sim" value="Sim">
                                        <span>Sim</span>
                                    </label>
                                    <label for="c_cancer">
                                        <input type="radio" name="c_cancer" id="c_cancer_nao" value="Não">
                                        <span>Não</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mb-2">
                        <!--Alergias -->
                        <label class="col-sm-4 col-form-label" for="c_alergias">Alergias: *</label>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-check">
                                    <label for="c_alergias">
                                        <input type="radio" name="c_alergias" id="c_alergias_sim" value="Sim">
                                        <span>Sim</span>
                                    </label>
                                    <label for="c_alergias">
                                        <input type="radio" name="c_alergias" id="c_alergias_nao" value="Não">
                                        <span>Não</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- Cirurgias prévia   -->
                        <label class="col-sm-4 col-form-label" for="c_cirurgias_previas">Cirurgias Prévias: *</label>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="form-check">
                                    <label for="c_cirurgias_previas">
                                        <input type="radio" name="c_cirurgias_previas" id="c_cirurgias_previas_sim" value="Sim">
                                        <span>Sim</span>
                                    </label>
                                    <label for="c_cirurgias_previas">
                                        <input type="radio" name="c_cirurgias_previas" id="c_cirurgias_previas_nao" value="Não">
                                        <span>Não</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>
        <hr>
        <div class="row mb-3">
            <div class="offset-sm-0 col-sm-3">
                <button type="submit" class="btn btn-primary"><span class='glyphicon glyphicon-floppy-saved'></span> Salvar</button>
                <a class='btn btn-danger' href='/smedweb/anamnese/anamnese_lista.php'><span class='glyphicon glyphicon-remove'></span> Cancelar</a>

            </div>
        </div>
    </div>
</body>

</html>