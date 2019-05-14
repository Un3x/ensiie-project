<?php
function calcul($elo1 , $elo2, $score1, $score2,$K)
{
    $p=1/(1+10**(($elo1-$elo2)/400));
    if ($score2>=$score1) return $K*$p;
    else return $K*(1-$p);
}



function update_elo($nomJoueur1,$nomJoueur2,$score1,$score2,$participants,$connection)
{
    $joueur1;
    $joueur2;

    foreach($participants as $p)
    {
        if ($nomJoueur1==$p->getNom()) $joueur1=$p;
        elseif ($nomJoueur2==$p->getNom()) $joueur2=$p;
    }

    $elo1 = $joueur1->getElo();
    $elo2 = $joueur2->getElo();
    $delta = calcul($elo1,$elo2,$score1,$score2,30);

    $req1 = "UPDATE Participant SET elo= :a WHERE nom= :b";
    $tmp = $connection->prepare($req1);
    $tmp->bindParam(':a', $elo1+$delta, PDO::PARAM_STR);
    $tmp->bindParam(':b', $joueur1->getNom(), PDO::PARAM_STR);
    $tmp->execute();

    $req2 = "UPDATE Participant SET elo= :a WHERE nom= :b";
    $tmp = $connection->prepare($req1);
    $tmp->bindParam(':a', $elo2-$delta, PDO::PARAM_STR);
    $tmp->bindParam(':b', $joueur2->getNom(), PDO::PARAM_STR);
    $tmp->execute();
}
?>