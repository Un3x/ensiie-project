<?php


namespace Fauteuils;


class Fauteuils
{
    private $nfauteuil;
    private $catplace;

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) {
            // On récupère le nom du setter correspondant à l'attribut.
            $method = 'set' . ucfirst($key);

            // Si le setter correspondant existe.
            if (method_exists($this, $method)) {
                // On appelle le setter.
                $this->$method($value);
            }
        }
    }
    /**
     * @return mixed
     */
    public function getCatplace()
    {
        return $this->catplace;
    }

    /**
     * @return mixed
     */
    public function getNfauteuil()
    {
        return $this->nfauteuil;
    }

    /**
     * @param mixed $catplace
     */
    public function setCatplace($catplace)
    {
        $this->catplace = $catplace;
    }

    /**
     * @param mixed $nfauteuil
     */
    public function setNfauteuil($nfauteuil)
    {
        $this->nfauteuil = $nfauteuil;
    }
}