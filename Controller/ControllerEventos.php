<?php

namespace Controller;

require_once(__DIR__."/../Model/AuthSpivi.php");

use Model\AuthSpivi;
use Model\Database;
use Services\ServicesAuthSpivi;

class ControllerAuth{
    private ServicesAuthSpivi $servicesAuthSpivi;
    private Database $database;

    public function __construct(ServicesAuthSpivi $servicesAuthSpivi, Database $database){
        $this->servicesAuthSpivi = $servicesAuthSpivi;
        $this->database = $database;
    }

    public function getCredentials($codUnidade = "00"): string{
        $this->database->connect();
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

        ob_start();
        include __DIR__."/../View/index.php";
        return ob_get_clean(); 
    }
}