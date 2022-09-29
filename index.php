<?php 

require_once("Services/ServicesAuthSpivi.php");
require_once("Controller/ControllerFuncoes.php");
require_once __DIR__.'/vendor/autoload.php';

use Services\ServicesAuthSpivi;
use Controller\ControllerFuncoes;

$controllerFuncoes = new ControllerFuncoes();
$serviceSpivi = new ServicesAuthSpivi($controllerFuncoes);

print_r($serviceSpivi->auth("00"));

?>