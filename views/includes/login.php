<section id="login">
    <form class="form" method="post">
        <h1>Connexion</h1>
        <?php
        if (!empty($error)) { ?>
            <p class="error">Erreur : <?= $error ?></p><br>
            <?php
        } ?>
        <label for="email">Adresse e-mail</label> <input type="email" id="email" name="email" required value="<?= htmlspecialchars($email ?? '') ?>">
        <label for="password">Mot de passe</label> <input type="password" id="password" name="password" required value="<?= htmlspecialchars($password ?? '') ?>">

        <input type="submit" class="button fullwidth text-center" value="Se connecter" name="login">

        <p class="register-link">Pas de compte ? <a href="inscription">Inscrivez-vous</a></p>
    </form>
    <div class="image">
        <img src="<?= IMG_PATH ?>register-login.png" title="" alt="">
    </div>
</section>
