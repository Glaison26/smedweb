<?php
// processa_alterar_senha.php
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}
include("conexao.php"); // conexão de banco de dados
include("links.php");
// pego o usuário logado
$c_usuario = $_SESSION['c_usuario'];
// pego o id do usuário logado
$c_sql = "SELECT id, senha FROM usuario WHERE login = '$c_usuario'";
$result = $conection->query($c_sql);
if ($result->num_rows == 0) {
    die('Usuário não encontrado!!!');
}
$c_row = $result->fetch_assoc();
$c_id_usuario = $c_row['id'];
$c_senha_atual_bd = base64_decode($c_row['senha']); // descriptografa senha atual do banco
// rotina para alterar senha
$senha_atual = $_POST['senha_atual'];
$nova_senha = $_POST['nova_senha'];
$confirma_senha = $_POST['confirma_senha'];
// verifico se a senha atual está correta
if ($senha_atual != $c_senha_atual_bd) {
   
    die('Senha atual incorreta. <a href="alterarsenha.php">Tente novamente</a>.');
}
if ($nova_senha != $confirma_senha) {
    die('A nova senha e a confirmação não coincidem. <a href="alterarsenha.php">Tente novamente</a>.');
}
// verifico se a nova senha tem no minimo 8 caracteres
if (strlen($nova_senha) < 8) {
    die('A nova senha deve ter no mínimo 8 caracteres. <a href="alterarsenha.php">Tente novamente</a>.');
}
// verifico se a nova senha tem pelo menos 1 caracter especial
if (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $nova_senha)) {
    die('A nova senha deve conter pelo menos um caractere especial. <a href="alterarsenha.php">Tente novamente</a>.');
}
// atualizo a senha no banco
$c_senha_criptografada = base64_encode($nova_senha); // criptografa a nova senha
$c_sql_update = "UPDATE usuario SET senha = '$c_senha_criptografada' WHERE id = $c_id_usuario";
if ($conection->query($c_sql_update) === TRUE) {
    echo 'Senha alterada com sucesso. <a href="menu.php">Voltar ao menu</a>.';
} else {
    echo 'Erro ao alterar a senha: ' . $conection->error . '. <a href="alterarsenha.php">Tente novamente</a>.';
}



?>