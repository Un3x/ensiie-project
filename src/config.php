<?php

$connecte = isset($_SESSION["id_utilisateur"]);
$script ="";


class User
{


    public function __construct()
    {
    }

    public function getAge()
    {
        return 20;
    }
    public function getPrenom()
    {
        return "Azathoth";
    }
    public function getNom()
    {
        return "le néant";
    }
    public function getDescription()
    {
        return "Chaos primordiale, au centre de tout chose, en dehors de l'espace-temps";
    }

}

