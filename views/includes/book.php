<div class="book">
    <img src="img/books/<?= $book->getImage() ?>">
    <p class="book-title"><?= $book->getTitle() ?></p>
    <?php
    foreach ($book->getAuthors() as $author) {
        printf('<p class="book-author">%s %s</p>', $author->getFirstname(), $author->getLastname());
    }
    ?>
    <p class="book-seller">Vendu par : ????????</p>
</div>