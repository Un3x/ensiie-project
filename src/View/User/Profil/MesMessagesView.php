<?php $title = "Un merveilleux site pour réserver des licornes ! " ?>

<?php ob_start(); ?>



    <table>
        <thead>
        <tr>
            <th>  n° </th>
            <th> Date </th>
            <th> Heure  </th>
            <th> Objet </th>
        </tr>
        </thead>
        <tbody>
        <?php  for($i = 0; $i < sizeof($mesMessages); $i++) {  ?>
            <tr>
                <td> <?=$mesMessages[$i]['date']?> </td>
                <td> <?=$mesMessages[$i]['heure']?> </td>

            </tr>
        <?php } ?>
        </tbody>

    </table>




<?php $content = ob_get_clean(); ?>

<?php require "../src/View/template.php"; ?>