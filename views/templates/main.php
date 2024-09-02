<html>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
<header>
    <nav>
        <div class="left">
            <div class="logo-with-text">
                <img src="img/logo2.png" alt="TomTroc" width="51" height="51">
                TomTroc
            </div>
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
    <a href="">Politique de confidentialité</a>
    <a href="">Mentions légales</a>
    <a href="">Tom Troc©️</a>
    LOGO
</footer>
</body>
</html>