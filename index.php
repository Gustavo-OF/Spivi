<?php 

require_once("Model/Database.php");
require_once("Controller/ControllerFuncoes.php");
require_once("Services/ServicesClienteSpivi.php");
require_once("Services/ServicesClienteUx.php");
require_once("Services/ServicesEventoSpivi.php");
require_once("Controller/ControllerClienteUx.php");
require_once("Controller/ControllerClienteSpivi.php");
require_once("Controller/ControllerEventoSpivi.php");
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
use Services\ServicesEventoSpivi;
use Controller\ControllerClienteUx;
use Controller\ControllerClienteSpivi;
use Controller\ControllerEventoSpivi;
use Route\Rotas;

$database = new Database("ux");
$controllerFuncoes = new ControllerFuncoes();
$serviceClienteSpivi = new ServicesClienteSpivi($controllerFuncoes,$database,$codUnidade);
$servicesEventoSpivi = new ServicesEventoSpivi($controllerFuncoes,$database,$codUnidade);
$serviceClientesUx = new ServicesClienteUx($database,$controllerFuncoes);
$controllerClienteSpivi = new ControllerClienteSpivi($serviceClienteSpivi);
$controllerClienteUx = new ControllerClienteUx($serviceClientesUx);
$controllerEventoSpivi = new ControllerEventoSpivi($servicesEventoSpivi);
$rotas = new Rotas($controllerClienteSpivi,$controllerClienteUx,$controllerEventoSpivi);

// em producao trocar para $_server

$rotas->abrir($_REQUEST);



?>