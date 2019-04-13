<?php
namespace Auteur;

class Auteur;
    /**
     * @var string
     */
    private $id_livre;

    /**
     * @var string
     */
    private $auteur;

    
    /**
     * @return string
     */
    public function getIdLivre()
    {
        return $this->id_livre;
    }

    /**
     * @param string $id_livre
     * @return Auteur
     */
    public function setIdLivre($id_livre)
    {
        $this->id_livre = $id_livre;
        return $this;
    }

    /**
     * @return string
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * @param string $auteur
     * @return Auteur
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;
        return $this;
    }


}