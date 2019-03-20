<?php
require_once("../inc/init.inc.php");

if(!utilisateurEstConnecteEtEstAdmin())
{
	header("location:../connexion.php");
	
}
else{
	require_once ("../inc/header.inc.php");
	require_once ("../inc/menu.inc.php");
}

	echo '<a class="ajout" href="?action=ajouter">Ajouter un produit</a> | ';
	echo '<a class="affiche" href="?action=affichage">Produits disponibles</a>';

echo '<h1>';
if(isset($_GET['action']) && $_GET['action'] == 'ajouter')
{
	echo '<div class="affichage">Ajouter un produit</div>';
}
if(isset($_GET['action']) && $_GET['action'] == 'affichage')
{
		echo '<div class="affichage">Produits disponibles</div>';
}
echo '</h1>';


// ********************************************MODIFICATION***********************************************
if(isset($_GET['action']) && ($_GET['action'] == 'ajouter' || $_GET['action'] == 'modifier'))
{
	if($_GET['action'] == 'modifier')
	{
		$resultat = executeRequete("SELECT * FROM produit WHERE id_produit='$_GET[id_produit]'");
		$infos_id_produit = $resultat->fetch_assoc();
		//var_dump($infos_id_produit);
		//die();
	}
?>

<section id = "global">
			
	<form name="add_product" method="post" action="">

			<fieldset>
						
				
				<label  for="date_in">Date d'arrivée</label>
				
				<input name="date_in" type="text" placeholder="aaaa/mm/jj" value="<?php if(isset($infos_id_produit['date_arrivee'])) echo $infos_id_produit['date_arrivee'];?>" required><br>
				
				<label  for="date_out">Date de départ</label>
				
				<input name="date_out" type="text" placeholder="aaaa/mm/jj" value="<?php if(isset($infos_id_produit['date_depart'])) echo $infos_id_produit['date_depart'];?>" required><br>
				
				<label  for="room">Choisir une salle parmi les salles existantes:</label>
				
					<select name="room" size=1>
					<?php
					if(isset($infos_id_produit['id_salle']))
					{
						$id_salle = $infos_id_produit['id_salle'];

						$salle = executeRequete("SELECT * FROM salle WHERE id_salle = $id_salle");
						while($menu_salle = $salle->fetch_assoc())
						{
							echo '<option value="'.$menu_salle['id_salle'].'">'. $menu_salle['ville'] .' - '.$menu_salle['adresse'].' - '. $menu_salle['titre'] .' - '.$menu_salle['capacite'].' - '.$menu_salle['categorie'].'</option>';
						}
					}

					$salle_all = executeRequete("SELECT * FROM salle ORDER BY ville");
					while($menu_salle_all = $salle_all->fetch_assoc())
					{
						echo '<option value="'.$menu_salle_all['id_salle'].'">'. $menu_salle_all['ville'] .' - '.$menu_salle_all['adresse'].' - '. $menu_salle_all['titre'] .' - '.$menu_salle_all['capacite'].' - '.$menu_salle_all['categorie'].'</option>';
					}
				
					?>
					</select><br>
				
				<label for="promotion">Promotion</label>
				
					<select name="promotion" size=1>
					<?php
					if(isset($infos_id_produit['id_promo']))
					{
						$promo = executeRequete("SELECT * FROM promotion ORDER BY code_promo");
						while($menu_promo = $promo->fetch_assoc())
						{
							echo '<option value="'.$menu_promo['id_promo'].'">'. $menu_promo['code_promo'] .' - '. $menu_promo['reduction'] .'%</option>';
						}
					}
					else
					{
						$promo = executeRequete("SELECT * FROM promotion ORDER BY code_promo");
						while($menu_promo = $promo->fetch_assoc())
						{
							echo '<option value="'.$menu_promo['id_promo'].'">'. $menu_promo['code_promo'] .' - '. $menu_promo['reduction'] .'%</option>';
						}
					}
					?>
					</select><br>
				
				<label  for="price">Prix</label>
				
				
				<input  name="price" type="text"  value="<?php if(isset($infos_id_produit['prix'])) echo $infos_id_produit['prix']; ?>" required><br>
			
			
				<label  for="statut">Etat</label>
				
			
				<input name="statut" type="radio"  value="0" <?php if(isset($infos_id_produit['etat']) && $infos_id_produit['etat'] == '0') echo 'checked'; ?>>Indisponible
				<input name="statut" type="radio"  value="1" <?php if(isset($infos_id_produit['etat']) && $infos_id_produit['etat'] == '1') echo 'checked'; ?>>Disponible<br>
				
				
				<input name="valider" type="submit" value="<?php echo ucfirst($_GET['action']);?>">
				
			</fieldset>
				
	</form>
</section>
<?php //------------------------------------------------------
	$date = date('Y/m/d');
	if(isset($_POST['valider'])) 
	{	
		if($_POST['date_in'] < $date || $_POST['date_in'] > $_POST['date_out']) 
		{
			echo "<div class='error'>Erreur de saisie : date d'arrivée antérieure à la date du jour ou postérieure à la date de départ.</div>";
		}else 
		{
			// vERIFIER SI SALLE EXIST DEJA
			$date_date_in = new DateTime($_POST['date_in']);
			$date_in = $date_date_in->format('Y-m-d H:i:s');

			$date_date_out = new DateTime($_POST['date_out']);
			$date_out = $date_date_out->format('Y-m-d H:i:s');

			$resultat = executeRequete("SELECT id_salle, date_arrivee, date_depart FROM produit WHERE date_arrivee = '$date_in' AND date_depart = '$date_out' AND id_salle = '$_POST[room]'");
		
			if($resultat->num_rows > 0 && isset($_GET['action']) && $_GET['action'] == 'ajouter')
			{
				$msg .="<div class='error'>Produit avec ces date est dèjà exist</div>";
			} 
			else 
			{
				if ($_GET['action'] == 'modifier' && isset($_GET['id_produit'])) 
				{
					$save_produit = executeRequete("UPDATE produit SET date_arrivee = '$_POST[date_in]', date_depart = '$_POST[date_out]', id_salle  = '$_POST[room]', prix = '$_POST[price]', etat = '$_POST[statut]', id_promo = '$_POST[promotion]' WHERE id_produit = '$_GET[id_produit]'");
					echo "<div class='primiere'>Votre produit a bien été modifié.</div>";
					exit();
				} else 
				{
					$save_salle = executeRequete("INSERT INTO produit (date_arrivee, date_depart, id_salle, id_promo, prix,etat) VALUES ('$_POST[date_in]', '$_POST[date_out]', '$_POST[room]', '$_POST[promotion]', '$_POST[price]', '$_POST[statut]')");
				}

				echo "<div class='primiere'>Votre produit a bien été enregistré.</div>";
			}
		}
	}
}	
echo $msg;
//SUPPRESSION DE PRODUITS

