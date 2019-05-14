<?php
session_start();
require 'projetVue.php';

/**
 *  \brief : fonction qui permet de se connecter au site
 *  \param : pseudo 
 *  \param : mdp le mot de passe
 *  \param : status soit inscrit soit asministrateur
 */
function connexion($pseudo, $mdp, $status)
{
    //connexion a la base de donner
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $bdd = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");


    //si celui qui veux se connectter est un inscrit
    if($status == "inscrit")
    {
        $requete = $bdd->prepare("SELECT pseudo, mdp 
                            FROM inscrit WHERE pseudo = :pseudo");
    }
    //si celui qui veux se connecter est un adminitrateur
    else
    {
        $requete = $bdd->prepare("SELECT pseudo, mdp 
                            FROM administrateur WHERE pseudo = :pseudo");
    }

    //execution de la requete de connexion
    $requete->execute(array('pseudo' => $pseudo));

    //gestion de la connexion
    $donne = $requete->fetch();
    if( $donne['pseudo'] == $pseudo)
    {
        if($donne['mdp'] == $mdp)
        {
            recupererUtilisateur($pseudo, $status);
            header('Location: profil.php');
        }
        //le mot de passe est faux
        else
        {
            entete("");
            echo "le mot de passe est incorrecte<br/>";
            formulaireConnexion();
        }
    }
    //le pseudo n'existe pas dans la base de données
    else
    {
        entete("");
        echo "votre pseudo n'existe pas<br/>";
        echo "<h4>Réeseyez</h4>";
        formulaireConnexion();
        echo "<h4>Vous inscrire</h4>";
        formulaireInscription();
    }
}   


/**
 *  \brief : fonction qui permet de s'inscrire dans le site
 *  \param : tous les element de la table "inscrit" avec
 * le mot de passe repeter 2 fois pour verification
 */
function inscription( $pseudo, $nom, $prenom, $mdp, $mdp2,
                    $genre, $mail, $addresse, $numEtudiant, 
                    $dateDeNaissance)
{
    //connexion a la base de données
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $bdd = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");


    //MARK : est-ce que c'est faisable en JS de verifier que le pseudo existe deja

    //tester que les 2 mdp sont les meme
    if( $mdp != $mdp2)
    {
        entete("");
        echo "les deux mot de passe ne sont pas les memes <br/>";
        formulaireInscription();
        exit(0);
    }

    //preparation de la requete et exection
    $requete = $bdd->prepare( 'INSERT INTO inscrit(nom, prenom, pseudo,
                    numEtudiant, mail,
                    dateDeNaissance, genre, mdp, addresse)
                    VALUES( :nom, :prenom, :pseudo, :NumEtudiant,
                    :mail, :DateDeNaissance, :genre, :mdp, :adresse)');
    
    //insertion des valeurs dans la base
    $test = $requete->execute(array(
                            'nom' => $nom,
                            'prenom' => $prenom,
                            'pseudo' => $pseudo,
                            'NumEtudiant' => $numEtudiant,
                            'mail' => $mail,
                            'DateDeNaissance' => $dateDeNaissance,
                            'genre' => $genre,
                            'mdp' => $mdp,
                            'adresse' => $addresse
                        ));


    //initialisation des variables de session si l'inscription a reussiie
    if( $test == true)
    {
        //echo "l'inscription a reussie";
        $_SESSION['prenom']          = $_POST['prenom'];
        $_SESSION['nom']             = $_POST['nom'];
        $_SESSION['pseudo']          = $_POST['pseudo'];
        $_SESSION['addresse']        = $_POST['addresse'];
        $_SESSION['mail']            = $_POST['mail'];
        $_SESSION['numEtudiant']     = $_POST['numEtudiant'];
        $_SESSION['dateDeNaissance'] = $_POST['dateDeNaissance'];
        $_SESSION['mdp']             = $_POST['mdp'];
        $_SESSION['genre']           = $_POST['genre'];
        $_SESSION['status']          = "inscrit";
        header('Location: profil.php');
    }
    else
    {
        entete("");
        echo "l'inscription a echouer";
        formulaireInscription();
    }
}


/**
 *  \brief : fonction qui initialise les variables de session apre
 * apres la connexion ou l'inscription
 *  \param ; ppseudo lee pseudo de celui qui s'esst connecter
 *  \param : status le status de celui qui essaye de se connecter
 */
function recupererUtilisateur($pseudo, $status)
{
    //connexion a la base de données
    $dbName     = getenv('DB_NAME');
    $dbUser     = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $bdd = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
   
    //test si c'est un inscrit ou un administrateur
    if($status == "inscrit")
    {
        $requete = $bdd->prepare("SELECT * 
                            FROM inscrit WHERE pseudo = ?");
    }
    else
    {
        $requete = $bdd->prepare("SELECT *
                            FROM administrateur WHERE pseudo = ?");
    }
    //execution de la requete
    if($requete->execute(array($pseudo)))
    {
        $donne             = $requete->fetch();
        $_SESSION['nom']             = $donne['nom'];
        $_SESSION['pseudo']          = $donne['pseudo'];
        $_SESSION['prenom']          = $donne['prenom'];
        $_SESSION['mail']            = $donne['mail'];
        $_SESSION['dateDeNaissance'] = $donne['datedenaissance'];
        $_SESSION['addresse']        = $donne['addresse'];
        if($status == "inscrit")
        {$_SESSION['numEtudiant']     = $donne['numetudiant'];}
        else
        {$_SESSION['numEtudiant']  = $donne['numadministrateur'];}
        $_SESSION['mdp']             = $donne['mdp'];
        $_SESSION['genre']           = $donne['genre'];
        $_SESSION['status']          = $status;
    }
}

/**
 *  \brief : fonction qui met a jour le profil de l'utilisateur
 *  \param : pseudo de l'utilisateur actuel et les nouvelles valeurs
 */
function updateProfil($status, $pseudo, $dateDeNaissance, $mail,
                        $addresse, $genre)
{
    //connexion a la base de données
    $dbName     = getenv('DB_NAME');
    $dbUser     = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $bdd = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
    

    //si c'est un "inscrit" qui veux mettre a jour son profil 
    if( $status == "inscrit")
    {
        $requeteUpdate = $bdd->prepare('UPDATE inscrit SET 
                                    dateDeNaissance = :dateDeNaissance ,
                                    addresse = :adresse,
                                    genre = :genre,
                                    mail =  :mail WHERE pseudo = :pseudo ');
   
    }
    //si c'est un "addministrateur" qui veux mettre a jour son profil
    else
    {
        $requeteUpdate = $bdd->prepare('UPDATE administrateur SET 
                                    dateDeNaissance = :dateDeNaissance ,
                                    addresse = :adresse,
                                    genre = :genre,
                                    mail =  :mail WHERE pseudo = :pseudo ');
   
    }
    //execution de la requete
    $testUpdate = $requeteUpdate->execute(array( 
        'dateDeNaissance' => $dateDeNaissance,
        'mail' => $mail,
        'adresse' => $addresse,
        'genre' => $genre,
        'pseudo' => $pseudo
    ));


    //si la requete a echouer : redirection vers le profil
    if( $testUpdate == false)
    {
        header('Location: profil.php');
    }
    //si elle a reussie : mise a jour des variables de session
    //et redirection vers le profil
    else
    {  
        $_SESSION['mail'] = $mail;
        $_SESSION['dateDeNaissance'] = $dateDeNaissance;
        $_SESSION['genre'] = $genre;
        $_SESSION['addresse'] = $addresse;
        header('Location: profil.php');
    }
}


/**
 *  \breif : fonction qui fait le changement de mot de passe
 *  \param : pseudo le pseudo de l'utilisateur qui veux faire le changement
 *  \param ; les mot de passe de verification et de mise a jour 
 *  \param : status pour savoir dans quelle table changer le mdp
 *  \param : mdp le mdp recuperer depuis les variables de session
 */
function changerMdp( $pseudo, $mdp, $ancienMdp, $nvxmdp, $nvxmdp2, $status)
{
    //connexion a la base de données
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $bdd = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");

    //si les 2 mdps de mise a jour ne sont pas semblable
    if( $nvxmdp != $nvxmdp2)
    {
        entete("");
        echo "Les 2 mot de passe ne sont pas les memes<br/>";
        formulaireChangementMdp();
        navigation($status);
        exit(0);
    }
    
    //tester si le mdp de session et celui entrer sont les meme
    if( $mdp != $ancienMdp)
    {
        entete("");
        echo "Etes-vous sûr c'est votre session?";
        formulaireChangementMdp();
        navigation($status);
        exit(0);
    }

    //si c'est un utilisateur qui veux changer le mdp
    if( $status == "inscrit")
    {
        $requete = $bdd->prepare("UPDATE inscrit SET mdp = :mdp
                            WHERE pseudo = :pseudo");
    }
    //si c'est un administrateur qui veuux changer
    else
    {
        $requete = $bdd->prepare("UPDATE administrateur SET mdp = :mdp
                            WHERE pseudo = :pseudo");
    }

    $testMdp = $requete->execute(array(
                                'mdp' => $nvxmdp,
                                'pseudo' => $pseudo
                                ));
    header('Location: profil.php');
}

/**
 *  \brief : fonction qui permet a un administrateur de supprimer un utilisateur
 *  \param ; pseudo ; le pseudo de l'utilisateur a supprimer
 *  \param ; si ce n'est pas administrateur la suppression ne s'appique pas
 */
function supprimerUtilisateur($pseudo, $status)
{
    $dbName     = getenv('DB_NAME');
    $dbUser     = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $bdd = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
    
    $requete = $bdd->prepare("DELETE FROM inscrit
                            WHERE pseudo = :pseudo");

    $test = $requete->execute(array($pseudo));
    if( $test == false)
    {
        entete("");
        echo "la supression a echouer<br/>";
        navigation($status);
    }
    else
    {
        header('Location: gestionInscrit.php');

    }
}

/**
 *  \brief ; fonction qui permet de supprimer un article 
 *  \type ; le type de l'article qu'on veux supprimer
 */
function supprimerArticle( $type, $reference)
{
    $dbName     = getenv('DB_NAME');
    $dbUser     = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $bdd = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");


    //si on veux supprimer un audio
    if( $type == "Audio")
    {
        $requete = $bdd->prepare("DELETE FROM Audio
                            WHERE reference = :reference");
    }
    //si on veux supprimer une video
    else if( $type == "Video")
    {
        $requete = $bdd->prepare("DELETE FROM Video
                            WHERE reference = :reference");
    }
    //si l'article a supprimer est une livre
    else if( $type = "Livres")
    {
        $requete = $bdd->prepare("DELETE FROM Livres 
                            WHERE reference = :reference");
    }

    


    
    else
    {
        entete("");
        echo "la table $type n'existe pas<br/>";
        echo "<a href = \"profil.php\">Profil</a>";
    }
    $test = $requete->execute(array($reference));
    if($test == false)
    {
        entete("");
        echo "la supression a echouer";
        navigation($status);

    }
    else
    {
        header('Location: recherche.php');
    }
}
?>