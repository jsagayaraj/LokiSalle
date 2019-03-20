<?php 
require_once("inc/init.inc.php");

if(isset($_POST['changeinfoprofil']))
	{
			$changeinfoprofil = executeRequete("UPDATE membre SET nom='$_POST[nom]',prenom='$_POST[prenom]',email='$_POST[email]',sexe='$_POST[sexe]',ville='$_POST[ville]',cp='$_POST[cp]',adresse='$_POST[adresse]' WHERE id_membre=".$_SESSION['utilisateur']['id_membre']."");
			
			$selection_membre =  executeRequete("SELECT * FROM membre WHERE id_membre=".$_SESSION['utilisateur']['id_membre']."");
			$membre = $selection_membre->fetch_assoc();

			foreach($membre as $indice => $valeurs)
				{
						$_SESSION['utilisateur'][$indice] = $valeurs;
						
				}
				header("location:profil.php");
	}
if(isset($_POST['changemdp']))
{
	header("location:changemdp.php");
}


?>