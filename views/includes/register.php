<section id="register">
    <form class="form" method="post">
        <h1>Inscription</h1>
        <?php
        if (isset($error)) { ?>
            <p class="error">Erreur : <?= $error ?></p><br>
            <?php
        } ?>
        <label for="nickname">Pseudo</label> <input type="text" name="nickname" required value="<?= htmlspecialchars($nickname ?? '') ?>">
        <label for="email">Adresse e-mail</label> <input type="email" name="email" required value="<?= htmlspecialchars($email ?? '') ?>">
        <label for="password">Mot de passe</label> <input type="password" name="password" required value="<?= htmlspecialchars($password ?? '') ?>">

        <input type="submit" class="button fullwidth text-center" value="S'inscrire" name="register">

        <p class="login-link">Déjà inscrit ? <a href="identification">Connectez-vous</a></p>
    </form>
    <div class="image">
        <img src="<?= IMG_PATH ?>register-login.png" title="" alt="">
    </div>
</section>
