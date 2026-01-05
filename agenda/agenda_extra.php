<?php
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}
// conexão dom o banco de dados
include("../conexao.php");
// rotina de inclusão
$c_horario = $_POST['c_horario'];

$c_profissional = $_POST['c_profissional'];
$c_data = $_POST['c_data'];
$c_sql = "insert into agenda (id_profissional, data, horario, id_convenio, status) 
value ('$c_profissional', '$c_data', '$c_horario', 3, 'SIM')";
$c_data =$c_sql;
$result = $conection->query($c_sql);

if($result ==true)
{
  
    $data = array(
        'status'=>'true',
       
    );
    // sql para pegar o nome do profissional
    $c_sql_profissional = "SELECT nome FROM profissionais WHERE id = $c_profissional";
    $result_profissional = $conection->query($c_sql_profissional);
    $c_nome_profissional = '';
    if ($result_profissional && $row_profissional = $result_profissional->fetch_assoc()) {
        $c_nome_profissional = $row_profissional['nome'];
    }
    // gero o log da criação de horário extra na agenda
    $d_data_acao = date('Y-m-d');
    // formato da data para o log
    $d_hora_acao = date('H:i:s');
    $usuario = $_SESSION['c_userId'];
    $c_data_formatada = date("d/m/Y", strtotime($d_data_acao));
    $c_informacao = "Médico id: ". $c_nome_profissional. '<br>'. "Data: ". date("d/m/Y", strtotime($c_data)). '<br>'. "Horário: ". $c_horario;
    $c_sql_log = "INSERT INTO log_criacao_agenda (data,hora,id_usuario,descricao,registro)
    VALUES ('$d_data_acao','$d_hora_acao','$usuario','Criação de horário extra na agenda','$c_informacao')";
    $result_log = $conection->query($c_sql_log);
    // retorno para o ajax
    echo json_encode($data);
}
else
{
     $data = array(
        'status'=>'false',
  
    );

    echo json_encode($data);
} 

?>