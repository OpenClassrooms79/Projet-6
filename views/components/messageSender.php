<?php

function messageSender(User $sender, ?Message $message, bool $isCurrentSender = false): void
{
    if ($message === null) {
        $message_time = '';
        $content = '';
    } else {
        if ($message->getCreated()->getTimestamp() === (new DateTime('now'))->getTimestamp()) {
            // le message a été créé aujourd'hui, format : Heures:Minutes
            $message_time = $message->getCreated()->format('H:i');
        } else {
            // le message n'a pas été créé aujourd'hui, format : Jour.Mois
            $message_time = $message->getCreated()->format('d.m');
        }
        $content = $message->getContent();
    }
    $activeClass = $isCurrentSender ? " active" : "";
    ?>
    <a id="from<?= $sender->getId() ?>" href="?from=<?= $sender->getId() ?>" class="member-block<?= $activeClass ?>">
        <img src="<?= $sender->getAvatarPath() ?>" class="avatar-medium" alt="Avatar">
        <div class="member-details">
            <div class="member-details-1">
                <span class="book-desc-text"><?= $sender->getNickname() ?></span>
                <span class="message-time"><?= $message_time ?></span>
            </div>
            <div class="member-details-2"><?= $content ?></div>
        </div>
    </a>
    <?php
}