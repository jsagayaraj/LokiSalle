<?php
require_once("../inc/init.inc.php");

if(!utilisateurEstConnecteEtEstAdmin())
{
	header("location:../noadmin.php");
	exit();
}
else{
	require_once ("../inc/header.inc.php");
	require_once ("../inc/menu.inc.php");
}

	echo '<a href="?action=affichage" class="affiche">Liste des Membres</a> | ';
	echo '<a class="ajout" href="?action=ajouter">Ajouter un membre</a>';
	
	
	echo '<h1>';
if(isset($_GET['action']) && $_GET['action'] == 'ajouter')
{
	echo '<div class="affichage">Ajouter un membre</div>';
}
if(isset($_GET['action']) && $_GET['action'] == 'affichage')
{
		echo '<div class="affichage">Liste des membres</div>';
}
echo '</h1>';
	
	
if(isset($_GET['action']) && $_GET['action'] == "affichage")
{
	echo '<div>';
	$resultat = executeRequete("SELECT * FROM membre");
	echo "Nombre de membre(s) : " . $resultat->num_rows;

	$nbcol = $resultat->field_count;
	echo "<table> <tr>";
	for ($i=0; $i < $nbcol; $i++)
	{    
		$colonne = $resultat->fetch_field(); 
		echo '<th>' . $colonne->name . '</th>';
	}
	echo "<th>Modification</th>";
	echo "<th>Suppression</th>";
	echo "</tr>";

	while ($ligne = $resultat->fetch_assoc())
  {  
		echo '<tr>';
		foreach ($ligne as $indice => $information)
		/*{
			if($indice == "photo")
			{
			echo "<td><img src='" . $information . "' width='70' height='70' /></td>";
			}
			else
			{
				echo "<td>" . $information . "</td>";
			}
		}*/
		echo "<td>" . $information . "</td>";
		echo '<td><a href="?action=modifier&id_membre=' . $ligne['id_membre'] .'"><i class="fa fa-pencil-square-o"style="color:green; font-size:18px;"></i></a></td>';
		if($ligne['statut'] == '1' && $ligne['id_membre'] == $_SESSION['utilisateur']['id_membre'])
		{
			echo '<td><i class="fa fa-ban" style="color:red; font-size:18px;"></i></td>';
		}
		else
		{
			echo '<td><a href="?action=suppression&id_membre=' . $ligne['id_membre'] .'" OnClick="return(confirm(\'Confirmez-vous la suppression ?\'));"><i class="fa fa-trash-o" style="color:red; font-size:18px;"></i></a></td>';
		}
		
		echo '</tr>';
	}
	echo '</table>';
	echo '* Vous ne pouvez pas supprimer la session sur laquelle vous êtes connectés.';
	echo "</div>";
}

if(isset($_GET['action']) && $_GET['action'] == "suppression")
{
	executeRequete("DELETE FROM membre WHERE id_membre = $_GET[id_membre]");
	//header("location:gestion_membre.php?action=affichage");
}

if(isset($_GET['action']) && ($_GET['action'] == "ajouter" || $_GET['action'] == "modifier"))
{
		if($_GET['action'] == 'modifier')
	{
		$resultat = executeRequete("SELECT * FROM membre WHERE id_membre='$_GET[id_membre]'");
		$infos_id_membre = $resultat->fetch_assoc();
	}
?>


<section id = "global">
		<form method = "post" action = "">

			
				<fieldset>
					<legend>Gestion Membre</legend>
										
					<?php
					echo '<div>';
					if($_GET['action'] == 'modifier')
					{
						echo '<label class = "well" for="pseudo">Pseudo</label>'. $infos_id_membre['pseudo'] . '<br>';
					}
					else{
					echo '<label class = "well" for="pseudo">Pseudo</label>';
					echo "<input type='text' class = 'type_text' id='pseudo' name='pseudo' value='' maxlength='14' placeholder='pseudo' title='caractères acceptés : a-zA-Z0-9_.' required  ><br>";
					}
					echo '</div>';
					?>
					<div>
					<label class = "well" for = "mdp">Mot de passe</label>
					<input class = "type_text" type = "text" id = "mdp" name = "mdp" value = "<?php if(isset($infos_id_membre['mdp'])) echo $infos_id_membre['mdp'] ?>"  maxlength="14" placeholder="Mot de passe..."/>
					</div>
												
					<div>
					<label class = "well" for = "nom">Nom</label>
					<input  class = "type_text" type = "text" id = "nom" name = "nom" value = "<?php if(isset($infos_id_membre['nom'])) echo $infos_id_membre['nom'] ?>" placeholder="Entrez votre nom..." />
					</div>
					
					<div>
					<label class = "well" for = "prenom">Prénom</label>
					<input class = "type_text" type = "text" id = "prenom" name = "prenom" value = "<?php if(isset($infos_id_membre['prenom'])) echo $infos_id_membre['prenom'] ?>"  placeholder="Entrez votre prénom..."/>
					</div>
					
					<div>
					<label class = "well" for = "email">Email</label>
					<input class = "type_text" type = "text" id = "email" name = "email" value = "<?php if(isset($infos_id_membre['email'])) echo $infos_id_membre['email'] ?>" placeholder = "Votre Email" />
					</div>
					
					<div>
					<label class="well" for ="sexe" class="name">Sexe</label>
					
					<input class= "type_radio" type = "radio" name = "sexe" value="M"<?php if(isset($infos_id_membre['sexe']) && $infos_id_membre['sexe'] == "M") echo 'checked' ?> />Homme
					
					<input class= "type_radio" type = "radio" name = "sexe" value="F" <?php if(isset($infos_id_membre['sexe']) && $infos_id_membre['sexe'] == "F") echo 'checked' ?>/>Femme
					
					</div>
									
					<div>
					<label class = "well" for = "ville">Ville</label>
					<input class = "type_text" type = "text" id = "ville" name = "ville" value = "<?php if(isset($infos_id_membre['ville'])) echo $infos_id_membre['ville'] ?>"  placeholder="Ville..."/>
					</div>
					
					<div>
					<label class = "well" for = "cp">Code postal</label>
					<input  class = "type_text" type = "text" id = "cp" name = "cp" value = "<?php if(isset($infos_id_membre['cp'])) echo $infos_id_membre['cp'] ?>"  placeholder="Code postal..."/>
					</div>
					
					<div>
					<label class = "well" id = "adresse_box" for = "adresse">Adresse</label>
					<textarea id = "adresse" name = "adresse" value = "<?php if(isset($infos_id_membre['adresse'])) echo $infos_id_membre['adresse'] ?>"  placeholder="Adresse..."></textarea>
					</div>

					<div>
					<label class = "well" for = "statut">Statut</label>
					<input class= "type_radio" type="radio" name="statut" value="0" <?php if(isset($infos_id_membre['statut']) && $infos_id_membre['statut']==0) echo 'checked' ?>>Membre
					<input class= "type_radio" type="radio" name="statut" value="0" <?php if(isset($infos_id_membre['statut']) && $infos_id_membre['statut']==1) echo 'checked' ?>>Administrateur
					</div>

					<div>
					<input  class= "type_submit" type = "submit" id = "inscription" name = "inscription" value = "<?php echo ucfirst($_GET['action']);?>"/>
					</div>
				</fieldset>
			</form>
</section>

<?php  
}
?>

