<?php

// ce fichier permet l'initialisation du site. il sera inclus sur toutes les pages avec les fichiers minimum requis pour le bon condtionnement du site.
// header('Content-type: text/html; charset=UTF-8');

define("RACINE_SITE", "/lokisalle/");// permet d'avoir le chemin absolu afin de g�rer les incoherences de l'arborescence de notre projet.
define("RACINE_SERVER", $_SERVER['DOCUMENT_ROOT']); // permet d'avoir un chemin automatis�

require_once ("connection_bdd.inc.php");
require_once ("function.inc.php");

session_start(); // creation de al session qui sera dispoible sur tout le site du fait d'�tre sur ce fichier!


$msg =""; // cette variable contiendra les messages � echanger avec l'utilisateur. Nous la d�clarons ici afin de pouvoir faire de la concat�nation. (elle existe !)



		