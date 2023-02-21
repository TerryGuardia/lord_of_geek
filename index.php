<?php

session_start();


require("./util/fonctions.inc.php");
require('./util/validateurs.inc.php');

$uc = filter_input(INPUT_GET, 'uc'); // Use Case
$action = filter_input(INPUT_GET, 'action'); // Action
initPanier();

if (!$uc) {
    $uc = 'accueil';
}

// Controleur principale
switch ($uc) {
    case 'visite':
        include 'App/controleur/c_consultation.php';
        break;
    case 'panier':
        include 'App/controleur/c_gestionPanier.php';
        break;
    case 'commander':
        include 'App/controleur/c_passerCommande.php';
        break;
    case 'compte':
        include 'App/controleur/c_monCompte.php';
        break;
    default:
        break;
}


include("App/vue/template.php");
