<?php
require_once('Menu.php');
class Commande
{
    /**
     * @var int id de la BDD
     */
    private $idCommande;

    /**
     * @var int ID de l'utilisateur qui a commandé
     */
    private $utilisateurID;

	/**
     * @var string "2019-04-04 18:25:10.000000"
     */
    private $date;

    /**
     * @var boolean Si la commande a été payée ou pas
     */
    private $isPaid;

	/**
	* @var array<Menu> Le tableau qui contient les différents menus
	*/
	private $menus = array();
    /**
     * Constructeur valué
     */
    public function __construct($idCommande, $utilisateurID, $date, $isPaid, $menus)
    {
        $this->idCommande = $idCommande;
        $this->utilisateurID = $utilisateurID;
        $this->date = $date;
        $this->isPaid = $isPaid;
		$this->menus = $menus;
    }
	
    public function getIDCommande()
    {
        return $this->idCommande;
    }

	public function getUtilisateurID()
    {
        return $this->utilisateurID;
    }
	
	public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

	public function getPaid() 
    {
        return $this->isPaid;
    }
	
	public function getMenus() 
    {
        return $this->menus;
    }
	
	public function addMenus($menu){
		array_push($this->menus, $menu);
    }
    
	public function updateLastMenu($newMenu){
		array_pop($this->menus);
		$this->addMenus($newMenu);
	}
	
    public function toString(){
        $str = "";
        foreach($this->getMenus() as $menu)
        {
            $str = $str."-".$menu->toString()."<br/>";
        }
        return $str;
    }
}

?>