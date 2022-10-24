<?php

namespace Services;

require_once(__DIR__."/../Services/Spivi.php");

use Controller\ControllerFuncoes;
use DateTime;
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
        $celular,
        $deviceId,
        $cpf
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
            "Phone" => $celular,
            "DeviceID" => $deviceId,
            "Notes" => $cpf
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
       int $lthr,
       int $device_id
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
            "LTHR" => $lthr,
            "DeviceID" => $device_id
        ];

        $request = array_merge(array("SourceCredentials"=>$this->getSourceCredentials()),$params);
        
        $results = $this->getFuncoes()->formataRetorno($this->getPest()->post('ClientService/UpdateClient',$request));
        
        $this->unsetSpivi();

        return $results;
    }

    public function deleteClient(string $email){
        $this->authSpivi();

        $params = [
            "Username" => $email
        ];

        $request = array_merge(array("SourceCredentials"=>$this->getSourceCredentials()),$params);
        
        $results = $this->getFuncoes()->formataRetorno($this->getPest()->post('ClientService/DelClient',$request));
        
        $this->unsetSpivi();

        return $results;
    }

    public function getPerformanceDataClient(
        string $usernamme,
        DateTime $dataInicio,
        DateTime $dataFim,
        int $idEvento
    )
    {
        $this->authSpivi();

        $params = [
            "Username" => $usernamme,
            "StartDateTime" => $dataInicio->format('d-m-Y')."T00:00",
            "EndDateTime" => $dataFim->format('d-m-Y')."T23:59",
        ];

        $idEvento != 0 ? $params["EventID"] = $idEvento : "";

        $request = array_merge(array("SourceCredentials"=>$this->getSourceCredentials()),$params);
        
        $results = $this->getFuncoes()->formataRetorno($this->getPest()->post('ClientService/GetClientPerformanceData',$request));
        
        $performanceData = $results->Workouts;

        $this->unsetSpivi();

        return $performanceData;
    }

    public function getInstructors()
    {
        $this->authSpivi();

        $params = [
            "SiteID" => $this->getAuthSpivi()->getSiteId()
        ];

        $request = array_merge(array("SourceCredentials"=>$this->getSourceCredentials()),$params);
        
        $results = $this->getFuncoes()->formataRetorno($this->getPest()->post('ClientService/GetInstructors',$request));
        
        $instructors = $results->Clients;

        $this->unsetSpivi();

        return $instructors;
    }
}
?>
