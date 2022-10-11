<?php

namespace Services;

use Controller\ControllerFuncoes;
use Model\Database;

class ServicesClienteUx{
    private Database $database;
    private ControllerFuncoes $controllerFuncoes;

    public function __construct(Database $database, ControllerFuncoes $controllerFuncoes){
        $this->database = $database;
        $this->controllerFuncoes = $controllerFuncoes;
    }
    
    /**
     * Pega os clientes da base de acordo com a pesquisa.
     *
     * @param  mixed $param
     * @param  mixed $codUnidade
     * @return array
     */
    public function getClientsUx($param,$codUnidade): array{
        if($this->database->connect()){
            $this->database->connect();
        }
        $retorno = "";
        $pesquisa = $this->controllerFuncoes->remover_Injection($param);
        if(!empty($pesquisa)){
            if(is_numeric($pesquisa)){
                if(strlen($pesquisa) == 11){
                    $retorno = $this->database->select("TB_PESSOAS P","COD_ALUNO,NOME,CPF,T.TIPO,DATA_NASC,PLVIG,EMAIL,SEXO,ENDERECO,CIDADE,CEL",["INNER","TB_TIPO_PESSOAS T","T.ID_TIPO_PESSOAS","P.ID_TIPO_PESSOAS"],"CPF = ?",[$pesquisa]);
                }else{
                    $retorno = $this->database->select("TB_PESSOAS P","COD_ALUNO,NOME,CPF,T.TIPO,DATA_NASC,PLVIG, EMAIL,SEXO,ENDERECO,CIDADE,CEL",["INNER","TB_TIPO_PESSOAS T","T.ID_TIPO_PESSOAS","P.ID_TIPO_PESSOAS"],"COD_ALUNO = ?",[$pesquisa]);
                }
            }else{
                $retorno = $this->database->select("TB_PESSOAS P","COD_ALUNO,NOME,CPF,T.TIPO,DATA_NASC, PLVIG,EMAIL,SEXO,ENDERECO,CIDADE,CEL",["INNER","TB_TIPO_PESSOAS T","T.ID_TIPO_PESSOAS","P.ID_TIPO_PESSOAS"],"NOME LIKE ? AND LOJA_V = ?",["%".$pesquisa."%",$codUnidade]);
            }
        }
        $this->database->disconnect();
        return $retorno;
    }
    
}





?>