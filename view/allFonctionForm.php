<?php
if (!function_exists('ajout_champ')) {
    function ajout_champ()
    {
        /* fonction qui prend comme arguments dans l'ordre: type, value, name, label, id, (required), (step)
            (les arguments entre parenthèses ne sont pas obligatoires, mais doivent être à l'index prévu:
            par exemple, si on veut indiquer un argument step, il faut mettre un argument required)
        */

        $tmp = '';
        //label
        if (!empty(func_get_arg(3))) {
            $tmp .= '<label for="' . func_get_arg(4) . '">' . func_get_arg(3) . ':</label>';
        }
        $tmp .= '<input type="' . func_get_arg(0) . '" ';
        if (!empty(func_get_arg(4))) {
            $tmp .= 'id="' . func_get_arg(4) . '" ';
        }
        if (!empty(func_get_arg(1))) {
            $tmp .= 'value="' . func_get_arg(1) . '" ';
        }
        if (!empty(func_get_arg(2))) {
            $tmp .= 'name="' . func_get_arg(2) . '" ';
        }
        if (func_num_args() > 5 && func_get_arg(5)) {
            $tmp .= 'required="required" ';
        }
        if (func_num_args() > 6 && func_get_arg(0) == "number" && func_get_arg(6) == -1) {
            $tmp .= 'step="any" ';
        }

        $tmp .= '>';
        return $tmp;
    }
}
    if (!function_exists('vue_connexion')) {
        function vue_connexion()
        {
            return '<div id="msgSubmit" class="h3 text-center hidden" style="margin-top: 5%;padding-bottom:2%;"><h1> Connexion </h1><br/>
                </div><form action="" method="post" style="margin-left: 0%">

        <div class="row" style="margin-left:35%">
            <div class="form-group col-sm-6">
                <input type="text" class="form-control" name="ndc" id="ndc" placeholder="Votre nom de compte" required>
            </div></div><div class="row" style="margin-left:35%">
            <div class="form-group col-sm-6">
                <input type="password" class="form-control" name="mdp" id="mdp" placeholder="Votre mot de passe " required>
            </div>
            </div>
           <div class="row" style="margin-left: 34%;margin-top: 2%;">
        <input type="submit" value="Envoyer" class="btn btn-primary" style="margin-left: 19%;padding-left: 30px;padding-right:30px" id="envoyer">
        </div>
        
        </form>
';

        }
    }

    if (!function_exists('vue_inscription1')) {
        function vue_inscription1()
        {

            return '<div id="msgSubmit" class="h3 text-center hidden" style="margin-top: 5%;padding-bottom:2%;"><h1> Inscription : PARTIE 1 </h1><br/>
                </div><form action="" method="post" style="margin-left: 0%">

        <div class="row" style="margin-left:32%">
            <div class="form-group col-sm-6">
                <input type="text" class="form-control" name="nomcompte" id="nomcompte" placeholder="nom de compte" required>
            </div></div><div class="row" style="margin-left:32%">
            <div class="form-group col-sm-6">
                <input type="password" class="form-control" name="motpasse" id="motpasse" placeholder="Votre mot de passe " required>
            </div>
            </div>
            <div class="row" style="margin-left:32%">
            <div class="form-group col-sm-6">
                <input type="password" class="form-control" name="motpasse2" id="motpasse2" placeholder="Répétez votre mot de passe " required>
            </div>
            </div>
            <div class="row" style="margin-left:32%">
            <div class="form-group col-sm-6">
                <input type="email" class="form-control" name="email" id="email" placeholder="Votre E-mail" required>
            </div>
            </div>
           <div class="row" style="margin-left: 29%;margin-top: 2%;">
        <input type="submit" value="Envoyer" class="btn btn-primary" style="margin-left: 19%;padding-left: 30px;padding-right:30px" id="envoyer">
        </div>
        
        </form>
';
        }
    }
    if (!function_exists('vue_inscription2')) {
        function vue_inscription2()
        {
            return '<div id="msgSubmit" class="h3 text-center hidden" style="margin-top: 5%;padding-bottom:2%;"><h1> Inscription : PARTIE 2 </h1><br/>
                </div><form action="" method="post" style="margin-left: 0%">

        <div class="row" style="margin-left:32%">
            <div class="form-group col-sm-6">
                <input type="text" class="form-control" name="nom" id="nom" placeholder="Votre nom" required>
            </div></div><div class="row" style="margin-left:32%">
            <div class="form-group col-sm-6">
                <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Votre prenom" required>
            </div>
            </div>
            <div class="row" style="margin-left:32%">
            <div class="form-group col-sm-6">
                <input type="text" class="form-control" name="adresse" id="adresse" placeholder="Votre adresse" required>
            </div>
            </div>
            <div class="row" style="margin-left:32%">
            <div class="form-group col-sm-6">
                <input type="date" class="form-control" name="datenaissance" id="datenaissance" required>
            </div>
            </div>
            <div class="row" style="margin-left:32%">
            <div class="form-group col-sm-6">
                <input type="number" class="form-control" name="cp" id="cp" placeholder="Votre code postal" required>
            </div>
            </div>
            <div class="row" style="margin-left:32%">
            <div class="form-group col-sm-6">
                <input type="text" class="form-control" name="pays" id="pays" placeholder="Votre pays" required>
            </div>
            </div>
            
           <div class="row" style="margin-left: 29%;margin-top: 2%;">
        <input type="submit" value="Envoyer" class="btn btn-primary" style="margin-left: 19%;padding-left: 30px;padding-right:30px" id="envoyer">
        </div>
        <div class="row" style="margin-left: 29%;margin-top: 5%;">
        </div>
        <div class="row" style="margin-left:32%">
            <div class="form-group col-sm-6">
                <input type="text" class="form-control" name="h" id="h" placeholder="">
            </div>
            </div>
        </form>
';
        }
    }

