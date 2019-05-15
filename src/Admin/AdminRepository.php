<?php
namespace admin;
class adminRepository
{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * UserRepository constructor.
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM "admin"')->fetchAll(\PDO::FETCH_OBJ);
        $admin = [];
        foreach ($rows as $row) {
            $admin = new admin();
            $admin
                ->setId($row->id)
                ->setPrenom($row->prenom)
                ->setNom($row->nom)
                ->setEmail($row->email)
                ->setMdp($row->mdp);
            $admin[] = $admin;
        }
        return $admin;
    }
}
