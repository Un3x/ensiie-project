<?php

$ok_livre = 1;

if (isset($_POST['titre']) && isset($_POST['datepub']) && isset($_POST['image']) && isset($_POST['edition']) && isset($_POST['auteur1'])) {
    if (verifTitre($_POST['titre'])) {
        $new_idlivre=genereIdLivre();
        $tmp=$livreRepository->creeLivre($new_idlivre, htmlspecialchars($_POST['titre'], $flags = ENT_QUOTES), $_POST['auteur1'], $_POST['datepub'], $_POST['image'], $_POST['edition'], '', '');
        //modifier l'id de l'emprunteur de base non c'est bon je l'ai mis à null dans la fonction d'insertion

        $livreRepository->insertLivre($tmp);
        $tmp=$auteurRepository->creeAuteur($new_idlivre, $_POST['auteur1']);
        $auteurRepository->insertAuteur($tmp);
        if ($_POST['auteur2']!='') {
            $tmp=$auteurRepository->creeAuteur($new_idlivre, $_POST['auteur2']);
            $auteurRepository->insertAuteur($tmp);
        }
        if ($_POST['auteur3']!='') {
            $tmp=$auteurRepository->creeAuteur($new_idlivre, $_POST['auteur3']);
            $auteurRepository->insertAuteur($tmp);
        }
        if ($_POST['auteur4']!='') {
            $tmp=$auteurRepository->creeAuteur($new_idlivre, $_POST['auteur4']);
            $auteurRepository->insertAuteur($tmp);
        }
        if ($_POST['auteur5']!='') {
            $tmp=$auteurRepository->creeAuteur($new_idlivre, $_POST['auteur5']);
            $auteurRepository->insertAuteur($tmp);
        }
        if ($_POST['auteur6']!='') {
            $tmp=$auteurRepository->creeAuteur($new_idlivre, $_POST['auteur6']);
            $auteurRepository->insertAuteur($tmp);
        }

        header("Location: index.php");
    }
    else {
        // le livre existe déjà
        $ok_livre = 0;
    }
}

?>