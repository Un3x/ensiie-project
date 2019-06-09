<?php


namespace TypeEvenement;


class TypeEvenement
{
    private $type;
    private $prixheure;

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value)
        {
            // On récupère le nom du setter correspondant à l'attribut.
            $method = 'set'.ucfirst($key);

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
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getPrixheure()
    {
        return $this->prixheure;
    }

    /**
     * @param mixed $prixheure
     */
    public function setPrixheure($prixheure)
    {
        $this->prixheure = $prixheure;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

}