<?php
require_once("inc/init.inc.php");

require_once ("inc/header.inc.php");
require_once ("inc/menu.inc.php");


?>

<section id = "global">
			<form method = "post" action = "">
			
				<fieldset>
					<legend>Contactez-nous</legend>
				<?php	
					if(!utilisateurEstConnecte()){
						echo '<h5>Veuillez vous <a href = "connexion.php"><u><span style="color:#2EAEF0";>connecter</span></u></a> pour pouvoir contacter ADMIN</h5>';
					}else
					{

						echo '<div>';
						echo '<label  class = "well" >Nom</label>';
						echo '<label>'.$_SESSION['utilisateur']['nom'].'</label>';
						echo '</div>';

						echo '<div>';
						echo '<label  class = "well">Prenom</label>';
						echo '<label>'.$_SESSION['utilisateur']['prenom'].'</label>';
						echo '</div>';

						echo '<div>';
						echo '<label  class = "well" for = "sujet">Email</label>';
						echo '<label>'.$_SESSION['utilisateur']['email'].'</label>';
						echo '</div>';

						echo '<div>';
						echo '<label  class = "well"for = "sujet">Sujet</label>';
						echo '<input class = "type_text" type = "text" name = "sujet" placeholder="sujet..."/>';
						echo '</div>';

						echo '<div>';
						echo '<label class = "well" id = "adresse_box" for = "adresse">Message</label>';
						echo '<textarea name = "message" cols="10" rows = "5" placeholder="message..."></textarea>';
						echo '</div>';
				
						echo '<input  class= "type_submit_contact" type = "submit" name = "inscription" value = "Envoyer"/>';
					}

				if (isset($_POST['inscription']))
				{

					$to = "bjsahay@gmail.com";
					$nom = $_SESSION['utilisateur']['nom'];
					$prenom = $_SESSION['utilisateur']['prenom'];
					$header = 'from : '.$_SESSION['utilisateur']['email'];
					$subject = 'sujet : '.$_POST['sujet'];
					$message = 'message : '.$_POST['message'].'<br>';
					
					$sendmail = mail($to, $header, $subject,$message);

					if($sendmail == true) 
					{
						echo 'votre mail a été bine envoyer';
					}else
					{
						echo 'problem de connexion';
					}
				}


				?>
						
					
			
				

			
				</fieldset>
				
				
				</form>
</section>


<?php
require_once ("inc/footer.inc.php");

?>