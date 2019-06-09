<?php
require('allFonctionForm.php');
if(!function_exists('FormPlanning')) {
    function FormPlanning($remplir)
    {

            if ($remplir == null) {
            return '
<div id="msgSubmit" class="h3 text-center hidden" style="margin-top: 5%;padding-bottom:5%;"><h1>Ajouter des admins</h1></div><form action="" method="post" style="margin-left: 15%">


        <div class="row">
            <div class="form-group col-sm-3 my-1">
                <label for="name" class="h4">Numéro de film</label>
                <input type="text" class="form-control" name="num_film" id="num_film" placeholder="" required>
            </div></div>
            <div class="row">
            <div class="form-group col-sm-3 my-1">
                <label for="email" class="h4">La date </label>
                <input type="date" class="form-control" name="trip-start" id="start" value=\'2018-07-22\' min=" . date(\'Y-m-j\') . "max=\'2020-12-31\' required>
            </div></div>
            <div class="row">
            <div class="form-group col-sm-3 my-1" align="center">
                <label for="name" class="h4">Heure debut :</label>
                <input type="time" class="form-control" name="appt" id="appt" placeholder="" min=\'9:00\' max=\'23:00\' required>
            </div></div>
            <div class="row">
            <div class="form-group col-sm-3 my-1" align="center">
                <label for="name" class="h4">Heure fin :</label>
                <input type="time" class="form-control" name="appt2" id="appt2" placeholder="" min=\'9:00\' max=\'23:00\' required>
            </div>
        </div>
        
        <div class="row" >
            
            <div class="form-group col-sm-3 my-1">
                <INPUT type= "radio" name="type" value="place" checked> Planning place<br/>
            <INPUT type= "radio" name="type" value="salle" > Planning salle<br/>
                
            </div></div>
            
           <div class="row" style="margin-left: 34%;margin-top: 2%;margin-bottom: 10%">
        <input type="submit" value="Ajouter" class="btn btn-primary" style="align: center" id="envoyer">
        </div>
        
        </form>
';
        }
            else {
                $format = $remplir[0]->getDebutheure();
                $debutheure = date("H:i", strtotime($remplir[0]->getDebutheure()));
                $finheure = date("H:i", strtotime($remplir[0]->getDebutheure()));
                return '
<div id="msgSubmit" class="h3 text-center hidden" style="margin-top: 5%;padding-bottom:5%;"><h1>Ajouter des admins</h1></div><form action="" method="post" style="margin-left: 15%">


        <div class="row">
            <div class="form-group col-sm-3 my-1">
                <label for="name" class="h4">Numéro de film</label>
                <input type="text" class="form-control" name="num_film" id="num_film" value ="'.$remplir[0]->getFilm().'" placeholder="" required>
            </div></div>
            <div class="row">
            <div class="form-group col-sm-3 my-1">
                <label for="email" class="h4">La date </label>
                <input type="date" class="form-control" name="trip-start" id="start" value="'.$remplir[0]->getDatejour().'" min=" . date(\'Y-m-j\') . "max=\'2020-12-31\' required>
            </div></div>
            <div class="row">
            <div class="form-group col-sm-3 my-1" align="center">
                <label for="name" class="h4">Heure debut :</label>
                <input type="time" class="form-control" name="appt" id="appt" placeholder="" value ="'.$debutheure.'" min=\'9:00\' max=\'23:00\' required>
            </div></div>
            <div class="row">
            <div class="form-group col-sm-3 my-1" align="center">
                <label for="name" class="h4">Heure fin :</label>
                <input type="time" class="form-control" name="appt2" id="appt2" placeholder="" value ="'.$finheure.'" min=\'9:00\' max=\'23:00\' required>
            </div>
        </div>
        
        <div class="row" >
            
            <div class="form-group col-sm-3 my-1">
                <INPUT type= "radio" name="type" value="place" checked> Planning place<br/>
            <INPUT type= "radio" name="type" value="salle" > Planning salle<br/>
                
            </div></div>
            
           <div class="row" style="margin-left: 34%;margin-top: 2%;margin-bottom: 10%">
        <input type="submit" value="Modifier" class="btn btn-primary" style="align: center" id="envoyer">
        </div>
        
        </form>
';
            }
        }


}

