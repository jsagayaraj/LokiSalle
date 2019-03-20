<?php
require_once("inc/init.inc.php");

require_once ("inc/header.inc.php");
require_once ("inc/menu.inc.php");


?>

<section id = "global">
			<form method = "post" action = "">
			
				<fieldset>
					<legend>Recherche</legend>
						
						<div id = "recherche-mainbox"	>
							<h4>Recherche d'une location de salle pour résevation.</h4>
							<ul>
								<li class ="head_researche">A la date du</li>
								<li  class ="head_researche">Par mots clés</li>
							</ul>
							
							<div id = "mois">
								<label class = "mois"for = "mois"> Mois</label>
									<select  name = "mois">
										<option value="01">Janvier</option>
										<option value="02">Fevrier</option>
										<option value="03">Mars</option>
										<option value="04">Avril</option>
										<option value="05">Mai</option>
										<option value="06">Juin</option>
										<option value="07">Jueillet</option>
										<option value="08">Aout</option>
										<option value="09">Septembre</option>
										<option value="10">Octobre</option>
										<option value="11">Novembre</option>
										<option value="12">Decembre</option>
									</select>
							</div>
							<div id = "annee">
								<label class = "annee" for = annee>Année</label>
									<select  name = "annee">
										<option>2015</option>
										<option>2016</option>
										<option>2017</option>
									</select>
							</div>
							
							<div class = "rech_motcle">
								<input class="text_type_searche" type = "searche" id="searche" name="searche"  placeholder="Ex:Paris" />
							</div>
								<input  class= "type_submit_reserche" type = "submit" id = "recherche" name = "recherche" value = "Recherche"/>
						</div>
				</fieldset>
			</form>
</section>

<div class="rest_recherche">
<?php
	if($_POST)
	{
		$mois = $_POST['mois'];
		$annee = $_POST['annee'];
		$searche = $_POST['searche'];
		
		$tempDateStart = $mois . "-01-" . $annee;
		$dateStart = DateTime::createFromFormat('m-d-Y', $tempDateStart )->format('Y-m-d');

		$tempDateEnd = $mois . "-30-" . $annee;
		$dateEnd = DateTime::createFromFormat('m-d-Y', $tempDateEnd )->format('Y-m-d');

		if($_POST)
		{
	   	 	$donnees = executeRequete("SELECT `salle`.`id_salle`,pays,ville,adresse,cp,titre,description,photo,capacite,categorie,`produit`.`prix`, date_depart, date_arrivee, id_promo, etat FROM salle left join produit on `salle`.`id_salle`=`produit`.`id_salle` WHERE salle.ville = '$searche' AND produit.date_arrivee >= '$dateStart' AND produit.date_arrivee <= '$dateEnd'");
	   	 	 	 	
		   	if($donnees)
	   	 	{
		   	 	while($article = $donnees->fetch_assoc())
		   	 	{
		   	 		echo '<div class="produits">';
			    		echo '<div class="text_produits">';
				    	echo "<img src='$article[photo]' width='248' height='160'>";
				   		//echo '</div>'; 
					    //echo '<div id="dernieroffres_text">';
				    	echo "<h3>$article[titre]</h3>";
				   		echo '<p><strong>Ville :</strong>'.$article['ville'].'</p>';
					    echo '<p><strong>Capacite :</strong>' .$article['capacite']. 'personnes </p>';
					    echo '<p><strong>Arrivée:</strong>' .$article['date_arrivee']. '</p>';
					    echo '<p><strong>Depart :</strong>'.$article['date_depart']. '</p>';
					    echo '<p><strong>Prix :</strong>'.$article['prix'].'€ ';
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
	   	}else
		{
			echo '<h2>Aucun résultat trouvé !</h2>';
		}
	}

?>

</div>

<?php
require_once ("inc/footer.inc.php");

?>



