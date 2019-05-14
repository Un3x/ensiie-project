<?php

class Nourriture
{
    /**
     * @var int id de la BDD
     */
    private $idNourriture;

    /**
     * @var string "Pizza", "Tacos", etc...
     */
    private $Type;

	/**
     * @var int Id du type de nourriture dans la BDD
     */
    private $idType;
	
    /**
     * @var string "Calzone (Tomates, Oignons)", "Tacos XXL", etc...
     */
    private $nom;
	
	/**
     * @var string "Le Palais", "Obigdelice", etc...
     */
    private $nomPart;
	
	/**
     * @var int id du partenariat dans la BDD
     */
    private $idPart;

	/**
     * @var string "6.5 €", "8€", Le prix que VONT PAYER LES IIENS
     */
    private $prixIIENS;
	
	/**
     * @var string "6.5 €", "8€", Le prix que L'ONT DOIT AU PART (moins cher que pricePaid)
     */
    private $prixLP;
	
	
    /**
     * Constructeur valué
     */
    public function __construct($idNourriture,$type,$idType, $nom, $nomPart, $idPart, $prixIIENS, $prixLP)
    {
        $this->idNourriture = $idNourriture;
        $this->type = $type;
        $this->nom = $nom;
        $this->nomPart = $nomPart;
        $this->idPart = $idPart;
        $this->prixIIENS = $prixIIENS;
        $this->prixLP = $prixLP;
    }
	
    public function getIDNourriture()
    {
        return $this->idNourriture;
    }
	
    public function setIDNourriture($id)
    {
        $this->idNourriture = $id;
    }

	public function getType()
    {
        return $this->type;
    }

	public function getNom()
    {
        return $this->nom;
    }
	
	public function getNomPart()
    {
        return $this->nomPart;
    }

	public function getIDPart()
    {
        return $this->idPart;
    }
	
	public function getPrixIIENS()
    {
        return $this->prixIIENS;
    }

	public function getPrixLP()
    {
        return $this->prixLP;
    }

    public function toString()
    {
        $str = "";
        $str = $str.$this->getType().": ".$this->getNom()."(".$this->getPrixIIENS().")";
        return $str;
    }
}

?>