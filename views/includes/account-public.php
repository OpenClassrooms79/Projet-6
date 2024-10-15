<section id="account-public">
    <section id="profile-public">
        <img class="avatar-large" alt="<?= htmlspecialchars($user->getNickname()) ?>" src="<?= htmlspecialchars($user->getAvatar()) ?>">
        <hr>
        <div class="nickname-big"><?= htmlspecialchars($user->getNickname()) ?></div>
        <div class="member-since">Membre depuis <?= Utils::getDaysSince($user->getRegistrationDate()) ?></div>
        <div class="biblio">Bibliothèque</div>
        <div class="nb-books"><img src="<?= ICONS_PATH ?>biblio.svg" alt=""> <?= count($books) ?> livre(s)</div>

        <a href="" class="button inverse text-center">Écrire un message</a>
    </section>
    <section id="book-list">
        <table>
            <thead>
            <tr>
                <th>PHOTO</th>
                <th>TITRE</th>
                <th>AUTEUR</th>
                <th>DESCRIPTION</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($books as $book) {
                ?>
                <tr>
                    <td><img src="<?= htmlspecialchars($book->getImagePath()) ?>" alt="Couverture du livre"></td>
                    <td><?= htmlspecialchars($book->getTitle()) ?></td>
                    <td><?= htmlspecialchars($book->getAuthorsText()) ?></td>
                    <td><?= htmlspecialchars(mb_substr($book->getDescription(), 0, 87)) ?>...</td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </section>
</section>
