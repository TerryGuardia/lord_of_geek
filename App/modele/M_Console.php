<?php

include_once("./App/modele/AccesDonnees.php");
/**
 * Les jeux sont rangés par console
 *
 * @author Loic LOG
 */
class M_Console {

    /**
     * Retourne toutes les consoles sous forme d'un tableau associatif
     *
     * @return le tableau associatif des consoles
     */
    public static function trouveLesConsoles() {
        $req = "SELECT * FROM consoles";
        $res = AccesDonnees::prepare($req);
        $res->execute();
        $lesLignes = $res->fetchAll();
        return $lesLignes;
    }

}
