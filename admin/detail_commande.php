<?php
require_once("../inc/init.inc.php");

if (!utilisateurEstConnecteEtEstAdmin()) {
	header("location:../connexion.php");
	exit();
} else {
	require_once ("../inc/header.inc.php");
	require_once ("../inc/menu.inc.php");
}

echo '<div class="affichage">Detail de Commande</div>';

if(isset($_GET['orderPrix']))
{
	$orderPrix = $_GET['orderPrix'];
	$resultat = executeRequete("SELECT * FROM commande ORDER BY commande.montant $orderPrix");
}elseif(isset($_GET['commande']))
{
	$command_id = $_GET['commande'];

	$resultat = executeRequete("SELECT dc.id_details_commande, dc.id_commande, dc.id_produit, c.montant, c.date, c.id_membre, m.pseudo, p.id_salle, s.ville FROM details_commande dc INNER JOIN commande c ON c.id_commande = dc.id_commande INNER JOIN membre m ON m.id_membre = c.id_membre INNER JOIN produit p ON p.id_produit = dc.id_produit INNER JOIN salle s ON s.id_salle = p.id_salle	WHERE dc.id_commande = '$command_id'");

	echo "Commande : " . $command_id;
	echo "<div>";
	echo "<table> <tr>";
	echo "<th>id_commande</th>";
	echo "<th>id_produit</th>";
	echo '<th>montant <a href="detail_commande.php?orderPrix=asc"><i style="font-size:18px"; class="fa fa-sort-asc"></i></a><a href="detail_commande.php?orderPrix=desc"><i style="font-size:18px;" class="fa fa-sort-desc"></i></a></th>';
	echo '<th>date<a href="detail_commande.php?orderDate=asc"><i style="font-size:18px"; class="fa fa-sort-asc"></i></a><a href="detail_commande.php?orderDate=desc"><i style="font-size:18px;" class="fa fa-sort-desc"></i></a></th>';
	echo "<th>membre</th>";
	echo "<th>pseudo</th>";
	echo "<th>id_salle</th>";
	echo "<th>ville</th>";
	echo "</tr>";

	while ($ligne = $resultat->fetch_assoc())
  	{  
	//crée-moi autant de lignes <tr> qu'il y a de résultats dans la BDD (utilisation de fecth_assoc() qui nous ressort les informations d'array(). Donc récupération par l'intermédiaire d'une boucle foreach()
		echo '<tr>';
		echo '<td>'.$ligne['id_commande'].'</td>';
		echo '<td>'.$ligne['id_produit'].'</td>';
		echo '<td>'.$ligne['montant'].'</td>';
		echo '<td>'.$ligne['date'].'</td>';
		echo '<td>'.$ligne['id_membre'].'</td>';
		echo '<td>'.$ligne['pseudo'].'</td>';
		echo '<td>'.$ligne['id_salle'].'</td>';
		echo '<td>'.$ligne['ville'].'</td>';
		//foreach ($ligne as $indice => $information)
    //on récupère les indices et à les informations. Exemple : $article['id_salle'] = 1
		
		echo '</tr>';
	}
	echo '</table>';
	echo "</div>";

	echo '</table>';
	echo "</div>";

} else {
	echo 'Il faut un commande id.';
}
	
require_once ("../inc/footer.inc.php");

