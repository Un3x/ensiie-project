<?php
require_once('Nourriture.php');
require_once('Special.php');
class Menu
{
    /**
     * @var int id de la BDD
     */
    private $idMenu;

    /**
     * @var Nourriture contennat les infos de ce qui est acheté
     */
    private $nourriture;

    /**
     * @var array<Special> contenant les sauces, viandes, etc...
     */
    private $specials;

    /**
     * Constructeur valué
     */
    public function __construct($idMenu,$nourriture,$specials)
    {
        $this->idMenu = $idMenu;
        $this->nourriture = $nourriture;
        $this->specials= $specials;
    }
	
    public function getIDMenu()
    {
        return $this->idMenu;
    }
	
    public function setIDMenu($id)
    {
        $this->idMenu = $id;
    }

	public function getNourriture()
    {
        return $this->nourriture;
    }
	
    public function setNourriture($nourriture)
    {
        $this->nourriture = $nourriture;
    }

	public function getSpecials()
    {
        return $this->specials;
    }
	
    public function setSpecials($specials)
    {
        $this->specials = $specials;
    }

	public function addSpecial($special){
		array_push($this->specials, $special);
	}
	
    public function getNbSauces()
    {
        $nb = 0;
        foreach($specials as $special)
        {
            if ($special->getType() == "Sauce")
            {
                $nb++;
            }
        }
        return $nb;
    }

    public function toString()
    {
        $str = "";
        $str = $str.$this->getNourriture()->toString();
        foreach($this->getSpecials() as $special)
        {
            $str = $str.", ".$special->toString();
        }
        return $str;
    }
}

?>