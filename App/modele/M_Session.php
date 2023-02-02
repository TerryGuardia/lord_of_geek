<?php

class Session
{
    public static function utilisateur_existe($email): bool
    {
        $req = 'SELECT * FROM `clients` WHERE email = :email';

        $res = AccesDonnees::prepare($req);
        $res->bindValue(':email', $email);
        $res->execute();

        if ($res->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function inscription($nom, $prenom, $email, $adresse, $ville, $cp, $mdp)
    {

        // Vérifie si la ville existe déjà dans la table ville
        $req = 'SELECT id FROM villes WHERE nom = :nom AND cp = :cp';
        $res = AccesDonnees::prepare($req);
        $res->bindValue(':nom', $ville);
        $res->bindValue(':cp', $cp);
        $res->execute();
        $ville_id = $res->fetch();

        // Si la ville n'existe pas, on l'ajoute à la table
        if (!$ville_id) {
            $req = 'INSERT INTO `villes` (`nom`, `cp`) VALUES (:nom, :cp)';
            $res = AccesDonnees::prepare($req);
            $res->bindValue(':nom', $ville);
            $res->bindValue(':cp', $cp);
            $res->execute();

            $ville_id = AccesDonnees::getPdo()->lastInsertId();
        } else {
            $ville_id = $ville_id['id'];
        }

        $mdp = password_hash($mdp, PASSWORD_BCRYPT);

        $req = 'INSERT INTO `clients` (`nom`, `prenom`, `email`, `adresse`, `mdp`, `ville_id`) VALUES (:nom, :prenom, :email, :adresse, :mdp, :ville_id)';

        $res = AccesDonnees::prepare($req);
        $res->bindValue(':nom', $nom);
        $res->bindValue(':prenom', $prenom);
        $res->bindValue(':email', $email);
        $res->bindValue(':adresse', $adresse);
        $res->bindValue(':mdp', $mdp);
        $res->bindValue(':ville_id', $ville_id);
        $res->execute();
    }

    public static function checkPassword($email, $mdp)
    {
        $req = 'SELECT mdp FROM `clients` WHERE email = :email';

        $res = AccesDonnees::prepare($req);
        $res->bindValue(':email', $email);
        $res->execute();
        $mdp_bdd = $res->fetch();
        $mdp_bdd = $mdp_bdd['mdp'];

        return password_verify($mdp, $mdp_bdd);
    }

    public static function utilisateurInfo($email)
    {
        $req = 'SELECT clients.id AS id, clients.nom AS nom, prenom, adresse, cp, villes.nom AS ville, email FROM `clients` JOIN `villes` ON clients.ville_id = villes.id WHERE email = :email';

        $res = AccesDonnees::prepare($req);
        $res->bindValue(':email', $email);
        $res->execute();

        return $res->fetch();
    }

    public static function modification($nom, $prenom, $email, $adresse, $ville, $cp, $mdp)
    {

        // Vérifie si la ville existe déjà dans la table ville
        $req = 'SELECT id FROM villes WHERE nom = :nom AND cp = :cp';
        $res = AccesDonnees::prepare($req);
        $res->bindValue(':nom', $ville);
        $res->bindValue(':cp', $cp);
        $res->execute();
        $ville_id = $res->fetch();

        // Si la ville n'existe pas, on l'ajoute à la table
        if (!$ville_id) {
            $req = 'INSERT INTO `villes` (`nom`, `cp`) VALUES (:nom, :cp)';
            $res = AccesDonnees::prepare($req);
            $res->bindValue(':nom', $ville);
            $res->bindValue(':cp', $cp);
            $res->execute();

            $ville_id = AccesDonnees::getPdo()->lastInsertId();
        } else {
            $ville_id = $ville_id['id'];
        }

        $mdp = password_hash($mdp, PASSWORD_BCRYPT);

        $req = 'UPDATE `clients` SET `nom` = :nom, `prenom` = :prenom, `email` = :email, `adresse` = :adresse, `mdp` = :mdp, `ville_id` = :ville_id WHERE `email` = :email';

        $res = AccesDonnees::prepare($req);
        $res->bindValue(':nom', $nom);
        $res->bindValue(':prenom', $prenom);
        $res->bindValue(':email', $email);
        $res->bindValue(':adresse', $adresse);
        $res->bindValue(':mdp', $mdp);
        $res->bindValue(':ville_id', $ville_id);
        $res->execute();
    }
}
