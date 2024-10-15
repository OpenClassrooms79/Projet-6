<section id="account">
    <h1>Mon compte</h1>
    <section id="profile">
        <form method="post" enctype="multipart/form-data">
            <div id="profile-display">
                <img class="avatar-large" alt="<?= htmlspecialchars($user->getNickname()) ?>" src="<?= htmlspecialchars($user->getAvatarPath()) . '?' . time() ?>" id="avatar-image">
                <label class="modify" id="avatar-label" for="avatar">modifier</label>
                <input type="hidden" name="MAX_FILE_SIZE" value="3145728">
                <input type="file" name="avatar" id="avatar" accept="image/*">
                <hr>
                <div class="nickname-big"><?= htmlspecialchars($user->getNickname()) ?></div>
                <div class="member-since">Membre depuis
                    <time datetime="<?= Utils::getISO8601Format($user->getRegistrationDate()) ?>" title="<?= Utils::getDaysSince($user->getRegistrationDate()) ?>"><?= Utils::getDaysSince($user->getRegistrationDate(), true) ?></time>
                </div>
                <div class="biblio">Bibliothèque</div>
                <div class="nb-books"><img src="<?= ICONS_PATH ?>biblio.svg" alt=""> <?= count($books) ?> livre(s)</div>
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
    <section id="book-list">
        <table>
            <thead>
            <tr>
                <th>PHOTO</th>
                <th>TITRE</th>
                <th>AUTEUR(S)</th>
                <th>DESCRIPTION</th>
                <th>DISPONIBILITÉ</th>
                <th>ACTION</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($books as $book) {
                ?>
                <tr>
                    <td><img src="<?= htmlspecialchars($book->getImagePath()) ?>" alt="Couverture du livre"></td>
                    <td class="cell-center"><?= htmlspecialchars($book->getTitle()) ?></td>
                    <td class="cell-center"><?= htmlspecialchars($book->getAuthorsText()) ?></td>
                    <td><?= htmlspecialchars($book->getDescription()) ?></td>
                    <td><?= Components::badge($book->isExchangeable()) ?></td>
                    <td>
                        <div class="action-links">
                            <a class="edit-link" href="">Éditer</a>
                            <a class="delete-link" href="">Supprimer</a>
                        </div>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </section>
</section>

<script>
    manageImage('avatar', 'avatar-image');
</script>