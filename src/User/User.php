<?php
namespace User;

class User
{
    /**
     * @var string
     */
    private $pseudo;

    /**
     * @var string
     */
    private $courriel;

    /**
     * @var string
     */
    private $motdepasse;

    /**
    * @return int
    */
    private $lvl;

    /**
     * @return string
     */
    public function getpseudo()
    {
        return $this->pseudo;
    }

    /**
     * @param string $pseudo
     * @return User
     */
    public function setpseudo($pseudo)
    {
        $this->pseudo = $pseudo;
        return $this;
    }

    /**
     * @return string
     */
    public function getcourriel()
    {
        return $this->courriel;
    }

    /**
     * @param string $courriel
     * @return User
     */
    public function setcourriel($courriel)
    {
        $this->courriel = $courriel;
        return $this;
    }
    /**
     * @return string
     */
    public function getmotdepasse()
    {
        return $this->motdepasse;
    }

     /**
     * @param string $motdepasse
     * @return User
     */
    public function setmotdepasse($motdepasse)
    {
        $this->motdepasse = $motdepasse;
        return $this;
    }

    /**
     * @return int
     */
    public function getlvl()
    {
        return $this->lvl;
    }

    /**
     * @param int $lvl
     * @return User
     */
    public function setlvl($lvl)
    {
        $this->lvl = $lvl;
        return $this;
    }
}