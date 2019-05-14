<?php $title = "Accès Admin! " ?>

<?php ob_start(); ?>


    <table>
        <thead>
        <tr>
            <th> Id  </th>
            <th> Nom de la race  </th>
            <th> Vitesse  </th>
            <th> Capacité  </th>

        </tr>
        </thead>
        <tbody>
        <?php  for($i = 0; $i < count($mesRaces); $i++) {  ?>
            <tr>
                <td> <?= $mesRaces[$i]->getId() ?> </td>
                <td> <?= $mesRaces[$i]->getName() ?> </td>
                <td> <?= $mesRaces[$i]->getSpeed() ?> </td>
                <td> <?= $mesRaces[$i]->getCapacity() ?> </td>

            </tr>
        <?php } ?>
        </tbody>

    </table>

<br/>
<br/>

<p>
    <a href="/ajoutRaceAdmin"> <input type="button" value="Ajouter une race"/>  </a>
</p>

<?php $content = ob_get_clean(); ?>


<?php require ("../src/View/template.php"); ?>

