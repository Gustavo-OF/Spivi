<?php 

require_once("Services/ServicesClienteSpivi.php");
require_once("Controller/ControllerFuncoes.php");
require_once("Controller/ControllerCliente.php");
require_once("Model/Database.php");
require_once("Routes/Rotas.php");
require_once __DIR__.'/vendor/autoload.php';

if(session_status() === PHP_SESSION_NONE){
    session_start();
}

$codUnidade = isset($_SESSION['codUnidadeUser']) ? $_SESSION['codUnidadeUser'] : "00";

use Services\ServicesClienteSpivi;
use Controller\ControllerFuncoes;
use Model\Database;
use Controller\ControllerCliente;
use Route\Rotas;

$database = new Database("ux");
$controllerFuncoes = new ControllerFuncoes();
$serviceClienteSpivi = new ServicesClienteSpivi($controllerFuncoes,$database,$codUnidade);
$controllerCliente = new ControllerCliente($serviceClienteSpivi);
$rotas = new Rotas($controllerCliente);

$rotas->abrir($_REQUEST);



?>