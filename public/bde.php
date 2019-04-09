<?php
include('./admin/functions.php');
// On prolonge la session
session_start();
// On teste si la variable de session existe et contient une valeur
if(empty($_SESSION['login']) || $_SESSION['bde']) 
{
  // Si inexistante ou nulle, on redirige vers le formulaire de login
  header('Location: http://localhost:8080/authentification.php');
  exit();
}
displayHeader();

<table>
<tr>
<td>Consulter pour associatif</td>
<td>
<select name="promoAnnee[]" multiple="multiple" size="5">
    <option value="2021" selected="selected">1A (Promo 2021)</option>
    <option value="2020">2A (Promo 2020)</option>
    <option value="2019">3A (Promo 2019)</option>
    <option value="2018">4A (Promo 2018)</option>
    <option value="2017">5A (Promo 2017)</option>
    <option value="2016">6A (Promo 2016)</option>
    <option value="2015">7A (Promo 2015)</option>
    <option value="2014">8A (Promo 2014)</option>
    <option value="2013">9A (Promo 2013)</option>
    <option value="2012">10A (Promo 2012)</option>
    <option value="2011">11A (Promo 2011)</option>
    <option value="2010">12A (Promo 2010)</option>
    <option value="2009">13A (Promo 2009)</option>
    <option value="2008">14A (Promo 2008)</option>
    <option value="2007">15A (Promo 2007)</option>
    <option value="2006">16A (Promo 2006)</option>
    <option value="2005">17A (Promo 2005)</option>
    <option value="2004">18A (Promo 2004)</option>
    <option value="2003">19A (Promo 2003)</option>
    <option value="2002">20A (Promo 2002)</option>
    </select>
    </td>
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
    </tr>
</table>    
    <input type="submit" value="Rechercher" name="tsub">
    
?>
</body>
</html>

