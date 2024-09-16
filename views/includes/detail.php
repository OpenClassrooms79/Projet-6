<p class="breadcrumbs">Nos livres &gt; <?= htmlspecialchars($book->getTitle()) ?></p>
<section id="detail">
    <div class="image">
        <img src="img/books/<?= $book->getImage() ?>" title="<?= htmlspecialchars($book->getTitle()) ?>" alt="<?= htmlspecialchars($book->getTitle()) ?>">
    </div>
    <div class="book">
        <h1><?= htmlspecialchars($book->getTitle()) ?></h1>
        <p class="detail-book-author">par <?= htmlspecialchars($book->getAuthorsText()) ?></p>
        <hr>
        <p class="book-desc">Description</p>
        <p class="book-desc-text"><?= htmlspecialchars($book->getDescription()) ?></p>
        <p class="book-owner">Propriétaire</p>

        <a class="button fullwidth text-center">Envoyer un message</a>
    </div>
</section>
