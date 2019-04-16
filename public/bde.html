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

<html>

<head>
  <meta charset="UTF-8">
  <style>
    .hide {
      display: none;
    }
  </style>
</head>
<boby>
  <table>
    <tr>
      <td>Consulter points associatifs de(s) l'année(s) : </td>
      <td>
        <select id="promoAnnee" multiple="multiple" size="4">
          <option value="2021" selected="selected">1A (Promo 2021)</option>
          <option value="2020">2A (Promo 2020)</option>
          <option value="2019">3A (Promo 2019)</option>
          <option value="2018">4A (Promo 2018)</option>
        </select>
      </td>
      <td> pour l(es) association(s) : </td>
      <td>
        <select id="association" multiple="multiple" size="4">
          <option value="2021" selected="selected">1A (Promo 2021)</option>
        </select>
      </td>
      <td class="choix hide">ordonner par:</td>
      <td class="choix hide">
        <select id="ordre">
          <option value="lastname">nom</option>
          <option value="pseudo">pseudo</option>
          <option value="point">points associatif</option>
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
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Pseudo</th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js">

  </script>
  <script>
    $.get("asso.php", function (asso) {
      console.log(asso);
      $("#association option").remove();
      $.each(asso, function (i, u) {
        $("#association").append('<option value="' + u['id_asso'] + '">' + u['name'] + '</option>');
      })
    }, 'json');


    function action_aff() {
      $(".choix").removeClass("hide");
    var year = $("#promoAnnee").val(),
    asso = $("#association").val(),
        ordre = $("#ordre").val();
      $.get("users.php", { "year": year, "asso": asso, "order": ordre }, function (users) {
        console.log(users);
        $("#res tbody tr").remove();
        $.each(users, function (i, u) {
          $("#res tbody").append('<tr><td>' + u['firstname'] + '</td><td>' + u['lastname'] + '</td><td>' + u['pseudo'] + '</td></tr>');
        })
      }, 'json');
    }

    function action_exp() {
      var year = $("#promoAnnee").val(),
        ordre = $("#ordre").val(),
        arg = "users.php?export=1";
      $.each(year, function (i, u) {
        arg += "&year[]=" + u;
      });
      arg += "&order=" + ordre;

      window.open(arg);
    }
  </script>
  </body>

</html>
