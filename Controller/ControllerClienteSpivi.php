<?php

namespace Controller;

use DateTime;
use Services\ServicesClienteSpivi;

class ControllerClienteSpivi{
    private ServicesClienteSpivi $servicesClienteSpivi;

    public function __construct(ServicesClienteSpivi $servicesClienteSpivi){
        $this->servicesClienteSpivi = $servicesClienteSpivi;        
    }

    public function getClientsByName(string $params): string{
        $pegaClientes = $this->servicesClienteSpivi->getClients("SearchText",$params);

        return json_encode($pegaClientes);
    }

    public function getClientsByMail(string $params): string{
        $pegaClientes = $this->servicesClienteSpivi->getClients("Username",$params);

        return json_encode($pegaClientes);
    }

    public function insertNewClient(array $params) : string
    {
        $nomeSeparado = explode(" ",$params['nome']);
        $username = $params['email'];
        $password = "123456";
        $gender = $params['genero'] == "M" ? "Male" : "Female";
        $firstname = $nomeSeparado[0];
        $lastname = $nomeSeparado[1];
        $endereco = $params['endereco'];
        $cidade = $params['cidade'];
        $country = "BRA";
        $data_nascimento = $params['data_nasc'];
        $celular = $params['celular'];
        $deviceId = $params['device_id'];
        $cpf = $params['cpf'];
        if(substr($celular,0,1) == 0){
            $celular = substr($celular,1);
        }
        $insereNovoCliente = $this->servicesClienteSpivi->insertNewClient(
            $username, $password, $gender, $firstname, $lastname,
            $endereco, $cidade, $country,$data_nascimento,$celular,
            $deviceId,$cpf
        );

        if($insereNovoCliente->ErrorCode != 200){
            return json_encode(["Code" => $insereNovoCliente->ErrorCode,"Message"=> $insereNovoCliente->Clients->message]);
        }else{
            return json_encode(["Code" => 200, "Message" => "Aluno inserido com sucesso"]);
        }   
    }

    public function updateClient(array $params): string{
        $nomeSeparado = explode(" ",$params['nome']);
        $username = $params['email'];
        $firstname = $nomeSeparado[0];
        $lastname = isset($nomeSeparado[1]) ? $nomeSeparado[1] : "";
        $endereco = $params['endereco'];
        $cidade = $params['cidade'];
        $celular = $params['celular'];
        $peso = $params['peso'];
        $altura = $params['altura'];
        $ftp = $params['FTP'];
        $rhr = $params['RHR'];
        $pst = $params['PST'];
        $lthr = $params['LTHR'];
        $deviceId = $params['device_id'];

        $atualizaCliente = $this->servicesClienteSpivi->updateClient(
            $username,$firstname,$lastname,$endereco,$cidade,
            $celular,$peso,$altura,$ftp,$rhr,$pst,
            $lthr,$deviceId
        );

        if($atualizaCliente->ErrorCode != 200){
            return json_encode(["Code" => $atualizaCliente->ErrorCode,"Message"=> $atualizaCliente->Clients->message]);
        }else{
            return json_encode(["Code" => 200, "Message" => "Aluno atualizado com sucesso."]);
        } 
    }

    public function deleteClient(array $params)
    {
        $email = $params['email'];

        $deletaCliente = $this->servicesClienteSpivi->deleteClient($email);

        return json_encode(["Code" => 200, "Message" => "Aluno deletado com sucesso."]);
    }
    
    public function getPerformanceDataClient(array $params){
        $username = $params['email'];
        $dataInicio = new DateTime($params['data_inicio']);
        $dataFim = new DateTime($params['data_fim']);
        $idEvento = $params['idEvento'];

        $performanceData = $this->servicesClienteSpivi->getPerformanceDataClient($username, $dataInicio, $dataFim, $idEvento);

        return json_encode($performanceData);
    }
}