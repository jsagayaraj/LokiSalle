<?php
require_once("../inc/init.inc.php");

if(!utilisateurEstConnecteEtEstAdmin())
{
	header("location:../connexion.php");
	exit();
}
?>
<div class="fix home_main_content">
<?php	
	// SUPPRESSION DE PRODUITS
if(isset($_GET['action']) && $_GET['action'] == 'suppression')
{
	$resultat = executeRequete("SELECT * FROM salle WHERE id_salle = '$_GET[id_salle]'"); // on récupère les informations de l'article afin de connaitre son image pour pouvoir la supprimer
	$article_a_supprimer = $resultat->fetch_assoc();
	$chemin_article = RACINE_SERVER . $article_a_supprimer['photo']; // nous avons besoin du chemin depuis la racine serveur pour supprimer la photo du serveur
	
	if(!empty($article_a_supprimer['photo']) && file_exists($chemin_article)) // file_exists() vérifie si le fichier existe bien.
	{
		unlink($chemin_article); // unlink() va supprimer le fichier du serveur.
	}
	echo '<div class="primiere">Suppression de la salle: $_GET[id_salle] </div>';
	executeRequete("DELETE FROM salle WHERE id_salle = '$_GET[id_salle]'");
	$_GET['action'] = 'affichage';
}
	
	
// ENREGISTREMENT DES PRODUITS
if(isset($_POST['enregistrement']))
{
	$reference = executeRequete("SELECT reference FROM salle WHERE reference='$_POST[reference]'"); // requete qui va interroger la BDD pour voir si la reference saisie existe !
	if($reference->num_rows > 0 && isset($_GET['action']) && $_GET['action'] == 'ajout') // si la référence existe déjà et qu'il s'agit bien d'un ajout
	{
		$msg .= '<div class="error">La référence est déjà attribuée, veuillez vérifier votre saisie !</div>';
	}
	else { // sinon la référence est valable.
		// $msg .= 'TEST';
		
		$photo_bdd = ""; // evite une erreur lors de la requete INSERT si le commercant ne charge pas une photo.
		
		if(isset($_GET['action']) && $_GET['action'] == 'modification')
		{
			$photo_bdd = $_POST['photo_actuelle']; // dans le cas d'une modification on récupère la photo actuelle avant de vérifier si l'utilisateur en charge une nouvelle.
		}
		
		if(!empty($_FILES['photo']['name']))
		{ // on vérifie si une photo a bien été postée.
			if(verificationExtensionPhoto())
			{
				// $msg .= '<div class="bg-success" style="margin-top: 20px; padding:10px; text-align: center;"><h4>OK</h4></div>';
				$nom_photo = $_POST['reference'] . '_' . $_FILES['photo']['name']; // afin que le nom de chaque photo soit unique.
				$photo_bdd = RACINE_SITE . "photo/$nom_photo"; // chemin src que l'on va enregistrer dans la BDD
				$photo_dossier = RACINE_SERVER . RACINE_SITE . "photo/$nom_photo"; // chemin pour l'enregistrement dans le dossier quiva servir dans la fonction copy()
				copy($_FILES['photo']['tmp_name'], $photo_dossier); // copy() permet de copier un fichier depuis un endroit (1er argument) vers un autre endroit (2ème argument).
				
			}
			else{
				$msg .= '<div class="error">L\'extension de la photo n\'est pas valide (png, gif, jpg, jpeg) !</div>';
			}			
		}
		if(empty($msg)) // s'il n'y a pas de message d'erreur, nous pouvons enregistrer les produits.
		{
			$msg .= '<div class="primiere">Enregistrement de la salle !</div>';
			
			foreach($_POST AS $indice => $valeur)
			{
				$_POST[$indice] = htmlentities($valeur, ENT_QUOTES);
			}
			extract($_POST);
			
			if(isset($_GET['action']) && $_GET['action'] == 'modification')
			{
				executeRequete("UPDATE salle SET id_salle = '$id_salle', reference = '$reference', pays = '$pays', ville = '$ville', adresse = '$adresse', cp = '$cp', titre='$titre', description='$description', photo = '$photo_bdd', capacite = '$capacite', categorie = '$categorie' WHERE id_salle = '$_POST[id_salle]'");
			}
			else {
				executeRequete("INSERT INTO salle ( id_salle, reference, pays, ville, adresse, cp, titre, description, photo, capacite, categorie) VALUES ('$id_salle', '$reference', '$pays', '$ville', '$adresse', '$cp', '$titre', '$description','$photo_bdd', '$capacite', '$categorie')");
			}
			$_GET['action'] = 'affichage';
			
		}
		
	}
}

