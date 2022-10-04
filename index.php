<?php 

require_once("Services/ServicesAuthSpivi.php");
require_once("Controller/ControllerFuncoes.php");
require_once("Controller/ControllerAuth.php");
require_once("Model/Database.php");
require_once __DIR__.'/vendor/autoload.php';

use Services\ServicesAuthSpivi;
use Controller\ControllerFuncoes;
use Model\Database;
use Controller\ControllerAuth;

$database = new Database("ux");
$controllerFuncoes = new ControllerFuncoes();
$serviceSpivi = new ServicesAuthSpivi($controllerFuncoes);
$controllerAuth = new ControllerAuth($serviceSpivi,$database);





if($database->connect()){
    // print_r($database->select("TB_PESSOAS","ID_PESSOAS","COD_ALUNO = ?",["22467400"]));
    print_r($controllerAuth->getCredentials());
    $database->disconnect();
}
die();



?>