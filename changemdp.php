<?php
require_once("inc/init.inc.php");
require_once ("inc/header.inc.php");
require_once ("inc/menu.inc.php");


?>
<section id="global">
	<form name="changemdp" method="post" action="">
		<fieldset>
				<legend>Changer son mot de passe :</legend>
				<label class="well" for="mdp1">MDP</label>
				<input class="type_text" name="mdp1" type="password"><br>
				<label class="well" for="mdp2">Confirm MDP</label>
				<input class="type_text" name="mdp2" type="password"><br>
				<input name="valider" class="type_submit" type="submit" value="Valider">
				<a href="profil.php">Retour à la page Profil</a>
		</fieldset>
	</form>			
</section>

<?php
if(isset($_POST['valider']))
{
	if(strlen($_POST['mdp1']) < 4 || strlen($_POST['mdp1']) > 14)
	{
	   	$msg .= '<div class="error">Le mot de passe doit être compris entre 4 et 14 caractères</div>';

	} 
	if(strlen($_POST['mdp2']) < 4 || strlen($_POST['mdp2']) > 14)
	{
	 	 $msg .= '<div class="error">Le mot de passe doit être compris entre 4 et 14 caractères</div>';
	}

	if($_POST['mdp1'] != $_POST['mdp2'])
	{
		$msg .= '<div class="error">Les mots de passes saisis ne correspondent pas.</div>';
	}else
	{

	$changepw = executeRequete("UPDATE membre SET mdp='$_POST[mdp1]' WHERE id_membre='".$_SESSION['utilisateur']['id_membre']."'");
	$msg .= '<div class="primiere">Mot de passe a été bien modifié</div>';
	}
	
}	

echo $msg;

require_once ("inc/footer.inc.php");

?>


