<section id="account">
    <h1>Mon compte</h1>
    <section id="profile">
        <form method="post" enctype="multipart/form-data">
            <div id="profile-display">
                <img class="avatar-large" alt="<?= htmlspecialchars($user->getNickname()) ?>" src="<?= htmlspecialchars($user->getAvatar()) ?>">
                <div><a class="modify" href="">modifier</a></div>
                <hr>
                <div class="nickname-big"><?= htmlspecialchars($user->getNickname()) ?></div>
                <div class="member-since">Membre depuis <?= Utils::getDaysSince($user->getRegistrationDate()) ?></div>
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
                    <td><a href="">Éditer</a> <a href="">Supprimer</a></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </section>
</section>
