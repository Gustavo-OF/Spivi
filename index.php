<?php 

require_once("Services/ServicesAuthSpivi.php");
require_once("Controller/ControllerFuncoes.php");
require_once("Controller/ControllerAuth.php");
require_once("Model/Database.php");
require_once("Routes/Rotas.php");
require_once __DIR__.'/vendor/autoload.php';

use Services\ServicesAuthSpivi;
use Controller\ControllerFuncoes;
use Model\Database;
use Controller\ControllerAuth;
use Route\Rotas;

$database = new Database("ux");
$controllerFuncoes = new ControllerFuncoes();
$serviceSpivi = new ServicesAuthSpivi($controllerFuncoes);
$controllerAuth = new ControllerAuth($serviceSpivi,$database);
$rotas = new Rotas($database,$controllerFuncoes,$serviceSpivi,$controllerAuth);

$rotas->abrir($_REQUEST);



?>