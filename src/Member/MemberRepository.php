<?php
namespace Member;
class MemberRepository
{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * MemberRepository constructor.
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM "member"')->fetchAll(\PDO::FETCH_OBJ);
        $members = [];
        foreach ($rows as $row) {
            $member = new Member();
            $member
                ->setId($row->id)
                ->setFirstname($row->firstname)
                ->setLastname($row->lastname)
                ->setSearchUser($row->searchUser)
                ->setEmail($row->email)
                ->setPassword($row->password);

            $members[] = $member;
        }

        return $members;
    }


}
