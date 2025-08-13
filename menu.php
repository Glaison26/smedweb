<?php

// controle de acesso ao formulário
session_start();
if (!isset($_SESSION['newsession'])) {
	die('Acesso não autorizado!!!');
}
$_SESSION['sql'] = "";
$_SESSION['aba_agenda'] = 1;
// pega usuário e seu perfil
// conexão dom o banco de dados
include("conexao.php");
// query para capturar perfil do usuário logado
$c_login = $_SESSION['c_usuario'];
$c_sql = "SELECT usuario.id,usuario.tipo,fichaclinica,
              agenda,agenda_marcacao,agenda_incluir,agenda_remanejar,agenda_desmarcar,agenda_criacao,
              prescricao,prescricao_atestado,prescricao_formula,prescricao_medicamento,prescricao_laudos,prescricao_orientacao,prescricao_relatorio,
              prescricao_configuracao,financeiro,configuracoes,cad_profissionais,cad_convenios,cad_procedimentos,cad_itenslaudos,cad_medicamentos,
              cad_orientacoes,cad_formula,cad_atestado,cad_grupo_medicamento,cad_grupo_exame,cad_componente_formula,cad_grupo_componentes,
              cad_especialidades,cad_parametros_eventos,cad_diagnosticos FROM usuario
			  JOIN perfil_usuarios_opcoes ON usuario.id_perfil=perfil_usuarios_opcoes.id
			  where usuario.login='$c_login'";
