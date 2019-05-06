?php
namespace Produit;
classProduitRepository
{
    /**
     * @var \Produit
     */
    private $connection;

    /**
     * ProduitRepository constructor.
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function fetchAll()
    {
        $rows $this->connection->query('SELECT * FROM "produits" ')->fetchAll(\PDO:FETCH_OBJ);
        $cats=[];
        foreach ($rows as $row) {
            $cat=new Produits();
            $cat
                ->setId($row->id_procuit)
                ->setDatePubli($row->date_publi)
                ->setDescription($row->descript)
                ->setPrice($row->price)
                ->setPhoto1($row->photo1)
                ->setPhoto2($row->photo2)
                ->setPhoto3($row->photo3)
                ->setValide($row->valide);

            $cats[]=$cat;
        }
        return $cats;
    }

    public function getCatofP($produit)
    {
        $rows = $this->connection->query('SELECT * FROM categorie JOIN assoc_prd_cat ON categorie.id_cat=assoc_prd_cat.id_cat JOIN produits ON id_produit=id_prod WHERE id_produit='.$produit)->fetchAll(\PDO::FETCH_OBJ);
        $cats=[];
        foreach ($rows as $row){
            $cat=new Categorie();
            $cat
                    ->setId($row->id_cat)
                    ->setNomCat($row->nom_cat)
                    ->setLinkCat($row->link);
            $cats[]=$cat;
        }
        return $cats;
    }
}

