<?php
namespace Message;
class MessageRepository
{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * MessageRepository constructor.
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM "message"')->fetchAll(\PDO::FETCH_OBJ);
        $messages = [];
        foreach ($rows as $row) {
            $message = new Message();
            $message
                ->setId($row->id)
                ->setSender($row->sender)
                ->setChat($row->chat)
                ->setSend($row->send)
                ->setMessage($row->message);

            $messages[] = $message;
        }

        return $messages;
    }


}
