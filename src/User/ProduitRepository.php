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
                ->setValide($row->valide)
                ->setIdProprio($row->id_proprio);
            $cats[]=$cat;
        }
        return $cats;
    }

    public function getProdofC($categorie)
    {
        $rows = $this->connection->query('SELECT * FROM categorie JOIN assoc_prd_cat ON categorie.id_cat=assoc_prd_cat.id_cat JOIN produits ON id_produit=id_prod WHERE categorie.id_cat='.$categorie)->fetchAll(\PDO::FETCH_OBJ);
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
                ->setValide($row->valide)
                ->setIdProprio($row->id_proprio);
            $prods[]=$prod;
        }
        return $prods;
    }

    public function getProdofUser($id_user)
    {
        $rows = $this->connection->query("SELECT * FROM produits JOIN utilisateur ON utilisateur.id=produits.id_proprio WHERE id='".$id_user."';")->fetchAll(\PDO::FETCH_OBJ);
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
                ->setValide($row->valide)
                ->setIdProprio($row->id_proprio);
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
                ->setValide($row->valide)
                ->setIdProprio($row->id_proprio);
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
                ->setValide($row->valide)
                ->setIdProprio($row->id_proprio);
            $prods[]=$prod;
        }
        return $prods;
    }

    public function getMax()
{
    $rows=$this->connection->query("SELECT MAX(id_produit) FROM produits;")->fetchAll(\PDO::FETCH_OBJ);
    $c=0;
    foreach($rows as $row){
        $c=$c+($row->max);
    }

    return $c;

}
public function getPhoto1($idprod){
    $rows=$this->connection->query("SELECT * FROM photo JOIN produits ON photo1=id_photo WHERE id_produit='".$idprod."';")->fetchAll(\PDO::FETCH_OBJ);
    $chemin="uploads/".$rows[0]->id_photo.".".$rows[0]->extension;
    return $chemin;
    
}

public function getPhoto2($idprod){
    $rows=$this->connection->query("SELECT * FROM photo JOIN produits ON photo2=id_photo WHERE id_produit='".$idprod."';")->fetchAll(\PDO::FETCH_OBJ);
    $chemin="/uploads/".$rows[0]->id_photo.".".$rows[0]->extension;
    return $chemin;
    
}

public function getPhoto3($idprod){
    $rows=$this->connection->query("SELECT * FROM photo JOIN produits ON photo3=id_photo WHERE id_produit='".$idprod."';")->fetchAll(\PDO::FETCH_OBJ);
    $chemin="/uploads/".$rows[0]->id_photo.".".$rows[0]->extension;
    return $chemin;
    
}

public function getProdNonValid() {
    $rows = $this->connection->query("SELECT * FROM produits WHERE valide = 0;")->fetchAll(\PDO::FETCH_OBJ);
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
            ->setValide($row->valide)
            ->setIdProprio($row->id_proprio);
        $prods[]=$prod;
    }
    return $prods;
}

    public function afficheProd($produit){
        $chemin=$this->getPhoto1($produit->getIdProd());
        $prix=$produit->getPrice();
        $rows = $this->connection->query("SELECT nom_cat FROM categorie JOIN assoc_prd_cat ON categorie.id_cat=assoc_prd_cat.id_cat WHERE assoc_prd_cat.id_prod=".$produit->getIdProd().";")->fetchAll(\PDO::FETCH_OBJ);
        $categories="";
        $taille=count($rows);
        $c=1;
        foreach ($rows as $row){
            if ($c<$taille){
                $categories=$categories.($row->nom_cat).", ";
                $c=$c+1;
            }

            else{
                $categories=$categories.($row->nom_cat);
            }

        }
        if ($prix!=0){
            $prix=$prix." €";
        }
        else{
            $prix="Gratuit";
        }
        echo "<a href=\"produit.php?produit=".$produit->getIdProd()."&pseudo=".$produit->getIdProprio()."\">
        <div class=\"produit\">
        <div class=\"photo_prod\">
        <img class =\"preview\" src=\"".$chemin."\" alt=\"photo du produit\"/>
        </div>
        <div class=\"text_prod\">
        <p>
        <span class=\"titre_prod\">".$produit->getTitle()."</span><br/><br/>
        <span class=\"prix_prod\">".$prix."</span><br/><br/>
        <span class=\"details\">".$categories."<br/>".$produit->getDatePubli()->format('Y-m-d')."</span>
        </p>
        </div>
        </div>
        </a>";
    }

    public function getSpecificProd($idproduit)
    {
        $rows = $this->connection->query("SELECT * FROM produits WHERE id_produit = '".$idproduit."';")->fetchAll(\PDO::FETCH_OBJ);
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
                ->setValide($row->valide)
                ->setIdProprio($row->id_proprio);
            $prods[]=$prod;
        }
        return $prods;
    }

}

