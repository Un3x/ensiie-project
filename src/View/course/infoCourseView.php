<?php $title = "Un merveilleux site pour réserver des licornes ! " ?>

<?php ob_start(); ?>

<div>
	date : <?=$date ?> <br/> 
	nom : <?=$name ?> <br/>
	prix : <?=$price ?> €<br/>
	lieu de départ : <?=$departure ?> <br/>
	heure de départ : <?=$departureTime ?> <br/>
	lieu d'arrivée : <?=$arrival ?> <br/>
	heure d'arrivée : <?=$arrivalTime ?> <br/>
</div>

<div id='mapId' style='width: 600px; height: 400px;'></div>

<form action="index.php?action=payment" method="POST">
	<input type=hidden name=nom value=<?=$name?> />
	<input type=hidden name=departure value=<?=$departure?> />
	<input type=hidden name=arrival value=<?=$arrival?> />
	<input type=hidden name=date value=<?=$date?> />
	<input type=hidden name=departureTime value=<?=$departureTime?> />
	<input type=submit id=search value=Réserver />
</form>
    

<?php $content = ob_get_clean(); ?>

<?php require('../src/View/template.php'); ?>

<link rel="stylesheet" href="js/leaflet/leaflet.css" />
<script src="js/leaflet/leaflet.js" ></script>

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

	var mymap = L.map('mapId').setView([28.63, 77.22], 13);


	L.tileLayer('https://a.tile.openstreetmap.org/{z}/{x}/{y}.png', {
	maxZoom: 18,
	attribution: 'Map data &copy; <a href=\"https://www.openstreetmap.org/\">OpenStreetMap</a> contributors, ' +
	'<a href=\"https://creativecommons.org/licenses/by-sa/2.0/\">CC-BY-SA</a>',
	id: 'osm.streets'
	}).addTo(mymap);

	L.marker([<?=$arrivalLat?>,<?=$arrivalLong?>]).addTo(mymap);

</script>