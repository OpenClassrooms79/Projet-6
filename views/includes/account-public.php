<section id="account-public">
    <section id="profile-public">
        <img class="avatar" src="<?= AVATARS_PATH ?>avatar1.png">
        <hr>
        <div class="nickname-big"><?= $member->getNickname() ?></div>
        <div class="member-since">Membre depuis <?= Utils::getDaysSince($member->getRegistrationDate()) ?></div>
        <div class="biblio">Bibliothèque</div>
        <div class="nb-books"><img src="<?= ICONS_PATH ?>biblio.svg"> <?= count($books) ?> livre(s)</div>

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
                    <td><img src="<?= BOOKS_PATH . htmlspecialchars($book->getImage()) ?>"></td>
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