<?php
require_once(__DIR__.'/uploads.php');
// classe répertoire des uploads
/**
 * PAS OPTI
 * On va charger tous les uploads dans un tableau, et les traiter après dans du js
 * Plutôt opti pour les BD pas trop grosses, ce qui est le cas ici
 */
class UploadsRepository
{

    /**
     * @var \PDO
     */
    private $connection;

    /**
     * array of all uploads
     */
    private $uploadsArray;

    /**
     * UserRepository constructor.
     * @param \PDO $connection
     * @todo check if connection ok
     * Charge les uploads et réponses de la BD, et les range dans le tableau uploadsArray
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
        $this->uploadsArray = $this->fetchAll();
    }

    /**
     */
    private function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM "uploads"')->fetchAll(\PDO::FETCH_OBJ);
        $uploads = [];
        foreach ($rows as $row) {
            $upl = new Upload();
            $upl
                ->setId($row->id)
                ->setTitle($row->title)
                ->setIdUploader($row->iduploader)
                ->setUploadPath($row->uploadpath)
                ->setUploadType($row->uploadtype);

            $uploads[] = $upl;
        }

        return $uploads;
    }

    /**
     */
    public function getuploads()
    {
      return $this->uploadsArray;
    }

}