if(!function_exists('decale'))
{
    function decale()
    {
        return '<div id="msgSubmit" class="h3 text-center hidden" style="margin-top: 5%;padding-bottom:2%;"><h1>Site officiel du CineEvry</h1></div>
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="margin-top: 3%">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="./images/marvel.jpg" class="d-block w-100" alt="..." height="500px">
    </div>
    <div class="carousel-item">
      <img src="./images/cinema.jpg" class="d-block w-100" alt="..." height="500px">
    </div>
    <div class="carousel-item">
      <img src="./images/cinema-header.jpg" class="d-block w-100" alt="..." height="500px">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a></div><br/>
        <h2 align="center" style="margin-top: 4%;margin-bottom: 4%;">Meilleurs films de tous les temps selon les spectateurs</h2>
        
       <div class="row mb-2" style="">
        <div class="col-md-6">
            <div class="card flex-md-row mb-4 box-shadow h-md-250">
                <div class="card-body d-flex flex-column align-items-start">
                    <strong class="d-inline-block mb-2 text-primary">De Joe Russo, Anthony Russo </strong>
                    <h3 class="mb-0">
                        <a class="text-dark" href="#">Avangers:Endgame</a>
                    </h3>
                    <div class="mb-1 text-muted">Date de sortie 24 avril 2019 (3h 01min) </div>
                    <p class="card-text mb-auto">Thanos ayant anéanti la moitié de l’univers, les Avengers restants resserrent les rangs dans ce vingt-deuxième film des Studios Marve...</p>
                    <a href="#">plus de details</a>
                </div>
                <img class="card-img-right flex-auto d-none d-md-block" src="./images/avangers.jpg" alt="Card image cap">
            </div>
        </div>
        <div class="col-md-6">
            <div class="card flex-md-row mb-4 box-shadow h-md-250">
                <div class="card-body d-flex flex-column align-items-start">
                    <strong class="d-inline-block mb-2 text-success">De Brad Bird</strong>
                    <h3 class="mb-0">
                   
                        <a class="text-dark" href="#">The Shawshank Redemption</a>
                    </h3>
                    <a class="text-dark" href="#">Date de sortie 1994-09-10 (1h42min)</a>
                    <p class="card-text mb-auto">Notre famille de super-héros préférée est de retour! Cette fois c’est Hélène  ...</p>
                    <a href="#">plus de details</a>
                </div>
                <img class="card-img-right flex-auto d-none d-md-block" src="./images/shawnshank.jpg" alt="Card image cap">
            </div>
        </div>
    </div>
    <h2 align="center" style="margin-top: 4%;margin-bottom: 4%;"> x</h2>';
    }
}
if(!function_exists('addAdmin_vue'))
{
    function addAdmin_vue()
    {
        return '
<div id="msgSubmit" class="h3 text-center hidden" style="margin-top: 5%;padding-bottom:5%;"><h1>Ajouter des admins</h1></div><form action="" method="post" style="margin-left: 15%">


        <div class="row">
            <div class="form-group col-sm-3 my-1">
                <label for="name" class="h4">Nom de compte</label>
                <input type="text" class="form-control" name="nomcompte" id="nomcompte" placeholder="" required>
            </div>
            <div class="form-group col-sm-3 my-1">
                <label for="email" class="h4">motpasse</label>
                <input type="password" class="form-control" name="motpasse" id="motpasse" placeholder="" required>
            </div>
            <div class="form-group col-sm-3 my-1" align="center">
                <label for="name" class="h4">email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="" required>
            </div>
        </div>
        <div class="row" >
            
            <div class="form-group col-sm-3 my-1">
                <label for="email" class="h4">nom</label>
                <input type="text" class="form-control" name="nom" id="nom" placeholder="" required>
            </div>
            
            <div class="form-group col-sm-3 my-1">
                <label for="email" class="h4">prenom</label>
                <input type="text" class="form-control" name="prenom" id="prenom" placeholder="" required>
            </div>
            <div class="form-group col-sm-3 my-1">
                <label for="email" class="h4">Date de naissance</label>
                <input type="date" class="form-control" name="datenaissance" id="datenaissance" placeholder="" required>
            </div>
            
        </div>
        
        <div class="row" >
            <div class="form-group col-sm-6">
                <label for="email" class="h4">Adresse</label>
                <input type="text" class="form-control" name="adresse" id="adresse" placeholder="" required>
            </div>
            
            <div class="form-group col-sm-3 my-1">
                <label for="message" class="h4 ">Code postal</label>
                <input type="number" class="form-control" name="cp" id="cp" placeholder="" required>
            </div>
            
            
         </div>
         <div class="row" style="margin-left: 30%">
         <div class="form-group col-sm-3 my-1">
                <label for="message" class="h4 ">Pays</label>
                <input type="text" class="form-control" name="pays" id="pays" placeholder="" required>
            </div>
           </div> 
           <div class="row" style="margin-left: 34%;margin-top: 2%;margin-bottom: 10%">
        <input type="submit" value="Ajouter" class="btn btn-primary" style="align: center" id="envoyer">
        </div>
        
        </form>
';
    }
}

