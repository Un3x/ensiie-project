<?php



require '../src/Joueur/Joueur.php';
require '../src/Joueur/JoueurRepository.php';


function nb_achievements($nomJoueur, $achPart)
{
    $i = 0;

    foreach($achPart as $ap)
    {
        if ($ap->getParticipant()==$nomJoueur) $i++;
    }
    return $i;
}


function rank_update($joueur, $nbachievements,$connection)
{
    $rang = "";
    $nom = $joueur->getNom();

    if ($nbachievements>=5 && $nbachievements<10)
    {
        $rang="Avancé";

        $req = "UPDATE Joueur SET rang= :a WHERE nom= :b";
        $tmp = $connection->prepare($req);
        $tmp->bindParam(':a', $rang, PDO::PARAM_STR);
        $tmp->bindParam(':b', $nom, PDO::PARAM_STR);
        $tmp->execute();
        //print_r($tmp->errorInfo());
        echo "</br>Nouveau rang de $nom : $rang</br>";
    }

    elseif ($nbachievements>=10 && $nbachievements <15)
    {
        $rang="Expert";

        $req = "UPDATE Joueur SET rang= :a WHERE nom= :b";
        $tmp = $connection->prepare($req);
        $tmp->bindParam(':a', $rang, PDO::PARAM_STR);
        $tmp->bindParam(':b', $nom, PDO::PARAM_STR);
        $tmp->execute();
        //print_r($tmp->errorInfo());
        echo "</br>Nouveau rang de $nom : $rang</br>";
    }

    elseif ($nbachievements>=15 && $nbachievements <20)
    {
        $rang="Champion";

        $req = "UPDATE Joueur SET rang= :a WHERE nom= :b";
        $tmp = $connection->prepare($req);
        $tmp->bindParam(':a', $rang, PDO::PARAM_STR);
        $tmp->bindParam(':b', $nom, PDO::PARAM_STR);
        $tmp->execute();
        //print_r($tmp->errorInfo());
        echo "</br>Nouveau rang de $nom : $rang</br>";
    }

    elseif ($nbachievements>=20)
    {
        $rang="God";

        $req = "UPDATE Joueur SET rang= :a WHERE nom= :b";
        $tmp = $connection->prepare($req);
        $tmp->bindParam(':a', $rang, PDO::PARAM_STR);
        $tmp->bindParam(':b', $nom, PDO::PARAM_STR);
        $tmp->execute();
        //print_r($tmp->errorInfo());
        echo "</br>Nouveau rang de $nom : $rang</br>";
    }

}


function random_opponent($tournoi,$nb_participants){
    $number1=rand(0,$nb_participants);
    $bool=false;
    $number2=-1;
    while ($bool==false){
        $number2=rand(0,$nb_participants);
        if ($number1!=$number2){
            $bool=true;
        }
    }
    return;
}
    
            
            