<div class="exchanges">
    <div class="exchange-header">
        <h1>Nos livres à l’échange</h1>
        <form method="get">
            <input id="search" name="search" class="book-search" type="search" placeholder="Rechercher un livre" value="<?= htmlspecialchars($search ?? '') ?>">
            <div id="clear-button" class="clear-input-button" aria-label="Effacer" title="Effacer">×
            </div>
        </form>
    </div>

    <?php
    if (empty($books)) { ?>
        Aucun livre ne correspond au texte recherché.
        <?php
    }
    ?>
    <section id="books-exchange">
        <?php
        foreach ($books as $book) {
            require 'book.php';
        } ?>
    </section>
</div>
<script>
    document.getElementById('clear-button').addEventListener('click', function () {
        document.location = "./echanges";
    });
</script>