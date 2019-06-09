<?php


namespace Planing;


class Planing
{
    private $nplaning;
    private $film;
    private $datejour;
    private $debutheure;
    private $finheure;
    private $dediesalle;

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
    public function getDediesalle()
    {
        return $this->dediesalle;
    }
    /**
     * @return mixed
     */
    public function getFilm()
    {
        return $this->film;
    }

    /**
     * @return mixed
     */
    public function getDatejour()
    {
        return $this->datejour;
    }

    /**
     * @return mixed
     */
    public function getDebutheure()
    {
        return $this->debutheure;
    }

    /**
     * @return mixed
     */
    public function getFinheure()
    {
        return $this->finheure;
    }

    /**
     * @return mixed
     */
    public function getNplaning()
    {
        return $this->nplaning;
    }

    /**
     * @param mixed $dediesalle
     */
    public function setDediesalle($dediesalle)
    {
        $this->dediesalle = $dediesalle;
    }
    /**
     * @param mixed $film
     */
    public function setFilm($film)
    {
        $this->film = $film;
    }

    /**
     * @param mixed $datejour
     */
    public function setDatejour($datejour)
    {
        $this->datejour = $datejour;
    }

    /**
     * @param mixed $debutheure
     */
    public function setDebutheure($debutheure)
    {
        $this->debutheure = $debutheure;
    }

    /**
     * @param mixed $finheure
     */
    public function setFinheure($finheure)
    {
        $this->finheure = $finheure;
    }

    /**
     * @param mixed $nplaning
     */
    public function setNplaning($nplaning)
    {
        $this->nplaning = $nplaning;
    }
}