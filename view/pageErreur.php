<?php
echo '
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="./images/cssErreur.css"/>
    <title>Erreur 4004</title>
</head>
<body>
<h1 style="margin-top: 10%">CineEvry404</h1>
<p class="zoom-area"><b>Vous cherchez une page qui n\'existe pas '.$_SERVER['REQUEST_URI'].' n\'existe pas. </b></p>
<section class="error-container">
    <span>4</span>
    <span><span class="screen-reader-text">0</span></span>
    <span>4</span>
</section>
<div class="link-container">
    <a target="_blank" href="/accueil" class="more-link">vers la page d\'accueil</a>
</div>
</body>
</html>';
