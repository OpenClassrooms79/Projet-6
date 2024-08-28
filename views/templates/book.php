<img src="img/books/<?= $book->getImage() ?>">
<?= $book->getTitle() ?>
<?php
foreach ($book->getAuthors() as $author) {
    printf('%s %s', $author->getFirstname(), $author->getLastname());
}
?>