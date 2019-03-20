<?php
require_once('inc/init.inc.php');
if(isset($_GET['id_salle']))//je récupère les informations dans l'URL
 {
    //$resultat = informationSurUneSalle($_GET['id_salle']);//récupération des informations sur l'article : 
    $resultat = executeRequete("SELECT salle.id_salle,pays,ville,adresse,cp,titre,description,photo,capacite,categorie, produit.prix, produit.etat, produit.id_promo FROM salle left join produit on salle.id_salle=produit.id_salle WHERE salle.id_salle = '$_GET[id_salle]'");

    if($resultat->num_rows <= 0) //la requête renvoie 0 : c'est-à-dire qu'il n'y a aucun article correspondant à l'id_salle de l'url. Exemple : si l'id_salle 29 n'est pas présent dans la BDD, alors num_rows sera égal à 0. Donc redirection avec la page salles.php. Par contre, si l'id_salle est présent dans la BDD, alors on affichera les informations propres à l'article en question !
    {
      header("location:resevation.php");
      exit();//on stoppe TOTALEMENT le script !! on s'arrête là !
    }
 }
  
//j'inclus les parties de mon site : 
require_once('inc/header.inc.php');
require_once('inc/menu.inc.php');
//echo $msg;
$article = $resultat->fetch_assoc(); //=> je rends exploitable les informations sur l'article à afficher 
$fullAdresse = $article['adresse'] . ', ' . $article['ville'] . ', ' . $article['pays'];
?>

<section id = "global">
     
      
        <fieldset>
          <legend>Details Salle</legend>
        <?php 
        
             echo '<div class="content_ds_haut">';
               echo '<div id="leftside">';
                echo '<img src="'.$article['photo'].'" width="300" height="250">';
               echo '</div>';

               echo '<div id="rightside">';
                 echo '<h3 style="font-size:20px; color:gray;">'.$article['titre'] .'</h3>'.'<hr>';
                 echo '<p><strong>Description :</strong>' .$article['description'].'</p>';
                 echo '<p><strong>Capacité :</strong> ' .$article['capacite'].'</p>';
                 echo '<p><strong>Catégorie :</strong> ' .$article['categorie'].'</p>';
                 echo '<p><strong>Prix :</strong> ' .$article['prix'].' €</p>';
                  if ($article['id_promo'] == 1)
                  {
                    echo "<strong>Promo</strong> 25% <br>";
                  }
                  elseif ($article['id_promo'] == 2)
                  {
                    echo "<strong>Promo</strong> 50% <br>";

                  }
               echo '</div>';
             echo '</div>';


            echo '<div class="content_ds_bas">';
              echo '<div id="adresse_fiche_salle">';
              echo '<p style="font-size:20px; color:gray; padding-bottom:10px;">Informations complémentaires<p>';
              echo '<p><strong>Adresse :</strong>' .$article['adresse']. '</p>';
              echo '<p><strong>Code postal :</strong>' .$article['cp'].'</p>';
              echo '<p><strong>Ville :</strong>' .$article['ville'].'</p>';
              echo '<p><strong>Pays :</strong>' .$article['pays']. '</p>';
              echo '<iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" width="375" height="250" src="https://maps.google.com/maps?hl=en&q=('. $fullAdresse .')&ie=UTF8&t=roadmap&z=6&iwloc=B&output=embed"><div><small><a href="http://embedgooglemaps.com">embedgooglemaps.com</a></small></div><div></div></iframe>';
              echo '</div>';

              echo '<div id="avis">';

               echo '<h1 style = "text-align:center;">Avis</h1>';
               //$affiche = executeRequete("SELECT id_salle, commentaire, note, date_format(date,'%d/%m/%Y') As date_fr, date_format(date, '%H:%i') As heure_fr, membre.`nom` FROM avis INNER JOIN membre ON avis.`id_membre`=`membre`.id_membre ORDER BY date DESC LIMIT 0,5");

                $affiche = executeRequete("SELECT id_salle, commentaire, note, date_format(date,'%d/%m/%Y') As date_fr, date_format(date, '%H:%i') As heure_fr, membre.`nom` FROM avis INNER JOIN membre ON avis.`id_membre`=`membre`.id_membre WHERE `avis`.`id_salle` = '$_GET[id_salle]' ORDER BY date DESC LIMIT 0,5");

              while ($comments = $affiche->fetch_assoc())
              {
                echo '<p>'.$comments['nom'].', le '.$comments['date_fr'].' à '.$comments['heure_fr']. ' '.$comments['note'].'</p>';
                echo '<p>'.$comments['commentaire'].'</p><hr>';
              }
               
                  if(!utilisateurEstConnecte())
                  {
                    echo '<p>Il faut être <a href="connexion.php"><u>connecté</u></a> pour pouvoir déposer des commentaires</p>';
                  }else
                  {
                    echo '<form method="post" action="">';
                      echo '<label class="well_avis" for ="message">Note</label>';

                      echo '<select class="select_avis" name="note">';
                        echo '<option value="1/10">01/10</option>';
                        echo '<option value="2/10">02/10</option>';
                        echo '<option value="3/10">03/10</option>';
                        echo '<option value="4/10">04/10</option>';
                        echo '<option value="5/10">05/10</option>';
                        echo '<option value="6/10">06/10</option>';
                        echo '<option value="7/10">07/10</option>';
                        echo '<option value="8/10">08/10</option>';
                        echo '<option value="9/10">09/10</option>';
                        echo '<option value="10/10">10/10</option>';
                      echo '</select>';

                      echo '<label class="well_avis" for ="message">Ajouter un commentaire</label>';
                      echo '<textarea class="textarea" type name="message" cols="10" rows="5"></textarea>';
                      echo '<input class="type_submit avis" type="submit" name="soumettre" value="Soumettre">';
                    echo '</form>';
                    
                  }


            if ($_POST){
                $id_membre = $_SESSION['utilisateur']['id_membre'];
                $id_salle = $article['id_salle'];
                $message = htmlentities($_POST['message'], ENT_QUOTES);
                $note = $_POST['note'];

                $resultat = executeRequete("INSERT INTO avis (id_membre, id_salle, commentaire, note, date) VALUES ('$id_membre','$id_salle','$message','$note', NOW())");
                  // requete BD table avis
            }
              echo '</div>';
            echo '</div>';

            echo '<form method="POST" action="panier.php">';
            echo '<input type="hidden" name="id_salle" value="'.$article['id_salle'].'" />';
            if($article['etat'] == '1') {
             echo '<input type="submit" class="type_submit ajt_pannier" name="ajout_panier" value="Ajout au panier">';
              
            }else{
              echo '<div class ="sal_indispo"> Salle indisponible </div>';
            }
            echo '<a href="reservation.php?categorie='.$article['categorie'].'" > <strong> >Retour à votre sélection</<strong></a>';
            echo '</form>';
           
            
        ?> 
        
        </fieldset>
        
        
</section>


<?php
require_once("inc/footer.inc.php");
?>










