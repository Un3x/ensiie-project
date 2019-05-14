<?php

class Evenement
{
    /**
     * @var int id de la BDD
     */
    private $idEvenement;

    /**
     * @var string "NJV" ou "ObiLAN"
     */
    private $type;

    /**
     * @var int Numero de l'event
     */
    private $numero;

    /**
     * @var time Date de l'évènement
     */
    private $date;

    /**
     * Constructeur valué
     */
    public function __construct($idEvenement,$type,$numero,$date)
    {
        $this->idEvenement = $idEvenement;
        $this->type = $type;
        $this->numero = $numero;
        $this->date = $date;
    }
	
    public function getIDEvenement()
    {
        return $this->idEvenement;
    }
	
    public function setIDEvenement($id)
    {
        $this->idEvenement = $id;
    }

	public function getType()
    {
        return $this->type;
    }
	
    public function setType($type)
    {
        $this->type = $type;
    }

	public function getNumero()
    {
        return $this->numero;
    }
	
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function buildID()
    {
        return $this->getNumero().$this->getType();
    }

}

?>