<?php

class Sujet
{
    /**
     * @var int
     */
    private $id;

        /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $author;

    /**
     * @var string
     */
    private $sdate;

    /**
     * @var string
     */
    private $content;

    /**
     * @var bool
     */
    private $solved;

    /**
     * @var int
     */
    private $nbrep;

    private $score;

    /** ---------------------------------------------------------------------------- */
    /** ---------------------------------------------------------------------------- */
    /** ---------------------------------------------------------------------------- */
    /** ---------------------------------------------------------------------------- */

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Sujet
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Sujet
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }    

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param string $author
     * @return Sujet
     */
    public function setAuthor($author)
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getSDate(): \DateTimeInterface
    {
        return $this->sdate;
    }

    /**
     * @param \DateTimeInterface $sdate
     * @return Sujet
     */
    public function setSDate(\DateTimeInterface $sdate)
    {
        $this->sdate = $sdate;
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
     * @return Sujet
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return bool
     */
    public function getSolved()
    {
        return $this->solved;
    }

    /**
     * @param bool $solved
     * @return Sujet
     */
    public function setSolved($solved)
    {
        $this->solved = $solved;
        return $this;
    }

    /**
     * @return int
     */
    public function getNbRep()
    {
        return $this->nbrep;
    }

    /**
     * @param int $nbrep
     * @return Sujet
     */
    public function setNbRep($nbrep)
    {
        $this->nbrep = $nbrep;
        return $this;
    }

    /**
     * @return int
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @param int $nbrep
     * @return Sujet
     */
    public function setScore($score)
    {
        $this->score = $score;
        return $this;
    }

    /** ---------------------------------------------------------------------------- */
    /** ---------------------------------------------------------------------------- */
    /** ---------------------------------------------------------------------------- */
    /** ---------------------------------------------------------------------------- */

}
