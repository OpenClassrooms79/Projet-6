<section id="account">
    <h1>Mon compte</h1>
    <section id="profile">
        <form method="post" enctype="multipart/form-data">
            <div id="profile-display">
                <?= Components::get('profileDisplay', $user, count($books)) ?>
            </div>
            <div id="profile-form">
                <div class="personal-info">Vos informations personnelles</div>
                <?php
                if (!empty($error)) { ?>
                    <p class="error">Erreur : <?= $error ?></p><br>
                    <?php
                } ?>
                <label for="email">Adresse e-mail</label> <input type="email" id="email" name="email" required value="<?= htmlspecialchars($user->getEmail()) ?>" class="member">
                <label for="password">Mot de passe</label> <input type="password" id="password" name="password" class="member">
                <label for="nickname">Pseudo</label> <input type="text" id="nickname" name="nickname" required value="<?= htmlspecialchars($user->getNickname()) ?>" class="member">

                <input type="submit" class="button inverse text-center" value="Enregistrer" name="update">
            </div>
        </form>
    </section>
    <?= Components::get('bookList', $books, true); ?>
</section>

<script>
    manageImage('avatar', 'avatar-image');
</script>