<?php 

namespace Controller;

use SimpleXMLElement;

class ControllerFuncoes{

    public function __construct(){

    }

    public function formataRetorno($data) : SimpleXMLElement
    {

        $xml = new SimpleXMLElement($data);
        return $xml;
    }
}
?>