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
						<th scope="col" class="text-center">Descrição</th>
						<th scope="col" class="text-center">Data inicio</th>
						<th scope="col" class="text-center">Data fim</th>
						<!--<th scope="col" class="text-center">Editar</th>-->
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
						<div class="form-floating mb-3">
							<textarea class="form-control h-75" id="spivi-evento-descricao" name="spivi-evento-descricao"></textarea>
							<label for="spivi-evento-descricao">Descrição</label>
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
		</div>
		<div class="modal-dialog modal-lg" role="document" style="height: fit-content;">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel"><b>Confirmar usuário</b></h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<h2 style="text-align: center;display:none" id="label-confirma">Tem certeza que deseja inserir este aluno?</h2>
					<br />
					<br />
					<div class="loader" id="loading-confirma-aluno" style="margin: 0; position: center"></div>
					<div class="divResultado" style="display: inline-flex;">
						<div class="imagem" style="padding-right: 2.5rem;">
							<img alt="imagem-aluno" id="foto-conf" style="max-width:200px; max-height: 200px;">
						</div>
						<div class="confirma-inclusao">

							<h6 id="cod_aluno_confirma"></h6>
							<h6 id="nome_aluno_confirma"></h6>
							<h6 id="email_aluno_confirma" style="line-break: anywhere;"></h6>
							<h6 id="cpf_aluno_confirma"></h6>
							<h6 id="data_nasc_aluno_confirma"></h6>
							<h6 id="plano_aluno_confirma"></h6>
							<h6 id="deviceID" class="d-inline-flex"><b>ID do dispositivo: </b> <input type="number" id="numberDeviceId" class="form-control w-25" style="height:76%"> </h6>

							<input type="hidden" id="genero">
							<input type="hidden" id="endereco">
							<input type="hidden" id="cidade">
							<input type="hidden" id="celular">
						</div>
					</div>
				</div>
				<div class="alert alert-warning div-retorno" role="alert">
					<b class="mensagem-retorno"></b>
				</div>
				<div class="modal-footer" style="margin-top: 5%">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-toggle="modal" href="#modalAdicionaUsuario">Voltar</button>
					<button type="button" class="btn btnUltra" id="btn-aplica-insercao">Inserir</button>
				</div>
			</div>
		</div>
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
					<h5 class="modal-title" id="exampleModalLabel"><b>Editar informações do aluno</b></h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="div-edita">
						<div class="form-floating mb-3">
							<input type="text" class="form-control" id="spivi-nome" name="spivi-nome">
							<label for="spivi-nome">Nome</label>
						</div>
						<div class="form-floating mb-3">
							<input type="text" class="form-control" id="spivi-endereco" name="spivi-endereco">
							<label for="spivi-endereco">Endereco</label>
						</div>
						<div class="form-floating mb-3">
							<input type="text" class="form-control" id="spivi-cidade" name="spivi-cidade">
							<label for="spivi-cidade">Cidade</label>
						</div>
						<div class="form-floating mb-3">
							<input type="text" class="form-control" id="spivi-cel" name="spivi-cel">
							<label for="spivi-cel">Celular</label>
						</div>
						<div class="form-floating mb-3">
							<input type="email" class="form-control" id="spivi-email" name="spivi-email" disabled>
							<label for="spivi-email">Email</label>
						</div>
						<div class="form-floating mb-3">
							<input type="text" disabled class="form-control" id="spivi-level" name="spivi-level">
							<label for="spivi-level">Level</label>
						</div>
						<div class="form-floating mb-3" style="padding-bottom: 1rem;">
							<input type="text" class="form-control" id="spivi-ftp" name="spivi-ftp">
							<label for="spivi-ftp">FTP</label>
						</div>
						<div class="form-floating mb-3">
							<input type="text" class="form-control" id="spivi-lthr" name="spivi-lthr">
							<label for="spivi-lthr">LTHR</label>
						</div>
						<div class="form-floating mb-3">
							<input type="number" class="form-control" id="spivi-peso" name="spivi-peso">
							<label for="spivi-peso">Peso (KG)</label>
						</div>
						<div class="form-floating mb-3">
							<input type="number" class="form-control" id="spivi-altura" name="spivi-altura">
							<label for="spivi-altura">Altura (cm)</label>
						</div>
						<div class="form-floating mb-3">
							<input type="text" class="form-control" id="spivi-rhr" name="spivi-rhr">
							<label for="spivi-rhr">RHR</label>
						</div>
						<div class="form-floating mb-3">
							<input type="text" class="form-control" id="spivi-pst" name="spivi-pst">
							<label for="spivi-pst">PST</label>
						</div>
						<div class="form-floating mb-3">
							<input type="number" class="form-control" id="spivi-device-id" name="spivi-device">
							<label for="spivi-device-id">ID do dispositivo</label>
						</div>
					</div>
					<!-- <div class="form-floating mb-3">
						<textarea class="form-control" id="spivi-anotacoes" rows="3"></textarea>
						<label for="spivi-anotacoes">Anotações</label>
					</div> -->
					<div class="alert alert-warning div-retorno" role="alert">
						<b class="mensagem-retorno"></b>
					</div>
					<div class="modal-footer mt-1 d-flex justify-content-between" style="padding-left: 0;padding-right:0">
						<button type="button" class="btn btn-danger" id="deleta-cliente">Excluir aluno</button>
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