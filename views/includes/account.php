<section id="account">
    <h1>Mon compte</h1>
    <section id="profile">
        <div id="profile-display">
            <img class="avatar" alt="<?= htmlspecialchars($user->getNickname()) ?>" src="<?= AVATARS_PATH . htmlspecialchars($user->getAvatar()) ?>">
            <div><a class="modify" href="">modifier</a></div>
            <hr>
            <div class="nickname-big"><?= htmlspecialchars($user->getNickname()) ?></div>
            <div class="member-since">Membre depuis <?= Utils::getDaysSince($user->getRegistrationDate()) ?></div>
            <div class="biblio">Bibliothèque</div>
            <div class="nb-books"><img src="<?= ICONS_PATH ?>biblio.svg" alt=""> <?= count($books) ?> livre(s)</div>
        </div>
        <form id="profile-form" method="post">
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
        </form>
    </section>
    <section id="book-list">
        <table>
            <thead>
            <tr>
                <th>PHOTO</th>
                <th>TITRE</th>
                <th>AUTEUR</th>
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
                    <td><img src="<?= BOOKS_PATH . htmlspecialchars($book->getImage()) ?>" alt="Couverture du livre"></td>
                    <td><?= htmlspecialchars($book->getTitle()) ?></td>
                    <td><?= htmlspecialchars($book->getAuthorsText()) ?></td>
                    <td><?= htmlspecialchars($book->getDescription()) ?></td>
                    <td><?= $book->isExchangeable() ? 'Disponible' : 'Indisponible' ?></td>
                    <td><a href="">Éditer</a> <a href="">Supprimer</a></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </section>
</section>
