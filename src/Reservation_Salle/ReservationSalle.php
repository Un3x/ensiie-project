<?php


namespace ReservationSalle;


class ReservationSalle
{
    private $nreservation;
    private $planing;
    private $client;
    private $typeevenement;
    private $nomevenement;

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
    public function getPlaning()
    {
        return $this->planing;
    }

    /**
     * @return mixed
     */
    public function getNreservation()
    {
        return $this->nreservation;
    }

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @return mixed
     */
    public function getNomevenement()
    {
        return $this->nomevenement;
    }

    /**
     * @return mixed
     */
    public function getTypeevenement()
    {
        return $this->typeevenement;
    }

    /**
     * @param mixed $planing
     */
    public function setPlaning($planing)
    {
        $this->planing = $planing;
    }

    /**
     * @param mixed $nreservation
     */
    public function setNreservation($nreservation)
    {
        $this->nreservation = $nreservation;
    }

    /**
     * @param mixed $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * @param mixed $nomevenement
     */
    public function setNomevenement($nomevenement)
    {
        $this->nomevenement = $nomevenement;
    }

    /**
     * @param mixed $typeevenement
     */
    public function setTypeevenement($typeevenement)
    {
        $this->typeevenement = $typeevenement;
    }
}