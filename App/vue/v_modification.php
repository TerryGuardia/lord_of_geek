<h1>Modification des informations liées au compte</h1>

<form action="index.php?uc=compte&action=modification" method="post">
    <label for="nom">Nom :</label>
    <input type="text" name="nom" id="nom" value="<?= $_SESSION['utilisateur']['nom']?>">
    <br>
    <label for="prenom">Prénom :</label>
    <input type="text" name="prenom" id="prenom" value="<?= $_SESSION['utilisateur']['prenom']?>">
    <br>
    <label for="email">Email :</label>
    <input type="email" name="email" id="email" value="<?= $_SESSION['utilisateur']['email']?>">
    <br>
    <label for="adresse">Adresse :</label>
    <input type="text" name="adresse" id="adresse" value="<?= $_SESSION['utilisateur']['adresse']?>">
    <br>
    <label for="ville">Ville :</label>
    <input type="text" name="ville" id="ville" value="<?= $_SESSION['utilisateur']['ville']?>">
    <br>
    <label for="cp">Code Postal :</label>
    <input type="text" name="cp" id="cp" value="<?= $_SESSION['utilisateur']['cp']?>">
    <br>
    <label for="mdp">Mot de passe :</label>
    <input type="password" name="mdp" id="mdp" value="">
    <br>
    <input type="submit" value="Mettre à jour">
</form>