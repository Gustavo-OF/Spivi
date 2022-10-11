<?php

namespace Services;

require_once(__DIR__."/../Services/Spivi.php");

use Controller\ControllerFuncoes;
use Model\Database;
use Services\Spivi;

class ServicesClienteSpivi extends Spivi{

    public function __construct(ControllerFuncoes $controllerFuncoes,Database $database, string $codUnidade){
        parent::__construct($controllerFuncoes, $database, $codUnidade);
    }

    public function getClients($params) : object
    {
        $this->authSpivi();

        $params = [
            "SearchText" => $params
        ];
        
        $request = array_merge(array("SourceCredentials"=>$this->getSourceCredentials()),$params);
        
        $results = $this->getFuncoes()->formataRetorno($this->getPest()->post('ClientService/GetClients',$request));
        
        $clients = $results->Clients;

        $this->unsetSpivi();
        
        return $clients;
    }
}
?>
