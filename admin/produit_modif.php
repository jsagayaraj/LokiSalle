<?php
require_once("../inc/init.inc.php");


if(isset($_GET['action']) && ($_GET['action'] == 'ajouter' || $_GET['action'] == 'modifier'))
{
	if($_GET['action'] == 'modifier')
	{
		$resultat = executeRequete("SELECT * FROM produit WHERE id_produit='$_GET[id_produit]'");
		$infos_id_produit = $resultat->fetch_assoc();
	}



	$date = date('Y/m/d');
	if(isset($_POST['valider'])) {
		if(($_POST['date_in'] < $date && $_GET['action'] == 'modifier') || ($_POST['date_in'] > $_POST['date_out'])) {
			echo "<div class='error'>Erreur de saisie : date d'arrivée antérieure à la date du jour ou postérieure à la date de départ.</div>";
			exit();
		}

		if ($_GET['action'] == 'modifier' && isset($_GET['id_produit'])) {
			$save_produit = executeRequete("UPDATE produit SET date_arrivee = '$_POST[date_in]', date_depart = '$_POST[date_out]', id_salle  = '$_POST[room]', prix = '$_POST[price]', etat = '$_POST[statut]', id_promo = '$_POST[promotion]' WHERE id_produit = '$_GET[id_produit]'");
			echo "<div class='primiere'>Votre produit a bien été enregistré.</div>";
		} else {
			$save_salle = executeRequete("INSERT INTO produit (date_arrivee, date_depart, id_salle, id_promo, prix,etat) VALUES ('$_POST[date_in]', '$_POST[date_out]', '$_POST[room]', '$_POST[promotion]', '$_POST[price]', '$_POST[statut]')");
		}

		echo "<div class='primiere'>Votre produit a bien été enregistré.</div>";
		header('location:gestion_produits.php?action=modifier');
	}

}
