<?php
// rotina de processamento do lançamento financeiro //
include_once("../../conexao.php");
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // captura dos dados do formulário
    $paciente_id = $_POST['paciente_id'];
    $procedimento_id = $_POST['procedimento_id'];
    $valor = $_POST['valor'];
    $data_lancamento = $_POST['data_lancamento'];
    $descricao = $_POST['descricao'];

    // validação dos campos obrigatórios
    if (empty($paciente_id) || empty($procedimento_id) || empty($valor) || empty($data_lancamento)) {
        die("Erro: Todos os campos obrigatórios devem ser preenchidos.");
    }

    // inserção do lançamento no banco de dados
    $sql_insert = "INSERT INTO lancamento (id_paciente, id_procedimento, valor, data, descricao, status) 
                   VALUES ('$paciente_id', '$procedimento_id', '$valor', '$data_lancamento', '$descricao', 'Pendente')";
    if ($conection->query($sql_insert) === TRUE) {
        header("Location: lancamentos.php?msg=sucesso");
        exit;
    } else {
        die("Erro ao processar lançamento: " . $conection->error);
    }
} else {
    die("Acesso inválido.");
}
// fim da rotina de processamento do lançamento financeiro //
?>

                
