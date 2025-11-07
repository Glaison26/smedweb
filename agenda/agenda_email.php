<?php
// rotina de envio de e-mail de lembrete de compromissos da agenda
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

// função para arrumar data
function arruma_data($data) // função para arrumar data
{
    $data_final = substr($data, 8, 2) . '/' . substr($data, 5, 2) . '/' . substr($data, 0, 4);
    return $data_final;
}


include("../conexao.php"); // conexão de banco de dados


//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

if (!isset($_GET["id"])) {
    header('location: /smedweb/agenda/agenda.php');
    exit;
}
$c_id = $_GET["id"];  // id do registro na agenda
$c_sql = "SELECT * FROM agenda WHERE id = $c_id";
$result = $conection->query($c_sql);
if ($result->num_rows == 0) {
    header('location: /smedweb/agenda/agenda.php');
    exit;
}
$c_row = $result->fetch_assoc();
$c_data = $c_row['data'];
$c_hora = $c_row['horario'];
$c_nome = $c_row['Nome'];
$c_email = $c_row['email'];
$c_matricula = $c_row['matricula'];
// sql para buscar convenio do paciente na agenda atraves do id_convenio
$c_id_convenio = $c_row['id_convenio'];
$c_sql_convenio = "SELECT * FROM convenios WHERE id = $c_id_convenio";
$c_result_convenio = $conection->query($c_sql_convenio);

if ($c_result_convenio->num_rows > 0) {
    $c_row_convenio = $c_result_convenio->fetch_assoc();
    $c_convenio = $c_row_convenio['nome'];
} else
    $c_convenio = " NÃO INFORMADO";
$c_telefone = $c_row['telefone'];
// sql para buscar o nome do profissional na agenda atraves do id_profissional
$c_id_profissional = $c_row['id_profissional'];
$c_sql_profissional = "SELECT * FROM profissionais WHERE id = $c_id_profissional";
$c_result_profissional = $conection->query($c_sql_profissional);
if ($c_result_profissional->num_rows > 0) {
    $c_row_profissional = $c_result_profissional->fetch_assoc();
    $c_profissional = $c_row_profissional['nome'];
} else
    $c_profissional = " NÃO INFORMADO";
//  monto sql buscas dados do e-mail na tabela de parametros    
$c_sql_parametro = "SELECT * FROM config";
$c_result_parametro = $conection->query($c_sql_parametro);
if ($c_result_parametro->num_rows > 0) {
    $c_row_parametro = $c_result_parametro->fetch_assoc();
    $c_email_remetente = $c_row_parametro['email_clinica'];
    $c_senha_email = $c_row_parametro['senha_email'];
    $c_smtp = $c_row_parametro['host_email'];
    $c_nome_remetente = $c_row_parametro['nome_clinica'];
} else {
    echo "<script>alert('Parâmetros de e-mail não cadastrados.'); window.close();</script>";
    exit;
}

// preparo o assunto do e-mail
$c_assunto = "Lembrete de compromisso - $c_nome_remetente";
// preparo o corpo do e-mail
$c_body = "Olá <b>$c_nome</b>, este é um lembrete do seu compromisso agendado na <b>$c_nome_remetente</b>.<br><br>";
$c_body .= "Data: <b>" . arruma_data($c_data) . "</b><br>";
$c_body .= "Horário: <b>$c_hora</b><br>";
$c_body .= "Profissional: <b>$c_profissional</b><br>";
$c_body .= "Convênio: <b>$c_convenio</b><br>";
$c_body .= "Matrícula: <b>$c_matricula</b><br>";
$c_body .= "Telefone: <b>$c_telefone</b><br><br>";
$c_body .= "Por favor, se não puder comparecer, entre em contato conosco.<br><br>";
$c_body .= "Atenciosamente,<br>";
try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $c_email_envio = $c_email_remetente;
    $mail->CharSet = 'UTF-8';
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = trim($c_smtp);                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = $c_email_remetente;                     //SMTP username
    $mail->Password   = $c_senha_email;                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    //$mail->Port       = 587; 
    //Recipients
    $mail->setFrom($c_email_envio, 'pms');
    //echo $c_email;
    //die;
    $mail->addAddress($c_email, 'pms');     // endereco para onde será enviado

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $c_assunto;
    $mail->Body    = $c_body;
    $mail->send();
    header('location: /smedweb/agenda/agenda.php');
    //echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
    //echo "Mensagem enviada com sucesso!";
