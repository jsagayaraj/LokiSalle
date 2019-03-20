<?php
require_once('inc/init.inc.php');
if(isset($_GET['id_salle']))//je récupère les informations dans l'URL
{
  $resultat = executeRequete("SELECT * FROM salle WHERE id_salle='$_GET[id_salle]'");
  if($resultat->num_rows <= 0)
  {
    header("location:resevation.php");
    exit();
  }
}else { // s'il n'y a pas d'id_article dans l'url
  header("location:boutique.php");
  exit();
}

$article = $resultat->fetch_assoc(); //=> je rends exploitable les informations sur l'article à afficher 

//j'inclus les parties de mon site : 
require_once('inc/header.inc.php');
require_once('inc/menu.inc.php');
echo $msg;
?>

<section id = "global">
     
      
        <fieldset>
          <legend>Details Salle</legend>
        <?php 
          echo '<div id="ds_maincontent">';
             echo '<div id="leftside">';
             echo '<img src="'.$article['photo'].'" width="300" height="250">';
             echo '</div>';

             echo '<div id="rightside">';
             echo '<h3 style="font-size:20px; color:gray;">'.$article['titre'] .'</h3>'.'<hr>';
             echo '<p><strong>Description :</strong>' .$article['description'].'</p>';
             echo '<p><strong>Capacité :</strong> ' .$article['capacite'].'</p>';
             echo '<p><strong>Catégorie :</strong> ' .$article['categorie'].'</p>';
             echo '</div>';
          echo '</div>';


          echo '<div id="adresse_fiche_salle">';
          echo '<p style="font-size:20px; color:gray; padding-bottom:10px;">Informations complémentaires'.'<p>' ;
          echo '<p><strong>Adresse :</strong>' .$article['adresse']. '</p>';
          echo '<p><strong>Code postal :</strong>' .$article['cp'].'</p>';
          echo '<p><strong>Ville :</strong>' .$article['ville'].'</p>';
          echo '<p><strong>Pays :</strong>' .$article['pays']. '</p>';

          echo '<form method="POST" action="panier.php">';
          echo "<input type='hidden' name='id_salle' value='$article[id_salle]'>";
          echo '<input type="submit" name="ajout_panier" value="Ajout au panier">';
          echo '</form>';
          echo '</div>';

        ?> 
        
        </fieldset>
        
        
       
</section>





<?php


/*if($article['stock'] > 0) //s'il y a du stock disponible. C'est-à-dire si stock est supérieur à 0. 
{
  echo "Nombre d'article(s) disponible : $article[stock]<br>";

  echo "<form method='post' action='panier.php'>";
  echo "<input type='hidden' name='id_salle' value='$article[id_salle]'>"; //type="hidden". Car on va récupérer cette information qui inutile pour le client. Du coup, on cache cette information. 
  echo "<label for='quantite'>Quantité</label>";
  echo '<select id="quantite" name="quantite">'; //en dehors de la boucle !!!
    for($i = 1; $i<= $article['stock'] && $i <= 5; $i++)
      //la boucle for interroge le stock et le 5 => pour voir si on ne dépasse pas ces valeurs
    {
      echo '<option>'.$i.'</option>';
    }
  echo '</select><br>';//en dehors de la boucle !!!/*
  echo "<form method='post' action='panier.php'>";
  echo '<input type="submit" name="ajout_panier" value="Ajout au panier">';
  echo '</form>';
}
else
{
  echo 'Rupture de stock !';
}  */


// faire un lien retour à la boutique avec la dernière catégorie consultée par défaut.
echo '<hr />';
echo '<a href="reservation.php?categorie='.$article['categorie'].'" >Retour à votre sélection</a>';
echo '<hr />';

require_once("inc/footer.inc.php");
?>