if(isset($_GET['action']) && $_GET['action'] == 'suppression')
{
	executeRequete("DELETE FROM produit WHERE id_produit = $_GET[id_produit]");
	$_GET['action'] = 'affichage';
}


// Affichage de Produits

if(isset($_GET['action']) && $_GET['action'] == 'affichage')
{
	$tab_produits = executeRequete("SELECT * FROM produit");
	$nb_rows = $tab_produits->num_rows;
	$nb_cols = $tab_produits->field_count;
	echo 'Nous avons actuellement '. $nb_rows .' produit(s) disponible(s).';
	echo "<table><tr>";
	for ($i=0; $i<$nb_cols; $i++)
	{
		$colonne = $tab_produits->fetch_field();
		echo "<th>". $colonne->name . '</th>';
	}
		echo '<th>Modification</th>';
		echo '<th>Suppression</th>';
		echo '</tr>';
	while($lignes = $tab_produits->fetch_assoc())
	{
		echo '<tr>';
			foreach($lignes as $indices => $informations)
			{
				echo '<td>'. $informations .'</td>';
			}
		echo '<td><a href="?action=modifier&id_produit=' . $lignes['id_produit'] .'"><i class="fa fa-pencil-square-o" style="color:green; font-size:18px;"></i></a></td>';
		echo '<td><a href="?action=suppression&id_produit=' . $lignes['id_produit'] .'" OnClick="return(confirm(\'Confirmez-vous la suppression ?\'));"><i class="fa fa-trash-o" style="color:red; font-size:18px;"></i></a></td>';
	}
	echo '</tr>';
	echo '</table>';
}
?>

<?php
require_once ("../inc/footer.inc.php");

