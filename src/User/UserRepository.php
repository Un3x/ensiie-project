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
        $rows = $this->connection->query('SELECT * FROM "utilisateur"')->fetchAll(\PDO::FETCH_OBJ);
        $users = [];
        foreach ($rows as $row) {
            $user = new User();
            $user
                ->setId($row->id)
                ->setFirstname($row->firstname)
                ->setLastname($row->lastname)
                ->setBirthday(new \DateTimeImmutable($row->birthday))
                ->setLocation($row->loc)
                ->setMail($row->mail)
                ->setMdp($row->mdp)
                //->setProfilePicture($row->pp); //pour l'avoir il faut faire une jointure avec la table : photo_profil
                ->setAdministrateur($row->administrateur)
                ->setValid($row->valid);

            $users[] = $user;
        }

        return $users;
    }

    public function fetchAllUnvalid()
    {
        $rows = $this->connection->query('SELECT * FROM "utilisateur" WHERE valid=0')->fetchAll(\PDO::FETCH_OBJ);
        $users = [];
        foreach ($rows as $row) {
            $user = new User();
            $user
                ->setId($row->id)
                ->setFirstname($row->firstname)
                ->setLastname($row->lastname)
                ->setBirthday(new \DateTimeImmutable($row->birthday))
                ->setLocation($row->loc)
                ->setMail($row->mail)
                ->setMdp($row->mdp)
                //->setProfilePicture($row->pp); //pour l'avoir il faut faire une jointure avec la table : photo_profil
                ->setAdministrateur($row->administrateur)
                ->setValid($row->valid);

            $users[] = $user;
        }

        return $users;
    }

    public function fetchAllDeleteByAdmin()
    {
        $rows = $this->connection->query('SELECT * FROM "utilisateur" WHERE valid=2')->fetchAll(\PDO::FETCH_OBJ);
        $users = [];
        foreach ($rows as $row) {
            $user = new User();
            $user
                ->setId($row->id)
                ->setFirstname($row->firstname)
                ->setLastname($row->lastname)
                ->setBirthday(new \DateTimeImmutable($row->birthday))
                ->setLocation($row->loc)
                ->setMail($row->mail)
                ->setMdp($row->mdp)
                //->setProfilePicture($row->pp); //pour l'avoir il faut faire une jointure avec la table : photo_profil
                ->setAdministrateur($row->administrateur)
                ->setValid($row->valid);

            $users[] = $user;
        }

        return $users;
    }

    public function fetchAllDeleteByUser()
    {
        $rows = $this->connection->query('SELECT * FROM "utilisateur" WHERE valid=3')->fetchAll(\PDO::FETCH_OBJ);
        $users = [];
        foreach ($rows as $row) {
            $user = new User();
            $user
                ->setId($row->id)
                ->setFirstname($row->firstname)
                ->setLastname($row->lastname)
                ->setBirthday(new \DateTimeImmutable($row->birthday))
                ->setLocation($row->loc)
                ->setMail($row->mail)
                ->setMdp($row->mdp)
                //->setProfilePicture($row->pp); //pour l'avoir il faut faire une jointure avec la table : photo_profil
                ->setAdministrateur($row->administrateur)
                ->setValid($row->valid);

            $users[] = $user;
        }

        return $users;
    }

    public function searchUser($search){
        $rows=$this->connection->query("SELECT * FROM \"utilisateur\" WHERE id LIKE '%".$search."%' OR firstname LIKE '%".$search."%' OR lastname LIKE '%".$search."%' ")->fetchAll(\PDO::FETCH_OBJ);
        $users=[];
        foreach ($rows as $row) {
            $user = new User();
            $user
                ->setId($row->id)
                ->setFirstname($row->firstname)
                ->setLastname($row->lastname)
                ->setBirthday(new \DateTimeImmutable($row->birthday))
                ->setLocation($row->loc)
                ->setMail($row->mail)
                ->setMdp($row->mdp)
                ->setAdministrateur($row->administrateur)
                ->setValid($row->valid);
            $users[] = $user;
        }
        return $users;

    }

    public function testmail($mailtest){
        $rows=$this->connection->query("SELECT * FROM \"utilisateur\" WHERE mail='".$mailtest."';")->fetchAll(\PDO::FETCH_OBJ);
        $users=[];
        foreach ($rows as $row) {
            $user = new User();
            $user
                ->setId($row->id)
                ->setFirstname($row->firstname)
                ->setLastname($row->lastname)
                ->setBirthday(new \DateTimeImmutable($row->birthday))
                ->setLocation($row->loc)
                ->setMail($row->mail)
                ->setMdp($row->mdp)
                ->setAdministrateur($row->administrateur)
                ->setValid($row->valid);
            $users[] = $user;
        }
        return $users;

    }

    public function testpseudo($pseudotest){
        $rows=$this->connection->query("SELECT * FROM utilisateur WHERE id='".$pseudotest."';")->fetchAll(\PDO::FETCH_OBJ);
        $users=[];
        foreach ($rows as $row) {
            $user = new User();
            $user
                ->setId($row->id)
                ->setFirstname($row->firstname)
                ->setLastname($row->lastname)
                ->setBirthday(new \DateTimeImmutable($row->birthday))
                ->setLocation($row->loc)
                ->setMail($row->mail)
                ->setMdp($row->mdp)
                ->setAdministrateur($row->administrateur)
                ->setValid($row->valid);
            $users[] = $user;
        }
        return $users;

    }

    public function getPhoto($pseudo){
        $rows=$this->connection->query("SELECT * FROM photo JOIN utilisateur ON photo_id=id_photo WHERE id='".$pseudo."';")->fetchAll(\PDO::FETCH_OBJ);
        $chemin="/uploads/".$rows[0]->id_photo.".".$rows[0]->extension;
        return $chemin;
        
    }

    public function afficheUser($user){
        $chemin=$this->getPhoto($user->getId());
        if ($user->getValid()==1){
        echo "<a href=\"pageProfil.php?pseudo=".$user->getId()."\">
        <div class=\"produit\">
        <div class=\"photo_prod\">
        <img class =\"preview\" src=\"".$chemin."\" alt=\"photo de profil\"/>
        </div>
        <div class=\"text_prod\">
        <p>
        <span class=\"titre_prod\">".$user->getId()."</span><br/><br/>
        <span class=\"prix_prod\">".$user->getAge()." ans</span><br/><br/>
        <span class=\"details\">".$user->getLocation()."</span>
        </p>
        </div>
        </div>
        </a>";
        }
    }

    public function afficheUserEvenUnvalid($user){
        $chemin=$this->getPhoto($user->getId());
        echo "<a href=\"pageProfil.php?pseudo=".$user->getId()."\">
        <div class=\"produit\">
        <div class=\"photo_prod\">
        <img class =\"preview\" src=\"".$chemin."\" alt=\"photo de profil\"/>
        </div>
        <div class=\"text_prod\">
        <p>
        <span class=\"titre_prod\">".$user->getId()."</span><br/><br/>
        <span class=\"prix_prod\">".$user->getAge()." ans</span><br/><br/>
        <span class=\"details\">".$user->getLocation()."</span>
        </p>
        </div>
        </div>
        </a>";
        
    }


}
?>