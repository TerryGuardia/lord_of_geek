<h1>Inscription</h1>
<form action="index.php?uc=compte&action=inscription" method="post">
    <fieldset>
        <legend>Inscription</legend>
        <p>
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom">
        </p>
        <p>
            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" id="prenom">
        </p>
        <p>
            <label for="email">Email :</label>
            <input type="email" name="email" id="email">
        </p>
        <p>
            <label for="adresse">Adresse :</label>
            <input type="text" name="adresse" id="adresse">
        </p>
        <p>
            <label for="ville">Ville :</label>
            <input type="text" name="ville" id="ville">
        </p>
        <p>
            <label for="cp">Code Postal :</label>
            <input type="text" name="cp" id="cp">
        </p>
        <p>
            <label for="mdp">Mot de passe :</label>
            <input type="password" name="mdp" id="mdp">
        </p>
    </fieldset>
    <p>
        <input type="submit" value="S'inscrire">
    </p>
</form>