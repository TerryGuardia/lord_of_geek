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
        $nom = filter_input(INPUT_POST, 'nom');
        $rue = filter_input(INPUT_POST, 'rue');
        $ville = filter_input(INPUT_POST, 'ville');
        $cp = filter_input(INPUT_POST, 'cp');
        $mail = filter_input(INPUT_POST, 'mail');
        $errors = M_Commande::estValide($nom, $rue, $ville, $cp, $mail);
        if (count($errors) > 0) {
            // Si une erreur, on recommence
            afficheErreurs($errors);
        } else {
            $lesIdJeu = getLesIdJeuxDuPanier();
            M_Commande::creerCommande($nom, $rue, $cp, $ville, $mail, $lesIdJeu);
            supprimerPanier();
            afficheMessage("Commande enregistrée");
            $uc = '';
        }
        break;
}
