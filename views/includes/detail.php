<p class="breadcrumbs">Nos livres &gt; <?= htmlspecialchars($book->getTitle()) ?></p>
<section id="detail">
    <div class="image">
        <img src="<?= htmlspecialchars($book->getImagePath()) ?>" title="<?= htmlspecialchars($book->getTitle()) ?>" alt="<?= htmlspecialchars($book->getTitle()) ?>">
    </div>
    <div class="book">
        <h1><?= htmlspecialchars($book->getTitle()) ?></h1>
        <p class="detail-book-author">par <?= htmlspecialchars($book->getAuthorsText()) ?></p>
        <hr>
        <p class="book-desc">Description</p>
        <p class="book-desc-text"><?= htmlspecialchars($book->getDescription()) ?></p>
        <p class="book-owner">Propriétaire</p>

        <div class="owner-badge">
            <a href="profil?id=<?= $book->getOwner()->getId() ?>">
                <img src="<?= AVATARS_PATH . $book->getOwner()->getAvatar() ?>">
                <?= htmlspecialchars($book->getOwner()->getNickname()) ?>
            </a>
        </div>


        <a class="button fullwidth text-center">Envoyer un message</a>
    </div>
</section>
