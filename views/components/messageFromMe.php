<?php

function messageFromMe(Message $message): void
{
    ?>
    <div class="message message-from-me" id="msg<?= $message->getId() ?>">
        <div class="message-time"><?= $message->getCreated()->format('d.m H:i') ?></div>
        <span class="message-body"><?= htmlspecialchars($message->getContent()) ?></span>
    </div>
    <?php
}