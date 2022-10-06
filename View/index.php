<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="View/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <title>Spivi - Ultra</title>
</head>
<body>
    <div class="container" style="display:flex;justify-content:space-around">
        <img src="View/images/spivi.png" width="250" height="250" />
    </div>
    <br/>
    <div class="container" >
    <span class="border rounded" style="display:flex;justify-content:space-between;color:grey" >
        <div class="container" style="width:20%;display:flex;justify-content:space-around;margin-top:1%">
            <a href="index/usuarios" style=" text-decoration: none;"><img src="View/images/usuario.png" alt="usuarioSpivi" width="90" height="90"/>
                <h5 class="text-center" style="color:black">Clientes</h5>
            </a>
        </div>
        <div class="container" style="width:20%;display:flex;justify-content:space-around;margin-top:1%" >
            <a href="index.php?tipo=times" style=" text-decoration: none;"><img src="View/images/teams.png" alt="clubesSpivi" width="90" height="90"/>
                <h5 class="text-center" style="color:black">Clubes</h5>
            </a>
        </div>
        <div class="container" style="width:20%;display:flex;justify-content:space-around;margin-top:1%" >
            <a href="index.php?tipo=sensores" style=" text-decoration: none;"><img src="View/images/sensor.png" alt="sensorSpivi" width="90" height="90"/>
                <h5 class="text-center" style="color:black">Eventos</h5>
            </a>
        </div>
        <!-- <p> Clique <a href="index.php?tipo=sair">aqui</a> para sair</p> -->
    </div>
    </span>
</body>
<script type="text/javascript" src="View/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="View/js/jquery-3.6.1.min.js?d=<?php echo uniqid() ?>"></script>
</html>