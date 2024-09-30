<p class="breadcrumbs">&larr; Retour</p>
<h1 class="detail-edit">Modifier les informations</h1>
<section id="detail-edit">
    <div class="image">
        <img src="<?= BOOKS_PATH . $book->getImage() ?>" title="<?= htmlspecialchars($book->getTitle()) ?>" alt="<?= htmlspecialchars($book->getTitle()) ?>">
    </div>
    <div class="form" method="post">
        <label for="title">Titre</label>
        <input id="title" name="title" value="<?= htmlspecialchars($book->getTitle()) ?>">
        <label for="authors">Auteur(s)</label>
        <input id="authors" name="authors" value="<?= htmlspecialchars($book->getAuthorsText()) ?>">
        <label for="description">Commentaire</label>
        <input id="description" name="description" value="<?= htmlspecialchars($book->getDescription()) ?>">
        <select id="availability" name="availability">
            <option value="0">indisponible</option>
            <option value="1">disponible</option>
        </select>
        <input type="submit" class="button text-center" value="Valider">
    </div>
</section>
