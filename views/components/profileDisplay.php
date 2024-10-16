<?php

function profileDisplay(User $user, int $nbBooks, bool $privateProfile = true): void
{
    ?>
    <img class="avatar-large" alt="<?= htmlspecialchars($user->getNickname()) ?>" src="<?= htmlspecialchars($user->getAvatarPath()) . '?' . time() ?>" id="avatar-image">
    <?php
    if ($privateProfile) {
        ?>
        <label class="modify" id="avatar-label" for="avatar">modifier</label>
        <input type="hidden" name="MAX_FILE_SIZE" value="3145728">
        <input type="file" name="avatar" id="avatar" accept="image/*">
        <?php
    }
    ?>
    <hr>

    <div class="nickname-big"><?= htmlspecialchars($user->getNickname()) ?></div>
    <div class="member-since">Membre depuis
        <time datetime="<?= Utils::getISO8601Format($user->getRegistrationDate()) ?>" title="<?= Utils::getDaysSince($user->getRegistrationDate()) ?>"><?= Utils::getDaysSince($user->getRegistrationDate(), true) ?></time>
    </div>
    <div class="biblio">Bibliothèque</div>
    <div class="nb-books"><img src="<?= ICONS_PATH ?>biblio.svg" alt=""> <?= $nbBooks ?> livre(s)</div>
    <?php
}
