<main>
    <p class="breadcrumbs">&larr; Retour</p>
    <h1 class="detail-edit">Modifier les informations</h1>
    <section id="detail-edit">
        <div class="image">
            <img src="<?= BOOKS_PATH . $book->getImage() ?>" title="<?= htmlspecialchars($book->getTitle()) ?>" alt="<?= htmlspecialchars($book->getTitle()) ?>">
        </div>
        <form class="form" method="post">
            <label for="title">Titre</label>
            <input id="title" name="title" type="text" value="<?= htmlspecialchars($book->getTitle()) ?>" required class="member">
            <label for="authors">Auteur(s)</label>
            <input id="authors" name="authors" type="text" value="<?= htmlspecialchars($authors) ?>" required class="member" placeholder="Prénom1, Nom1, Pseudo1 ; Prénom2, Nom2, Pseudo2…">
            <label for="description">Commentaire</label>
            <textarea id="description" name="description" type="text" required class="member"><?= htmlspecialchars($book->getDescription()) ?></textarea>
            <label for="availability">Disponibilité</label>
            <select id="availability" name="availability" class="member">
                <option value="0" <?= $book->isExchangeable() ? '' : ' selected' ?>>indisponible</option>
                <option value="1" <?= $book->isExchangeable() ? ' selected' : '' ?>>disponible</option>
            </select>
            <input type="submit" class="button text-center" value="Valider" name="update-book">
        </form>
    </section>
</main>