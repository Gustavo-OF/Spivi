<?php

namespace Controller;

use Services\ServicesEventoSpivi;

class ControllerEventoSpivi{
    private ServicesEventoSpivi $serviceEventoSpivi;

    public function __construct(ServicesEventoSpivi $serviceEventoSpivi){
        $this->serviceEventoSpivi = $serviceEventoSpivi;
    }

    public function getEvents()
    {
        return json_encode($this->serviceEventoSpivi->getEvents());
    }
}