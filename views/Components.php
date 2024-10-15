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
}
