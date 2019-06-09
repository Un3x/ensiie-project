<?php
namespace Compte ;
class Compte
{
    private $ncompte;
    private $nomcompte;
    private $motpasse;
    private $email;
    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value)
        {
            // On récupère le nom du setter correspondant à l'attribut.
            $method = 'set'.ucfirst($key);

            // Si le setter correspondant existe.
            if (method_exists($this, $method))
            {
                // On appelle le setter.
                $this->$method($value);
            }
        }
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getMotpasse()
    {
        return $this->motpasse;
    }

    /**
     * @return mixed
     */
    public function getNcompte()
    {
        return $this->ncompte;
    }

    /**
     * @return mixed
     */
    public function getNomcompte()
    {
        return $this->nomcompte;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param mixed $motpasse
     */
    public function setMotpasse($motpasse)
    {
        $this->motpasse = $motpasse;
    }

    /**
     * @param mixed $ncompte
     */
    public function setNcompte($ncompte)
    {
        $this->ncompte = $ncompte;
    }

    /**
     * @param mixed $nomcompte
     */
    public function setNomcompte($nomcompte)
    {
        $this->nomcompte = $nomcompte;
    }
}
