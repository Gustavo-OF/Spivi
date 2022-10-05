<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="View/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="View/css/times.css?d=<?php echo uniqid() ?>" rel="stylesheet" type="text/css" />
    <title>Times - Selfloops</title>
</head>

<body>
    <div id="pesquisaTimes" class="card">
        <div class="card-header">
            <div class="pull-left">
                <h6 class="panel-title txt-dark">Times - Selfloops</h6>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <label for="pesquisaNomeTime">Nome do time:</label>
                    <input class="form-control w-75" type="text" id="pesquisaNomeTime" value="" />
                </div>
                <div class="col-md-6">
                    <label for="pesquisaIdTime">ID do time:</label>
                    <input class="form-control w-75" type="text" id="pesquisaIdTime" value="" />
                </div>
            </div>
            <br/>
            <button id="botaoPesquisaTime" class="btn btn-primary">Buscar</button>
        </div>
    </div>
    <br />
    <div class="card" id="cardPesquisaTime" style="display: none;">
        <div class="card-header">
            <div class="pull-left">
                <h6 class="panel-title txt-dark">Resultado da pesquisa</h6>
            </div>
        </div>
        <div class="table-wrap table-wrapper-scroll-y my-custom-scrollbar">
            <table id="tabela_01" class="table" data-filtering="true" data-sorting="true" data-paging="true" data-paging-position="left" data-paging-size="400" data-paging-container="#paging-ui-container" data-filter-placeholder="Buscar">
                <thead>
                    <tr>
					    <th data-breakpoints="xs" data-name="id">Id</th>
                        <th data-breakpoints="xs" data-name="nomeTime">Nome do time</th>
                        <th data-breakpoints="xs" data-name="descricao">Descrição</th>
                    </tr>
                </thead>
                <tbody id="corpoTabelaTime">
                    
                </tbody>
            </table>
        </div>
    </div>
        <button id="botaoVoltaTimes" class="btn btn-primary" onclick="history.back()">Voltar</button>
</body>
<script type="text/javascript" src="View/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="../js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="View/js/times.js?d=<?php echo uniqid() ?>"></script>

</html>