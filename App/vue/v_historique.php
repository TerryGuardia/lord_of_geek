<h1>Liste des anciennes commandes</h1>
<?php
foreach ($commandes as $commande) {
    $lesJeuxDeLaCommande = M_Session::getJeuxDeLaCommande($commande['id']);
    $total = 0;

    echo "<h2>Commande n°" . $commande['id'] . "</h2>";
    echo "<div class='d-flex'>";
    foreach ($lesJeuxDeLaCommande as $unJeu) {
        $id = $unJeu['id'];
        $description = $unJeu['description'];
        $image = $unJeu['image'];
        $prix = $unJeu['prix'];
        $etat = $unJeu['etat'];
        $total += $prix;
?>
        <p class="ml-25">
            <img src="public/images/jeux/<?php echo $image ?>" alt=image width=100 height=100 />
            <?php
            echo "<br>Etat de l'article : " . $etat . '<br>';
            echo $description . " $prix €";
            ?>
        </p>
<?php
    }
    echo "total de la commande :" . $total . "€";
    echo "<br> adresse de livraison : " . $commande['adresse_livraison'];
    echo "<br> ville : " . $commande['nom'];
    echo "<br> code postal : " . $commande['cp'];
    echo "</div>";
}
?>