<?php
require_once("inc/init.inc.php");

if(utilisateurEstConnecte()) // Verification de la connextion de l'utilisateur
{
	header("location:index.php"); // s'il l'est il est renvoyé vers sa page de profil
}

if(isset($_GET['action']) && $_GET['action'] == 'deconnexion')
{
	//session_start();
	//setcookie('pseudo','',time()-3600);
	//setcookie('mdp','',time()-3600);
	//$_SESSION = array();
	session_destroy();
	//header("location:connexion.php");
	// unset($_SESSION['utilisateur']);
}

	


/*if($_POST) // si l'utilisateur demande une connexion
{

	$pseudo = htmlentities($_POST['pseudo'], ENT_QUOTES);
	$mdp = htmlentities($_POST['mdp'], ENT_QUOTES);
	
	$selection_membre = executeRequete("SELECT * FROM membre WHERE pseudo='$pseudo' AND mdp='$mdp'");
	
	if($selection_membre->num_rows != 0)// s'il y a bien au moins une ligne de resultat alors le pseudo et le mdp sont ok
	{
		$msg .= '<div class="primiere">Pseudo et mdp OK !</div>';
		$membre = $selection_membre->fetch_assoc(); // on traite le résultat avec fetch_assoc() pour transformer la ligne de resultat en tableau ARRAY
		
		foreach($membre AS $indice => $valeur)
		{
			if($indice != 'mdp')
			{
				$_SESSION['utilisateur'][$indice] = $valeur; // on inscrit les informations de l'utilisateur dans la session au niveau de l'indice que nous créons "utilisateur"
			}
		}
		header("location:profil.php"); // on redirige sur la page profil.
		exit(); // sécurité, qui permet d'arreter l'execution du code de cette page après la redirection.
		
		
	}
	else {
		$msg .= '<div class="error">Erreur d\'identification !</div>';
	}
}*/
if(isset($_POST['connexion']))
		{

			$pseudo = htmlentities($_POST['pseudo'], ENT_QUOTES);
			$mdp = htmlentities($_POST['mdp'], ENT_QUOTES);

			  $selection_membre =  executeRequete("SELECT * FROM membre WHERE pseudo='$pseudo'"); //On vérifie que le pseudo existe dans la base de données.
			  if($selection_membre->num_rows !=0)
				{
						$membre = $selection_membre->fetch_assoc();
						if($membre['mdp'] == $mdp) //On vérifie si le mot de passe saisi par l'utilisateur correspond à celui de la base de données.
						{
							foreach($membre as $indice => $valeurs)
							  {
								if($indice != 'mdp')
								if(isset($_POST['rememberme'])){
									setcookie('pseudo',$_POST['pseudo'], time()+365*24*3600,null,null,false,true);
									setcookie('mdp',$_POST['mdp'], time()+365*24*3600,null,null,false,true);

								}
									{
										$_SESSION['utilisateur'][$indice] = $valeurs;
									}
							  }
							header("location:profil.php"); //Si le pseudo et le mot de passe sont corrects, l'utilisateur est renvoyé vers sa page de profil.
						}
						else //Le mot de passe est incorrect : 
						{
						  $msg .="<div class='error'>Mot de passe incorrect.</div>";
						}
				}
		  else //Le pseudo est incorrect :
		  {
			  $msg .="<div class='error'>Pseudo incorrect.</div>";    
		  }
		}

		if(isset($_POST['mdpperdu']))
		{
			if(empty($_POST['pseudo']))
			{
				header("location:mdpperdu.php");
			}
		}

require_once ("inc/header.inc.php");
require_once ("inc/menu.inc.php");
echo $msg;

?>

<section id = "global">
			<form method="post" action = "">
			
				<fieldset>
					<legend>Connexion</legend>
						
						<div id = "left-side-box">
						<p class = "text-connexion-su">Déjà membre?</p>
							<div class = "bluebox">
								
								<label class = "label-connexion" for = "pseudo">Pseudo</label>
								<input class = "type_text_connexion" type = "text" id = "pseudo" name = "pseudo" value = "<?php if(isset($_POST['pseudo'])) { echo $_POST['pseudo']; } ?>"  placeholder="Pseudo..."/>
							</div>
								
							<div class = "bluebox">
								<label class = "label-connexion" for = "mdp">Mot de passe</label>
								<input class = "type_text_connexion" type ="password" id = "mdp" name = "mdp" maxlength="14" value = ""   placeholder="Mot de passe..."/>
							</div>
							<div class = "bluebox">
								<label style="font-size: 14px; font-weight: bold; text-align: right;" for="remembercheckbox">Se souvenir de moi</label>
								<input style ="margin-left:10px;"type ="checkbox" name = "rememberme" id="rememberme" />
							</div>
					






							<input  class= "type_submit_connexion" type = "submit" id = "connexion" name = "connexion" value = "Connexion">
							<input type="submit" name="mdpperdu" value="Mot de passe oublié">


						</div>
					
					<div id ="right-side-box">
					<?php
						echo '<p class="text-connexion-su">Pas encore membre?</p><br/><br/><br/>';
						echo '<p class="text-connexion"><a href = "'.RACINE_SITE.'inscription.php">Inscrivez-vous</a></p>';
				
					?>
					</div>
				</fieldset>
				
				
			</form>
</section>


<?php
require_once ("inc/footer.inc.php");



?>


