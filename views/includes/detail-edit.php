<main>
    <p class="breadcrumbs">&larr; Retour</p>
    <h1 class="detail-edit">Modifier les informations</h1>
    <form class="form" method="post" enctype="multipart/form-data">
        <section id="detail-edit">
            <div class="image">
                <label for="cover">Photo</label>
                <img src="<?= htmlspecialchars($book->getImagePath()) . '?' . time() ?>" title="<?= htmlspecialchars($book->getTitle()) ?>" alt="<?= htmlspecialchars($book->getTitle()) ?>" id="cover-image">
                <label id="cover-label" for="cover">Modifier la photo</label>
                <input type="hidden" name="MAX_FILE_SIZE" value="3145728">
                <input type="file" name="cover" id="cover" accept="image/*">
            </div>
            <section>
                <label for="title">Titre</label>
                <input id="title" name="title" type="text" value="<?= htmlspecialchars($book->getTitle()) ?>" required class="member">
                <label for="authors">Auteur(s)</label>
                <input id="authors" name="authors" type="text" value="<?= htmlspecialchars($authors) ?>" required class="member" placeholder="Prénom1, Nom1, Pseudo1 ; Prénom2, Nom2, Pseudo2…">
                <label for="description">Commentaire</label>
                <textarea id="description" name="description" required class="member"><?= htmlspecialchars($book->getDescription()) ?></textarea>
                <label for="availability">Disponibilité</label>
                <select id="availability" name="availability" class="member">
                    <option value="0" <?= $book->isExchangeable() ? '' : ' selected' ?>>indisponible</option>
                    <option value="1" <?= $book->isExchangeable() ? ' selected' : '' ?>>disponible</option>
                </select>
                <input type="submit" class="button text-center" value="Valider" name="update-book">
            </section>
        </section>
    </form>
</main>

<script>
    manageImage('cover', 'cover-image');
</script>