<?php

class Special
{
    /**
     * @var int id de la BDD
     */
    private $idSpecial;

    /**
     * @var string "Sauce", "Viande", etc...
     */
    private $type;

	/**
     * @var int Id du type de nourriture dans la BDD
     */
    private $idType;

	
    /**
     * @var string "Algérienne", "Poulet", etc...
     */
    private $nom;
	
    /**
     * Constructeur valué
     */
    public function __construct($idSpecial,$type,$idType, $nom)
    {
        $this->idSpecial = $idSpecial;
        $this->type = $type;
        $this->idType = $idType;
        $this->nom = $nom;
    }
	
    public function getIDSpecial()
    {
        return $this->idSpecial;
    }
	
    public function setIDSpecial($id)
    {
        $this->idSpecial = $id;
    }

	public function getType()
    {
        return $this->type;
    }
	
	 public function getIDType()
    {
        return $this->idType;
    }

	public function getNom()
    {
        return $this->nom;
    }

    public function toString()
    {
        return $this->getNom();
    }
}
?>