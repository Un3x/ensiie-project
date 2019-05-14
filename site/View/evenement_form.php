<html>

<head>
<title>Créer un évènement</title>
</head>

<body>

<div class="panel panel-default">
    <div class="panel-heading text-center">
        Créer un évènement
    </div>
    <div class="panel-body">
    <form action="Controller/set_event.php" method="post">
		<div class="form-group">
			<label for="selectType">Type d'évènement : </label>
			<select name="selectType" class="form-control" id="selectType">
				<option>NJV</option>
				<option>ObiLan</option>
			</select>
		</div>
        <div class="form-group">
			<label for="nbEvent">Numéro de l'évènement : </label>
			<input id="nbEvent" type="number" name="numero" required="required">
		</div>
		<div class="form-group">
			<label for="dateStart">Date de début de l'évènement : </label>
			<input id="date_start" type="date" name="dateStart" required="required">
		</div>
        <div class="form-group">
			<label for="dateStart">Date de fin de l'évènement : </label>
			<input id="dateStart" type="date" name="dateEnd" required="required">
		</div>
        <button type="submit" class="btn btn-primary">Valider</button>
    </form>
    </div>
	<a class="btn btn-primary btn-block btn-lg" href="index.php">Retour</a>
</div>
</body>
</html>