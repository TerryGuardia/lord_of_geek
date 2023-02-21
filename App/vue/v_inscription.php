<h1>Inscription</h1>
<form action="index.php?uc=compte&action=inscription" method="post">
    <fieldset>
        <legend>Inscription</legend>
        <p>
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" maxlength="45" pattern="^[a-z ,.'-]+$" required>
        </p>
        <p>
            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" id="prenom" maxlength="45" pattern="^[a-z ,.'-]+$" required>
        </p>
        <p>
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" maxlength="150" pattern="^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$" required>
        </p>
        <p>
            <label for="adresse">Adresse :</label>
            <input type="text" name="adresse" id="adresse" maxlength="150" required>
        </p>
        <p>
            <label for="ville">Ville :</label>
            <input type="text" name="ville" id="ville" maxlength="45" required>
        </p>
        <p>
            <label for="cp">Code Postal :</label>
            <input type="text" name="cp" id="cp" maxlength="5" pattern="\d{2}[ ]?\d{3}" required>
        </p>
        <p>
            <label for="mdp">Mot de passe :</label>
            <input type="password" name="mdp" id="mdp" maxlength="80" required>
        </p>
    </fieldset>
    <p>
        <input type="submit" value="S'inscrire">
    </p>
</form>