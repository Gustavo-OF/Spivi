<?php

namespace Services;

require_once(__DIR__."/../Services/Spivi.php");

use Controller\ControllerFuncoes;
use DateTime;
use Model\Database;
use Services\Spivi;

class ServicesEventoSpivi extends Spivi{

    public function __construct(ControllerFuncoes $controllerFuncoes,Database $database, string $codUnidade){
        parent::__construct($controllerFuncoes, $database, $codUnidade);
    }

    public function getEvents(DateTime $data_ini, DateTime $data_fim) : object
    {
        $this->authSpivi();

        $params = [
            "StartDateTime" => $data_ini->format('d-m-Y')."T00:00",
            "EndDateTime" => $data_fim->format('d-m-Y')."T23:59",
        ];

        $request = array_merge(array("SourceCredentials"=>$this->getSourceCredentials()),$params);
        
        $results = $this->getFuncoes()->formataRetorno($this->getPest()->post('EventService/GetEvents',$request));

        $events = $results->Events;

        $this->unsetSpivi();

        return $events;
    }

    public function addEvent(
        string $nomeEvento, 
        Datetime $data_ini, 
        Datetime $data_fim, 
        string $professor_username, 
        string $descricao
    )
    {
        $this->authSpivi();

        $params = [
            "Title" => $nomeEvento,
            "StartDateTime" => $data_ini->format("d-m-Y")."T".$data_ini->format("H:i"),
            "EndDateTime" => $data_fim->format('d-m-Y')."T".$data_fim->format("H:i"),
            "Description" => $descricao,
            "InstructorUserName" => $professor_username,
            "BoxID" => $this->getAuthSpivi()->getBoxIdCycling()
        ];
        $request = array_merge(array("SourceCredentials"=>$this->getSourceCredentials()),$params);
        
        $results = $this->getFuncoes()->formataRetorno($this->getPest()->post('EventService/AddEvent',$request));

        $events = $results->Events;

        $this->unsetSpivi();

        return $events;
    }
}
?>
