<?php

function messageSender(User $sender, Message $message): void
{
    if ($message->getCreated()->format('Y-m-d') === (new DateTime('now'))->format('Y-m-d')) {
        // le message a été créé aujourd'hui
        $message_time = $message->getCreated()->format('H:i');
    } else {
        $message_time = $message->getCreated()->format('d.m');
    }
    ?>
    <a href="?from_id=<?= $sender->getId() ?>" class="member-block">
        <!--<div class="member-block">-->
        <img src="<?= $sender->getAvatarPath() ?>" class="avatar-medium" alt="Avatar">
        <div class="member-details">
            <div class="member-details-1">
                <span class="book-desc-text"><?= $sender->getNickname() ?></span>
                <span class="message-time"><?= $message_time ?></span>
            </div>
            <div class="member-details-2"><?= $message->getContent() ?></div>
        </div>
        <!--</div>-->
    </a>
    <?php
}