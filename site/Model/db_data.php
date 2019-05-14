<?php

if(file_exists("Model/db_connect.php")){
	$prefixModel = "Model/";
	$prefixClasse = "Classes/";
}else if (file_exists("db_connect.php")){
	$prefixModel = "";
	$prefixClasse = "../Classes/";
}else{
	$prefixModel = "../Model/";
	$prefixClasse = "../Classes/";
}
require_once($prefixModel . 'db_connect.php');
require_once($prefixClasse . 'Evenement.php');
require_once($prefixClasse . 'Commande.php');
require_once($prefixClasse . 'Utilisateur.php');

/**@brief récupère le nom de l'evenement actuel
 *
 * @return NULL Si il n'y a aucun evenement courant
	@return Evenement si il y a un evenement
 */
function db_getActuelEvenement(){
    $pdo = $GLOBALS['connection'];
	$dateToday = date("Y-m-d");
	$statement = $pdo->prepare("SELECT * FROM event WHERE event.date_start < ? AND event.date_end > ?");
	$statement->execute([$dateToday, $dateToday]);
	$event = $statement->fetch();
	if($event == false || !isset($event))
		return NULL;
	
	$evenement = new Evenement($event['eventID'],
							   $event['typeEvent'],
							   $event['numeroEvent'],
							   $event['date_end']);
    return $evenement;
}

function db_getAllFoods(){
	$pdo = $GLOBALS['connection'];
	$statement = $pdo->prepare(
		"SELECT idPartenariat, nomPartenariat FROM partenariat"
	);
	$statement->execute();
	$parts = array();
	while($part = $statement->fetch()){
		$typeFoods = array();
		$typeFoods['Nom'] = $part['nomPartenariat'];
		$typeFoods['idPart'] = $part['idPartenariat'];
		$typeFoods['typeFood'] = array();
		$statement_typeFoods = $pdo->prepare(
			"SELECT DISTINCT TF.foodTypeID, TF.nomTypeFood
			 FROM foods AS F INNER JOIN foodtype AS TF ON F.foodTypeID = TF.foodtypeID
			 WHERE F.partID = ?
			 GROUP BY foodTypeID"
		);
		$statement_typeFoods->execute([$typeFoods['idPart']]);
		while($type_db = $statement_typeFoods->fetch()){
			$type = array();
			$type['idType'] = $type_db['foodTypeID'];
			$type['nomType'] = $type_db['nomTypeFood'];
			$type['foods'] = array();
			$statement_foods = $pdo->prepare(
				"SELECT F.isAvailable, F.nomFood, F.priceIIE, F.pricePart, F.foodID
				 FROM foods AS F
				 WHERE foodTypeID = ? AND partID = ?"
			);
			$statement_foods->execute([$type['idType'], $typeFoods['idPart']]);
			while($foods_db = $statement_foods->fetch()){
				if($foods_db['isAvailable'] == 0){
					continue; //On ajoute pas la nourriture au tableausi elle n'est pas dispo
				}
				$food = array();
				$food['foodID'] = $foods_db['foodID'];
				$food['nameFood'] = $foods_db['nomFood'];
				$food['priceFood'] = $foods_db['priceIIE'];
				$food['priceFoodLP'] = $foods_db['pricePart'];
				$food['idSpecial'] = array();
				$food['nbMinSpecial'] = array();
				$food['nbMax'] = array();
				$statement_specials = $pdo->prepare(
				"SELECT specialTypeID, nbSpecialMin, nbSpecialMax
				FROM food_has_special
				WHERE foodID = ?"
				);
				$statement_specials->execute([$food['foodID']]);
				while($spec = $statement_specials->fetch()){
					$idSpecial = $spec['specialTypeID'];
					$nbMinSpecial = $spec['nbSpecialMin'];
					$nbMax = $spec['nbSpecialMax'];
					array_push($food['idSpecial'], $idSpecial);
					array_push($food['nbMinSpecial'], $nbMinSpecial);
					array_push($food['nbMax'], $nbMax);
				}
				if(sizeof($food['idSpecial'], 0) == 0){
					$food['idSpecial'] = NULL;
					$food['nbMinSpecial'] = NULL;
					$food['nbMax'] = NULL;
				}
				array_push($type['foods'], $food);
			}
			array_push($typeFoods['typeFood'], $type);
		}
		array_push($parts, $typeFoods);
	}
	
	
	
	return $parts;
}

