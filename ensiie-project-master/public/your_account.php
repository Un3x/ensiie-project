<?php
    include("ini_session.php");
    if (!isset($_SESSION['active']) || !$_SESSION['active']) echo '<meta http-equiv="refresh" content="0;URL=index.php">';
?>

<html>
<head>
    <title>          Challenge Centrale Evry</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include("header.php"); ?>
    <?php include("menu.php"); ?>
    <div id="form_account" class="middle">
        <?php echo '<p class = "hello">
            <br/> Bonjour '.$_SESSION['prenom'].' ! 
            </p>';
        ?>
        <form action="modify_account.php" method="POST">
            <p>
                <?php
                    echo 'Adresse email : '.$_SESSION['email'];
                ?>
            </p>
            <p>
                <?php
                    echo 'Nom : '.$_SESSION['nom'];
                ?>
            </p>
            <p>
                <?php
                    echo 'Prenom : '.$_SESSION['prenom'];
                ?>
            </p>
            <p>
                <?php
                    echo 'Sport : '.$_SESSION['sport'];
                ?>
            </p>
            <p>
                <?php
                    echo 'Genre : '.$_SESSION['genre'];
                ?>
            </p>
            <p>
                <?php
                    echo 'Tel : '.$_SESSION['tel'];
                ?>
            </p>
            <p>
                <input type="submit" id="btn" value="Modifier" />
            </p>
        </form>
    </div>
    <?php include("footer.php"); ?>
</body>
</html>