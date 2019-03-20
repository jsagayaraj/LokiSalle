<?php
require_once("../inc/init.inc.php");

if(!utilisateurEstConnecteEtEstAdmin())
{
	header("location:../connexion.php");
	//exit();
}
else{
	require_once ("../inc/header.inc.php");
	require_once ("../inc/menu.inc.php");
}
?>
<div class="fix home_main_content">
<?php
echo '<section id = "global">';

	if(isset($_GET['orderNote']))
	{
		$orderNote = $_GET['orderNote'];
		$resultat = executeRequete("SELECT * FROM avis ORDER BY avis.note $orderNote");
	}elseif (isset($_GET['orderDate'])) {
		$orderDate = $_GET['orderDate'];
		$resultat = executeRequete("SELECT * FROM avis ORDER BY avis.date $orderDate");
	}else
	{
		$resultat = executeRequete("SELECT * FROM avis");
	}
	echo '<div>';
	//$resultat = executeRequete("SELECT * FROM avis");
	echo "Nombre de avis: " . $resultat->num_rows;

	/*$nbcol = $resultat->field_count;
	echo "<table> <tr>";
	for ($i=0; $i < $nbcol; $i++)
	{    
		$colonne = $resultat->fetch_field(); 
		//echo '<th>' . $colonne->name . '</th>';
		echo '<th>'.$colonne->name.'</th>';
	}*/
	echo "<table style ='margin-top:15px;'> <tr>";
	echo "<th>id_avis</th>";
	echo "<th>id_membre</th>";
	echo "<th>id_salle</th>";
	echo "<th>commentaire</th>";
	echo '<th>note&nbsp <a href ="gestion_avis.php?orderNote=ASC"><i style="font-size:18px"; class="fa fa-sort-asc"></i></a><a href ="gestion_avis.php?orderNote=DESC"><i style="font-size:18px;" class="fa fa-sort-desc"></i></a></th>';
	//echo '<th>note&nbsp <a href ="?action=asc&id_avis"><i style="font-size:18px"; class="fa fa-sort-asc"></i></a></th>';
	echo '<th>date&nbsp <a href ="gestion_avis.php?orderDate=ASC"><i style="font-size:18px"; class="fa fa-sort-asc"></i></a><a href ="gestion_avis.php?orderDate=DESC"><i style="font-size:18px;" class="fa fa-sort-desc"></i></a></th>';
	echo "<th>Suppression</th>";
	echo "</tr>";




	while ($ligne = $resultat->fetch_assoc())
  	{  
		echo '<tr>';
		foreach ($ligne as $indice => $information)
		{
			
				echo "<td>" . $information . "</td>";
				
		}
		echo '<td><a href="?action=suppression&id_avis=' . $ligne['id_avis'] .'" OnClick="return(confirm(\'Confirmez-vous la suppression ?\'));"><i class="fa fa-trash-o" style="color:red; font-size:18px;"></i></a></td>';
	}

	if(isset($_GET['action']) && $_GET['action'] == "suppression")
	{
		executeRequete("DELETE FROM avis WHERE id_avis = $_GET[id_avis]");
		//header("location:gestion_avis.php?action=affichage");
	}
	
	echo '</td></table>';

/*	while ($ligne = $resultat->fetch_assoc())
  	{  
		echo '<tr>';
		foreach ($ligne as $indice => $information)
		{
			
				echo "<td>" . $information . "</td>";
				
		}
		echo '<td><a href="?action=suppression&id_avis=' . $ligne['id_avis'] .'" OnClick="return(confirm(\'Confirmez-vous la suppression ?\'));"><i class="fa fa-trash-o" style="color:red; font-size:18px;"></i></a></td>';
	}

	if(isset($_GET['action']) && $_GET['action'] == "suppression")
	{
	executeRequete("DELETE FROM avis WHERE id_avis = $_GET[id_avis]");
	//header("location:gestion_avis.php?action=affichage");
	}*/
	













			
		/*if($ligne['statut'] == '1' && $ligne['id_membre'] == $_SESSION['utilisateur']['id_membre'])
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
	//echo '* Vous ne pouvez pas supprimer la session sur laquelle vous êtes connectés.';
	echo "</div>";


if(isset($_GET['action']) && $_GET['action'] == "suppression")
{
	executeRequete("DELETE FROM membre WHERE id_membre = $_GET[id_membre]");
	header("location:gestion_membre.php?action=affichage");
}
*/
?>

		</section>
		</div>
	</div>
</section>

<?php
require_once ("../inc/footer.inc.php");

?>