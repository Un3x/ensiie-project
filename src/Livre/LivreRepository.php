<?php
namespace Livre;
class LivreRepository
{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * UserRepository constructor.
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM "Livre"')->fetchAll(\PDO::FETCH_OBJ);
        $livres = [];
        foreach ($rows as $row) {
            $livre = new Livre();
            $livre
                ->setId($row->id)
                ->setTitre($row->titre)
                ->setAuteurs($row->auteur) //TODO ALED
                ->setPublication(new \DateTimeImmutable($row->publication))
                ->setImage($row->couverture)
                ->setEdition($row->edition);

            $livres[] = $livre;
        }

        return $livres;
    }

//TODO update

    public function updateLivre($livre) {
        $this->connection->query('UPDATE "Livre" SET "titre"=$livre->getTitre(), "auteur"=$livre->getAuteur(), "publication"=$livre->getPublication(), "couverture"=$livre->getImage(), "editeur"=$livre->getEditeur(), "emprunteur"=$livre->getEmprunteur(), "date_emprunt"=$livre->getDateEmprunt() WHERE "id_livre"=$livre->getId()');
    }

    public function insertLivre($livre) {
        $this->connection->query('INSERT INTO "Livre" VALUES ($livre->getId(), $livre->getTitre(), $livre->getAuteur(), $livre->getPublication(), $livre->Image(), $livre->getEditeur(), $livre->getEmprunteur(), $livre->getDateEmprunt())');
    }
}
