<?php
include('./admin/functions.php');
// On prolonge la session
session_start();
// On teste si la variable de session existe et contient une valeur
if(empty($_SESSION['login']) || empty($_SESSION['bde'])) 
{
	// Si inexistante ou nulle, on redirige vers le formulaire de login
	header('Location: http://localhost:8080/authentification.php');
	exit();
}
displayHeader();

?>

<header class="header de page">
    
    <h1 id = "PageBDE"> <label> Gestion BDE : </label> </h1></header>

  <table>
	<tr>
	  <td>Consulter points associatifs de(s) l'année(s) : </td>
	  <td>
		<select id="promoAnnee" multiple="multiple" size="4">
		  <option value="2018" selected="selected">1A (Promo 2021)</option>
		  <option value="2017">2A (Promo 2020)</option>
		  <option value="2016">3A (Promo 2019)</option>
		  <option value="2015">4A (Promo 2018)</option>
		</select>
	  </td>
	  <td> pour l(es) association(s) : </td>
	  <td>
		<select id="association" multiple="multiple" size="4">
		  <option>Aucune Asso</option>
		</select>
	  </td>
	  <td class="choix hide">ordonner par:</td>
	  <td class="choix hide">
		<select id="ordre">
		  <option value="lastname">nom</option>
		  <option value="pseudo">pseudo</option>
		  <option value="notation">points associatif</option>
		</select>
	  </td>
	  <td class="choix hide">
		<button onclick="action_exp()">CSV</button>
	  </td>
	</tr>
  </table>

  <button onclick="action_aff()">Rechercher</button>

  <table id="res">
	<thead>
	  <tr>
		<th>Firstname </th>
		<th>Lastname </th>
		<th>Pseudo </th>
	  </tr>
	</thead>
	<tbody></tbody>
  </table>

<script src="jquery.min.js">

</script>
<script>
var asso_name = [];
$.get("asso.php", function (asso) {
	console.log(asso);
	$("#association option").remove();
	asso.forEach(function(u) {
		asso_name[u['id_asso']] = u['name'];
		$("#association").append('<option value="' + u['id_asso'] + '">' + u['name'] + '</option>');
	})
}, 'json');


function action_aff() {
	$(".choix").removeClass("hide");
	var year = $("#promoAnnee").val(),
		asso = $("#association").val(),
		ordre = $("#ordre").val();
	$.get("users.php", { "year": year, "asso": asso, "order": ordre }, function (users) {
		if (asso.length == 1 && ordre == 'notation') {
			var asso_id = asso[0];
			users.sort(function(a,b) {
				var va = a['asso'][asso_id] || 0,
					vb = b['asso'][asso_id] || 0;
				return va < vb;
			})
		}
		console.log(asso_id, users);
		$("#res thead tr").remove();
		$("#res thead").append('<tr><th>Firstname</th><th>Lastname</th><th>Pseudo</th></tr>');
		asso.forEach(function(asso_id) {
			$("#res thead tr").append('<th>' + asso_name[asso_id] + '</th>');
		})
		$("#res tbody tr").remove();
		users.forEach(function(u) {
			var ligne = '<tr><td>' + u['firstname'] + '</td><td>' + u['lastname'] + '</td><td>' + u['pseudo'] + '</td>';

			asso.forEach(function(asso_id,index) {
				var v = '';
				if (u['asso'][asso_id]) {
					v = u['asso'][asso_id];
				}
				ligne += '<td>' + v + '</td>';
			})

			ligne += '</tr>';
			$("#res tbody").append(ligne);
		})
	}, 'json');
}

function action_exp() {
	var year = $("#promoAnnee").val(),
		ordre = $("#ordre").val(),
		asso = $("#association").val(),
		arg = "users.php?export=1";
	year.forEach(function(annee) {
		arg += "&year[]=" + annee;
	});
	arg += "&order=" + ordre;
	asso.forEach(function(asso_id) {
		arg += "&asso[]=" + asso_id;
	});

	window.open(arg);
}
</script>
  </body>

</html>
