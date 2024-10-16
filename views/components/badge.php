<?php

function badge(bool $isAvailable): void
{
    if ($isAvailable) {
        $class = 'badge-available';
        $text = 'disponible';
    } else {
        $class = 'badge-unavailable';
        $text = 'non dispo.';
    }
    ?>
    <div class="badge <?= $class ?>"><?= $text ?></div>
    <?php
}
