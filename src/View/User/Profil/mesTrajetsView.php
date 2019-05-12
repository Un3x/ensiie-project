<?php $title = "Un merveilleux site pour réserver des licornes ! " ?>

<?php ob_start(); ?>

<table>
    <thead>
        <tr>
            <th> Lieu de destination </th>
            <th> Lieu d'arrivée</th>
            <th> Date </th>
            <th> Heure de départ</th>
            <th> Heure d'arrivée </th>
            <th> Transporteur </th>
            <th> Prix </th>
        </tr>
    </thead>
    <tbody>
    <?php  for($i = 0; $i < sizeof($mesCourses); $i++) {  ?>
        <tr>
            <td> <?=$mesCourses[$i]->getDeparture()?> </td>
            <td> <?=$mesCourses[$i]->getArrival() ?> </td>
            <td> <?=$mesCourses[$i]->getDepartureTime()->format("Y-m-d")?> </td>
            <td> <?=$mesCourses[$i]->getDepartureTime()->format("H:i:s")?> </td>
            <td> <?=$mesCourses[$i]['heure_arri']?> </td>
            <td> <?=$mesCourses[$i]->getCarrier()?> </td>
            <td> <?=$mesCourses[$i]->getPrice()?> </td>
        </tr>
    <?php } ?>
    </tbody>

</table>


<?php $content = ob_get_clean(); ?>


<?php require "../src/View/template.php"; ?>