<html>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
<header>
    <nav>
        <div class="left">
            <a href="index" title="Accueil TomTroc">
                <div class="logo-with-text">

                    <img src="img/logo.png" alt="TomTroc" width="51" height="51">
                    TomTroc
                </div>
            </a>
            <div class="menu-left">
                <a href="" class="current">Accueil</a>
                <a href="echanges">Nos livres à l'échange</a>
            </div>
        </div>
        <div class="right">
            <a href="messagerie">🗨️ Messagerie <span class="number">1</span></a>
            <a href="compte">
                <div id="account-icon">
                    <div></div>
                    <div></div>
                </div>
                Mon compte</a>
            <a href="identification">Connexion</a>
        </div>
    </nav>
</header>
<?= $content ?>
<footer>
    <nav class="right">
        <a href="">Politique de confidentialité</a>
        <a href="">Mentions légales</a>
        <a href="">Tom Troc©️</a>
        <a href="index" title="Accueil TomTroc"><img src="img/logo2.png"></a>
    </nav>
</footer>
</body>
</html>