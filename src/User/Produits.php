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
     * @var int ??
     */

    private $photo1;

    private $photo2;

    private $photo3;

    Private $valide;

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

    public function getPhoto1()
    {
        return $this->photo1;
    }

    public function setPhoto1($photo)
    {
        $this->photo1=$photo;
        return $this;
    }

    public function getPhoto2()
    {
        return $this->photo2;
    }

    public function setPhoto2($photo)
    {
        $this->photo2=$photo;
        return $this;
    }

    public function getPhoto3()
    {
        return $this->photo3;
    }

    public function setPhoto3($photo)
    {
        $this->photo3=$photo;
        return $this;
    }

    public function getValide()
    {
        return $this->valide;
    }

    public function setValide($v)
    {
        $this->valide=$v;
        return $this;
    }

}

?>