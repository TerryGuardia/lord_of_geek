<?php

include_once("./App/modele/AccesDonnees.php");
/**
 * Requetes sur les exemplaires  de jeux videos
 *
 * @author Loic LOG
 */
class M_Exemplaire
{

    /**
     * Retourne sous forme d'un tableau associatif tous les jeux qui
     * sont encore à vendre.
     *
     * @return array
     */
    public static function trouveLesExemplaires()
    {
        $req = "SELECT * FROM exemplaires WHERE a_vendre = 0";
        $res = AccesDonnees::prepare($req);
        $res->execute();
        $lesLignes = $res->fetchAll();
        return $lesLignes;
    }

    /**
     * Retourne sous forme d'un tableau associatif tous les jeux dont
     * le genre correspond à l'id.
     *
     * @param $idGenre
     * @return array
     */
    public static function trouveLesJeuxDeGenre($idGenre)
    {
        $req = "SELECT * FROM exemplaires WHERE genre_id = :id";
        $res = AccesDonnees::prepare($req);
        $res->bindValue(':id', $idGenre);
        $res->execute();
        $lesLignes = $res->fetchAll();
        return $lesLignes;
    }

    /**
     * Retourne sous forme d'un tableau associatif tous les jeux dont
     * le type de console correspond à l'id.
     *
     * @param $idConsole
     * @return array
     */
    public static function trouveLesJeuxDeConsole($idConsole)
    {
        $req = "SELECT * FROM exemplaires WHERE console_id = :idconsole";
        $res = AccesDonnees::prepare($req);
        $res->bindValue(':idconsole', $idConsole);
        $res->execute();
        $lesLignes = $res->fetchAll();
        return $lesLignes;
    }

    /**
     * Retourne sous forme d'un tableau associatif tous les jeux dont
     * la description comporte $nomJeu.
     *
     * @param $nomJeu
     * @return array
     */
    public static function trouveLesJeuxParNom($nomJeu)
    {
        $req = "SELECT * FROM exemplaires WHERE description LIKE :nomJeu AND a_vendre = 0";
        $res = AccesDonnees::prepare($req);
        $res->bindValue(':nomJeu', '%' . $nomJeu . '%');
        $res->execute();
        $lesJeux = $res->fetchAll();
        return $lesJeux;
    }

    /**
     * Retourne les jeux concernés par le tableau des idProduits passée en argument
     *
     * @param $desIdJeux tableau d'idProduits
     * @return un tableau associatif
     */
    public static function trouveLesJeuxDuTableau($desIdJeux)
    {
        $nbProduits = count($desIdJeux);
        $lesProduits = array();
        if ($nbProduits != 0) {
            foreach ($desIdJeux as $unIdProduit) {
                $req = "SELECT * FROM exemplaires WHERE id = :unIdProduit";
                $res = AccesDonnees::prepare($req);
                $res->bindValue(':unIdProduit', $unIdProduit);
                $res->execute();
                $unProduit = $res->fetch();
                $lesProduits[] = $unProduit;
            }
        }
        return $lesProduits;
    }
}
