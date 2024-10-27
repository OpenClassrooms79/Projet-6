<section id="exchanges">
    <div class="exchange-header">
        <h1>Nos livres à l’échange</h1>
        <form method="get">
            <input id="book-search" name="search" type="search" placeholder="Rechercher un livre" value="<?= htmlspecialchars($search ?? '') ?>" class="book-search public">
            <div id="clear-button" class="clear-input-button" title="Effacer">×
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
            echo Components::get('book', $book);
        } ?>
    </section>
</section>
<script>
    document.getElementById('clear-button').addEventListener('click', function () {
        document.location = "./echanges";
    });
</script>