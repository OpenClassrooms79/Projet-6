<section id="messenger">
    <div id="members">
        <h1>Messagerie</h1>
        <?php
        foreach ($messageSenders as $sender) {
            if ($sender['from_id'] === $sender['user_id']) {
                $message = new Message([
                    'id' => $sender['id'],
                    'content' => $sender['content'],
                    'created' => $sender['created'],
                    'is_read' => $sender['is_read'],
                ]);
            } else {
                $message = null;
            }

            echo Components::get(
                'messageSender',
                new User([
                    'id' => $sender['user_id'],
                    'nickname' => $sender['nickname'],
                ]),
                $message,
            );
        }
        ?>
    </div>
    <div id="messages">
        <div id="from">
            <img src="<?= $fromUser->getAvatarPath() ?>" class="avatar-medium" alt="<?= $fromUser->getNickname() ?>"> <span><?= $fromUser->getNickname() ?></span>
        </div>

        <div id="discussion">
            <?php
            foreach ($messages as $message) {
                if ($message->getFromId() === $userId) {
                    echo Components::get('messageFromMe', $message);
                } else {
                    echo Components::get('messageFromOther', $fromUser, $message);
                }
            }
            ?>

            <form method="post">
                <input type="text" name="message" id="message-input" placeholder="Tapez votre message ici"><input type="submit" value="Envoyer">
            </form>
        </div>
    </div>
</section>