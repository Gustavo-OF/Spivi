<?php

namespace Model;

class Database
{
    private string $marca;
    private string $dbServer;
    private string $dbDatabase;
    private string $dbUser;
    private string $dbPassword;
    private $conn;

    public function __construct($marca)
    {
        $this->marca = $marca;
        $this->selectDB();
    }

    private function selectDB(): void
    {
        if(strpos($this->marca,"ux") !== false){
            $this->setDbServer("200.98.205.240");
            $this->setDbDatabase("BD_CG");
            $this->setDbUser("uxadm");
            $this->setDbPassword("b*0I956aB");
        }else{
            $this->setDbServer("200.98.136.19");
            $this->setDbDatabase("BD_CG");
            $this->setDbUser("evoqueadm");
            $this->setDbPassword("e*0I956aE");
        }
    }

    public function connect(): bool
    {
        if (empty($this->conn)) {
            $this->setConn(new \PDO("sqlsrv:Server=" . $this->dbServer . "; Database=" . $this->dbDatabase . "; ConnectionPooling=0;", "" . $this->dbUser . "", "" . $this->dbPassword . ""));
            if ($this->getConn()) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    public function disconnect(): void
    {
        if ($this->getConn()) {
            $this->getConn()->query("KILL CONNECTION_ID()");
            $this->setConn(false);
        }
    }

    public function select($table, $rows = '*', $where = null,$ps=[] ,$order = null): array
    {
        $resultado = [];
        $q = 'SELECT ' . $rows . ' FROM ' . $table;
        $where != null ? $q .= ' WHERE ' . $where : "";
        $order != null ? $q .= ' ORDER BY ' . $order : "";
        $conn = $this->getConn()->prepare($q);
        
        for($i = 1; $i <= count($ps);$i++){
            $conn->bindParam($i, $ps[$i-1]);
        }
        if ($conn->execute()) {
            $resultado = $conn->fetchAll();
        }
        return $resultado;

    }

    /**
     * Get the value of conn
     */
    public function getConn()
    {
        return $this->conn;
    }

    /**
     * Set the value of conn
     *
     * @return  self
     */
    public function setConn($conn)
    {
        $this->conn = $conn;
    }

    /**
     * Set the value of dbServer
     *
     * @return  self
     */ 
    public function setDbServer($dbServer)
    {
        $this->dbServer = $dbServer;
    }

    /**
     * Set the value of dbDatabase
     *
     * @return  self
     */ 
    public function setDbDatabase($dbDatabase)
    {
        $this->dbDatabase = $dbDatabase;
    }

    /**
     * Set the value of dbUser
     *
     * @return  self
     */ 
    public function setDbUser($dbUser)
    {
        $this->dbUser = $dbUser;
    }

    /**
     * Set the value of dbPassword
     *
     * @return  self
     */ 
    public function setDbPassword($dbPassword)
    {
        $this->dbPassword = $dbPassword;
    }
}
