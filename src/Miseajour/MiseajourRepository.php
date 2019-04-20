<?php
namespace Miseajour;

use Jeu\Jeu;

class MiseajourRepository
{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * MiseajourRepository constructor.
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT *
                                          FROM "miseajour" NATURAL JOIN "jeux"')->fetchAll(\PDO::FETCH_OBJ);
        $miseajours = [];
        foreach ($rows as $row) {
            $jeu = new Jeu();
            $jeu
            ->setId($row->jeu.id_jeu)
            ->setTitre($row->titre)
            ->setGit($row->git)
            ->setTelechargement($row->telechargement);
            
            $miseajour = new Miseajour();
            $miseajour
                ->setId($row->id_maj)
                ->setJeu($jeu)
                ->setTexte($row->texte)
                ->setDate(new \DateTimeImmutable($row->date));

            $miseajours[] = $miseajour;
        }

        return $miseajours;
    }
}
