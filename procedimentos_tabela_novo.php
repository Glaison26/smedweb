<?php
session_start();

if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

// conexão dom o banco de dados
include("conexao.php");

// verifico se tabela já foi incluida anteriormente ao procedimento
$c_id=$_POST['c_id'];
$c_sqltabela = "SELECT tabela.descricao, procedimentos_tabelas.id
 FROM procedimentos_tabelas
 JOIN tabela ON procedimentos_tabelas.id_tabela=tabela.id WHERE procedimentos_tabelas.id_procedimento='$c_id'";
$result_tabela = $conection->query($c_sqltabela);
 // verifico se a query foi correto
  
// rotina de inclusão
//$c_tabela = rtrim($_POST['c_tabela']);
//$c_custo = $_POST['c_custo'];

//$c_sql = "Insert into procedimentos_tabelas (, valor) Value ('$c_indice', '$c_valor')";
//$result = $conection->query($c_sql);
if ($result_tabela == false){
    echo "<script>
           alert('Tabela já selecionada')</script>";
}
if ($result == true && $result_tabela == false) {

    $data = array(
        'status' => 'true',

    );
    echo json_encode($data);
} else {
    $data = array(
        'status' => 'false',

    );

    echo json_encode($data);
}
