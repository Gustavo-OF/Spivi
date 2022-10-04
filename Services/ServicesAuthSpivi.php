<?php

namespace Services;

use Pest;
use Controller\ControllerFuncoes;
use ControllerAuth;

class ServicesAuthSpivi{
    private $pest;
    private $funcoes;

    public function __construct(ControllerFuncoes $controllerFuncoes){
        $this->pest = new Pest('https://api.spivi.com');
        $this->funcoes = $controllerFuncoes;
    }

    public function auth($sourceName, $password, $siteId) : object
    {
        $sourceCredentials = array(
            "SourceName" => $sourceName,
            "Password" => $password,
            "SiteID" => $siteId
        );
        
        $params = [
            "SearchText" => "Francis"
        ];
        
        $request = array_merge(array("SourceCredentials"=>$sourceCredentials),$params);
        
        $results = $this->funcoes->formataRetorno($this->pest->post('ClientService/GetClients',$request));
        
        $clients = $results->Clients;

        return $clients;
    }
}
?>
