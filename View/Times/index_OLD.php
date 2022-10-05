<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../ModuloPerfil/View/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="../ModuloPerfil/View/css/bootstrap-theme.css" rel="stylesheet" type="text/css" />
    <link href="View/css/times.css?d=<?php echo uniqid()?>" rel="stylesheet" type="text/css"/>
    <title>Times - Selfloops</title>
</head>

<body>
    <div class="container" id="divImagemTime">
        <img src="View/images/teams.png" width="230" height="230" /><h3>Times</h3>
    </div>

    <div id="pesquisaTimes" class="container">
        <div class="form-group" style="width: 45%;">
            <label for="pesquisaIdTime">Pesquisar por ID:</label>
            <input class="form-control" type="text" id="pesquisaIdTime" value=""/>
        </div>
        <div class="form-group" style="width: 45%;">
            <label for="pesquisaNomeTime">Pesquisar por nome:</label>
            <input class="form-control" type="text" id="pesquisaNomeTime" value=""/>
        </div>
        <button id="botaoPesquisaTime" class="btn btn-primary">Buscar</button>
    </div>
    <div id="divTimesDisponiveisPesquisa" class="container">
        <h4 class="text-center">Resultado da pesquisa</h4>
        <div id="timesDisponiveisPesquisa" class="container">

        </div>
    </div>
    <div id="divTimesDisponiveis" class="container">
        <h4 class="text-center">Todos os times cadastrados</h4>
        <?php for($i = 0;$i<=count($times);$i++){?>
        <div id="timesDisponiveis" class="container">
            <label for="idTime">ID do time: </label><h5 class="idTime"><?php echo $times['teams'][$i]['id']?></h5><br/>
            <label for="nomeTime">Nome do time: </label><h5 class="nomeTime"><?php echo $times['teams'][$i]['fullname']?></h5><br/>
            <label for="descricaoTime">Descrição do time: </label><h5 class="descricaoTime"><?php echo $times['teams'][$i]['full_description']?></h5>
        </div>
        <?php } ?>
    </div>
    <br />
    <h5>
        <a href="#" onclick="history.back()">
            < Voltar
        </a>
    </h5>
</body>
<script type="text/javascript" src="../js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="View/js/times.js?d=<?php echo uniqid()?>"></script>
</html>