<?php 

namespace Model;

class AuthSpivi{
    private string $codUnidade;
    private string $sourceName;
    private string $password;
    private string $siteId;

    public function __construct($codUnidade, $sourceName, $password, $siteId){
        $this->codUnidade = $codUnidade;
        $this->sourceName = $sourceName;
        $this->password = $password;
        $this->siteId = $siteId;
    }

    /**
     * Get the value of siteId
     */ 
    public function getSiteId(): int
    {
        return $this->siteId;
    }

    /**
     * Set the value of siteId
     *
     * @return  self
     */ 
    public function setSiteId($siteId): void
    {
        $this->siteId = $siteId;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password): void
    {
        $this->password = $password;

    }

    /**
     * Get the value of sourceName
     */ 
    public function getSourceName(): string
    {
        return $this->sourceName;
    }

    /**
     * Set the value of sourceName
     *
     * @return  self
     */ 
    public function setSourceName($sourceName): void
    {
        $this->sourceName = $sourceName;

    }

    /**
     * Get the value of codUnidade
     */ 
    public function getCodUnidade(): string
    {
        return $this->codUnidade;
    }

    /**
     * Set the value of codUnidade
     *
     * @return  self
     */ 
    public function setCodUnidade($codUnidade): void
    {
        $this->codUnidade = $codUnidade;
    }
}

