<?php


namespace ReservationPlace;


class ReservationPlace
{
    private $nreservation;
    private $planing;
    private $client;
    private $fauteuil;

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
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @return mixed
     */
    public function getFauteuil()
    {
        return $this->fauteuil;
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
    public function getPlaning()
    {
        return $this->planing;
    }

    /**
     * @param mixed $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * @param mixed $fauteuil
     */
    public function setFauteuil($fauteuil)
    {
        $this->fauteuil = $fauteuil;
    }

    /**
     * @param mixed $nreservation
     */
    public function setNreservation($nreservation)
    {
        $this->nreservation = $nreservation;
    }

    /**
     * @param mixed $planing
     */
    public function setPlaning($planing)
    {
        $this->planing = $planing;
    }
}