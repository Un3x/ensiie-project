<?php


namespace Categoriefilm;


use categorie\Categories;
use Film\Film;
use Film\FilmRepository;

class CategorieFRepository
{
    private $connection;
    public function __construct($connection)
    {
        $this->connection=$connection;
    }
    public function add(Film $film,Categories $categorie)
    {
        $prep=$this->connection->prepare('INSERT INTO categorieFilm (film,categorie) VALUES (:film,:categorie)');
        $prep->bindValue(':categorie',$categorie->getIdcategorie(),\PDO::PARAM_INT);
        $prep->bindValue(':film',$film->getIdfilm(),\PDO::PARAM_INT);
        $prep->execute();
    }
    public function delete(Film $film,Categories $categorie)
    {
        $this->connection->query('DELETE from categorieFilm where categorie='.$categorie->getIdcategorie().' and film='.$film->getIdfilm());
    }
    public function updateFilm(Film $film,Categories $categorie) // A modifier aprés
    {
        $prep=$this->connection->prepare('UPDATE categorieFilm SET film=:film where categorie=:categorie');
        $prep->bindValue(':categorie',$categorie->getIdcategorie(),\PDO::PARAM_INT);
        $prep->bindValue(':film',$film->getIdfilm(),\PDO::PARAM_INT);
        $prep->execute();
    }
    public function updateCategorie(Film $film,Categories $categorie) // A modifier aprés
    {
        $prep=$this->connection->prepare('UPDATE categorieFilm SET categorie=:categorie where film=:film');
        $prep->bindValue(':categorie',$categorie->getIdcategorie(),\PDO::PARAM_INT);
        $prep->bindValue(':film',$film->getIdfilm(),\PDO::PARAM_INT);
        $prep->execute();
    }
    public function showFilmsOfCategorie($categorie)
    {
        $id = (int) $categorie;
        $films=[];
        $req = $this->connection->query('SELECT film FROM categorie_film WHERE categorie = '.$id);
        if($req)
        {
            while ($film = $req->fetch(\PDO::FETCH_ASSOC)) {
                    $fil=new FilmRepository($this->connection);
                    $unFilm=$fil->showFilms($film['film']);
                $films[] = $unFilm;

            }
            return $films;
        }
        else return false;
    }
    public function showFilmsOfLibelle($libelle)
    {
        //$this->connection->query();
        $films=[];
        $req = $this->connection->query("select film from categorie_film inner join categories on idcategorie=categorie where libelle=''".$libelle."'");
        if($req) {
            while ($film = $req->fetch(\PDO::FETCH_ASSOC)) {
                $films[] = (new FilmRepository($this->connection))->showFilms($film['film']);
            }
            return $films;
        }
        else return false;
    }

}