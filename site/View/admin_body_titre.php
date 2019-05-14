<!DOCTYPE html>
<html>
<body>

<div class="container" style="max-width: 900px;">
<?php if(isset($_SESSION['resAdmin'])){?>
	<div class="alert alert-info">
	<strong> <?php echo($_SESSION['resAdmin']);?></strong>
	</div>
<?php } ?>
    <h2 class="text-center">Gérer les évènements</h2>
    <hr/>
</body>
</html>