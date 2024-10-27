<p class="breadcrumbs-detail">Nos livres &gt; <?= htmlspecialchars($book->getTitle()) ?></p>
<section id="detail">
    <div class="image">
        <img src="<?= htmlspecialchars($book->getImagePath()) ?>" title="<?= htmlspecialchars($book->getTitle()) ?>" alt="<?= htmlspecialchars($book->getTitle()) ?>">
    </div>
    <div class="book">
        <h1><?= htmlspecialchars($book->getTitle()) ?></h1>
        <p class="detail-book-author">par <?= htmlspecialchars($book->getAuthorsText()) ?></p>
        <hr class="detail-hr">
        <p class="book-desc">Description</p>
        <p class="book-desc-text"><?= htmlspecialchars($book->getDescription()) ?></p>
        <p class="book-owner">Propriétaire</p>

        <div class="owner-badge">
            <a href="profil?id=<?= $book->getOwner()->getId() ?>">
                <img src="<?= $book->getOwner()->getAvatarPath() ?>" alt="Avatar">
                <?= htmlspecialchars($book->getOwner()->getNickname()) ?>
            </a>
        </div>


        <a class="button fullwidth text-center" href="messagerie?from=<?= $book->getOwner()->getId() ?>#from<?= $book->getOwner()->getId() ?>">Envoyer un message</a>
    </div>
</section>
