<?php

//$mysqli = @new Mysqli("cl1-sql23", "kkt70801", "WsyFSZenSyJW", " kkt70801");// le @permet d'éviter le message d'erreur généré par php afin de le gérer nous meme.
$mysqli = @new Mysqli("localhost", "root", "", "lokisalle");// le @permet d'éviter le message d'erreur généré par php afin de le gérer nous meme.

if($mysqli->connect_error)
{
	 die("un probleme ests survenu lors de la tentative de connextion à la BDD;".$mysqli->connect_error);// jamais de ma vie je ne mettrais nu @ en PHP sauf si j'ai décidé de gérer moi-meme l'erreur proprement avec un IF
}

$mysqli->set_charset("utf-8"); 
// en cas de probleme d'encodage avec l'utf-8 en BDD