<?php
require_once("../inc/init.inc.php");

if(!utilisateurEstConnecteEtEstAdmin())
{
	header("location:../connexion.php");
	
}
else{
	require_once ("../inc/header.inc.php");
	require_once ("../inc/menu.inc.php");
}

echo '<div class="affichage">Gestion Code Promos</div>';
?>

<form name="codepromo" method="post" action="">
<label for="valeurpromo">Promotion :</label><br>
<input name="valeurpromo" type="text"> %<br>
<input name="gencode" type="submit" value="Générer">
</form>
<?php
if(isset($_GET['action']) && $_GET['action'] == "suppression")
{
	executeRequete("DELETE FROM promotion WHERE id_promo = $_GET[id_promo]");
	$_GET['action'] = 'affichage';	
}

if(isset($_POST['gencode']))
{
	if($_POST['valeurpromo'] == 0 || empty($_POST['valeurpromo']))
		{
			$msg .= "<div class='error'>Votre code promo ne peut pas être égal à zéro.</div>";
		}
				else
				{
					$codepromo = 'PROMO';
					$codepromo .= substr(uniqid(rand(), true),0,10);
					$savecodepromo = executeRequete("INSERT INTO promotion (code_promo, reduction) VALUES ('$codepromo', '$_POST[valeurpromo]')");
					$msg .= "<div class='primiere'>Code promo généré.</div>";
				}
}
	echo $msg;
	

$tab_promo = executeRequete("SELECT * FROM promotion");
$nb_rows = $tab_promo->num_rows;
$nb_cols = $tab_promo->field_count;
echo 'Nous avons actuellement '.$nb_rows.' code(s) promotion en cours.';


echo "<table> <tr>";
		for ($i=0; $i<$nb_cols; $i++)
			{
				$colonne = $tab_promo->fetch_field();
				echo '<th>'. $colonne->name . '</th>';
			}
				echo '<th>Suppression</th>';
				echo '</tr>';

					while($lignes = $tab_promo->fetch_assoc())
						{
							echo '<tr>';
								foreach($lignes as $indices => $informations)
									{
										echo '<td>'. $informations . '</td>';
									}
							echo '<td><a href="?action=suppression&id_promo=' . $lignes['id_promo'] .'" OnClick="return(confirm(\'Confirmez-vous la suppression ?\'));"><i class="fa fa-trash-o" style="color:red; font-size:18px;"></i></a></td>';
						}
							echo '</tr>';
echo '</table>';
?>


<?php
require_once ("../inc/footer.inc.php");

?>