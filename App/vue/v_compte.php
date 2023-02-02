
<h1 style="text-align: center;">Bienvenue sur votre compte <?= $_SESSION['utilisateur']['prenom']?></h1>

<a href="index.php?uc=compte&action=historique">Voir historique des commandes</a>
<br>
<a href="index.php?uc=compte&action=modifInfo">Modifier les informations du compte</a>
<br>
<a href="index.php?uc=compte&action=deconnexion">Déconnexion</a>