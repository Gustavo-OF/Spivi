<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../View/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../View/css/usuarios.css?d=<?php echo uniqid() ?>" rel="stylesheet" type="text/css" />
    <title>Clientes - Spivi</title>
</head>

<body>
    <div id="pesquisaUsuarios" class="card">
        <div class="card-header">
            <div class="pull-left">
                <h6 class="panel-title txt-dark">Clientes - Selfloops</h6>
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
                    <label for="pesquisaIdUsuario">Pesquisar por ID:</label>
                    <input class="form-control w-75" type="text" id="pesquisaIdUsuario" value="" />
                </div>
            </div>
            <button id="botaoPesquisaUsuario" class="btn btn-primary">Buscar</button>
            <button type="button" id="adicionaUsuario" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdicionaUsuario">+</button>
        </div>
    </div>

    <div id="divUsuariosDisponiveisPesquisa" class="container">
        <h4 class="text-center">Resultado da pesquisa</h4>
        <div id="usuariosDisponiveisPesquisa" class="container">

        </div>
    </div>


    <?php //print_r($_SESSION['accessToken']);
	//print_r($pegaClientes);
    ?>
    <br />
    <button id="botaoVoltaUsuarios" class="btn btn-primary" onclick="history.back()">Voltar</button>

    <div class="modal fade" id="modalAdicionaUsuario" tabindex="-1" role="dialog" aria-labelledby="modalUsuario" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h3 class="modal-title" id="modalConv">
							<!-- <img width="40px" height="40px" src="images/convite.png"/> -->
							<b>&nbsp; Adicionar usuário</b>
						</h3>
					</div>
					<div class="modal-body">
						<p>
							<h5>
								Digite o nome, CPF ou o código do(a) aluno(a) que deseja adicionar em uma turma.
							</h5>
                            <br/>
                            <br/>
							<input type="text" id="campoPesquisaAluno" class="form-control" placeholder="Nome, CPF ou código do aluno(a)."/>
						</p>
						<div class="alert alert-danger" id="div-erro" role="alert" style="display:none">
							<b id="erro"></b>
						</div>
						<div class="loader"></div>
						<br/>

						<div class="alert alert-warning" id="div-not-found" style="display:none"> 
							<b>Aluno(a) não encontrado na base. Deseja cadastrá-lo(a)?</b>
							<br/>
							<br/>
							<button class="btn btn-default" id="cancel-registration" style="width: 32%;margin-right:18%;margin-left:5%">Não</button>
							<button class="btn btnUltra" id="proceed-registration"style="width: 32%;">Sim</button>
						</div>
						<div class="table-responsive">
							<table class="table table-hover" style="height:34%; display: none; width:100%;" id="tabela-convidado">
								<thead>
									<tr>
										<th style="position: sticky; top:0">Foto</th>
										<th style="position: sticky; top:0">Cód. Aluno</th>
										<th style="position: sticky; top:0">Nome</th>
										<th style="position: sticky; top:0">CPF</th>
										<th style="position: sticky; top:0">Status</th>
									</tr>
								</thead>
								<tbody id="corpo-tabela-convites"></tbody>
							</table>
						</div>
					</div>
					<div class="modal-footer" >
						<button type="button" class="btn btn-default close" data-dismiss="modal">Cancelar</button>
						<button type="button" class="btn btn-primary" id="btnPesquisaAluno" >Pesquisar</button>
					</div>
				</div>
			</div>
		</div>
</body>
<script type="text/javascript" src="../View/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="../View/js/jquery-3.6.1.min.js?d=<?php echo uniqid() ?>"></script>

</html>