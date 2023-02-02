<?php

include 'App/modele/M_commande.php';

/**
 * Controleur pour les commandes
 * @author Loic LOG
 */
switch ($action) {
    case 'passerCommande':
        $n = nbJeuxDuPanier();
        if (!isset($_SESSION['connexion'])) {
            header('Location: index.php?uc=compte');
        } elseif ($n == 0) {
            afficheMessage("Panier vide !!");
            $uc = '';
        } else {
            $nom = $_SESSION['utilisateur']['nom'];
            $prenom = $_SESSION['utilisateur']['prenom'];
            $rue = $_SESSION['utilisateur']['adresse'];
            $ville = $_SESSION['utilisateur']['ville'];
            $cp = $_SESSION['utilisateur']['cp'];
            $mail = $_SESSION['utilisateur']['email'];
        }
        break;
    case 'confirmerCommande':
        $rue = filter_input(INPUT_POST, 'rue');
        $cp = filter_input(INPUT_POST, 'cp');
        $ville = filter_input(INPUT_POST, 'ville');
        $id_client = $_SESSION['utilisateur']['id'];
        $errors = M_Commande::estValide($rue, $ville, $cp);
        if (count($errors) > 0) {
            // Si une erreur, on recommence
            afficheErreurs($errors);
        }
        // else if {
        //    //ajout de vérification , si l'adresse n'est pas la meme que celui du compte 
        // }
         else {
            $lesIdJeu = getLesIdJeuxDuPanier();
            M_Commande::creerCommande($rue, $cp, $ville, $lesIdJeu, $id_client);
            supprimerPanier();
            afficheMessage("Commande enregistrée");
            $uc = '';
        }
        break;
}
