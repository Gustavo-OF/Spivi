<?php

namespace Route;

use Controller\ControllerCliente;
use Controller\ControllerFuncoes;
use Model\Database;
use Services\ServicesClienteSpivi;

class Rotas
{
    private Database $database;
    private ControllerFuncoes $controllerFuncoes;
    private ServicesClienteSpivi $servicesClienteSpivi;
    private ControllerCliente $ControllerCliente;

    public function __construct(
        Database $database, 
        ControllerFuncoes $controllerFuncoes, 
        ServicesClienteSpivi $servicesClienteSpivi, 
        ControllerCliente $ControllerCliente
    )
    {
        $this->database = $database;
        $this->controllerFuncoes = $controllerFuncoes;
        $this->servicesClienteSpivi = $servicesClienteSpivi;
        $this->ControllerCliente = $ControllerCliente;
    }

    public function abrir($req)
    {
        $json = file_get_contents('php://input');
        $obj = json_decode($json);

        $url = explode("/", $req['url']);
        $classe = $url[0] ?? "";
        array_shift($url);

        $metodo = implode(" ", $url);
        echo $classe." ".$metodo;
        switch($classe){
            case "index":
            case "Index":
            case "INDEX":
                switch ($metodo) {
                    case 'usuarios':
                        print_r($this->ControllerCliente->getClients());
                        break;
                    default:
                        include_once __DIR__."/../view/index.php";
                        break;
                }                
        }
    }
}
