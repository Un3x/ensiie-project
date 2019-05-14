<?php
namespace Achievements;
class AchievementsRepository
{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * AchievementsRepository constructor.
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM achievements')->fetchAll(\PDO::FETCH_OBJ);
        $achs = [];
        foreach ($rows as $row) {
            $ach = new Achievements();
            $ach
                ->setNom($row->nom)
                ->setSignification($row->signification);

            $achs[] = $ach;
        }

        return $achs;
    }


}
