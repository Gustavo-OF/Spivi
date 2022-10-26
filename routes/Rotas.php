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

        //$req['url'] = explode("/ControlGym/View/Spivi/",$req['SCRIPT_URL']);

        // if(isset($req['url'][1])){
        //     $url = explode("/", $req['url'][1]);    
        // }else{
        //     $url = "";
        // }
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
                            case 'pesquisa_professor':
                                echo $this->controllerClienteSpivi->getInstructors();
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
                    case 'eventos':
                        switch($metodo){
                            case 'pesquisa_evento':
                                echo $this->controllerEventoSpivi->getEvents($_GET);
                            break;
                            case 'pesquisa_evento_id':
                                echo $this->controllerEventoSpivi->getEventsById($_GET);
                            break;
                            case 'insere_evento':
                                echo $this->controllerEventoSpivi->addEvent($_POST);
                            break;
                            case 'deleta_evento':
                                echo $this->controllerEventoSpivi->deleteEvent($_POST);
                            break;
                            case 'adiciona_aluno_evento':
                                echo $this->controllerEventoSpivi->AddClientsToEvents($_POST);
                            break;
                            case 'remove_usuario_evento':
                                echo $this->controllerEventoSpivi->removeClientFromEvent($_POST);
                            break;
                            default:
                                include __DIR__."/../View/Eventos/index.php";
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
