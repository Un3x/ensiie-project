<?php
require_once('Commande.php');
class Utilisateur
{
    /**
     * @var string
     */
    private $ariseID;

    /**
     * @var string
     */
    private $prenom;

    /**
     * @var string
     */
    private $nom;

    /**
     * @var string
     */
    private $pseudo;

    /**
     * @var bool
     */
    private $isAdmin;

    /**
     * @var array<Commande> Commandes de l'evenement courrant
     */
    private $commandes;


    /**
     * Constructeur valué
     */
    public function __construct($ariseID,$prenom,$nom,$pseudo,$isAdmin,$commandes)
    {
        $this->ariseID = $ariseID;
        $this->prenom = $prenom;
        $this->nom = $nom;
        $this->pseudo = $pseudo;
        $this->isAdmin = $isAdmin;
		$this->commandes = $commandes;
    }

    /**
     * @return int
     */
    public function getAriseID()
    {
        return $this->ariseID;
    }

    /**
     * @param int $ariseID
     * @return Utilisateur
     */
    public function setAriseID($ariseID)
    {
        $this->ariseID = $ariseID;
        return $this;
    }

    /**
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     * @return Utilisateur
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
        return $this;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     * @return Utilisateur
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return string
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * @param string $pseudo
     * @return Utilisateur
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
        return $this;
    }
  
    /**
     * @return string
     */
    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * @param string $isAdmin
     * @return Utilisateur
     */
    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;
        return $this;
    }

    /**
     * @return string
     */
    public function getCommandes()
    {
        return $this->commandes;
    }

    /**
     * @param string $commandes
     * @return Utilisateur
     */
    public function setCommandes($commandes)
    {
        $this->commandes = $commandes;
        return $this;
    }
	
    public function addCommande($com)
    {
		array_push($this->commandes, $com);
    }
    
    public function removeCommande($com)
    {
        $arr = array();
        foreach($this->getCommandes() as $commande)
        {
            if ($commande != $com)
            {
                array_push($arr,$commande);
            }
        }
        $utilisateur->setCommandes($arr);
    }
}

?>