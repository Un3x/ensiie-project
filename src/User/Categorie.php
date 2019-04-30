<?php
namespace User;

class Categorie
{
    /**
     * @var int
     */
    private $id_cat;

    /**
     * @var string
     */
    private $nom_cat;

    private $link_cat;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id_cat;
    }

    /**
     * @param int $id
     * @return Categorie
     */
    public function setId($id)
    {
        $this->id_cat = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getNomCat()
    {
        return $this->nom_cat;
    }

    /**
     * @param string $nomcat
     * @return Categorie
     */
    public function setNomCat($nomcat)
    {
        $this->nom_cat = $nomcat;
        return $this;
    }

    public function getLinkCat()
    {
        return $this->link_cat;
    }

    public function setLinkCat($newlink)
    {
        $this->link_cat=$newlink;
        return $this;
    }

}

?>
