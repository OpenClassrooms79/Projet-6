<section id="register-login">
    <form class="form" method="post">
        <h1><?= $h1 ?></h1>
        <?php
        if (!empty($error)) { ?>
            <p class="error">Erreur : <?= $error ?></p><br>
            <?php
        }
        if ($button_name === 'register') {
            ?>
            <label for="nickname">Pseudo</label> <input type="text" id="nickname" name="nickname" required value="<?= htmlspecialchars($nickname ?? '') ?>">
            <?php
        }
        ?>

        <label for="email">Adresse e-mail</label> <input type="email" id="email" name="email" required value="<?= htmlspecialchars($email ?? '') ?>">
        <label for="password">Mot de passe</label> <input type="password" id="password" name="password" required value="<?= htmlspecialchars($password ?? '') ?>">

        <input type="submit" class="button fullwidth text-center" value="<?= $button_text ?>" name="<?= $button_name ?>">

        <p class="register-login-link"><?= $bottom_text ?> <a href="<?= $bottom_url ?>"><?= $bottom_link ?></a></p>
    </form>
    <div class="image">
        <img src="<?= IMG_PATH ?>register-login.png" title="" alt="">
    </div>
</section>
