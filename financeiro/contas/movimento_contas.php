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
    $sql_base = "SELECT lancamento.id as id_lancamento, lancamento.id_paciente, lancamento.id_procedimento, lancamento.`data`,
                lancamento.valor, lancamento.`status`, lancamento.descricao, pacientes.nome, convenios.nome as convenio, 
                procedimentos.descricao AS procedimento_descricao
                FROM lancamento
                JOIN pacientes ON lancamento.id_paciente=pacientes.id
                JOIN convenios ON pacientes.id_convenio=convenios.id
                JOIN procedimentos ON lancamento.id_procedimento=procedimentos.id
                where lancamento.data BETWEEN '$data_inicial' AND '$data_final'";
    if ($filtro == 'convenio') {
        $convenio_id = $_POST['convenio_id'];
        // pego o nome do convenio selecionado
        $c_convenio_sql = "SELECT nome FROM convenios where id='$convenio_id'";
        $result_convenio = $conection->query($c_convenio_sql);
        $registro_convenio = $result_convenio->fetch_assoc();
        $c_nome_convenio = $registro_convenio['nome'];
        $_SESSION['nome_convenio'] = $c_nome_convenio;
        $sql_base .= " AND convenios.id = '$convenio_id'";
    } elseif ($filtro == 'paciente') {
        $paciente_id = $_POST['paciente_id'];
        // pego o nome do paciente selecionado
        $c_paciente_sql = "SELECT nome FROM pacientes where id='$paciente_id'";
        $result_paciente = $conection->query($c_paciente_sql);
        $registro_paciente = $result_paciente->fetch_assoc();
        $c_nome_paciente = $registro_paciente['nome'];
        $_SESSION['nome_paciente'] = $c_nome_paciente;
        $sql_base .= " AND id_paciente = '$paciente_id'";
    }

    // executar a consulta e processar os resultados conforme necessário
    $result = $conection->query($sql_base);
    // ... (processamento dos resultados)
    // chama pagina de exibição do resultado da pesquisa
    $_SESSION['sql_movimento_contas'] = $sql_base;
    $_SESSION['data_inicial'] = date("d/m/Y", strtotime(str_replace('-', '/', $data_inicial)));
    $_SESSION['data_final'] = date("d/m/Y", strtotime(str_replace('-', '/', $data_final)));
    $_SESSION['filtro_movimento'] = $filtro;
    header("Location: movimento_contas_resultado.php");
    exit;
} else {
    die("Acesso inválido.");
}
// fim da rotina de montagem do sql de pesquisa de movimentação de contas //
