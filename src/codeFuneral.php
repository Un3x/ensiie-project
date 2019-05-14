    <table class="table table-bordered table-hover table-striped" id="tableSolo"style="display:none" >
        <thead style="font-weight: bold">
            <td>Classement</td>
        </thead>
        <?php foreach ($achievements as $j) : ?>
            <tr>
                <td><?php echo $j->getNom()?></td>
            </tr>
        <?php endforeach; ?>
    </table>





    <?php
        if(array_key_exists('chgNom',$_POST)){ changerNom($participants, $connection, $participantsRepository); }

        echo '<form method="POST">
                <input type="submit" name="chdMdp" id="chdMdp" value="Changer mot de passe" />
                <input type="password" size="20" maxlength="30" name="mdp" id="mdp"/>
                </br> </form>';
        if(array_key_exists('chgMdp',$_POST)){ changerMdp(); }



        echo '<form method="POST">';
        foreach ($achievements as $a):
            
            echo "<input type='checkbox' size='20' maxlength='30' name='ach' id='ach'>";
            $tmp = $a->getNom();
            echo " $tmp</br> ";
        endforeach;
        echo "<input type='submit' size='20' maxlength='30' name='bach' id='bach' value= Modifier ";
        echo "</form>";
        if(array_key_exists('bach',$_POST)){ changerAchivements(); }











        function changerNom($participants, $connection, $participantsRepository)
{
    $nom = $_POST['nom'];
    $actuel = $_SESSION['login'];
    echo "NOm actuel : $actuel";
    $elo = 100;

    $boo = 0;
    foreach ($participants as $p)
    {
        if ($p->getNom()==$nom)
        {
            $boo = 1;
            $elo = $p->getElo();
            break;
        }
    }

    if ($boo == 1)
    {
        echo "Le nom $nom est déjà pris";
    }

    else
    {
        //$_SESSION['login'] = $nom;
        //$req1 = "UPDATE 'Participants' SET 'nom'=$nom WHERE 'nom'=$actuel"  ;
        $req1 = "INSERT INTO Participants(nom,elo) VALUES ($nom,$elo)"  ;

        //$connection->prepare($req1)->execute([$nom,$actuel]);
        $connection->prepare($req1)->execute();

      //  $participantsRepository->updateParticipantNom($actuel, $nom, $elo);
        echo 'BLAAAA';
    }

    echo "</br>";
    $par = $participantsRepository->fetchAll();
    foreach ($par as $cs) :
        $nom = $cs->getNom();
        echo "$nom ";
        $elo = $cs->getElo();
        echo "$elo</br>";
    endforeach;
    
    /*echo "<table class='table table-bordered table-hover table-striped' id='tableSolo'style='display:none' >
        <thead style='font-weight: bold'>
            <td>Nom</td>
            <td>Elo</td>
        </thead>";
        
        foreach ($par as $cs) :
            echo "<tr>
                <td><?php echo $cs->getNom()?></td>
                <td><?php echo $cs->getElo()?></td>
            </tr>";
        endforeach;
    echo "</table>";*/

}

function changerMdp()
{
    $mdp = $_POST['mdp'];
    echo "$mdp";
}

function changerAchivements()
{
    echo 'pas encore fait';
}