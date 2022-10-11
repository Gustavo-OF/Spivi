<?php

namespace Services;

require_once(__DIR__."/../Model/AuthSpivi.php");

use Model\AuthSpivi;
use Pest;
use Controller\ControllerFuncoes;
use Model\Database;

class Spivi{
    private Pest $pest;
    private ControllerFuncoes $funcoes;
    private array $sourceCredentials;
    private Database $database;
    private AuthSpivi $authSpivi;
    private string $codUnidade;

    public function __construct(ControllerFuncoes $controllerFuncoes,Database $database, string $codUnidade){
        $this->pest = new Pest('https://api.spivi.com');
        $this->funcoes = $controllerFuncoes;
        $this->database = $database;
        $this->codUnidade = $codUnidade;
    }

    /**
     * Get the value of pest
     */ 
    public function getPest()
    {
        return $this->pest;
    }

    /**
     * Get the value of funcoes
     */ 
    public function getFuncoes()
    {
        return $this->funcoes;
    }

    /**
     * Get the value of sourceCredentials
     */ 
    public function getSourceCredentials()
    {
        return $this->sourceCredentials;
    }

    protected function authSpivi(){
        if(empty($this->authSpivi)){
            if(!$this->database->connect()){
                $this->database->connect();
            };
    
            $this->credenciais = $this->database->select("TB_AUTH_SPIVI","*",[],"COD_UNIDADE = ?",[$this->codUnidade]);
    
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
            $this->database->disconnect();
        }
    }

    protected function unsetSpivi(){
        unset($this->authSpivi);
    }
}


?>