<?php
// monto sql para pesquisar movimentação de contas de acordo com os filtros selecionados
include_once("../../conexao.php");
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // captura dos dados do formulário
    $data_inicial = $_POST['data_inicial'];
    $data_final = $_POST['data_final'];
    $filtro = $_POST['filtro'];

    // construção do sql de acordo com o filtro selecionado sendo que o id do convenio está ná tavbela de convennios vinculados ao paciente sendo necessario fazer join
    $sql_base = "SELECT mc.* FROM lancamento mc 
                 JOIN pacientes p ON mc.id_paciente = p.id 
                 WHERE mc.data BETWEEN '$data_inicial' AND '$data_final'";
    

    if ($filtro == 'convenio') {
        $convenio_id = $_POST['convenio_id'];
        $sql_base .= " AND convenio_id = '$convenio_id'";
    } elseif ($filtro == 'paciente') {
        $paciente_id = $_POST['paciente_id'];
        $sql_base .= " AND id_paciente = '$paciente_id'";
    }

    // executar a consulta e processar os resultados conforme necessário
    $result = $conection->query($sql_base);
    // ... (processamento dos resultados)
} else {
    die("Acesso inválido.");
}
//SELECT lancamento.id, lancamento.id_paciente, lancamento.id_procedimento, lancamento.`data`,
//lancamento.valor, lancamento.`status`, lancamento.descricao, pacientes.nome
//FROM lancamento 
//JOIN pacientes ON lancamento.id_paciente=pacientes.id
?>