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
                ->setId($row->id_user)
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

    public function creeUser($id, $nom, $prenom, $pseudo, $ddn, $mdp, $mail, $nb_livres_empruntes, $nb_livres_rendus, $est_admin) {
        $ret = new User();
        $ret->setId($id)
                ->setPrenom($prenom)
                ->setNom($nom)
                ->setPseudo($pseudo)
                /*->setDdn(new \DateTimeImmutable($ddn))*/
                ->setMdp($mdp)
                ->setMail($mail)
                ->setNbLivresEmpruntes($nb_livres_empruntes)
                ->setNbLivresRendus($nb_livres_rendus)
                ->setAdmin($est_admin);
        return $ret;
    }

    public function updateUser($user) {
        $this->connection->query("UPDATE \"User\" SET prenom=$user->getPrenom(), nom=$user->getNom(), pseudo=$user->getPseudo(), ddn=$user->getDdn(), mdp=$user->getMdp(), mail=$user->getMail(), nb_livres_empruntes=$user->getNbLivresEmpruntes(), nb_livres_rendus=$user->getNbLivresRendus(), est_admin=$user->getAdmin() WHERE id_user=$user->getId();");
    }

    public function insertUser($user) {
        $id = $user->getId();
        $nom = $user->getNom();
        $prenom = $user->getPrenom();
        $pseudo = $user->getPseudo();
        /*test mais ne sert plus a rien*/
        $this->connection->query("INSERT INTO \"User\"(id_user, nom, prenom, pseudo, mdp, mail, nb_livres_empruntes, nb_livres_rendus) VALUES ($id, $nom, 'Tangu0y7', 'An0syth7', '0', '0', '0', '0');");
        
        /*$this->connection->query("INSERT INTO \"User\"(id_user, nom, prenom, pseudo, mdp, mail, nb_livres_empruntes, nb_livres_rendus) VALUES ($id, $nom, $prenom, $pseudo, '0', '0', '0', '0');");*/
        return $nom;

    }


}
