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
        <form method="post">
            <div class="mb-3 row">

                <label for="add_descricaoField" class="col-md-3 form-label">Descrição (*)</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="add_descricaoField" name="add_descricaoField">
                </div>

            </div>
            <hr>
            <div class="mb-3 row">
                <label class="col-md-3 form-label">Grupo do Exame</label>
                <div class="col-sm-4">
                    <select class="form-control form-control-lg" id="add_grupoField" name="add_grupoField">
                        <?php
                        $c_sql = "select grupos_laudos.id, grupos_laudos.descricao from grupos_laudos ORDER BY grupos_laudos.descricao";
                        $result = $conection->query($c_sql);

                        // insiro os registro do banco de dados na tabela 
                        while ($c_linha = $result->fetch_assoc()) {
                            echo "<option>$c_linha[descricao]</option>";
                        }
                        ?>
                    </select>

                </div>

            </div>
            <div class="mb-3 row">
                <label for="add_materialField" class="col-md-3 form-label">Material</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="add_materialField" name="add_materialField">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="add_metodoField" class="col-md-3 form-label">Metodo</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="add_metodoField" name="add_metodoField">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="add_valref" class="col-md-3 form-label">Valor de Referência</label>
                <div class="col-sm-6">
                    <textarea class="form-control" id="add_valrefField" name="add_valrefField" rows="10"></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3">
                    <button type="submit" id='btn_grava' name='btn_grava' class="btn btn-primary"><span class='glyphicon glyphicon-floppy-saved'></span> Salvar</button>
                    <a class='btn btn-danger' href='/smedweb/formula_padrao_lista.php'><span class='glyphicon glyphicon-remove'></span> Cancelar</a>
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


</div>

</form>


</body>

</body>
</html>