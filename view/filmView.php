<?php
if (!function_exists('affiche_films')) {
    function affiche_films($tableau, $val)
    {

        $max = sizeof($tableau);
        $i = 0;
        $v2 = '';
        $v3 = '';
        $v1 = '<table class="table table-striped" style="width: 65%;text-align: left;margin-left: 15%;">
  <thead>
    <tr>
      <th scope="col">titre</th>
      <th scope="col">duree (minutes)</th>
      <th scope="col">date de sortie</th>
      <th scope="col">Consulter ce film</th>';

        if ($val == 'a') {
            $v3 .= '<th scope="col">Suprimmer ce film</th>';
        }

        $v3 .= '</tr></thead>';
        while ($i < $max) {
            $v2 .= '
    <tr>
      <td>' . $tableau[$i]->getTitre() . '</td>
      <td>' . $tableau[$i]->getDuree() . '</td>
      <td>' . $tableau[$i]->getDatesortie() . '</td>
      
      <td><a class="btn btn-default" href="/affichefilm?numero='.$tableau[$i]->getIdfilm().'" role="button">Oui</a> </button></td>
      ';

            if ($val == 'a') {
                $v2.='<td><a class="btn btn-warning" href="/deletefilm?nfilm=' . $tableau[$i]->getIdfilm() . '" role="button">Oui</a> </button></td>';
            }
            $v2.= '</tr>';
            $i++;
        }
        return $v1 . $v3 . $v2 . "</table>";

    }
}
if (!function_exists('gestionFilm')) {
    function gestionFilm($tableau)
    {

        $max=sizeof($tableau);
        $i=0;
        $v2='';
        $v1='<table class="table table-striped" style="width: 65%;text-align: left;margin-left: 15%;">
  <thead>
    <tr>
      <th scope="col">Titre</th>
      <th scope="col">Duree (minutes)</th>
      <th scope="col">Date de sortie</th>
      <th scope="col">Modifier</th>
      <th scope="col">Consulter ce film</th>
      <th scope="col">Suprimmer</th>
    </tr>
    </thead>';
        while ($i < $max) {
            $v2.='
    <tr>
      <td>' . $tableau[$i]->getTitre() . '</td>
      <td>' . $tableau[$i]->getDuree() . '</td>
      <td>' . $tableau[$i]->getDatesortie() . '</td>
      <td><a class="btn btn-default" href="/voirFilm" role="button">Oui</a> </button></td>
      <td><a class="btn btn-default" href="/voirFilm" role="button">Oui</a> </button></td>
      <td><a class="btn btn-default" href="/voirFilm" role="button">Oui</a> </button></td>
    </tr>';
            $i++;
        }
        return $v1.$v2."</table>";

    }
}
if (!function_exists('filmOfCat')) {
    function filmOfCate($tableau)
    {
        $max=sizeof($tableau);
        $i=0;$v2='';
        $v1=
            "<div id=\"msgSubmit\" class=\"h3 text-center hidden\" style=\"margin-top: 5%;\"><h1> Veuillez choisir la catégorie </h1><br/>
                </div><form action='' method='post' name=\"action1\">" . "<br/>" .
            '<div class="row" style="margin-left:40%">
            <div class="form-group col-sm-6">'.
            '<select name="filmcat" ">';
        while($i<$max) {
            $v2.='<option value="'.$tableau[$i]->getIdcategorie().'" onclick="window.document.action1.submit()">'.$tableau[$i]->getLibelle().'</option>';
            $i++;
        }
        return $v1.$v2."</select></div><br/></form>";
    }
}
if(!function_exists('addfilmView'))
{
    function addfilmView()
    {
        return '<form action="" method="post">
<div id="msgSubmit" class="h3 text-center hidden" style="margin-top: 7%">Ajouter des films</div>

        <div class="row">
            <div class="form-group col-sm-6">
                <label for="name" class="h4">Titre de film</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="" required>
            </div>
            <div class="form-group col-sm-6">
                <label for="email" class="h4">Durée</label>
                <input type="number" class="form-control" name="duree" id="duree" placeholder="" required>
            </div>
        </div>
        <div class="row" style="margin-left: 35%">
            <div class="form-group col-sm-6" align="center">
                <label for="name" class="h4">Date de sortie</label>
                <input type="date" class="form-control" name="date" id="date" placeholder="" required>
            </div>
            
        </div>
        <div class="form-group">
            <label for="message" class="h4 ">Description de film</label>
            <textarea id="message" class="form-control" name="description" id="description" rows="5" placeholder="" required></textarea>
        </div>
        <input type="submit" value="Ajouter" class="btn btn-primary" style="align: center" id="envoyer">
        </form>
';
    }
}