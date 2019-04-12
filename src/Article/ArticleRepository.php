<?php
namespace Article;
class ArticleRepository
{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * ArticleRepository constructor.
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM "Article"')->fetchAll(\PDO::FETCH_OBJ);
        $articles = [];
        foreach ($rows as $row) {
            $article = new Article();
            $article
                ->setId($row->id)
                ->setTitre($row->titre)
                ->setTexte($row->texte)
                ->setDate(new \DateTimeImmutable($row->date));

            $articles[] = $article;
        }

        return $articles;
    }

    public function fetchWithoutTexte()
    {
        $rows = $this->connection->query('SELECT id, titre, date FROM "Article"')->fetchAll(\PDO::FETCH_OBJ);
        $articles = [];
        foreach ($rows as $row) {
            $article = new Article();
            $article
            ->setId($row->id)
            ->setTitre($row->titre)
            ->setTexte($row->texte)
            ->setDate(new \DateTimeImmutable($row->date));
            
            $articles[] = $article;
        }
        
        return $articles;
    }
}
