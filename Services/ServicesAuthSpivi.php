<?php

namespace Services;

use Pest;
use Controller\ControllerFuncoes;

class ServicesAuthSpivi{
    private $sourceCredentials;
    private $password;
    private $siteId;
    private $pest;
    private $funcoes;

    public function __construct(ControllerFuncoes $controllerFuncoes){
        //  Trocar para pegar do banco
        $this->sourceCredentials = "sandbox";
        $this->password = "apitest1234";
        $this->siteId = "428";
        $this->pest = new Pest('https://api.spivi.com');
        $this->funcoes = $controllerFuncoes;
    }

    public function auth($codUnidade) : object
    {
        $sourceCredentials = array(
            "SourceName" => $this->sourceCredentials,
            "Password" => $this->password,
            "SiteID" => $this->siteId);
        
        $params = [
            "SearchText" => "Francis"
        ];
        
        $request = array_merge(array("SourceCredentials"=>$sourceCredentials),$params);
        
        $results = $this->funcoes->formataRetorno($this->pest->post('ClientService/GetClients',$request));
        
        $clients = $results->Clients;

        // dump info on first client
        return $clients;
    }
}
?>
