<?php
namespace Article;

use Membre\Membre;

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

    /* Utile?
    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT id_article, titre, texte, date, id_membre, nom, prenom, surnom, promo, role
                                          FROM "article" NATURAL JOIN "membre"')->fetchAll(\PDO::FETCH_OBJ);
        $articles = [];
        foreach ($rows as $row) {
            $article = new Article();
            $auteur = new Membre();
            $auteur
            ->setId($row->id_membre)
            ->setNom($row->nom)
            ->setPrenom($row->prenom)
            ->setSurnom($row->surnom)
            ->setPromo($row->promo)
            ->setRole($row->role);
            $article
            ->setId($row->id_article)
            ->setTitre($row->titre)
            ->setTexte($row->texte)
            ->setAuteur($auteur)
            ->setDate(new \DateTimeImmutable($row->date));
            
            $articles[] = $article;
        }
        
        return $articles;
    }*/

    public function fetchWithoutTexte()
    {
        $rows = $this->connection->query('SELECT id_article, titre, date, id_membre, nom, prenom, surnom, promo, role
                                          FROM "article" NATURAL JOIN "membre"
                                          ORDER BY date DESC')->fetchAll(\PDO::FETCH_OBJ);
        $articles = [];
        foreach ($rows as $row) {
            $article = new Article();
            $auteur = new Membre();
            $auteur
                ->setId($row->id_membre)
                ->setNom($row->nom)
                ->setPrenom($row->prenom)
                ->setSurnom($row->surnom)
                ->setPromo($row->promo)
                ->setRole($row->role);
            $article
                ->setId($row->id_article)
                ->setTitre($row->titre)
                ->setAuteur($auteur)
                ->setDate(new \DateTimeImmutable($row->date));
            
            $articles[] = $article;
        }
        
        return $articles;
    }
    
    public function getArticle($id)
    {
        $row = $this->connection->query('SELECT id_article, titre, texte, date, id_membre, nom, prenom, surnom, promo, role
                                         FROM "article" NATURAL JOIN "membre"
                                         WHERE id_article = '.$id)->fetchAll(\PDO::FETCH_OBJ);
        if(count($row) == 0){
            return NULL;
        }
        $row = $row[0];
        $article = new Article();
        $auteur = new Membre();
        $auteur
            ->setId($row->id_membre)
            ->setNom($row->nom)
            ->setPrenom($row->prenom)
            ->setSurnom($row->surnom)
            ->setPromo($row->promo)
            ->setRole($row->role);
        $article
            ->setId($row->id_article)
            ->setTitre($row->titre)
            ->setTexte($row->texte)
            ->setAuteur($auteur)
            ->setDate(new \DateTimeImmutable($row->date));
        
        return $article;
    }
    
    public function setArticle($id, $titre, $texte, $auteur, $date)
    {
        $sql = "UPDATE article
                SET titre = ?, texte = ?, id_membre = ?, date = ?
                WHERE id_article = ?";
        $req = $this->connection->prepare($sql);
        $status = $req->execute(array($titre, $texte, $auteur, $date, $id));
        return $status;
    }
    
    public function deleteArticle($id)
    {
        $sql = "DELETE FROM article
                WHERE id_article = ?";
        $req = $this->connection->prepare($sql);
        $status = $req->execute(array($id));
        return $status;
    }
    
    public function createArticle($titre, $texte, $auteur, $date)
    {
        $sql = "INSERT INTO article
                (titre, texte, id_membre, date) VALUES (?, ?, ?, ?);";
        $req = $this->connection->prepare($sql);
        $status = $req->execute(array($titre, $texte, $auteur, $date));
        return $status;
    }
}
