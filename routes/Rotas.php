<?php

namespace Route;

use Controller\ControllerCliente;

class Rotas
{
    private ControllerCliente $ControllerCliente;

    public function __construct(
        ControllerCliente $ControllerCliente
    )
    {
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
