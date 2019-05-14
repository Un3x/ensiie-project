<?php 
if (!isset($_SESSION['Utilisateur']))
{?>
    <button onclick="login()" class="btn btn-primary btn-xs" name="login" style="float: right; margin-bottom: 10px;">Connexion</button>
<?php 
}
else
{?>
    <p style="float: right;">
    <?php
    if ($_SESSION['Utilisateur']->getIsAdmin())
    {?>
        <button onclick="admin()" class="btn btn-success btn-xs" name="admin" style="font-size: small; display: inline-block;">Admin</button>
    <?php
    }?>
    <span class="label label-primary" style="font-size: small; display: inline-block;"><?php 
	
		$pseudo = $_SESSION['Utilisateur']->getPseudo();
		if($pseudo == NULL)
			echo $_SESSION['Utilisateur']->getAriseID();
		else
			echo $pseudo
	
	?></span>
    <button onclick="logout()" class="btn btn-danger btn-xs" type="submit" name="logout">Déconnexion</button>
    </p>

<?php 
}?>

<br/>
<br/>

<script>
    function login()
    {
        window.location.href = "View/connexion_form.php"
    }
    function logout()
    {
        window.location.href = "Controller/logout.php"
    }
    function admin()
    {
        window.location.href = "admin.php"
    }
</script>
