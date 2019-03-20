<section id="header_area">
				<div class="header_top_area">
					<div class="header_top center">
						<div class="header_left">
							<nav>
								<ul id="nav">
								<?php
									echo'<li><a href="'.RACINE_SITE.'mentions_legales.php">Mentions légales</a>';
									echo'<li><a href="'.RACINE_SITE.'connexion.php">Connexion</a></li>';
									echo'<li><a href="'.RACINE_SITE.'contact.php ">Contact</a></li>';
								?>
								</ul>
							</nav>
						</div>
					</div>
				</div>
				
				<div class="fix header_bottom_area">
					<div class="header_bottom center">
						<div class="fix logo floatleft">
							<div class="logo"><a href="index.php"><img src="images/logolokisalle.png" alt="logo lokisalle"></a></div>
						</div>
						<div class="header_add">	
						 	<div class="bienvenue">
								<?php 
									if (utilisateurEstConnecte()){
										echo '<div class="text_header">Bonjour <br>'.$_SESSION['utilisateur']['sexe'].'. '.$_SESSION['utilisateur']['nom'].' ' .$_SESSION['utilisateur']['prenom'].'</div>';
									}else
									{
										echo '<div class="text_header">Bienvenue Notre Site</div>';
									}
							
								?>
							</div> 

						 	<div class="boxPannier">
						 	<?php
								if(empty($_SESSION['panier']['id_produit']))
								  {
								     echo '<div class="shopping_cart"> 0.00 €</div>';
								  }else{
								  	echo '<div class="shopping_cart">Total : '.montantTotal().' €</div>';
								  }

							?> 
							</div>  
						</div>
					</div>
				</div>

</section>
		<section id="header_bottom_area"></section>
		<section id="content_area">
			<div class="content center">
				<div class="main_menu">
					<nav>
						<ul id="nav2">
							<?php
							if(utilisateurEstConnecte()){
							echo '<li><a href="'.RACINE_SITE.'index.php">Accueil </a></li>';
							echo '<li><a href="'.RACINE_SITE.'reservation.php">Réservation</a></li>';
							echo '<li><a href="'.RACINE_SITE.'recherche.php">Recherche</a></li>';
							echo '<li><a href="'.RACINE_SITE.'profil.php">Profil</a></li>';
							echo '<li><a href="'.RACINE_SITE.'panier.php">Panier</a></li>';
							echo '<li><a href="?action=deconnexion">Deconnecter</a></li>';
							}
							else{
							echo '<li><a href="'.RACINE_SITE.'index.php">Accueil </a></li>';
							echo '<li><a href="'.RACINE_SITE.'reservation.php">Réservation</a></li>';
							echo '<li><a href="'.RACINE_SITE.'recherche.php">Recherche</a></li>';
							echo '<li><a href="'.RACINE_SITE.'connexion.php">Se connecter</a></li>';
							echo '<li><a href="'.RACINE_SITE.'inscription.php">Créer un nouveau compte</a></li>';
							}
							?>
						</ul>
					</nav>
				</div>
					<div class="menu_admin">
						<ul>
							<?php
							if (utilisateurEstConnecteEtEstAdmin()){	
							echo '<li><a href="'.RACINE_SITE.'admin/gestion_salles.php">Gestion des Salles</a></li>';
							echo '<li><a href="'.RACINE_SITE.'admin/gestion_membre.php">Gestion des Membre</a></li>';
							echo '<li><a href="'.RACINE_SITE.'admin/gestion_produits.php">Gestion des Produits</a></li>';
							echo '<li><a href="'.RACINE_SITE.'admin/gestion_commande.php">Gestion des Commandes</a></li>';
							echo '<li><a href="'.RACINE_SITE.'admin/gestion_avis.php">Gestion des Avis</a></li>';
							echo '<li><a href="'.RACINE_SITE.'admin/gestion_promos.php">Gestion codes Promo</a></li>';
							echo '<li><a href="'.RACINE_SITE.'admin/statistiques.php">Statistiques</a></li>';
							echo '<li><a href="'.RACINE_SITE.'admin/newsletter.php">Envoyer la newsletter</a></li>'; 
							}

							if(utilisateurEstConnecte() && isset($_GET['action']) && $_GET['action'] == 'deconnexion')
								{
								session_destroy();
								header("location:". RACINE_SITE ."connexion.php");
								}
								if(utilisateurEstConnecteEtEstAdmin() && isset($_GET['action']) && $_GET['action'] == 'deconnexion')
								{
								session_destroy();
								header("location:". RACINE_SITE ."connexion.php");
								}
							?>
						</ul>
					</div>	
				<div class="fix main_content_area">
					<div class="fix slider_area">
						<div class="fix slider_top_border"></div>
						<div class="slider">
							
							
						<!-- Jssor Slider Begin -->
						<!-- You can move inline styles to css file or css block. -->
						<div id="slider1_container" style="position: relative; width: 980px;height: 300px;">

							<!-- Loading Screen -->
							<div u="loading" style="position: absolute; top: 0px; left: 0px;">
								<div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
									background-color: #000; top: 0px; left: 0px;width: 100%;height:100%;">
								</div>
								<div style="position: absolute; display: block; background: url(images/loading.gif) no-repeat center center;
									top: 0px; left: 0px;width: 100%;height:100%;">
								</div>
							</div>

							<!-- Slides Container -->
							<div id="myslides" u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 980px; height: 300px;overflow: hidden;">
								<div>
									<img u="image" src="images/slider01.jpg"/>
									<img u="thumb" src="images/travel/thumb-01.jpg" />
								</div>
								<div>
									<img u="image" src="images/image02.jpg" />
									<img u="thumb" src="images/travel/thumb-02.jpg" />
								</div>
								<div>
									<img u="image" src="images/slider02.jpg" />
									<img u="thumb" src="images/travel/thumb-03.jpg" />
								</div>
								</div>
						</div>
						<div class="fix slider_bottom_border"></div>
					</div>
						<div class="fix home_main_content">