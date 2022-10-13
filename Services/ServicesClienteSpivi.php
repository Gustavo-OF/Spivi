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

    public function getClients(string $format, string $params) : object
    {
        $this->authSpivi();

        $params = [
            $format => $params
        ];
        
        $request = array_merge(array("SourceCredentials"=>$this->getSourceCredentials()),$params);
        
        $results = $this->getFuncoes()->formataRetorno($this->getPest()->post('ClientService/GetClients',$request));
        
        $clients = $results->Clients;

        $this->unsetSpivi();
        
        return $clients;
    }

    public function insertNewClient(
        $username, 
        $password, 
        $gender, 
        $firstname, 
        $lastname, 
        $endereco, 
        $cidade, 
        $country,
        $birthdate,
        $celular
    ) : object
    {
        $this->authSpivi();

        $params = [
            "Username" => $username,
            "Password" => $password,
            "Gender" => $gender,
            "FirstName" => $firstname,
            "LastName" => $lastname,
            "Address" => $this->getFuncoes()->remover_Injection($endereco),
            "City" => $this->getFuncoes()->remover_Injection($cidade),
            "Country" => $country,
            "BirthDate" => $birthdate,
            "Phone" => $celular
        ];

        $request = array_merge(array("SourceCredentials"=>$this->getSourceCredentials()),$params);
        
        $results = $this->getFuncoes()->formataRetorno($this->getPest()->post('ClientService/AddClient',$request));
        
        $this->unsetSpivi();

        return $results;
    }

    public function updateClient(
       string $username, 
       string $firstname, 
       string $lastname, 
       string $endereco, 
       string $cidade, 
       string $celular,
       int $peso,
       int $altura,
       int $ftp,
       int $rhr,
       int $pst,
       int $lthr
    ) : object{
        $this->authSpivi();

        $params = [
            "Username" => $username,
            "FirstName" => $firstname,
            "LastName" => $lastname,
            "Address" => $this->getFuncoes()->remover_Injection($endereco),
            "City" => $this->getFuncoes()->remover_Injection($cidade),
            "Phone" => $celular,
            "Weight" => $peso,
            "Height" => $altura,
            "FTP" => $ftp,
            "RHR" => $rhr,
            "PST" => $pst,
            "LTHR" => $lthr
        ];

        $request = array_merge(array("SourceCredentials"=>$this->getSourceCredentials()),$params);
        
        $results = $this->getFuncoes()->formataRetorno($this->getPest()->post('ClientService/UpdateClient',$request));
        
        $this->unsetSpivi();

        return $results;
    }

    public function deleteClient($email){
        $this->authSpivi();

        $params = [
            "Username" => $email
        ];

        $request = array_merge(array("SourceCredentials"=>$this->getSourceCredentials()),$params);
        
        $results = $this->getFuncoes()->formataRetorno($this->getPest()->post('ClientService/DelClient',$request));
        
        $this->unsetSpivi();

        return $results;
    }
}
?>
