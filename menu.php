<?php
// controle de acesso ao formulário
session_start();
if (!isset($_SESSION['newsession'])) {
	die('Acesso não autorizado!!!');
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

<body class="sb-nav-fixed">
	<main>

		

		<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-blue ftco-navbar-light" id="ftco-navbar">
			<div class="container -my5">


				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="fa fa-bars"></span>Menu
				</button>

				<div class="collapse navbar-collapse" id="ftco-nav">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pacientes</a>
							<div class="dropdown-menu" aria-labelledby="dropdown01">
								<a class="dropdown-item" href="\smedweb\pacientes_lista.php"><img src="\smedweb\images\paciente.png" alt="" width="20" height="20"> Ficha Clinica...</a>
								<a class="dropdown-item" href="#"><img src="\smedweb\images\estatisticas.png" alt="" width="20" height="20"> Estatíscas...</a>
							</div>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Agenda</a>
							<div class="dropdown-menu" aria-labelledby="dropdown04">
								<a class="dropdown-item" href="\smedweb\agenda.php"><img src="\smedweb\images\agenda.png" alt="" width="20" height="20"> Marcação de Consultas...</a>
								<a class="dropdown-item" href="#">____________________________________________</a>
								<a class="dropdown-item" href="\smedweb\config_agenda.php"><img src="\smedweb\images\configdatas.png" alt="" width="20" height="20"> Configuração e Criação da Agenda...</a>
							</div>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Prescrições</a>
							<div class="dropdown-menu" aria-labelledby="dropdown04">
								<a class="dropdown-item" href="\smedweb\prescricao.php"><img src="\smedweb\images\atestado.png" alt="" width="20" height="20">Emitir Prescrição...</a>
								<a class="dropdown-item" href="#"><img src="\smedweb\images\config.png" alt="" width="20" height="20">Configurações...</a>
							</div>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Finaceiro</a>
							<div class="dropdown-menu" aria-labelledby="dropdown04">
								<a class="dropdown-item" href="#"><img src="\smedweb\images\financeiro.png" alt="" width="20" height="20"> Lançamento...</a>
								<a class="dropdown-item" href="#"><img src="\smedweb\images\movimentacao.png" alt="" width="20" height="20"> Movimentação...</a>
								<a class="dropdown-item" href="#">__________________________________</a>
								<a class="dropdown-item" href="\smedweb\indices_lista.php"><img src="\smedweb\images\indices.png" alt="" width="20" height="20"> Indices Financeiros...</a>
								<a class="dropdown-item" href="\smedweb\tabelas_lista.php"><img src="\smedweb\images\tabela.png" alt="" width="20" height="20"> Tabelas...</a>
							</div>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Cadastros</a>
							<div class="dropdown-menu" aria-labelledby="dropdown04">
								<a class="dropdown-item" href="\smedweb\profissionais_lista.php"><img src="\smedweb\images\equipemedica.png" alt="" width="20" height="20"> Profissionais...</a>
								<a class="dropdown-item" href="\smedweb\convenios_lista.php"><img src="\smedweb\images\populacao.png" alt="" width="20" height="20"> Convênios...</a>
								<a class="dropdown-item" href="#">__________________________________</a>
								<a class="dropdown-item" href="\smedweb\procedimentos_lista.php"><img src="\smedweb\images\procedimentos.png" alt="" width="20" height="20"> Procedimentos...</a>
								<a class="dropdown-item" href="\smedweb\itenslaudos_lista.php"><img src="\smedweb\images\laudo2.png" alt="" width="20" height="20"> Itens para Laudos...</a>
								<a class="dropdown-item" href="\smedweb\medicamentos_lista.php"><img src="\smedweb\images\medicamento.png" alt="" width="20" height="20"> Medicamentos...</a>
								<a class="dropdown-item" href="\smedweb\orientacoes_padrao_lista.php"><img src="\smedweb\images\orientacao2.png" alt="" width="20" height="20"> Orientações...</a>
								<a class="dropdown-item" href="\smedweb\formula_padrao_lista.php"><img src="\smedweb\images\ff1.png" alt="" width="20" height="20"> Fórmulas padrões...</a>
								<a class="dropdown-item" href="\smedweb\atestados_padroes_lista.php"><img src="\smedweb\images\atestado2.png" alt="" width="20" height="20"> Atestados Padrões...</a>
								<a class="dropdown-item" href="#">__________________________________</a>
								<a class="dropdown-item" href="\smedweb\grupoMedicamentos_lista.php"><img src="\smedweb\images\grupomedicamento.png" alt="20" height="20"> Grupos de Medicamentos...</a>
								<a class="dropdown-item" href="\smedweb\grupolaudos_lista.php"><img src="\smedweb\images\grupolaudos.png" alt="20" height="20"> Grupos de Exames...</a>
								<a class="dropdown-item" href="#">__________________________________</a>
								<a class="dropdown-item" href="\smedweb\componentes_lista.php"><img src="\smedweb\images\componentes.png" alt="20" height="20"> Componentes de Fórmulas...</a>
								<a class="dropdown-item" href="\smedweb\grupocomponentes_lista.php"><img src="\smedweb\images\grupocomponentes.png" alt="20" height="20"> Grupos de Componentes...</a>
								<a class="dropdown-item" href="#">__________________________________</a>
								<a class="dropdown-item" href="\smedweb\especialidades_lista.php"><img src="\smedweb\images\especialidades.png" alt="" with=20 height="20"> Especialidades...</a>
								<a class="dropdown-item" href="\smedweb\parametros_lista.php"><img src="\smedweb\images\parametros.png" alt="" width="20" height="20"> Parâmetros para Eventos...</a>
								<a class="dropdown-item" href="\smedweb\diagnosticos_lista.php"><img src="\smedweb\images\diagnostico.png" alt="" width="20" height="20"> Diagnósticos...</a>
								
							</div>

						</li>
						<li class="nav-item dropdown">
							<a class="nav-link  dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Usuários</a>
							<div class="dropdown-menu" aria-labelledby="dropdown04">
								<a class="dropdown-item" href="\smedweb\usuarios_lista.php"><img src="\smedweb\images\usuario.png" alt="" width="20" height="20"> Cadastro de Usuários...</a>
								<a class="dropdown-item" href="\smedweb\alterarsenha.php"><img src="\smedweb\images\trocasenha.png" alt="" width="20" height="20"> Trocar de Senha</a>
							</div>
						</li>
						<li class="nav-item active"><a href="#" data-toggle="modal" data-target="#modal" class="nav-link"><img src="\smedweb\images\config.png" alt="" width="20" height="20"> Configurações</a></li>
						<li class="nav-item active"><a href="\smedweb\index.php" class="nav-link"><img src="\smedweb\images\saida.png" alt="" width="20" height="20"> Sair</a></li>
					</ul>
				</div>

			</div>

		</nav>
		<?php
		date_default_timezone_set('America/Sao_Paulo');
		$agora = date('d/m/Y H:i');
		?>
		<div>
			<?php
			if ($_SESSION['c_tipo'] == '1') {
				$c_nivel = 'Administrador ';
			} else {
				$c_nivel = 'Operador';
			}
			?>
			<div style="padding-left:20px;">
				<h5><strong> Usuário logado: <?php echo ' ' . $_SESSION['c_nome'] . ' - ' . $agora . ' ' ?>- Nivel de acesso:<?php echo ' ' . $c_nivel ?></strong></h5>
			</div>
		</div>
		<!-- END nav -->

	</main>

</body>

</html>