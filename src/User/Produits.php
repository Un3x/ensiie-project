<?php
namespace User;

class Produits
{
    /**
     * @var int
     */
    private $id_produit;

    /**
     * @var string
     */
    private $date_publi;

    private $id_proprio;

    private $descript;

    private $title;

    private $price;

    /**
     * @return int
     */
    public function getIdProd()
    {
        return $this->id_produit;
    }

    /**
     * @param int $id
     * @return Categorie
     */
    public function setId($id)
    {
        $this->id_produit = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getDatePubli()
    {
        return $this->date_publi;
    }

    /**
     * @param string $nomcat
     * @return Categorie
     */
    public function setDatePubli(\DateTimeInterface $date)
    {
        $this->date_publi = $date;
        return $this;
    }

    public function getDescription()
    {
        return $this->descript;
    }

    public function setDescription($desc)
    {
        $this->descript=$desc;
        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($tit)
    {
        $this->title=$tit;
        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($prix)
    {
        $this->price=$prix;
        return $this;
    }



}

?>