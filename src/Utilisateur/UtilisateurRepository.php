<?php
namespace Utilisateur;
class UtilisateurRepository
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
        $rows = $this->connection->query('SELECT * FROM "utilisateur"')->fetchAll(\PDO::FETCH_OBJ);
        $utilisateurs = [];
        foreach ($rows as $row) {
            $utilisateur = new Utilisateur();
            $utilisateur
                ->setId($row->id)
                ->setPrenom($row->prenom)
                ->setNom($row->nom)
                ->setEmail($row->email)
                ->setMdp($row->mdp);

            $utilisateurs[] = $utilisateur;
        }
        return $utilisateurs;
    }

    public function userByMail($mail) {
        $user  = new Utilisateur();

        $row = $this->connection->query("SELECT * FROM utilisateur WHERE email= ".$this->connection->quote($mail))->fetch();
        $user->setEmail($row['email']);
        $user->setId($row['id']);
        $user->setPrenom($row['prenom']);
        $user->setNom($row['nom']);
        $user->setMdp($row['mdp']);

        return $user;
    }

    public function registerUser($prenom,$nom,$mail,$mdp){
        $query = $this->connection->prepare("INSERT INTO utilisateur(prenom,nom,email,mdp) VALUES(?,?,?,?)");
        return $query->execute([$prenom,$nom,$mail,$mdp]);
    }

    public function registered($mail){
        $row = $this->connection->query("SELECT COUNT(*) AS nb FROM utilisateur WHERE email= ".$this->connection->quote($mail))->fetch();
        return ($row['nb']);
    }
}
