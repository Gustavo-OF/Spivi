<?php

namespace Route;

use Controller\ControllerAuth;
use Controller\ControllerFuncoes;
use Model\Database;
use Services\ServicesAuthSpivi;

class Rotas
{
    private Database $database;
    private ControllerFuncoes $controllerFuncoes;
    private ServicesAuthSpivi $servicesAuthSpivi;
    private ControllerAuth $controllerAuth;

    public function __construct(
        Database $database, 
        ControllerFuncoes $controllerFuncoes, 
        ServicesAuthSpivi $servicesAuthSpivi, 
        ControllerAuth $controllerAuth
    )
    {
        $this->database = $database;
        $this->controllerFuncoes = $controllerFuncoes;
        $this->servicesAuthSpivi = $servicesAuthSpivi;
        $this->controllerAuth = $controllerAuth;
    }

    public function abrir($req)
    {
        $json = file_get_contents('php://input');
        $obj = json_decode($json);

        $url = explode("/", $req['url']);
        $classe = $url[0] ?? "";
        array_shift($url);

        $metodo = implode(" ", $url);

        switch($classe){
            case "index":
            case "Index":
            case "INDEX":
                print_r($this->controllerAuth->getCredentials());
                break;
        }
    }
}
