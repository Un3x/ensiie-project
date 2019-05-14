<?php
include('./admin/functions.php');
// On prolonge la session
session_start();
// On teste si la variable de session existe et contient une valeur
if(empty($_SESSION['login']) || empty($_SESSION['president'])) 
{
  // Si inexistante ou nulle, on redirige vers le formulaire de login
  header('Location: authentification.php');
  exit();
}

  //Gros machin copié depuis authentification.php
require '../vendor/autoload.php';
//postgres
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$userRepository = new \User\UserRepository($connection);
$users = $userRepository->fetchAll();
$user = $users[$_SESSION['login']];

$assos_pres = $connection->query('select * from associations where president='.$user->getId())->fetchAll(\PDO::FETCH_OBJ);
displayHeader();
?>

<header class="header de page">
    
    <h1 id = "PagePresident"> <label> Gestion Présidence : </label> </h1></header>
<form action="admin/president_controller.php" method="post" style="border:solid grey 1px;">
<fieldset>
  <label for="association">Gérer l'association : </label>
	<select id="association" name="association">
	<?php foreach ($assos_pres as $asso):?>
	<option value="<?php echo $asso->id_asso ?>" <?php if (!empty($_SESSION['association'])): if ($asso->id_asso == $_SESSION['association']): echo 'selected="selected"'; endif; endif; ?> ><?php echo $asso->name ?></option>
	<?php endforeach; ?>
	</select>
	<input type="submit" name="submit" value="Gérer"/>
</fieldset>
</form>

<?php 
if (!empty($_SESSION['association'])):
$events=$connection->query('select * from events where id_asso='.$_SESSION['association'])->fetchAll(\PDO::FETCH_OBJ);
?>


<div class="gestion" id="gestion_evenements">

	<table class="table table-bordered table-hover table-striped">
		<caption>Récapitulatif des évènements</caption>
		<tr>
			<th>Evenement</th>
			<th>Date</th>
			<th>Description</th>
			<th>Coeff</th>
		</tr>
		<?php foreach ($events as $event) : ?>
		<tr>
			<form method="post" action="admin/president_controller.php">
			<td> <input type="text"  name="nameevent" class="tableinput" value="<?php echo $event->name ?>" /> </td>
			<td><input type="date"  name="dateevent" class="tableinput" value="<?php echo $event->date_ev ?>"></td>
			<td><input type="textarea"  name="descriptionevent" class="tableinput" value="<?php echo $event->description_event ?>"></td>
			<td><input type="text"  name="coeffevent" class="tableinput" value="<?php echo $event->coeff_event ?>"></td>
			<td class="actions">
				<input type="number" value="<?php echo $event->id_event ?>" name="idevent" class="idevent" readonly/>
				<input type="submit" name="submit" value="Modifier"/>
				<input type="submit" name="detail" value="Détails" />
				<input type="submit" name="suppr" value="Supprimer"/>
			</td>
			</form>

		</tr>
		<?php endforeach; ?>
	</table>
	

	<form action="admin/president_controller.php" method="post">
		<fieldset>
		<legend>Créer un évènement</legend>
		<p>
		<label for="event_name">Nom : </label>
		<input type="text" name="event_name" value=""/>
		</p>

		<p>
		<label for="event_date">Date : </label>
		<input type="date" name="event_date" value=""/>
		</p>

		<p>
		<label for="event_desc">Description : </label>
		<textarea class="desc" rows="5" cols="50" name="event_desc">Insérer la description</textarea>
		</p>
		<p>
		<label for="coeff_event">coefficient : </label>
		<input type="number" name="coeff_event" value="0" min="1" max="10"/>
		</p>
		<input type="submit" name="submit" value="Créer l'évènement"/>
		</fieldset>
	</form>
</div>

<div class="gestion" id="gestion_eleve">
<?php $eleves = $connection->query("select * from pointsassos_prop left join users using (id_user) where id_asso=".$_SESSION['association'])->fetchAll(\PDO::FETCH_OBJ);
foreach ($eleves as $eleve) {
	$connection->query("insert into pointsassos (id_user,id_asso,notation,proposition) values (".$eleve->id_user.",".$_SESSION['association'].",".$eleve->moyenne.",".$eleve->moyenne.")");
	$connection->query("update pointsassos set proposition=".$eleve->moyenne." where id_user=".$eleve->id_user." and id_asso=".$_SESSION['association']);
}
$eleves = $connection->query("select * from pointsassos left join users using (id_user) where id_asso=".$_SESSION['association']." order by year desc,notation desc")->fetchAll(\PDO::FETCH_OBJ);
?>
	<table class="table table-bordered table-hover table-striped">
		<caption>Classement des élèves</caption>
		<tr>
			<th>Prénom</th>
			<th>Nom</th>
			<th>Pseudo</th>
			<th>Promo</th>
			<th>Proposition</th>
			<th>moyenne</th>
		</tr>
		<?php foreach ($eleves as $eleve) : ?>
		<tr>
			<form method="post" action="admin/president_controller.php">
			<td> <?php echo $eleve->firstname ?> </td>
			<td> <?php echo $eleve->lastname ?> </td>
			<td> <?php echo $eleve->pseudo ?> </td>
			<td> <?php echo $eleve->year+3 ?></td>
			<td> <?php echo $eleve->proposition ?> </td>
			<td><input type="number" min="1" max="10" name="points" class="tableinput" value="<?php echo $eleve->notation ?>"></td>
			<td class="actions">
				<input type="number" value="<?php echo $eleve->id_user ?>" name="usertomodif" class="idevent" readonly/>
				<input type="submit" name="submit" value="Modifier" />
				<input type="submit" name="suppr_eleve" value="Supprimer"/>
			</td>
			</form>

		</tr>
		<?php endforeach; ?>
	</table>

<legend>Rajouter un élève</legend>
<label>Rechercher</label>
<input type="text" id="ajout"/>
<button id="ajout_submit">Ajouter</button>

</div>

<div class="gestion" id="gestion_transmission">
<legend>Changer de président</legend>
<label>Rechercher</label>
<input type="text" id="passation"/>
<button id="passation_submit">Transmettre</button>

</div>

<?php endif; ?>

<script src="assets/jquery.min.js"></script>
<script src="assets/awesomplete.min.js"></script>
<script>
$("#ajout_submit").prop("disabled",true);
$("#passation_submit").prop("disabled",true);
var users_list = [],
		user_selected;
$.get("ajax/users_get.php", function(users) {
	users.forEach(function(u) {
		users_list.push({
			label: u['lastname'] + " '" + u['pseudo'] + "' " + u['firstname'],
			value: u['id_user']
		})
	})
	var input = document.getElementById("ajout");
	new Awesomplete(input, {
		list: users_list,
		replace: function(suggestion) {
			this.input.value = suggestion.label;
//			console.log(suggestion);
			$("#ajout_submit").prop("disabled",false);
			user_selected = suggestion.value;
		}
	});
	var input2 = document.getElementById("passation");
	new Awesomplete(input2, {
		list: users_list,
		replace: function(suggestion) {
			this.input.value = suggestion.label;
//			console.log(suggestion);
			$("#passation_submit").prop("disabled",false);
			user_selected_passation = suggestion.value;
		}
	});

$("#ajout_submit").on("click", function() {
	$.get("ajax/pointassos_set.php",{user: user_selected},'json');
	location.reload();	
})
$("#passation_submit").on("click", function() {
	$.get("ajax/passation_set.php",{user_passation: user_selected_passation},'json');
	
	window.location.replace('passation.php');
})

}, 'json');
</script>


</body>
</html>
