<div id="recherche">
    <form action="index.php" method="get">
        <input type="hidden" name="uc" value="visite">
        <input type="hidden" name="action" value="rechercheJeux">
        <input type="text" name="nomJeu" placeholder="Rechercher un jeu">
        <input type="submit" value="Rechercher">
    </form>
</div>
<section id="visite">
    <aside id="categories">
        <ul>
            <?php
            foreach ($lesGenres as $unGenre) {
                $idGenre = $unGenre['id'];
                $libGenre = $unGenre['nom'];
            ?>
                <li>
                    <a href=index.php?uc=visite&genre=<?php echo $idGenre ?>&action=voirJeuxByGenre><?php echo $libGenre ?></a>
                </li>
            <?php
            }
            ?>
        </ul>
        <ul>
            <?php
            foreach ($lesConsoles as $uneConsole) {
                $idConsole = $uneConsole['id'];
                $libConsole = $uneConsole['nom'];
            ?>
                <li>
                    <a href=index.php?uc=visite&console=<?php echo $idConsole ?>&action=voirJeuxByConsole><?php echo $libConsole ?></a>
                </li>
            <?php
            }
            ?>
        </ul>
    </aside>
    <section id="jeux">
        <?php
        foreach ($lesJeux as $unJeu) {
            $id = $unJeu['id'];
            $description = $unJeu['description'];
            $prix = $unJeu['prix'];
            $image = $unJeu['image'];
            $etat = $unJeu['etat'];
        ?>
            <article>
                <img src="public/images/jeux/<?= $image ?>" alt="Image de <?= $description; ?>" />
                <p><?= $etat ?></p>
                <p><?= $description ?></p>
                <p><?= "Prix : " . $prix . " Euros" ?>
                    <a href="index.php?uc=visite&genre=<?= $genre ?>&jeu=<?= $id ?>&action=ajouterAuPanier">
                        <img src="public/images/mettrepanier.png" title="Ajouter au panier" class="add" />
                    </a>
                </p>
            </article>
        <?php
        }
        ?>
    </section>
</section>