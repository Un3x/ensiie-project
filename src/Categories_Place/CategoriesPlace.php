<?php


namespace categorieplace;


class CategoriesPlace
{
    private $catplace;
    private $prixheure;
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
    public function getPrixheure()
    {
        return $this->prixheure;
    }

    /**
     * @param mixed $catplace
     */
    public function setCatplace($catplace)
    {
        $this->catplace = $catplace;
    }

    /**
     * @param mixed $prixheure
     */
    public function setPrixheure($prixheure)
    {
        $this->prixheure = $prixheure;
    }
}