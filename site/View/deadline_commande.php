<!DOCTYPE html>
<html>
<body>
<?php
if ($_SESSION['currentEvenement']->getDate() < date('Y-m-d'))
{?>
    <div class="alert alert-warning">
        <strong>📅 Les commandes sont ferm�es !</strong>
    </div>
    
<?php
} 
else 
{?>
    <div class="alert alert-danger">
        <strong>📅 Les commandes sont ouvertes jusqu'au <?php echo $_SESSION['currentEvenement']->getDate() ?> !</strong>
    </div>
<?php
}
?>
</body>
</html>