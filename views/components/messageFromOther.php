<?php

function messageFromOther(User $user, Message $message): void
{
    ?>
    <div class="message message-from-other" id="msg<?= $message->getId() ?>">
        <div class="message-header">
            <img src="<?= $user->getAvatarPath() ?>" class="avatar-small" alt="Alexlecture">
            <div class="message-time"><?= $message->getCreated()->format('d.m H:i') ?></div>
        </div>
        <span class="message-body"><?= htmlspecialchars($message->getContent()) ?></span>
    </div>
    <?php
}