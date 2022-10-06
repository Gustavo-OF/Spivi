<?php 

namespace Controller;

use Services\ServicesClienteUx;

class ControllerClienteUx{

    private ServicesClienteUx $servicesClienteUx;

    public function __construct(ServicesClienteUx $servicesClienteUx)
    {
        $this->servicesClienteUx = $servicesClienteUx;
    }
    
    public function getClientsUx($parametro,$codUnidade):string {
        $retorno = $this->servicesClienteUx->getClientsUx($parametro,$codUnidade);
        $contaPessoas = count($retorno);
        for($i = 0; $i < $contaPessoas;$i++){
            $nomeCliente = explode(" ",$retorno[$i]['NOME']);
            $contaNomes = count($nomeCliente);
            $retorno[$i]['NOME_INICIAL'] = ucwords(strtolower($nomeCliente[0]));
            $retorno[$i]['NOME_FINAL'] = ucwords(strtolower($nomeCliente[$contaNomes-1]));
        }
        return json_encode($retorno);
    }

}



?>