<?php

namespace Controller;

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
        if(substr($celular,0,1) == 0){
            $celular = substr($celular,1);
        }
        $insereNovoCliente = $this->servicesClienteSpivi->insertNewClient(
            $username, $password, $gender, $firstname, $lastname,
            $endereco, $cidade, $country,$data_nascimento,$celular
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
        $lastname = $nomeSeparado[1];
        $endereco = $params['endereco'];
        $cidade = $params['cidade'];
        $celular = $params['celular'];
        $peso = $params['peso'];
        $altura = $params['altura'];
        $ftp = $params['FTP'];
        $rhr = $params['RHR'];
        $pst = $params['PST'];
        $lthr = $params['LTHR'];

        $atualizaCliente = $this->servicesClienteSpivi->updateClient(
            $username,$firstname,$lastname,$endereco,$cidade,
            $celular,$peso,$altura,$ftp,$rhr,$pst,
            $lthr
        );

        if($atualizaCliente->ErrorCode != 200){
            return json_encode(["Code" => $atualizaCliente->ErrorCode,"Message"=> $atualizaCliente->Clients->message]);
        }else{
            return json_encode(["Code" => 200, "Message" => "Aluno atualizado com sucesso."]);
        } 
    }

    public function deleteClient($params)
    {
        $email = $params['email'];

        $deletaCliente = $this->servicesClienteSpivi->deleteClient($email);

        return json_encode(["Code" => 200, "Message" => "Aluno deletado com sucesso."]);
    }
}