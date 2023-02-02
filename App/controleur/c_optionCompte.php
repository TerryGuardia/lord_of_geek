<?php

switch ($action) {

    case 'historique':
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
