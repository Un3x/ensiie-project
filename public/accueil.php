<?php

function getFirstWeekDay() {
    $dayArray = array(0 => 'Monday', 1 => 'Tuesday', 2 => 'Wednesday', 3 => 'Thursday', 4 => 'Friday', 5 => 'Saturday', 6 => 'Sunday');
    $sDay = date("l");
    $nDay = date("d");
    $fDay = $nDay - array_search($sDay,$dayArray);
    return $fDay;
}
function getTimeInterval() {
    $fDay = getFirstWeekDay();
    if($fDay > 10) {
        $dateF = date("Y")."-".date("m")."-".$fDay;
    }
    else {
        $dateF = date("Y")."-".date("m")."-0".$fDay;
    }
    if(($fDay+6) > 10) {
        $dateL = date("Y")."-".date("m")."-".($fDay+6);
    }
    else {
        $dateL = date("Y")."-".date("m")."-0".($fDay+6);
    }
    $array = array(0 => $dateF, 1 => $dateL);
    return $array;
}

function getDay($date) {
    $day = explode('-',$date);
    return $day[2];
}

function demandesurlecote($connexion){
	$arr_days = getTimeInterval();
	$dateF = date("Y")."-".date("m")."-".(date("d")+1);
	$dateL = date("Y")."-0".(date("m")+1)."-".date("d");
    $utilisateur=$_SESSION['Pseudo'];
    $result=$connexion->query("SELECT point_fort FROM compte WHERE id_pseudo_compte='$utilisateur';")->fetchAll();

    echo "<ul>";
    foreach($result as $row){
        $result2=$connexion->query("SELECT * FROM aide WHERE jour >= '$dateF' AND jour <= '$dateL' AND aide_matiere='".$row['point_fort']."';")->fetchAll();
        foreach($result2 as $sortiedemande){
        if($sortiedemande['valide']==false){
            echo "
            <div id = ".$sortiedemande['id_aide']." style ='border-width:1px;
				 border-style:solid; 
				 padding: 0;
				 text-align: center'>
					<p><strong>".$sortiedemande['pseudo_aide']."</strong></p>
					<p>Matière : ".$sortiedemande['aide_matiere']."</p>
					<p>".$sortiedemande['jour']."<br>".$sortiedemande['heure']."h00</p>
					<input class='bouton5' type='button' value='Valider' onclick='acceptRequest(this);'>				
				 </div>
                 <br></br>
                 ";
        }
    }
    }
    echo "</ul>";

}

function acceptRequest($connexion,$id){
    $pseudo = $_SESSION['Pseudo'];
    $connexion->query("UPDATE aide SET valide = true, pseudo_aidant = '".$pseudo."' WHERE id_aide = $id ");
}

function loadEDT($connexion) {
	$pseudo=$_SESSION['Pseudo'];
	$arr_days = getTimeInterval();
	$dateF = $arr_days[0];
	$dateL = $arr_days[1];
	$fDay =getFirstWeekDay();
	$curr_index = 0;
	$result = $connexion->query("SELECT * from aide WHERE (pseudo_aide = '$pseudo' OR pseudo_aidant = '$pseudo') AND jour <= '$dateL' AND jour >= '$dateF' AND valide = true ORDER BY heure,jour")->fetchAll();


	echo '<table class ="col-lg-9"style="margin-left: 30px">
			<tr>
				<th> </th>
					<th class = "textcentrer"> Lundi</th>
					<th class = "textcentrer">Mardi</th>
					<th class = "textcentrer">Mercredi</th>
					<th class = "textcentrer">Jeudi</th>
					<th class = "textcentrer">Vendredi</th>
					<th class = "textcentrer">Samedi</th>
					<th class = "textcentrer">Dimanche</th>
				</tr>';
	for($i = 8; $i <= 20; $i++) {
		echo '<tr><td>'.$i.'h00</td>';
		for($j = 1; $j <=7 ; $j++) {
			if($curr_index != count($result) && $i == ($result[$curr_index]['heure']) && ($j-1)==((getDay($result[$curr_index]['jour']))-$fDay)) {
				$nom_partenaire = '';
				if($pseudo == $result[$curr_index]['pseudo_aidant']) {
					$nom_partenaire = $result[$curr_index]['pseudo_aide'];
				}
				else {
					$nom_partenaire = $result[$curr_index]['pseudo_aidant'];
				}
				echo '<td>Matière : '.$result[$curr_index]['aide_matiere'].'<br> avec '.$nom_partenaire.'</td>';
				$curr_index++;
			}
			else {
				echo '<td></td>';
			}
		}
		echo '</tr>';
	}
	echo '</table';
}

function testAdmin($connexion) {
	$pseudo = $_SESSION['Pseudo'];
	$result = $connexion->query("SELECT * FROM utilisateur WHERE id_pseudo = '$pseudo' AND isAdmin = true")->fetchAll();
    if(!empty($result)) { 
        echo 1;
    }
    else {
        echo 0;
    }
}

function banUser($connexion) {
	$user = $_POST['user'];
	echo "DELETE FROM aide WHERE pseudo_aide = '$user' OR pseudo_aidant = '$user'";
	$connexion->query("DELETE FROM aide WHERE pseudo_aide = '$user' OR pseudo_aidant = '$user'");
	$connexion->query("DELETE FROM compte WHERE id_pseudo_compte = '$user'");
	$connexion->query("DELETE FROM utilisateur WHERE id_pseudo = '$user'");
}

$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connexion = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
session_start();
if (isset($_POST['fun'])) {
	if($_POST['fun'] == 'lEDT') {
		loadEDT($connexion);
	}
	if($_POST['fun'] == 'dem') {
		demandesurlecote($connexion);
	}
    if($_POST['fun'] == 'accept') {
        acceptRequest($connexion,$_POST['id_aide']);
    }
    if($_POST['fun'] == 'testAdmin') {
    	testAdmin($connexion);
    }
    if($_POST['fun'] == 'banUser') {
    	banUser($connexion);
    }
}

?>