<h1>Modification des informations liées au compte</h1>

<form action="index.php?uc=compte&action=modification" method="post">
    <fieldset>
        <legend>Modification</legend>
        <p>
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" value="<?= $_SESSION['utilisateur']['nom'] ?>" maxlength="45" pattern="^[a-z ,.'-]+$" required>
        </p>
        <p>
            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" id="prenom" value="<?= $_SESSION['utilisateur']['prenom'] ?>" maxlength="45" pattern="^[a-z ,.'-]+$" required>
        </p>
        <p>
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" value="<?= $_SESSION['utilisateur']['email'] ?>" maxlength="150" pattern="^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$" required>
        </p>
        <p>
            <label for="adresse">Adresse :</label>
            <input type="text" name="adresse" id="adresse" value="<?= $_SESSION['utilisateur']['adresse'] ?>" maxlength="150" required>
        </p>
        <p>
            <label for="ville">Ville :</label>
            <input type="text" name="ville" id="ville" value="<?= $_SESSION['utilisateur']['ville'] ?>" maxlength="45" required>
        </p>
        <p>
            <label for="cp">Code Postal :</label>
            <input type="text" name="cp" id="cp" value="<?= $_SESSION['utilisateur']['cp'] ?>" maxlength="5" pattern="\d{2}[ ]?\d{3}" required>
        </p>
    </fieldset>
    <p>
        <input type="submit" value="Mettre à jour">
    </p>
</form>