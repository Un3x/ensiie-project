<?php $title = "Accès Admin! " ?>

<?php ob_start(); ?>

    <table>
        <thead>
        <tr>
            <th> Lieu de destination </th>
            <th> Lieu d'arrivée</th>
            <th> Date </th>
            <th> Heure de départ</th>
            <th> Prénom du transporteur </th>
            <th> Nom du transporteur </th>
            <th> En savoir plus </th>
            <th> Prénom du client </th>
            <th> Nom du client </th>
            <th> En savoir plus </th>
            <th> Prix </th>
            <th>  Détails </th>
        </tr>
        </thead>
        <tbody>
        <?php  for($i = 0; $i < count($mesCourses); $i++) {  ?>
            <tr>
                <td> <?= $cityManager->get($mesCourses[$i]->getDeparture())->getName() ?> </td>
                <td> <?= $cityManager->get($mesCourses[$i]->getArrival())->getName()?> </td>
                <td> <?=$mesCourses[$i]->getDepartureDateTime()->format("Y-m-d")?> </td>
                <td> <?=$mesCourses[$i]->getDepartureDateTime()->format("H:i:s")?> </td>

                <td> <?php
                    $a =$vendorManager->get($mesCourses[$i]->getCarrier());
                    if($a == false) echo "Inconnu";
                    else echo ($a->getFirstname());
                    ?> </td>


                <td> <?php
                    $a = $vendorManager->get($mesCourses[$i]->getCarrier());
                    if($a==false) echo "Inconnu";
                    else echo ($a->getSurname());?> </td>

                <td> <a href="index.php?action=modifUserAdmin&id=<?=$mesCourses[$i]->getCarrier()?>&type=Vendor"> Plus de détails</a> </td>
                <td> <?php $a =$clientManager->get($mesCourses[$i]->getClient());
                if($a==false) echo "Inconnu";
                else echo ($a->getFirstname())?> </td>

                <td> <?php $a =$clientManager->get($mesCourses[$i]->getClient());
                    if($a==false) echo "Inconnu";
                    else echo ($a->getSurname())?> </td>
                <td><a href="index.php?action=modifUserAdmin&id=<?=$mesCourses[$i]->getClient()?>&type=Client"> Plus de détails</a> </td>
                <td>  <?=$mesCourses[$i]->getPrice()?> </td>
                <td> <a href="index.php?action=infoCourse&courseId=<?php echo ($mesCourses[$i]->getId() )?>">   Plus d'info </a></td>
            </tr>
        <?php } ?>
        </tbody>

    </table>


<?php $content = ob_get_clean(); ?>


<?php require "../src/View/template.php"; ?>