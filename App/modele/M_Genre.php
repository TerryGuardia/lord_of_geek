<?php

/**
 * Les jeux sont rangés par catégorie
 *
 * @author Loic LOG
 */
class M_Genre {

    /**
     * Retourne tous les genres sous forme d'un tableau associatif
     *
     * @return le tableau associatif des genres
     */
    public static function trouveLesGenres() {
        $req = "SELECT * FROM genres";
        $res = AccesDonnees::query($req);
        $lesLignes = $res->fetchAll();
        return $lesLignes;
    }

}
