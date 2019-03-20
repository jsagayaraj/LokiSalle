<?php
require_once("inc/init.inc.php");
//j'inclus les parties de mon site : 
require_once ("inc/header.inc.php");
require_once ("inc/menu.inc.php");
//AFFICHAGE DES CATEGORIES : 
  //$categorie_des_articles = executeRequete("SELECT DISTINCT categorie FROM salle");//éviter les doublons

//affichage liens catégories : 
//echo "<div class='gauche'>";
//echo "<ul>";
//while($cat = $categorie_des_articles->fetch_assoc())
//{
  //echo "<li><a href='?categorie=". $cat['categorie'] ."'>" .$cat['categorie'] . "</a></li>" ;
//}

//echo "</ul></div>";

//affichage articles : 
echo '<div class="droite">';
  //if(isset($_GET['categorie']))//je récupère l'indice 'categorie' de l'url
  //{
    //$donnees = executeRequete("SELECT `salle`.`id_salle`,pays,ville,adresse,cp,titre,description,photo,capacite,categorie,`produit`.`prix`, date_depart, date_arrivee FROM salle left join produit on `salle`.`id_salle`=`produit`.`id_salle`");
    $donnees = executeRequete("SELECT salle.id_salle, pays, ville, adresse, cp, titre, description, photo, capacite, categorie, produit.prix, date_depart, date_arrivee,id_promo,etat FROM salle left join produit on salle.id_salle=produit.id_salle");

    while($article = $donnees->fetch_assoc()) //je récupère les informations
    {
      echo '<div class="produits">';
        echo '<div class="text_produits">';
          echo "<img src='$article[photo]' width='248' height='160'>";
          echo '<h3>'.$article['titre'].'</h3>';
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
      //echo '<div class="aj_pannier"><a href="panier.php?id_salle=$article[id_salle]">Ajouter au Panier</a></div>';

      //echo "<a href='fiche_salle.php?id_salle=$article[id_salle]'>lien vers $article[titre]</a>";
      echo '</div>';  
    }
  //}
echo '</div>';
?>

<?php
require_once ("inc/footer.inc.php");

?>











