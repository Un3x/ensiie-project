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
                ->setDdn($row->ddn)
                ->setMdp($row->mdp)
                ->setMail($row->mail)
                ->setNbLivresEmpruntes($row->nb_livres_empruntes)
                ->setNbLivresRendus($row->nb_livres_rendus)
                ->setAdmin($row->est_admin);

            $users[] = $user;
        }

        return $users;
    }

    public function fetchId($id_user) {
        $rows = $this->connection->query("SELECT * FROM \"User\" WHERE id_user='$id_user'")->fetchAll(\PDO::FETCH_OBJ);
        foreach ($rows as $row) {
            $user = new User();
            $user
                ->setId($row->id_user)
                ->setPrenom($row->prenom)
                ->setNom($row->nom)
                ->setPseudo($row->pseudo)
                ->setDdn($row->ddn)
                ->setMdp($row->mdp)
                ->setMail($row->mail)
                ->setNbLivresEmpruntes($row->nb_livres_empruntes)
                ->setNbLivresRendus($row->nb_livres_rendus)
                ->setAdmin($row->est_admin);
        }
        return $user;

    }

    public function fetchPseudo($pseudo_user) {
        $rows = $this->connection->query("SELECT * FROM \"User\" WHERE pseudo='$pseudo_user'")->fetchAll(\PDO::FETCH_OBJ);
        foreach ($rows as $row) {
            $user = new User();
            $user
                ->setId($row->id_user)
                ->setPrenom($row->prenom)
                ->setNom($row->nom)
                ->setPseudo($row->pseudo)
                ->setDdn($row->ddn)
                ->setMdp($row->mdp)
                ->setMail($row->mail)
                ->setNbLivresEmpruntes($row->nb_livres_empruntes)
                ->setNbLivresRendus($row->nb_livres_rendus)
                ->setAdmin($row->est_admin);
        }
        return $user;

    }


    public function creeUser($id, $nom, $prenom, $pseudo, $ddn, $mdp, $mail, $nb_livres_empruntes, $nb_livres_rendus, $est_admin) {
        $ret = new User();
        $ret->setId($id);
        $ret->setPrenom($prenom);
        $ret->setNom($nom);
        $ret->setPseudo($pseudo);
        $ret->setDdn($ddn);
        $ret->setMdp($mdp);
        $ret->setMail($mail);
        $ret->setNbLivresEmpruntes($nb_livres_empruntes);
        $ret->setNbLivresRendus($nb_livres_rendus);
        $ret->setAdmin($est_admin);
        return $ret;
    }

    public function updateUser($user) {
        $id=$user->getId();
        $prenom=$user->getPrenom();
        $nom=$user->getNom();
        $pseudo=$user->getPseudo();
        $ddn=$user->getDdn();
        $mdp=$user->getMdp();
        $mail=$user->getMail();
        $nb_livres_empruntes=$user->getNbLivresEmpruntes();
        $nb_livres_rendus=$user->getNbLivresRendus();
        $est_admin=$user->getAdmin();

        $query="UPDATE \"User\" SET prenom='$prenom', nom='$nom', pseudo='$pseudo', mdp='$mdp', mail='$mail', nb_livres_empruntes='$nb_livres_empruntes', nb_livres_rendus='$nb_livres_rendus', est_admin='$est_admin', ddn='$ddn' WHERE id_user='$id';";

        $this->connection->query("$query");

        return $query;
    }

    public function insertUser($user) {
        $id = $user->getId();
        $nom = $user->getNom();
        $prenom = $user->getPrenom();
        $pseudo = $user->getPseudo();
        $ddn = $user->getDdn();
        $mdp = $user->getMdp();
        $mail = $user->getMail();
        $nb_livres_empruntes = $user->getNbLivresEmpruntes();
        $nb_livres_rendus = $user->getNbLivresRendus();
        $est_admin= $user->getAdmin();
        /*test mais ne sert plus a rien*/
        $query="INSERT INTO \"User\"(id_user, nom, prenom, pseudo, mdp, mail, nb_livres_empruntes, nb_livres_rendus) VALUES ('$id', '$nom', '$prenom', '$pseudo', '$mdp', '$mail', '$nb_livres_empruntes', '$nb_livres_rendus');";
        $this->connection->query("$query");
        
        
        return $query;

    }




}
