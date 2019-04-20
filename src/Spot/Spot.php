<?php
namespace Spot;

class Spot
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
    private $latitude;

    /**
     * @var string
     */
    private $longitude;

    /**
     * @var int
     */
    private $note;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Spot
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
     * @return Spot
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param string $latitude
     * @return Spot
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
        return $this;
    }

    /**
     * @return string
     */
    public function getLongitude() {
        return $this->longitude;
    }

    /**
     * @param string $longitude
     * @return Spot
     */
    public function setLongitude($longitude) {
        $this->longitude=$longitude;
        return $this;
    }

    /**
     * @return int
     */
    public function getnote() {
        return $this->note;
    }

    /**
     * @param int $note
     * @return Spot
     */
    public function setNote($note) {
        $this->note = $note;
        return $this;
    }

    /**
     * @return int
     * @throws \OutOfRangeException
     */
    /*
    public function getAge(): int
    {
        $now = new \DateTime();

        if ($now < $this->getBirthday()) {
            throw new \OutOfRangeException('Birthday in the future');
        }

        return $now->diff($this->getBirthday())->y;
    }
    */
}