$result = $conection->query($c_sql);
// verifico se a query foi correto
if (!$result) {
	die("Erro ao Executar Sql !!" . $conection->connect_error);
}
$c_linha = $result->fetch_assoc();
///////////////////////////////////////////////////////////////
// permissões das opções de entrada no menu
//////////////////////////////////////////////////////////////
// ficha de pacientes
if (($c_linha['fichaclinica'] == 'S') || ($c_linha['tipo'] == '1')) {
	$op_paciente = "\smedweb\pacientes_lista.php";
} else {
	$op_paciente = "javascript:negar()";
}
// Cadastro de usuários
if (($c_linha['tipo'] == '1')) {
	$op_usuarios = "\smedweb\usuarios_lista.php";
} else {
	$op_usuarios = "javascript:negar()";
}
// Cadastro de perfis
if (($c_linha['tipo'] == '1')) {
	$op_usuarios_perfil = "\smedweb\perfil_acesso.php";
} else {
	$op_usuarios_perfil = "javascript:negar()";
}
// agenda 
if (($c_linha['agenda'] == 'S') || ($c_linha['tipo'] == '1')) {
	$op_agenda = "\smedweb\agenda.php";
} else {
	$op_agenda = "javascript:negar()";
}
// agenda Criação
if (($c_linha['agenda_criacao'] == 'S') || ($c_linha['tipo'] == '1')) {
	$op_agenda_criacao = "\smedweb\config_agenda.php";
} else {
	$op_agenda_criacao = "javascript:negar()";
}
// acesso a prescrição
if (($c_linha['prescricao'] == 'S') || ($c_linha['tipo'] == '1')) {
	$op_prescricao = "\smedweb\prescricao.php";
} else {
	$op_prescricao = "javascript:negar()";
}
// acesso cadastro de profissionais
if (($c_linha['cad_profissionais'] == 'S') || ($c_linha['tipo'] == '1')) {
	$op_cad_profissionais = "\smedweb\profissionais_lista.php";
} else {
	$op_cad_profissionais = "javascript:negar()";
}
// acesso cadastro de profissionais
if (($c_linha['cad_convenios'] == 'S') ||  ($c_linha['tipo'] == '1')) {
	$op_cad_convenios = "\smedweb\convenios_lista.php";
} else {
	$op_cad_convenios = "javascript:negar()";
}
// acesso cadastro de procedimentos
if (($c_linha['cad_procedimentos'] == 'S') || ($c_linha['tipo'] == '1')) {
	$op_cad_procedimentos = "\smedweb\procedimentos_lista.php";
} else {
	$op_cad_procedimentos = "javascript:negar()";
}
// acesso cadastro de procedimentos
if (($c_linha['cad_itenslaudos'] == 'S') || ($c_linha['tipo'] == '1')) {
	$op_cad_itenslaudos = "\smedweb\itenslaudos_lista.php";
} else {
	$op_cad_itenslaudos = "javascript:negar()";
}
// acesso cadastro de medicamentos
if (($c_linha['cad_medicamentos'] == 'S') || ($c_linha['tipo'] == '1')) {
	$op_cad_medicamentos = "\smedweb\medicamentos_lista.php";
} else {
	$op_cad_medicamentos = "javascript:negar()";
}
// acesso cadastro de orientações
if (($c_linha['cad_orientacoes'] == 'S') || ($c_linha['tipo'] == '1')) {
	$op_cad_orientacoes = "\smedweb\orientacoes_padrao_lista.php";
} else {
	$op_cad_orientacoes = "javascript:negar()";
}
// acesso cadastro de formulas
if (($c_linha['cad_formula'] == 'S') || ($c_linha['tipo'] == '1')) {
	$op_cad_formulas = '\smedweb.\formula_padrao_lista.php';
} else {
	$op_cad_formulas = "javascript:negar()";
}
// acesso cadastro de atestados padroes
if (($c_linha['cad_atestado'] == 'S') || ($c_linha['tipo'] == '1')) {
	$op_cad_atestado = "\smedweb\atestados_padroes_lista.php";
} else {
	$op_cad_atestado = "javascript:negar()";
}
// acesso cadastro de grupos de medicamentos
if (($c_linha['cad_grupo_medicamento'] == 'S') || ($c_linha['tipo'] == '1')) {
	$op_cad_grupo_medicamento = "\smedweb\grupoMedicamentos_lista.php";
} else {
	$op_cad_grupo_medicamento = "javascript:negar()";
}
// acesso cadastro de grupos de exames para laudos
if (($c_linha['cad_grupo_exame'] == 'S') || ($c_linha['tipo'] == '1')) {
	$op_cad_grupo_exame = "\smedweb\grupolaudos_lista.php";
} else {
	$op_cad_grupo_exame = "javascript:negar()";
}
// acesso cadastro de componentes de formulas
if (($c_linha['cad_componente_formula'] == 'S') || ($c_linha['tipo'] == '1')) {
	$op_cad_componentes = "\smedweb\componentes_lista.php";
} else {
	$op_cad_componentes = "javascript:negar()";
}
// acesso cadastro de grupos componentes de formulas
if (($c_linha['cad_grupo_componentes'] == 'S') || ($c_linha['tipo'] == '1')) {
	$op_cad_grupos_componentes = "\smedweb\grupocomponentes_lista.php";
	$op_cad_grupos_componentes;
} else {
	$op_cad_grupos_componentes = "javascript:negar()";
}
// acesso cadastro de Especialidades
if (($c_linha['cad_especialidades'] == 'S') || ($c_linha['tipo'] == '1')) {
	$op_cad_especialidades = "\smedweb\especialidades_lista.php";
} else {
	$op_cad_especialidades = "javascript:negar()";
}
// acesso cadastro de parametros de eventos
if (($c_linha['cad_parametros_eventos'] == 'S') || ($c_linha['tipo'] == '1')) {
	$op_cad_parametros = "\smedweb\parametros_lista.php";
} else {
	$op_cad_parametros = "javascript:negar()";
}
// acesso cadastro de diagnosticos
if (($c_linha['cad_diagnosticos'] == 'S') || ($c_linha['tipo'] == '1')) {
	$op_cad_diagnosticos = "\smedweb\diagnosticos_lista.php";
} else {
	$op_cad_diagnosticos = "javascript:negar()";
}
// acesso financeiro indices
if (($c_linha['financeiro'] == 'S') || ($c_linha['tipo'] == '1')) {
	$op_financeiro1 = "\smedweb\indices_lista.php";
} else {
	$op_financeiro1 = "javascript:negar()";
}
// acesso tabelas
if (($c_linha['financeiro'] == 'S') || ($c_linha['tipo'] == '1')) {
	$op_financeiro2 = '\smedweb\tabelas_lista.php';
} else {
	$op_financeiro2 = "javascript:negar()";
}
// acesso as configurações somente para o administrador
if (($c_linha['tipo'] == '1')) {
	$op_configuracoes = "\smedweb\configuracoes.php";
} else {
	$op_configuracoes = "javascript:negar()";
}

