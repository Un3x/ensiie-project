<?php
require_once(__DIR__.'/sujets.php');
// classe répertoire des sujets
/**
 * PAS OPTI
 * On va charger tous les sujets dans un tableau, et les traiter après dans du js
 * Plutôt opti pour les BD pas trop grosses, ce qui est le cas ici
 */
class SujetsRepository
{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * array of all sujets
     */
    private $sujetsArray;

    /**
     * UserRepository constructor.
     * @param \PDO $connection
     * @todo check if connection ok
     * Charge les sujets et réponses de la BD, et les range dans le tableau sujetsArray
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
        $this->sujetsArray = $this->fetchAll();
    }

    /**
     * @todo verifier unicite mail
     */
    private function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM "sujets"')->fetchAll(\PDO::FETCH_OBJ);
        $sujets = [];
        foreach ($rows as $row) {
            $suj = new Sujet();
            $suj
                ->setId($row->id)
                ->setTitle($row->title)
                ->setContent($row->content)
                ->setAuthor($row->author)
                ->setSDate(new \DateTimeImmutable($row->sdatetime))
                ->setNbRep($row->nbrep)
                ->setScore($row->score);

            $sujets[] = $suj;
        }

        return $sujets;
    }

    /**
     * pwh = password hash
     * returns user found if ok, false else
     */
    public function getSujets()
    {
      return $this->sujetsArray;
    }

}
