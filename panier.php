<?php
//SIMULATION DE PAIEMENT : 
require_once('inc/init.inc.php');
creationDuPanier(); //crée le panier au cas où il ne l'est pas. 
//debug($_SESSION);

//----------VIDER LE PANIER----------
if(isset($_GET['action']) && $_GET['action'] == 'vider')
{
  unset($_SESSION['panier']);
  creationDuPanier();
}
//--------FIN VIDER LE PANIER---------

//----------PARTIE PAIEMENT DU PANIER----------

  if(isset($_POST['payer'])) 
  {
    executeRequete("INSERT INTO commande(montant, id_membre,  date) VALUES (" . montantTotal() . ",". $_SESSION['utilisateur']['id_membre'] . ", NOW())");
    
    //récupération du dernier identifiant auto-généré par l'auto-increment de la BDD
    $id_commande = $mysqli->insert_id;
    
    //pour tous les articles dans le panier, on observe l'id, la quantité, le prix : on récupère tout pour les placer dans la table details_commande : 
    for($j = 0 ; $j < count($_SESSION['panier']['id_produit']); $j++)
    {
      //=>
      //ajout des informations dans la table details_commande : 
      executeRequete("INSERT INTO details_commande (id_commande, id_produit) VALUES ($id_commande, ". (int)$_SESSION['panier']['id_produit'][$j].")");
         
      executeRequete("UPDATE produit SET etat = '0' WHERE id_produit = ".(int)$_SESSION['panier']['id_produit'][$j]);
    } 
    //paiement par chèque du coup on vide le panier : 
    unset($_SESSION['panier']);
    //envoi mail confirmation achat au client : 

    mail($_SESSION['utilisateur']['email'],"Confirmation de la commande", "Votre suivi de commande est le suivante : $id_commande","From:lokisalle.com");
    echo "<div class='primiere'>Merci pour votre commande. Votre n° suivi est le $id_commande</div>";
  }

//------FIN PARTIE PAIEMENT DU PANIER-------


//----------RETIRER ARTICLE DU PANIER----------
   
if(isset($_GET['action']) && $_GET['action'] == 'retirer')
{
  retirerUnArticleDuPanier($_GET['id_salle']);
}    
//--------FIN RETIRER ARTICLE DU PANIER--------


//--------AJOUT D'ARTICLE DANS LE PANIER---------

if(isset($_POST['ajout_panier']))//ce post provient de la page fiche_salle.php
{
  //debug($_POST);
  //echo $_POST['id_salle']; //on récupère bien l'ID !!
  
   
  $resultat = executeRequete("SELECT `salle`.`id_salle`,ville,titre,photo,capacite,`produit`.prix, date_arrivee, date_depart, `produit`.id_produit FROM salle left join produit on `salle`.`id_salle`=`produit`.`id_salle`WHERE `salle`.`id_salle` = '$_POST[id_salle]' ");


   //$sql = 'SELECT * FROM salle WHERE id_salle = Get';
      //$resultat = informationSurUneSalle($_POST['id_salle']); //on renseigne l'argument de ma fonction par le $_POST['id_salle'] récupéré depuis la fiche_salle.php
   $article = $resultat->fetch_assoc();
   //debug($article);
   
   //calcul prix TVA : 
   //$TVA = 1.2;   
   //$article['prix'] = $article['prix'] * 1.2;//calcul du prix en rajoutant la TVA
   ajouterArticleDansPanier($article['id_produit'], $article['titre'], $article['photo'], $article['ville'], $article['capacite'], $article['date_arrivee'], $article['date_depart'], $article['prix']);//on rajoute l'article dans le panier.
   header("location:panier.php"); // pour éviter de rajouter plusieurs fois l'article dans le panier si F5

  //debug($_SESSION);
}   
//--------FIN AJOUT D'ARTICLE DANS LE PANIER---------



//------AFFICHAGE DU PANIER------
//j'inclus les parties de mon site : 
require_once('inc/header.inc.php');
require_once('inc/menu.inc.php');


echo "<table border='1' style='border-collapse:collapse' cellpadding='7'>";
echo '<tr><td colspan="10">VOTRE PANIER</td></tr>';
echo "<tr><th>PRODUIT</th><th>SALLE</th><th>PHOTO</th><th>VILLE</th><th>CAPACITE</th><th>DATE_ARRIVEE</th><th>DATE_DEPART</th><th>PRIX HT</th><th>TVA</th><th>RETIRER</th></tr>";
//condition : si le panier est vide : 
  if(empty($_SESSION['panier']['id_produit']))
  {
      echo '<tr><td colspan="10">VOTRE PANIER EST VIDE</td></tr>';
  }
  else
  {
    for($w = 0; $w < count($_SESSION['panier']['id_produit']); $w++) //boucle qui tournera autant de fois qu'il y a d'articles dans notre panier
    {
      echo '<tr>';
      echo '<td>' . $_SESSION['panier']['id_produit'][$w] . '</td>';
      echo '<td>' . $_SESSION['panier']['titre'][$w] . '</td>';
      echo '<td>' . $_SESSION['panier']['photo'][$w] . '</td>';
      echo '<td>' . $_SESSION['panier']['ville'][$w] . '</td>';
      echo '<td>' . $_SESSION['panier']['capacite'][$w] . '</td>';
      echo '<td>' . $_SESSION['panier']['date_arrivee'][$w] . '</td>';
      echo '<td>' . $_SESSION['panier']['date_depart'][$w] . '</td>';
      echo '<td>' . $_SESSION['panier']['prix'][$w] . '</td>';
      echo '<td>' . '20%' . '</td>';
      //echo "string";echo '<td>' .$TVA. '</td>';

      echo '<td><a href="?action=retirer&id_salle='. $_SESSION['panier']['id_produit'][$w].'" ><i class="fa fa-trash-o" style="color:red; font-size:18px;"></a></td>';
      echo '</tr>';
    }
    
    echo '<tr><th colspan="3">TOTAL</th><td colspan="2">' .montantTotal().' euros</td></tr>';
  }


  //conditions si le visiteur est connecté ou non-connecté : 
  if(utilisateurEstConnecte()) //si l'utilisateur est connecté
  {
    echo '<form method="post" action="">';
    echo '<tr><td colspan="5"><input type="submit" name="payer" value="payer"></td></tr>';
    echo '</form>';
  }
  else  //si l'utilisateur n'est pas connecté
  {
    echo '<tr><td colspan="3">Veuillez-vous <a href="connexion.php">connecter</a> ou vous <a href="inscription.php" >inscrivez</a> afin de pouvoir payer</td></tr>';
  }
  //proposer au visteur de vider son panier : 
  echo "<tr><td colspan='5'><a href='?action=vider'>Vider le panier</a></td></tr>";

echo "</table>";
echo '<hr /><p>Réglement par chèque uniquement à l\'adresse: 37 rue saint sébastien 75011 Paris</p>';
echo '<hr /><p>Tous nos article ont un prix calculé avec le taux de TVA à 19.6%</p><hr />';
// si l'utilisateur est connecté, afficher son adresse de livraison
if(utilisateurEstConnecte())
{
  echo '<h3>Vos informations de livraison:</h3>';
  echo '<address><strong>'.$_SESSION['utilisateur']['nom']. ' '.$_SESSION['utilisateur']['prenom']. '</strong><br />';
  echo $_SESSION['utilisateur']['adresse'] . '<br />';
  echo $_SESSION['utilisateur']['ville'] . '<br />';
  echo $_SESSION['utilisateur']['cp'] . '<br />';
  echo '</address>';
}

//require_once("inc/footer.inc.php");
?>