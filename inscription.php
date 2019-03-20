<?php
require_once("inc/init.inc.php");
require_once ("inc/header.inc.php");
require_once ("inc/menu.inc.php");
if(utilisateurEstConnecte()){
	header('location:profil.php');
}

if($_POST){

	$verif_caractere = preg_match('#^[a-zA-Z0-9._-]+$#', $_POST['pseudo']); // retourne FALSE si mauvais caractères dans $_POST['pseudo'] sinon TRUE.
	if(!$verif_caractere && !empty($_POST['pseudo']))
	{
		$msg .= '<div class="error">Caractères acceptés: A à Z et de 0 à 9</div>';
	}	
	/**************************************/
	// EXPRESSION REGULIERE
	// les # indiquent le début et la fin de notre expréssion régulière 
	// ^ indique le début de la chaine, sinon la chaine pourrait commencer par autre chose
	// $ indique la fin de la chaine, sinon la chaine pourrait finir par autre chose.
	// + indique que les caractères autorisés peuvent aparaitre plusieurs fois.
	/**************************************/
	if(strlen($_POST['pseudo']) < 4 || strlen($_POST['pseudo']) > 14) // pb de taille
	{
		$msg .= '<div class="error">Le pseudo doit avoir entre 4 et 14 caractères inclus !</div>';
	}
	if(strlen($_POST['mdp']) < 4 || strlen($_POST['mdp']) > 14) // pb de taille
	{
		$msg .= '<div class="error">Le mot de passe doit avoir entre 4 et 14 caractères inclus !</div>';
	}
	
	if(empty($msg))// si $msg est vide alors il n'y a pas d'erreur, nous pouvons lancer l'inscription !
	{
		$membre = executeRequete("SELECT * FROM membre WHERE pseudo='$_POST[pseudo]'");
		if($membre->num_rows > 0) // si superieur à 0: le pseudo est déja pris
		{
			$msg .= '<div class="error" >Pseudo indisponible !</div>';
		}
		else { // dans le cas contraire: le pseudo est unique:=> on lance l'inscription
				foreach($_POST AS $indices => $valeurs)
					{
						$_POST[$indices] = htmlEntities(addslashes($valeurs));
					}
					executeRequete("INSERT INTO membre (pseudo, mdp, nom, prenom, email, sexe, ville, cp, adresse) VALUES ('$_POST[pseudo]', '$_POST[mdp]', '$_POST[nom]', '$_POST[prenom]', '$_POST[email]', '$_POST[sexe]', '$_POST[ville]', '$_POST[cp]', '$_POST[adresse]')");
					
					$id_mem = $mysqli->insert_id;

					if(!empty($_POST['newsletter']))
					{
						executeRequete("INSERT INTO newsletter (id_membre) VALUES ('$id_mem')");

					}else
					{
						
					}
				$msg.= '<div class="primiere">Félicitations ! Votre inscription a bien été enregistrée.</div>';
				//header('location:profil.php');
		}		
	}	
}


echo $msg;
/* if($_POST){
	
	debug($_POST);
} */
	

?>

<section id = "global">
			<form method ="post" action = "">
			
					<fieldset>
					<legend>Informations Personnelles</legend>
					<div>
					<label class = "well" for = "pseudo">Pseudo<span style="color:red;">*</span></label>
					<input class = "type_text" type = "text" id = "pseudo" name = "pseudo" value = "<?php if(isset($_POST['pseudo'])) {echo $_POST['pseudo'];}?>" maxlength="14" required placeholder="Pseudo..."/>
					</div>
					
					<div>
					<label class = "well" for = "mdp">Mot de passe<span style="color:red;">*</span></label>
					<input class = "type_text" type = "password" id = "mdp" name = "mdp" value = "<?php if(isset($_POST['mdp'])) {echo $_POST['mdp'];}?>"  required placeholder="Mot de passe..."/>
					</div>
														
					<div>
					<label class = "well" for = "nom">Nom<span style="color:red;">*</span></label>
					<input  class = "type_text" type = "text" id = "nom" name = "nom" value = "<?php if(isset($_POST['mdp'])) {echo $_POST['mdp'];}?>" maxlength="14" required placeholder="Entrez votre nom..." />
					</div>
					
					<div>
					<label class = "well" for = "prenom">Prénom</label>
					<input class = "type_text" type = "text" id = "prenom" name = "prenom" value = "<?php if(isset($_POST['mdp'])) {echo $_POST['mdp'];}?>" maxlength="14"  placeholder="Entrez votre prénom..."/>
					</div>
					
					<div>
					<label class = "well" for = "email">Email<span style="color:red;">*</span></label>
					<input class = "type_text" type = "text" id = "email" name = "email" value = "<?php if(isset($_POST['email'])) {echo $_POST['email'];}?>" required placeholder = "Votre Email" />
					</div>
					
					<div>
					<label class="well" for ="sexe" class="name">Sexe</label>
					
					<input class= "type_radio" type = "radio" name = "sexe" value="M"<?php if(isset($_POST['sexe']) && $_POST['sexe'] == "m") { echo 'checked';}elseif(!isset($_POST['sexe'])) { echo 'checked'; } ?> />Homme
					
					<input class= "type_radio" type = "radio" name = "sexe" value="Mme" <?php if(isset($_POST['sexe']) && $_POST['sexe'] == "f") { echo 'checked';} ?>/>Femme
					
					</div>
					<h6><span style="color:red;">*</span> Champs sont obligatoire</h6>
				</fieldset>
				
				<fieldset>
				<legend>Adresse de contact</legend>
					<div>
					<label class = "well" for = "ville">Ville</label>
					<input class = "type_text" type = "text" id = "ville" name = "ville" value = "<?php if(isset($_POST['ville'])) {echo $_POST['ville'];}?>"  placeholder="Ville..."/>
					</div>
					
					<div>
					<label class = "well" for = "cp">Code postal</label>
					<input  class = "type_text" type = "number" id = "cp" name = "cp" value = "<?php if(isset($_POST['cp'])) {echo $_POST['cp'];}?>" maxlength="5" placeholder="Code postal..."/>
					</div>
					
					<div>
					<label class = "well" id = "adresse_box" for = "adresse">Adresse</label>
					<textarea id = "adresse" name = "adresse" value = "<?php if(isset($_POST['adresse'])) {echo $_POST['adresse'];}?>"  placeholder="Adresse..."></textarea>
					</div>
					<div>
					<label class="well" for ="newsletter" class="name">M'inscrire à la Newsletter</label>
					<input class= "type_radio" type = "checkbox" name = "newsletter" value="yes"/>Oui
					
					</div>
					<div>
					<input class= "type_reset" type = "reset" id = "reset" name = "reset" value = "Reset"/>
					<input  class= "type_submit" type = "submit" id = "inscription" name = "inscription" value = "Enregistrer"/>
					</div>
				</fieldset>
					

		</form>
</section>


<?php
require_once ("inc/footer.inc.php");

?>