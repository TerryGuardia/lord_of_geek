<?php

include_once("./App/modele/AccesDonnees.php");
/**
 * Requetes sur les commandes
 *
 * @author Loic LOG
 */
class M_Commande
{

    /**
     * Crée une commande
     *
     * Crée une commande à partir des arguments validés passés en paramètre, l'identifiant est
     * construit à partir du maximum existant ; crée les lignes de commandes dans la table contenir à partir du
     * tableau d'idProduit passé en paramètre
     * @param $adresse_livraison
     * @param $ville
     * @param $cp
     * @param $listJeux
     * @param $id_client
     */
    public static function creerCommande($adresse_livraison, $ville, $cp, $listJeux, $id_client)
    {
        $idVille = M_Commande::getIdVille($ville, $cp);

        $req = "INSERT INTO commandes (client_id, adresse_livraison, villes_id) VALUES (:id_client, :adresse, :ville_id)";
        $res = AccesDonnees::prepare($req);
        $res->bindValue(':id_client', $id_client);
        $res->bindValue(':adresse', $adresse_livraison);
        $res->bindValue(':ville_id', $idVille);
        $res->execute();

        $idCommande = AccesDonnees::getPdo()->lastInsertId();

        foreach ($listJeux as $jeu) {
            $req = "INSERT INTO lignes_commande (commande_id, exemplaire_id) VALUES (:idcommande, :jeu)";
            $res = AccesDonnees::prepare($req);
            $res->bindValue(':idcommande', $idCommande);
            $res->bindValue(':jeu', $jeu);
            $res->execute();
        }
    }
    /**
     * Retourne vrai si pas d'erreur
     * Remplie le tableau d'erreur s'il y a
     *
     * @param $rue : chaîne
     * @param $ville : chaîne
     * @param $cp : chaîne
     * @return : array
     */
    public static function estValide($rue, $ville, $cp)
    {
        $erreurs = [];
        if ($rue == "") {
            $erreurs[] = "Il faut saisir le champ rue";
        }
        if ($ville == "") {
            $erreurs[] = "Il faut saisir le champ ville";
        }
        if ($cp == "") {
            $erreurs[] = "Il faut saisir le champ Code postal";
        } else if (!estUnCp($cp)) {
            $erreurs[] = "erreur de code postal";
        }
        return $erreurs;
    }

    /**
     * Récupère l'id qui correspond au nom de la ville et le retourne.
     *
     * @param $ville : chaîne
     * @param $cp : chaîne
     * @return : int
     */
    public static function getIdVille($ville, $cp)
    {
        $req = 'SELECT id FROM villes WHERE nom = :nom AND cp = :cp';
        $res = AccesDonnees::prepare($req);
        $res->bindValue(':nom', $ville);
        $res->bindValue(':cp', $cp);
        $res->execute();
        $ville_id = $res->fetchColumn();
        return intval($ville_id);
    }

    /**
     * Donne la valeur 1 au booléen a_vendre de la table exemplaires.
     *
     * @param $listJeux : array
     */
    public static function supprimerExemplaires($listJeux)
    {
        foreach ($listJeux as $jeu) {
            $req = "UPDATE exemplaires SET `a_vendre` = 1 WHERE id = :jeu";
            $res = AccesDonnees::prepare($req);
            $res->bindValue(':jeu', $jeu);
            $res->execute();
        }
    }
}