?>

<!doctype html>
<html lang="en">

<head>
	<title>SmartMed - Sistema Medico</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
	<link rel="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
	<link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="shortcut icon" type="imagex/png" href="./images/smed_icon.ico">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

	<script type="text/javascript" src="js/jquery-1.2.6.pack.js"></script>
	<script type="text/javascript" src="js/jquery.maskedinput-1.1.4.pack.js"></script>
	<script src="js/jquery.min.js"></script>
	<script src="js/popper.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<!-- The sidebar -->
<div class="container -my5">
	<!-- barra lateral com opções mais utilizadas -->
	<div class="container -my5">
		<div class="sidebar">
			<a href="#"></a>
			<a title='Ficha clinica de Paciente' href=<?php echo $op_paciente; ?>><img src="\smedweb\images\paciente.png" alt="" width="30" height="30"></a>
			<a title='Marcação de Consultas' href=<?php echo $op_agenda; ?>><img src="\smedweb\images\agenda.png" alt="" width="30" height="30"></a>
			<a title='Prescrições Médicas' href=<?php echo $op_prescricao; ?>><img src="\smedweb\images\atestado.png" alt="" width="30" height="30"></a>
			<a title='Alterar Senha' href="\smedweb\alterarsenha.php"><img src="\smedweb\images\trocasenha.png" alt="" width="30" height="30"></a>
			<a title='Sair do Sistema' href="\smedweb\index.php"><img src="\smedweb\images\saida.png" alt="" width="30" height="30"></a>
		</div>
	</div>

	<body class="sb-nav-fixed">
		<!-- função para negar acesso ao usuário não autorizado -->
		<script>
			function negar() {
				alert('Acesso não autorizado para o usuário, consulte o administrador do Sistema!!!');
				void(0);
			}
		</script>
		<!-- fim da função -->
		<main>

			<div style="padding-top:10px;">
				<div class="panel">
					<div class="panel-heading text-center text-info">
						<br>
						<h1><img Align="left" src="\smedweb\images\smed2.png"><strong>Sistema Médico</strong></h1>
						<br>
					</div>

				</div>
				<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-blue ftco-navbar-light" id="ftco-navbar">

					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
						<span class="fa fa-bars">Menu</span>
					</button>

					<div class="collapse navbar-collapse" id="ftco-nav">

						<div class="navbar-header">
							<br>
							<a class="navbar-brand" href="#">
								<h5><span class="glyphicon glyphicon-home" aria-hidden="true"></span><strong> Menu Inicial</strong></h5>
							</a>
						</div>
						<ul class="navbar-nav ml-auto">

							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pacientes</a>
								<div class="dropdown-menu" aria-labelledby="dropdown01">
									<a class="dropdown-item" href=<?php echo $op_paciente; ?>><img src="\smedweb\images\paciente.png" alt="" width="20" height="20"> Ficha Clinica...</a>
									<a class="dropdown-item" href="#"><img src="\smedweb\images\estatisticas.png" alt="" width="20" height="20"> Estatíscas...</a>
								</div>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Agenda</a>
								<div class="dropdown-menu" aria-labelledby="dropdown04">
									<a class="dropdown-item" href=<?php echo $op_agenda; ?>><img src="\smedweb\images\agenda.png" alt="" width="20" height="20"> Marcação de Consultas...</a>
									<a class="dropdown-item" href="#">____________________________________________</a>
									<a class="dropdown-item" href=<?php echo $op_agenda_criacao; ?>><img src="\smedweb\images\configdatas.png" alt="" width="20" height="20"> Configuração e Criação da Agenda...</a>
								</div>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Prescrições</a>
								<div class="dropdown-menu" aria-labelledby="dropdown04">
									<a class="dropdown-item" href=<?php echo $op_prescricao; ?>><img src="\smedweb\images\atestado.png" alt="" width="20" height="20">Emitir Prescrição...</a>
									<a class="dropdown-item" href="#"><img src="\smedweb\images\config.png" alt="" width="20" height="20">Configurações...</a>
								</div>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Finaceiro</a>
								<div class="dropdown-menu" aria-labelledby="dropdown04">
									<a class="dropdown-item" href="#"><img src="\smedweb\images\financeiro.png" alt="" width="20" height="20"> Lançamento...</a>
									<a class="dropdown-item" href="#"><img src="\smedweb\images\movimentacao.png" alt="" width="20" height="20"> Movimentação...</a>
									<a class="dropdown-item" href="#">__________________________________</a>
									<a class="dropdown-item" href=<?php echo $op_financeiro1; ?>><img src="\smedweb\images\indices.png" alt="" width="20" height="20"> Indices Financeiros...</a>
									<a class="dropdown-item" href=<?php echo $op_financeiro2; ?>><img src="\smedweb\images\tabela.png" alt="" width="20" height="20"> Tabelas...</a>
								</div>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Cadastros</a>
								<div class="dropdown-menu" aria-labelledby="dropdown04">
									<a class="dropdown-item" href=<?php echo $op_cad_profissionais; ?>><img src="\smedweb\images\equipemedica.png" alt="" width="20" height="20"> Profissionais...</a>
									<a class="dropdown-item" href=<?php echo $op_cad_convenios; ?>><img src="\smedweb\images\populacao.png" alt="" width="20" height="20"> Convênios...</a>
									<a class="dropdown-item" href="#">__________________________________</a>
									<a class="dropdown-item" href=<?php echo $op_cad_procedimentos; ?>><img src="\smedweb\images\procedimentos.png" alt="" width="20" height="20"> Procedimentos...</a>
									<a class="dropdown-item" href=<?php echo $op_cad_itenslaudos; ?>><img src="\smedweb\images\laudo2.png" alt="" width="20" height="20"> Itens para Laudos...</a>
									<a class="dropdown-item" href=<?php echo $op_cad_medicamentos; ?>><img src="\smedweb\images\medicamento.png" alt="" width="20" height="20"> Medicamentos...</a>
									<a class="dropdown-item" href=<?php echo $op_cad_orientacoes; ?>><img src="\smedweb\images\orientacao2.png" alt="" width="20" height="20"> Orientações...</a>
									<a class="dropdown-item" href=<?php echo $op_cad_formulas; ?>><img src="\smedweb\images\ff1.png" alt="" width="20" height="20"> Fórmulas padrões...</a>
									<a class="dropdown-item" href=<?php echo $op_cad_atestado; ?>><img src="\smedweb\images\atestado2.png" alt="" width="20" height="20"> Atestados Padrões...</a>
									<a class="dropdown-item" href="#">__________________________________</a>
									<a class="dropdown-item" href=<?php echo $op_cad_grupo_medicamento; ?>><img src="\smedweb\images\grupomedicamento.png" alt="20" height="20"> Grupos de Medicamentos...</a>
									<a class="dropdown-item" href=<?php echo $op_cad_grupo_exame; ?>><img src="\smedweb\images\grupolaudos.png" alt="20" height="20"> Grupos de Exames...</a>
									<a class="dropdown-item" href="#">__________________________________</a>
									<a class="dropdown-item" href=<?php echo $op_cad_componentes; ?>><img src="\smedweb\images\componentes.png" alt="20" height="20"> Componentes de Fórmulas...</a>
									<a class="dropdown-item" href=<?php echo $op_cad_grupos_componentes; ?>><img src="\smedweb\images\grupocomponentes.png" alt="20" height="20"> Grupos de Componentes...</a>
									<a class="dropdown-item" href="#">__________________________________</a>
									<a class="dropdown-item" href=<?php echo $op_cad_especialidades; ?>><img src="\smedweb\images\especialidades.png" alt="" with=20 height="20"> Especialidades...</a>
									<a class="dropdown-item" href=<?php echo $op_cad_parametros; ?>><img src="\smedweb\images\parametros.png" alt="" width="20" height="20"> Parâmetros para Eventos...</a>
									<a class="dropdown-item" href=<?php echo $op_cad_diagnosticos; ?>><img src="\smedweb\images\diagnostico.png" alt="" width="20" height="20"> Diagnósticos...</a>
									<a class="dropdown-item" href="#">__________________________________</a>
									<a class="dropdown-item" href=<?php echo $op_configuracoes; ?>><img src="\smedweb\images\config.png" alt="" with=20 height="20"> Configurações Gerais...</a>
								</div>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Usuários</a>
								<div class="dropdown-menu" aria-labelledby="dropdown04">
									<a class="dropdown-item" href=<?php echo $op_usuarios; ?>><img src="\smedweb\images\usuario.png" alt="" width="20" height="20"> Cadastro de Usuários...</a>
									<a class="dropdown-item" href=<?php echo $op_usuarios_perfil; ?>><img src="\smedweb\images\acessos2.png" alt="" width="20" height="20"> Perfis dos acessos de Usuários</a>
									<a class="dropdown-item" href="\smedweb\alterarsenha.php"><img src="\smedweb\images\trocasenha.png" alt="" width="20" height="20"> Trocar de Senha</a>

								</div>
							</li>


						</ul>
					</div>

				</nav>

				<div class="container -my5">
					<?php
					date_default_timezone_set('America/Sao_Paulo');
					$agora = date('d/m/Y H:i');
					if ($_SESSION['c_tipo'] == '1') {
						$c_nivel = 'Administrador ';
					} else {
						$c_nivel = 'Operador';
					}
					?>
					<div class="container" class="text-primary">
						<div class="panel-body text-left">
							<h4>Usuário logado: <?php echo ' ' . $_SESSION['c_nome'] . ' - ' . $agora . ' ' ?>- Nivel de acesso:<?php echo ' ' . $c_nivel ?></h4>
						</div>

					</div>

				</div>
				<hr>
				<div class="container">
					<div class="row">
						<div class="col-sm">
							<div class="container" Align="left">
								<img class="img-thumbnail" class="img-fluid" alt="Responsive image" src="\smedweb\images\medico.jpeg" alt="" width="500" height="400">
							</div>
						</div>
						<div class="col-sm-7">
							<div class="container" class="text-primary">

								<p>
								<h3 class="text-black-50" Align="justify">

									Bem-vindo ao nosso sistema inovador, projetado especificamente para atender às necessidades de gestão de clínicas e consultórios médicos.
									Esta plataforma abrangente oferece uma ampla gama de recursos, desde o gerenciamento eficiente de pacientes até o faturamento e análises detalhadas,
									tornando a administração do seu negócio mais simples e eficiente.<br><br> Explore conosco as principais funcionalidades deste sistema e descubra como
									ele pode transformar a maneira como você gerencia sua clínica ou consultório.<h4>

								</h3>
								</p>
							</div>
						</div>

						<div class="col-sm-0">
						</div>
					</div>
				</div>
			</div>



</div>


<!-- END nav -->

</main>

</body>

<!-- CSS para as barras laterais -->
<style>
	/* Style the sidebar - fixed full height */
	.sidebar {
		height: 100%;
		width: 70px;
		position: fixed;
		z-index: 1;
		top: 0;
		left: 0;
		background-color: #4682B4;
		overflow-x: hidden;
		padding-top: 16px;
	}

	/* Style sidebar links */
	.sidebar a {
		padding: 6px 8px 6px 16px;
		text-decoration: none;
		font-size: 20px;
		color: #F5F5F5;
		display: block;
	}

	/* Style links on mouse-over */
	.sidebar a:hover {
		color: #f1f1f1;
	}

	/* Style the main content */
	.main {
		margin-left: 160px;
		/* Same as the width of the sidenav */
		padding: 0px 10px;
	}

	/* Add media queries for small screens (when the height of the screen is less than 450px, add a smaller padding and font-size) */
	@media screen and (max-height: 450px) {
		.sidebar {
			padding-top: 15px;
		}

		.sidebar a {
			font-size: 18px;
		}
	}
</style>


</html>