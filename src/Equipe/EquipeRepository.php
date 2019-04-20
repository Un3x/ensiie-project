<?php
namespace Equipe;
use Jeu\JeuRepository;
use Membre\Membre;

class EquipeRepository
{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * EquipeRepository constructor.
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function fetchAll()
    {
        $jeuRepository = new JeuRepository($this->connection);
        
        $rows = $this->connection->query('SELECT id_jeu, id_membre, equipe.role, nom, prenom, surnom, promo, membre.role
                                          FROM "equipe" NATURAL JOIN "membre"
                                          ORDER BY id_jeu')->fetchAll(\PDO::FETCH_OBJ);
        $equipes = [];
        
        $id_jeu = -1;
        $membres = array();
        $roles = array();
        
        foreach ($rows as $row) {
            if($row->id_jeu != $id_jeu && !empty($membres)){
                $jeu = $jeuRepository->getJeu($id_jeu);
                
                $equipe = new Equipe();
                $equipe
                    ->setJeu($jeu)
                    ->setMembres($membres)
                    ->setRoles($roles);
                
                $equipes[] = $equipe;
                
                $id_jeu = $row->id_jeu;
                unset($membres);
                unset($roles);
                $membres = array();
                $roles = array();
                
            }
            
            $membre = new Membre();
            $membre
            ->setId($row->id_membre)
            ->setNom($row->nom)
            ->setPrenom($row->prenom)
            ->setSurnom($row->surnom)
            ->setPromo($row->promo)
            ->setRole($row->membre.role);
            
            $membres[] = $membre;
            $roles[membre] = $row->equipe.role;
        }

        return $equipes;
    }
}