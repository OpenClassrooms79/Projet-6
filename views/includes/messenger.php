<section id="messenger">
    <div id="members">
        <h1>Messagerie</h1>
        <?php
        foreach ($messageSenders as $sender) {
            echo Components::get(
                'messageSender',
                new User([
                    'id' => $sender['from_id'],
                    'nickname' => $sender['nickname'],
                ]),
                new Message([
                    'id' => $sender['id'],
                    'content' => $sender['content'],
                    'created' => $sender['created'],
                    'is_read' => $sender['is_read'],
                ]),
            );
        }
        ?>
    </div>
    <div id="messages">
        <div id="from">
            <img src="<?= $user->getAvatarPath() ?>" class="avatar-medium" alt="Alexlecture"> <span>Alexlecture</span>
        </div>

        <div id="discussion">

            <div class="message message-from-me">
                <div class="message-time">21.08 15:44</div>
                <span class="message-body">Lorem ipsum dolor sit amet, consectetur .adipiscing elit, sed do eiusmod tempor</span>
            </div>


            <div class="message message-from-other">
                <div class="message-header">
                    <img src="<?= $user->getAvatarPath() ?>" class="avatar-small" alt="Alexlecture">
                    <div class="message-time">21.08 15:48</div>
                </div>
                <span class="message-body">Lorem ipsum dolor sit amet, consectetur .adipiscing elit, sed do eiusmod tempor</span>
            </div>


            <form method="post">
                <input type="text" name="message" id="message-input" placeholder="Tapez votre message ici"><input type="submit" value="Envoyer">
            </form>
        </div>
    </div>
</section>