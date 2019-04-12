<head>
<link rel="stylesheet" href="../CSS/style.css">
</head>

<body>



<?php
class Article
{
    /**
     * @var int
     */
    private $id;
    
    /**
     * @var string
     */
    private $titre;
    
    /**
     * @var string
     */
    private $text;
    
    /**
     * @var \DateTimeInterface
     */
    private $date;
    
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @param int $id
     * @return Article
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }
    
    /**
     * @param string $firstname
     * @return Article
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getTexte()
    {
        return $this->texte;
    }
    
    /**
     * @param string $lastname
     * @return Article
     */
    public function setTexte($texte)
    {
        $this->texte = $texte;
        return $this;
    }
    
    /**
     * @return \DateTimeInterface
     */
    public function getDate(): \DateTimeInterface
    {
        return $this->date;
    }
    
    /**
     * @param \DateTimeInterface $birthday
     * @return Article
     */
    public function setBirthday(\DateTimeInterface $date)
    {
        $this->date = $date;
        return $this;
    }
    
    
    /**
     * @return int
     * @throws \OutOfRangeException
     */
    public function joursDepuisPublication(): int
    {
        $now = new \DateTime();
        
        if ($now < $this->getDate()) {
            throw new \OutOfRangeException('Pas encore publié');
        }
        
        return $now->diff($this->getDate())->y;
    }
}
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
        $rows = $this->connection->query('SELECT * FROM "article"')->fetchAll(\PDO::FETCH_OBJ);
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
        $rows = $this->connection->query('SELECT id, titre, date FROM "article"')->fetchAll(\PDO::FETCH_OBJ);
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
//postgres
/*$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");*/
$dbName = 'realitiie';
$dbUser = 'postgres';
$dbPassword = 'postgres';
$connection = new PDO("pgsql:host=localhost user=$dbUser dbname=$dbName password=$dbPassword");

//$articleRepository = new \Article\ArticleRepository($connection);
$articleRepository = new ArticleRepository($connection);
$articles = $articleRepository->fetchAll();

if(isset($_SESSION['pseudo'])){ //Si pas connect�, renvoie vers la page de connexion
    header("location: connexion.php");
}

?>

<h1>Administration des articles</h1>

<h3>Cliquez sur un article pour le modifier ou le supprimer</h3>

<div style="overflow-x:auto;">
    <table>
    	<tr><th>Titre</th><th>Auteur</th><th>Nombre de commentaires</th><th>Date</th></tr>
    	<tr><td>FIIEts, celui qui est parti de Realitiie en emportant la caisse. 30 ans plus tard, il raconte son histoire</td><td>Un gars</td><td>21</td><td>20/05/2049</td></tr>
    	<tr><td>C'est prouvé scientifiquement! Des études très sérieuses montre que Carapuce est supérieur à Bowser en tout points</td><td>Professeur Chen</td><td>11</td><td>12/04/2019</td></tr>
    	<tr><td>L'ITALIE ENVAHIE L'ALGERIE!!! PRANK ÇA TOURNE MAL! EXPLICATION!!!</td><td>La vérité vrai de la réalité véritable</td><td>94548484</td><td>12/04/2019</td></tr>
    	<tr><td>TOP 10 des raisons pour laquelle la tarentelle est un super danse, la 8ème va vous surprendre!</td><td>Altreon</td><td>0</td><td>12/04/2019</td></tr>
    </table>
</div>
<form action=""><input type="submit" class="plus" value="Écrire un Article"/></form>

</body>