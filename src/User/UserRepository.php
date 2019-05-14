<?php
namespace User;
class UserRepository
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
        $rows = $this->connection->query("SELECT * FROM membres")->fetchAll(\PDO::FETCH_OBJ);
        $users = [];
        foreach ($rows as $row) {
            $user = new User();
            $user
                ->setpseudo($row->pseudo)
                ->setcourriel($row->courriel)
                ->setmotdepasse($row->motdepasse);

            $users[] = $user;
        }

        return $users;
    }


}
