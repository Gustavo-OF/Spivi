<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="../View/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="../View/css/eventos.css?d=<?php echo uniqid() ?>" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="../View/css/style_v2.css">
	<link rel="stylesheet" href="../View/css/style_loader.css">
	<title>Eventos - Spivi</title>
</head>

<body style="margin:1rem">
	<input type="hidden" id="codUnidade" value=<?php echo isset($_SESSION['codUnidadeUser']) ? $_SESSION['codUnidadeUser'] : "00"; ?>>
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
				<h6 class="panel-title txt-dark">Eventos - Spivi</h6>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="form-floating col-md-6 mt-2">
					<input class="form-control w-100" type="date" id="pesquisaDataInicio" value="" />
					<label for="pesquisaDataInicio">&nbsp;Data inicio do evento:</label>
					<div id="pesquisaDataInicioFeedback" class="invalid-feedback">
						Selecione uma data válida.
					</div>
				</div>
				<div class="form-floating col-md-6 mt-2">
					<input class="form-control w-100" type="date" id="pesquisaDataFim" value="" />
					<label for="pesquisaDataFim">&nbsp;Data fim do evento:</label>
					<div id="pesquisaDataFimFeedback" class="invalid-feedback">
						Selecione uma data válida.
					</div>
				</div>
			</div>
			<button type="button" id="botaoPesquisaUsuario" class="btn btn-primary">Buscar</button>
			<button type="button" id="adicionaEvento" class="btn btn-primary btnUltra" data-bs-toggle="modal" data-bs-target="#modal-adiciona-evento">+</button>
		</div>
	</div>

	<!-- <div id="divUsuariosDisponiveisPesquisa" class="container">
        <h4 class="text-center">Resultado da pesquisa</h4>
        <div id="usuariosDisponiveisPesquisa" class="container">
			
        </div>
    </div> -->

	<div class="card table-responsive">
		<div class="card-header headerResponsive">
			<h6 class="panel-title txt-dark">Eventos</h6>
		</div>
		<div class="card-body">
			<table class="table table-hover" id="tabelaResultadoPesquisa">
				<thead>
					<tr>
						<th scope="col" class="text-center">#</th>
						<th scope="col" class="text-center">Nome</th>
						<th scope="col" class="text-center">Professor</th>
						<th scope="col" class="text-center">Data inicio</th>
						<th scope="col" class="text-center">Data fim</th>
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

	<!-- Modal Pesquisa alunos -->
	<div class="modal fade" id="modal-adiciona-evento" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div id="loadingModel" name="loading" class="loading_b">
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
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel"><b>Adicionar evento</b></h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div>
						<div class="form-floating mb-3">
							<input type="text" class="form-control" id="spivi-evento-nome" name="spivi-evento-nome">
							<label for="spivi-evento-nome">Nome do evento</label>
						</div>
						<div class="form-floating mb-3">
							<input type="datetime-local" class="form-control" id="spivi-evento-data-inicial" name="spivi-evento-data-inicial">
							<label for="spivi-endereco">Data incial</label>
						</div>
						<div class="form-floating mb-3">
							<input type="datetime-local" class="form-control" id="spivi-evento-data-final" name="spivi-evento-data-final">
							<label for="spivi-evento-data-final">Data final</label>
						</div>
						<div class="form-floating mb-3">
							<select class="form-select" id="spivi-evento-professor" name="spivi-evento-professor">
								<option value="0" selected>Escolha um professor...</option>
							</select>
							<label for="spivi-evento-professor">Professor</label>
						</div>
					</div>
				</div>
				<div class="alert alert-warning div-retorno" role="alert">
					<b class="mensagem-retorno"></b>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
					<button type="button" class="btn btn-primary btnUltra" id="btn-adiciona-evento" disabled>Adicionar</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Fim Modal Pesquisa alunos -->

	<!-- Modal Confirma aluno -->
	<div class="modal fade" data-keyboard="false" data-backdrop="static" id="modal-confirma-inclusao" tabindex="-1" role="dialog" aria-labelledby="modalConfirmaInclusao">
		<div id="loadingModel1" name="loading" class="loading_b">
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
		</div>>
	</div>
	<!-- Fim Modal Confirma alunos -->


	<!-- Modal edita aluno -->
	<div class="modal fade" data-keyboard="false" data-backdrop="static" id="modal-edita-aluno" tabindex="-1" role="dialog" aria-labelledby="modalEditaAluno">
		<div id="loadingModel2" name="loading" class="loading_b">
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
		<div class="modal-dialog modal-lg" role="document" style="height: fit-content;">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel"><b>Editar informações do evento</b></h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="div-edita">
						<div class="form-floating mb-3">
							<input type="text" class="form-control" id="spivi-evento-edita-nome" name="spivi-evento-edita-nome">
							<label for="spivi-evento-edita-nome">Nome</label>
						</div>
						<div class="form-floating mb-3">
							<input type="datetime-local" class="form-control" id="spivi-evento-edita-data-inicio" name="spivi-evento-edita-data-inicio">
							<label for="spivi-evento-edita-data-inicio">Data inicio</label>
						</div>
						<div class="form-floating mb-3">
							<input type="text" class="form-control" id="spivi-evento-edita-professor" name="spivi-evento-edita-professor">
							<label for="spivi-evento-edita-professor">Professor</label>
						</div>
						<div class="form-floating mb-3">
							<input type="datetime-local" class="form-control" id="spivi-evento-edita-data-fim" name="spivi-evento-edita-data-fim">
							<label for="spivi-evento-edita-data-fim">Data fim</label>
						</div>
					</div>
					<div class="card table-responsive" style="height: 500px">
						<div class="card-header headerResponsive">
							<h6 class="panel-title txt-dark" id="labelVagas"></h6>
						</div>
						<div class="tabelaAlunosEvento card-body">
							<table class="table table-hover" id="tabelaVagas">
								<thead>
									<tr>
										<th scope="col" class="text-center">#</th>
										<th scope="col" class="text-center">Nome</th>
										<th scope="col" class="text-center">Email</th>
										<th scope="col" class="text-center">ID da vaga</th>
										<th scope="col" class="text-center">Remover</th>
									</tr>
								</thead>
								<tbody id="resultadoPesquisaClienteEvento">

								</tbody>
							</table>
						</div>
					</div>
					<div class="alert alert-warning div-retorno" role="alert">
						<b class="mensagem-retorno"></b>
					</div>
					<input type="hidden" id="eventoID">
					<div class="modal-footer mt-1 d-flex justify-content-between" style="padding-left: 0;padding-right:0">
						<button type="button" class="btn btn-danger" id="deleta-evento">Excluir evento</button>
						<button type="button" class="btn btnUltra" id="btn-aplica-atualizacao" disabled>Atualizar</button>
					</div>
				</div>
			</div>
		</div>
		<!-- Fim modal edita aluno -->

</body>
<script type="text/javascript" src="../View/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="../View/js/jquery-3.6.1.min.js?d=<?php echo uniqid() ?>"></script>
<script type="text/javascript" src="../View/js/eventos.js?d=<?php echo uniqid() ?>"></script>
<script type="text/javascript" src="../View/js/loader.js"></script>

</html>