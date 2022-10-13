<?php

namespace Services;

require_once(__DIR__."/../Services/Spivi.php");

use Controller\ControllerFuncoes;
use Model\Database;
use Services\Spivi;

class ServicesEventoSpivi extends Spivi{

    public function __construct(ControllerFuncoes $controllerFuncoes,Database $database, string $codUnidade){
        parent::__construct($controllerFuncoes, $database, $codUnidade);
    }

    public function getEvents() : object
    {
        $this->authSpivi();

        $request = array_merge(array("SourceCredentials"=>$this->getSourceCredentials()));
        
        $results = $this->getFuncoes()->formataRetorno($this->getPest()->post('EventService/GetEvents',$request));

        $events = $results->Events;

        $this->unsetSpivi();

        return $events;
    }
}
?>
