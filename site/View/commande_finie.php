<!DOCTYPE html>
<html>
<body>
<div class="panel panel-default">
<div class="panel-heading text-center">
<strong>Voici vos commandes :</strong><br/>
</div>
<?php
foreach($_SESSION['Utilisateur']->getCommandes() as $commande){
?>
  <div class="panel panel-default">
    <div class="panel-heading text-left">
    Vous avez commandé : <br/>
    </div>
    <div class="panel-body">
    <div class="text-left">
      <?php echo $commande->toString();?>
    </div>
    </div>  
  </div>
<?php
}
?>
</div>
<hr/>
</body>

<?php
if(isset($_POST['supprime']))
{
  $utilisateur->getCommandes($commande);
}
?>

</html>
