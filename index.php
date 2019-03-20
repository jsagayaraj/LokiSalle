<?php
require_once("inc/init.inc.php");
require_once("inc/header.inc.php");
require_once("inc/menu.inc.php");

//echo $msg;
?> 
	
					
	<div class="fix home_main_content">
			<div class="main_content floatleft">
			<!--<div class="fix main_content_container">-->
				<div id = "text_accueil_bloc">
				<h1>LokiSalle</h1>
				<p>"Créé en 2015, LokiSalle vous propose un large choix de salles de réunion de différentes dimensions pouvant accueillir de 
					10 à 100 personnes sur Paris, Bordeaux, Marseille et Lyon. Nous disponsons de petites salles pour travailler avec vos collaborateurs
					et vos fournisseurs ou pour recevoir vos clients, mais aussi de très grandes salle pour les grandes occasions. 
					Toutes les salles proposées disposent de toutes les commodités pour la réussite de vos meetings. 
					LokiSalle mets tout en œuvre pour vous simplifier la vie et concourir à la réussite de vos réunions."</p>
				</div>
			</div>
									
			<div id = "rightsidebar">

				<div id="searchbox">
					<form  method="post" action="researchIndex.php">
					    <input id="search" type="search" name="searche" placeholder="search">
					    <input id="submit" name="submit" type="submit" value="Search">
					</form>
				</div>
					<div class="dernier_offer">Nos 3 derniéres offres</div>
					<?php

						$donnees=executeRequete("SELECT `salle`.`id_salle`,pays,ville,adresse,cp,titre,description,photo,capacite,categorie,`produit`.`prix`, date_depart, date_arrivee, id_promo, etat FROM salle left join produit on `salle`.`id_salle`=`produit`.`id_salle` WHERE produit.etat = '1' ORDER BY produit.id_promo desc LIMIT 0,3");

							while($article = $donnees->fetch_assoc()) //je récupère les informations
							{
							    echo '<div id="firstbox">';
							    	echo "<img class='image' src='$article[photo]' alt='#'>";
							   		
								    echo '<div id="dernieroffres_text">';
								    	echo "<h3>$article[titre]</h3>";
								   		echo "<strong>Ville:</strong> $article[ville]<br>";
								    	echo "<strong>Capacite :</strong> $article[capacite] personnes <br>";
							  			echo "<strong>Du</strong> $article[date_arrivee] <strong>Au</strong> $article[date_depart]<br>";
							  			echo "<strong>Prix</strong> $article[prix] € &nbsp";
							  			if ($article['id_promo'] == 1)
							  			{
							  				echo "<strong>Promo</strong> 25%";
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
							   


							     echo '<div class="text_link">';
							    	echo '<div class="bt_dt_produit"><a href="fiche_salle.php?id_salle='.$article['id_salle'].'"> >&nbspDetails de produits</a>';
							    	echo '</div>';

							    	
							    	if (utilisateurEstConnecte())
							    	{
							    		//echo '<a href="">Ajouter au panier</a>';
							    		  	echo '<form method="POST" action="panier.php">';
								            echo '<input type="hidden" name="id_salle" value="'.$article['id_salle'].'" />';
								            echo '<input type="submit" class="pannier_index" name="ajout_panier" value="Ajout au panier">';
								            echo '</form>';
									}else
									{
										echo '<a href="connexion.php"style ="float:right;">>&nbspConnecter vous pour ajouter au panier</a>';
									}
									
								echo '</div>';
							}

						?>
					</div>
				
			</div>
	</div>
	</div>
	</div>
</section>
		
<?php
require_once("inc/footer.inc.php");
?>