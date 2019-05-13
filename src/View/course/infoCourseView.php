<?php $title = "Un merveilleux site pour réserver des licornes ! " ?>

<?php ob_start();?>

<div>
	nom : <?=$name ?> <br/>
	prix : <?=$price ?> €<br/>
	lieu de départ : <?=$departureName ?> <br/>
	lieu d'arrivée : <?=$arrivalName ?> <br/>
	distance : <?=$distance ?> <br/>
	durée : <?=$duration ?> <br/>
</div>

<div id='mapId' style='width: 600px; height: 400px;'></div>


<?php switch($userType) {
	case null :?>
<form action="/course/payment" method="POST">
	<input type=hidden name=carrierId value="<?=$carrierId?>" />
	<input type=hidden name=departure value="<?=$departureName?>" />
	<input type=hidden name=arrival value="<?=$arrivalName?>" />
	<input type=submit id=search value=Réserver />
</form>

<?php break; case "Vendor": ?>
<?php switch($courseStatus){ 
		case 1: //booked?>
	trajet réservé <br/>
	<form action="/course/accept" method="POST">
	<input type=hidden name=courseId value="<?=$courseId?>" />
	<input type=submit id=accept value="Accepter la réservation" />
	</form>

	<form action="/course/refuse" method="POST">
	<input type=hidden name=courseId value="<?=$courseId?>" />
	<input type=submit id=refuse value="Refuser la réservation" />
	</form>

	<?php break; case 2;//"confirmed": ?>
	trajet confirmé <br/>
	<form action="/course/cancel" method="POST">
	<input type=hidden name=courseId value="<?=$courseId?>" />
	<input type=submit id=cancel value="Annuler la réservation" />
	</form>

	<?php break; case 3: //"finished": ?>

	<?php break; case 4; //"cancelled": ?>

	<?php break; } ?>

<?php break; case "Client": ?>
	<?php switch($courseStatus){ 
		case 1; //"booked": ?>
	trajet réservé <br/>
	<form action="/course/cancel" method="POST">
	<input type=hidden name=courseId value="<?=$courseId?>" />
	<input type=submit id=cancel value="Annuler la réservation" />
	</form>

	<?php break; case 2; //"confirmed": ?>
	trajet confirmé <br/>
	<form action="/course/cancel" method="POST">
	<input type=hidden name=courseId value="<?=$courseId?>" />
	<input type=submit id=cancel value="Annuler la réservation" />
	</form>

	<?php break; case 3; //"finished": ?>
	trajet effectué <br/>

	<?php break; case 4; //"cancelled": ?>
	trajet annulé ou refusé <br/>

	<?php break; } ?>

<?php break; } ?>  

<?php $content = ob_get_clean(); ?>

<?php require('../src/View/template.php'); ?>

<link rel="stylesheet" href="/js/leaflet/leaflet.css" />
<script src="/js/leaflet/leaflet.js" ></script>

<script>
	var request = new XMLHttpRequest();
	var request2 = new XMLHttpRequest();

	request.open('GET', '/api/routing/?departureLat=<?=$departureLat?>&departureLong=<?=$departureLong?>&arrivalLat=<?=$arrivalLat?>&arrivalLong=<?=$arrivalLong?>');

	//request.setRequestHeader('Accept', 'application/json, application/geo+json, application/gpx+xml, img/png; charset=utf-8');

	request.onreadystatechange = function () {
		if (this.readyState === 4) {
			var pointList = [];

			pointList = JSON.parse(this.responseText)['data'];

			console.log(pointList);

			var polyline = new L.Polyline(pointList, {color: 'blue'});

			polyline.addTo(mymap);
			mymap.fitBounds(polyline.getBounds());
		}
	};

	request.send();

	var mymap = L.map('mapId');


	L.tileLayer('https://a.tile.openstreetmap.org/{z}/{x}/{y}.png', {
	maxZoom: 18,
	attribution: 'Map data &copy; <a href=\"https://www.openstreetmap.org/\">OpenStreetMap</a> contributors, ' +
	'<a href=\"https://creativecommons.org/licenses/by-sa/2.0/\">CC-BY-SA</a>',
	id: 'osm.streets'
	}).addTo(mymap);

	L.marker([<?=$arrivalLat?>,<?=$arrivalLong?>]).addTo(mymap);

</script>