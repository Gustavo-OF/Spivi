<?php

namespace Services;

require_once(__DIR__."/../Model/AuthSpivi.php");

use Model\AuthSpivi;
use Pest;
use Controller\ControllerFuncoes;
use Model\Database;


class ServicesClienteSpivi{
    private Pest $pest;
    private ControllerFuncoes $funcoes;
    private array $sourceCredentials;
    private Database $database;
    private AuthSpivi $authSpivi;


    public function __construct(ControllerFuncoes $controllerFuncoes,Database $database, string $codUnidade){
        $this->pest = new Pest('https://api.spivi.com');
        $this->funcoes = $controllerFuncoes;

        $this->database = $database;

        if(!$this->database->connect()){
            $this->database->connect();
        };

        $this->credenciais = $this->database->select("TB_AUTH_SPIVI","*","COD_UNIDADE = ?",[$codUnidade]);

        $this->authSpivi = new AuthSpivi(
            $this->credenciais[0]['COD_UNIDADE'],
            $this->credenciais[0]['SOURCE_NAME'],
            $this->credenciais[0]['PASSWORD'],
            $this->credenciais[0]['SITE_ID']
        );

        $this->sourceCredentials = array(
            "SourceName" => $this->authSpivi->getSourceName(),
            "Password" => $this->authSpivi->getPassword(),
            "SiteID" => $this->authSpivi->getSiteId()
        );
    }

    public function getClients($params) : object
    {
        
        $params = [
            "SearchText" => $params
        ];
        
        $request = array_merge(array("SourceCredentials"=>$this->sourceCredentials),$params);
        
        $results = $this->funcoes->formataRetorno($this->pest->post('ClientService/GetClients',$request));
        
        $clients = $results->Clients;

        return $clients;
    }
}
?>
