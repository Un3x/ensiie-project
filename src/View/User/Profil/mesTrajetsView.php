<?php $title = "Un merveilleux site pour réserver des licornes ! " ?>

<?php ob_start(); ?>

<table>
    <thead>
        <tr>
            <th> Lieu de destination </th>
            <th> Lieu d'arrivée</th>
            <th> Date </th>
            <th> Heure de départ</th>
            <th> Transporteur </th>
            <th> Transporteur </th>
            <th> Prix </th>
        </tr>
    </thead>
    <tbody>
    <?php  for($i = 0; $i < count($mesCourses); $i++) {  ?>
        <tr>
            <td> <?= $cityManager->get($mesCourses[$i]->getDeparture())->getName() ?> </td>
            <td> <?= $cityManager->get($mesCourses[$i]->getArrival())->getName()?> </td>
            <td> <?=$mesCourses[$i]->getDepartureDateTime()->format("Y-m-d")?> </td>
            <td> <?=$mesCourses[$i]->getDepartureDateTime()->format("H:i:s")?> </td>
            <td> <?=$vendorManager->get($mesCourses[$i]->getCarrier())->getFirstname()?> </td>
            <td> <?=$vendorManager->get($mesCourses[$i]->getCarrier())->getSurname()?> </td>
            <td>  <?=$mesCourses[$i]->getCarrier()?> </td>
        </tr>
    <?php } ?>
    </tbody>

</table>


<?php $content = ob_get_clean(); ?>


<?php require "../src/View/template.php"; ?>