<?php
namespace categorie;

class CategoriesRepository
{
    private $connection;
    public function __construct(\PDO $connection)
    {
        $this->connection=$connection;
    }
    public function add(Categories $categorie)
    {
        $prep=$this->connection->prepare('INSERT INTO categories (idcategorie,libelle,description) VALUES (:idcategorie,:libelle,:description)');
        $prep->bindValue(':idcategorie',$categorie->getIdcategorie(),PDO::PARAM_INT);
        $prep->bindValue(':libelle',$categorie->getLibelle());
        $prep->bindValue(':description',$categorie->getDescription());
        $prep->execute();
    }
    public function delete(Categories $categorie)
    {
        $this->connection->query("DELETE from categories where idcategorie=".$categorie);
    }
    public function update(Categories $categorie)
    {
        $prep=$this->connection->prepare('UPDATE categories SET libelle=:libelle,description=:description where idcategorie=:idcategorie');
        $prep->bindValue(':idcategorie',$categorie->getIdcategorie(),PDO::PARAM_INT);
        $prep->bindValue(':libelle',$categorie->getLibelle());
        $prep->bindValue(':description',$categorie->getDescription());
        $prep->execute();
    }
    public function allCategories()
    {
        $categories=[];
        $req=$this->connection->query('select idcategorie,libelle,description from categories order by idcategorie');

        while($cat=$req->fetch(\PDO::FETCH_ASSOC))
        {
            $categorie=new Categories();
            $categorie->setLibelle($cat['libelle']);
            $categorie->setDescription($cat['description']);
            $categorie->setIdcategorie($cat['idcategorie']);
            $categories[]=$categorie;
        }
        return $categories;
    }
    public function getCategories($idcat)
    {
        $id = (int) $idcat;
        $req = $this->connection->query('SELECT libelle,description FROM categories WHERE idcategorie = '.$id);
        $donnees = $req->fetch(\PDO::FETCH_ASSOC);
        return (new Categories())->hydrate($donnees);
    }
}