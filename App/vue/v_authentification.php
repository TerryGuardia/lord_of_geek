<h1>Authentification</h1>
<form action="index.php?uc=compte&action=authentification" method="post">
    <fieldset>
        <p>
            <label for="email">Votre Email :</label>
            <input type="email" name="email" id="email" maxlength="150" pattern="^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$" required>
        </p>
        <p>
            <label for="mdp">Votre Mot de passe :</label>
            <input type="password" name="mdp" id="mdp" maxlength="80" required>
        </p>
    </fieldset>
    <p>
        <input type="submit" value="S'authentifier">
    </p>
</form>

<a href="index.php?uc=inscription">Créer un compte</a>