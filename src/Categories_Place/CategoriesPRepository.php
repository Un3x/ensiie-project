<?php


namespace categorieplace;


use categorie\Categories;

class CategoriesPRepository
{
    private $connection;
    public function __construct(\PDO $connection)
    {
        $this->connection=$connection;
    }
    public function add(CategoriesPlace $categorie)
    {
        $prep=$this->connection->prepare('INSERT INTO categories_place (catplace,prixheure) VALUES (:catplace,:prixheure)');
        $prep->bindValue(':catplace',$categorie->getCatplace(),\PDO::PARAM_INT);
        $prep->bindValue(':prixheure',$categorie->getPrixheure(),\PDO::PARAM_INT);
        $prep->execute();
    }
    public function delete(CategoriesPlace $categorie)
    {
        $this->connection->query("DELETE from categories_place where catplace=".$categorie->getCatplace());
    }
    public function updatePrix(CategoriesPlace $categorie)
    {
        $prep=$this->connection->prepare('UPDATE categories_place SET prixheure=:prixheure where catplace=:catplace');
        $prep->bindValue(':prixheure',$categorie->getPrixheure(),\PDO::PARAM_INT);
        $prep->bindValue(':catplace',$categorie->getCatplace(),\PDO::PARAM_INT);
        $prep->execute();
    }
    public function allCategories()
    {
        $categories=[];
        $req=$this->connection->query('select prixheure,catplace from categories_place order by catplace');
        while($cat=$req->fetch(\PDO::FETCH_ASSOC))
        {
            $cato=new CategoriesPlace();
            $cato->setCatplace($cat['catplace']);
            $cato->setPrixheure($cat['prixheure']);
            $categories[]=$cato;
        }
        return $categories;
    }
    public function getCategorie($idcat)
    {
        $id = (int) $idcat;
        $req = $this->connection->query('SELECT prixheure FROM categories_place WHERE catplace='.$id);
        $donnees = $req->fetch(\PDO::FETCH_ASSOC);
        //$cat=new CategoriesPlace();
        return (new CategoriesPlace())->hydrate($donnees);
    }
}