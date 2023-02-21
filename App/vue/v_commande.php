<section id="creationCommande">
    <form method="POST" action="index.php?uc=commander&action=confirmerCommande">
        <fieldset>
            <legend>Adresse de livraison</legend>

            <p>
                <label for="rue">rue*</label>
                <input id="rue" type="text" name="rue" value="<?= $rue ?>" maxlength="150" required>
            </p>
            <p>
                <label for="cp">code postal* </label>
                <input id="cp" type="text" name="cp" value="<?= $cp ?>" maxlength="5" pattern="\d{2}[ ]?\d{3}" required>
            </p>
            <p>
                <label for="ville">ville* </label>
                <input id="ville" type="text" name="ville"  value="<?= $ville ?>" maxlength="45" required>
            </p>
            <p>
                <input type="submit" value="Valider" name="valider">
                <input type="reset" value="Annuler" name="annuler"> 
            </p>
    </form>
</section>
