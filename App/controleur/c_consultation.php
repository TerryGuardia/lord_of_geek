<?php
include 'App/modele/M_genre.php';
include 'App/modele/M_console.php';
include 'App/modele/M_exemplaire.php';

/**
 * Controleur pour la consultation des exemplaires
 * @author Loic LOG
 */
switch ($action) {
    case 'voirJeuxByGenre':
        $genre = filter_input(INPUT_GET, 'genre');
        $lesJeux = M_Exemplaire::trouveLesJeuxDeGenre($genre);
        break;
    case 'voirJeuxByConsole':
        $console = filter_input(INPUT_GET, 'console');
        $lesJeux = M_Exemplaire::trouveLesJeuxDeConsole($console);
        break;
    case 'rechercheJeux':
        $nomJeu = filter_input(INPUT_GET, 'nomJeu');
        $lesJeux = M_Exemplaire::trouveLesJeuxParNom($nomJeu);
        break;
    case 'ajouterAuPanier':
        $idJeu = filter_input(INPUT_GET, 'jeu');
        $genre = filter_input(INPUT_GET, 'genre');
        if (!ajouterAuPanier($idJeu)) {
            afficheErreurs(["Ce jeu est déjà dans le panier !!"]);
        } else {
            afficheMessage("Ce jeu a été ajouté");
        }
        $lesJeux = M_Exemplaire::trouveLesJeuxDeGenre($genre);
        break;
    default:
        $lesJeux = M_Exemplaire::trouveLesExemplaires();
        break;
}

$lesGenres = M_Genre::trouveLesGenres();
$lesConsoles = M_Console::trouveLesConsoles();
