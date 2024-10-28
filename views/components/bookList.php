<?php

function bookList(array $books, bool $extraColumns = false): void
{
    ?>
    <section id="book-list">
        <table>
            <thead>
            <tr>
                <th>PHOTO</th>
                <th>TITRE</th>
                <th>AUTEUR(S)</th>
                <th>DESCRIPTION</th>
                <?php
                if ($extraColumns) { ?>
                    <th>DISPONIBILITÉ</th>
                    <th>ACTION</th>
                    <?php
                } ?>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($books as $book) {
                ?>
                <tr>
                    <td><img src="<?= htmlspecialchars($book->getImagePath()) ?>" alt="Couverture du livre"></td>
                    <td><?= htmlspecialchars($book->getTitle()) ?></td>
                    <td><?= htmlspecialchars($book->getAuthorsText()) ?></td>
                    <td class="italic"><?= htmlspecialchars($book->getTruncatedDescription()) ?></td>
                    <?php
                    if ($extraColumns) { ?>
                        <td><?= Components::get('badge', $book->isExchangeable()) ?></td>
                        <td>
                            <div class="action-links">
                                <a class="edit-link" href="modifier?id=<?= $book->getId() ?>">Éditer</a>
                                <a class="delete-link" href="?supprimer=<?= $book->getId() ?>">Supprimer</a>
                            </div>
                        </td>
                        <?php
                    } ?>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </section>
    <?php
}