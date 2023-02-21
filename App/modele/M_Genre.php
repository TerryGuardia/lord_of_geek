<?php

include_once("./App/modele/AccesDonnees.php");
/**
 * Les jeux sont rangés par Genre
 *
 * @author Loic LOG
 */
class M_Genre {

    /**
     * Retourne tous les genres sous forme d'un tableau associatif
     *
     * @return array
     */
    public static function trouveLesGenres() {
        $req = "SELECT * FROM genres";
        $res = AccesDonnees::prepare($req);
        $res->execute();
        $lesLignes = $res->fetchAll();
        return $lesLignes;
    }

}
