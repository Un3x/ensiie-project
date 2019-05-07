<?php
namespace User;
class ProduitRepository
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
        $rows = $this->connection->query('SELECT * FROM "produits" ')->fetchAll(\PDO::FETCH_OBJ);
        $cats=[];
        foreach ($rows as $row) {
            $cat=new Produits();
            $cat
                ->setId($row->id_produit)
                ->setDatePubli(new \DateTimeImmutable($row->date_publi))
                ->setDescription($row->descript)
                ->setPrice($row->price)
                ->setTitle($row->title)
                ->setPhoto1($row->photo1)
                ->setPhoto2($row->photo2)
                ->setPhoto3($row->photo3)
                ->setValide($row->valide);

            $cats[]=$cat;
        }
        return $cats;
    }

    public function getProdofC($categorie)
    {
        $rows = $this->connection->query('SELECT * FROM categorie JOIN assoc_prd_cat ON categorie.id_cat=assoc_prd_cat.id_cat JOIN produits ON id_produit=id_prod WHERE id_produit='.$produit)->fetchAll(\PDO::FETCH_OBJ);
        $prods=[];
        foreach ($rows as $row){
            $prod=new Produits();
            $prod
                ->setId($row->id_produit)
                ->setDatePubli(new \DateTimeImmutable ($row->date_publi))
                ->setDescription($row->descript)
                ->setPrice($row->price)
                ->setTitle($row->title)
                ->setPhoto1($row->photo1)
                ->setPhoto2($row->photo2)
                ->setPhoto3($row->photo3)
                ->setValide($row->valide);
            $prods[]=$prod;
        }
        return $prods;
    }

    public function searchProd($search)
    {
        $rows = $this->connection->query("SELECT * FROM \"produits\" WHERE title LIKE '%".$search."%' OR descript LIKE '%".$search."%'")->fetchAll(\PDO::FETCH_OBJ);
        $prods=[];
        foreach ($rows as $row){
            $prod=new Produits();
            $prod
                ->setId($row->id_produit)
                ->setDatePubli(new \DateTimeImmutable($row->date_publi))
                ->setDescription($row->descript)
                ->setPrice($row->price)
                ->setTitle($row->title)
                ->setPhoto1($row->photo1)
                ->setPhoto2($row->photo2)
                ->setPhoto3($row->photo3)
                ->setValide($row->valide);
            $prods[]=$prod;
        }
        return $prods;
    }

    public function searchProdonCat($search,$cat)
    {
        $rows = $this->connection->query("SELECT * FROM produits JOIN assoc_prd_cat ON id_produit=id_prod JOIN categorie ON categorie.id_cat=assoc_prd_cat.id_cat WHERE (title LIKE '%".$search."%' OR descript LIKE '%".$search."%') AND categorie.id_cat=".$cat)->fetchAll(\PDO::FETCH_OBJ);
        $prods=[];
        foreach ($rows as $row){
            $prod=new Produits();
            $prod
                ->setId($row->id_produit)
                ->setDatePubli(new \DateTimeImmutable($row->date_publi))
                ->setDescription($row->descript)
                ->setPrice($row->price)
                ->setTitle($row->title)
                ->setPhoto1($row->photo1)
                ->setPhoto2($row->photo2)
                ->setPhoto3($row->photo3)
                ->setValide($row->valide);
            $prods[]=$prod;
        }
        return $prods;
    }


}

