<?php
namespace Move;

class Move
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $nom;

    /**
     * @var string
     */
    private $difficulte;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Move
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * @return Move
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return string
     */
    public function getDifficulte()
    {
        return $this->difficulte;
    }

    /**
     * @param string $difficulte
     * @return Move
     */
    public function setDifficulte($difficulte)
    {
        $this->difficulte = $difficulte;
        return $this;
    }
}

