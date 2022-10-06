<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="../View/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="../View/css/clientes.css?d=<?php echo uniqid() ?>" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="../View/css/style_v2.css">
	<link rel="stylesheet" href="../View/css/style_loader.css">
	<title>Alunos - Spivi</title>
</head>

<body style="margin:1rem">
	<input type="hidden" id="codUnidade" value=<?php echo isset($_SESSION['codUnidadeUser']) ? $_SESSION['codUnidadeUser'] : "01";?>>
	<div id="loading" name="loading" class="loading_b">
		<div class="loader-wrapper">
			<div class="loaderA">
				<div class="roller"></div>
				<div class="roller"></div>
			</div>

			<div id="loader2" class="loader">
				<div class="roller"></div>
				<div class="roller"></div>
			</div>

			<div id="loader3" class="loader">
				<div class="roller"></div>
				<div class="roller"></div>
			</div>
			<div class="img01">
				<img src="../View/images/logoA.png" style="width:148px;" />
			</div>
			<div class="txt01">
				Aguarde
			</div>
		</div>
	</div>
	<div id="pesquisaUsuarios" class="card">
		<div class="card-header">
			<div class="pull-left">
				<h6 class="panel-title txt-dark">Alunos - Spivi</h6>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					<label for="pesquisaNomeUsuario">Pesquisar por nome:</label>
					<input class="form-control w-75" type="text" id="pesquisaNomeUsuario" value="" />
				</div>
				<div class="col-md-6">
					<label for="pesquisaEmailUsuario">Pesquisar por Email:</label>
					<input class="form-control w-75" type="text" id="pesquisaEmailUsuario" value="" />
				</div>
			</div>
			<button type="button" id="botaoPesquisaUsuario" class="btn btn-primary">Buscar</button>
			<button type="button" id="adicionaUsuario" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdicionaUsuario">+</button>
		</div>
	</div>

	<!-- <div id="divUsuariosDisponiveisPesquisa" class="container">
        <h4 class="text-center">Resultado da pesquisa</h4>
        <div id="usuariosDisponiveisPesquisa" class="container">
			
        </div>
    </div> -->

	<div class="card table-responsive">
		<div class="card-header headerResponsive">
			<h6 class="panel-title txt-dark">Alunos</h6>
		</div>
		<div class="card-body">
			<table class="table table-hover" id="tabelaResultadoPesquisa">
				<thead>
					<tr>
						<th scope="col" class="text-center">#</th>
						<th scope="col" class="text-center">Nome</th>
						<th scope="col" class="text-center">Email</th>
						<th scope="col" class="text-center">Level</th>
						<th scope="col" class="text-center">FTP</th>
						<th scope="col" class="text-center">LTHR</th>
						<th scope="col" class="text-center">RHR</th>
						<th scope="col" class="text-center">Editar</th>
					</tr>
				</thead>
				<tbody id="resultadoPesquisaCliente">

				</tbody>
			</table>
		</div>
	</div>

	<?php //print_r($_SESSION['accessToken']);
	//print_r($pegaClientes);
	?>
	<br />
	<button type="button" id="botaoVoltaUsuarios" class="btn btn-primary" onclick="history.back()">Voltar</button>

	<!-- Modal -->
	<div class="modal fade" id="modalAdicionaUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel"><b>Adicionar aluno</b></h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
				<p>
					<h5>
						Digite o nome, CPF ou o código do(a) aluno(a) que deseja adicionar na Spivi.
					</h5>
					<br />
					<br />
					<input type="text" id="campoPesquisaAluno" class="form-control" placeholder="Nome, CPF ou código do aluno(a)." />
					</p>
					<div class="alert alert-danger" id="div-erro" role="alert" style="display:none">
						<b id="erro"></b>
					</div>
					<div class="loader"></div>
					<br />

					<div class="alert alert-warning" id="div-not-found" style="display:none">
						<b>Aluno(a) não encontrado na base. Deseja cadastrá-lo(a)?</b>
						<br />
						<br />
						<button class="btn btn-default" id="cancel-registration" style="width: 32%;margin-right:18%;margin-left:5%">Não</button>
						<button class="btn btnUltra" id="proceed-registration" style="width: 32%;">Sim</button>
					</div>
					<div class="table-responsive">
						<table class="table table-hover" style="height:34%; display: none; width:100%;" id="tabela-convidado">
							<thead>
								<tr>
									<th scope="col">Cód. Aluno</th>
									<th scope="col">Nome</th>
									<th scope="col">CPF</th>
									<th scope="col">Status</th>
								</tr>
							</thead>
							<tbody id="corpo-tabela-convites"></tbody>
						</table>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
					<button type="button" class="btn btn-primary" id="btnPesquisaAluno">Procurar</button>
				</div>
			</div>
		</div>
	</div>

</body>
<script type="text/javascript" src="../View/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="../View/js/jquery-3.6.1.min.js?d=<?php echo uniqid() ?>"></script>
<script type="text/javascript" src="../View/js/clientes.js?d=<?php echo uniqid() ?>"></script>
<script type="text/javascript" src="../View/js/loader.js"></script>

</html>