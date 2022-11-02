<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="../View/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="../View/css/performance.css?d=<?php echo uniqid() ?>" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="../View/css/style_v2.css">
	<link rel="stylesheet" href="../View/css/style_loader.css">
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
	<title>Performance - Spivi</title>
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
				<h6 class="panel-title txt-dark">Performance alunos - Spivi</h6>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="form-floating col-md-6 mb-2">
					<input class="form-control w-100" type="text" id="pesquisaNomeUsuario" value="" />
					<label for="pesquisaNomeUsuario">&nbsp;Nome do aluno:</label>
				</div>
				<input type="hidden" id="emailAluno">
				<div class="form-floating col-md-6 mb-2">
					<select class="form-select w-100" id="selectEvento">
						<option selected value="0">Nenhum em específico</option>
					</select>
					<label for="selectEvento">&nbsp;Evento:</label>
				</div>
			</div>
			<div class="row">
				<div class="form-floating col-md-6">
					<input class="form-control w-100" type="date" id="pesquisaDataInicio" value="" />
					<label for="pesquisaDataInicio">&nbsp;Data inicio do evento:</label>
					<div id="pesquisaDataInicioFeedback" class="invalid-feedback">
						Selecione uma data válida.
					</div>
				</div>
				<div class="form-floating col-md-6">
					<input class="form-control w-100" type="date" id="pesquisaDataFim" value="" />
					<label for="pesquisaDataFim">&nbsp;Data fim do evento:</label>
					<div id="pesquisaDataFimFeedback" class="invalid-feedback">
						Selecione uma data válida.
					</div>
				</div>
			</div>
			<button type="button" id="botaoPesquisaUsuario" class="btn btn-primary">Buscar</button>
		</div>
	</div>

	<!-- <div id="divUsuariosDisponiveisPesquisa" class="container">
        <h4 class="text-center">Resultado da pesquisa</h4>
        <div id="usuariosDisponiveisPesquisa" class="container">
			
        </div>
    </div> -->

	<div class="card table-responsive">
		<div class="card-header headerResponsive">
			<h6 class="panel-title txt-dark">Informações do pós-treino</h6>
		</div>
		<div class="card-body">
			<table class="table table-hover" id="tabelaResultadoPesquisa">
				<thead>
					<tr>
						<th scope="col" class="text-center">#</th>
						<th scope="col" class="text-center">Aluno</th>
						<th scope="col" class="text-center">Treino</th>
						<th scope="col" class="text-center">Calorias gastas</th>
						<th scope="col" class="text-center">Pontos Spivi ganhos</th>
						<th scope="col" class="text-center">Pontos Ultra ganhos</th>
						<th scope="col" class="text-center">Média de batimentos</th>
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


</body>
<script type="text/javascript" src="../View/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="../View/js/jquery-3.6.1.min.js?d=<?php echo uniqid() ?>"></script>
<script type="text/javascript" src="../View/js/performance.js?d=<?php echo uniqid() ?>"></script>
<script type="text/javascript" src="../View/js/loader.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

</html>