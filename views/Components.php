<?php

class Components
{
    public static function book(Book $book): string
    {
        ob_start();
        ?>
        <a href="detail?id=<?= $book->getId() ?>">
            <div class="book">
                <img class="book-image" src="<?= htmlspecialchars($book->getImagePath()) ?>" alt="<?= $book->getTitle() ?>" title="<?= $book->getTitle() ?>">
                <div class="book-texts">
                    <p class="book-title"><?= $book->getTitle() ?></p>
                    <?php
                    foreach ($book->getAuthors() as $author) {
                        printf('<p class="book-author">%s %s</p>', $author->getFirstname(), $author->getLastname());
                    }
                    ?>
                    <p class="book-seller">Vendu par : <?= htmlspecialchars($book->getOwner()->getNickname()) ?></p>
                </div>
            </div>
        </a>
        <?php
        return ob_get_clean();
    }

    public static function badge(bool $isAvailable): string
    {
        if ($isAvailable) {
            $class = 'badge-available';
            $text = 'disponible';
        } else {
            $class = 'badge-unavailable';
            $text = 'non dispo.';
        }
        ob_start();
        ?>
        <div class="badge <?= $class ?>"><?= $text ?></div>
        <?php
        return ob_get_clean();
    }

    public static function messageSender(User $sender, Message $message): string
    {
        if ($message->getCreated()->format('Y-m-d') === (new DateTime('now'))->format('Y-m-d')) {
            // le message a été créé aujourd'hui
            $message_time = $message->getCreated()->format('H:i');
        } else {
            $message_time = $message->getCreated()->format('d.m');
        }

        ob_start();
        ?>
        <a href="?from_id=<?= $sender->getId() ?>" class="member-block">
            <!--<div class="member-block">-->
            <img src="<?= $sender->getAvatarPath() ?>" class="avatar-medium" alt="Avatar">
            <div class="member-details">
                <div class="member-details-1">
                    <span class="book-desc-text"><?= $sender->getNickname() ?></span>
                    <span class="message-time"><?= $message_time ?></span>
                </div>
                <div class="member-details-2"><?= $message->getContent() ?></div>
            </div>
            <!--</div>-->
        </a>
        <?php
        return ob_get_clean();
    }

    public static function profileDisplay(User $user, int $nbBooks, bool $privateProfile = true): string
    {
        ob_start();
        ?>
        <img class="avatar-large" alt="<?= htmlspecialchars($user->getNickname()) ?>" src="<?= htmlspecialchars($user->getAvatarPath()) . '?' . time() ?>" id="avatar-image">
        <?php
        if ($privateProfile) {
            ?>
            <label class="modify" id="avatar-label" for="avatar">modifier</label>
            <input type="hidden" name="MAX_FILE_SIZE" value="3145728">
            <input type="file" name="avatar" id="avatar" accept="image/*">
            <?php
        }
        ?>
        <hr>

        <div class="nickname-big"><?= htmlspecialchars($user->getNickname()) ?></div>
        <div class="member-since">Membre depuis
            <time datetime="<?= Utils::getISO8601Format($user->getRegistrationDate()) ?>" title="<?= Utils::getDaysSince($user->getRegistrationDate()) ?>"><?= Utils::getDaysSince($user->getRegistrationDate(), true) ?></time>
        </div>
        <div class="biblio">Bibliothèque</div>
        <div class="nb-books"><img src="<?= ICONS_PATH ?>biblio.svg" alt=""> <?= $nbBooks ?> livre(s)</div>
        <?php
        return ob_get_clean();
    }

    public static function bookList(array $books, bool $extraColumns = false): string
    {
        ob_start();
        ?>
        <section id="book-list">
            <table>
                <thead>
                <tr>
                    <th>PHOTO</th>
                    <th>TITRE</th>
                    <th>AUTEUR(S)</th>
                    <th>DESCRIPTION</th>
                    <?php
                    if ($extraColumns) { ?>
                        <th>DISPONIBILITÉ</th>
                        <th>ACTION</th>
                        <?php
                    } ?>
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
                        <?php
                        if ($extraColumns) { ?>
                            <td><?= self::badge($book->isExchangeable()) ?></td>
                            <td>
                                <div class="action-links">
                                    <a class="edit-link" href="">Éditer</a>
                                    <a class="delete-link" href="">Supprimer</a>
                                </div>
                            </td>
                            <?php
                        } ?>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </section>
        <?php
        return ob_get_clean();
    }
}
