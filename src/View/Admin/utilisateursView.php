<?php $title = "Accès Admin ! " ?>


<?php ob_start(); ?>



<table>
    <thead>
    <tr>
        <th> Id utilisateur  </th>
        <th> Prénom </th>
        <th> Nom  </th>
        <th> Date de naissance </th>
        <th> Argent </th>
        <th> Adresse mail </th>
        <th> Numéro de téléphone  </th>
        <th> Réputation </th>
        <th> Genre </th>
        <th> Date de création </th>
        <th> Nombre de course effectuées ( côté client) </th>
        <th> Description </th>
        <th> Accès </th>
    </tr>
    </thead>
    <tbody>
    <?php  for($i = 0; $i < count($mesUsers); $i++) {  ?>
        <tr>

            <td> <?=$mesUsers[$i]->getId()?> </td>
            <td> <?=$mesUsers[$i]->getFirstname()?> </td>
            <td> <?=$mesUsers[$i]->getSurname()?> </td>
            <td> <?=$mesUsers[$i]->getBirthdate()->format("Y-m-d h:i:s") ?> </td>
            <td>  <?=$mesUsers[$i]->getMoney()?> </td>
            <td>  <?=$mesUsers[$i]->getPhoneNumber()?> </td>
            <td>  <?=$mesUsers[$i]->getMailAddress() ?> </td>
            <td>  <?=$mesUsers[$i]->getReputation()?> </td>
            <td>  <?=$mesUsers[$i]->getGender()?> </td>
            <td>   <?=$mesUsers[$i]->getCreationDate()->format("Y-m-d h:i:s")?></td>
            <td> <?=$mesUsers[$i]->getNbClientCourses()?> </td>
            <td> <?=$mesUsers[$i]->getDescription()?> </td>
            <td>  <a href="/modifUserAdmin&id=<?=$mesUsers[$i]->getId()?>&type=Client"> Plus de détails</a></td>
        </tr>

    <?php  }  ?>
    </tbody>

</table>



<?php $content = ob_get_clean(); ?>

<?php require("../src/View/template.php"); ?>

