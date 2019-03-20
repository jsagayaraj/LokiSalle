<?php
require_once("../inc/init.inc.php");

if(!utilisateurEstConnecteEtEstAdmin())
{
	header("location:../connexion.php");
	exit();
}
else{
	require_once ("../inc/header.inc.php");
	require_once ("../inc/menu.inc.php");
}

?>
<h1>Newsletter</h1>
<?php
require_once("../inc/init.inc.php");

	if (isset($_POST['send'])){
		$expediteur = htmlentities($_POST['expediteur'],ENT_QUOTES);
		$sujet = htmlentities($_POST['sujet'],ENT_QUOTES);
		$message = htmlentities($_POST['message'],ENT_QUOTES);
		$headers = "From: " . $expediteur;

		 $resultat = executeRequete("SELECT membre.email FROM membre INNER JOIN newsletter ON newsletter.id_membre = membre.id_membre");
		 echo "Nombre d'abonné à la newsletter :" . $resultat->num_rows;
		
		 while ($ligne = $resultat->fetch_assoc()) {
		 	mail($ligne['email'],$sujet,$message,$headers);
		 }
		 //header('../location:index.php');
	}
?>
<section id = "global">
			<form method ="post" action = "">
			
					<fieldset>
					
					<div>
					<label class = "well" for = "expediteur">Expéditeur</label>
					<input class = "type_text" type = "text" id = "expediteur" name = "expediteur"/>
					</div>

					<div>
					<label class = "well" for = "sujet">Sujet</label>
					<input  class = "type_text" type = "text" id = "sujet" name = "sujet"/>
					</div>
					
					<div>
					<label class = "well" id = "message" for = "adresse">Message</label>
					<textarea id = "message" name = "message"></textarea>
					</div>
					<div style ="text-align:center;">
					<input  class= "type_submit" type = "submit" id = "send" name = "send" value = "Envoi de la Newsletter aux membres"/>
					</div>
				</fieldset>
					
		</form>
</section>
















<?php
require_once ("../inc/footer.inc.php");

?>