function db_getAllSpecials(){
	$pdo = $GLOBALS['connection'];
	$specials =array();
	$statement = $pdo->prepare(
		"SELECT TS.specialTypeID, TS.nomSpecialType, S.nomSpecialItem, S.specialItemID
		 FROM special_type TS INNER JOIN special_item S
							  ON S.specialTypeID = TS.specialTypeID
		 ORDER BY TS.specialTypeID, TS.nomSpecialType, S.nomSpecialItem"
	);
	$statement->execute();
	while($one_item = $statement->fetch()){
		$idType = $one_item['specialTypeID'];
		if(!isset($specials[$idType])){
			$specials[$idType] = array();
			$specials[$idType]['nameSpecial'] = $one_item['nomSpecialType'];
			$specials[$idType]['items'] = array();
		}
		$newItem = array();
		$newItem['nomItem'] = $one_item['nomSpecialItem'];
		$newItem['idItem'] = $one_item['specialItemID'];
		array_push($specials[$idType]['items'], $newItem);
	}
	return $specials;
}

function db_getAllUsers(){
	$pdo = $GLOBALS['connection'];
	$statement = $pdo->prepare("
		SELECT ariseID FROM utilisateur ORDER BY CASE WHEN pseudo IS NULL THEN prenom ELSE pseudo END
	");
	$statement->execute();
	$res = $statement->fetch();
	if($res == FALSE){
		return NULL;
	}
	$users = array();
	do{
		array_push($users, db_getUser($res['ariseID']));
	}while($res = $statement->fetch());
	return $users;
}

function db_getUser($idUser){
	$pdo = (isset($GLOBALS['connection']))?$GLOBALS['connection']:false;
	$statement = $pdo->prepare("
		SELECT * FROM utilisateur WHERE utilisateur.ariseID = ?
	");
	$statement->execute([$idUser]);
	$res = $statement->fetch();
	if($res == FALSE){
		return NULL;
	}
	assert($idUser == $res['ariseID']);
	return new Utilisateur(	$idUser,
							$res['prenom'],
							$res['nom'],
							$res['pseudo'],
							(($res['isAdmin'] == 0)? FALSE : TRUE),
							db_getCommandesUtilisateur($idUser)
	);
}

/** A ne pas utiliser en dehors de "db_getUser"
**/
function db_getCommandesUtilisateur($idUtilisateur){
    $evenement = db_getActuelEvenement();
    if ($evenement == NULL)
    {
        return array();
    }
	
	$pdo = $GLOBALS['connection'];
	$statement = $pdo->prepare(
		"SELECT C.idCommande, C.dateTimeCommande, C.isPaid,
				I.idItemCommande,
				F.foodID, FT.nomTypeFood, F.foodTypeID, F.nomFood,
				P.nomPartenariat, P.idPartenariat,
				F.priceIIE, F.pricePart,
				S.specialItemID, S.nomSpecialItem,
				T.specialTypeID, T.nomSpecialType
		 FROM commande AS C
			LEFT OUTER JOIN commande_item AS I ON C.idCommande = I.idCommande
			LEFT OUTER JOIN foods AS F ON F.foodID = I.idFood
			LEFT OUTER JOIN foodtype AS FT ON FT.foodTypeID = F.foodTypeID
			LEFT OUTER JOIN partenariat AS P ON P.idPartenariat = F.partID
			LEFT OUTER JOIN item_commande_has_special HS ON HS.idItemCommande = I.idItemCommande
			LEFT OUTER JOIN special_item S ON S.specialItemID = HS.idItemSpecial
			LEFT OUTER JOIN special_type T ON T.specialTypeID = S.specialTypeID
		WHERE C.userID = ? AND C.eventID = ?
		ORDER BY C.dateTimeCommande,
				 P.nomPartenariat,
				 FT.nomTypeFood,
				 F.nomFood"
	);
	$statement->execute([$idUtilisateur, $evenement->getIDEvenement()]);
	$allComands = array();
	while($res = $statement->fetch()){
		if(!isset($allComands[$res['idCommande']])){
			$allComands[$res['idCommande']]
			 = new Commande($res['idCommande'],
							$idUtilisateur,
							$res['dateTimeCommande'],
							$res['isPaid'],
							array()
						);
		}
		$tmpArray = $allComands[$res['idCommande']]->getMenus();
		$lastMenu = end($tmpArray);
		$idLastMenu = -1;
		if($lastMenu != FALSE){
			$idLastMenu = $lastMenu->getIDMenu();
		}
		if($lastMenu == FALSE || $idLastMenu != $res['idItemCommande']){
			$lastMenu = new Menu(
				$res['idItemCommande'],
				new Nourriture(
					$res['foodID'],
					$res['nomTypeFood'],
					$res['foodTypeID'],
					$res['nomFood'],
					$res['nomPartenariat'],
					$res['idPartenariat'],
					$res['priceIIE'],
					$res['pricePart']
				),
				array()
			);
			if($res['specialItemID'] != NULL){
				$lastMenu->addSpecial(new Special(
						$res['specialItemID'],
						$res['nomSpecialType'],
						$res['specialTypeID'],
						$res['nomSpecialItem']
					)
				);
			}
			$allComands[$res['idCommande']]->addMenus($lastMenu);
		}else{
			assert($idLastMenu == $res['idItemCommande']);
			if($res['specialItemID'] != NULL){
				$tempArray =$allComands[$res['idCommande']]->getMenus();
				$newMenu = end($tempArray);
				$newMenu->addSpecial(new Special(
					$res['specialItemID'],
					$res['nomSpecialType'],
					$res['specialTypeID'],
					$res['nomSpecialItem']
					)
				);
				$allComands[$res['idCommande']]->updateLastMenu($newMenu);
			}
		}
	}
	
	return $allComands;
}

/**
 * @brief Ajoute une commande à la BDD
 * @param $utilisateur
 *      La variable utilisateur contenant toutes les informations importantes
 * @param $evenement
 *      La variable contenant les informations de l'évenement pour lequel l'utilisateur commande
 * @param $commande
 *      La variable contenant les informations de la commande
 */

function addCommande($utilisateur, $evenement, $commande){
    $actuel_evenement = db_getActuelEvenement();
    assert(strtotime($commande->getDate()) < strtotime($actuel_evenement->getDate()));
	$pdo = $GLOBALS['connection'];
	$statement = $pdo->prepare(
		"INSERT INTO commande (userID, eventID, dateTimeCommande, isPaid)
		 VALUES (?, ?, ?, ?)"
	);
	$date = $commande->getDate();
	if(!$statement->execute([$commande->getUtilisateurID(),
							 $actuel_evenement->getIDEvenement(),
							 $date,
							 0,
							]))
	{
		throw new Exception("Can't insert Commande !");
	}
	$idCommande = $pdo->lastInsertId();
	foreach($commande->getMenus() as $menu){
		$statement_commandeItem = $pdo->prepare(
			"INSERT INTO commande_item (idCommande, idFood)
			 VALUES (?, ?)"
		);
		if(!$statement_commandeItem->execute([$idCommande,
											  $menu->getNourriture()->getIDNourriture()	
											 ])){
			 throw new Exception("Can't insertcommande_item");
		 }
		$idCommandeItem = $pdo->lastInsertId();
		$specials = $menu->getSpecials();
		if($specials != NULL && !empty($specials)){
			foreach($specials as $spec){
				$statement_itemSpecial = $pdo->prepare(
					"INSERT INTO item_commande_has_special (idItemCommande, idItemSpecial)
					 VALUES (?, ?)" 
				);
				if(!$statement_itemSpecial->execute([$idCommandeItem,$spec->getIDSpecial()])){
					throw new Exception("Can't insert item_commande_has_special");
				}
			}
		}
	}
}

function db_addEvenement($evenement, $dateStart)
{
	if($dateStart >= $evenement->getDate())
		return FALSE;
	$pdo = $GLOBALS['connection'];
	$statementAllDates = $pdo->prepare(
		"SELECT date_end FROM event"
	);
	$statementAllDates->execute();
	while($date_end = $statementAllDates->fetch()){
		if($date_end['date_end'] >= $dateStart)
			return FALSE;
	}
	$statementAdd = $pdo->prepare(
		"INSERT INTO event (typeEvent, numeroEvent, date_start, date_end)
		 VALUES (?, ?, ?, ?)"
	);
	if(!$statementAdd->execute([$evenement->getType(), $evenement->getNumero(), $dateStart, $evenement->getDate()])){
		throw new Exception("Can't insert event !");
	}
	return TRUE;
	//INSERT INTO `event` (`eventID`, `typeEvent`, `numeroEvent`, `date_start`, `date_end`) VALUES
	//($evenement->getIDevenement(), '$evenement->getType()', $evenement->getNumero(), $evenement->getDate(), '2019-03-01')
}

?>