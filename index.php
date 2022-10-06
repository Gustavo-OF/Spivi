<?php 

require_once("Model/Database.php");
require_once("Controller/ControllerFuncoes.php");
require_once("Services/ServicesClienteSpivi.php");
require_once("Services/ServicesClienteUx.php");
require_once("Controller/ControllerClienteUx.php");
require_once("Controller/ControllerClienteSpivi.php");
require_once("Routes/Rotas.php");
require_once __DIR__.'/vendor/autoload.php';

if(session_status() === PHP_SESSION_NONE){
    session_start();
}

$codUnidade = isset($_SESSION['codUnidadeUser']) ? $_SESSION['codUnidadeUser'] : "00";

use Model\Database;
use Controller\ControllerFuncoes;
use Services\ServicesClienteSpivi;
use Services\ServicesClienteUx;
use Controller\ControllerClienteUx;
use Controller\ControllerClienteSpivi;
use Route\Rotas;

$database = new Database("ux");
$controllerFuncoes = new ControllerFuncoes();
$serviceClienteSpivi = new ServicesClienteSpivi($controllerFuncoes,$database,$codUnidade);
$serviceClientesUx = new ServicesClienteUx($database,$controllerFuncoes);
$controllerClienteSpivi = new ControllerClienteSpivi($serviceClienteSpivi);
$controllerClienteUx = new ControllerClienteUx($serviceClientesUx);
$rotas = new Rotas($controllerClienteSpivi,$controllerClienteUx);

$rotas->abrir($_REQUEST);



?>