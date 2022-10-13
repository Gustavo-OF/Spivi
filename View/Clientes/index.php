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
				<h6 class="panel-title txt-dark">Alunos - Spivi</h6>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="form-floating col-md-6">
					<input class="form-control w-75" type="text" id="pesquisaNomeUsuario" value="" />
					<label for="pesquisaNomeUsuario">&nbsp;Nome do aluno:</label>
				</div>
				<div class="form-floating col-md-6">
					<input class="form-control w-75" type="text" id="pesquisaEmailUsuario" value="" />
					<label for="pesquisaEmailUsuario">&nbsp;Email do aluno:</label>
				</div>
			</div>
			<button type="button" id="botaoPesquisaUsuario" class="btn btn-primary">Buscar</button>
			<button type="button" id="adicionaUsuario" class="btn btn-primary btnUltra" data-bs-toggle="modal" data-bs-target="#modalAdicionaUsuario">+</button>
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

	<!-- Modal Pesquisa alunos -->
	<div class="modal fade" id="modalAdicionaUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
					<h5 class="modal-title" id="exampleModalLabel"><b>Adicionar aluno</b></h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<p>
						<label for="campoPesquisaAluno">
							Digite o nome, CPF ou o código do aluno que deseja adicionar no Spivi.
						</label>
						<br />
						<div class="form-floating mb-3">
						<input type="text" id="campoPesquisaAluno" class="form-control" />
							<label for="campoPesquisaAluno">Nome, CPF ou código do aluno.</label>
						</div>
					</p>
					<div class="alert alert-danger" id="div-erro" role="alert" style="display:none">
						<b id="erro"></b>
					</div>
					<div class="loader"></div>
					<br />
					<div class="alert alert-warning" id="div-not-found" style="display:none">
						<b>Aluno(a) não encontrado na base.</b>
						<br />
					</div>
					<div class="table-responsive">
						<table class="table table-hover" style="height:34%; display: none; width:100%;" id="tabela-pesquisa">
							<thead>
								<tr>
									<th scope="col">Cód. Aluno</th>
									<th scope="col">Nome</th>
									<th scope="col">CPF</th>
									<th scope="col">Status</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
					<button type="button" class="btn btn-primary btnUltra" id="btnPesquisaAluno" disabled>Procurar</button>
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
					<img alt="imagem-aluno" id="foto-conf" style="max-width:200px; max-height: 200px;">
					<div class="confirma-inclusao">

						<h5 id="cod_aluno_confirma"></h5>
						<h5 id="nome_aluno_confirma"></h5>
						<h5 id="email_aluno_confirma" style="line-break: anywhere;"></h5>
						<h5 id="cpf_aluno_confirma"></h5>
						<h5 id="data_nasc_aluno_confirma"></h5>
						<h5 id="plano_aluno_confirma"></h5>

						<input type="hidden" id="genero">
						<input type="hidden" id="endereco">
						<input type="hidden" id="cidade">
						<input type="hidden" id="celular">
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
						<div class="form-floating mb-3">
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
						<div class="form-floating">
							<input type="text" class="form-control" id="spivi-pst" name="spivi-pst">
							<label for="spivi-pst">PST</label>
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
<script type="text/javascript" src="../View/js/clientes.js?d=<?php echo uniqid() ?>"></script>
<script type="text/javascript" src="../View/js/loader.js"></script>

</html>