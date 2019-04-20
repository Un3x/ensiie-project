<?php
namespace Jeu;

class Jeu
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $titre;
    
    /**
     * @var string
     */
    private $git;
    
    /**
     * @var string
     */
    private $telechargement;
    
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Jeu
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTtire()
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     * @return Jeu
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
        return $this;
    }

    /**
     * @return string
     */
    public function getGit()
    {
        return $this->git;
    }

    /**
     * @param string $git
     * @return Jeu
     */
    public function setGit($git)
    {
        $this->git = $git;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getTelechargement()
    {
        return $this->telechargement;
    }
    
    /**
     * @param string $telechargement
     * @return Jeu
     */
    public function setTelechargement($telechargement)
    {
        $this->telechargement = $telechargement;
        return $this;
    }
}

