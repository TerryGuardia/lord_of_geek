<?php

/**
 * Les jeux sont rangés par console
 *
 * @author Loic LOG
 */
class M_Console {

    /**
     * Retourne tous les genres sous forme d'un tableau associatif
     *
     * @return le tableau associatif des genres
     */
    public static function trouveLesConsoles() {
        $req = "SELECT * FROM consoles";
        $res = AccesDonnees::query($req);
        $lesLignes = $res->fetchAll();
        return $lesLignes;
    }

}
