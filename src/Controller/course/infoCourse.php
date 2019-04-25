<link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA==" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js" integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg==" crossorigin=""></script>

<?php
	/*
	require '../vendor/autoload.php';
	require '../src/model/course/CourseManager.php';

	//postgres
	$dbName = getenv('DB_NAME');
	$dbUser = getenv('DB_USER');
	$dbPassword = getenv('DB_PASSWORD');
	$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");


	$CourseManager = new \City\CityManager($connection);

	$courses = $CourseManager->searchCourses();
	*/

	$name="aa";
	$price=20;
	$departure=$_GET['departure'];
	$departureTime="15-48";
	$arrival=$_GET['arrival'];
	$arrivalTime="17-23";

	$key = "5b3ce3597851110001cf6248c6e87f2691cf4b8aad0d91e3fa3f3de1";
	$departureLat = 49.41461;
	$departureLong = 8.681495;
	$arrivalLat = 49.420318;
	$arrivalLong = 8.687872;

?>


<div>
	nom : <?=$name ?> <br/>
	prix : <?=$price ?> €<br/>
	lieu de départ : <?=$departure ?> <br/>
	heure de départ : <?=$departureTime ?> <br/>
	lieu d'arrivée : <?=$arrival ?> <br/>
	heure d'arrivée : <?=$arrivalTime ?> <br/>
</div>
<div id='mapid' style='width: 600px; height: 400px;'></div>

<form action="index.php?action=payment" method="POST">
	<input type=hidden id=id value=<?=$name?> />
	<input type=hidden id=departure value=<?=$name?> />
	<input type=hidden value=<?=$name?> />
	<input type=hidden value=<?=$name?> />
	<input type=hidden value=<?=$name?> />
	<input type=hidden value=<?=$name?> />
	<input type=submit id=search value=Réserver />
</form>



<script>
	var request = new XMLHttpRequest();

	request.open('GET', 'https://api.openrouteservice.org/v2/directions/driving-car?api_key=<?=$key?>&start=<?=$departureLong?>,<?=$departureLat?>&end=<?=$arrivalLong?>,<?=$arrivalLat?>');

	//request.setRequestHeader('Accept', 'application/json, application/geo+json, application/gpx+xml, img/png; charset=utf-8');

	request.onreadystatechange = function () {
		if (this.readyState === 4) {
			var pointList = [];

			for (coord of JSON.parse(this.responseText)['features']['0']['geometry']['coordinates']){
				pointList.push(coord.reverse());
			}

			var polyline = new L.Polyline(pointList, {color: 'blue'});

			polyline.addTo(mymap);
			mymap.fitBounds(polyline.getBounds());
		}
	};



	request.send();

	var mymap = L.map('mapid').setView([28.63, 77.22], 13);


	L.tileLayer('https://a.tile.openstreetmap.org/{z}/{x}/{y}.png', {
	maxZoom: 18,
	attribution: 'Map data &copy; <a href=\"https://www.openstreetmap.org/\">OpenStreetMap</a> contributors, ' +
	'<a href=\"https://creativecommons.org/licenses/by-sa/2.0/\">CC-BY-SA</a>',
	id: 'osm.streets'
	}).addTo(mymap);

	L.marker([<?=$arrivalLat?>,<?=$arrivalLong?>]).addTo(mymap);

</script>

