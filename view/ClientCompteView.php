<?php
require_once('allFonctionForm.php');
function deleteCompte()
{

        return "<form action='' method='post' >" ."<br/>".
            ajout_champ("text", '', "deleteClient", "numero de comtpe à suprimmer", "deleteClient")."<br/>".
            ajout_champ('submit', 'Envoyer', 'soumission', '', ''). "<br/></form>";
}
function profilClient($cb)
{
    return '<div class="container" style="margin-left:32%;margin-bottom: 10%;margin-top: 5%" >
	<div class="row">
		<div class="col-xs-12 col-md-12">
    	 <div class="well profile">
            <div class="col-sm-12">
                <div class="col-xs-12 col-sm-12">
                    <h2 style="margin-left:10%">'.$_SESSION['nom'].'</h2><br/>
                    
                    <div class="col-xs-12 col-sm-4 emphasis" style="margin-bottom: 4%">
                    
                    <button class="btn btn-info btn-block"><span class="fa fa-user"></span>Modifier le profil</button>
                </div>
                                     
                   
                    <p ><strong>Email: </strong>'.$_SESSION['email'].'</p>
                    <p><strong>date de naissance: </strong>  '.$_SESSION['datenaissance'].'</p>
                    <p><strong>adresse: </strong>
                        <span class="tags">'.$_SESSION['adresse'].'</span> 
                    </p>
                    <p><strong>Code postal: </strong>
                        <span class="tags">'.$_SESSION['cp'].'</span> 
                    </p>
                    <p><strong>pays: </strong>
                        <span class="tags">'.$_SESSION['pays'].'</span> 
                    </p>
                </div>             
                
            </div>            
            <div class="col-xs-12 divider text-center">
                <div class="col-xs-12 col-sm-4 emphasis">
                    <h2><strong>'.$cb.'</strong></h2>                    
                    <p><small>Nombre de place résérver</small></p>
                    <button class="btn btn-success btn-block"><span class="fa fa-plus-circle"></span> Page réservation</button>
                </div>
              
                <div class="col-xs-12 col-sm-4 emphasis">
                    <div class="btn-group dropup btn-block">
                     
                      <button class="btn btn-danger btn-block" style="margin-top:3%"><span class="fa fa-plus-circle"></span> se déconnecter</button>
                     
                    </div>
                </div>
            </div>
    	 </div>                 
		</div>
	</div>
</div>';

}
function affichePday($plan_day,$film)
{
    $image='';
    switch($film['titre'])
    {
        case "Man of Steel":
            $image="manOfSteel";break;
        case "The Shawshank Redemption":
            $image="shawnshank";break;
        case "The Last Castle":
            $image="lastcastle";break;
        case "One Piece : Z":
            $image="op";break;
        case "Avengers: Endgame":
            $image="avangers";break;
        default:
            $image="fildefault";

    }
    return '<div class="container2" style="padding-bottom: 20%">
    
	
	<div class="movie-card">
		<div class="movie-header '.$image.'">
		</div><!--movie-header-->
		<div class="movie-content">
			<div class="movie-content-header">
				<a href="#">
					<h3 class="movie-title">'.$film['titre'].'</h3>
				</a>
				<div class="imax-logo"></div>
			</div>
			<div class="movie-info">
				<div class="info-section">
					<label>Date</label>
					<span>'.$plan_day->getDatejour().'</span>
				</div><!--date,time-->
				<div class="info-section">
					<label>L"heure de début </label>
					<span>'.$plan_day->getDebutheure().'</span>
				</div><!--screen-->
				<div class="info-section">
					<label>Genre</label>
					<span>_________</span>
				</div><!--row-->
				<div class="info-section">
					<label>Durée</label>
					<span>'.$film['duree'].'</span>
				</div><!--seat-->
				
			</div>
			<form method="post" action="">
		    <input type="hidden" name="reserver" value="idreservation" id="reserver">
			<input type="hidden" name="film" value="idfilm" id="film">
            <input class="btn btn-info btn-block" type="submit" value="Reserver" name="Breserver" id="Breserver"> 
			
			</form>
			
		
			
		</div><!--movie-content-->
	</div><!--movie-card-->
	
</div>';
}
function afficheWday($tabP,$tabfilm)
{

    $max=sizeof($tabP);
    $i=0;
    $v2='';
    $image='';
    $v1='<div class="container" style="padding-bottom: 20%">
	<table align="center"><tr>';
    while($i<$max)
    {
        $tr='';
        $trf='';
        $film=$tabfilm[$i];
        switch($film['titre'])
        {
            case "Man of Steel":
                $image="manOfSteel";break;
            case "The Shawshank Redemption":
                $image="shawnshank";break;
            case "The Last Castle":
                $image="lastcastle";break;
            case "One Piece : Z":
                $image="op";break;
            case "Avengers: Endgame":
                $image="avangers";break;
            default:
                $image="fildefault";

        }
        if($i==3)
        {
            $tr='<tr>';
        }
        if($i==($max-1)) $trf='</tr>';
        $v2.=$tr.'<td><div class="movie-card">
		<div class="movie-header '.$image.'">
		</div><!--movie-header-->
		<div class="movie-content">
			<div class="movie-content-header">
				<a href="#">
					<h3 class="movie-title">'.$film['titre'].'</h3>
				</a>
				<div class="imax-logo"></div>
			</div>
			<div class="movie-info">
				<div class="info-section">
					<label>Date</label>
					<span>'.$tabP[$i]->getDatejour().'</span>
				</div><!--date,time-->
				<div class="info-section">
					<label>L\'heure de début </label>
					<span>'.$tabP[$i]->getDebutheure().'</span>
				</div><!--screen-->
				<div class="info-section">
					<label>Genre</label>
					<span>_______</span>
				</div><!--row-->
				<div class="info-section">
					<label>Durée</label>
					<span>'.$film['duree'].'</span>
				</div><!--seat-->
				
			</div>
			
			
			<form method="post" action="">
		    <input type="hidden" name="reserver" value="idreservation" id="reserver">
			<input type="hidden" name="film" value="idfilm" id="film">
            <input class="btn btn-info btn-block" type="submit" value="Breserver" name="Breserver" id="Breserver"> 
			</form>
			
		
			
		</div></td>'.$trf;
        $i++;
    }
    return $v1.$v2.'</tr></table>
</div>';
}
if(!function_exists('affichePsalle'))
{
    function affichePsalle($p,$film)
    {
        $fil=$film[0];
        $image='';
        switch($fil['titre'])
        {
            case "Man of Steel":
                $image="manOfSteel";break;
            case "The Shawshank Redemption":
                $image="shawnshank";break;
            case "The Last Castle":
                $image="lastcastle";break;
            case "One Piece : Z":
                $image="op";break;
            case "Avengers: Endgame":
                $image="avangers";break;
            default:
                $image="fildefault";

        }
        return '<div class="container" style="padding-bottom: 20%">

	<table align="center"><tr><td><div class="movie-card">
		<div class="movie-header '.$image.'">
		</div><!--movie-header-->
		<div class="movie-content">
			<div class="movie-content-header">
				<a href="#">
					<h3 class="movie-title">'.$fil['titre'].': dans la grande salle</h3>
				</a>
				<div class="imax-logo"></div>
			</div>
			<div class="movie-info">
				<div class="info-section">
					<label>Date</label>
					<span>'.$p[0]->getDatejour().'</span>
				</div><!--date,time-->
				<div class="info-section">
					<label>L"heure de début </label>
					<span>'.$p[0]->getDebutheure().'</span>
				</div><!--screen-->
				<div class="info-section">
					<label>Genre</label>
					<span>______</span>
				</div><!--row-->
				<div class="info-section">
					<label>Durée</label>
					<span>'.$fil['duree'].'</span>
				</div><!--seat-->
				
			</div>
			
			
			<form method="post" action="">
		    <input type="hidden" name="reserver" value="idreservation" id="reserver">
			<input type="hidden" name="film" value="idfilm" id="film">
            <input class="btn btn-info btn-block" type="submit" value="Reserver" name="Breserver" id="Breserver"> 
			</form>
			
		
			
		</div></div></td></tr></table></div>';
    }
}