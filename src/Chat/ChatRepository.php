<?php
namespace Chat;
class ChatRepository
{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * ChatRepository constructor.
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM "chat"')->fetchAll(\PDO::FETCH_OBJ);
        $chats = [];
        foreach ($rows as $row) {
            $chat = new Chat();
            $chat
                ->setId($row->id)
                ->setMember1($row->member1)
                ->setMember2($row->member2)
                ->setStartDate(new \DateTimeImmutable($row->startDate));

            $chats[] = $chat;
        }

        return $chats;
    }


}
