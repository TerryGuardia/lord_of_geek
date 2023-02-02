<?php


switch ($action) {
    case 'inscription':
        $nom = filter_input(INPUT_POST, 'nom');
        $prenom = filter_input(INPUT_POST, 'prenom');
        $email = filter_input(INPUT_POST, 'email');
        $adresse = filter_input(INPUT_POST, 'adresse');
        $ville = filter_input(INPUT_POST, 'ville');
        $cp = filter_input(INPUT_POST, 'cp');
        $mdp = filter_input(INPUT_POST, 'mdp');

        Session::inscription($nom, $prenom, $email, $adresse, $ville, $cp, $mdp);
        afficheMessage('Votre compte a été crée avec succes.');
        break;

    case 'authentification':
        $email = filter_input(INPUT_POST, 'email');
        $mdp = filter_input(INPUT_POST, 'mdp');

        if (Session::utilisateur_existe($email) && Session::checkPassword($email, $mdp)) {
            $_SESSION['connexion'] = 'on';
            $utilisateur = Session::utilisateurInfo($email);
            $_SESSION['utilisateur'] = array(
                'id' => $utilisateur['id'],
                'nom' => $utilisateur['nom'],
                'prenom' => $utilisateur['prenom'],
                'adresse' => $utilisateur['adresse'],
                'cp' => $utilisateur['cp'],
                'ville' => $utilisateur['ville'],
                'email' => $utilisateur['email']
            );
        } else {
            // Sinon, on affiche un message d'erreur
            echo "Identifiants incorrects";
        }
        break;

    case 'modification':
        $nom = filter_input(INPUT_POST, 'nom');
        $prenom = filter_input(INPUT_POST, 'prenom');
        $email = filter_input(INPUT_POST, 'email');
        $adresse = filter_input(INPUT_POST, 'adresse');
        $ville = filter_input(INPUT_POST, 'ville');
        $cp = filter_input(INPUT_POST, 'cp');
        $mdp = filter_input(INPUT_POST, 'mdp');

        if (isset($_SESSION['connexion'])) {
            Session::modification($nom, $prenom, $email, $adresse, $ville, $cp, $mdp);
            afficheMessage('Vos informations on bien été mis à jour.');
            
            $utilisateur = Session::utilisateurInfo($email);
            $_SESSION['utilisateur'] = array(
                'id' => $utilisateur['id'],
                'nom' => $utilisateur['nom'],
                'prenom' => $utilisateur['prenom'],
                'adresse' => $utilisateur['adresse'],
                'cp' => $utilisateur['cp'],
                'ville' => $utilisateur['ville'],
                'email' => $utilisateur['email']
            );
        }
}
