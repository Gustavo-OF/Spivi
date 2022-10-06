<?php

namespace Route;

use Controller\ControllerClienteSpivi;
use Controller\ControllerClienteUx;

class Rotas
{
    private ControllerClienteSpivi $controllerClienteSpivi;
    private ControllerClienteUx $controllerClienteUx;
    
    /**
     * Construtor
     *
     * @return void
     */
    public function __construct(
        ControllerClienteSpivi $controllerClienteSpivi,
        ControllerClienteUx $controllerClienteUx
    )
    {
        $this->controllerClienteSpivi = $controllerClienteSpivi;
        $this->controllerClienteUx = $controllerClienteUx;
    }
    
    /**
     * Método para redirecionar a requisição. Recebe $_REQUEST como parametro
     *
     * @param  mixed $req
     * @return void
     */
    public function abrir($req)
    {
        $json = file_get_contents('php://input');
        $obj = json_decode($json);

        $url = explode("/", $req['url']);

        $index = isset($url[0]) ? $url[0] : "";
        $classe = isset($url[1]) ? $url[1] : "";
        $metodo = isset($url[2]) ? $url[2] : "";
        //echo $classe." ".$metodo;
        switch($index){
            case "index":
            case "Index":
            case "INDEX":
                switch ($classe) {
                    case 'usuarios':
                        switch($metodo){
                            case 'pesquisa_nome':
                                echo $this->controllerClienteSpivi->getClients($_GET['valor']);
                                break;
                            case 'pesquisa_email':
                                
                                break;
                            case 'pesquisa_aluno_ux':
                                echo $this->controllerClienteUx->getClientsUx($_GET['valor'],$_GET['cod_unidade']);
                                break;
                            default:
                                include __DIR__."/../View/Clientes/index.php";
                                break;
                        }
                }
            default:
                if(empty($classe)){
                    include_once __DIR__."/../view/index.php";
                }
                break;                
        }
    }
}
