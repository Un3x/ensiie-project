<?php
namespace Forum;

class Forum
{
    /**
     * @var int
     */
    private $id_forum;

    /**
     * @var string
     */
    private $nom;

    /**
     * @var string
     */
    private $ville;

    /**
     * @var \DateTimeInterface
     */
    private $f_date;

    /**
     * @return int
     */
    public function getIdForum()
    {
        return $this->id_forum;
    }

    /**
     * @param int $id_forum
     * @return Forum
     */
    public function setIdForum($id_forum)
    {
        $this->id_forum = $id_forum;
        return $this;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     * @return Forum
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @param string $ville
     * @return Forum
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getDate()
    {
        return $this->f_date;
    }

    /**
     * @param \DateTimeInterface $f_date
     * @return Forum
     */
    public function setDate($f_date)
    {
        $this->f_date = $f_date;
        return $this;
    }


}

