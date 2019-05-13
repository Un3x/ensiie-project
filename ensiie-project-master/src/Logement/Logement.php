<?php
namespace Logement;

class Logement
{
    /**
     * @var string
     */
    private $adresse;


    /**
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param string $adresse
     * @return Logement
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
        return $this;
    }


}

