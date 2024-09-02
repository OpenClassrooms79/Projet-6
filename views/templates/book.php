<div>
    <img src="img/books/<?= $book->getImage() ?>">
    <p class="book-title"><?= $book->getTitle() ?></p>
    <?php
    foreach ($book->getAuthors() as $author) {
        printf('<p>%s %s</p>', $author->getFirstname(), $author->getLastname());
    }
    ?>
</div>