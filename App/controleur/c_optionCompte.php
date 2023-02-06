<?php

include_once 'App/modele/M_Session.php';

switch ($action) {

    case 'historique':
        $commandes = M_Session::getCommandesDuClient();

        include 'App/vue/v_historique.php';
        break;

    case 'modifInfo':
        include 'App/vue/v_modification.php';
        break;

    case 'deconnexion':
        session_destroy();
        header('Location: index.php?uc=accueil');
        exit;
    default:

        break;
}
