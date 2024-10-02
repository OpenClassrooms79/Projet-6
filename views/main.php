<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="css/style.css" rel="stylesheet">
    <title><?= htmlspecialchars($title) ?></title>
</head>
<body>
<header>
    <nav>
        <div class="left">
            <a href="./" title="Accueil TomTroc">
                <div class="logo-with-text">

                    <img src="<?= IMG_PATH ?>logo.png" alt="TomTroc" width="51" height="51">
                    TomTroc
                </div>
            </a>
            <div class="menu-left">
                <a href="./" class="current">Accueil</a>
                <a href="echanges">Nos livres à l'échange</a>
            </div>
        </div>
        <div class="right">
            <?php
            if (isset($_SESSION['user'])) { ?>
                <a href="messagerie"><img class="icon" src="<?= ICONS_PATH ?>message.svg" alt="Messages"> Messagerie <span class="number">1</span></a>
                <a href="profil"><img class="icon" src="<?= ICONS_PATH ?>account.svg" alt="Compte">Mon compte</a>
                <a href="deconnexion">Déconnexion</a>
                <?php
            } else { ?>
                <a href="identification">Connexion</a>
                <?php
            } ?>
        </div>
    </nav>
</header>
<?= $content ?>
<footer>
    <nav class="right">
        <a href="">Politique de confidentialité</a>
        <a href="">Mentions légales</a>
        <a href="">Tom Troc©️</a>
        <a href="index" title="Accueil TomTroc"><img src="<?= IMG_PATH ?>logo2.png" alt="TomTroc"></a>
    </nav>
</footer>
</body>
</html>