// FIN ENREGISTREMENT DES PRODUITS
require_once ("../inc/header.inc.php");
require_once ("../inc/menu.inc.php");
echo $msg;
/* if($_POST){
	
	debug($_POST);
} */

		echo '<a href="?action=affichage" class="affiche">Nos salles</a> |';
		echo '<a href="?action=ajout" class="ajout">Ajout d\'une salle</a>';
		
// AFFICHAGE DES ARTICLES

if(isset($_GET['action']) && $_GET['action'] == 'affichage')
{
	echo '<div>';
		echo '<div class="affichage"> Affichage des Salles </div>';
		$resultat = executeRequete("SELECT * FROM salle");
		echo "Nombre de salles disponibles :" . $resultat->num_rows;
		$nb_col = $resultat->field_count; // on récupère le nb de champs contenu dans notre résultat.
		
		echo "<table> <tr>";
		for ($i=0; $i<$nb_col; $i++)
		{
			$colonne = $resultat->fetch_field();
		// debug($colonne);
		echo '<th>'.$colonne->name .'</th>';
		}
		
		echo '<th>Modif</th>';
		echo '<th>Suppr</th>';
		echo '</tr>';

		while($ligne = $resultat->fetch_assoc())
		{
		echo '<tr>';
		foreach($ligne AS $indice => $valeur)
		{
			if($indice == 'photo')
			{
				echo '<td><img src="'.$valeur.'" width="70" height="70" /></td>';
			}			
			else {
				echo '<td>'.$valeur.'</td>';
			}			
		}
		echo '<td><a href="?action=modification&id_salle='.$ligne['id_salle'].'"><i class="fa fa-pencil-square-o"style="color:green; font-size:18px;"></i>
</a></td>';
		echo '<td><a href="?action=suppression&id_salle='.$ligne['id_salle'].'" onClick="return(confirm(\'En êtes vous certain de supprimer cette salle?\'));"><i class="fa fa-trash-o" style="color:red; font-size:18px;"></i>
</a></td>';
		echo '</tr>';
	}
	
	echo '</table>';	
	echo '</div>';
	
}
/*** FORMULAIRE ENREGISTREMENT DES ARTICLES ***/
if(isset($_GET['action']) && ($_GET['action'] == 'ajout' || $_GET['action'] == 'modification'))
{
	
	if(isset($_GET['id_salle']))
	{
		$resultat = executeRequete("SELECT * FROM salle WHERE id_salle='$_GET[id_salle]'"); // dans le cas d'une modif, l'id_article est présent dans l'url. On fait donc une requete pour récupérer les informations de cet article.
		$salle_actuel = $resultat->fetch_assoc(); // on transforme la ligne de résultat en tableau ARRAY 
		// debug($salle_actuel);
	}
?>



<section id = "global">
			<form method = "post" enctype="multipart/form-data" action = "">
			<!-- l'attribut enctype="multipart/form-data" est obligatoire afin de pouvoir récupérer les pièces jointes du formulaire (champs file updload) le fichier sera dans la superglobale $_FILES -->

					<fieldset>
					<legend>Salles</legend>
					<div>
					<input type="hidden" name="id_salle" id="id_salle" value="<?php if(isset($salle_actuel['id_salle'])) { echo $salle_actuel['id_salle'];} ?>" />
				
					<label class = "well" for = "reference">Référence</label>
					<input class = "type_text" type = "text" id = "reference" name = "reference" value = "<?php if(isset($salle_actuel['reference'])) { echo $salle_actuel['reference'];} ?><?php if(isset($_POST['reference'])) { echo $_POST['reference']; } ?>" placeholder="Reference..."/>
					</div>
					
					<div>
					<label class = "well" for = "pays">Pays</label>
					<input class = "type_text" type = "text" id = "pays" name = "pays" value = "<?php if(isset($salle_actuel['pays'])) { echo $salle_actuel['pays'];} ?><?php if(isset($_POST['pays'])) {echo $_POST['pays'];}?>" placeholder="Pays..."/>
					</div>
				
					<div>
					<label class = "well" for = "ville">Ville</label>
					<input class = "type_text" type = "text" id = "ville" name = "ville" value = "<?php if(isset($salle_actuel['ville'])) { echo $salle_actuel['ville'];} ?><?php if(isset($_POST['ville'])) {echo $_POST['ville'];}?>"  placeholder="Ville..."/>
					</div>
					
					<div>
					<label class = "well" id = "adresse_box" for = "adresse">Adresse</label>
					<textarea id = "adresse" name = "adresse" placeholder="Adresse..."><?php if(isset($salle_actuel['adresse'])) { echo $salle_actuel['adresse'];} ?><?php if(isset($_POST['adresse'])) {echo $_POST['adresse'];}?></textarea>
					</div>
				
					<div>
					<label class = "well" for = "cp">Code postal</label>
					<input  class = "type_text" type = "text" id = "cp" name = "cp" value = "<?php if(isset($salle_actuel['cp'])) { echo $salle_actuel['cp'];} ?><?php if(isset($_POST['cp'])) {echo $_POST['cp'];}?>"  placeholder="Code postal..."/>
					</div>
					
					<div>
					<label class = "well" for = "titre">Titre</label>
					<input class = "type_text" type = "text" id = "titre" name = "titre" value = "<?php if(isset($salle_actuel['titre'])) { echo $salle_actuel['titre'];} ?><?php if(isset($_POST['titre'])) { echo $_POST['titre']; } ?>"  placeholder="Titre..."/>
					</div>
					
					<div>
					<label class = "well" id = "adresse_box" for = "description">Description</label>
					<textarea id = "description" name = "description"  placeholder="Description..."> <?php if(isset($salle_actuel['description'])) { echo $salle_actuel['description'];} ?><?php if(isset($_POST['description'])) { echo $_POST['description']; } ?></textarea>
					</div>
					
					<div>
					<label class = "well" for = "photo">Photo</label>
					<input class = "type_text" type = "file" id = "photo" name = "photo" value = "<?php if(isset($_POST['photo'])) {echo $_POST['photo'];}?>"  placeholder = "Photo" />
					</div>
					<?php
						if(isset($salle_actuel)) // si article actuel existe alors nous sommes dans une modification et nous affichons la photo actuelle par défaut.
						{
							echo '<label>Photo Actuelle</label><br />';
							echo '<img src="'.$salle_actuel['photo'].'" width="140" /><br/>';
							echo '<input type="hidden" name="photo_actuelle" value="'.$salle_actuel['photo'].'" />';		
						}
					?>
					<div>
					<label class = "well" for = "capacite">Capacité</label>
					<input class = "type_text" type = "text" id = "capacite" name = "capacite" value = "<?php if(isset($salle_actuel['capacite'])) { echo $salle_actuel['capacite'];} ?><?php if(isset($_POST['capacite'])) {echo $_POST['capacite'];}?>"  placeholder="Capacite..."/>
					</div>
					
					<div>
					<label class = "well" for = "categorie">Catégorie</label>
					<input class = "type_text" type = "text" id = "categorie" name = "categorie" value = "<?php if(isset($salle_actuel['categorie'])) { echo $salle_actuel['categorie'];} ?><?php if(isset($_POST['categorie'])) { echo $_POST['categorie']; } ?>"  placeholder="Categorie..."/>
					</div>
					
					<div>
					<input class= "type_reset" type ="reset" id = "reset" name = "reset" value = "Reset"/>
					<input  class= "type_submit" type = "submit" id = "enregistrement" name = "enregistrement" value = "<?php echo ucfirst($_GET['action']); // ucfirst() met la première lettre en majuscule ?>"/>
					</div>
				</fieldset>
				
			</form>
</section>

<?php
}
?>

		</div>
	</div>
</section>

<?php
require_once ("../inc/footer.inc.php");