if(!function_exists('affiche_admcli'))
{
    function affiche_admcli($tableau,$v)
    {
        $max = sizeof($tableau);
        $i = 0;
        $v2 = '';
        $v3 = '';
        $v1 = '<table class="table table-striped" style="width: 80%;text-align: left;margin-left: 10%;">
  <thead>
    <tr>
      <th scope="col">nom</th>
      <th scope="col">prenom</th>
      <th scope="col">datenaissance</th>
      <th scope="col">Adresse</th>
      <th scope="col">Code postal</th>
      <th scope="col">pays</th>';
        if($v=='a') {

            $v1.='<th scope = "col" > Suprimmer</th >';
        }
      echo '</tr></thead>';

        while ($i < $max) {
            $v2 .= '
    <tr>
      <td>' . $tableau[$i]->getNom() . '</td>
      <td>' . $tableau[$i]->getPrenom() . '</td>
      <td>' . $tableau[$i]->getDatenaissance() . '</td>
      <td>' . $tableau[$i]->getAdresse(). '</td>
      <td>' . $tableau[$i]->getCp() . '</td>
      <td>' . $tableau[$i]->getPays() . '</td>';

            if($v=='a') {
                $v2 .= '<td><a class="btn btn-default" href="/deleteClient?nclient=' . $tableau[$i]->getNcompte() . '" role="button">Oui</a> </button></td>';
            }
            $v2.= '</tr>';
            $i++;
        }
        return $v1 . $v3 . $v2 . "</table>";
    }
}
if(!function_exists('addFauteuil'))
{
    function addFauteuil($cat)
    {
        $max=sizeof($cat);
        $i=0;
        $v1='';
        $v2='';
        $v1.='<div id="msgSubmit" class="h3 text-center hidden" style="margin-top: 5%;padding-bottom:2%;"><h1>Ajouter des Fauteuils</h1><br/><h5>Vous devez ajouter un numero de fauteuil supérieur à 20</h5></div><form action="" method="post">

        <div class="row">
            <div class="form-group col-sm">
                <label for="nfauteuil" class="h4">Numero de fauteuil</label>
                <input type="text" class="form-control" name="nfauteuil" id="nfauteuil" placeholder="" required>
            </div>
            
            <div class="form-group col-sm">
            <label for="catplace" class="h4" >La catégorie</label>
            <select name="catplace" class="form-control">';

            while($i<$max)
            {
                $v2.='<option value="'.$cat[$i]->getCatplace().'">'.$cat[$i]->getCatplace().'</option>';
                $i++;
            }
            $v2.='</select></div>
        </div>
        
           <div class="row" style="margin-left: 34%;margin-top: 2%;">
        <input type="submit" value="Ajouter" class="btn btn-primary" style="margin-left: 17%;padding-left: 4%;padding-right: 4%"" id="envoyer">
        </div>
        
        </form>
';
            return $v1.$v2;
    }
}
if(!function_exists('addTypeevent'))
{
    function addTypeevent()
    {
        return '<div id="msgSubmit" class="h3 text-center hidden" style="margin-top: 5%;padding-bottom:2%;"><h1>Ajouter un typ évenement </h1><br/>
                </div><form action="" method="post" style="margin-left: 0%">

        <div class="row">
            <div class="form-group col-sm">
                <label for="nfauteuil" class="h4">Type evenement</label>
                <input type="text" class="form-control" name="tevent" id="tevent" placeholder="" required>
            </div>
            <div class="form-group col-sm">
                <label for="nfauteuil" class="h4">prix par heure (en €) </label>
                <input type="text" class="form-control" name="pheure" id="pheure" placeholder="" required>
            </div>
            </div>
           <div class="row" style="margin-left: 34%;margin-top: 2%;">
        <input type="submit" value="Ajouter" class="btn btn-primary" style="margin-left: 18%" id="envoyer">
        </div>
        
        </form>
';
    }
}
if(!function_exists('oneFilm'))
{
    function oneFIlm($fl)
    {
        $image='';
        switch($fl['titre'])
        {
            case "Man of Steel":
                $image="manofsteel.jpg";break;
            case "The Shawshank Redemption":
                $image="shawnshank.jpg";break;
            case "The Last Castle":
                $image="lastcastle.jpg";break;
            case "One Piece : Z":
                $image="op.jpg";break;
            case "Avengers: Endgame":
                $image="avangers.jpg";break;
            default:
                $image="fildefault.png";

        }
        return "<div class=\"container-fluid bg-grey\" style='margin-bottom: 15%;margin-top:5%'>
   <div class=\"row mb-2\" style=\"\">
        <div class=\"col-md-12\">
            <div class=\"card flex-md-row mb-4 box-shadow h-md-250\">
                <div class=\"card-body d-flex flex-column align-items-start\">
                    <strong class=\"d-inline-block mb-2 text-primary\">Date de sortie : ".$fl['datesortie']."</strong>
                    <h3 class=\"mb-0\">
                        <a class=\"text-dark\" href=\"#\">".$fl['titre']."</a>
                    </h3>
                    <div class=\"mb-1 text-muted\">durée :".$fl['duree']."</div>
                    <p class=\"card-text mb-auto\" style='font-size :17px;margin-top: 2%'>".$fl['description']."</p>
                </div>
                <img class=\"card-img-right flex-auto d-none d-md-block\" src=\"./images/".$image."\" alt=\"Card image cap\">
            </div>
        </div>";
    }
}