<?php

namespace Controller;

use Services\ServicesClienteSpivi;

class ControllerCliente{
    private ServicesClienteSpivi $servicesClienteSpivi;

    public function __construct(ServicesClienteSpivi $servicesClienteSpivi){
        $this->servicesClienteSpivi = $servicesClienteSpivi;        
    }

    public function getClients($params): string{
        $pegaClientes = $this->servicesClienteSpivi->getClients($params);

        return json_encode($pegaClientes);
    }
}