<?php
namespace User;
class UserRepository
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
        $rows = $this->connection->query('SELECT * FROM "User"')->fetchAll(\PDO::FETCH_OBJ);
        $users = [];
        foreach ($rows as $row) {
            $user = new User();
            $user
                ->setId($row->id)
                ->setPrenom($row->prenom)
                ->setNom($row->nom)
                ->setPseudo($row->pseudo)
                ->setDdn(new \DateTimeImmutable($row->ddn))
                ->setMdp($row->mdp)
                ->setMail($row->mail)
                ->setNbLivresEmpruntes($row->nb_livres_empruntes)
                ->setNbLivresRendus($row->nb_livres_rendus)
                ->setAdmin($row->est_admin);

            $users[] = $user;
        }

        return $users;
    }

    //TODO update je sais pas si ça marche lol ALED

    public function updateUser($user) {
        $this->connection->query('UPDATE "User" SET "prenom"=$user->getPrenom(), "nom"=$user->getNom(), "pseudo"=$user->getPseudo(), "ddn"=$user->getDdn(), "mdp"=$user->getMdp(), "mail"=$user->getMail(), "nb_livres_empruntes"=$user->getNbLivresEmpruntes(), "nb_livres_rendus"=$user->getNbLivresRendus(), "est_admin"=$user->getAdmin() WHERE "id"=$user->getId()');
    }

    public function insertUser($user) {
        $this->connection->query('INSERT INTO "User" VALUES ($user->getId(), $user->getPrenom(), $user->getNom(), $user->getPseudo(), $user->getDdn(), $user->getMdp(), $user->getMail(), $user->getNbLivresEmpruntes(), $user->getNbLivresRendus(), $user->getAdmin())');
    }


}
