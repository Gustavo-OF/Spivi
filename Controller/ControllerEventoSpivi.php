<?php

namespace Controller;

use DateTime;
use Services\ServicesEventoSpivi;

class ControllerEventoSpivi{
    private ServicesEventoSpivi $serviceEventoSpivi;

    public function __construct(ServicesEventoSpivi $serviceEventoSpivi){
        $this->serviceEventoSpivi = $serviceEventoSpivi;
    }

    public function getEvents(array $params)
    {
        $data_ini = new DateTime($params['data_ini']);
        $data_fim = new DateTime($params['data_fim']);
        $eventos = $this->serviceEventoSpivi->getEvents($data_ini, $data_fim);
        return json_encode($eventos);
    }

    public function addEvent(array $params)
    {
        $nomeEvento = $params['nome'];
        $data_ini = new Datetime($params['data_inicial']);
        $data_fim = new Datetime($params['data_fim']);
        $professor_username = $params['professor'];
        $descricao = $params['descricao'];

        $addEvent = $this->serviceEventoSpivi->addEvent($nomeEvento, $data_ini, $data_fim, $professor_username, $descricao);

        return json_encode($addEvent);
    }
}