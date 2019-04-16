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
        $rows = $this->connection->query('SELECT * FROM Users')->fetchAll(\PDO::FETCH_OBJ);
        $users = [];
        foreach ($rows as $row) {
            $user = new User();
			if ($row->password == 'default') {
				$row->password = password_hash('default',PASSWORD_BCRYPT);
			}
            $user
                ->setId($row->id_user)
                ->setFirstname($row->firstname)
                ->setLastname($row->lastname)
				->setPseudo($row->pseudo)
				->setPassword($row->password)
				->setPromo($row->year)
				->setPresident($row->president)
				->setMail($row->mail)
				->setBde($row->bde);
				

            $users[$user->getPseudo()] = $user;
        }

        return $users;
    }

	
}

