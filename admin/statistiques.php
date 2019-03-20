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
<div class="fix home_main_content">
	<div class="affichage">Statistiques</div>

		<section id = "global">

			<h5><a href="statistiques.php?bestavis=5">Top 5 des salles les mieux notés</a></h5>
			<h5><a href="">Top 5 des salles les vendues</a></h5>
			<h5><a href="">Top des membres qui achéte le plus (en termes de quantité)</a></h5>
			<h5><a href="statistiques.php?pluscher=desc">Top 5 membres qui achète le plus cher (en termes de prix)</a></h5>

			<?php
			if(isset($_GET['bestavis']))
			{
				$bestavis = $_GET['bestavis'];
				$get_avis = executeRequete("SELECT * FROM avis WHERE  note>$bestavis");
				echo '<table style="margin-top:30px;"><tr>
				 		<th>ID_SALLE</th>
				 		<th>COMMENTAIRE</th>
				 		<th>NOTE</th></tr>';
				while($result_avis = $get_avis->fetch_assoc())
				{	echo '<tr>';
					echo '<td>'.$result_avis['id_salle']. '</td>';
					echo '<td>'.$result_avis['commentaire']. '</td>';
					echo '<td>'.$result_avis['note']. '</td>';
				}
					echo '</tr></table>';
				//var_dump($get_avis);
			}

			?>
			<?php
			if(isset($_GET['pluscher'])){
				$pluscher = $_GET['pluscher'];
				//$membrePluscher = executeRequete("SELECT c.montant, m.nom, m.prenom FROM commande c INNER JOIN membre m on m.id_membre=c.id_membre ORDER BY c.montant=$pluscher");
				$membrePluscher = executeRequete("SELECT commande.montant, membre.nom, membre.prenom FROM commande INNER JOIN membre on membre.id_membre = commande.id_membre ORDER BY commande.montant $pluscher LIMIT 5");

					echo '<table style="margin-top:30px;"> 
							<tr>
							<th>Name</th>
							<th>Prenom</th>
							<th>Montant</th></tr>';
					while($result_Pluscher = $membrePluscher->fetch_assoc())
					{	echo '<tr>';
						echo '<td>'.$result_Pluscher['nom']. '</td>';
						echo '<td>'.$result_Pluscher['prenom']. '</td>';
						echo '<td>'.$result_Pluscher['montant']. '</td>';
					}
					echo '</tr> </table>';
			}

			?>

		</section>	
		</div>
	</div>
</section>
<?php
require_once ("../inc/footer.inc.php");

?>