<?php

if (!function_exists('voirReserv')) {

    function voirReserv($tableau,$val)
    {
        $max = sizeof($tableau);
        $i = 0;
        $v2 = '';
        if ($max > 0) {
            $v1 = '<table class="table table-striped" style="width: 65%;text-align: left;margin-left: 15%;">
  <thead>
    <tr>
      <th scope="col" >numero de Reservation</th>
      <th scope="col">numero de planing</th>
      <th scope="col">fauteuil</th>
      <th scope="col">consulter le planning</th>';
            if ($val == 'a') {
                $v1 .= '<th scope="col">Suprimmer </th>';
            }
    $v1.='</tr>
    </thead>';
            while ($i < $max) {
                $v2 = '
                <tr>
                    <td>' . $tableau[$i]->getNreservation() . '</td>
                    <td>' . $tableau[$i]->getPlaning() . '</td>
                    <td>' . $tableau[$i]->getFauteuil() . '</td>
                    <td><a class="btn btn-dark" href="/planningClient?nplaning=' . $tableau[$i]->getPlaning() . '" role="button" style="text-align: center">Oui</a> </button></td>';
                if($val=='a') {
                    $v2 .= '<td><a class="btn btn-dark" href="/deleteRservation?nreservation=' . $tableau[$i]->getNreservation() . '" role="button" style="text-align: center">Oui</a> </button></td>';
                }
                $v2.='</tr>';
                $i++;
            }
            return $v1 . $v2 . "</table>";
        }
    }
}
if(!function_exists('voirReservSalle')) {

function voirReservSalle($tableau,$val)
{
    $max = sizeof($tableau);
    $i = 0;
    $v2 = '';
    if ($max > 0) {
        $v1 = '<table class="table table-striped" style="width: 65%;text-align: left;margin-left: 15%;">
  <thead>
    <tr>
      <th scope="col" >numero de Reservation</th>
      <th scope="col">numero de planing</th>
      <th scope="col">numero de client</th>';

        if ($val == 'a') {
            $v1 .= '<th scope="col">Type d\'evenemnt </th><th scope="col">nom d\'evenement</th><th scope="col">Suprimmer </th>';
        }
        $v1.='<th scope="col">consulter le planning</th></tr></thead>';

        while ($i < $max) {
            $v2 = '
                <tr>
                    <td>' . $tableau[$i]->getNreservation() . '</td>
                    <td>' . $tableau[$i]->getPlaning() . '</td>
                    <td>' . $tableau[$i]->getClient() . '</td>';
            if($val=='a') {
                $v2 .= '<td>'.$tableau[$i]->getTypeevenement().'</td>'.
                    '<td>'.$tableau[$i]->getNomevenement().'</td>'.
                '<td><a class="btn btn-dark" href="/deleteRservationSalle?nreservationS=' . $tableau[$i]->getNreservation() . '" role="button" style="text-align: center">Oui</a> </button></td>';
            }
            $v2.='<td><a class="btn btn-dark" href="/planningClient?nplaning=' . $tableau[$i]->getPlaning() . '" role="button" style="text-align: center">Oui</a> </button></td></tr>';
            $i++;
        }
        return $v1 . $v2 . "</table>";
    }
}
}
if (!function_exists('formreserverPlace')) {
    function formreserverPlace()
    {
        return "<div id=\"msgSubmit\" class=\"h3 text-center hidden\" style=\"margin-top: 5%;padding-bottom:2%;\"><h2> numero supérieur à 20 pour les autres catégories (2,3,4,5,6)</h2><br/>
                </div><form action='' method='post' >" . "<br/>" .'
        <div class="row" style="margin-left:35%">
            <div class="form-group col-sm-6">
                <input type="number" class="form-control" name="nfauteuil" id="nfauteuil" placeholder="numero de fauteuil" required>
    <input type="submit" class="form-control" name="envoyer" id="envoyer" value="Valider">
            </div></div></form></div></div>';;

    }
}
if (!function_exists('formreserverSalle')) {
    function formreserverSalle($tableau)
    {
        $max=sizeof($tableau);
        $i=0;
        $v2='';
        $v1="Veuillez choisir le numero correspont à une catégorie que vous voulez !"."<form action='' method='post' >" . "<br/>" .

            '<label for=\'tevent\'>Type d\'événement</label><select name="tevent">';
            while($i<$max) {
                $v2.='<option value="' .$tableau[$i]->getType().'">' .$tableau[$i]->getType().'</option>';
                $i++;
            }
        return $v1.$v2.'</select></br>'.
        ajout_champ("text", '', "nomevent", "nom d'évenement : ", "nom event") . "<br/>" .
        ajout_champ('submit', 'Réserver', 'soumission', '', '')."<br/></form>";
    }
}
if(!function_exists('affiche_reservations'))
{
    function affiche_reservations($tableau,$val)
    {
        $max = sizeof($tableau);
        $i = 0;
        $v2 = '';
        $v3 = '';
        $v1 = '<table class="table table-striped" style="width: 65%;text-align: left;margin-left: 15%;">
  <thead>
    <tr>
      <th scope="col">numero de reservation</th>
      <th scope="col">numero de planing</th>
      <th scope="col">numero de client</th>';
        if ($val == 'a') {
            $v3 .= '<th scope="col">type d\'evenement<</th><th scope="col">nom d\'evenement</th>';
        }

        $v3 .= '</tr></thead>';
        while ($i < $max) {
            $v2 .= '
    <tr>
      <td>' . $tableau[$i]->getTitre() . '</td>
      <td>' . $tableau[$i]->getDuree() . '</td>
      <td>' . $tableau[$i]->getDatesortie() . '</td>
      
      <td><a class="btn btn-default" href="/voirFilm" role="button">Oui</a> </button></td>';

            if ($val == 'a') {
                $v2.='<td><a class="btn btn-warning" href="/deletefilm?nfilm=' . $tableau[$i]->getIdfilm() . '" role="button">Oui</a> </button></td>';
            }
            $v2.= '</tr>';
            $i++;
        }
        return $v1 . $v3 . $v2 . "</table>";
    }
}