<?php
require_once("inc/init.inc.php");

require_once ("inc/header.inc.php");
require_once ("inc/menu.inc.php");


?>

<section id = "global">
			
<div class="rest_recherche">
<?php
	if($_POST)
	{
		$searche = $_POST['searche'];

		if($_POST['submit'])
		{
	   	 	$donnees = executeRequete("SELECT `salle`.`id_salle`,pays,ville,adresse,cp,titre,description,photo,capacite,categorie,`produit`.`prix`, date_depart, date_arrivee, id_promo, etat FROM salle left join produit on `salle`.`id_salle`=`produit`.`id_salle` WHERE salle.ville = '$searche'");
	   	 	 	 	
		   	if($donnees)
	   	 	{
		   	 	while($article = $donnees->fetch_assoc())
		   	 	{
		   	 		echo '<div class="produits">';
			    	echo '<div class="text_produits">';
			    		echo "<img src='$article[photo]' width='248' height='160'>";
			   		   	echo "<h3>$article[titre]</h3>";
				   		echo '<p><strong>Ville :</strong>'.$article['ville'].'</p>';
					    echo '<p><strong>Capacite :</strong>' .$article['capacite']. 'personnes </p>';
					    echo '<p><strong>Arrivée:</strong>' .$article['date_arrivee']. '</p>';
					    echo '<p><strong>Depart :</strong>'.$article['date_depart']. '</p>';
					    echo '<p><strong>Prix :</strong>'.$article['prix']. '€ ';
					      if ($article['id_promo'] == 1)
			              {
			                echo "<strong>Promo</strong> 25% <br>";
			              }
			              elseif ($article['id_promo'] == 2)
			              {
			                echo "<strong>Promo</strong> 50% <br>";

			              }
			              if ($article['etat'] == 0)
			              {
			                echo "<strong>Salle</strong><span style='color:red;'> Indisponible</span>";
			              }
			              elseif ($article['etat'] == 1)
			              {
			                echo "<strong>Salle</strong> <span style='color:green;'>Disponible</span>";

			              }
						echo '</div>';
							
				    echo '<div class="dt_produits"><a href="fiche_salle.php?id_salle='.$article['id_salle'].'">Details de produits</a></div>';
				    /*if (utilisateurEstConnecte())
				    	{
				    		//echo '<a href="">Ajouter au panier</a>';
				    		echo '<form method="POST" action="panier.php">';
						    echo '<input type="hidden" name="id_salle" value="'.$article['id_salle'].'" />';
				            echo '<input type="submit" name="ajout_panier" value="Ajout au panier">';
				            echo '</form>';
						}else
						{
							echo '<a href="connexion.php">Connecter vous pour ajouter au panier</a>';
						}*/
					
				    echo '</div>';  
		   		}
	   	 	}
		   	
	   	}

	}
	//var_dump($_POST);
	if ($searche == 0)
	{
		echo 'Aucune resultat trouver dans cette ville!';
	}
?>

	</div>
</section>


<?php
require_once ("inc/footer.inc.php");

?>



