<?php
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}
include("conexao.php");  // conexão
include("links.php");
include("config_tabelas.php");
?>

<!-- HTML frontend da pagina -->
<!DOCTYPE html>
<html lang="en">

<body>
    <div class="panel panel-primary class">
        <div class="panel-heading text-center">
            <h4>SmartMed - Sistema Médico</h4>
            <h5>Lista de Perfis de usuários do Sistema<h5>
        </div>
    </div>
    <br>
    <div class="container -my5">
        <!-- botão de incluir -->
        <a class="btn btn-success btn-sm" href="/smedweb/perfil_novo.php"><span class="glyphicon glyphicon-plus"></span> Incluir</a>
        <!-- botão de voltar -->
        <a class="btn btn-secondary btn-sm" href="/smedweb/menu.php"><span class="glyphicon glyphicon-arrow-left"></span> Voltar</a>
        <hr>
        <table class="table display table-bordered tabperfis">
            <thead class="thead">
                <tr class="info">
                    <th scope="col">No.</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // faço a Leitura da tabela com sql
                $c_sql = "SELECT perfil_usuarios_opcoes.id, perfil_usuarios_opcoes.descricao FROM perfil_usuarios_opcoes ORDER BY perfil_usuarios_opcoes.descricao";
                $result = $conection->query($c_sql);
                // verifico se a query foi correto
                if (!$result) {
                    die("Erro ao Executar Sql!!" . $conection->connect_error);
                }

                // insiro os registro do banco de dados na tabela 
                while ($c_linha = $result->fetch_assoc()) {

                    echo "
                    <tr>
                    <td>$c_linha[id]</td>
                    <td>$c_linha[descricao]</td>
               
                    <td>
                 
                    <a class='btn btn-info btn-sm' title='Editar Convenios' href='/smedweb/perfil_editar.php?id=$c_linha[id]'><span class='glyphicon glyphicon-pencil'></span></a>
                    <a class='btn btn-danger btn-sm' title='Excluir Perfil' href='javascript:func()'onclick='confirmacao($c_linha[id])'><span class='glyphicon glyphicon-trash'></span></a>
                    </td>

                    </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>