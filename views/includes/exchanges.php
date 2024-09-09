<div class="exchanges">
    <div class="exchange-header">
        <h2>Nos livres à l’échange</h2>
        <input class="book-search" type="search" placeholder="Rechercher un livre">
    </div>

    <section id="books-exchange">
        <?php
        foreach ($books as $book) {
            require 'book.php';
        }
        ?>
    </section>
</div>