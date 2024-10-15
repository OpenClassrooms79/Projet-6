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
        <div class="<?= $class ?>"><?= $text ?></div>
        <?php
        return ob_get_clean();
    }

    public static function messageSender(User $sender, Message $message): string
    {
        if ($message->getCreated()->format('Y-m-d') === (new \DateTime('now'))->format('Y-m-d')) {
            // le message a été créé aujourd'hui
            $message_time = $message->getCreated()->format('H:i');
        } else {
            $message_time = $message->getCreated()->format('d.m');
        }

        ob_start();
        ?>
        <a href="?from_id=<?= $sender->getId() ?>" class="member-block">
            <!--<div class="member-block">-->
            <img src="<?= $sender->getAvatarPath() ?>" class="avatar-medium">
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
}
