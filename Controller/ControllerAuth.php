<?php

namespace Controller;

require_once(__DIR__."/../Model/AuthSpivi.php");

use Model\AuthSpivi;
use Model\Database;
use Services\ServicesAuthSpivi;

class ControllerAuth{
    private $controller;
    private $servicesAuthSpivi;
    private $database;

    public function __construct(ServicesAuthSpivi $servicesAuthSpivi, Database $database){
        $this->servicesAuthSpivi = $servicesAuthSpivi;
        $this->database = $database;
    }

    public function getCredentials($codUnidade = "00"){
        $credenciais = $this->database->select("TB_AUTH_SPIVI","*","COD_UNIDADE = ?",[$codUnidade]);
        $authSpivi = new AuthSpivi(
            $credenciais[0]['COD_UNIDADE'],
            $credenciais[0]['SOURCE_NAME'],
            $credenciais[0]['PASSWORD'],
            $credenciais[0]['SITE_ID']
        );
        $pegaClientes = $this->servicesAuthSpivi->auth(
            $authSpivi->getSourceName(),
            $authSpivi->getPassword(),
            $authSpivi->getSiteId()
        );
        return $pegaClientes; 
    }
}