<?php 
if(isset($_POST['inscription']) && $_GET['action'] == 'ajouter')
{
 	$verif_caracteres = preg_match('#^[a-zA-Z0-9._-]+$#',$_POST['pseudo']);
 	if(!$verif_caracteres && !empty($_POST['pseudo']))
 	{
   		$msg .= '<div class="error">Caractères acceptés : A à Z et de 0 à 9</div>';
 	}
	if(strlen($_POST['pseudo']) < 4 || strlen($_POST['pseudo']) > 14)
	{
		$msg .= '<div class="error">Le pseudo doit être compris entre 4 et 14 caractères</div>';
	}
	if(strlen($_POST['mdp']) < 4 || strlen($_POST['mdp']) > 14)
	{
		$msg .= '<div class="error">Le mot de passe doit être compris entre 4 et 14 caractères</div>';
	}   

 	if(empty($msg))// si $msg est vide alors il n'y a pas d'erreur, nous pouvons lancer l'inscription !
  	{
		$membre = executeRequete("SELECT * FROM membre WHERE pseudo='$_POST[pseudo]'");
	    if($membre->num_rows > 0)
	    {
	       $msg .= '<div class="error">Pseudo indisponible</div>';
	    }
	    else
		{
	    foreach($_POST as $indices => $valeurs)
	    {
	    	$_POST[$indices] = htmlEntities(addslashes($valeurs));
	    }
	    	executeRequete("INSERT INTO membre (pseudo,mdp,nom,prenom,email,sexe,ville,cp,adresse,statut) VALUES ('$_POST[pseudo]','$_POST[mdp]','$_POST[nom]','$_POST[prenom]','$_POST[email]','$_POST[sexe]','$_POST[ville]','$_POST[cp]','$_POST[adresse]','$_POST[statut]')");
	      
	    if($_POST['statut'] == 0)
			{
				$msg .= '<div class="primiere">Nouveau Membre créé.</div>';
			}
				else
				{
					$msg = '<div class="primiere">Nouvel Administrateur créé.</div>';
				}
	    }
	}
}
if(isset($_POST['inscription']) && $_GET['action'] == 'modifier')
{
	$resultat = executeRequete("SELECT pseudo FROM membre WHERE id_membre='$_GET[id_membre]'");
	$pseudo = $resultat->fetch_assoc();
	executeRequete("REPLACE INTO membre (id_membre,pseudo,mdp,nom,prenom,email,sexe,ville,cp,adresse,statut) VALUES ('$_GET[id_membre]','$pseudo[pseudo]','$_POST[mdp]','$_POST[nom]','$_POST[prenom]','$_POST[email]','$_POST[sexe]','$_POST[ville]','$_POST[cp]','$_POST[adresse]','$_POST[statut]')");

	$msg = "<div class='primiere'>Modification(s) effectuée(s)</div>";
	//header("location:gestion_membre.php?action=affichage");
}
echo $msg;
?>

<?php
require_once ("../inc/footer.inc.php");

