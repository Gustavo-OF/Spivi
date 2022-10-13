<?php

namespace Route;

use Controller\ControllerClienteSpivi;
use Controller\ControllerClienteUx;
use Controller\ControllerEventoSpivi;

class Rotas
{
    private ControllerClienteSpivi $controllerClienteSpivi;
    private ControllerClienteUx $controllerClienteUx;
    private ControllerEventoSpivi $controllerEventoSpivi;
    
    /**
     * Construtor
     *
     * @return void
     */
    public function __construct(
        ControllerClienteSpivi $controllerClienteSpivi,
        ControllerClienteUx $controllerClienteUx,
        ControllerEventoSpivi $controllerEventoSpivi
    )
    {
        $this->controllerClienteSpivi = $controllerClienteSpivi;
        $this->controllerClienteUx = $controllerClienteUx;
        $this->controllerEventoSpivi = $controllerEventoSpivi;
    }
    
    /**
     * Método para redirecionar a requisição. Recebe $_REQUEST como parametro
     *
     * @param  mixed $req
     * @return void
     */
    public function abrir($req)
    {
        // em producao dar explode no script_url
        
        $json = file_get_contents('php://input');
        $obj = json_decode($json);

        if(isset($req['url'])){
            $url = explode("/", $req['url']);    
        }else{
            $url = "";
        }

        $index = isset($url[0]) ? $url[0] : "";
        $classe = isset($url[1]) ? $url[1] : "";
        $metodo = isset($url[2]) ? $url[2] : "";
        //echo $classe." ".$metodo;
        switch($index){
            case "":
            case "index":
            case "Index":
            case "INDEX":
                switch ($classe) {
                    case 'usuarios':
                        switch($metodo){
                            case 'pesquisa_nome':
                                echo $this->controllerClienteSpivi->getClientsByName($_GET['valor']);
                                break;
                            case 'pesquisa_email':
                                echo $this->controllerClienteSpivi->getClientsByMail($_GET['valor']);
                                break;
                            case 'pesquisa_aluno_ux':
                                echo $this->controllerClienteUx->getClientsUx($_GET['valor'],$_GET['cod_unidade']);
                                break;
                            case 'insere_usuario_spivi':
                                echo $this->controllerClienteSpivi->insertNewClient($_POST);
                                break;
                            case 'atualiza_aluno':
                                echo $this->controllerClienteSpivi->updateClient($_POST);
                            break;
                            case 'deleta_aluno':
                                echo $this->controllerClienteSpivi->deleteClient($_POST);
                            break;
                            case 'pesquisa_performance':
                                echo $this->controllerClienteSpivi->getPerformanceDataClient($_GET);
                            break;
                            default:
                                include __DIR__."/../View/Clientes/index.php";
                                break;
                        }
                        break;
                    case 'performance':
                        switch($metodo){
                            default:
                                include __DIR__."/../View/Performance/index.php";
                                break;
                        }
                        break;
                    case 'evento':
                        switch($metodo){
                            case 'pesquisa_evento':
                                echo $this->controllerEventoSpivi->getEvents();
                                break;
                        }
                        break;
                }
            default:
                if(empty($classe)){
                    include_once __DIR__."/../view/index.php";
                }
                break;                
        }
    }
}
