<?php

namespace Controller;

require_once(__DIR__."/../Model/AuthSpivi.php");

use Model\AuthSpivi;
use Services\ServicesClienteSpivi;

class ControllerCliente{
    private ServicesClienteSpivi $servicesClienteSpivi;

    public function __construct(ServicesClienteSpivi $servicesClienteSpivi){
        $this->servicesClienteSpivi = $servicesClienteSpivi;        
    }

    public function getClients(): string{
        $pegaClientes = $this->servicesClienteSpivi->getClients($params = "Francis");

        ob_start();
        include __DIR__."/../View/Clientes/index.php";
        return ob_get_clean(); 
    }
}