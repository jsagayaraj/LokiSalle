<?php
require_once("inc/init.inc.php");
if(!utilisateurEstConnecte())
{
	header("location:connexion.php");
	
}
require_once ("inc/header.inc.php");
require_once ("inc/menu.inc.php");
//echo $msg;
//debug($_SESSION);

?>

<section id = "global">
			
		
	<fieldset>
		<legend>Vos Informations</legend>
			<?php
			if(utilisateurEstConnecteEtEstAdmin())
			{
				echo '<h3>Vous êtes Administrateur</h3>';
			}
			else {
				echo '<h3>Vous êtes Membre</h3>';
			}
			
			echo '<p class="profil_p">Votre pseudo est: <strong>'.$_SESSION['utilisateur']['pseudo'].'</strong></p>';
			echo '<p class="profil_p">Votre Nom est: <strong>'.$_SESSION['utilisateur']['nom'].'</strong></p>';
			echo '<p class="profil_p">Votre Prénom est: <strong>'.$_SESSION['utilisateur']['prenom'].'</strong></p>';
			echo '<p class="profil_p">Votre Email est: <strong>'.$_SESSION['utilisateur']['email'].'</strong></p>';
			echo '<p class="profil_p">Votre Sexe est: <strong>'.$_SESSION['utilisateur']['sexe'].'</strong></p>';
			echo '<p class="profil_p">Votre Adresse est: <strong>'.$_SESSION['utilisateur']['adresse'].'</strong></p>';
			echo '<p class="profil_p">Votre Code postal est: <strong>'.$_SESSION['utilisateur']['cp'].'</strong></p>';
			echo '<p class="profil_p">Votre Ville est: <strong>'.$_SESSION['utilisateur']['ville'].'</strong></p>';

			?>
				
		<form name="changeprofil" action="modifprofil.php" method="post">
			<input class="type_submit" name="changeprofil" type="submit" value="Mettre à jour mes informations">
		</form>	
	</fieldset>
</section>


<?php
require_once ("inc/footer.inc.php");
?>