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

echo '<div class="affichage">Liste des Commandes</div>';


/*if(isset($_GET['action']) && $_GET['action'] == "Suppression")
{
	echo "<div class='validation'>Suppression de la commande : $_GET[id_commande] </div>";
	executeRequete("DELETE FROM commande where id_commande=$_GET[id_commande]");
	$_GET['action'] = 'affichage';	
}*/

if(isset($_GET['orderMontant'])){
	$orderMontant = $_GET['orderMontant'];
	$resultat = executeRequete("SELECT * FROM commande ORDER BY commande.montant $orderMontant");
}else
{
	$resultat = executeRequete("SELECT * FROM commande");
}

	echo "Liste des commandes : " . $resultat->num_rows;
	echo "<div>";
	echo "<table style ='margin-top:15px;'> <tr>";
	echo "<th>id_commande</th>";
	echo '<th>id_membre</th>';
	echo '<th>montant <a href="gestion_commande.php?orderMontant=asc"><i style="font-size:18px"; class="fa fa-sort-asc"></i></a><a href="gestion_commande.php?orderMontant=desc"><i style="font-size:18px;" class="fa fa-sort-desc"></i></a></th>';
/*	$nbcol = $resultat->field_count;
	for ($i=0; $i < $nbcol; $i++)
	{    
		$colonne = $resultat->fetch_field(); 
		echo '<th>' . $colonne->name . '</th>';
	}*/
	
	echo "</tr>";

	$total = 0;
	while ($ligne = $resultat->fetch_assoc())
  	{  
	//crée-moi autant de lignes <tr> qu'il y a de résultats dans la BDD (utilisation de fecth_assoc() qui nous ressort les informations d'array(). Donc récupération par l'intermédiaire d'une boucle foreach()
		echo '<tr>';
			echo '<td><a href="detail_commande.php?commande='.$ligne['id_commande'].'">'.$ligne['id_commande'].'</a></td>';
			echo '<td>'.$ligne['id_membre'].'</td>';
			echo '<td>'.$ligne['montant'].'</td>';
		echo '</tr>';
		
		$total = $total+$ligne['montant']; // chiffre de affaires
	}
	 //var_dump ($total);
		


					
	echo '</table>';
	echo "</div>";
	echo '<h3>Le Chiffre d\'affaires :'.$total.' €</h3>';

require_once ("../inc/footer.inc.php");
