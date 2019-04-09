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
/*
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

$reps = $connection->query('SELECT firstname, lastname, pseudo, moyenne FROM users NATURAL JOIN leaderboard')->fetchAll(\PDO::FETCH_OBJ);
*/
?>

<table>
<tr>
<td>Consulter pour associatif</td>
<td>
<select name="promoAnnee[]" multiple="multiple" size="4">
    <option value="2021" selected="selected">1A (Promo 2021)</option>
    <option value="2020">2A (Promo 2020)</option>
    <option value="2019">3A (Promo 2019)</option>
    <option value="2018">4A (Promo 2018)</option>
    </select>
    </td>
    <span id="choix" style="display:none">
    <td>ordonner par:</td>
    <td>
    <select name="ordre">
    <option value="nom">nom</option>
    <option value="pseudo">pseudo</option>
    <option value="point">points associatif</option>
    </select>
    </td>
    <td>
    <input type="submit" value="CSV" name="avoirpoints">
    </td>
    <span>
    </tr>
</table>    
    <input type="submit" value="Rechercher" name="tsub" onclick="document.getElementById('choix').style.display='table-cell'">
    
    
</body>
</html>

