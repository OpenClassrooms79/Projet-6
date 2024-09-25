<a href="detail?id=<?= $book->getId() ?>">
    <div class="book">
        <img class="book-image" src="<?= BOOKS_PATH . $book->getImage() ?>" alt="<?= $book->getTitle() ?>" title="<?= $book->getTitle() ?>">
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