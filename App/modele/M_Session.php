<?php

include_once("./App/modele/AccesDonnees.php");



class M_Session
{

    /**
     * Vérifie si un client dont l'email correspond à $email se trouve dans la table clients.
     *
     * @param $email
     * @return bool
     */
    public static function utilisateur_existe($email)
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

    /**
     * Récupère le mot de passe du client dont l'email vaut $email, puis le compare à celui renseigné dans $mdp.
     *
     * @param $email
     * @param $mdp
     * @return bool
     */
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

    /**
     * Récupère l'id de la ville renseignée, hash le mot de passe et créer le compte dans la table clients.
     *
     * @param $nom
     * @param $prenom
     * @param $email
     * @param $adresse
     * @param $ville
     * @param $cp
     * @param $mdp
     */
    public static function inscription($nom, $prenom, $email, $adresse, $ville, $cp, $mdp)
    {

        $req = 'SELECT id FROM villes WHERE nom = :nom AND cp = :cp';
        $res = AccesDonnees::prepare($req);
        $res->bindValue(':nom', $ville);
        $res->bindValue(':cp', $cp);
        $res->execute();
        $ville_id = $res->fetch();
        $ville_id = $ville_id['id'];

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

    /**
     * Récupère les informations relatives au client dont l'email est équivalent à $email.
     *
     * @param $email
     * @return array
     */
    public static function utilisateurInfo($email)
    {
        $req = 'SELECT clients.id AS id, clients.nom AS nom, prenom, adresse, cp, villes.nom AS ville, email FROM `clients` JOIN `villes` ON clients.ville_id = villes.id WHERE email = :email';

        $res = AccesDonnees::prepare($req);
        $res->bindValue(':email', $email);
        $res->execute();

        return $res->fetch();
    }

    /**
     * Récupère l'id de la ville renseignée, modifie les informations du compte client.
     *
     * @param $nom
     * @param $prenom
     * @param $email
     * @param $adresse
     * @param $ville
     * @param $cp
     */
    public static function modification($nom, $prenom, $email, $adresse, $ville, $cp)
    {

        $req = 'SELECT id FROM villes WHERE nom = :nom AND cp = :cp';
        $res = AccesDonnees::prepare($req);
        $res->bindValue(':nom', $ville);
        $res->bindValue(':cp', $cp);
        $res->execute();
        $ville_id = $res->fetch();
        $ville_id = $ville_id['id'];

        $req = 'UPDATE `clients` SET `nom` = :nom, `prenom` = :prenom, `email` = :email, `adresse` = :adresse, `ville_id` = :ville_id WHERE `email` = :email';

        $res = AccesDonnees::prepare($req);
        $res->bindValue(':nom', $nom);
        $res->bindValue(':prenom', $prenom);
        $res->bindValue(':email', $email);
        $res->bindValue(':adresse', $adresse);
        $res->bindValue(':ville_id', $ville_id);
        $res->execute();
    }

    /**
     * Récupère les commandes relatives au client.
     *
     * @return array
     */
    public static function getCommandesDuClient()
    {
        $idClient = $_SESSION['utilisateur']['id'];
        $req = 'SELECT commandes.*, villes.nom, villes.cp FROM commandes 
        INNER JOIN villes ON commandes.villes_id = villes.id
        WHERE client_id = :idClient';
        $res = AccesDonnees::prepare($req);
        $res->bindValue(':idClient', $idClient);
        $res->execute();
        $commandes = $res->fetchAll();
        return $commandes;
    }

    /**
     * Récupère les jeux de la commande dont l'id correspond.
     *
     * @param $idCommande
     * @return array
     */
    public static function getJeuxDeLaCommande($idCommande)
    {
        $req = 'SELECT * FROM exemplaires WHERE id IN (SELECT exemplaire_id FROM lignes_commande WHERE commande_id = :idCommande)';
        $res = AccesDonnees::prepare($req);
        $res->bindValue(':idCommande', $idCommande);
        $res->execute();
        $jeux = $res->fetchAll();
        return $jeux;
    }
}
