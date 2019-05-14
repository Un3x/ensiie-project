<?php
namespace Reponse;

class Reponse
{
    /**
     * @var int
     */
    private $idrep;

        /**
     * @var int
     */
    private $idsujet;

    /**
     * @var int
     */
    private $idauthor;

    /**
     * @var string
     */
    private $rdate;

    /**
     * @var string
     */
    private $content;

    /**
     * @var bool
     */
    private $validated;

    /**
     * @var int
     */
    private $votecount;


    /** ---------------------------------------------------------------------------- */
    /** ---------------------------------------------------------------------------- */
    /** ---------------------------------------------------------------------------- */
    /** ---------------------------------------------------------------------------- */

    /**
     * @return int
     */
    public function getIdRep()
    {
        return $this->idrep;
    }

    /**
     * @param int $id
     * @return Reponse
     */
    public function setIdRep($idrep)
    {
        $this->idrep = $idrep;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdSujet()
    {
        return $this->idsujet;
    }

    /**
     * @param int $id
     * @return Reponse
     */
    public function setIdSujet($idsujet)
    {
        $this->idsujet = $idsujet;
        return $this;
    }

    /**
     * @return int
     */
    public function getIdAuthor()
    {
        return $this->idauthor;
    }

    /**
     * @param int $id
     * @return Reponse
     */
    public function setIdAuthor($idauthor)
    {
        $this->idauthor = $idauthor;
        return $this;
    }    

    /**
     * @return \DateTimeInterface
     */
    public function getRDate(): \DateTimeInterface
    {
        return $this->rdate;
    }

    /**
     * @param \DateTimeInterface $rdate
     * @return Reponse
     */
    public function setRDate(\DateTimeInterface $rdate)
    {
        $this->rdate = $rdate;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return Reponse
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return bool
     */
    public function getValidated()
    {
        return $this->validated;
    }

    /**
     * @param string $validated
     * @return Reponse
     */
    public function setValidated($validated)
    {
        $this->validated = $validated;
        return $this;
    }

    /**
     * @return int
     */
    public function getVoteCount()
    {
        return $this->votecount;
    }

    /**
     * @param int $votecount
     * @return Reponse
     */
    public function setVoteCount($votecount)
    {
        $this->votecount = $votecount;
        return $this;
    }

    /** ---------------------------------------------------------------------------- */
    /** ---------------------------------------------------------------------------- */
    /** ---------------------------------------------------------------------------- */
    /** ---------------------------------------------------------------------------- */

}

