<?php

class VoteSujet{
  private $iduser;
  private $idsujet;
  
  /**
   * @var int
   */
  private $votevalue;

  /**
   * @return int
   */
  public function getIdUser()
  {
      return $this->iduser;
  }

  /**
   * @return int
   */
  public function getIdSujet()
  {
      return $this->idsujet;
  }

  public function getVoteValue()
  {
    return $this->voteValue;
  }

    /**
   * @return VoteSujet
   */
  public function setIdUser($iduser)
  {
    $this->iduser = $iduser;
    return $this;
  }
  /**
   * @return VoteSujet
   */
  public function setIdSujet($idsujet)
  {
    $this->idsujet = $idsujet;
    return $this;
  }

  public function setVoteValue($voteValue)
  {
    $this->voteValue = $voteValue;
    return $this;
  }
} 

class VoteReponse{
  private $iduser;
  private $idsujet;
  private $idreponse;
  private $votevalue;

  /**
   * @return int
   */
  public function getIdUser()
  {
      return $this->iduser;
  }

  /**
   * @return int
   */
  public function getIdReponse()
  {
      return $this->idreponse;
  }

  /**
   * @return int
   */
  public function setIdReponse($idreponse)
  {
      return $this->idreponse = $idreponse;
  }

  /**
   * @return int
   */
  public function getIdSujet()
  {
      return $this->idsujet;
  }

  public function getVoteValue()
  {
    return $this->voteValue;
  }

    /**
   * @return VoteSujet
   */
  public function setIdUser($iduser)
  {
    $this->iduser = $iduser;
    return $this;
  }
  /**
   * @return VoteSujet
   */
  public function setIdSujet($idsujet)
  {
    $this->idsujet = $idsujet;
    return $this;
  }

  public function setVoteValue($voteValue)
  {
    $this->voteValue = $voteValue;
    return $this;
  }
}

class VoteRepository{
    /**
     * @var \PDO
     */
    private $connection;

    // arrays
    private $votessujet;
    private $votesreponses;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
        $this->votesreponses = $this->fetchAllVotesRep();
        $this->votessujets = $this->fetchAllVotesSuj();
    }

    private function fetchAllVotesRep()
    {
        $rows = $this->connection->query('SELECT * FROM "votesreponses"')->fetchAll(\PDO::FETCH_OBJ);
        $votesrep = [];
        foreach ($rows as $row) {
            $vr = new VoteReponse();
            $vr
                ->setIdUser($row->iduser)
                ->setIdReponse($row->idrep)
                ->setIdSujet($row->idsujet)
                ->setVoteValue($row->vote);
            $votesrep[] = $vr;
        }
        return $votesrep;
    }

    private function fetchAllVotesSuj()
    {
        $rows = $this->connection->query('SELECT * FROM "votessujets"')->fetchAll(\PDO::FETCH_OBJ);
        $votessuj = [];
        foreach ($rows as $row) {
            $vs = new VoteSujet();
            $vs
                ->setIdUser($row->iduser)
                ->setIdSujet($row->idsujet)
                ->setVoteValue($row->vote);
            $votessuj[] = $vs;
        }
        return $votessuj;
    }

}

?>