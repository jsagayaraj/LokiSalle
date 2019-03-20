<?php
require_once ("inc/init.inc.php");

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
	}
	
}	
if(empty($msg)){
	$changepw = executeRequete("UPDATE membre SET mdp='$_POST[mdp1]' WHERE id_membre='".$_SESSION['utilisateur']['id_membre']."'");
	$msg .= '<div class="primiere">Mot de passe modifié</div>';

}
echo $msg;

?>