function FormDeletePlanning()
{
    return "<form action='' method='post' >" ."<br/>".
        ajout_champ("text", '', "deletit", "numero de film à suprimmer", "deletit")."<br/>".
        ajout_champ('submit', 'Envoyer', 'soumission', '', ''). "<br/></form>";
}
function FormUpdatePlanning()
{
    return "<form action='' method='post' >" . "<br/>" .
        ajout_champ("text", '', "updateit", "numero de film à modifier ", "updateit") . "<br/>" .
        ajout_champ('submit', 'Modifier', 'soumission', '', '') . "<br/></form>";

}
function affiche_table($a_modifier)
{
    $max=sizeof($a_modifier);
    $i=0;
    $v2='';
    $v1='<table class="table table-striped" style="width: 80%;text-align: left;margin-left: 10%;">
  <thead>
    <tr>
      <th scope="col" >numero de planing</th>
      <th scope="col">film</th>
      <th scope="col">Jour</th>
      <th scope="col">heure debut</th>
      <th scope="col">heure fin</th>
      <th scope="col">modifier</th>
      <th scope="col">Consulter le film</th>
      <th scope="col">Suprimmer</th>
    </tr>
    </thead>';
    while($i<$max) {
        $v2.= '
    <tr>
      <th scope="row">1</th>
      <td>' . $a_modifier[$i]->getFilm() . '</td>
      <td>' . $a_modifier[$i]->getDatejour() . '</td>
      <td>' . $a_modifier[$i]->getDebutheure() . '</td>
      <td>' . $a_modifier[$i]->getfinheure() . '</td>
      <td><a class="btn btn-default" href="/updateplaning?n_film='.$a_modifier[$i]->getFilm().'" role="button">Oui</a> </button></td>  
      <td><a class="btn btn-default" href="#" role="button">Oui</a> </button></td>
      <td><a class="btn btn-warning" href="/deleteplaning?nplaning='.$a_modifier[$i]->getNplaning().'" role="button">Oui</a> </button></td>
    </tr>';
        $i++;
    }
    return $v1.$v2."</table>";
}
function afficheTableUnPlan($objet)
{
    return '<table class="table table-striped" style="width: 65%;text-align: left;margin-left: 15%;">
  <thead>
    <tr>
      <th scope="col" >numero de planing</th>
      <th scope="col">film</th>
      <th scope="col">Jour</th>
      <th scope="col">heure debut</th>
      <th scope="col">heure fin</th>
    </tr>
    </thead>
    <tr>
      <th scope="row">1</th>
      <td>' . $objet->getFilm() . '</td>
      <td>' . $objet->getDatejour() . '</td>
      <td>' . $objet->getDebutheure() . '</td>
      <td>' . $objet->getfinheure() . '</td>
    </tr></table>';
}
/*function liste_cherche($afficher)
{
    $max=sizeof($afficher);
    $i=0;
    echo '<form action="" method="post">'.
        ajout_champ('text', '', 'film', 'le film', 'film').'<br/>'.
        "<fieldset> <legend>Choix:</legend>\n";
        while($i<$max) {
            ajout_champ("radio", "m", "choix", "Modification") . "<br/>"

        }
        "</fieldset>\n".
        ajout_champ('submit', 'Envoyer', 'soumission', '', '', 0)."\n".
        '</form>';
}*/
/*
while($i<$max)
    {
        echo "<tr>
      <th scope=\"row\">1</th>
      <td>\".$a_modifier[0]->getFilm().\"</td>
      <td>\".$a_modifier[1]->getDatejour().\"</td>
      <td>\".$a_modifier[0]->getDebutheure().\"</td>
      <td>\".$a_modifier[2]->getfinheure().\"</td>
      <td><a class=\"btn btn-default\" href=\"/addplaning\" role=\"button\">ajouter planning</a> </button></td>
    </tr>


</table>";
        $i++;
    }
*/
?>
