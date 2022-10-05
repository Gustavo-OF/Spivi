<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../ModuloPerfil/View/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="../ModuloPerfil/View/css/bootstrap-theme.css" rel="stylesheet" type="text/css" />
    <link href="View/css/usuarios.css?d=<?php echo uniqid() ?>" rel="stylesheet" type="text/css" />
    <title>Usuários - Selfloops</title>
</head>

<body>
    <div class="container" id="divImagemTime">
        <img src="View/images/usuario.png" width="230" height="230" />
        <h3>Usuários</h3>
    </div>

    <div id="pesquisaUsuarios" class="container">
        <div class="form-group" style="width: 45%;">
            <label for="pesquisaIdUsuario">Pesquisar por ID:</label>
            <input class="form-control" type="text" id="pesquisaIdUsuario" value="" />
        </div>
        <div class="form-group" style="width: 45%;">
            <label for="pesquisaNomeUsuario">Pesquisar por nome:</label>
            <input class="form-control" type="text" id="pesquisaNomeUsuario" value="" />
        </div>
        <button id="botaoPesquisaUsuario" class="btn btn-primary">Buscar</button>
        <button id="adicionaUsuario" style="margin-top:1rem" class="btn btn-primary" data-toggle="modal" data-target="#modalAdicionaUsuario">+</button>
    </div>

    <div id="divUsuariosDisponiveisPesquisa" class="container">
        <h4 class="text-center">Resultado da pesquisa</h4>
        <div id="usuariosDisponiveisPesquisa" class="container">

        </div>
    </div>

    <div id="divUsuariosDisponiveis" class="container">
        <h4 class="text-center">Todos os usuários cadastrados</h4>
        <?php for ($i = 0; $i < $usuarios['count']; $i++) { ?>
            <div id="timesDisponiveis" class="container">
                <label for="idUsuario">ID do usuário: </label>
                <h5 id="idUsuario"><?php echo $usuarios['users'][$i]['id'] ?></h5><br />
                <label for="nomeUsuario">Nome do usuário: </label>
                <h5 id="nomeUsuario"><?php echo $usuarios['users'][$i]['firstname'] . " " . $usuarios['users'][$i]['lastname'] ?></h5><br />
                <label for="descricaoUsuario">Email: </label>
                <h5 id="descricaoUsuario"><?php echo $usuarios['users'][$i]['email'] ?></h5><br />
                <label for="timesUsuario">Times do usuário: </label>
                <?php for ($c = 0; $c < count($usuarios['users'][$i]['teams']); $c++) { ?>

                    <h5 id="timesUsuario"><?php echo $usuarios['users'][$i]['teams'][$c]['name'] . " |" ?></h5>
                <?php } ?>
                <div id="acoes" class="pull-right" style="margin-bottom: 1rem;margin-top:-10px;display:inline;">
                    <button type="button" id="editaUser" class="btn btn-warning btn-sm">
                        <img src="View/images/icons/pencil-square.svg" width="25" height="25">
                    </button>
                    <button type="button" data-toggle="modal" data-target="#exampleModal<?php echo $i ?>" class="btn btn-danger btn-sm">
                        <img src="View/images/icons/x.svg" width="25" height="25">
                    </button>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal<?php echo $i ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="exampleModalLabel"><b>Escolha o time que deseja remover o aluno <?php echo $usuarios['users'][$i]['firstname'] . " " . $usuarios['users'][$i]['lastname'] ?>.</b></h3>
                        </div>
                        <div class="modal-body">
                            <?php for ($c = 0; $c < count($usuarios['users'][$i]['teams']); $c++) { ?>
                                <input type="checkbox" data-idU="<?php echo $usuarios['users'][$i]['id'] ?>" class="form-check-input timesUsuario" id="team<?php echo $i . $c ?>" value="<?php echo $usuarios['users'][$i]['teams'][$c]['id'] ?>">
                                <label class="form-check-label" for="team<?php echo $i . $c ?>"><?php echo $usuarios['users'][$i]['teams'][$c]['fullname'] ?></label><br />
                            <?php } ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-danger deletaTimeUser">Deletar</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <?php //print_r($_SESSION['accessToken']);
    ?>
    <br />
    <h5>
        <a href="#" onclick="history.back()">
            < Voltar </a>
    </h5>

    <!-- <div class="modal fade bd-example-modal-lg" id="modalAdicionaUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Adicionar usuário</h3>
                </div>
                <div class="modal-body">
                    <h4>Digite o CPF, nome ou código do aluno para adicionar em uma turma.</h4>
                    <br />
                    <input type="text" class="form-control" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" id="btnPesquisaAluno">Pesquisar</button>
                </div>
            </div>
        </div>
    </div> -->
    <div class="modal fade bd-example-modal-lg" data-keyboard="false" data-backdrop="static" id="modalAdicionaUsuario" tabindex="-1" role="dialog" aria-labelledby="modalUsuario">
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
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
						<button type="button" class="btn btn-primary" id="btnPesquisaAluno" >Pesquisar</button>
					</div>
				</div>
			</div>
		</div>
</body>
<script type="text/javascript" src="../js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.js"></script>
<script type="text/javascript" src="View/js/usuarios.js?d=<?php echo uniqid() ?>"></script>

</html>