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
    <div class='alert alert-info' role='alert'>
        <h5>Campos com (*) são obrigatórios</h5>
    </div>
    <!-- criação de tablist para dados ocupacionais, Queixa Principal e História da Doença Atual (HDA), Antecedentes Pessoais,
     Antecedentes Familiares, Interrogatório Sintomatológico (Revisão por
    Sistemas), Exame Físico (A ser preenchido pelo médico), Conduta e Parecer Médico -->
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
            <div id="home" class="container tab-pane active"><br>
                <div class="form-group">
                    
                    <label for="c_setor">Setor: *</label>
                    <input type="text" class="form-control" id="c_setor" name="c_setor" required>
                </div>
                <div class="form-group">
                    <label for="c_cargo">Cargo: *</label>
                    <input type="text" class="form-control" id="c_cargo" name="c_cargo" required>
                </div>
                <div class="form-group">
                    <label for="c_admissao">Admissao: *</label>
                    <input type="date" class="form-control" id="c_admissao" name="c_admissao" required>
                </div>
                <div class="form-group">
                    <label for="c_atividade">Atividade: *</label>
                    <input type="text" class="form-control" id="c_atividade" name="c_atividade" required>
                </div>
                <div class="form-group">
                    <label for="c_jornada">Jornada de Trabalho: *</label>
                    <input type="text" class="form-control" id="c_jornada" name="c_jornada" required>
                </div>
                <div class="form-group">
                    <label for="c_descricao_atividades">Descrição Atividades : *</label>
                    <input type="text" class="form-control" id="c_descricao_atividades" name="c_descricao_atividades" required>
                </div>
            </div>
        </div>
    </form>

</body>
</html>